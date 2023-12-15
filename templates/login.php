<?php include_once '../includes/head.php'; ?>
<?php include_once '../includes/header.php'; ?>

<body class="align-items-center">
<main class="main-content">
    <form class="form-signin text-center">
        <img class="mb-4" src="../assets/img/uta_vertical.png" alt="UNIVERSIDAD DE TARAPACA" width="80%" height="80%">

        <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Correo Electrónico</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Contraseña</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Recordarme
            </label>
        </div>

        <a class="w-100 btn btn-lg btn-warning btn-uta-orng" type="submit" href="botones.php">Ingresar</a>

    </form>
</main>

<?php include_once '../includes/footer.php'; ?>