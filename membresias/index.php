<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');


include('../app/controllers/membresias/listar_membresias.php');

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
                    <h1 class="m-0">listado de membresias
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                        </button>
                        <a href="<?php echo $URL; ?>/fpdf/membresiaa.php" target="_blank" class="btn btn-primary m-2"><i class="fas fa-file-pdf"></i> Generar reporte</a>
                    </h1>
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
                            <h3 class="card-title">membresías registradas</h3>

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
                                        <th>Tipo de Membresía</th>
                                        <th>Precio</th>
                                        <th>Descripcion</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($datos_membresia as$datos_membresia) { 
                                        $id_membresia = $datos_membresia['id_membresia'];
                                        ?>
                                        <tr>
                                            <td><?php echo $contador = $contador + 1 ?></td>
                                            <td><?php echo $datos_membresia['nombre'] ?></td>
                                            <td><?php echo $datos_membresia['precio'] ?></td>
                                            <td><?php echo $datos_membresia['descripcion'] ?></td>
                                            
                                            <td><center>
                                                <div class="btn-group">
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal-update<?php echo $id_membresia; ?>">
                                                            <i class="fa fa-pencil-alt"></i> Editar
                                                        </button>
                                                        <!-- Modal para actualizar miembro -->
                                                        <div class="modal fade" id="modal-update<?php echo $id_membresia; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #116f4a;color: white">
                                                                        <h4 class="modal-title">Actualización de membresias</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Nombre <b>*</b></label>
                                                                                    <input type="text" id="nombre<?php echo $id_membresia; ?>" value="<?php echo $datos_membresia['nombre']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_nombre<?php echo $id_membresia; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Apellido <b>*</b></label>
                                                                                    <input type="text" id="precio<?php echo $id_membresia; ?>" value="<?php echo $datos_membresia['precio']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_precio<?php echo $id_membresia; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">DNI <b>*</b></label>
                                                                                    <input type="text" id="descripcion<?php echo $id_membresia; ?>" value="<?php echo $datos_membresia['descripcion']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_descripcion<?php echo $id_membresia; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>

                                                                       
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_membresia; ?>">Actualizar</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                        <script>
                                                            $('#btn_update<?php echo $id_membresia; ?>').click(function() {

                                                                var id_membresia = '<?php echo    $id_membresia; ?>';
                                                                var nombre = $('#nombre<?php echo $id_membresia; ?>').val();
                                                                var precio = $('#precio<?php echo$id_membresia; ?>').val();
                                                                var descripcion = $('#descripcion<?php echo $id_membresia; ?>').val();
                                                               

                                                                if (nombre == "") {
                                                                    $('#nombre<?php echo $id_membresia; ?>').focus();
                                                                    $('#lbl_nombre<?php echo $id_membresia; ?>').css('display', 'block');
                                                                } else if (precio == "") {
                                                                    $('#precio<?php echo $id_membresia; ?>').focus();
                                                                    $('#lbl_precio<?php echo $id_membresia; ?>').css('display', 'block');
                                                                } else if (descripcion == "") {
                                                                    $('#descripcion<?php echo $id_membresia; ?>').focus();
                                                                    $('#lbl_descripcion<?php echo $id_membresia; ?>').css('display', 'block');
                                                                } else {
                                                                    var url = "../app/controllers/membresias/update.php";
                                                                    $.get(url, {
                                                                        id_membresia: id_membresia,
                                                                        nombre: nombre,
                                                                        precio: precio,
                                                                        descripcion: descripcion

                                                                    }, function(datos) {
                                                                        $('#respuesta_update<?php echo $id_membresia; ?>').html(datos);
                                                                    });
                                                                }
                                                            });
                                                        </script>
                                                        <div id="respuesta_update<?php echo $id_membresia; ?>"></div>
                                                </div>
                                                </div>
                                                <div class="btn-group">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modal-delete<?php echo $id_membresia; ?>">
                                                            <i class="fa fa-trash"></i> Borrar
                                                        </button>
                                                        <!-- modal para borrar proveedore -->
                                                        <div class="modal fade" id="modal-delete<?php echo $id_membresia; ?>">
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
                                                                        <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_membresia; ?>">Eliminar</button>
                                                                    </div>
                                                                    <div id="respuesta_delete<?php echo $id_membresia; ?>"></div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                        <script>
                                                            $('#btn_delete<?php echo $id_membresia; ?>').click(function() {

                                                                var id_membresia = '<?php echo $id_membresia; ?>';

                                                                var url2 = "../app/controllers/membresias/delete.php";
                                                                $.get(url2, {
                                                                    id_membresia: id_membresia
                                                                }, function(datos) {
                                                                    $('#respuesta_delete<?php echo $id_membresia; ?>').html(datos);
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
</div>
<!-- modal para registrar miembros-------------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1d36b6;color: white">
                <h4 class="modal-title">Creación de una nueva membresia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nombre <b>*</b></label>
                            <input type="text" id="nombre" class="form-control">
                            <small style="color: red;display: none" id="lbl_nombre">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">precio <b>*</b></label>
                            <input type="text" id="precio" class="form-control">
                            <small style="color: red;display: none" id="lbl_precio">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">descripcion <b>*</b></label>
                            <input type="text" id="descripcion" class="form-control">
                            <small style="color: red;display: none" id="lbl_descripcion">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar membresia</button>
            </div>
            <div id="respuesta"></div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $('#btn_create').click(function() {
        var nombre = $('#nombre').val();
        var precio = $('#precio').val();
        var descripcion = $('#descripcion').val();

        if (nombre == "") {
            $('#nombre').focus();
            $('#lbl_nombre').css('display', 'block');
        } else if (precio == "") {
            $('#precio').focus();
            $('#lbl_precio').css('display', 'block');
        } else if (descripcion == "") {
            $('#descripcion').focus();
            $('#lbl_descripcion').css('display', 'block');
        } else {
            var url = "../app/controllers/membresias/create.php";
            $.get(url, {
                nombre: nombre,
                precio: precio,
                descripcion: descripcion
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>

<?php
include('../layout/parte2.php');
?>
<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 5,
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
