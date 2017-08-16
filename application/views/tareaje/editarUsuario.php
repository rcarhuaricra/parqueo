<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Usuario Tareaje 
            <small>Serenos de Transito</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url();?>tareaje/actualizar">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"> </label>
                        <div class="col-sm-10 ">
                            <p><strong>Fecha tarea: </strong><?php echo $usuario->fecha_tarea; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"> </label>
                        <div class="col-sm-10 ">
                            <p><strong>Turno de tarea: </strong><?php echo $usuario->txt_turno; ?></p>
                        </div>
                        <input type="hidden" value="<?php echo $iduser; ?>" name="id" id="id">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Sereno A asignar</label>

                        <div class="col-sm-10">
                            <select  name="usuario" id="usuario" class="form-control select" style="min-width: 250px" required="">
                                <?php
                                foreach ($usuarios as $value) {
                                    if ($value->iduser == $usuario->iduser) {
                                        echo "<option value='$value->iduser' selected>$value->user_name $value->user_ape_pat $value->user_ape_mat</option>";
                                    } else {
                                        echo "<option value='$value->iduser' >$value->user_name $value->user_ape_pat $value->user_ape_mat</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">                    
                    <button type="submit" class="btn btn-info pull-right">Guardar</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </section>
</div>
