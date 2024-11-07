<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Crear Nueva Sucursal</title>
</head>
<body>

<div class="container my-5">
    <h1>Crear Nueva Sucursal</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sucursales.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Ciudad:</label>
            <input type="number" name="cve_ciu" class="form-control" value="{{ old('cve_ciu') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nom_suc" class="form-control" value="{{ old('nom_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Colonia:</label>
            <input type="text" name="col_suc" class="form-control" maxlength="15" value="{{ old('col_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Calle:</label>
            <input type="text" name="calle_suc" class="form-control" maxlength="15" value="{{ old('calle_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Núm. Ext.:</label>
            <input type="number" name="ne_suc" class="form-control" value="{{ old('ne_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Núm. Int.:</label>
            <input type="number" name="ni_suc" class="form-control" value="{{ old('ni_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cp:</label>
            <input type="number" name="cp_suc" class="form-control" value="{{ old('cp_suc') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Sucursal</button>
    </form>
    <br>
    <a href="{{ route('sucursales.index') }}" class="btn btn-secondary">Volver a la lista</a>

</div>
</body>
</html>