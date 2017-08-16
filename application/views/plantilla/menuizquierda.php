
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->


    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left ">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x text-red "></i>
                    <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                </span>
            </div>
            <div class="pull-left info">
                <p>
                    <?php
                    echo $_SESSION['email']
                    ?>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
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
                <a href="<?php echo base_url(); ?>parqueador/listardeposito">
                    <i class="fa fa-circle-o text-red"></i> <span>Deposito</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red"></small>
                    </span>
                </a>
            </li>
            <li class="<?php echo $culminado; ?>">
                <a href="<?php echo base_url(); ?>parqueador/listarculminados">
                    <i class="fa fa-circle-o text-yellow"></i> <span>culminados</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-black"></small>
                    </span>
                </a>
            </li>
            <li class="<?php echo $tareaje; ?>">
                <a href="<?php echo base_url(); ?>tareaje">
                    <i class="fa fa-circle-o text-purple"></i> <span>Tareaje</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-black"></small>
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->

</aside>
