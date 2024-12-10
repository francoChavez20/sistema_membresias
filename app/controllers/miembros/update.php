<?php

include ('../../config.php');

$id_miembro = $_GET['id_miembro'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$dni = $_GET['dni'];
$telefono = $_GET['telefono'];
$id_membresia = $_GET['id_membresia'];
$estado_membresia = $_GET['estado_membresia'];
$fecha_comienzo = $_GET['fecha_comienzo'];
$fecha_final = $_GET['fecha_final'];

// Prepara la sentencia SQL para actualizar los datos del miembro
$sentencia = $pdo->prepare("UPDATE miembros
    SET nombre = :nombre,
        apellido = :apellido,
        dni = :dni,
        telefono = :telefono,
        id_membresia = :id_membresia,
        estado_membresia = :estado_membresia,
        fecha_comienzo = :fecha_comienzo,
        fecha_final = :fecha_final
    WHERE id_miembros = :id_miembro");

$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':apellido', $apellido);
$sentencia->bindParam(':dni', $dni);
$sentencia->bindParam(':telefono', $telefono);
$sentencia->bindParam(':id_membresia', $id_membresia);
$sentencia->bindParam(':estado_membresia', $estado_membresia);
$sentencia->bindParam(':fecha_comienzo', $fecha_comienzo);
$sentencia->bindParam(':fecha_final', $fecha_final);
$sentencia->bindParam(':id_miembro', $id_miembro);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó al miembro correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/miembros/miembros.php";
    </script>
    <?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo actualizar el miembro en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/miembros/miembros.php";
    </script>
    <?php
}
?>
