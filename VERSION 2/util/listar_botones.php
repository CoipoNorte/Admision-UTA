<?php
// Listas de nombres de archivos de plantillas en la carpeta "botones"
$plantillaNombres = [
    "Mejores 10",
    "Dependencia postulantes",
    "Detalles",
    "Etnias Postulantes",
    "Genero Carrera",
    "Genero Facultad",
    "Ingreso por Establecimiento",
    "Ingresos Establecimientos",
    "Origen Postulante",
    "Postulaciones Facultad",
    "Postulantes Genero",
    "Postulantes Region",
];

$plantillaVistas = [
    "10_mejores",
    "dependencia_postulantes",
    "detalles",
    "etnias_postulantes",
    "genero_carrera",
    "genero_facultad",
    "ingreso_por_establecimiento",
    "ingresos_establecimientos",
    "origen_postulante",
    "postulaciones_facultad",
    "postulantes_genero",
    "postulantes_region",
];

// Itera sobre la lista y genera los enlaces
for ($i = 0; $i < count($plantillaNombres); $i++) :
    $nombreVista = $plantillaVistas[$i];
?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo $nombreVista; ?>.php"><?php echo $plantillaNombres[$i]; ?></a>
    </li>

<?php endfor; ?>
