<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilSurvei;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SurveiController extends Controller
{
    public function survei(Request $request)
    {
        $q = $request->q;
        $selectedYear = $request->year;

        // =========================
        // QUERY DATA DARI ADMIN
        // =========================
        $query = HasilSurvei::where('status', 'terbit');

        // Search judul
        if ($q) {
            $query->where('judul_survei', 'like', '%' . $q . '%');
        }

        // Filter tahun dari tanggal
        if ($selectedYear) {
            $query->whereYear('tanggal', $selectedYear);
        }

        $data = $query->orderByDesc('tanggal')->get();

        // =========================
        // TRANSFORM KE FORMAT VIEW
        // =========================
        $surveis = $data->map(function ($item) {
            return [
                'id'    => $item->id,
                'judul' => $item->judul_survei,
                'tahun' => Carbon::parse($item->tanggal)->year,
                'tipe'  => $item->tipe_file,
                'file'  => $item->file_path,
            ];
        });

        // =========================
        // AMBIL LIST TAHUN
        // =========================
        $years = HasilSurvei::where('status', 'terbit')
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('user.survei.survei', [
            'surveis'      => $surveis,
            'years'        => $years,
            'q'            => $q,
            'selectedYear' => $selectedYear,
        ]);
    }
    
    public function download($id)
    {
        $data = HasilSurvei::where('status','terbit')->findOrFail($id);
    
        if (!$data->file_path) abort(404);
    
        $file = '/home/aajxwzdj/public_html/bbpr/' . $data->file_path;
    
        if (!file_exists($file)) abort(404);
    
        return response()->download(
            $file,
            Str::slug($data->judul_survei) . '-hasil-survei.' . $data->tipe_file
        );
    }
}
