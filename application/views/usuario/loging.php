<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="panel-heading panel-default">
            <span class="fa fa-lock icono"></span> 
            <label class="titulo">Inicio de Sesión</label>
        </div>
        <div class="modal-body">
            <form method="post" role="form" action="<?php echo base_url(); ?>login/verificarLogin">
                <div class="form-group">
                    <label for="email"><span class="fa fa-user-circle"></span> E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" 
                           placeholder="Ingrese Correo" title="Ingrese Usuario Valido" 
                           value="<?php echo set_value('email'); ?>"/>
                           <?php echo form_error('email'); ?>
                </div>
                <div class="form-group">
                    <label for="psw"><span class="fa fa-eye-slash"></span> Password</label>
                    <input type="password" class="form-control" id="psw" name="psw" title="Ingrese pasword Valido"  
                           placeholder="Ingrese password" value="<?php echo set_value('psw'); ?>"/>
                           <?php echo form_error('psw'); ?>
                </div>
                <button type="submit" class="btn btn-success btn-block"><span class="fa fa-sign-in"></span> Ingresar</button>
            </form>
            <?php echo $this->session->flashdata('mensaje'); ?>
        </div>
    </div>
</div>
