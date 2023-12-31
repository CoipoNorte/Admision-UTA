<?php
include_once '../util/verificar_sesion.php'; // Actualiza la ruta para el archivo verificar_sesion.php
include_once '../includes/head.php'; // Actualiza la ruta para el archivo head.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Puntajes Máximos por Carrera (Top 10)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include_once '../includes/header.php'; // Actualiza la ruta para el archivo header.php ?>

    <h1>Puntajes Máximos por Carrera (Top 10)</h1>
    <div class="container">

    <?php
        // Incluir archivo para la conexión a la base de datos
        include_once '../config.php'; // Actualiza la ruta para el archivo config.php

        // Consulta SQL
        $query = "SELECT
                    C.NOMBRE_CARRERA AS Nombre_Carrera,
                    MAX(P.PUNTAJE_PONDERADO) AS Puntaje_Maximo
                  FROM Carreras C
                  JOIN Postulaciones P ON C.CODIGO_DEMRE = P.CODIGO
                  GROUP BY C.NOMBRE_CARRERA
                  ORDER BY Puntaje_Maximo DESC
                  LIMIT 10";

        // Ejecutar la consulta
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla usando Bootstrap
        echo '
        <div class="table-responsive pb-5">
            <table class="table table-striped table-sm"
                <thead>
                    <tr>
                        <th>Nombre de Carrera</th>
                        <th>Puntaje Máximo</th>
                    </tr>
                </thead
                <tbody>';

        foreach ($data as $row) {
        echo '
                    <tr>
                        <td>' . $row['nombre_carrera'] . '</td>
                        <td>' . $row['puntaje_maximo'] . '</td>
                    </tr>';
        }
        echo '
                </tbody>
            </table>
        </div>';
    ?>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a>
    </div>
    <br>

    <?php include_once '../includes/footer.php'; // Actualiza la ruta para el archivo footer.php ?>
</body>
</html>
