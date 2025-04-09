<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HashFactory;

class Pengumuman extends Model
{
    use HashFactory;
    protected $fillable=[
        'judulPengumuman',
        'isiPengumuman'
    ];
}
