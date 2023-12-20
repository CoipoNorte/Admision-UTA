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
                    <h1 class="h2">Resultados de Postulaciones</h1>
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
                            MAX(CAST(p.PUNTAJE_PONDERADO AS DECIMAL)) AS Puntaje_Maximo,
                            MIN(CAST(p.PUNTAJE_PONDERADO AS DECIMAL)) AS Puntaje_Minimo,
                            SUM(CASE WHEN p.ESTADO_DE_LA_POSTULACION = 24 THEN 1 ELSE 0 END) AS Seleccionados,
                            SUM(CASE WHEN p.ESTADO_DE_LA_POSTULACION = 25 THEN 1 ELSE 0 END) AS Lista_Espera
                            FROM Carreras c
                            LEFT JOIN Postulaciones p ON c.CODIGO_DEMRE = p.CODIGO
                            GROUP BY c.NOMBRE_CARRERA
                            HAVING MAX(CAST(p.PUNTAJE_PONDERADO AS DECIMAL)) != 0 AND MIN(CAST(p.PUNTAJE_PONDERADO AS DECIMAL)) != 0";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '<div class="table-responsive pb-5">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre de Carrera</th>
                                    <th>Puntaje Máximo</th>
                                    <th>Puntaje Mínimo</th>
                                    <th>Seleccionados</th>
                                    <th>Lista de Espera</th>
                                </tr>
                            </thead>
                            <tbody>';
                foreach ($data as $row) {
                    echo '<tr>
                            <td>' . $row['nombre_carrera'] . '</td>
                            <td>' . $row['puntaje_maximo'] . '</td>
                            <td>' . $row['puntaje_minimo'] . '</td>
                            <td>' . $row['seleccionados'] . '</td>
                            <td>' . $row['lista_espera'] . '</td>
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