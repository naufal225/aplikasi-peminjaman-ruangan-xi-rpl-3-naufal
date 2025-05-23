<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanRuangan;
use App\Models\PengajuanPengembalian;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanPengembalianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $status = $request->input('status', '');
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');
        $type = $request->input('type', 'peminjaman'); // peminjaman or pengembalian
        
        if ($type === 'peminjaman') {
            $query = PeminjamanRuangan::with(['user', 'ruangan']);
            
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->whereHas('user', function($query) use ($search) {
                        $query->where('nama_lengkap', 'like', "%{$search}%");
                    })
                    ->orWhereHas('ruangan', function($query) use ($search) {
                        $query->where('nama_ruangan', 'like', "%{$search}%");
                    });
                });
            }
            
            if (!empty($status)) {
                $query->where('status', $status);
            }
            
            $data = $query->orderBy($sort, $direction)->paginate(10);
            
            if ($request->ajax()) {
                return view('admin.peminjaman-pengembalian.peminjaman-table', compact('data', 'sort', 'direction', 'status'));
            }
        } else {
            $query = PengajuanPengembalian::with(['peminjaman', 'user', 'peminjaman.ruangan']);
            
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->whereHas('user', function($query) use ($search) {
                        $query->where('nama_lengkap', 'like', "%{$search}%");
                    })
                    ->orWhereHas('peminjaman.ruangan', function($query) use ($search) {
                        $query->where('nama_ruangan', 'like', "%{$search}%");
                    });
                });
            }
            
            if (!empty($status)) {
                $query->where('status', $status);
            }
            
            $data = $query->orderBy($sort, $direction)->paginate(10);
            
            if ($request->ajax()) {
                return view('admin.peminjaman-pengembalian.pengembalian-table', compact('data', 'sort', 'direction', 'status'));
            }
        }
        
        return view('admin.peminjaman-pengembalian.index', compact('data', 'search', 'sort', 'direction', 'status', 'type'));
    }
    
    public function create()
    {
        $users = User::all();
        $ruangan = Ruangan::all();
        
        return view('admin.peminjaman-pengembalian.create', compact('users', 'ruangan'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'ruangan_id' => 'required|exists:ruangan,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'durasi_pinjam' => 'required|integer|min:1',
        ]);
        
        // Calculate waktu_selesai based on waktu_mulai and durasi_pinjam
        $tanggal = $validated['tanggal'];
        $waktuMulai = $validated['waktu_mulai'];
        $durasiJam = $validated['durasi_pinjam']; // Assuming durasi_pinjam is in hours
        
        $waktuMulaiDateTime = Carbon::parse($tanggal . ' ' . $waktuMulai);
        $waktuSelesai = $waktuMulaiDateTime->copy()->addHours($durasiJam);
        
        // Check for conflicts
        $conflictingBookings = PeminjamanRuangan::where('ruangan_id', $validated['ruangan_id'])
            ->where('status', 'disetujui')
            ->where('tanggal', $validated['tanggal'])
            ->where(function($query) use ($waktuMulaiDateTime, $waktuSelesai) {
                $query->whereBetween('waktu_mulai', [$waktuMulaiDateTime->format('H:i:s'), $waktuSelesai->format('H:i:s')])
                    ->orWhereBetween('waktu_selesai', [$waktuMulaiDateTime->format('H:i:s'), $waktuSelesai->format('H:i:s')]);
            })
            ->exists();
            
        if ($conflictingBookings) {
            return back()->withErrors(['conflict' => 'Ruangan sudah dibooking pada waktu tersebut.'])->withInput();
        }
        
        // Create the booking
        PeminjamanRuangan::create([
            'user_id' => $validated['user_id'],
            'ruangan_id' => $validated['ruangan_id'],
            'tanggal' => $validated['tanggal'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'durasi_pinjam' => $validated['durasi_pinjam'],
            'waktu_selesai' => $waktuSelesai,
            'status' => 'menunggu',
        ]);
        
        return redirect()->route('peminjaman-pengembalian.index')
            ->with('success', 'Peminjaman ruangan berhasil diajukan');
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak,selesai',
        ]);
        
        $peminjaman = PeminjamanRuangan::findOrFail($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();
        
        return redirect()->route('peminjaman-pengembalian.index')
            ->with('success', 'Status peminjaman berhasil diperbarui');
    }
    
    public function updatePengembalianStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum_disetujui,disetujui',
        ]);
        
        $pengembalian = PengajuanPengembalian::findOrFail($id);
        $pengembalian->status = $request->status;
        
        if ($request->status === 'disetujui') {
            $pengembalian->tanggal_disetujui = now();
            
            // Update the related peminjaman status to 'selesai'
            $peminjaman = $pengembalian->peminjaman;
            $peminjaman->status = 'selesai';
            $peminjaman->save();
        }
        
        $pengembalian->save();
        
        return redirect()->route('peminjaman-pengembalian.index', ['type' => 'pengembalian'])
            ->with('success', 'Status pengembalian berhasil diperbarui');
    }
    
    public function exportData(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'export_type' => 'required|in:peminjaman,pengembalian,all',
        ]);
        
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        
        // In a real application, you would generate an Excel/CSV file here
        // For this example, we'll just redirect back with a success message
        
        return redirect()->route('peminjaman-pengembalian.index')
            ->with('success', 'Data berhasil diekspor untuk periode ' . 
                $startDate->format('d M Y') . ' sampai ' . $endDate->format('d M Y'));
    }
}