<?php

include ('../../config.php');

$id_membresia = $_GET['id_membresia'];
$nombre = $_GET['nombre'];
$precio = $_GET['precio'];
$descripcion = $_GET['descripcion'];


// Prepara la sentencia SQL para actualizar los datos del miembro
$sentencia = $pdo->prepare("UPDATE tipo_membresia
    SET nombre = :nombre,
        precio = :precio,
        descripcion = :descripcion
    WHERE id_membresia = :id_membresia");

$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':precio', $precio);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':id_membresia', $id_membresia);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó la membresia correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/membresias/index.php";
    </script>
    <?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo actualizar la membresia";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/membresias/index.php";
    </script>
    <?php
}
?>
