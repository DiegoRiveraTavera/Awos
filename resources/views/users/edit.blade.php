<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Usuario</title>
</head>
<body class="container my-5">

<h1>Editar Usuario</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST" class="mt-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nombre: "{{ old('name', $user->name) }}"</label>
    </div>

    <div class="mb-3">
        <label class="form-label">Email: "{{ old('email', $user->email) }}" </label>
    </div>

    <div class="mb-3">
        <label class="form-label">Contraseña: "{{ old('password', $user->password) }}" </label>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipo:</label>
        <select name="tipo" class="form-control" required>
            <option value="">{{ old('tipo', $user->tipo) }}</option>
            <option value="cliente">cliente</option>
            <option value="administrador">administrador</option>
        </select>
        <!--<input type="text" name="tipo" class="form-control" value="{{ old('tipo', $user->tipo) }}" required>-->
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
</form>
<br>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Volver a la lista</a>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
