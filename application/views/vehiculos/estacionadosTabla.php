
<table id="table" class="table table-hover table-bordered dt-responsive " cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Placa</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Tiempo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($vehiculos as $fila) {
            if ($fila->idestado == GRUA_EN_CAMINO) {
                echo "<tr class='bg-light-blue odd'>";
            } else {
                if ($fila->diferencia > '-00:15:00' && $fila->diferencia < '00:00:00') {
                    echo "<tr class='danger odd'>";
                } else if ($fila->diferencia < '00:00:00') {
                    echo "<tr class='warning odd'>";
                } else {
                    echo "<tr class='success odd'>";
                }
            }
            echo "<td>$fila->placa</td>";
            echo "<td>$fila->horainicio</td>";
            echo "<td>$fila->horafinal</td>";
            echo "<td>$fila->diferencia</td>";
            echo "<td>";
            if ($fila->diferencia > '-00:15:00' && $fila->diferencia < '00:00:00') {
                ?>
            <a class="btn btn-app bg-blue" id="estado"  id-vehiculo="<?php echo $fila->idvehiculo ?>" id-estado="<?php echo CULMINADO_CON_INFRACCION; ?>">
                <i class="fa icon-auto"></i> Culminar 
            </a>
            <?php
        } else if ($fila->diferencia < '00:00:00') {
            ?> 
            <a class="btn btn-app bg-blue-active" id="estado"  id-vehiculo="<?php echo $fila->idvehiculo ?>" id-estado="<?php echo CULMINADO_A_TIEMPO; ?>">
                <i class="fa icon-auto"></i> Culminar 
            </a>
            <?php
        } else {
            ?>
            <a class="btn btn-app bg-blue-active" id="estado" id-vehiculo="<?php echo $fila->idvehiculo ?>" id-estado="<?php echo CULMINADO_A_TIEMPO; ?>">
                <i class="fa icon-auto"></i> Culminar 
            </a>

            <?php
        }
        ?>
        <a href="<?php echo base_url(); ?>parqueador/imprimirPDF/<?php echo $fila->idvehiculo; ?>" class="btn btn-app bg-yellow">
            <i class="fa fa-print"></i> Imprimir
        </a>


        <?php
        echo "</td>";
    }
    ?>
</tbody>

</table>
<script>
    $('table').on('click', '#estado', function () {
        var ida = $(this).attr('id');
        var id = $(this).attr('id-vehiculo');
        var estado = $(this).attr('id-estado');
        swal({
            title: "El Vehículo se retira!",
            showCancelButton: true,
            confirmButtonColor: "#004974",
            confirmButtonText: "Si, Concluir!",
            cancelButtonText: "No, cancelar!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url(); ?>parqueador/updateEstados',
                        data: {
                            "id": id,
                            "estado": estado
                        },
                        success: function (response) {
                            location.reload();
                        }
                    });

                });
    })
    $('#table').DataTable({
        "paging": true,
        "ordering": true,
        "order": [[2, "asc"]],
        "info": true,
        "searching": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
        //"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]

    });
</script>
