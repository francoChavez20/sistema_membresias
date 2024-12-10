<?php
  $sql_membresia = "SELECT*FROM tipo_membresia";
  $query_membresia = $pdo->prepare($sql_membresia);
  $query_membresia->execute();
  $datos_membresia = $query_membresia->fetchAll(PDO::FETCH_ASSOC);

  ?>