<?php
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once '../util/verificar_sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Postulantes por Carrera</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>Postulantes por Carrera</h1>
    <div class="container">
        <?php
        // Incluir archivo para la conexión a la base de datos
        include_once '../config.php';

        // Consulta SQL
        $query = "SELECT
                    c.NOMBRE_CARRERA AS Nombre_Carrera,
                    SUM(CASE WHEN p.SEXO = 1 THEN 1 ELSE 0 END) AS Cantidad_Hombres,
                    SUM(CASE WHEN p.SEXO = 2 THEN 1 ELSE 0 END) AS Cantidad_Mujeres
                  FROM Postulaciones p
                  JOIN Carreras c ON p.CODIGO = c.CODIGO_DEMRE
                  GROUP BY c.NOMBRE_CARRERA";

        // Ejecutar la consulta
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla usando Bootstrap
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>Nombre de Carrera</th>
                        <th>Cantidad de Hombres</th>
                        <th>Cantidad de Mujeres</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $row) {
            echo '<tr>
                    <td>' . $row['nombre_carrera'] . '</td>
                    <td>' . $row['cantidad_hombres'] . '</td>
                    <td>' . $row['cantidad_mujeres'] . '</td>
                  </tr>';
        }
        echo '</tbody></table>';
        ?>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a><br>
    </div><br>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
