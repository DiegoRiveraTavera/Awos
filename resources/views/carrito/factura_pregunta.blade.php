<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pregunta de Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="container mt-5">
    <div class="card">
        <div class="card-body text-center">
            <h1 class="card-title">¿Deseas generar una factura?</h1>
            <div class="mt-4">
                <a href="{{ route('carrito.factura') }}" class="btn btn-primary mx-2">Sí, generar factura</a>
                <a href="{{ route('catalogo') }}" class="btn btn-secondary mx-2">No, volver al catálogo</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

