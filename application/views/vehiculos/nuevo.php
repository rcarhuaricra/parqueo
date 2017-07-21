<div class="register-box panel panel-default">
    <div class="register-logo">
        <a><b>Registrar</b>Placa</a>
    </div>
    <div class="register-box-body">
        <p class="login-box-msg">Registrar Estacionamiento</p>
        <form action="<?php echo base_url() ?>parqueador/guardar" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" style="text-transform:uppercase;" placeholder="INGRESE PLACA" name="placa" id="placa" required/>
                <span class="ion-model-s form-control-feedback"></span>
            </div>
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

            <div class="form-group">                   
                <button type="submit" class="btn btn-primary btn-block btn-flat"><span class="ion-plus-round"></span> Registrar</button>                    
                <!-- /.col -->
            </div>
            <div class="form-group">                   
                <a href="<?php echo base_url(); ?>" class="btn btn-danger btn-block btn-flat"> <span class="ion-reply"></span> Volver</a>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.form-box -->

</div>
