<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilSurvei extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hasilsurvei';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul_survei',
        'tanggal',
        'status',
        'file_path',
        'tipe_file',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the timestamps for the model.
     *
     * @var bool
     */
    public $timestamps = true;
}
