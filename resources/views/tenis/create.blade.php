<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Crear Nuevo Teni</title>
</head>
<body>

<div class="container my-5">
    <h1>Crear Nuevo Tenis</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="create-tenis-form" action="{{ route('tenis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Modelo:</label>
            <select name="id_model" class="form-control" required>
                <option value="">Selecciona un Modelo</option>
                @foreach($modelos as $modelo)
                    <option value="{{ $modelo->id_model }}" {{ old('id_model') == $modelo->id_model ? 'selected' : '' }}>
                        {{ $modelo->nom_model }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Talla:</label>
            <input type="number" name="num_talla" class="form-control" value="{{ old('num_talla') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría:</label>
            <select name="categ_ten" class="form-control" required>
                <option value="id_categ">Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->nom_categ }}" {{ old('nom_categ') == $categoria->nom_categ ? 'selected' : '' }}>
                        {{ $categoria->nom_categ }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Color:</label>
            <input type="text" name="color_ten" class="form-control" maxlength="15" value="{{ old('color_ten') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio:</label>
            <input type="number" step="0.01" name="prec_ten" class="form-control" value="{{ old('prec_ten') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Costo:</label>
            <input type="number" step="0.01" name="costo_ten" class="form-control" value="{{ old('costo_ten') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen:</label>
            <input type="file" name="img_ten" class="form-control" accept="image/*" value="{{ old('img_ten') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Cantidad:</label>
            <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad', 0) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sucursal:</label>
            <select name="cve_suc" class="form-control" required>
                <option value="">Selecciona una Sucursal</option>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->cve_suc }}" {{ old('cve_suc') == $sucursal->cve_suc ? 'selected' : '' }}>
                        {{ $sucursal->nom_suc }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary" id="submit-button">Crear Tenis</button>
    </form>
    <br>
    <a href="{{ route('tenis.index') }}" class="btn btn-secondary">Volver a la lista</a>

</div>

<script>
    document.getElementById('create-tenis-form').addEventListener('submit', function() {
        document.getElementById('submit-button').disabled = true;
    });
</script>

</body>
</html>
