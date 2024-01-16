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
                    <h1 class="h1">Dependencia de los postulantes</h1>
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
                <h1 class="h2">Gráfico</h1>
                <div id="bar-chart"></div>

                <!--TABLA-->
                <h1 class="h2">Tabla</h1>
                <?php
                // Incluir archivo para la conexión a la base de datos
                include_once '../config.php';

                // Consulta SQL
                $query = "SELECT 
                            D.nombre AS Dependencia,
                            COUNT(DISTINCT P.numero_documento) AS Cantidad_Documentos_Unicos
                          FROM GRUPO_DEPENDENCIA D
                          JOIN Postulaciones P ON D.codigo = P.GRUPO_DEPENDENCIA
                          GROUP BY D.nombre";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '<div class="table-responsive pb-5">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Dependencia</th>
                                <th>Cantidad de Documentos Únicos</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($data as $row) {
                    echo '<tr>
                            <td>' . $row['dependencia'] . '</td>
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
        // Obtener datos para el gráfico de barras
        var dependencias = <?php echo json_encode(array_column($data, 'dependencia')); ?>;
        var cantidadDocumentos = <?php echo json_encode(array_column($data, 'cantidad_documentos_unicos')); ?>;

        var data = [{
            x: dependencias,
            y: cantidadDocumentos,
            type: 'bar'
        }];

        var layout = {
            title: 'Dependencia de los postulantes'
        };

        Plotly.newPlot('bar-chart', data, layout);
    </script>

</body>

</html>