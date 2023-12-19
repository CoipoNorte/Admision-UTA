<?php
include_once '../util/verificar_sesion.php';
include_once '../includes/head.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla y Gráfico de Postulantes por Etnia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <?php include_once '../includes/header.php'; ?>
    <h1>Postulantes por Etnia</h1>
    <div class="container">
        <?php
        // Incluir archivo para la conexión a la base de datos
        include_once '../config.php';

        // Consulta SQL
        $query = "SELECT
                    e.nombre AS Nombre_Etnia,
                    COUNT(DISTINCT p.numero_documento) AS total
                  FROM Postulaciones p
                  LEFT JOIN Etnias e ON p.CODIGO_ETNIA = e.codigo
                  GROUP BY e.nombre
                  ORDER BY total DESC";

        // Ejecutar la consulta
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla usando Bootstrap
        echo '<table class="table">
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
        echo '</tbody></table>';
        ?>
    </div>

    <!-- Gráfico de torta -->
    <div class="container">
        <center><h2>Gráfico de Postulantes por Etnia </h2></center>
        <div id="pie-chart"></div>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a><br>
    </div><br>

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

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
