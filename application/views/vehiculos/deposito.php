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
                                    <th>Fin</th>
                                    <th>Tiempo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($vehiculos as $fila1) {
                                    echo "<tr>";
                                    echo "<td>" . $fila1->placa . "</td>";
                                    echo "<td>" . $fila1->horainicio . "</td>";
                                    echo "<td>" . $fila1->horafinal . "</td>";
                                    echo "<td>$fila1->diferencia</td>";
                                    echo "<td></td>";
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