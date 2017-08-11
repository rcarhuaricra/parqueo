
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registrar Ingreso 
            <small> Ingresar un Nuevo vehiculo estacionado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Ingresar los datos indicados en el formulario</h3>
                        <?php
                        echo $_SESSION['idtareaje'];
                        echo $_SESSION['calle'];
                        ?>
                    </div>
                    <div class=" box-body">
                        <!-- /.box-header -->
                        <div class="register-box panel panel-default">
                            <div class="box-header">
                                <h4>
                                    <?php
                                    echo $_SESSION['calle'];
                                    ?>
                                </h4>
                            </div>
                            <div class="register-box-body">
                                <form action="<?php echo base_url() ?>parqueador/guardar" method="post">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control input-lg texto-placa" style="text-transform:uppercase;" placeholder="INGRESE PLACA" name="placa" id="placa" required/>
                                        <span class="ion-model-s form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback ">
                                        <span class="glyphicon glyphicon-road form-control-feedback "></span>
                                        <select class="form-control input-lg" name="lado" id="lado" required>
                                            <option value="">[selecciones lado]</option>
                                            <option value="P">PAR</option>
                                            <option value="I">IMPAR</option>                                           
                                        </select>
                                    </div>
                                    <div class="form-group has-feedback ">                                        
                                        <input type="text" class="form-control input-lg solo-numero" style="text-transform:uppercase;" placeholder="Número de Estacionamiento" name="estacionamiento" id="estacionamiento   " required/>
                                    </div>
                                    <div class="form-group">                   
                                        <button type="submit" class="btn btn-primary btn-block btn-flat"><span class="ion-plus-round"></span> Registrar</button>                    
                                    </div>
                                    <div class="form-group">                   
                                        <a href="<?php echo base_url(); ?>" class="btn btn-danger btn-block btn-flat"> <span class="ion-reply"></span> Volver</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


