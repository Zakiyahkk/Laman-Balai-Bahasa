<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lakin extends Model
{
    use HasFactory;

    /**
     * Nama tabel di Supabase. 
     * Laravel secara default mencari tabel bernama 'lakins' (plural).
     * Jika di Supabase nama tabelnya berbeda, ganti tulisan di bawah ini.
     */
    protected $table = 'lakins';

    /**
     * Kolom yang bisa diisi (Mass Assignment).
     * Ini harus sesuai dengan nama kolom yang ada di tabel Supabase kamu.
     */
    protected $fillable = [
        'nama_dokumen',
        'deskripsi',
        'file_path',
        'status',
        'tanggal',
    ];
    

    /**
     * Karena kamu tidak menggunakan migration Laravel, 
     * pastikan tabel di Supabase memiliki kolom created_at dan updated_at.
     * Jika tidak ada, ubah menjadi false.
     */
    public $timestamps = true;
}