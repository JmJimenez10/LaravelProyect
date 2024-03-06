<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body id="body" data-bs-theme="dark" class="vh-100">
    <div class="container">

        <div class="theme mb-5 pb-5">
            <button class="bg-purple btn rounded-bottom" onclick="changeTheme()"><i id="dl-icon"
                    class="fa-solid fa-sun"></i></button>
        </div>

        <div class="row my-5 pt-5">
            <h1 class="text-center display-1"><span class="fw-bold">To-Do</span> App</h1>
            <h2 class="text-center">Inicio de sesión</h2>
        </div>

        <div class="row">
            <form action="{{ route('login') }}" method="post"
                class="bg-dark col-4 mx-auto bottom-0 border border-1 p-5 rounded rounded-2">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email"
                        class="form-control py-2 fs-5 @error('email') is-invalid @enderror" placeholder="Correo"
                        autocomplete="off">
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password"
                        class="form-control py-2 fs-5 @error('password') is-invalid @enderror" placeholder="Contraseña"
                        autocomplete="off">
                    <span class="input-group-text"><i class='bx bx-show'></i></span>
                </div>
                <input class="btn btn-purple" type="submit" name="login" value="Entrar">

                <div class="text-center">
                    <p>¿No tienes cuenta?</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Registrarse</a>
                </div>
            </form>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
