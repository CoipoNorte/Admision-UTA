<?php
// Lista de nombres de archivos de plantillas en la carpeta "botones"
$plantillaNombres = [
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
foreach ($plantillaNombres as $nombre) :
?>
    <div class="col">
        <!-- Construye el enlace con el nombre de la plantilla actual -->
        <a class="btn btn-warning btn-uta-orng" href="<?php echo $nombre; ?>.php"><?php echo $nombre; ?></a>
    </div>
<?php endforeach; ?>