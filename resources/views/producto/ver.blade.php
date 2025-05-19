<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Stock de Dina</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Sacramento&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ secure_asset)'css/style.css') }}">
  <link rel="icon" href="{{ secure_asset)'favicon.ico') }}" type="image/x-icon">
</head>
<x-navbar />

<div class="container">
    <h1 class="text-abril text-center mt-4 mb-3 fs-1">Detalle del Producto</h1>
    
    <div class="d-flex justify-content-center align-items-center">
        <div class="color-nav rounded-5 p-5 mb-5 shadow-lg w-100" style="max-width: 900px;">
            <h2 class="text-center text-light text-abril fw-bold fs-1">{{ $producto['Marca'] ?? 'Producto' }}</h2>
            
            <div class="mb-3 fs-2">
                <p><strong class="text-abril">Marca:</strong> {{ $producto['Marca'] ?? '-' }}</p>
                <p><strong class="text-abril">Artículo:</strong> {{ $producto['Articulo'] ?? '-' }}</p>
                <p><strong class="text-abril">Color:</strong> {{ $producto['Color'] ?? '-' }}</p>
                <p><strong class="text-abril">Tipo:</strong> {{ $producto['Tipo'] ?? '-' }}</p>
                <p><strong class="text-abril">Precio:</strong> ${{ $producto['Precio'] ?? '-' }}</p>
                <p><strong class="text-abril">Descripción:</strong> {{ $producto['Descripcion'] ?? '-' }}</p>
                <p><strong class="text-abril">Fecha de creación:</strong>
                    {{ isset($producto['created_at']) ? \Carbon\Carbon::parse($producto['created_at'])->format('d/m/Y H:i') : '-' }}
                </p>
            </div>

            <hr class="border-light">

            <h3 class="text-center text-abril fs-2 mb-4">Stock por Talle</h3>
            <div class="row row-cols-2 row-cols-md-4 g-3 text-center">
                @foreach(range(34, 42) as $talle)
                    <div class="col">
                        <div class="bg-light rounded-5 p-3 h-100 shadow-sm">
                            <p class="text-abril fw-bold mb-1">Talle {{ $talle }}</p>
                            <p class="mb-0">{{ !empty($producto[(string)$talle]) ? $producto[(string)$talle] : 'Sin stock' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-light rounded-5 text-abril">Volver al listado</a>
            </div>
        </div>
    </div>
</div>

<x-footer />
</html>