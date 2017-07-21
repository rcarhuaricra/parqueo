
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->


    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php
            foreach ($usuario->result() as $fila1) {
                ?>
                <div class="pull-left image">
                    <img src="<?php echo base_url(); ?>recursos/dist/img/user.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>
                        <?php
                        echo $fila1->user_ape_pat . ' ';
                        ?>
                    </p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            <?php } ?>
            
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        
        <ul class="sidebar-menu">
            <li>
                <a>
                    <i class="fa fa-automobile "></i> <span>VEHICULOS</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="<?php echo $nuevo; ?>">
                <a href="<?php echo base_url(); ?>parqueador/nuevo">
                    <i class="fa fa-circle-o text-green"></i> <span>Nuevo</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green"><span class="ion-plus-round"></span></small>
                    </span>
                </a>
            </li>
            <li class="<?php echo $estacionado; ?>">
                <a href="<?php echo base_url(); ?>parqueador/estacionados">
                    <i class="fa fa-circle-o text-aqua"></i> <span>Estacionados</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-blue"></small>
                    </span>
                </a>
            </li>
            <li class="<?php echo $deposito; ?>">
                <a href="<?php echo base_url(); ?>parqueador/deposito">
                    <i class="fa fa-circle-o text-red"></i> <span>Deposito</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red"></small>
                    </span>
                </a>
            </li>
             <li class="<?php echo $culminado; ?>">
                <a href="<?php echo base_url(); ?>parqueador/culminados">
                    <i class="fa fa-circle-o text-yellow"></i> <span>culminados</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-black"></small>
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->

</aside>
