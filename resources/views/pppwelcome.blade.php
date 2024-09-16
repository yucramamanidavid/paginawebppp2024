<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad Adventista - Prácticas Pre Profesionales</title>
    <style>
        /* Estilos globales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Encabezado */
        header {
            background-color: #0056a0; /* Color institucional */
            color: white;
            padding: 1rem;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            border-bottom: 3px solid #004080; /* Línea de separación */
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffffff;
        }

        nav {
            display: flex;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 1rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #cce5ff;
        }

        /* Contenedor principal */
        .container {
            padding: 6rem 1rem 2rem; /* Ajuste superior para el encabezado fijo */
            text-align: center;
        }

        /* Encabezado principal */
        h1 {
            font-size: 3.5rem;
            font-weight: bold;
            color: #003366; /* Color institucional */
            margin-bottom: 1rem;
        }

        /* Texto descriptivo */
        p {
            font-size: 1.25rem;
            color: #606f7b;
            margin-bottom: 2rem;
        }

        /* Botones */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #fff;
            background-color: #0056a0; /* Color institucional */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #003d7a; /* Color más oscuro para hover */
        }

        .btn.green {
            background-color: #38c172;
        }

        .btn.green:hover {
            background-color: #2d995b;
        }

        /* Imagen y video */
        .media-container {
            margin-top: 2rem;
        }

        .media-container img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .media-container video {
            width: 100%;
            max-width: 700px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }

        /* Footer */
        footer {
            margin-top: 4rem;
            font-size: 0.875rem;
            color: #b0b0b0;
            text-align: center;
            padding: 1rem;
            background-color: #003366; /* Color institucional */
            color: #ffffff;
        }

        /* Estilo responsivo para pantallas pequeñas */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            p {
                font-size: 1.125rem;
            }

            .btn {
                font-size: 0.875rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Encabezado fijo -->
    <header>
        <div class="header-container">
            <div class="logo">Universidad UPEU</div>
            <nav>
                <a href="{{ route('login') }}">Iniciar Sesión</a>
                <a href="{{ route('register') }}">Registrarse</a>
                {{-- <a href="{{ route('student-company') }}">student</a>
             --}}
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="container">
        <!-- Encabezado de bienvenida -->
        <h1>Bienvenidos al Sistema de Prácticas Pre Profesionales</h1>
        <p>Gestiona y sigue tus prácticas de forma eficiente.</p>

        <!-- Botones de acción -->
        <div class="mt-8">
            <a href="{{ route('login') }}" class="btn">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn green ml-4">Registrarse</a>
        </div>

        <!-- Imagen y video explicativo -->
        <div class="media-container">
            <img src="{{ asset('../views/images/logo.png') }}" alt="Prácticas">
            <div class="slider">
                <div>

                        <iframe width="1213" height="550" src="https://www.youtube.com/embed/TyVW3wNjuww" title="UPeU | #UniversidadesQueMejoran" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>

                <!-- Add more images as needed -->
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 Universidad Adventista. Todos los derechos reservados.
    </footer>
</body>
</html>
