<header class="navbar sticky-top flex-md-nowrap shadow">

    <div class="ps-2 d-block d-md-none">
        <img src="../assets/img/uta_vertical.png" alt="UTA" style="max-width: 100%; max-height: 50px;">
    </div>

    <!-- Boton de Regresar -->
    <?php
    // Verificar si la vista actual no es login.php
    $currentView = basename($_SERVER['PHP_SELF']); // Obtiene el nombre del archivo actual
    
    if ($currentView !== 'login.php') {
        echo '<div class="ps-5">
                <a class="btn btn-warning me-0 px-3" type="submit" href="botones.php">Regresar</a>
              </div>';
    }
    ?>

    <div class="barra d-md-block collapse">
        <img src="../assets/img/uta_vertical.png" alt="UTA" style="max-width: 100%; max-height: 50px;">
        Sistema de Admisión - Inteligencia de Negocios
    </div>

    <!-- Formulario para cerrar sesión -->
    <?php
    // Verificar si la vista actual no es login.php
    if ($currentView !== 'login.php') {
        echo '<div>
                <form method="post" action="" class="pe-5">
                    <button class="btn btn-danger" type="submit" name="cerrar_sesion">Salir</button>
                </form>
              </div>';
    }
    ?>

    <?php
    // Verificar si la vista actual no es login.php
    if ($currentView !== 'login.php') {
        echo '<div class="pe-2">
                <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>';
    }
    ?>

    <?php include_once 'footer.php'; ?>

</header>