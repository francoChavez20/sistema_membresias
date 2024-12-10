<?php

include ('../../config.php');

$id_pago = $_GET['id_pago'];

$sentencia = $pdo->prepare("DELETE FROM pago WHERE id_pago=:id_pago ");

$sentencia->bindParam('id_pago',$id_pago);

if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se elimino el pago de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/pago/index.php";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/pago/index.php";
    </script>
    <?php
}