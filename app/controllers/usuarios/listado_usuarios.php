<?php
  $sql_usuarios = "SELECT*FROM usuario";
  $query_usuarios = $pdo->prepare($sql_usuarios);
  $query_usuarios->execute();
  $datos_usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

  ?>