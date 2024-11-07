<?php

// app/Http/Controllers/TeniController.php
namespace App\Http\Controllers;

use App\Models\Sucursales;
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
        return view('sucursales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cve_ciu' => 'nullable|integer',
            'nom_suc' => 'nullable|string|max:20',
            'col_suc' => 'nullable|string|max:20',
            'calle_suc' => 'nullable|string|max:20',
            'ne_suc' => 'nullable|integer',
            'ni_suc' => 'nullable|integer',
            'cp_suc' => 'nullable|integer',
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
        return view('sucursales.edit', compact('sucursales'));
    }
    

    public function update(Request $request, $cve_suc)
    {
        // Validar los datos
        $request->validate([
            'cve_ciu' => 'nullable|integer',
            'nom_suc' => 'nullable|string|max:20',
            'col_suc' => 'nullable|string|max:20',
            'calle_suc' => 'nullable|string|max:20',
            'ne_suc' => 'nullable|integer',
            'ni_suc' => 'nullable|integer',
            'cp_suc' => 'nullable|integer',
        ]);
    
        // Buscar y actualizar la sucursal
        $sucursales = Sucursales::findOrFail($cve_suc);
        $sucursales->update($request->all());
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada con éxito.');
    }

    public function destroy($cve_suc)
{
    $sucursales = Sucursales::findOrFail($cve_suc);
    $sucursales->delete();
    return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada con éxito.');
}


}