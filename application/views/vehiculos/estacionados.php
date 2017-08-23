<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Velículos 

            <small>Estacionados</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Vehículos estacionados el dia de hoy
                        </h3>
                        <h3 class="box-title pull-right"> 
                            Ultima Actualización: <strong id="hora"></strong>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="contenidoEstacionados">

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script>
    function actualizaTabla() {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>parqueador/verificar',
            success: function (response) {
                $('#contenidoEstacionados').html(response);
                var d = new Date();
                $('#hora').html(d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds());
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                alert(msg);
            }
        });
    }
    setInterval(actualizaTabla, 12000);
    window.addEventListener('load', actualizaTabla, false);
</script>
