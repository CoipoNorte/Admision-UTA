<?php
include_once '../util/verificar_sesion.php';
include_once '../includes/head.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla y Gráfico de Postulantes por Facultad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
<?php include_once '../includes/header.php'; ?>
    <h1>Postulantes por Facultad</h1>
    <div class="container">
        <?php
        // Incluir archivo para la conexión a la base de datos
        include_once '../config.php';

        // Consulta SQL
        $query = "SELECT
                    C.NOMBRE_FACULTAD AS Nombre_Facultad,
                    SUM(CASE WHEN P.SEXO = 1 OR P.SEXO = 2 THEN 1 ELSE 0 END) AS Total_Postulantes
                  FROM Postulaciones P
                  JOIN Carreras C ON P.CODIGO = C.CODIGO_DEMRE
                  GROUP BY C.NOMBRE_FACULTAD";

        // Ejecutar la consulta
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla usando Bootstrap
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>Nombre de Facultad</th>
                        <th>Total de Postulantes</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $row) {
            echo '<tr>
                    <td>' . $row['nombre_facultad'] . '</td>
                    <td>' . $row['total_postulantes'] . '</td>
                  </tr>';
        }
        echo '</tbody></table>';
        ?>
    </div>

    <!-- Gráfico de barras --><br>
    <div class="container">
        <center><h2>Gráfico de Postulantes por Facultad </h2></center>
        <div id="bar-chart"></div>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a><br>
    </div><br>

    <script>
        // Obtener datos para el gráfico de barras
        var facultades = <?php echo json_encode(array_column($data, 'nombre_facultad')); ?>;
        var totalPostulantes = <?php echo json_encode(array_column($data, 'total_postulantes')); ?>;

        var data = [{
            x: facultades,
            y: totalPostulantes,
            type: 'bar'
        }];

        var layout = {
            title: 'Postulantes por Facultad '
        };

        Plotly.newPlot('bar-chart', data, layout);
    </script>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
