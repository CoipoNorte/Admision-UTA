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
                    <h1 class="h2">Postulantes por Etnia</h1>
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
                <h1 class="h2">Grafico</h1>
                <div id="pie-chart">
                
                <!--TABLA-->
                <h1 class="h2">Tabla</h1>
                <?php
                // Incluir archivo para la conexión a la base de datos
                include_once '../config.php';

                // Consulta SQL
                $query = "SELECT e.nombre AS Nombre_Etnia, COUNT(DISTINCT p.numero_documento) AS total
                          FROM Postulaciones p
                          LEFT JOIN Etnias e ON p.CODIGO_ETNIA = e.codigo
                          GROUP BY e.nombre
                          ORDER BY total DESC";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '<div class="table-responsive pb-5">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre de Etnia</th>
                                    <th>Total de Postulantes</th>
                                </tr>
                            </thead>
                            <tbody>';
                foreach ($data as $row) {
                    echo '<tr>
                            <td>' . $row['nombre_etnia'] . '</td>
                            <td>' . $row['total'] . '</td>
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
        var etnias = <?php echo json_encode(array_column($data, 'nombre_etnia')); ?>;
        var totalPostulantes = <?php echo json_encode(array_column($data, 'total')); ?>;

        var data = [{
            values: totalPostulantes,
            labels: etnias,
            type: 'pie'
        }];

        var layout = {
            title: 'Postulantes por Etnia (Torta)'
        };

        Plotly.newPlot('pie-chart', data, layout);
    </script>

</body>

</html>