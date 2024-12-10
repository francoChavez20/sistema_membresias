<?php

include ('../../config.php');

$id_miembro = $_GET['id_miembro'];

$sentencia = $pdo->prepare("DELETE FROM miembros WHERE id_miembros=:id_miembros ");

$sentencia->bindParam('id_miembros',$id_miembro);

if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se elimino al miembro de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/miembros/miembros.php";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/miembros/miembros.php";
    </script>
    <?php
}
