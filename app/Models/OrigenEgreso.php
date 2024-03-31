<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrigenEgreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'origenegreso',
        'tipodecuenta'
    ];

}
