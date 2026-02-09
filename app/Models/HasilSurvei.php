<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilSurvei extends Model
{
    protected $table = 'hasil_survei';

    protected $fillable = [
        'judul_survei',
        'tanggal',
        'tipe_file',
        'file_path',
        'status'
    ];
}
