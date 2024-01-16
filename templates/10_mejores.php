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
                    <h1 class="h1">Puntajes Máximos por Carrera (Top 10)</h1>
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
                include_once '../config.php'; // Actualiza la ruta para el archivo config.php

                // Consulta SQL
                $query = "SELECT C.NOMBRE_CARRERA AS Nombre_Carrera, MAX(P.PUNTAJE_PONDERADO) AS Puntaje_Maximo
                          FROM Carreras C
                          JOIN Postulaciones P ON C.CODIGO_DEMRE = P.CODIGO
                          GROUP BY C.NOMBRE_CARRERA
                          ORDER BY Puntaje_Maximo DESC
                          LIMIT 10";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '
                    <div class="table-responsive pb-5">
                        <table class="table table-striped table-sm"
                            <thead>
                                <tr>
                                    <th>Nombre de Carrera</th>
                                    <th>Puntaje Máximo</th>
                                </tr>
                            </thead
                            <tbody>';

                foreach ($data as $row) {
                echo '
                    <tr>
                        <td>' . $row['nombre_carrera'] . '</td>
                        <td>' . $row['puntaje_maximo'] . '</td>
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