<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Tareaje 
            <small>Serenos de Transito</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box-header -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Registrar Horarios de Parqueadores:
                        </h3>
                        <h3 class="box-title pull-right"> 
                            <strong><?php echo HORA_ACTUAL; ?></strong>
                        </h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" id="fechaEdicion">
                            <div class="form-group col-sm-7">
                                <label for="txtFecha" class="col-sm-3 control-label">Fecha:</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar" ></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" id="txtFecha" name="txtFecha" placeholder="Fecha a Editar">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-7">
                                <label for="calle" class="col-sm-3 control-label">Calle:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="calle" id="calle">
                                        <option value="">[Seleccione Calle]</option>
                                        <?php
                                        foreach ($calles as $calle) {
                                            echo "<option value='$calle->codvia'>$calle->tipoVia $calle->nombrevia</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-7">
                                <label for="calle" class="col-sm-3 control-label">Horario:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="horario" id="horario" required>
                                        <option value="0">[selecciones Horario]</option>
                                        <?php
                                        foreach ($Buscaturno->result() as $fila1) {
                                            echo "<option value='$fila1->id_turno'>$fila1->txt_turno</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-5">
                                <button type="button" id="btnFiltrar" name="btnFiltrar" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer" id="edicionTareaje">

                    </div>
                </div>
            </div>
    </section>
</div>
<script>
    $("#btnFiltrar").click(function () {
        var correcto = true;
        if ($("#txtFecha").val() === '') {
            swal({title: "Seleccione una fecha Valida!", timer: 2000});
            $("#txtFecha").focus();
            $("#TablaTareaje").html('');
            correcto = false;
        }
        if ($("#calle").val() === '') {
            swal({title: "Seleccione una Calle Valida!", timer: 2000});
            $("#txtFecha").focus();
            $("#TablaTareaje").html('');
            correcto = false;
        }
        if (correcto) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>tareaje/tablaTareajeEdicion',
                data: $('#fechaEdicion').serialize(),
                success: function (response) {
                    console.log(response);
                    $("#edicionTareaje").html(response);
                }
            });
        }

    });

</script>
