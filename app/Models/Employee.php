<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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

    ];
}