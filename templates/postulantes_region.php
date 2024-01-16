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
                    <h1 class="h1">Postulantes por Región</h1>
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
                <h1 class="h2">Gráfico de Postulantes por Región</h1>
                <div id="pie-chart"></div>

                <!--TABLA-->
                <h1 class="h2">Tabla</h1>
                <?php
                // Incluir archivo para la conexión a la base de datos
                include_once '../config.php';

                // Consulta SQL
                $query = "SELECT R.REG_ORDEN, COUNT(DISTINCT P.NUMERO_DOCUMENTO) AS cantidad_postulantes
                          FROM Regiones R
                          JOIN Postulaciones P ON R.CR = P.CODIGO_REGION
                          GROUP BY R.REG_ORDEN
                          ORDER BY cantidad_postulantes DESC";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '<div class="table-responsive pb-5">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nombre de Región</th>
                                <th>Cantidad de Postulantes</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($data as $row) {
                    echo '<tr>
                            <td>' . $row['reg_orden'] . '</td>
                            <td>' . $row['cantidad_postulantes'] . '</td>
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
        // Obtener datos para el gráfico circular
        var regiones = <?php echo json_encode(array_column($data, 'reg_orden')); ?>;
        var postulantes = <?php echo json_encode(array_column($data, 'cantidad_postulantes')); ?>;

        var data = [{
            values: postulantes,
            labels: regiones,
            type: 'pie'
        }];

        var layout = {
            title: 'Postulantes por Región (Circular)'
        };

        Plotly.newPlot('pie-chart', data, layout);
    </script>

</body>

</html>