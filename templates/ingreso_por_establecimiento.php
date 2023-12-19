<?php
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once '../util/verificar_sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Postulantes por Colegio (Región 15)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>Postulantes por Colegio (Región 15)</h1>
    <div class="container">
        <?php
        // Incluir archivo para la conexión a la base de datos
        include_once '../config.php';

        // Consulta SQL
        $query = "SELECT
                    e.RBD AS Colegio_RBD,
                    e.NOMBRE_OFICIAL AS Nombre_Colegio,
                    COUNT(DISTINCT p.numero_documento) AS total
                  FROM Postulaciones p
                  JOIN Establecimiento e ON p.RBD = e.RBD
                  WHERE e.CODIGO_REGION = 15
                  GROUP BY e.RBD, e.NOMBRE_OFICIAL
                  ORDER BY total DESC";

        // Ejecutar la consulta
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados en una tabla usando Bootstrap
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>Colegio RBD</th>
                        <th>Nombre del Colegio</th>
                        <th>Total de Postulantes</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $row) {
            echo '<tr>
                    <td>' . $row['colegio_rbd'] . '</td>
                    <td>' . $row['nombre_colegio'] . '</td>
                    <td>' . $row['total'] . '</td>
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
