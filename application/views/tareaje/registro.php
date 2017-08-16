<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tareaje 
            <small>Parqueadores</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Registrar Horarios de Parqueadores:
                        </h3>
                        <h3 class="box-title pull-right"> 
                            <strong><?php echo HORA_ACTUAL; ?></strong> <a href="<?php echo base_url(); ?>tareaje/editarTareaje" class="btn btn-app bg-yellow"><span class="fa fa-edit"></span> Editar Tareaje</a>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-lg-offset-2 col-lg-8">

                            <form class="row" id="datosTareaje">
                                <div class="col-lg-6">
                                    <div class="form-group has-feedback">
                                        <select class="form-control" style="text-transform:uppercase;"  name="mes" id="mes" required>
                                            <?php
                                            foreach ($meses as $clave => $valor) {
                                                IF ($clave > MES_ACTUAL - 1) {
                                                    echo "<option value='$clave'>$valor</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="fa fa-calendar-check-o form-control-feedback"></span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group has-feedback ">
                                        <select class="form-control" name="horario" id="horario" required>
                                            <option value="0">[selecciones Horario]</option>
                                            <?php
                                            foreach ($Buscaturno->result() as $fila1) {
                                                echo "<option value='$fila1->id_turno'>$fila1->txt_turno</option>";
                                            }
                                            ?>
                                        </select>
                                        <span class="fa fa-clock-o form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-lg-offset-4">
                                    <button type="button" class="btn btn-success btn-block" id="btnCargar" name="btnCargar">iniciar</button>
                                </div>
                            </form>
                        </div>
                        <div id="TablaTareaje" class="col-lg-12 table-responsive">

                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<script>
    $("#btnCargar").click(function () {
        var correcto = true;
        var hoy = new Date();
        var mm = hoy.getMonth() + 1; //hoy es 0!        
        if ($("#horario").val() === '0') {
            swal({title: "Alto!", text: "Seleccione un Horario valido", timer: 2500});

            $("#horario").focus();
            $("#TablaTareaje").html('');
            correcto = false;
        }
        if ($("#mes").val() === '0') {
            hoy = mm;
            swal({title: "Alto!", text: hoy, timer: 2500});
            correcto = false;
            $("#mes").focus();
        }

        if (correcto) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>tareaje/tablaTareaje',
                data: $('#datosTareaje').serialize(),
                success: function (response) {
                    
                    console.log(response);
                    $("#TablaTareaje").html(response);
                }
            });
        }

    });
</script>
