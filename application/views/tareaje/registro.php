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
                            <strong><?php echo HORA_ACTUAL; ?></strong>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <select class="form-control" style="text-transform:uppercase;"  name="mes" id="mes" required>
                                            <option value="">[selecciones Mes]</option>
                                            <?php
                                            foreach ($meses as $clave => $valor) {
                                                echo "<option value='$clave'>$valor</option>";
                                            }
                                            ?>
                                        </select>
                                        <span class="fa fa-calendar-check-o form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-road form-control-feedback"></span>
                                        <select class="form-control" name="via" id="via" required>
                                            <option value="">[selecciones Calle]</option>
                                            <?php
                                            foreach ($via->result() as $fila1) {
                                                ?>
                                                <option value="<?php echo $fila1->codvia ?>"><?php
                                                    echo $fila1->tipoVia . ' ' . $fila1->nombrevia;
                                                    ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback ">
                                        <select class="form-control" name="horario" id="horario" required>
                                            <option value="">[selecciones Horario]</option>
                                            <?php
                                            foreach ($Buscaturno->result() as $fila1) {
                                                echo "<option value='$fila1->idturno'>$fila1->txt_turno</option>";
                                            }
                                            ?>
                                        </select>
                                        <span class="fa fa-clock-o form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback ">
                                <select class="form-control" multiple="multiple"  name="usuario" id="usuario" required>
                                    <option value="">[selecciones Horario]</option>
                                    <?php
                                    foreach ($BuscaParquedor->result() as $fila1) {
                                        echo "<option value='$fila1->iduser'>$fila1->USER</option>";
                                    }
                                    ?>
                                </select>
                                <span class="fa fa-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control " style="text-transform:uppercase;" placeholder="CUADRA DESIGNADA" name="cuadra" id="cuadra" required/>
                                <span class="fa fa-map-signs form-control-feedback"></span>
                            </div> 



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>

    $(document).ready(function () {
        $("#usuario").select2();
    });
</script>
</script>
