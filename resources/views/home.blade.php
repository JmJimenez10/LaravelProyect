<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"><!-- Token CSRF para protección contra ataques de falsificación de solicitudes entre sitios -->
    <title>To-Do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body data-bs-theme="dark">

    <div class="container">

        <nav class="row fixed-top w-75 mx-auto bg-dark">
            <div class="d-flex justify-content-between">
                <div>
                    <!-- Botón para cambiar el tema -->
                    <button class="icon bg-purple btn rounded-bottom" onclick="changeTheme()"><i id="dl-icon" class="fa-solid fa-sun"></i></button>
                    <!-- Botón para cerrar sesión -->
                    <a href="{{route('logout')}}" class="icon bg-purple btn rounded-bottom" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="i-special bx bx-log-out"></i></a>
                    <!-- Formulario para enviar la solicitud de cierre de sesión -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <h1 class="text-center"><span class="fw-bold">TO-DO</span> App</h1>
                <div>
                    <a href="" class="icon bg-purple btn rounded-bottom invisible"><i class="fa-solid fa-user"></i></a>
                    <!-- Botón para abrir el modal de creación de nueva nota -->
                    <button class="icon bg-purple btn rounded-bottom" data-bs-toggle="modal" data-bs-target="#newNote"><i class="fa-solid fa-pen-to-square"></i></button>    
                </div>
            </div>
            <hr>
        </nav>

        <div>
            <!-- Contenido generado por las vistas -->
            @yield('content')
        </div>
    </div>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
