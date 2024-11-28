<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Crear Nueva Categoria</title>
</head>
<body>

<div class="container my-5">
    <h1>Crear Nueva Categoria</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="form-categoria" action="{{ route('categorias.store') }}" method="POST">
        @csrf
        

        <div class="mb-3">
            <label class="form-label">Nombre de la Categoría:</label>
            <input type="text" name="nom_categ" class="form-control" maxlength="15" value="{{ old('nom_categ') }}" required>
        </div>

        <button type="submit" class="btn btn-primary" id="boton" >Crear Categoria</button>
    </form>
    <br>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver a la lista</a>

</div>

<script>
    document.getElementById('form-categoria').addEventListener('submit', function() {
        document.getElementById('boton').disabled = true;
    });
</script>

</body>
</html>
