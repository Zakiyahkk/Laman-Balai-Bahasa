<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function terbitanbbpr()
    {
        return view('user.produk.terbitan-bbpr');
    }

    public function jurnal()
    {
        return view('user.produk.jurnal');
    }

    public function majalah()
    {
        return view('user.produk.majalah');
    }

    public function sembari(Request $request)
    {
        // ===============================
        // AMBIL DATA DARI DATABASE
        // ===============================
        $query = \App\Models\Sembari::where('status', 'published');

        // Filter Pencarian Judul
        if ($request->has('q') && $request->q != '') {
            $query->where('nama_dokumen', 'like', '%' . $request->q . '%');
        }

        // Filter Tahun
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('tanggal', $request->year);
        }

        // Ambil Data & Urutkan Terbaru
        $data = $query->orderBy('tanggal', 'desc')->get();

        // Mapping ke format yang View harapkan
        $docs = $data->map(function ($item) {
            return [
                'judul'   => $item->nama_dokumen,
                'tahun'   => $item->tanggal ? $item->tanggal->format('Y') : '-',
                'daerah'  => $item->daerah ?? '-',
                'jenjang' => $item->jenjang ?? '-',
                'file'    => $item->file_path, // Pastikan view pakai asset('storage/' . $file)
            ];
        });

        // Ambil List Tahun Unik untuk Dropdown
        // Kita query terpisah agar dropdown tahun tetap lengkap meski sedang difilter
        $years = \App\Models\Sembari::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('user.produk.sembari', [
            'docs' => $docs,
            'years' => $years,
            'q' => $request->q,
            'selectedYear' => $request->year,
        ]);
    }
    
    public function petaPembinaanBahasa()
    {
        return view('user.produk.peta-pembinaan-bahasa');
    }
    public function petaPembinaanSastra()
    {
        return view('user.produk.peta-pembinaan-sastra');
    }
    public function bipa()
    {
        return view('user.produk.bipa');
    }
    public function kemala()
    {
        return view('user.produk.kemala');
    }
    
}
