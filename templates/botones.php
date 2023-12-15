<?php include_once '../includes/head.php'; ?>
<?php include_once '../includes/header.php'; ?>

<body class="align-items-stretch">
<main class="flex-grow-1 text-center p-5">
    <h1 class="h3 mb-3 fw-normal">Botones</h1>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <div class="col">
                <a class="btn btn-warning btn-uta-orng" type="submit" href="tablero.php">Botón <?php echo $i; ?></a>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Botón "Salir" -->
    <div class="text-center mt-4 pt-5">
        <a class="btn btn-danger btn-uta-orng" type="submit" href="login.php">Salir</a>
    </div>

</main>

<?php include_once '../includes/footer.php'; ?>
