<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Mostrar el formulario de inicio de sesión (GET)
Route::get('/login', function() {
    return view('login');
})->name('login')->middleware('guest');

// Manejar la autenticación del usuario (POST)
Route::post('/login', function() {
    // Obtener las credenciales del formulario
    $credentials = request()->only('usuario', 'contraseña');

    // Intentar autenticar al usuario
    if (Auth::attempt(['name' => $credentials['usuario'], 'password' => $credentials['contraseña'], 'tipo' => 'cliente'])) {
        return redirect()->route('catalogo');
    } elseif (Auth::attempt(['name' => $credentials['usuario'], 'password' => $credentials['contraseña'], 'tipo' => 'administrador'])) {
        return redirect()->route('indexAdmin');
    }

    // Si la autenticación falla, redirigir al formulario de registro
    return redirect()->route('registrarse');
})->name('login.attempt');

// Ruta para mostrar el formulario de registro (GET)
Route::get('/registrarse', function() {
    return view('registrarse');
})->name('registrarse')->middleware('guest');

Route::post('/registrarse', [AuthController::class, 'register'])->name('registrarse');

// Ruta para cerrar sesión
Route::post('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

use App\Http\Controllers\TeniController;

// Ruta para el catálogo de productos (clientes)
Route::get('/catalogo', [TeniController::class, 'catalogo'])->name('catalogo')->middleware('auth');


// Ruta para el índice de administración (administradores)
Route::view('/indexAdmin', 'indexAdmin')->name('indexAdmin')->middleware('auth');

// Recursos de tenis (CRUD)

Route::resource('tenis', TeniController::class)->middleware('auth');

// Recursos de sucursales (CRUD)
use App\Http\Controllers\SucursalesController;
Route::resource('sucursales', SucursalesController::class)->middleware('auth');

// Recursos de categorías (CRUD)
use App\Http\Controllers\CategoriaController;
Route::resource('categorias', CategoriaController::class)->middleware('auth');

// Recursos de usuarios (CRUD)
use App\Http\Controllers\UserController;
Route::resource('users', UserController::class)->middleware('auth');

use App\Http\Controllers\CarritoController;


// Rutas del carrito
Route::get('/carrito', [CarritoController::class, 'view'])->name('carrito.view');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');

use App\Http\Controllers\ListaDeseosController;

Route::middleware(['auth'])->group(function () {
    Route::post('/lista-deseos/add/{teni_id}', [ListaDeseosController::class, 'add'])->name('lista_deseos.add');
    Route::post('/lista-deseos/remove/{teni_id}', [ListaDeseosController::class, 'remove'])->name('lista_deseos.remove');
    Route::get('/lista-deseos', [ListaDeseosController::class, 'index'])->name('lista_deseos.index');
});

Route::post('/carrito/procesarCompra', [CarritoController::class, 'procesarCompra'])->name('carrito.procesarCompra');

Route::get('/carrito/facturaPregunta', [CarritoController::class, 'facturaPregunta'])->name('carrito.facturaPregunta'); 
// Ruta para mostrar el formulario de factura 
Route::get('/carrito/factura', [CarritoController::class, 'mostrarFormularioFactura'])->name('carrito.factura'); 
// Ruta para generar la factura en PDF 
Route::post('/carrito/generarFactura', [CarritoController::class, 'generarFactura'])->name('carrito.generarFactura');


