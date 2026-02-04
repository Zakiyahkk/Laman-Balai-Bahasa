<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akuntabilitas extends Model
{
    use HasFactory;

    // Arahkan ke nama tabel baru hasil rename SQL tadi
    protected $table = 'akuntabilitas';

    protected $fillable = [
        'tipe',         // Tambahkan ini agar sistem tahu ini data Renstra, DIPA, atau Lakin
        'nama_dokumen',
        'deskripsi',
        'file_path',
        'status',
        'tanggal',
    ];
    
    // Tetap true karena di screenshot database kamu ada kolom created_at & updated_at
    public $timestamps = true; 
}