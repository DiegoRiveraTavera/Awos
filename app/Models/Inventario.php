<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';

    protected $fillable = [
        'id_ten',  // Asegúrate de usar 'id_ten' en lugar de 'id_teni'
        'cve_suc', // Asegúrate de usar 'cve_suc' en lugar de 'id_suc'
        'exist_inv'
    ];

    public $timestamps = false; // Deshabilita los timestamps automáticos

    public function tenis()
    {
        return $this->belongsTo(Teni::class, 'id_ten'); // Asegúrate de usar 'id_ten'
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'cve_suc'); // Asegúrate de usar 'cve_suc'
    }
}
