<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
if (isset($_SESSION['mensaje'])) {
    $respuesta = $_SESSION['mensaje']; ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "<?php echo $respuesta; ?>",
            showConfirmButton: false,
            timer: 10500
        });
    </script>

<?php
    //elimina la session para que no aparesca el mensaje al actualizar
    unset($_SESSION['mensaje']);
}


?>





<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registrar un nuevo usuario</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Agregar usuario</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="../app/controllers/usuarios/create.php" method="post">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" placeholder="ingrese un nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Apellido</label>
                                            <input type="text" name="apellido" class="form-control" placeholder="ingrese un apellido" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nombre de usuario</label>
                                            <input type="text" name="usuario" class="form-control" placeholder="ingrese usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="text" name="contraseña" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Repita la Contraseña</label>
                                            <input type="text" name="contraseña2" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <select name="rol" class="form-control" required required>
                                                <option value="">-- Seleccione un rol --</option> <!-- Opción por defecto -->
                                                <option value="Administrador">Administrador</option>
                                                <option value="Recepcionista">Recepcionista</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <a href="" class="btn btn-secondary">cancelar</a>
                                            <button class="btn btn-primary" type="submit">Guardar</button>
                                        </div>




                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
include('../layout/parte2.php');
?>