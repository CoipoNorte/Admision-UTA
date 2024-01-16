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
                    <h1 class="h1">Total de Postulantes por Género</h1>
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
                <h1 class="h2">Gráfico de Total de Postulantes por Género</h1>
                <div id="bar-chart"></div>

                <!--TABLA-->
                <h1 class="h2">Tabla</h1>
                <?php
                // Incluir archivo para la conexión a la base de datos
                include_once '../config.php';

                // Consulta SQL
                $query = "SELECT
                            COUNT(DISTINCT CASE WHEN p.SEXO = 1 THEN p.NUMERO_DOCUMENTO END) AS Total_Hombres,
                            COUNT(DISTINCT CASE WHEN p.SEXO = 2 THEN p.NUMERO_DOCUMENTO END) AS Total_Mujeres
                          FROM Postulaciones p";

                // Ejecutar la consulta
                $result = $db->query($query);
                $data = $result->fetch(PDO::FETCH_ASSOC);

                // Mostrar los resultados en una tabla usando Bootstrap
                echo '<div class="table-responsive pb-5">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Total de Hombres</th>
                                <th>Total de Mujeres</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>' . $data['total_hombres'] . '</td>
                                <td>' . $data['total_mujeres'] . '</td>
                            </tr>
                        </tbody>
                    </table>';
                ?>
                </div><br>  

            </main>

        </div>
    </div>

    <?php include_once '../includes/foot.php'; ?>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script>
        // Obtener datos para el gráfico de barras
        var data = [
            {
                x: ['Hombres', 'Mujeres'],
                y: [<?php echo $data['total_hombres']; ?>, <?php echo $data['total_mujeres']; ?>],
                type: 'bar'
            }
        ];

        var layout = {
            title: 'Total de Postulantes por Género',
        };

        Plotly.newPlot('bar-chart', data, layout);
    </script>

</body>

</html>