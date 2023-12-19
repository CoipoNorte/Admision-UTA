<?php
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once '../util/verificar_sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Resultados de Carreras</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<h1>Postulaciones por Carrera</h1>
<div class="container">
    <?php
    // Incluir archivo para la conexión a la base de datos
    include_once '../config.php';

    // Consulta SQL
    $query = "SELECT
                c.NOMBRE_CARRERA AS Nombre_Carrera,
                MAX(CAST(p.PUNTAJE_PONDERADO AS DECIMAL)) AS Puntaje_Maximo,
                MIN(CAST(p.PUNTAJE_PONDERADO AS DECIMAL)) AS Puntaje_Minimo,
                SUM(CASE WHEN p.ESTADO_DE_LA_POSTULACION = 24 THEN 1 ELSE 0 END) AS Seleccionados,
                SUM(CASE WHEN p.ESTADO_DE_LA_POSTULACION = 25 THEN 1 ELSE 0 END) AS Lista_Espera
              FROM Carreras c
              LEFT JOIN Postulaciones p ON c.CODIGO_DEMRE = p.CODIGO
              GROUP BY c.NOMBRE_CARRERA
              HAVING MAX(CAST(p.PUNTAJE_PONDERADO AS DECIMAL)) != 0 AND MIN(CAST(p.PUNTAJE_PONDERADO AS DECIMAL)) != 0";

    // Ejecutar la consulta
    $result = $db->query($query);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    

    // Mostrar los resultados en una tabla usando Bootstrap
    echo '<table class="table">
            <thead>
                <tr>
                    <th>Nombre de Carrera</th>
                    <th>Puntaje Máximo</th>
                    <th>Puntaje Mínimo</th>
                    <th>Seleccionados</th>
                    <th>Lista de Espera</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($data as $row) {
        echo '<tr>
                <td>' . $row['nombre_carrera'] . '</td>
                <td>' . $row['puntaje_maximo'] . '</td>
                <td>' . $row['puntaje_minimo'] . '</td>
                <td>' . $row['seleccionados'] . '</td>
                <td>' . $row['lista_espera'] . '</td>
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
