
<x-header/>
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">Registrarse</h3>

    @if($errors->has('register_error'))
        <div class="alert alert-danger">{{ $errors->first('register_error') }}</div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">Registrarse</button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}">¿Ya tenés cuenta? Iniciá sesión</a>
    </div>
</div>
