<?php
// Verificar si la vista actual no es login.php
$currentView = basename($_SERVER['PHP_SELF']); // Obtiene el nombre del archivo actual
?>

<header class="navbar sticky-top flex-md-nowrap shadow">

    <div class="ms-2 d-block d-md-none">
        <img src="../assets/img/uta_horizontal.png" alt="UTA" style="max-width: 100%; max-height: 50px;">
    </div>

    <div class="barra d-md-block collapse">
        <img src="../assets/img/uta_vertical.png" alt="UTA" style="max-width: 100%; max-height: 50px;">
        Sistema de Admisión - Inteligencia de Negocios
    </div>

    <div class="d-flex align-items-center">
        <!-- Formulario para cerrar sesión -->
        <?php
        // Verificar si la vista actual no es login.php
        if ($currentView !== 'login.php') {
            echo '<form class="me-2" method="post" action="">
                    <button class="btn btn-danger" type="submit" name="cerrar_sesion">Salir</button>
                </form>';
        }
        ?>

        <?php
        // Verificar si la vista actual no es login.php
        if ($currentView !== 'login.php') {
            echo '<button class="me-2 navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>';
        }
        ?>
    </div>

    <?php include_once 'footer.php'; ?>

</header>