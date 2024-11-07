<?php

// app/Http/Controllers/TeniController.php
namespace App\Http\Controllers;

use App\Models\Teni;
use Illuminate\Http\Request;

class TeniController extends Controller
{
    public function index()
    {
        $tenis = Teni::all();
        return view('tenis.index', compact('tenis'));
    }

    public function create()
    {
        return view('tenis.create');
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
        return view('tenis.edit', compact('teni'));
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
