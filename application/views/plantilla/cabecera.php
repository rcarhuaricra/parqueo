<body class="hold-transition skin-green sidebar-mini">

    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url(); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><span class="fa fa-car"></span></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><span class="fa fa-car"></span> <b>Modulo</b>PARQUEO</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->

            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">                                    
                                <span class="fa-stack">
                                    <i class="fa fa-circle fa-stack-2x text-red"></i>
                                    <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                                </span>
                                <span class="hidden-xs">
                                    <?php
                                    echo $_SESSION['email']
                                    ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <span class="fa-stack fa-3x">
                                        <i class="fa fa-circle fa-stack-2x text-red "></i>
                                        <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <p>
                                        <?php
                                        echo $_SESSION['nombre'];
                                        ?> - 
                                        <?php
                                        echo $_SESSION['txtrol']
                                        ?>
                                        <small>

                                        </small>
                                    </p>
                                </li>

                                <li class="user-footer">                                      
                                    <div class="pull-right">
                                        <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </nav>
           
        </header>