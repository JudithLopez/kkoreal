<script src="../complements/validate/js/jquery-1.8.2.min.js"></script>
<script src="../complements/validate/js/jquery.validate.js"></script>
<script src="../complements/validate/js/additional-methods.js"></script>
<script src="../complements/validate/js/messages_es.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#form").validate({
        rules: {
            'nombre': {
                required: true,
            }
        },
        messages: {
            'nombre': {
                required: "El Nombre es requerido",
            }
        },
        submitHandler: function(form){
            var id = $("#nombre").val();
            $('#contenido').load("crearHorarioPersonal.php?id="+id);
        }
    });
});
</script>
<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$datosEmpleados = $consulta->Conectar("postgres","SELECT * FROM userinfo ORDER BY userid ASC");
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Horario del Personal</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Datos de Empleado
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form" name="form" action="" role="form" method="post">
                            <div class="form-group">
                                <label>Nombre y Apellido:</label>
                                <select id="nombre" name="nombre" class="form-control" style="width:250px">
                                    <option value="">Seleccione un empleado</option>
                                    <?php foreach ($datosEmpleados as $key => $value) {
                                        echo '<option value="'.$value['userid'].'">'.$value['name'].'</option>';
                                    } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default" onclick="">Siguiente</button>
                            <button type="button" class="btn btn-default" onclick="cargaContent('carruselkkoReal.html','','contenido');">Cancelar</button>
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