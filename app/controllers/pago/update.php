<?php

include('../../config.php');

$id_pago = $_GET['id_pago'];
$id_miembro = $_GET['id_miembro'];
$monto = $_GET['monto'];
$metodo_pago = $_GET['metodo_pago'];
$fecha_pago = $_GET['fecha_pago'];

// Prepara la sentencia SQL para actualizar los datos del miembro
$sentencia = $pdo->prepare("UPDATE pago
    SET id_miembro = :id_miembro,
          monto = :monto,
          metodo_pago = :metodo_pago,
          fecha_pago = :fecha_pago
    WHERE id_pago = :id_pago");

$sentencia->bindParam(':id_miembro', $id_miembro);
$sentencia->bindParam(':monto', $monto);
$sentencia->bindParam(':metodo_pago', $metodo_pago);
$sentencia->bindParam(':fecha_pago', $fecha_pago);
$sentencia->bindParam(':id_pago', $id_pago);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el pago correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/pago/index.php";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo actualizar el pago en la base de datos";
    $_SESSION['icono'] = "error";
?>
    <script>
        location.href = "<?php echo $URL; ?>/pago/index.php";
    </script>
<?php
}
?>