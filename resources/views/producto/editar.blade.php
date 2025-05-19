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
    <h1 class="text-abril text-center mt-4 mb-3 fs-1">Editar producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger rounded-5 fw-bold">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center">
        <div class="color-nav rounded-5 p-5 form-edit mb-5 shadow-lg">
            <form action="{{ route('producto.actualizar', $id) }}" method="POST">
                @csrf
                <h2 class="text-center text-light text-abril fw-bold fs-1">{{ $producto['Marca'] ?? 'Producto' }}</h2>

                <div class="mb-3 fs-2">
                    <label class="form-label text-abril fw-bold mt-2">Marca</label>
                    <input type="text" name="marca" class="form-control rounded-5" value="{{ $producto['Marca'] ?? '' }}">

                    <label class="form-label text-abril fw-bold mt-2">Artículo</label>
                    <input type="number" name="articulo" class="form-control rounded-5" value="{{ $producto['Articulo'] ?? '' }}">

                    <label class="form-label text-abril fw-bold mt-2">Color</label>
                    <input type="text" name="color" class="form-control rounded-5" value="{{ $producto['Color'] ?? '' }}">

                    <label class="form-label text-abril fw-bold mt-2">Tipo</label>
                    <select name="tipo" class="form-control rounded-5">
                        <option value="">Seleccione tipo</option>
                        <option value="Mujer" {{ ($producto['Tipo'] ?? '') === 'Mujer' ? 'selected' : '' }}>Mujer</option>
                        <option value="Hombre" {{ ($producto['Tipo'] ?? '') === 'Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Unisex" {{ ($producto['Tipo'] ?? '') === 'Unisex' ? 'selected' : '' }}>Unisex</option>
                    </select>

                    <label class="form-label text-abril fw-bold mt-2">Precio</label>
                    <input type="text" name="precio" class="form-control rounded-5" value="{{ $producto['Precio'] ?? '' }}">

                    <label class="form-label text-abril fw-bold mt-2">Descripción</label>
                    <input type="text" name="descripcion" class="form-control rounded-5" value="{{ $producto['Descripcion'] ?? '' }}">
                </div>

                <div class="mb-4 fs-2">
                    <label class="form-label text-abril fw-bold mt-2">Talles (Stock):</label>
                    <div class="row">
                        @for ($i = 34; $i <= 42; $i++)
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-abril fw-bold">{{ $i }}</label>
                                <input type="number" step="1" name="numero{{ $i - 33 }}" class="form-control rounded-5" value="{{ $producto[strval($i)] ?? 0 }}">
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-outline-light color-text fw-bold rounded-5 text-abril">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<x-footer />
</html>
