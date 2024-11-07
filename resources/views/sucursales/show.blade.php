<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Detalles de la Sucursal</title>
</head>
<body class="container my-5">

    <h1 class="mb-4">Detalles de la Sucursal</h1>

    <div class="card p-4 shadow-sm">
        <div class="mb-3">
            <p class="mb-1"><strong>ID:</strong></p>
            <p>{{ $teni->id_ten }}</p>
        </div>
        <div class="mb-3">
            <p class="mb-1"><strong>Modelo:</strong></p>
            <p>{{ $teni->id_model }}</p>
        </div>
        <div class="mb-3">
            <p class="mb-1"><strong>Talla:</strong></p>
            <p>{{ $teni->num_talla }}</p>
        </div>
        <div class="mb-3">
            <p class="mb-1"><strong>Categoría:</strong></p>
            <p>{{ $teni->categ_ten }}</p>
        </div>
        <div class="mb-3">
            <p class="mb-1"><strong>Color:</strong></p>
            <p>{{ $teni->color_ten }}</p>
        </div>
        <div class="mb-3">
            <p class="mb-1"><strong>Precio:</strong></p>
            <p>${{ $teni->prec_ten }}</p>
        </div>
        <div class="mb-3">
            <p class="mb-1"><strong>Costo:</strong></p>
            <p>${{ $teni->costo_ten }}</p>
        </div>
        <div class="mb-3">
            <p class="mb-1"><strong>Imagen:</strong></p>
            <img src="{{ $teni->img_ten }}" alt="Imagen del Teni" class="img-fluid" width="150">
        </div>
        <div class="mb-3">
            <p class="mb-1"><strong>Cantidad:</strong></p>
            <p>{{ $teni->cantidad }}</p>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('tenis.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('tenis.edit', $teni->id_ten) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('tenis.destroy', $teni->id_ten) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>