<?php
$mes = $mesTurno['mes'];
$número = cal_days_in_month(CAL_GREGORIAN, $mes, AÑO_ACTUAL); // 31
echo "Hubo {$número} días en " . $meses[$mes] . " del " . AÑO_ACTUAL;
$timeout = time() - 900; # 15 minutos
?>
<form id="guardarTareaje">


    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>

                <th>Fecha</th>
                <th>Turno</th>
                <th>Calle</th>
                <th>Cuadra</th>
                <th>usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($cuadras as $value) {
                echo "<tr>";

                echo "<td><input type='hidden' name='mes[]' value='$mes'>" . $meses[$mesTurno['mes']] . "</td>";
                echo "<td><input type='hidden' name='turno[]' value='$value->id_turno'>" . $value->txt_turno . "</td>";
                echo "<td>" . $value->tipoVia . " " . $value->nombrevia . "</td>";
                echo "<td><input type='hidden' name='cuadra[]' value='$value->id_cuadras'>" . $value->cuadra . "</td>";
                echo "<td>";
                ?>
        <select  name="usuario[]" id="usuario" style="min-width: 250px" required="">
                <option value="">[selecciones Usuario]</option>
                <?php
                foreach ($usuarios as $usuario) {
                    echo "<option value='$usuario->iduser'>$usuario->user_name $usuario->user_ape_pat $usuario->user_ape_mat</option>";
                }
                ?>
            </select>
            <?php
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <div class="">
        <button type="submit" class="btn btn-success" name="btnGuardarTareaje" id="btnGuardarTareaje">Guardar</button>        
    </div>
</form>
<script>
    $(document).ready(function () {
        $("select").select2();
    });
    $('#guardarTareaje').bind('submit', function () {

        
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>tareaje/guardarTareaje',
            data: $('#guardarTareaje').serialize(),
            success: function (response) {
                console.log(response);
                /*$("#modalCofirmacion").modal({backdrop: "static", keyboard: false});
                 $("#contenidoCofirmacion").html(response);*/
            }
        });


    });
</script>
