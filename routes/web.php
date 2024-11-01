<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Mostrar el formulario de inicio de sesión (GET)
Route::get('/login', function() {
    return view('login');
})->name('login');

// Manejar la autenticación del usuario (POST)
Route::post('/login', function() {
    // Obtener las credenciales del formulario
    $credentials = request()->only('usuario', 'contraseña');

    // Intentar autenticar al usuario
    if (Auth::attempt(['name' => $credentials['usuario'], 'password' => $credentials['contraseña'], 'tipo' => 'cliente'])) {
        // Si las credenciales son correctas, redirigir al dashboard u otra página
        return redirect('index');
    }elseif (Auth::attempt(['name' => $credentials['usuario'], 'password' => $credentials['contraseña'], 'tipo' => 'administrador'])) {
        return redirect('indexAdmin');
    }

    // Si la autenticación falla, redirigir al formulario de registro
    return redirect('registrarse');
});

// Ruta para mostrar el formulario de registro (GET)
Route::get('/registrarse', function() {
    return view('registrarse');
})->name('registrarse');

Route::post('/registrarse', [AuthController::class, 'register'])->name('registrarse');

Route::view('/index', 'index')->name('index');

Route::view('/indexAdmin', 'indexAdmin')->name('indexAdmin');

Route::view('/productos', 'productos')->name('productos');

Route::view('/sucursales', 'sucursales')->name('sucursales');

Route::view('/categorias', 'categorias')->name('categorias');