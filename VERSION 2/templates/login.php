<?php
include_once '../util/verificar_cookie.php';
include_once '../includes/head.php';
?>

<body>

    <?php include_once '../includes/header.php'; ?>

    <main class="container pt-5">
        <div class="row justify-content-center form-signin text-center">
            <form class="col-sm-8 col-md-8 col-lg-4" action="../util/login_process.php" method="post">
                <img class="mb-4" src="../assets/img/uta_vertical.png" alt="UNIVERSIDAD DE TARAPACA" width="50%"
                    height="30%">

                <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" name="email"
                        placeholder="name@example.com" value="<?php echo htmlspecialchars($recordar_email); ?>"
                        required>
                    <label for="floatingInput">Correo Electrónico</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="contrasena"
                        placeholder="Password" required>
                    <label for="floatingPassword">Contraseña</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" name="recordar" value="1"> Recordarme
                    </label>
                </div>

                <button class="w-100 btn btn-lg btn-warning" type="submit">Ingresar</button>
            </form>
        </div>
    </main>

    <?php include_once '../includes/foot.php'; ?>

</body>
</html>