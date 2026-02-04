<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ZiWbkDocument;

class ZiwbkController extends Controller
{
    // HALAMAN UTAMA ZI-WBK
   public function index($tahun, $pilar, $subPilar)
    {
    $data = ZiWbk::where('tahun', $tahun)
        ->where('pilar', $pilar)
        ->where('sub_pilar', $subPilar)
        ->orderBy('judul')
        ->get();

    return view('user.ziwbk.index', compact('data', 'tahun', 'pilar', 'subPilar'));
    }

    // HALAMAN DOKUMEN
    public function dokumen($tahun, $area, $sub)
    {
        $dokumen = ZiWbkDocument::where('status', 'publish')
            ->where('tahun', $tahun)
            ->where('pilar', $area)
            ->where('sub_pilar', $sub)
            ->get();

        return view('user.ziwbk.ziwbk', compact(
            'tahun', 'area', 'sub', 'dokumen'
        ));
    }
}
