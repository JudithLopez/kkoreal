<link rel="stylesheet" type="text/css" href="../complements/jquery.timepickr/jquery-ui.css" />
<script src="../complements/jquery.timepickr/jquery-1.7.1.js"></script>
<script src="../complements/jquery.timepickr/jquery-ui.js"></script>
<script src="../complements/jquery.timepickr/jquery.timepickr.js"></script>
<!--<script src="../complements/validate/js/jquery-1.8.2.min.js"></script>-->
<script src="../complements/validate/js/jquery.validate.js"></script>
<script src="../complements/validate/js/additional-methods.js"></script>
<script src="../complements/validate/js/messages_es.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#form").validate({
        rules: {
            'horaDesde': {
                required: true,
            },
            'horaHasta': {
                required: true,
            },
            'tipoHora': {
                required: true,
            }
        },
        messages: {
            'horaDesde': {
                required: "La Hora Desde es requerida",
            },
            'horaHasta': {
                required: "La Hora Hasta es requerida",
            },
            'tipoHora': {
                required: "El Tipo de Hora es requerido",
            }
        },
        submitHandler: function(form){
            $.ajax({
                type: 'POST',
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                success: function(data){
                    var datos = data.split('!');
                    alert(datos[0]);
                    setTimeout( function(){
                        $('#contenido').load("configurarBandaHorario.php?id="+datos[1]);
                    }, 1000);
                }
            });
        }
    });
});
</script>
<script type="text/javascript">
$('.timepickr').timepickr({
convention: 12,
format: '{h}:{m} {suffix}',
hoverIntent: false
});
</script>
<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$datosBanda = $consulta->Conectar("postgres","SELECT banda.*, tipo_horario.nombre FROM banda INNER JOIN tipo_horario ON banda.tipo_horario_id=tipo_horario.id WHERE banda.id=".$_GET['id']);
$tipoHora = $consulta->Conectar("postgres","SELECT * FROM tipo_hora ORDER BY id ASC");
if($_GET['idRango']!==0)
{
    $rangoBanda = $consulta->Conectar("postgres","SELECT * FROM rango_banda WHERE id=".$_GET['idRango']);
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Rango de Banda</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Nuevo Rango
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form" name="form" action="../controller/crearRangoBandaHorarioAction.php" role="form" method="post">
                            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $_GET['id']; ?>">
                            <input type="hidden" id="idRango" name="idRango" class="form-control" value="<?php echo $_GET['idRango']; ?>">
                            <input type="hidden" id="entrada" name="entrada" class="form-control" value="<?php echo $datosBanda[0]['hora_entrada']; ?>">
                            <input type="hidden" id="salida" name="salida" class="form-control" value="<?php echo $datosBanda[0]['hora_salida']; ?>">
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
                            <div class="form-group">
                                <label>Hora Desde:</label>
                                <input id="horaDesde" name="horaDesde" class="form-control timepickr" placeholder="Ingrese la Hora Desde" value="<?php echo $he=isset($rangoBanda[0]['hora_desde'])? $rangoBanda[0]['hora_desde'] : ''; ?>" readonly style="width:250px">
                            </div>
                            <div class="form-group">
                                <label>Hora Hasta:</label>
                                <input id="horaHasta" name="horaHasta" class="form-control timepickr" placeholder="Ingrese la Hora Hasta" value="<?php echo $hs=isset($rangoBanda[0]['hora_hasta'])? $rangoBanda[0]['hora_hasta'] : ''; ?>" readonly style="width:250px">
                            </div>
                            <div class="form-group">
                                <label>Tipo de Hora:</label>
                                <select id="tipoHora" name="tipoHora" class="form-control" style="width:250px">
                                    <option value="">Seleccione una opción</option>
                                    <?php foreach ($tipoHora as $key => $value) {
                                        if($rangoBanda[0]['tipo_hora_id']==$value['id']){
                                            echo '<option value="'.$value['id'].'" selected="selected">'.$value['nombre'].'</option>';
                                        }else{
                                            echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default" onclick="">Guardar</button>
                            <button type="button" class="btn btn-default" onclick="cargaContent('configurarBandaHorario.php?id=<?php echo $_GET['id'];?>','','contenido');">Volver</button>
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