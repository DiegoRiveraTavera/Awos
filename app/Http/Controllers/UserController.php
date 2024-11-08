<?php

// app/Http/Controllers/TeniController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Modelo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /*public function create()
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
    }*/

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'tipo' => 'nullable|string|max:15',
        ]);

        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /*public function destroy(Teni $teni)
    {
        $teni->delete();
        return redirect()->route('tenis.index')->with('success', 'Teni eliminado con éxito.');
    }*/
}