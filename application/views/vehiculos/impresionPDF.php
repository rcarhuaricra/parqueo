<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Municipalidad de San Isidro - Citas</title>

        <style>
            @import url("https://www.google.com/fonts#UsePlace:use/Collection:Roboto");
            body{
                font-family: "Roboto", sans-serif;
                font-size: 0.95em;
            }

            @page {
                margin: 16px;
            }

        </style>


    </head>
    <body >
        <div>
          
            <table width=250 border="0" style="margin: 0 auto;">
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: left">
                            <a><img src="<?php echo base_url() ?>/recursos/dist/img/logomsi.png" width="40"/> </a>
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
                            <?php echo $ticket->tiempoparqueo; ?> Horas
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
                            <p style="font-size: 0.8em; text-align: justify">Cuenta con 15 minutos de tolerancia, según Ordenanza Municipal 
                                Nº 448-MSI y Decreto de Alcaldía Nº 008-2017-MSI que regula el uso y tiempo de los espacios de estacionamiento público.</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="20">
                    <?php echo "<img src='$qr' width='115' />";?>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </body>


