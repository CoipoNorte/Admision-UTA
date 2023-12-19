<?php
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once '../util/verificar_sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla y Gráfico de Postulantes por Región</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <h1>Postulantes por Región</h1>
    <div class="container">
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
        echo '<table class="table">
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
        echo '</tbody></table>';
        ?>
    </div>

    <!-- Gráfico circular -->
    <div class="container">
     <center>   <h2>Gráfico de Postulantes por Región </h2></center>
        <div id="pie-chart"></div>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a><br>
    </div><br>

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

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
