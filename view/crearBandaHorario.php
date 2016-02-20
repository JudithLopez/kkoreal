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
            'horaEntrada': {
                required: true,
            },
            'horaSalida': {
                required: true,
            },
            'tipoHorario': {
                required: true,
            }
        },
        messages: {
            'horaEntrada': {
                required: "La Hora de Entrada requerida",
            },
            'horaSalida': {
                required: "La Hora de Salida es requerida",
            },
            'tipoHorario': {
                required: "El Tipo de Horario es requerido",
            }
        },
        submitHandler: function(form){
            $.ajax({
                type: 'POST',
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                success: function(data){
                    alert(data);
                    setTimeout( function(){
                        $('#contenido').load("administrarBandasHorarios.php");
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
$tipoHorario = $consulta->Conectar("postgres","SELECT * FROM tipo_horario ORDER BY id ASC");
if($_GET['id']!==0)
{
    $banda = $consulta->Conectar("postgres","SELECT * FROM banda WHERE id=".$_GET['id']);
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Banda De Horario</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Nueva Banda
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form" name="form" action="../controller/crearBandaHorarioAction.php" role="form" method="post">
                            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $_GET['id']; ?>">
                            <div class="form-group">
                                <label>Hora de Entrada:</label>
                                <input id="horaEntrada" name="horaEntrada" class="form-control timepickr" placeholder="Ingrese la Hora de Entrada" value="<?php echo $he=isset($banda[0]['hora_entrada'])? $banda[0]['hora_entrada'] : ''; ?>" readonly style="width:250px">
                            </div>
                            <div class="form-group">
                                <label>Hora de Salida:</label>
                                <input id="horaSalida" name="horaSalida" class="form-control timepickr" placeholder="Ingrese la hora de Salida" value="<?php echo $hs=isset($banda[0]['hora_salida'])? $banda[0]['hora_salida'] : ''; ?>" readonly style="width:250px">
                            </div>
                            <div class="form-group">
                                <label>Tipo de Horario:</label>
                                <select id="tipoHorario" name="tipoHorario" class="form-control" style="width:250px">
                                    <option value="">Seleccione una opción</option>
                                    <?php foreach ($tipoHorario as $key => $value) {
                                        if($banda[0]['tipo_horario_id']==$value['id']){
                                            echo '<option value="'.$value['id'].'" selected="selected">'.$value['nombre'].'</option>';
                                        }else{
                                            echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default" onclick="">Guardar</button>
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