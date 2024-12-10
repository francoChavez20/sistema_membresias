<?php

include('app/config.php');
include('layout/sesion.php');
include('layout/parte1.php');
include('./app/controllers/usuarios/listado_usuarios.php');
include('./app/controllers/pago/listar_pago.php');
include('./app/controllers/miembros/listado_miembros.php');
include('./app/controllers/membresias/listar_membresias.php');


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Bienvenido al SISTEMA  - <?php echo $rol_sesion ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <h4>Contenido del sistema</h4>


            <div class="row">

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $contador_miembros = 0;
                            foreach ($datos_miembros as $datos) {
                                $contador_miembros = $contador_miembros + 1;
                            }
                            ?>

                            <h3><?php echo $contador_miembros; ?></h3>
                            <p>Miembros Registrados</p>
                        </div>
                        <a href="">
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </a>
                        <a href="" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $contador_membresia = 0;
                            foreach ($datos_membresia as $datos) {
                                $contador_membresia = $contador_membresia + 1;
                            }
                            ?>

                            <h3><?php echo $contador_membresia; ?></h3>
                            <p>Membresías Registradas</p>
                        </div>
                        <a href="">
                            <div class="icon">
                                <i class="fas fa-address-card"></i>
                            </div>
                        </a>
                        <a href="" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $contador_pago = 0;
                            foreach ($datos_pago as $datos) {
                                $contador_pago = $contador_pago + 1;
                            }
                            ?>

                            <h3><?php echo $contador_pago; ?></h3>
                            <p>Pagos Registrados</p>
                        </div>
                        <a href="">
                            <div class="icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </a>
                        <a href="" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php
                            $contador_usuario = 0;
                            foreach ($datos_usuarios as $datos_usuarios) {
                                $contador_usuario = $contador_usuario + 1;
                            }
                            ?>

                            <h3><?php echo $contador_usuario; ?></h3>
                            <p>Usuarios Registrados</p>
                        </div>
                        <a href="">
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </a>
                        <a href="" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include './layout/parte2.php'

?>