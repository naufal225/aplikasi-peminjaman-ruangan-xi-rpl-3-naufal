<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sort = $request->input('sort', 'nama_ruangan');
        $direction = $request->input('direction', 'asc');
        
        $ruangan = Ruangan::where('nama_ruangan', 'like', "%{$search}%")
            ->orWhere('lokasi', 'like', "%{$search}%")
            ->orWhere('kapasitas', 'like', "%{$search}%")
            ->orderBy($sort, $direction)
            ->paginate(10);
            
        if ($request->ajax()) {
            return view('admin.ruangan.table', compact('ruangan', 'sort', 'direction'));
        }
        
        return view('admin.ruangan.index', compact('ruangan', 'search', 'sort', 'direction'));
    }
    
    public function create()
    {
        return view('admin.ruangan.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);
        
        Ruangan::create($validated);
        
        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }
    
    public function edit(Ruangan $ruangan)
    {
        return view('admin.ruangan.edit', compact('ruangan'));
    }
    
    public function update(Request $request, Ruangan $ruangan)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);
        
        $ruangan->update($validated);
        
        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil diperbarui');
    }
    
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        
        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }
    
    public function importForm()
    {
        return view('admin.ruangan.import');
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        
        return redirect()->route('ruangan.index')
            ->with('success', 'Data ruangan berhasil diimpor');
    }
}
