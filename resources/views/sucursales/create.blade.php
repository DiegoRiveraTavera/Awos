<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Crear Nueva Sucursal</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
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

    <div class="mb-3">
        <label for="direccion" class="form-label">Buscar Dirección:</label>
        <input type="text" id="direccion" class="form-control" placeholder="Ingresa una dirección">
        <button type="button" id="buscar" class="btn btn-primary mt-2">Buscar</button>
        <ul id="resultados" class="list-group mt-2"></ul>
    </div>

    <div id="map"></div>
    
    <form id="form-sucursal" action="{{ route('sucursales.store') }}" method="POST">
        @csrf

        <!-- Campo oculto para Ciudad -->
        <input type="hidden" name="cve_ciu" value="67">

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nom_suc" class="form-control" value="{{ old('nom_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Colonia:</label>
            <input type="text" name="col_suc" class="form-control" maxlength="20" value="{{ old('col_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Calle:</label>
            <input type="text" name="calle_suc" class="form-control" maxlength="20" value="{{ old('calle_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Núm. Ext.:</label>
            <input type="number" name="ne_suc" class="form-control" value="{{ old('ne_suc') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Núm. Int.:</label>
            <input type="number" name="ni_suc" class="form-control" value="{{ old('ni_suc') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Cp:</label>
            <input type="number" name="cp_suc" class="form-control" value="{{ old('cp_suc') }}" required>
        </div>

        <button type="submit" class="btn btn-primary" id="boton">Crear Sucursal</button>
    </form>
    <br>
    <a href="{{ route('sucursales.index') }}" class="btn btn-secondary">Volver a la lista</a>

</div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.getElementById('form-sucursal').addEventListener('submit', function() {
        document.getElementById('boton').disabled = true;
    });

    var map = L.map('map').setView([20.659698, -103.349609], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    var marker;
    map.on('click', function(e) {
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${e.latlng.lat}&lon=${e.latlng.lng}`)
            .then(response => response.json())
            .then(data => {
                if (data.address) {
                    document.getElementsByName('col_suc')[0].value = data.address.suburb || data.address.neighbourhood || '';
                    document.getElementsByName('calle_suc')[0].value = data.address.road || '';
                    document.getElementsByName('ne_suc')[0].value = data.address.house_number || '';
                    document.getElementsByName('cp_suc')[0].value = data.address.postcode || '';
                }
            });
    });

    document.getElementById('buscar').addEventListener('click', function() {
        var direccion = document.getElementById('direccion').value;
        if (direccion) {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${direccion}`)
                .then(response => response.json())
                .then(data => {
                    var resultados = document.getElementById('resultados');
                    resultados.innerHTML = ''; // Limpiar resultados anteriores

                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            var li = document.createElement('li');
                            li.classList.add('list-group-item');
                            li.textContent = item.display_name;
                            li.setAttribute('data-lat', item.lat);
                            li.setAttribute('data-lon', item.lon);
                            li.addEventListener('click', function() {
                                var lat = li.getAttribute('data-lat');
                                var lon = li.getAttribute('data-lon');
                                map.setView([lat, lon], 15);
                                if (marker) {
                                    marker.setLatLng([lat, lon]);
                                } else {
                                    marker = L.marker([lat, lon]).addTo(map);
                                }
                                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.address) {
                                            document.getElementsByName('col_suc')[0].value = data.address.suburb || data.address.neighbourhood || '';
                                            document.getElementsByName('calle_suc')[0].value = data.address.road || '';
                                            document.getElementsByName('ne_suc')[0].value = data.address.house_number || '';
                                            document.getElementsByName('cp_suc')[0].value = data.address.postcode || '';
                                        }
                                    });
                                // Ocultar los resultados después de seleccionar una opción
                                resultados.innerHTML = '';
                            });
                            resultados.appendChild(li);
                        });
                    } else {
                        var li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.textContent = 'No se encontraron resultados para la dirección ingresada.';
                        resultados.appendChild(li);
                    }
                });
        }
    });
</script>
</body>
</html>
