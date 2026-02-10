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
            // Generate file URL dengan Laravel Storage
            $fileUrl = null;
            if ($item->file_path) {
                // Strip semua prefix lama
                $file = preg_replace(
                    '#^(storage/|/storage/|img/survei/|/img/survei/|survei/|/survei/)#',
                    '',
                    ltrim($item->file_path, '/')
                );
                $fileUrl = 'storage/survei/' . $file;
            }
            
            return [
                'id'    => $item->id,
                'judul' => $item->judul_survei,
                'tahun' => Carbon::parse($item->tanggal)->year,
                'tipe'  => $item->tipe_file,
                'file'  => $fileUrl,
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
    
        // Strip prefix dan construct path
        $filePath = preg_replace(
            '#^(storage/|/storage/|img/survei/|/img/survei/|survei/|/survei/)#',
            '',
            ltrim($data->file_path, '/')
        );
        
        // Try storage path first
        $file = storage_path('app/public/survei/' . $filePath);
        
        // Fallback ke old path jika file belum dipindahkan
        if (!file_exists($file)) {
            $file = public_path('img/survei/' . $filePath);
        }
        
        if (!file_exists($file)) abort(404);
    
        return response()->download(
            $file,
            Str::slug($data->judul_survei) . '-hasil-survei.' . $data->tipe_file
        );
    }
}
