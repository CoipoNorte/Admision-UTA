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
                    <h1 class="h2">Postulantes por Carrera</h1>
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
                $query = "SELECT c.NOMBRE_CARRERA AS Nombre_Carrera,
                            SUM(CASE WHEN p.SEXO = 1 THEN 1 ELSE 0 END) AS Cantidad_Hombres,
                            SUM(CASE WHEN p.SEXO = 2 THEN 1 ELSE 0 END) AS Cantidad_Mujeres
                            FROM Postulaciones p
                            JOIN Carreras c ON p.CODIGO = c.CODIGO_DEMRE
                            GROUP BY c.NOMBRE_CARRERA";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '<div class="table-responsive pb-5">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre de Carrera</th>
                                    <th>Cantidad de Hombres</th>
                                    <th>Cantidad de Mujeres</th>
                                </tr>
                            </thead>
                            <tbody>';
                foreach ($data as $row) {
                    echo '<tr>
                            <td>' . $row['nombre_carrera'] . '</td>
                            <td>' . $row['cantidad_hombres'] . '</td>
                            <td>' . $row['cantidad_mujeres'] . '</td>
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