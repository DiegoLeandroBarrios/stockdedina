<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Stock de Dina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Sacramento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  </head>
<body>
  <div id="app" class="d-flex flex-column min-vh-100">

    <x-navbar />

    <main class="flex-grow-1 container py-5">

      <form method="GET" action="{{ route('home') }}" class="mb-3">
        <div class="input-group mb-4 p-1 color-nav rounded-5 shadow">
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control rounded-5 shadow-sm text-abril text-center"
            placeholder="Buscar por marca, artículo o tipo..."
            oninput="this.form.submit()"
          >
        </div>
      </form>

      <h1 class="mb-4 text-center text-abril">Listado de Productos</h1>

      @if(session('success'))
        <div class="alert alert-success text-center rounded-5">{{ session('success') }}</div>
      @endif

      <div class="color-nav p-2 rounded-3 shadow-lg overflow-auto">
        <table class="table table-sm color-table rounded-5 align-middle">
          <thead class="rounded-5">
            <tr>
              <th>Marca</th>
              <th>Artículo</th>
              <th class="d-none d-md-table-cell">Color</th>
              <th class="d-none d-md-table-cell">Tipo</th>
              <th>Precio</th>
              <th class="d-none d-md-table-cell">Números</th>
              <th class="d-none d-md-table-cell">Fecha</th>
              <th>Ver</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody class="fw-bold rounded-5" id="productosBody">
            @foreach($productos as $producto)
              @php
                $data = $producto['data'];
                $id = $producto['id'];
              @endphp
              <tr>
                <td>{{ $data['Marca'] ?? '-' }}</td>
                <td>{{ $data['Articulo'] ?? '-' }}</td>
                <td class="d-none d-md-table-cell">{{ $data['Color'] ?? '-' }}</td>
                <td class="d-none d-md-table-cell">{{ $data['Tipo'] ?? '-' }}</td>
                <td>{{ $data['Precio'] ?? '-' }}</td>
                <td class="d-none d-md-table-cell">
                  @foreach(range(34, 42) as $num)
                    @if(isset($data[(string)$num]))
                      <span class="badge color-badge me-1 rounded-3">{{ $num }}: {{ $data[(string)$num] }}</span>
                    @endif
                  @endforeach
                </td>
                <td class="d-none d-md-table-cell">
                    @if(isset($data['updated_at']))
                    <span class="badge color-badge rounded-3">
                      {{ \Carbon\Carbon::parse($data['updated_at'])->format('d/m/Y H:i') }}
                    </span>
                  @elseif(isset($data['created_at']))
                    <span class="badge color-badge rounded-3">
                      {{ \Carbon\Carbon::parse($data['created_at'])->format('d/m/Y H:i') }}
                    </span>
                  @else
                    -
                  @endif
                  
                </td>
                <td>
                  <a href="{{ route('producto.ver', ['id' => $id]) }}" class="btn btn-outline-info rounded-5 text-abril fw-bold">Ver</a>
                </td>
                <td>
                  <a href="{{ route('producto.editar', ['id' => $id]) }}" class="btn btn-outline-light color-text fw-bold rounded-5">Editar</a>
                </td>
                <td>
                  <button class="btn btn-outline-danger fw-bold rounded-5" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $id }}">
                    Eliminar
                  </button>

                  <div class="modal fade" id="deleteModal{{ $id }}" tabindex="-1" aria-labelledby="modalLabel{{ $id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header color-nav">
                          <h5 class="modal-title" id="modalLabel{{ $id }}">Confirmar Eliminación</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                          <h2 class="text-center text-abril">¿Estás seguro que quieres eliminar este producto?</h2>
                          <p class="mt-1 text-center text-abril">Producto: {{ $data['Marca'] }} - A{{ $data['Articulo'] }}</p>
                        </div>
                        <div class="modal-footer">
                          <form method="POST" action="{{ route('producto.eliminar', $id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary rounded-5 text-abril" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger rounded-5 text-abril">Eliminar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-center mt-4">
        {{ $productos->links('vendor.pagination.custom') }}
      </div>

    </main>

    <x-footer />

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
