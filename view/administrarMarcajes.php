<!-- Bootstrap Core CSS -->
<link href="../complements/sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="../complements/sb-admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="../complements/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<!--<link href="../complements/sb-admin/bower_components/datatables-responsive/css/dataTables.responsive.scss" rel="stylesheet">-->
<!-- Custom CSS -->
<link href="../complements/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="../complements/sb-admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- jQuery -->
<script src="../complements/sb-admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../complements/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../complements/sb-admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- DataTables JavaScript -->
<script src="../complements/sb-admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../complements/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../complements/sb-admin/dist/js/sb-admin-2.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
                "language": {
                "sProcessing":    "Procesando...",
                "sLengthMenu":    "Mostrar _MENU_ registros",
                "sZeroRecords":   "No se encontraron resultados",
                "sEmptyTable":    "Ningún dato disponible en esta tabla",
                "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_.",
                "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":   "",
                "sSearch":        "Buscar:",
                "sUrl":           "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":    "Último",
                    "sNext":    "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
    });
});
</script>
<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$ultimoMarcaje = $consulta->Conectar("postgres","SELECT checktime FROM checkinout ORDER BY checktime DESC LIMIT 1");
$ultimaFechaMarcaje = strtotime($ultimoMarcaje[0]['checktime']);
$ultimaFechaMarcaje = date("Y-m-j", $ultimaFechaMarcaje);
$datosMarcajes = $consulta->Conectar("postgres","SELECT checkinout.logid, checkinout.checktime, userinfo.name FROM checkinout INNER JOIN userinfo ON checkinout.userid=userinfo.userid WHERE checkinout.checktime BETWEEN '".$ultimaFechaMarcaje." 00:00:00' AND '".$ultimaFechaMarcaje." 23:59:59' ORDER BY checkinout.checktime ASC");
$ultimoRefresh = $consulta->Conectar("postgres","SELECT * FROM refrescamiento WHERE tabla='checkinout' ORDER BY fecha DESC LIMIT 1");
//echo date("j-m-Y H:i:s");
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Marcajes</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Marcaje de Empleados
            </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        Ultima actualización de marcajes: <?php echo date("j-m-Y H:i:s", strtotime($ultimoRefresh[0]['fecha']));?>.
            <!-- /.panel-heading -->
                <div class="dataTable_wrapper">
                    <?php if(!empty($datosMarcajes)){?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Empleado</th>
                                <th>Marcaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datosMarcajes as $marcaje){?>
                            <tr class="odd gradeX">
                                <td><?php echo $marcaje["logid"];?></td>
                                <td><?php echo $marcaje["name"];?></td>
                                <td><?php echo $marcaje["checktime"];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php }else{ ?>
                    <div class="alert alert-danger">
                        No existen registros; Por favor Presione el botón Sincronizar Marcajes.
                    </div>
                    <?php }?>
                </div>
                <!-- /.table-responsive -->
                <div class="well">
                    <a class="btn btn-default btn-lg btn-block" href="#" onclick="$('#divSincronizar').show();$('.well').hide();cargaContent('sincronizarMarcajes.php','','contenido');">Sincronizar Marcajes</a>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>