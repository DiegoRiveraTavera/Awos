<?php

// app/Models/Teni.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    use HasFactory;

    protected $table = 'sucursal';
    protected $primaryKey = 'cve_suc';
    protected $fillable = [
        'cve_ciu', 'nom_suc', 'col_suc', 'calle_suc', 'ne_suc',
        'ni_suc', 'cp_suc'
    ];
    public $timestamps = false;
}

