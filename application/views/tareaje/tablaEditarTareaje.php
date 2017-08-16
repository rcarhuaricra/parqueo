<table class="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Sereno</th>
            <th>Turno</th>
            <th>Calle</th>
            <th>Nº de Cuadra</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($TareajeEdicion as $valor) {
            echo '<tr>';
            echo "<td>$valor->fecha_tarea</td>";
            echo "<td>$valor->user_name $valor->user_ape_pat $valor->user_ape_mat</td>";
            echo "<td>$valor->txt_turno</td>";
            echo "<td>$valor->tipoVia $valor->nombrevia</td>";
            echo "<td>$valor->cuadra</td>";
            ?>
        <td><a class='btn btn-success' id='buttonEditar' href='<?php echo base_url().'tareaje/editarusuario/'.$valor->id_tareaje ?>'>Editar</a></td>
        <?php
        echo '</tr>';
    }
    ?>
</tbody>
</table>
