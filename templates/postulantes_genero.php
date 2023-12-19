<?php
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once '../util/verificar_sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla y Gráfico de Total de Postulantes por Género</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <br><h1>Total de Postulantes por Género</h1>
    <div class="container">
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
        echo '<table class="table">
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
    </div>

    <!-- Gráfico de barras -->
    <div class="container">
        <center><h2>Gráfico de Total de Postulantes por Género</h2></center>
        <div id="bar-chart"></div>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a><br>
    </div><br>

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

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
