<html>
<head>
<title>kkoReal</title>
<link rel="shortcut icon" href="../images/Logo.ico"/>
<!-- Bootstrap Core CSS -->
<link href="../complements/sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="../complements/sb-admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<!-- Timeline CSS -->
<link href="../complements/sb-admin/dist/css/timeline.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="../complements/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Morris Charts CSS -->
<link href="../complements/sb-admin/bower_components/morrisjs/morris.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="../complements/sb-admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<script src="../complements/sb-admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../complements/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
// Activate Carousel
$("#myCarousel").carousel();

// Enable Carousel Indicators
$(".item").click(function(){
    $("#myCarousel").carousel(1);
});

// Enable Carousel Controls
$(".left").click(function(){
    $("#myCarousel").carousel("prev");
});

function cargaContent(formulario, valor, div){
    divContent = div;
    var v = valor;
    $.post(formulario, {numero:v}, function(data){
        $("#"+divContent+"").html(data);
    });   
}

function clickBoton(id_form, url){
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        success: function(data){
            alert(data);
        }
    });
}
</script>
<style>
.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
    width: 60%;
    margin: auto;
}
</style>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header" style="background: url(../images/header.png) center;/*width: 1440px;*/height:170px;">
                <a class="navbar-brand" href="principal.php" style="padding: 20px 170px;"><img src="../images/Logo.jpg" width="80px" height="80px"></a>
            </div>
            <!-- /.navbar-header -->
            <div class="navbar-default sidebar" role="navigation" style="margin-top:170px;">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#" onclick="cargaContent('administrarDepartamentos.php','','contenido');"><i class="fa fa-windows fa-fw"></i> Departamentos</a>
                        </li>
                        <li>
                            <a href="#" onclick="cargaContent('administrarBandasHorarios.php','','contenido');"><i class="fa fa-dashboard fa-fw"></i> Banda de Horario</a>
                        </li>
                        <li>
                            <a href="#" onclick="cargaContent('horarioPersonal.php','','contenido');"><i class="fa fa-user fa-fw"></i> Horario por Personal</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gear fa-fw"></i> Parametros del Sistema</a>
                        </li>
                        <li>
                            <a href="#" onclick="cargaContent('administrarMarcajes.php','','contenido');"><i class="fa fa-list-alt fa-fw"></i> Refrescamiento de Marcaje</a>
                        </li>
                        <li>
                            <a href="#" onclick="cargaContent('administrarEmpleados.php','','contenido');"><i class="fa fa-list-alt fa-fw"></i> Empleados</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar-o fa-fw"></i> Horas Trabajadas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="divSincronizar" style="display:none;width:100%;height:100%;position:absolute;background:#eee;opacity:0.8;left:0px;top:0px;z-index:100000" align="center"><img height="125px" width="125px" alt="Sincronizando" src="../images/load.gif" style="margin-top:150px;"><br><h4>Por favor, Espere.</h4></div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" id="contenido">
                    <h3 class="page-header">SISTEMA DE REPORTES DEL BIOMETRICO</h3>
                    <?php include_once("carruselkkoReal.html");?>
                </div>
            </div>
        </div>

    </div>
</body>
</html>