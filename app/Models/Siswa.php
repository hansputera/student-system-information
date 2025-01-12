<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'name',
        'nisn',
        'nik',
        'nis',
        'birth',
        'birth_place',
        'address',
        'mother_name',
        'religion',
        'phone',
        'email',
        'grade',
        'grade_level',
        'synced_at',
    ];

    protected $hidden = [
        'nik',
        'mother_name',
        'nisn',
    ];
}
