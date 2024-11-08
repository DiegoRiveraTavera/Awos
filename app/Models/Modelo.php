<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelo';
    protected $primaryKey = 'id_model';
    protected $fillable = [
        'no_marc', 'nom_model'
    ];
    public $timestamps = false;
}
