<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombrecompleto',
        'nombreunidad',
        'anomesdereporte',
        'producto',
        'fechareal',
        'montototal',
        'user_id'
    ];

    protected $dates = ['anomesdereporte'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}
