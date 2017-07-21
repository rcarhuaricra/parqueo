<body class="hold-transition skin-green sidebar-mini">


    <div class="">

        <header class="main-header">

            <!-- Logo -->
            <a href="<?php echo base_url(); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><span class="fa fa-car"></span></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><span class="fa fa-car"></span> <b>Modulo</b>PARQUEO</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <?php
            foreach ($usuario->result() as $fila1) {
                ?>
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url(); ?>recursos/dist/img/user.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs">
                                        <?php
                                        echo $fila1->user_name . ' ';
                                        echo $fila1->user_ape_pat . ' ';
                                        echo $fila1->user_ape_mat;
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url(); ?>recursos/dist/img/user.jpg" class="img-circle" alt="User Image">
                                        <p>
                                            <?php
                                            echo $fila1->user_name . ' ';
                                            echo $fila1->user_ape_pat . ' ';
                                            echo $fila1->user_ape_mat;
                                            ?> - 
                                            <?php
                                            echo $fila1->txtrol;
                                            ?>
                                            <small>
                                                <?php
                                                echo $fila1->fecreg;
                                                ?>
                                            </small>
                                        </p>
                                    </li>
                            </li>
                            <li class="user-footer">                                      
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>/login/logout" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                        </li>
                        <li class="dropdow notifications-menu visible-sm visible-xs" >
                            <a href="tel://964727438" >
                                <i class="fa fa-phone"></i>
                                <span class="label label-danger"></span>
                            </a>
                        </li>
                        </ul>
                    </div>
                </nav>
                <?php
            }
            ?>
            
        </header>