<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - UPEU</title>
    <style>
        /* Estilos globales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Contenedor principal */
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            text-align: center;
        }

        /* Logo */
        .logo img {
            max-width: 120px;
            margin-bottom: 1rem;
        }

        /* Títulos y textos */
        h1 {
            font-size: 1.75rem;
            color: #0056a0; /* Color institucional */
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem;
            color: #606f7b;
            margin-bottom: 2rem;
        }

        /* Formulario */
        form {
            margin-top: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-group input[type="checkbox"] {
            margin-right: 0.5rem;
        }

        /* Botón */
        .btn-submit {
            background-color: #0056a0;
            color: #ffffff;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #003d7a;
        }

        /* Enlaces */
        .link {
            color: #0056a0;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .link:hover {
            text-decoration: underline;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('../images/logo.png') }}" alt="Logo UPEU">
        </div>

        <h1>Inicio de Sesión</h1>

        @if (session('status'))
            <div class="text-center" style="color: #28a745; margin-bottom: 1rem;">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="form-group text-center">
                <label for="remember_me">
                    <input type="checkbox" id="remember_me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    {{ __('Remember me') }}
                </label>
            </div>

            <button type="submit" class="btn-submit">
                {{ __('Log in') }}
            </button>

            @if (Route::has('password.request'))
                <div class="text-center" style="margin-top: 1rem;">
                    <a class="link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</body>
</html>
