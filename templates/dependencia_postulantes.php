<?php
include_once '../util/verificar_sesion.php';
include_once '../includes/head.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla y Gráfico de Documentos por Dependencia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>

<?php include_once '../includes/header.php'; ?>

    <h1>Dependencia de los postulantes</h1>
    <div class="container">
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
        echo '<table class="table">
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
        echo '</tbody></table>';
        ?>
    </div>

    <!-- Gráfico de barras -->
    <div class="container">
        <center><h2>Gráfico: Dependencia de los postulantes </h2></center>
        <div id="bar-chart"></div>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a><br>
    </div><br>

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

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
