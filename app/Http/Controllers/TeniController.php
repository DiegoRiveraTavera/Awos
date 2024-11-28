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
        $tenis = Teni::with('modelo')->get(); 
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

    // app/Http/Controllers/TeniController.php
    public function store(Request $request)
    {
        $request->validate([
            'id_model' => 'required',
            'num_talla' => 'required|integer',
            'categ_ten' => 'required|string',
            'color_ten' => 'required|string|max:15',
            'prec_ten' => 'required|numeric',
            'costo_ten' => 'required|numeric',
            'img_ten' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validación de imagen
            'cantidad' => 'required|integer',
        ]);

        // Subir la imagen
        if ($request->hasFile('img_ten')) {
            $image = $request->file('img_ten');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imagenes/productos');
            $image->move($destinationPath, $name);
            $img_ten = 'imagenes/productos/' . $name;
        } else {
            $img_ten = null;
        }

        // Crear un nuevo registro de tenis
        Teni::create([
            'id_model' => $request->input('id_model'),
            'num_talla' => $request->input('num_talla'),
            'categ_ten' => $request->input('categ_ten'),
            'color_ten' => $request->input('color_ten'),
            'prec_ten' => $request->input('prec_ten'),
            'costo_ten' => $request->input('costo_ten'),
            'img_ten' => $img_ten,
            'cantidad' => $request->input('cantidad'),
        ]);

        return redirect()->route('tenis.index')->with('success', 'Tenis creado con éxito.');
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

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_model' => 'nullable|integer',
            'num_talla' => 'nullable|integer',
            'categ_ten' => 'nullable|string|max:15',
            'color_ten' => 'nullable|string|max:15',
            'prec_ten' => 'nullable|numeric',
            'costo_ten' => 'nullable|numeric',
            'img_ten' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validación de imagen
            'cantidad' => 'nullable|integer',
        ]);

        $teni = Teni::find($id);

        // Subir la imagen si se proporciona
        if ($request->hasFile('img_ten')) {
            $image = $request->file('img_ten');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imagenes/productos');
            $image->move($destinationPath, $name);
            $img_ten = 'imagenes/productos/' . $name;

            // Elimina la imagen anterior si existe
            if ($teni->img_ten && file_exists(public_path($teni->img_ten))) {
                unlink(public_path($teni->img_ten));
            }

            $teni->img_ten = $img_ten;
        }

        // Actualizar el registro de tenis
        $teni->id_model = $request->input('id_model');
        $teni->num_talla = $request->input('num_talla');
        $teni->categ_ten = $request->input('categ_ten');
        $teni->color_ten = $request->input('color_ten');
        $teni->prec_ten = $request->input('prec_ten');
        $teni->costo_ten = $request->input('costo_ten');
        $teni->cantidad = $request->input('cantidad');
        $teni->save();

        return redirect()->route('tenis.index')->with('success', 'Tenis actualizado con éxito.');
    }



    public function destroy(Teni $teni)
    {
        $teni->delete();
        return redirect()->route('tenis.index')->with('success', 'Teni eliminado con éxito.');
    }
}
