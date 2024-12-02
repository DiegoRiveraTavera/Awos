<?php
namespace App\Http\Controllers;

use App\Models\Sucursales;
use App\Models\Ciudad; 
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    public function index()
    {
        $sucursales = Sucursales::all();
        return view('sucursales.index', compact('sucursales'));
    }

    public function create()
    {
        $ciudades = Ciudad::all();
        return view('sucursales.create', compact('ciudades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cve_ciu' => 'required|integer',
            'nom_suc' => 'required|string|max:20',
            'col_suc' => 'required|string|max:20',
            'calle_suc' => 'required|string|max:20',
            'ne_suc' => 'required|integer',
            'ni_suc' => 'nullable|integer',
            'cp_suc' => 'required|integer',
        ]);

        Sucursales::create($request->all());
        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada con éxito.');
    }

    public function show(Sucursales $sucursales)
    {
        return view('sucursales.show', compact('sucursales'));
    }

    public function edit($cve_suc)
    {
        $sucursales = Sucursales::findOrFail($cve_suc);
        $ciudades = Ciudad::all(); // Obtenemos todas las ciudades
        return view('sucursales.edit', compact('sucursales', 'ciudades'));
    }

    public function update(Request $request, $cve_suc)
    {
        $request->validate([
            'cve_ciu' => 'required|integer',
            'nom_suc' => 'required|string|max:20',
            'col_suc' => 'required|string|max:20',
            'calle_suc' => 'required|string|max:20',
            'ne_suc' => 'required|integer',
            'ni_suc' => 'nullable|integer',
            'cp_suc' => 'required|integer',
        ]);
    
        $sucursales = Sucursales::findOrFail($cve_suc);
        $sucursales->update($request->all());
    
        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada con éxito.');
    }

    public function destroy($cve_suc)
    {
        $sucursales = Sucursales::findOrFail($cve_suc);
        $sucursales->delete();
        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada con éxito.');
    }
}
