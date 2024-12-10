
<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../conexion.php'; //llamamos a la conexion BD
 
      $consulta_info = $conn->query("SELECT * FROM miembros"); //traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('../img/galaxy.png', 10, 5, 40); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode("Galaxy Fitness"), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(190);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : jr.Marizcal caseres"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(190);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : 900054935"), 0, 0, '', 0);
      $this->Ln(5);

      /* RUC */
      $this->Cell(190);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("RUC : 56455655236"), 0, 0, '', 0);
      $this->Ln(10);



      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 0, 0);
      $this->Cell(80); // mover a la derecha
      $this->SetFont('Arial', 'B', 25);
      $this->Cell(100, 10, utf8_decode("Lista de Miembros"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(151, 236, 216); //colorFondo
      $this->SetTextColor(0, 0, 0); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(8, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Apellido'), 1, 0, 'C', 1);
      $this->Cell(27, 10, utf8_decode('DNI'), 1, 0, 'C', 1);
      $this->Cell(27, 10, utf8_decode('Teléfono'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Membresía'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Estado'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Fecha Inicio'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Fecha Fin'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../conexion.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte = $conn->query("SELECT  miembros.id_miembros, 
        miembros.nombre, 
        miembros.apellido, 
        miembros.dni, 
        miembros.telefono, 
        tipo_membresia.nombre AS membresia, 
        miembros.estado_membresia, 
        miembros.fecha_comienzo, 
        miembros.fecha_final 
    FROM 
        miembros AS miembros
    INNER JOIN tipo_membresia AS tipo_membresia  ON  miembros.id_membresia = tipo_membresia.id_membresia");

while ($datos_reporte = $consulta_reporte->fetch_object()) {
   $i = $i + 1;
   /* TABLA */
   $pdf->Cell(8, 10, utf8_decode($datos_reporte->id_miembros), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($datos_reporte->nombre), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($datos_reporte->apellido), 1, 0, 'C', 0);
    $pdf->Cell(27, 10, utf8_decode($datos_reporte->dni), 1, 0, 'C', 0);
    $pdf->Cell(27, 10, utf8_decode($datos_reporte->telefono), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($datos_reporte->membresia), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($datos_reporte->estado_membresia), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, utf8_decode($datos_reporte->fecha_comienzo), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, utf8_decode($datos_reporte->fecha_final), 1, 1, 'C', 0);
  
}


$pdf->Output('Reporte_Miembros.pdf', 'I'); // Visualizar o descargar PDF