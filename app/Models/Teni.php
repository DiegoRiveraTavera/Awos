<?php

// app/Models/Teni.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teni extends Model
{
    use HasFactory;

    protected $table = 'tenis';
    protected $primaryKey = 'id_ten';
    protected $fillable = [
        'id_model', 'num_talla', 'categ_ten', 'color_ten',
        'prec_ten', 'costo_ten', 'img_ten', 'cantidad'
    ];
    public $timestamps = false;
}
