<?php

include ('../../config.php');

$id_miembro = $_GET['id_miembro'];
$monto = $_GET['monto'];
$metodo_pago = $_GET['metodo_pago'];
$fecha_pago = $_GET['fecha_pago'];


$sentencia = $pdo->prepare("INSERT INTO pago
       ( id_miembro, monto, metodo_pago, fecha_pago) 
VALUES ( :id_miembro, :monto, :metodo_pago, :fecha_pago)");

$sentencia->bindParam('id_miembro',$id_miembro);
$sentencia->bindParam('monto',$monto);
$sentencia->bindParam('metodo_pago',$metodo_pago);
$sentencia->bindParam('fecha_pago',$fecha_pago);


if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se registro el pago de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/pago/index.php";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/pago/index.php";
    </script>
    <?php
}