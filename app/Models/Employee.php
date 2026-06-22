<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'nip',
        'nama',
        'bidang',
        'jabatan',
        'kedisiplinan',
        'kualitas_kerja',
        'tanggung_jawab',
        'kerjasama',
        'loyalitas',
        'total_nilai',
        'bulan',
        'tahun',
    ];

    protected $casts = [
        'kedisiplinan' => 'integer',
        'kualitas_kerja' => 'integer',
        'tanggung_jawab' => 'integer',
        'kerjasama' => 'integer',
        'loyalitas' => 'integer',
        'total_nilai' => 'double',
        'bulan' => 'integer',
        'tahun' => 'integer',
    ];
}
