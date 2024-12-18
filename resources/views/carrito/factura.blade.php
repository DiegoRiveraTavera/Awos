<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Formulario de Factura</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('carrito.generarFactura') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre_completo" class="form-label">Nombre Completo:</label>
            <input type="text" name="nombre_completo" class="form-control @error('nombre_completo') is-invalid @enderror" value="{{ old('nombre_completo') }}" required>
            @error('nombre_completo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" required>
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rfc" class="form-label">RFC:</label>
            <input type="text" name="rfc" class="form-control @error('rfc') is-invalid @enderror" value="{{ old('rfc') }}" required>
            @error('rfc')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
            @error('correo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="domicilio" class="form-label">Domicilio:</label>
            <textarea name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" required>{{ old('domicilio') }}</textarea>
            @error('domicilio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Descargar Factura</button>
        <a href="{{ route('catalogo') }}" class="btn btn-secondary mx-2">Volver al catálogo</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


