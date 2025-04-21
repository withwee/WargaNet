<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kk',
        'jenis_iuran',
        'total_bayar',
        'status',
    ];
}
