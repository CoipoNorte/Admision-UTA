<?php
include_once '../util/verificar_sesion.php';
include_once '../util/cierre_sesion.php';
include_once '../includes/head.php';
?>

<body>

    <?php include_once '../includes/header.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <?php include_once '../includes/nav.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <!--TITULO-->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Postulantes por Colegio (Región 15)</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            Fecha
                        </button>
                    </div>
                </div>

                <!--TABLA-->
                <h1 class="h2">Tabla</h1>
                <?php
                // Incluir archivo para la conexión a la base de datos
                include_once '../config.php';

                // Consulta SQL
                $query = "SELECT e.RBD AS Colegio_RBD, e.NOMBRE_OFICIAL AS Nombre_Colegio, COUNT(DISTINCT p.numero_documento) AS total
                            FROM Postulaciones p
                            JOIN Establecimiento e ON p.RBD = e.RBD
                            WHERE e.CODIGO_REGION = 15
                            GROUP BY e.RBD, e.NOMBRE_OFICIAL
                            ORDER BY total DESC";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '<div class="table-responsive pb-5">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Colegio RBD</th>
                                <th>Nombre del Colegio</th>
                                <th>Total de Postulantes</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($data as $row) {
                    echo '<tr>
                            <td>' . $row['colegio_rbd'] . '</td>
                            <td>' . $row['nombre_colegio'] . '</td>
                            <td>' . $row['total'] . '</td>
                          </tr>';
                }
                echo '</tbody></table></div><br>';
                ?>
                
            </main>

        </div>
    </div>

    <?php include_once '../includes/foot.php'; ?>

</body>

</html>