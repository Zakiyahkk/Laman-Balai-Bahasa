<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sembari extends Model
{
    use HasFactory;

    protected $table = 'sembari';

    protected $fillable = [
        'nama_dokumen',
        'deskripsi',  // Tetap kita biarkan nullable jika ingin dikosongkan
        'file_path',
        'status',
        'tanggal',
        'daerah',    // Baru
        'jenjang',   // Baru
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
