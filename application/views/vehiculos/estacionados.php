<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Velículos 
            <small>Estacionados</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Vehículos estacionados el dia de hoy
                        </h3>
                        <h3 class="box-title pull-right"> 
                            <strong><?php
                                echo HORA_ACTUAL;
                                ?></strong>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table" class="table table-hover table-bordered dt-responsive " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Tiempo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($vehiculos as $fila) {

                                    if ($fila->diferencia > '-00:15:00' && $fila->diferencia < '00:00:00') {
                                        echo "<tr class='danger odd'>";
                                    } else if ($fila->diferencia < '00:00:00') {
                                        echo "<tr class='warning odd'>";
                                    } else {
                                        echo "<tr class='success odd'>";
                                    }
                                    echo "<td>$fila->placa</td>";
                                    echo "<td>$fila->horainicio</td>";
                                    echo "<td>$fila->horafinal</td>";
                                    echo "<td>$fila->diferencia</td>";
                                    echo "<td>";
                                    if ($fila->diferencia > '-00:15:00' && $fila->diferencia < '00:00:00') {
                                        ?>
                                    <a class="btn btn-app bg-blue" id="estado" id-vehiculo="<?php echo $fila->idvehiculo ?>" id-estado="<?php echo CULMINADO_CON_INFRACCION; ?>">
                                        <i class="fa icon-auto"></i> Culminar 
                                    </a>
                                    <?php
                                } else if ($fila->diferencia < '00:00:00') {
                                    ?> 
                                    <a class="btn btn-app bg-blue-active" id="estado" id-vehiculo="<?php echo $fila->idvehiculo ?>" id-estado="<?php echo CULMINADO_A_TIEMPO; ?>">
                                        <i class="fa icon-auto"></i> Culminar 
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="btn btn-app bg-blue-active" id="estado" id-vehiculo="<?php echo $fila->idvehiculo ?>" id-estado="<?php echo CULMINADO_A_TIEMPO; ?>">
                                        <i class="fa icon-auto"></i> Culminar 
                                    </a>

                                    <?php
                                }
                                ?>





                                <a href="<?php echo base_url(); ?>parqueador/imprimirPDF/<?php echo $fila->idvehiculo; ?>" class="btn btn-app bg-yellow">
                                    <i class="fa fa-print"></i> Imprimir
                                </a>


                                <?php
                            }
                            ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script>

    $('a#estado').click(function () {
        var ida = $(this).attr('id');
        var id = $(this).attr('id-vehiculo');
        var estado = $(this).attr('id-estado');
        swal({
            title: "El Vehículo se retira!",
            showCancelButton: true,
            confirmButtonColor: "#004974",
            confirmButtonText: "Si, Concluir!",
            cancelButtonText: "No, cancelar!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url(); ?>parqueador/updateEstados',
                        data: {
                            "id": id,
                            "estado": estado
                        },
                        success: function (response) {
                            location.reload();
                        }
                    });

                });

    });


    function button(event, plac, idreg) {

        var id = idreg;
        var placa = plac;
        var evento = event;
        var request;
        if (request) {
            request.abort();
        }
        switch (evento) {
            case "anulado":
                var titulo = "¿Seguro que desea anular?";
                var texto = "Esta a punto de anular el registro con placa <strong>" + placa + "</strong>";
                var color = "#DD6B55";
                var tituloConfir = "Anulado";
                break;
            case "culminado":
                var titulo = "¿Seguro que desea culminar?";
                var texto = "El Vehiculo con placa <strong>" + placa + "</strong> esta saliendo del parqueo";
                var color = "#3C8DBC";
                var tituloConfir = "Culminado";
                break;
            case "remolcado":
                var titulo = "¿Seguro que desea Remolcar?";
                var texto = "El Vehiculo con placa <strong>" + placa + "</strong> esta siendo Remolcado";
                var color = "#00A65A";
                var tituloConfir = "Remolcado";
                break;
        }

        swal({
            title: titulo,
            text: texto,
            html: true,
            showCancelButton: true,
            confirmButtonColor: color,
            confirmButtonText: "Si, Confirmar!",
            cancelButtonText: "No, Cancelar!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
                function (isConfirm) {
                    if (isConfirm) {
                        request = $.ajax({
                            url: "<?php echo base_url(); ?>parqueador/" + evento,
                            type: "POST",
                            data: "id=" + id
                        });
                        request.done(function (response, textStatus, jqXHR) {
                            swal({
                                title: tituloConfir,
                                text: "el registro con placa <strong>" + placa + "</strong> ha sido " + tituloConfir,
                                html: true,
                                timer: 2000
                            });
                            //alert("aaaa");
                            //alert("#tr" + response);
                            //$("#tr" + response).html("");
                            location.reload();
                        });
                        request.fail(function (jqXHR, textStatus, thrown) {
                            swal({
                                title: textStatus,
                                text: "el registro con placa <strong>" + placa + "</strong> no ha sido anulado",
                                html: true

                            });
                            //$("#" + response).html("");
                        });
                        request.always(function () {
                            //alert('termino todo');
                        });

                    }
                });
    }
    ;
    $('#table').DataTable({
        "paging": true,
        "ordering": true,
        "order": [[2, "asc"]],
        "info": true,
        "searching": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
        //"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]

    });
</script>
