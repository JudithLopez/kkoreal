<script type="text/javascript">
$(document).ready(function() {
    $('#form').submit(function() {
        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                alert(data);
                //$('#result').html(data);
            }
        })        
        return false;
    }); 
});
</script>
<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$datosBanda = $consulta->Conectar("postgres","SELECT banda.*, tipo_horario.nombre FROM banda INNER JOIN tipo_horario ON banda.tipo_horario_id=tipo_horario.id WHERE banda.id=".$_GET['id']);
$datosRangoBanda = $consulta->Conectar("postgres","SELECT rango_banda.*, tipo_hora.nombre FROM rango_banda INNER JOIN tipo_hora ON rango_banda.tipo_hora_id=tipo_hora.id WHERE rango_banda.banda_id=".$_GET['id']." ORDER BY rango_banda.id ASC");
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Configuración De Banda De Horario</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Banda de Horario
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form id="form" name="form" action="../controller/crearBandaHorarioAction.php" role="form" method="post">
                            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $_GET['id']; ?>">
                            <div class="form-group">
                                <label>Hora de Entrada:</label>
                                <?php echo $datosBanda[0]['hora_entrada']; ?>
                            </div>
                            <div class="form-group">
                                <label>Hora de Salida:</label>
                                <?php echo $datosBanda[0]['hora_salida']; ?>
                            </div>
                            <div class="form-group">
                                <label>Tipo de Horario:</label>                                    
                                <?php echo $datosBanda[0]['nombre'];?>
                                </select>
                            </div>
                            <?php if($datosRangoBanda){ ?>
                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-12"><table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                                <thead>
                                    <tr role="row"><th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 170px;">#</th><th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">Entrada</th><th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">Salida</th><th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">Tipo</th><th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">Opciones</th></tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($datosRangoBanda as $rangoBanda){
                                    ?>
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1"><?php echo $rangoBanda["id"];?></td>
                                        <td><?php echo $rangoBanda["hora_desde"];?></td>
                                        <td><?php echo $rangoBanda["hora_hasta"];?></td>
                                        <td><?php echo $rangoBanda["nombre"];?></td>
                                        <td><a href="#" onclick="cargaContent('crearRangoBandaHorario.php?idRango=<?php echo $rangoBanda["id"];?>&id=<?php echo $_GET['id'];?>','','contenido');"><button type="button" class="btn btn-outline btn-primary btn-xs">Editar</button></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table></div></div></div>
                            <?php }else{ ?>
                                <div class="alert alert-danger">
                                    No se han Registrado Rangos para esta Banda de Horario.
                                </div>
                            <?php }?>
                            <button type="button" class="btn btn-default" onclick="cargaContent('crearRangoBandaHorario.php?idRango=0&id=<?php echo $_GET['id'];?>','','contenido');">Nuevo Rango</button>
                            <button type="button" class="btn btn-default" onclick="cargaContent('administrarBandasHorarios.php','','contenido');">Volver</button>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>