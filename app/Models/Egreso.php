<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombrecompleto',
        'nombreempresa',
        'anomesdereporte',
        'origenegreso',
        'tipodecuenta',
        'N1',
        'N2',
        'N3',
        'N4',
        'N5',
        'descripcionegreso',
        'gasto', 
        'nombreunidad',
        'fechareal',
        'montototal',
        'user_id'
    ];

    protected $dates = ['anomesdereporte'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
