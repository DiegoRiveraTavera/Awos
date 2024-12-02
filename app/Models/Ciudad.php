<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudad';
    protected $primaryKey = 'cve_ciu';
    protected $fillable = [
        'cve_est', 'nom_ciu'
    ];
    public $timestamps = false;

    public function sucursales() { 
        return $this->hasMany(Sucursales::class, 'cve_ciu', 'cve_ciu'); 
    }
}
