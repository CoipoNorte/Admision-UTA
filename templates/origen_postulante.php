<?php
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once '../util/verificar_sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nacionalidades de los postulantes </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <h1>Nacionalidades de los postulantes </h1>
    <div class="container">
        <?php
        // Incluir archivo para la conexión a la base de datos
        include_once '../config.php';

        // Consulta SQL
        $query = "SELECT
                    CASE 
                        WHEN tipo_identificacion = 'P' THEN 'Extranjero'
                        WHEN tipo_identificacion = 'C' THEN 'Chileno'
                        ELSE 'Otros'
                    END AS Origen,
                    COUNT(DISTINCT numero_documento) AS Cantidad_Documentos_Unicos
                  FROM Postulaciones
                  GROUP BY Origen";

        // Ejecutar la consulta
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla usando Bootstrap
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>Origen</th>
                        <th>Cantidad de Documentos Únicos</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $row) {
            echo '<tr>
                    <td>' . $row['origen'] . '</td>
                    <td>' . $row['cantidad_documentos_unicos'] . '</td>
                  </tr>';
        }
        echo '</tbody></table>';
        ?>
    </div>

    <!-- Gráfico de torta -->
    <div class="container">
        <h2>Gráfico Nacionalidades de los postulantes </h2>
        <div id="pie-chart"></div>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a><br>
    </div><br>

    <script>
        // Obtener datos para el gráfico de torta
        var origen = <?php echo json_encode(array_column($data, 'origen')); ?>;
        var cantidadDocumentos = <?php echo json_encode(array_column($data, 'cantidad_documentos_unicos')); ?>;

        var data = [{
            values: cantidadDocumentos,
            labels: origen,
            type: 'pie'
        }];

        var layout = {
            title: 'Origen de Documentos (Torta)'
        };

        Plotly.newPlot('pie-chart', data, layout);
    </script>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
