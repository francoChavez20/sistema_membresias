<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');


include('../app/controllers/usuarios/listado_usuarios.php');

if (isset($_SESSION['mensaje'])) {
    $respuesta = $_SESSION['mensaje']; ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
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
                    <h1 class="m-0">listado de usuarios</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 ">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios registrados</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Nombre usuario</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($datos_usuarios as $datos_usuarios) { 
                                        $id_usuario = $datos_usuarios['id_usuario'];
                                        ?>
                                        <tr>
                                            <td><?php echo $contador = $contador + 1 ?></td>
                                            <td><?php echo $datos_usuarios['nombre'] ?></td>
                                            <td><?php echo $datos_usuarios['apellido'] ?></td>
                                            <td><?php echo $datos_usuarios['usuario'] ?></td>
                                            <td><?php echo $datos_usuarios['rol'] ?></td>
                                            <td><center>
                                            <div class="btn-group">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modal-delete<?php echo $id_usuario; ?>">
                                                            <i class="fa fa-trash"></i> Borrar
                                                        </button>
                                                        <!-- modal para borrar proveedore -->
                                                        <div class="modal fade" id="modal-delete<?php echo $id_usuario; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #ca0a0b;color: white">
                                                                        <h4 class="modal-title">¿Esta seguro de eliminar al proveedor?</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                        <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_usuario; ?>">Eliminar</button>
                                                                    </div>
                                                                    <div id="respuesta_delete<?php echo $id_usuario; ?>"></div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                        <script>
                                                            $('#btn_delete<?php echo $id_usuario; ?>').click(function() {

                                                                var id_usuario = '<?php echo $id_usuario; ?>';

                                                                var url2 = "../app/controllers/usuarios/delete.php";
                                                                $.get(url2, {
                                                                    id_usuario: id_usuario
                                                                }, function(datos) {
                                                                    $('#respuesta_delete<?php echo $id_usuario; ?>').html(datos);
                                                                });


                                                            });
                                                        </script>

                                                    </div>
                                            </center></td>
                                        </tr>




                                    <?php
                                    }

                                    ?>

                                </tbody>
                                
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php



                    ?>


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
<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 7,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
</script>
