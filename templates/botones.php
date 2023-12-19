<?php
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once '../util/verificar_sesion.php';
include_once '../util/cierre_sesion.php';
?>

<body class="align-items-stretch">
    <main class="flex-grow-1 text-center p-5">
        <h1 class="h3 mb-3 fw-normal">Botones</h1>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php include_once '../util/listar_botones.php'; ?>
        </div>

        <!-- Formulario para cerrar sesión -->
        <form method="post" action="">
            <div class="text-center mt-4 pt-5">
                <button class="btn btn-danger btn-uta-orng" type="submit" name="cerrar_sesion">Salir</button>
            </div>
        </form>
    </main>
    <?php include_once '../includes/footer.php'; ?>
</body>

</html>
