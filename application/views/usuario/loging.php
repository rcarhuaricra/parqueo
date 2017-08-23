<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo base_url(); ?>"><b>Sistema de </b>Parqueo</a>
            <?php echo DIA_DE_HOY  ; ?>
            
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Inicio de Sesión</p>

            <form action="<?php echo base_url(); ?>login/verificarlogin" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email"  value="<?php echo set_value('email'); ?>"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <?php echo form_error('email'); ?>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group" id="verPass" >
                        <div class="has-feedback">
                            <input type="password" class="form-control" placeholder="Password" id="psw" name="psw"  value="<?php echo set_value('psw'); ?>">
                            <span class="glyphicon glyphicon-lock form-control-feedback" id="ver"></span>
                        </div>
                        <span class="input-group-btn " id="btnVerPass">
                            <button type="button" class="btn btn-info btn-flat hover" id="ver"><span class="fa fa-eye"></span></button>
                        </span>
                    </div>
                    <?php echo form_error('psw'); ?>
                </div>
                <?php echo form_error('acceso'); ?>
                <div class="form-group has-feedback">
                    <button type="submit" class="btn btn-success btn-block btn-flat"><span class="fa fa-sign-in"></span> Ingresar</button>
                    <!-- /.col -->
                </div>
            </form>
            <?php echo $this->session->flashdata('mensaje'); ?>
        </div>
        <!-- /.login-box-body -->
    </div>
    <script>
       
        $("button#ver").click(function () {
            var inputType = $('#psw').attr('type');
            var teclas = $("#psw").val().length;
            if (teclas !== 0) {
                if (inputType === 'password') {
                    $("#psw").attr("type", "text")
                } else {
                    $("#psw").attr("type", "password")
                }
            }

            //$("#psw").attr("type","text")
        });
    </script>
