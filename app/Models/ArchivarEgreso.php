<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivarEgreso extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombrecompleto',
        'nombreempresa',
        'anomesdereporte',
        'origenegreso',
        'tipodecuenta',
        'tipoegreso',
        'descripcionegreso',
        'gasto', 
        'nombreunidad',
        'fechareal',
        'montototal',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
