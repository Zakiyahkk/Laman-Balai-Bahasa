<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZiWbkDocument;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ZiWbkController extends Controller
{
    /**
     * TAMPIL DATA + SEARCH & FILTER
     */
    public function index(Request $request)
    {
        $data = ZiWbkDocument::query()
            ->when($request->q, function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->q . '%');
            })
            ->when($request->tahun, function ($query) use ($request) {
                $query->where('tahun', $request->tahun);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.ziwbk.index', compact('data'));
    }

    /**
     * FORM TAMBAH
     */
    public function create()
    {
        return view('admin.ziwbk.create');
    }

    /**
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string',
            'pilar'     => 'required|string',
            'sub_pilar' => 'required|string',
            'tahun'     => 'required|numeric',
            'status'    => 'required|in:publish,draft',
            'file'      => 'required|file|mimes:pdf|max:51200',
        ]);

        $filePath = $request->file('file')->store('zi-wbk', 'public');

        ZiWbkDocument::create([
            'judul'     => $request->judul,
            'pilar'     => Str::slug($request->pilar),
            'sub_pilar' => Str::slug($request->sub_pilar),
            'tahun'     => $request->tahun,
            'status'    => $request->status,
            'file'      => $filePath,
        ]);

        return redirect()
            ->route('admin.ziwbk.index')
            ->with('success', 'Dokumen berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $data = ZiWbkDocument::findOrFail($id);
        return view('admin.ziwbk.edit', compact('data'));
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $data = ZiWbkDocument::findOrFail($id);

        $request->validate([
            'judul'     => 'required|string',
            'pilar'     => 'required|string',
            'sub_pilar' => 'required|string',
            'tahun'     => 'required|numeric',
            'status'    => 'required|in:publish,draft',
            'file'      => 'nullable|file|mimes:pdf|max:51200',
        ]);

        if ($request->hasFile('file')) {
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $data->file = $request->file('file')->store('zi-wbk', 'public');
        }

        $data->update([
            'judul'     => $request->judul,
            'pilar'     => Str::slug($request->pilar),
            'sub_pilar' => Str::slug($request->sub_pilar),
            'tahun'     => $request->tahun,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('admin.ziwbk.index')
            ->with('success', 'Dokumen berhasil diperbarui');
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        $data = ZiWbkDocument::findOrFail($id);

        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()
            ->route('admin.ziwbk.index')
            ->with('success', 'Dokumen berhasil dihapus');
    }
}
