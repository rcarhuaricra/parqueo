<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Velículos 
            <small> remolcados por grúa</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Vehículos enviados al deposito el día de hoy</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table" class="table table-hover table-bordered dt-responsive " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Inicio</th>
                                    <th>Culmino</th>
                                    <th>Tiempo Estacionado</th>
                                    <th>Estado</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($vehiculos as $fila) {

                                    echo "<tr>";
                                    echo "<td>$fila->placa</td>";
                                    echo "<td>$fila->horainicio</td>";
                                    echo "<td>$fila->fecmod</td>";
                                    echo "<td>$fila->tiempoParqueado</td>";
                                    echo "<td>$fila->txtestado</td>";

                                    echo "</tr>";
                                }
                                ?>
                            </tbody>

                        </table>
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