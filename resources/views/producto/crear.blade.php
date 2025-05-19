<!DOCTYPE html>
<html>
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
<x-navbar/>
<body>
<div class="container">
    <h1 class="mt-4 text-abril text-center fw-bold">Crear producto</h1>
    <div class="d-flex justify-content-center aling-items-center">
        <div class="color-nav rounded-5 p-5 form-edit mb-5 shadow-lg">
            <h2 class="text-center text-light text-abril fw-bold">Rellenar</h2>

            {{-- Alerta general si hay errores --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-5">
                    <strong>¡Atención!</strong> Por favor corregí los errores marcados en el formulario.
                </div>
            @endif

            <form id="productoForm" method="POST" action="{{ route('producto.guardar') }}">
                @csrf
                <div class="mb-3 fs-2">
                    <label class="form-label text-abril fw-bold mt-2">Marca:</label>
                    <input type="text" name="marca" class="form-control rounded-5" value="{{ old('marca') }}">
                    @error('marca') <p class="error"><small class="text-danger">{{ $message }}</small></p> @enderror

                    <label class="form-label text-abril fw-bold mt-2">Artículo:</label>
                    <input type="number" step="0.01" name="articulo" class="form-control rounded-5" value="{{ old('articulo') }}">
                    @error('articulo') <p class="error"><small class="text-danger">{{ $message }}</small></p>@enderror

                    <label class="form-label text-abril fw-bold mt-2">Color:</label>
                    <input type="text" name="color" class="form-control rounded-5" value="{{ old('color') }}">
                    @error('color') <p class="error"><small class="text-danger">{{ $message }}</small></p> @enderror

                    <label class="form-label text-abril fw-bold mt-2">Tipo:</label>
                    <select name="tipo" class="form-control rounded-5">
                        <option value="">Seleccionar tipo</option>
                        <option value="Mujer" {{ old('tipo') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                        <option value="Hombre" {{ old('tipo') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Unisex" {{ old('tipo') == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                    </select>
                    @error('tipo')<p class="error"><small class="text-danger">{{ $message }}</small></p>@enderror

                    <label class="form-label text-abril fw-bold mt-2">Precio:</label>
                    <input type="number" name="precio" class="form-control rounded-5" value="{{ old('precio') }}">
                    @error('precio') <p class="error"><small class="text-danger">{{ $message }}</small></p> @enderror

                    <label class="form-label text-abril fw-bold mt-2">Descripción:</label>
                    <input type="text" name="descripcion" class="form-control rounded-5" value="{{ old('descripcion') }}">
                    @error('descripcion') <p class="error"><small class="text-danger">{{ $message }}</small></p> @enderror
                </div>

                <div class="mb-3 fs-2">
                    <label class="form-label text-abril fw-bold mt-3">Talles:</label>
                    <div class="row">
                        @for ($i = 34; $i <= 42; $i++)
                            <div class="col-md-4">
                                <label class="form-label text-abril fw-bold mt-2">{{ $i }}:</label>
                                <input type="number" step="0.01" name="numero{{ $i - 33 }}" class="form-control rounded-5" value="{{ old('numero' . ($i - 33)) }}">
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-outline-light color-text fw-bold rounded-5" id="btnGuardar" type="submit">Guardar</button>
                </div>

                @if(session('success'))
                    <p style="color: green">{{ session('success') }}</p>
                @endif
            </form>
        </div>
    </div>
</div>

<x-footer />
</body>
</html>
