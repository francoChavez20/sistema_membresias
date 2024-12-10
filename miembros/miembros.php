<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');


include('../app/controllers/miembros/listado_miembros.php');
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
                    <h1 class="m-0">listado de miembros
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                        </button>
                       
                    <a href="../fpdf/PruebaH.php" target="_blank" class="btn btn-primary m-2"><i class="fas fa-file-pdf"></i> Generar reporte</a>
                
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
                <div class="col-md-12 ">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">miembros registrados</h3>

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
                                        <th>Dni</th>
                                        <th>telefono</th>
                                        <th>tipo de membresía</th>
                                        <th>estado</th>
                                        <th>comienzo</th>
                                        <th>final</th>
                                        <th>acciones</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $contador = 0;
                                    foreach ($datos_miembros as $datos_miembros) {
                                        $id_miembro = $datos_miembros['id_miembro'];
                                        $nombre_miembros = $datos_miembros['nombre'];

                                        // Convertir las fechas de comienzo y finalización a formato DateTime
                                        $fecha_comienzo = new DateTime($datos_miembros['fecha_comienzo']);
                                        $fecha_final = new DateTime($datos_miembros['fecha_final']);
                                        $fecha_actual = new DateTime(); // Fecha actual

                                        // Comparar las fechas para determinar el estado
                                        if ($fecha_actual < $fecha_final) {
                                            $estado_membresia = '<span class="badge badge-success">Vigente</span>';
                                            $estado_membresias = 'Vigente';
                                        } else {
                                            $estado_membresia = '<span class="badge badge-danger">Finalizado</span>';
                                            $estado_membresias = 'Finalizado';
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $contador = $contador + 1 ?></td>
                                            <td><?php echo htmlspecialchars($datos_miembros['nombre']) . ' ' . htmlspecialchars($datos_miembros['apellido']); ?></td>
                                            <td><?php echo htmlspecialchars($datos_miembros['dni']); ?></td>
                                            <td><?php echo htmlspecialchars($datos_miembros['telefono']); ?></td>
                                            <td><?php echo htmlspecialchars($datos_miembros['tipo_membresia']); ?></td>
                                            <td><?php echo $estado_membresia; ?></td>
                                            <td><?php echo htmlspecialchars($datos_miembros['fecha_comienzo']); ?></td>
                                            <td><?php echo htmlspecialchars($datos_miembros['fecha_final']); ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal-update<?php echo $id_miembro; ?>">
                                                            <i class="fa fa-pencil-alt"></i> Editar
                                                        </button>
                                                        <!-- Modal para actualizar miembro -->
                                                        <div class="modal fade" id="modal-update<?php echo $id_miembro; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #116f4a;color: white">
                                                                        <h4 class="modal-title">Actualización del miembro</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Nombre <b>*</b></label>
                                                                                    <input type="text" id="nombre<?php echo $id_miembro; ?>" value="<?php echo $nombre_miembros; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_nombre<?php echo $id_miembro; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Apellido <b>*</b></label>
                                                                                    <input type="text" id="apellido<?php echo $id_miembro; ?>" value="<?php echo $datos_miembros['apellido']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_apellido<?php echo $id_miembro; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">DNI <b>*</b></label>
                                                                                    <input type="text" id="dni<?php echo $id_miembro; ?>" value="<?php echo $datos_miembros['dni']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_dni<?php echo $id_miembro; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Teléfono</label>
                                                                                    <input type="text" id="telefono<?php echo $id_miembro; ?>" value="<?php echo $datos_miembros['telefono']; ?>" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6">

                                                                                <div class="form-group">
                                                                                    <label for="">Membresía</label>
                                                                                    <div style="display: flex">

                                                                                        <select name="id_membresia" id="id_membresia<?php echo $id_miembro; ?>" class="form-control" required>
                                                                                            <?php
                                                                                            foreach ($datos_membresia as $membresia) {
                                                                                                // Extraemos el ID y el nombre de la membresía
                                                                                                $id_membresia_tabla = $membresia['id_membresia'];
                                                                                                $nombre_membresia_tabla = $membresia['nombre'];

                                                                                                // Verificamos si esta membresía está seleccionada actualmente
                                                                                                $selected = ($datos_miembros['tipo_membresia'] ==  $nombre_membresia_tabla) ? 'selected' : '';
                                                                                            ?>
                                                                                                <option value="<?php echo $id_membresia_tabla; ?>" <?php echo $selected; ?>>
                                                                                                    <?php echo $nombre_membresia_tabla; ?>
                                                                                                </option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                        <small style="color: red; display: none;" id="lbl_id_membresia<?php echo $id_miembro; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>

                                                                            </div>






                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Estado de Membresía <b>*</b></label>
                                                                                    <input type="text" id="estado_membresia<?php echo $id_miembro; ?>" value="<?php echo $estado_membresias; ?>" readonly class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_estado_membresia<?php echo $id_miembro; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Fecha de Comienzo <b>*</b></label>
                                                                                    <input type="date" id="fecha_comienzo<?php echo $id_miembro; ?>" value="<?php echo $datos_miembros['fecha_comienzo']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_fecha_comienzo<?php echo $id_miembro; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Fecha Final <b>*</b></label>
                                                                                    <input type="date" id="fecha_final<?php echo $id_miembro; ?>" value="<?php echo $datos_miembros['fecha_final']; ?>" class="form-control">
                                                                                    <small style="color: red;display: none" id="lbl_fecha_final<?php echo $id_miembro; ?>">* Este campo es requerido</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_miembro; ?>">Actualizar</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                        <script>
                                                            $('#btn_update<?php echo $id_miembro; ?>').click(function() {

                                                                var id_miembro = '<?php echo $id_miembro; ?>';
                                                                var nombre = $('#nombre<?php echo $id_miembro; ?>').val();
                                                                var apellido = $('#apellido<?php echo $id_miembro; ?>').val();
                                                                var dni = $('#dni<?php echo $id_miembro; ?>').val();
                                                                var telefono = $('#telefono<?php echo $id_miembro; ?>').val();
                                                                var id_membresia = $('#id_membresia<?php echo $id_miembro; ?>').val();
                                                                var estado_membresia = $('#estado_membresia<?php echo $id_miembro; ?>').val();
                                                                var fecha_comienzo = $('#fecha_comienzo<?php echo $id_miembro; ?>').val();
                                                                var fecha_final = $('#fecha_final<?php echo $id_miembro; ?>').val();

                                                                if (nombre == "") {
                                                                    $('#nombre<?php echo $id_miembro; ?>').focus();
                                                                    $('#lbl_nombre<?php echo $id_miembro; ?>').css('display', 'block');
                                                                } else if (apellido == "") {
                                                                    $('#apellido<?php echo $id_miembro; ?>').focus();
                                                                    $('#lbl_apellido<?php echo $id_miembro; ?>').css('display', 'block');
                                                                } else if (dni == "") {
                                                                    $('#dni<?php echo $id_miembro; ?>').focus();
                                                                    $('#lbl_dni<?php echo $id_miembro; ?>').css('display', 'block');
                                                                } else if (telefono == "") {
                                                                    $('#telefono<?php echo $id_miembro; ?>').focus();
                                                                    $('#lbl_telefono<?php echo $id_miembro; ?>').css('display', 'block');
                                                                } else if (id_membresia == "") {
                                                                    $('#id_membresia<?php echo $id_miembro; ?>').focus();
                                                                    $('#lbl_id_membresia<?php echo $id_miembro; ?>').css('display', 'block');
                                                                } else if (estado_membresia == "") {
                                                                    $('#estado_membresia<?php echo $id_miembro; ?>').focus();
                                                                    $('#lbl_estado_membresia<?php echo $id_miembro; ?>').css('display', 'block');
                                                                } else if (fecha_comienzo == "") {
                                                                    $('#fecha_comienzo<?php echo $id_miembro; ?>').focus();
                                                                    $('#lbl_fecha_comienzo<?php echo $id_miembro; ?>').css('display', 'block');
                                                                } else if (fecha_final == "") {
                                                                    $('#fecha_final<?php echo $id_miembro; ?>').focus();
                                                                    $('#lbl_fecha_final<?php echo $id_miembro; ?>').css('display', 'block');
                                                                } else {
                                                                    var url = "../app/controllers/miembros/update.php";
                                                                    $.get(url, {
                                                                        id_miembro: id_miembro,
                                                                        nombre: nombre,
                                                                        apellido: apellido,
                                                                        dni: dni,
                                                                        telefono: telefono,
                                                                        id_membresia: id_membresia,
                                                                        estado_membresia: estado_membresia,
                                                                        fecha_comienzo: fecha_comienzo,
                                                                        fecha_final: fecha_final
                                                                    }, function(datos) {
                                                                        $('#respuesta_update<?php echo $id_miembro; ?>').html(datos);
                                                                    });
                                                                }
                                                            });
                                                        </script>
                                                        <div id="respuesta_update<?php echo $id_miembro; ?>"></div>
                                                    </div>


                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modal-delete<?php echo $id_miembro; ?>">
                                                            <i class="fa fa-trash"></i> Borrar
                                                        </button>
                                                        <!-- modal para borrar proveedore -->
                                                        <div class="modal fade" id="modal-delete<?php echo $id_miembro; ?>">
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
                                                                        <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_miembro; ?>">Eliminar</button>
                                                                    </div>
                                                                    <div id="respuesta_delete<?php echo $id_miembro; ?>"></div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                        <script>
                                                            $('#btn_delete<?php echo $id_miembro; ?>').click(function() {

                                                                var id_miembro = '<?php echo $id_miembro; ?>';

                                                                var url2 = "../app/controllers/miembros/delete.php";
                                                                $.get(url2, {
                                                                    id_miembro: id_miembro
                                                                }, function(datos) {
                                                                    $('#respuesta_delete<?php echo $id_miembro; ?>').html(datos);
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
                <h4 class="modal-title">Creación de un nuevo miembro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nombre del miembro <b>*</b></label>
                            <input type="text" id="nombre" class="form-control">
                            <small style="color: red;display: none" id="lbl_nombre">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Apellido <b>*</b></label>
                            <input type="text" id="apellido" class="form-control">
                            <small style="color: red;display: none" id="lbl_apellido">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">dni <b>*</b></label>
                            <input type="text" id="dni" class="form-control">
                            <small style="color: red;display: none" id="lbl_dni">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Teléfono</label>
                            <input type="text" id="telefono" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tipo de membresía</label>
                            <select id="id_membresia" class="form-control">
                                <option value="">Selecciona una membresía</option>
                                <?php
                                // Conexión y consulta a la tabla tipo_membresia
                                $query_membresias = $pdo->query("SELECT id_membresia, nombre FROM tipo_membresia");
                                $membresias = $query_membresias->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($membresias as $membresia) {
                                    echo "<option value='" . $membresia['id_membresia'] . "'>" . $membresia['nombre'] . "</option>";
                                }
                                ?>
                            </select>
                            <small style="color: red;display: none" id="lbl_id_membresia">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Estado de membresía <b>*</b></label>
                            <input type="text" id="estado_membresia" class="form-control" value="vigente" readonly>
                            <small style="color: red; display: none" id="lbl_estado_membresia">* Este campo es requerido</small>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">fecha comienzo</label>
                            <input type="date" id="fecha_comienzo" class="form-control">
                            <small style="color: red;display: none" id="lbl_fecha_comienzo">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">fecha de final <b>*</b></label>
                            <input type="date" id="fecha_final" class="form-control">
                            <small style="color: red;display: none" id="lbl_fecha_final">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar miembro</button>
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
        var apellido = $('#apellido').val();
        var dni = $('#dni').val();
        var telefono = $('#telefono').val();
        var id_membresia = $('#id_membresia').val();
        var estado_membresia = $('#estado_membresia').val();
        var fecha_comienzo = $('#fecha_comienzo').val();
        var fecha_final = $('#fecha_final').val();

        if (nombre == "") {
            $('#nombre').focus();
            $('#lbl_nombre').css('display', 'block');
        } else if (apellido == "") {
            $('#apellido').focus();
            $('#lbl_apellido').css('display', 'block');
        } else if (dni == "") {
            $('#dni').focus();
            $('#lbl_dni').css('display', 'block');
        } else if (id_membresia == "") {
            $('#id_membresia').focus();
            $('#lbl_id_membresia').css('display', 'block');
        } else if (estado_membresia == "") {
            $('#estado_membresia').focus();
            $('#lbl_estado_membresia').css('display', 'block');
        } else {
            var url = "../app/controllers/miembros/create.php";
            $.get(url, {
                nombre: nombre,
                apellido: apellido,
                dni: dni,
                telefono: telefono,
                id_membresia: id_membresia,
                estado_membresia: estado_membresia,
                fecha_comienzo: fecha_comienzo,
                fecha_final: fecha_final
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php include('../layout/parte2.php'); ?>

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