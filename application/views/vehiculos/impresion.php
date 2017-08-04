<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<style>
    .dato {
        text-align: left;
        font-size: 0.9em;
        padding-left: 1.5em;
    }
    .subtitulo{
        text-align: right;
    }

</style>
<body onload="imprimir()">
    <div>
        <table width=290 border="0" style="margin: 0 auto;">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: left">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url() ?>/recursos/dist/img/logomsi.png" width="40"/> </a>
                    </th>
                    <th colspan="18">
                        <strong style="font-size: 1.3em;">Municipalidad de San Isidro</strong>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="4" class="subtitulo"> 
                        <strong>Placa: </strong>
                    </td>
                    <td colspan="16" class="dato"> 
                        <?php echo $ticket->placa; ?>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td colspan="4" class="subtitulo"> 
                        <strong>Hora Inicio: </strong>
                    </td>
                    <td colspan="16" class="dato"> 
                        <?php echo $ticket->horainicio; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="subtitulo"> 
                        <strong>Hora Final: </strong>
                    </td>
                    <td colspan="16" class="dato"> 
                        <?php echo $ticket->horafinal; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="subtitulo"> 
                        <strong>Hora TMP: </strong>
                    </td>
                    <td colspan="16" class="dato"> 
                        <?php echo $ticket->tiempoparqueo; ?> min
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="subtitulo"> 
                        <strong>Vía: </strong>
                    </td>
                    <td colspan="16" class="dato"> 
                        <?php echo $ticket->via; ?>
                    </td>

                </tr>
                <tr>
                    <td colspan="20">
                        <p>TMP(tiempo maximo de permanencia)</p>
                        <p style="font-size: 0.65em; text-align: justify">Según Ordenanza Municipal Nº 448-MSI y Decreto de Alcaldía Nº 008-2017-MSI
                        que regula el uso y tiempo de los espacios de estacionamiento público</p>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</body>


<script>
    function imprimir() {
       window.print();
       //top.location = "<?php echo base_url(); ?>"
    }
</script>