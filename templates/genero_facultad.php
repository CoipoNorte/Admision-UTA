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
                    c.NOMBRE_FACULTAD AS Nombre_Facultad,
                    SUM(CASE WHEN p.SEXO = 1 THEN 1 ELSE 0 END) AS Cantidad_Hombres,
                    SUM(CASE WHEN p.SEXO = 2 THEN 1 ELSE 0 END) AS Cantidad_Mujeres
                  FROM Postulaciones p
                  JOIN Carreras c ON p.CODIGO = c.CODIGO_DEMRE
                  GROUP BY c.NOMBRE_FACULTAD";

        // Ejecutar la consulta
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla usando Bootstrap
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>Nombre de Facultad</th>
                        <th>Cantidad de Hombres</th>
                        <th>Cantidad de Mujeres</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $row) {
            echo '<tr>
                    <td>' . $row['nombre_facultad'] . '</td>
                    <td>' . $row['cantidad_hombres'] . '</td>
                    <td>' . $row['cantidad_mujeres'] . '</td>
                  </tr>';
        }
        echo '</tbody></table>';
        ?>
    </div>

    <!-- Gráfico combinado de barras -->
    <div class="container">
        <h2>Gráfico de Postulantes por Facultad (Hombres y Mujeres)</h2>
        <div id="bar-chart"></div>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a><br>
    </div><br>

    <script>
        // Obtener datos para el gráfico combinado de barras
        var facultades = <?php echo json_encode(array_column($data, 'nombre_facultad')); ?>;
        var hombres = <?php echo json_encode(array_column($data, 'cantidad_hombres')); ?>;
        var mujeres = <?php echo json_encode(array_column($data, 'cantidad_mujeres')); ?>;

        var data = [
            {
                x: facultades,
                y: hombres,
                name: 'Hombres',
                type: 'bar'
            },
            {
                x: facultades,
                y: mujeres,
                name: 'Mujeres',
                type: 'bar'
            }
        ];

        var layout = {
            title: 'Postulantes por Facultad (Hombres y Mujeres)',
            barmode: 'group'
        };

        Plotly.newPlot('bar-chart', data, layout);
    </script>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
