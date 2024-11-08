<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Tenis</title>
</head>
<body class="container my-5">

<h1>Editar Tenis</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tenis.update', $teni->id_ten) }}" method="POST" class="mt-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
            <label class="form-label">Modelo:</label>
            <select name="id_model" class="form-control" required>
            <option value="">Selecciona un Modelo</option>
            @foreach($modelos as $modelo)
            <option value="{{ $modelo->id_model }}" {{ old('id_model') == $modelo->id ? 'selected' : '' }}>
                {{ $modelo->nom_model }}
            </option>
            @endforeach
            </select>
        </div>

    <div class="mb-3">
        <label class="form-label">Talla:</label>
        <input type="number" name="num_talla" class="form-control" value="{{ old('num_talla', $teni->num_talla) }}" required>
    </div>

    <div class="mb-3">
            <label class="form-label">Categoría:</label>
            <select name="categ_ten" class="form-control" required>
            <option value="id_categ">Selecciona una categoría</option>
            @foreach($categorias as $categoria)
            <option value="{{ $categoria->nom_categ }}" {{ old('nom_categ') == $categoria->nombre ? 'selected' : '' }}>
                {{ $categoria->nom_categ }}
            </option>
            @endforeach
            </select>
        </div>

    <div class="mb-3">
        <label class="form-label">Color:</label>
        <input type="text" name="color_ten" class="form-control" maxlength="15" value="{{ old('color_ten', $teni->color_ten) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Precio:</label>
        <input type="number" step="0.01" name="prec_ten" class="form-control" value="{{ old('prec_ten', $teni->prec_ten) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Costo:</label>
        <input type="number" step="0.01" name="costo_ten" class="form-control" value="{{ old('costo_ten', $teni->costo_ten) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Imagen (URL):</label>
        <input type="text" name="img_ten" class="form-control" maxlength="20" value="{{ old('img_ten', $teni->img_ten) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Cantidad:</label>
        <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad', $teni->cantidad) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Tenis</button>
</form>
<br>
<a href="{{ route('tenis.index') }}" class="btn btn-secondary">Volver a la lista</a>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
