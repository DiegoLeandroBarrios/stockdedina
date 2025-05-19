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
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>
<body class="imagenLogin">
  <div class="container-fluid p-4 color-nav rounded-5 shadow-lg position-absolute top-50 start-50 translate-middle" style="max-width: 300px;">
    <h2 class="mb-2 text-center text-light text-abril">Recuperar contraseña</h2>

    @if($errors->has('reset_error'))
      <div class="alert alert-danger text-center rounded-5">{{ $errors->first('reset_error') }}</div>
    @endif
    @if(session('success'))
      <div class="alert alert-success text-center rounded-5">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label text-abril fw-bold mt-3">Correo electrónico:</label>
        <input type="email" name="email" id="email" class="form-control rounded-5" required autofocus>
      </div>
      <div class="text-center mt-2">
        <button class="btn btn-outline-light color-text fw-bold rounded-5 w-100">Enviar enlace de recuperación</button>
      </div>
    </form>

    <div class="mt-3 text-center">
      <a href="{{ route('login') }}" class="text-decoration-none text-light">Volver al inicio de sesión</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>