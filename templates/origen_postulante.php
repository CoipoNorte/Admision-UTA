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
                    <h1 class="h1">Nacionalidades de los postulantes</h1>
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

                <!--GRAFICO-->
                <h1 class="h2">Gráfico Nacionalidades de los postulantes</h1>
                <div id="pie-chart"></div>

                <!--TABLA-->
                <h1 class="h2">Tabla</h1>
                <?php
                // Incluir archivo para la conexión a la base de datos
                include_once '../config.php';

                // Consulta SQL
                $query = "SELECT
                            CASE 
                                WHEN tipo_identificacion = 'P' THEN 'Extranjero'
                                WHEN tipo_identificacion = 'C' THEN 'Chileno'
                                ELSE 'Otros'
                            END AS Origen,
                            COUNT(DISTINCT numero_documento) AS Cantidad_Documentos_Unicos
                          FROM Postulaciones
                          GROUP BY Origen";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '<div class="table-responsive pb-5">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Origen</th>
                                <th>Cantidad de Documentos Únicos</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($data as $row) {
                    echo '<tr>
                            <td>' . $row['origen'] . '</td>
                            <td>' . $row['cantidad_documentos_unicos'] . '</td>
                          </tr>';
                }
                echo '</tbody></table></div><br>';
                ?>

            </main>

        </div>
    </div>

    <?php include_once '../includes/foot.php'; ?>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script>
        // Obtener datos para el gráfico de torta
        var origen = <?php echo json_encode(array_column($data, 'origen')); ?>;
        var cantidadDocumentos = <?php echo json_encode(array_column($data, 'cantidad_documentos_unicos')); ?>;

        var data = [{
            values: cantidadDocumentos,
            labels: origen,
            type: 'pie'
        }];

        var layout = {
            title: 'Origen de Documentos (Torta)'
        };

        Plotly.newPlot('pie-chart', data, layout);
    </script>

</body>

</html>