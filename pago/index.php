<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');


include('../app/controllers/pago/listar_pago.php');
include('../app/controllers/miembros/listado_miembros.php');

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
                    <h1 class="m-0">listado de Pagos
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                        </button>
                        <a href="../fpdf/pago.php" target="_blank" class="btn btn-primary m-2"><i class="fas fa-file-pdf"></i> Generar reporte</a>
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
                            <h3 class="card-title">Pagos Registrados</h3>

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
                                        <th>Nombre y apellido</th>
                                        <th>Monto</th>
                                        <th>Metodo de pago</th>
                                        <th>Fecha de pago</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($datos_pago as $datos_pago) {
                                        $id_pago = $datos_pago['id_pago'];
                                    ?>
                                        <tr>
                                            <td><?php echo $contador = $contador + 1 ?></td>
                                            <td><?php echo $datos_pago['nombre_miembro'] . ' ' . $datos_pago['apellido_miembro']; ?></td>
                                            <td><?php echo $datos_pago['monto'] ?></td>
                                            <td><?php echo $datos_pago['metodo_pago'] ?></td>
                                            <td><?php echo $datos_pago['fecha_pago'] ?></td>

                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal-update<?php echo  $id_pago; ?>">
                                                            <i class="fa fa-pencil-alt"></i> Editar
                                                        </button>
                                                        <!-- Modal para actualizar miembro -->
                                                        <div class="modal fade" id="modal-update<?php echo  $id_pago; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #116f4a;color: white">
                                                                        <h4 class="modal-title">Actualizar Pagos</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Nombre <b>*</b></label>
                                                                                    <div style="display: flex">

                                                                                        <select name="id_miembro" id="id_miembro<?php echo $id_pago; ?>" class="form-control" required>
                                                                                            <?php
                                                                                            foreach ($datos_miembros as $miembro) {
                                                                                                // Extraemos el ID, nombre y apellido del miembro
                                                                                                $id_miembro_tabla = $miembro['id_miembro'];
                                                                                                $nombre_miembro_tabla = $miembro['nombre'];
                                                                                                $apellido_miembro_tabla = $miembro['apellido'];

                                                                                                // Concatenamos nombre y apellido
                                                                                                $nombre_completo = $nombre_miembro_tabla . ' ' . $apellido_miembro_tabla;

                                                                                                // Verificamos si esta opción está seleccionada actualmente basándonos en el ID
                                                                                                $selected = ($datos_pago['id_miembro'] == $id_miembro_tabla) ? 'selected' : '';
                                                                                            ?>
                                                                                                <option value="<?php echo $id_miembro_tabla; ?>" <?php echo $selected; ?>>
                                                                                                    <?php echo $nombre_completo; ?>
                                                                                                </option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>


                                                                                        <small style="color: red; display: none;" id="lbl_id_miembro<?php echo $id_pago; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">monto<b>*</b></label>
                                                                                    <input type="text" id="monto<?php echo  $id_pago; ?>" value="<?php echo $datos_pago['monto']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_monto<?php echo  $id_pago; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">metodo de pago <b>*</b></label>
                                                                                    <input type="text" id="metodo_pago<?php echo $id_pago; ?>" value="<?php echo $datos_pago['metodo_pago']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_metodo_pago<?php echo $id_pago; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Fecha de pago <b>*</b></label>
                                                                                    <input type="date" id="fecha_pago<?php echo $id_pago; ?>" value="<?php echo $datos_pago['fecha_pago']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_fecha_pago<?php echo $id_pago; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>

                                                                        </div>


                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-success" id="btn_update<?php echo $id_pago; ?>">Actualizar</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                            <script>
                                                                $('#btn_update<?php echo $id_pago; ?>').click(function() {

                                                                    var id_pago = '<?php echo $id_pago; ?>';
                                                                    var id_miembro = $('#id_miembro<?php echo $id_pago; ?>').val();
                                                                    var monto = $('#monto<?php echo $id_pago; ?>').val();
                                                                    var metodo_pago = $('#metodo_pago<?php echo $id_pago; ?>').val();
                                                                    var fecha_pago = $('#fecha_pago<?php echo $id_pago; ?>').val();


                                                                    if (id_miembro == "") {
                                                                        $('#id_miembro<?php echo $id_pago; ?>').focus();
                                                                        $('#lbl_id_miembro<?php echo $id_pago; ?>').css('display', 'block');
                                                                    } else if (monto == "") {
                                                                        $('#monto<?php echo $id_pago; ?>').focus();
                                                                        $('#lbl_monto<?php echo $id_pago; ?>').css('display', 'block');
                                                                    } else if (metodo_pago == "") {
                                                                        $('#metodo_pago<?php echo $id_pago; ?>').focus();
                                                                        $('#lbl_metodo_pago<?php echo $id_pago; ?>').css('display', 'block');
                                                                    } else if (fecha_pago == "") {
                                                                        $('#fecha_pago<?php echo $id_pago; ?>').focus();
                                                                        $('#lbl_fecha_pago<?php echo $id_pago; ?>').css('display', 'block');
                                                                    } else {
                                                                        var url = "../app/controllers/pago/update.php";
                                                                        $.get(url, {
                                                                            id_pago: id_pago,
                                                                            id_miembro: id_miembro,
                                                                            monto: monto,
                                                                            metodo_pago: metodo_pago,
                                                                            fecha_pago: fecha_pago

                                                                        }, function(datos) {
                                                                            $('#respuesta_update<?php echo $id_pago; ?>').html(datos);
                                                                        });
                                                                    }
                                                                });
                                                            </script>
                                                            <div id="respuesta_update<?php echo $id_pago; ?>"></div>
                                                        </div>
                                                    </div>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modal-delete<?php echo $id_pago; ?>">
                                                            <i class="fa fa-trash"></i> Borrar
                                                        </button>
                                                        <!-- modal para borrar proveedore -->
                                                        <div class="modal fade" id="modal-delete<?php echo $id_pago; ?>">
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
                                                                        <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_pago; ?>">Eliminar</button>
                                                                    </div>
                                                                    <div id="respuesta_delete<?php echo $id_pago; ?>"></div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                        <script>
                                                            $('#btn_delete<?php echo $id_pago; ?>').click(function() {

                                                                var id_pago = '<?php echo $id_pago; ?>';

                                                                var url2 = "../app/controllers/pago/delete.php";
                                                                $.get(url2, {
                                                                    id_pago: id_pago
                                                                }, function(datos) {
                                                                    $('#respuesta_delete<?php echo $id_pago; ?>').html(datos);
                                                                });


                                                            });
                                                        </script>

                                                    </div>
                                                </center>
                                            </td>
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
<!-- modal para registrar miembros-------------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1d36b6;color: white">
                <h4 class="modal-title">Creación de un nuevo pago</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">nombre</label>
                            <select id="id_miembro" class="form-control">
                                <option value="">Seleccione un miembro</option>
                                <?php
                                // Conexión y consulta a la tabla miembros para obtener id, nombre y apellido
                                $query_miembros = $pdo->query("SELECT id_miembros, nombre, apellido FROM miembros");
                                $miembros = $query_miembros->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($miembros as $miembro) {
                                    // Concatenamos el nombre y el apellido
                                    $nombre_completo = $miembro['nombre'] . ' ' . $miembro['apellido'];
                                    echo "<option value='" . $miembro['id_miembros'] . "'>" . $nombre_completo . "</option>";
                                }
                                ?>
                            </select>

                            <small style="color: red;display: none" id="lbl_id_miembro">* Este campo es requerido</small>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">monto <b>*</b></label>
                            <input type="text" id="monto" class="form-control">
                            <small style="color: red;display: none" id="lbl_monto">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">metodo pago<b>*</b></label>
                            <input type="text" id="metodo_pago" class="form-control">
                            <small style="color: red;display: none" id="lbl_metodo_pago">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">fecha de pago<b>*</b></label>
                            <input type="date" id="fecha_pago" class="form-control">
                            <small style="color: red;display: none" id="lbl_fecha_pago">* Este campo es requerido</small>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar pago</button>
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
        var id_miembro = $('#id_miembro').val();
        var monto = $('#monto').val();
        var metodo_pago = $('#metodo_pago').val();
        var fecha_pago = $('#fecha_pago').val();


        if (id_miembro == "") {
            $('#id_miembro').focus();
            $('#lbl_id_miembro').css('display', 'block');
        } else if (monto == "") {
            $('#monto').focus();
            $('#lbl_monto').css('display', 'block');
        } else if (metodo_pago == "") {
            $('#metodo_pago').focus();
            $('#lbl_metodo_pago').css('display', 'block');
        } else if (fecha_pago == "") {
            $('#fecha_pago').focus();
            $('#lbl_fecha_pago').css('display', 'block');
        } else {
            var url = "../app/controllers/pago/create.php";
            $.get(url, {
                id_miembro: id_miembro,
                monto: monto,
                metodo_pago: metodo_pago,
                fecha_pago: fecha_pago

            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------->

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