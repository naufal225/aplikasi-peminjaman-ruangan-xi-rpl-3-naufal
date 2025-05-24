<?php

namespace App\Http\Controllers;

use App\Imports\RuanganImport;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        ], [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi.',
            'nama_ruangan.string' => 'Nama ruangan harus berupa teks.',
            'nama_ruangan.max' => 'Nama ruangan tidak boleh lebih dari 255 karakter.',

            'lokasi.required' => 'Lokasi ruangan wajib diisi.',
            'lokasi.string' => 'Lokasi ruangan harus berupa teks.',
            'lokasi.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',

            'kapasitas.required' => 'Kapasitas ruangan wajib diisi.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka bulat.',
            'kapasitas.min' => 'Kapasitas minimal adalah 1.',
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
        ], [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi.',
            'nama_ruangan.string' => 'Nama ruangan harus berupa teks.',
            'nama_ruangan.max' => 'Nama ruangan tidak boleh lebih dari 255 karakter.',

            'lokasi.required' => 'Lokasi ruangan wajib diisi.',
            'lokasi.string' => 'Lokasi ruangan harus berupa teks.',
            'lokasi.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',

            'kapasitas.required' => 'Kapasitas ruangan wajib diisi.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka bulat.',
            'kapasitas.min' => 'Kapasitas minimal adalah 1.',
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
        ], [
            "file.required" => "File wajib diisi.",
            "file.file" => "File wajib berupa file.",
            "file.mimes" => "File harus berupa file Excel (XLSX, XLS)."
        ]);

        $request->file('file')->store('imports_data_user', 'public');

        $importer = new RuanganImport();

        $error = false;
        $message = [];

        Excel::import($importer, $request->file('file'));

        $rows_count = $importer->getRowsCount();
        $created_or_updated_rows = $importer->getCreatedOrUpdatedRowsCount();
        $failed_rows = $importer->getFailedRows();

        if ($created_or_updated_rows == 0 || $rows_count == 0) {
            $error = true;
            $message = "Gagal mengimport data, pastikan data valid.";
        }

        if ($error) {
            return redirect()->route('users.index')
                ->with('error', $message)
                ->with('failed_rows', $failed_rows);
        }

        return redirect()->route('ruangan.index')
            ->with('success', $created_or_updated_rows . ' data ruangan berhasil diimpor')
            ->with('failed_rows', $failed_rows);
    }


    public function downloadTemplate()
    {
        $filePath = public_path('/storage/templates/template_data_ruangan.xlsx');

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, 'template_data_ruangan.xlsx');
    }
}
