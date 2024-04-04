<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEgreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'N1',
        'N2',
        'N3',
        'N4',
        'N5',
        'descripcionegreso',
        'gasto'
    ];
}
