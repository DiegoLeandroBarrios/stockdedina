
<x-header/>
<body class="imagenLogin">
<div class="container-fluid p-4 color-nav rounded-5 shadow-lg position-absolute top-50 start-50 translate-middle" style="max-width: 300px;">
    <h2 class="mb-2 text-center text-light text-abril">Iniciar sesión</h2>

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label text-abril fw-bold mt-3">Correo electrónico:</label>
            <input type="email" name="email" id="email" class="form-control rounded-5" required autofocus>

            <label for="password" class="form-label text-abril fw-bold mt-3">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control rounded-5" required>
        </div>
    
        @if($errors->has('login_error'))
        <div class="alert alert-danger text-center rounded-5">{{ $errors->first('login_error') }}</div>
        @endif
        <div class="text-center mt-2">
        <button class="btn btn-outline-light color-text fw-bold rounded-5 w-100">Ingresar</button>
        </div>
    </form>
    <div class="mb-2 text-center">
        <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
    </div>
</div>
</body>

