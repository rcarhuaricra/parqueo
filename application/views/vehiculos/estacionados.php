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
                            <strong><?php echo HORA_ACTUAL; ?></strong>
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
                                foreach ($vehiculos->result() as $fila1) {
                                    $i = HORA_ACTUAL;
                                    $f = $fila1->horafinal;
                                    $datetime1 = new DateTime($f);
                                    $datetime2 = new DateTime($i);
                                    $interval = $datetime2->diff($datetime1);
                                    if ($interval->format('%R') == "+") {
                                        echo "<tr class='success' id='tr$fila1->idvehiculo'>";
                                    } else {
                                        echo "<tr class='danger' id='tr$fila1->idvehiculo'>";
                                    }
                                    echo "<td>" . $fila1->placa . "</td>";
                                    echo "<td>" . $fila1->horainicio . "</td>";
                                    echo "<td>" . $fila1->horafinal . "</td>";
                                    echo "<td>";
                                    echo $interval->format('%R %h:%i:%S horas');
                                    echo "</td>";
                                    echo "<td>";
                                    $date = new DateTime($fila1->horainicio);
                                    //echo $date->format('H:i:s');
                                    //echo "<br>";
                                    //echo date('H:s:i', strtotime($date->format('H:i:s') . '+ 30 minutes'));
                                    ?>
                                <button class="btn btn-danger btn-lg" onclick="button('anulado', '<?php echo $fila1->placa; ?>', '<?php echo $fila1->idvehiculo; ?>');" id_evento="anulado" name="<?php echo $fila1->placa; ?>" id="<?php echo $fila1->idvehiculo; ?>" title="Anular">
                                    <span class="ion-trash-a" style="font-size: 1.3em;"></span>
                                </button>
                                <button class="btn btn-primary btn-lg" onclick="button('culminado', '<?php echo $fila1->placa; ?>', '<?php echo $fila1->idvehiculo; ?>');" id_evento="culminado" name="<?php echo $fila1->placa; ?>" id="<?php echo $fila1->idvehiculo; ?>" title="Culminar">
                                    <span class="icon-auto" style="font-size: 1.4em;"></span>
                                </button>
                                <button class="btn btn-success btn-lg" onclick="button('remolcado', '<?php echo $fila1->placa; ?>', '<?php echo $fila1->idvehiculo; ?>');" id_evento="remolcado" name="<?php echo $fila1->placa; ?>" id="<?php echo $fila1->idvehiculo; ?>"  title="Remolcar">
                                    <span class="icon-grua" style="font-size: 1.4em;"></span>
                                </button>
                                <a href="<?php echo base_url(); ?>parqueador/imprimir/<?php echo $fila1->idvehiculo; ?>" class="btn btn-warning btn-lg" name="<?php echo $fila1->placa; ?>" id="<?php echo $fila1->idvehiculo; ?>"  title="Imprimir">
                                    <span class="fa fa-print" style="font-size: 1.4em;"></span>
                                </a>

                                <?php
                                echo "</td>";
                                echo "</tr>";
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
</script>
