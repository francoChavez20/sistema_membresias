<?php

include ('../../config.php');

$id_usuario = $_GET['id_usuario'];

$sentencia = $pdo->prepare("DELETE FROM usuario WHERE id_usuario=:id_usuario ");

$sentencia->bindParam('id_usuario',$id_usuario);

if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se elimino el usuario correctamente";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/usuario/usuario.php";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/usuario/usuario.php";
    </script>
    <?php
}