<?php

function verificarRol($rolesPermitidos) {
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $rolesPermitidos)) {
        // Redirigir a una página de acceso denegado
        header('Location: ../layout/acceso_denegado.php');
        exit();
    }
}

?>