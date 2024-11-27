<?php

// app/Http/Controllers/TeniController.php
namespace App\Http\Controllers;

use App\Models\Teni;
use App\Models\Categoria;
use App\Models\Modelo;
use Illuminate\Http\Request;

class TeniController extends Controller
{
    public function index()
    {
        $tenis = Teni::all();
        return view('tenis.index', compact('tenis'));
    }

    public function catalogo() 
    { 
        $tenis = Teni::all(); 
        return view('catalogo', compact('tenis')); // Vista para el catálogo de clientes 
    } 

    public function create()
{
    // Obtener todos los modelos y categorías
    $modelos = Modelo::all();
    $categorias = Categoria::all();

    // Pasar las variables a la vista
    return view('tenis.create', compact('modelos', 'categorias'));
}

    public function store(Request $request)
    {
        $request->validate([
            'id_model' => 'nullable|integer',
            'num_talla' => 'nullable|integer',
            'categ_ten' => 'nullable|string|max:15',
            'color_ten' => 'nullable|string|max:15',
            'prec_ten' => 'nullable|numeric',
            'costo_ten' => 'nullable|numeric',
            'img_ten' => 'nullable|string|max:20',
            'cantidad' => 'nullable|integer',
        ]);

        Teni::create($request->all());
        return redirect()->route('tenis.index')->with('success', 'Teni creado con éxito.');
    }

    public function show(Teni $teni)
    {
        return view('tenis.show', compact('teni'));
    }

    public function edit(Teni $teni)
    {
        $modelos = Modelo::all();
        $categorias = Categoria::all();

        return view('tenis.edit', compact('teni', 'modelos', 'categorias'));
    }

    public function update(Request $request, Teni $teni)
    {
        $request->validate([
            'id_model' => 'nullable|integer',
            'num_talla' => 'nullable|integer',
            'categ_ten' => 'nullable|string|max:15',
            'color_ten' => 'nullable|string|max:15',
            'prec_ten' => 'nullable|numeric',
            'costo_ten' => 'nullable|numeric',
            'img_ten' => 'nullable|string|max:20',
            'cantidad' => 'nullable|integer',
        ]);

        $teni->update($request->all());
        return redirect()->route('tenis.index')->with('success', 'Teni actualizado con éxito.');
    }

    public function destroy(Teni $teni)
    {
        $teni->delete();
        return redirect()->route('tenis.index')->with('success', 'Teni eliminado con éxito.');
    }
}
