<?php include_once '../includes/head.php'; ?>
<?php include_once '../includes/header.php'; ?>

<body class="align-items-stretch">
<main class="flex-grow-1 p-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Espacio para el gráfico -->
            <div class="col-md-6">
                <h2>Gráfico</h2>
                <canvas id="CanvasGrafico" style="width: 100%; height: 100%; background-color: #FFA500;"></canvas>
            </div>

            <!-- Tabla con 4 columnas y 5 filas -->
            <div class="col-md-6 pt-md-0 pt-5">
                <h2>Tabla</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Columna 1</th>
                                <th>Columna 2</th>
                                <th>Columna 3</th>
                                <th>Columna 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <tr>
                                    <td>Fila
                                        <?php echo $i; ?>, Col 1
                                    </td>
                                    <td>Fila
                                        <?php echo $i; ?>, Col 2
                                    </td>
                                    <td>Fila
                                        <?php echo $i; ?>, Col 3
                                    </td>
                                    <td>Fila
                                        <?php echo $i; ?>, Col 4
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón "Regresar" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-warning btn-uta-orng" type="submit" href="botones.php">Regresar</a>
    </div>
</main>

<?php include_once '../includes/footer.php'; ?>
