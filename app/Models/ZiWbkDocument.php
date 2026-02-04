<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZiWbkDocument extends Model
{
    use HasFactory;

    protected $table = 'zi_wbk_documents';

    protected $fillable = [
        'tahun',
        'pilar',
        'sub_pilar',
        'judul',
        'file',
        'status'
    ];
}
