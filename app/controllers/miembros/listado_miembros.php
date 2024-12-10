<?php
$sql_miembros = "SELECT m.id_miembros AS id_miembro, 
                        m.nombre AS nombre, 
                        m.apellido AS apellido, 
                        m.dni AS dni,  
                        m.telefono AS telefono, 
                        tm.nombre AS tipo_membresia, 
                        m.estado_membresia AS estado_membresia, 
                        m.fecha_comienzo AS fecha_comienzo, 
                        m.fecha_final AS fecha_final 
                 FROM miembros AS m
                 INNER JOIN tipo_membresia AS tm ON m.id_membresia = tm.id_membresia";

$query_miembros = $pdo->prepare($sql_miembros);
$query_miembros->execute();
$datos_miembros = $query_miembros->fetchAll(PDO::FETCH_ASSOC);
