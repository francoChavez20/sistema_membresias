<?php
  $sql_pago = "SELECT pago.id_pago AS id_pago, 
                     pago.monto AS monto, 
                     pago.metodo_pago AS metodo_pago, 
                     pago.fecha_pago AS fecha_pago, 
                     miembro.nombre AS nombre_miembro, 
                     miembro.apellido AS apellido_miembro 
                     
              FROM pago AS pago
              INNER JOIN miembros AS miembro ON pago.id_miembro = miembro.id_miembros";
              
  $query_pago = $pdo->prepare($sql_pago);
  $query_pago->execute();
  $datos_pago = $query_pago->fetchAll(PDO::FETCH_ASSOC);

  ?>