<!DOCTYPE html>
<html>
<head>
    <title><?php //echo $titulo; ?>SIP Personal</title>
    <meta charset="utf-8"></meta>
    <title>Sistema de Información de Posgrado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href= "<?php echo $this->config->item('base_url'); ?>"/>

    <script type='text/javascript' src="../assets/js/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.ui.draggable.js"></script>
    <script type="text/javascript" src="../assets/js/DataTables-1.8.1/media/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.jeditable.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.validate.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="../assets/js/highcharts.js"></script>
    <script type="text/javascript" src="../assets/js/exporting.js"></script>
    <script type="text/javascript" src="../assets/js/exporting.src.js"></script>

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css" >
    <link rel="stylesheet" href="../assets/js/themes/smoothness/jquery-ui-1.8.16.custom.css" type="text/css">
    <link rel="stylesheet" href="../assets/js/themes/base/jquery.ui.base.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
      body {
        padding-top: 50px;
        /*background-color: #f5f5f5;*/
      }
    </style>


<script type="text/javascript">
$(document).ready(function()
  {
//*******************  ANEXOS **********************************************************

  $('#save-and-go-back-button').on('click', function()
  {
    if (($("#field-periodo_anexo").val() != null) || ($("#field-director_interno").val() != null))
    {
      if (!window.confirm("Una vez guardada la información ya no será posible su modificación. ¿Está seguro(a) de guardar los datos?"))
        { window.history.reload();}
    }
  });



 $('#form-button-save').on('click', function(e)
 {
   if (($("#field-periodo_anexo").val() != null) || ($("#field-director_interno").val() != null))
    {
      if (!window.confirm("Una vez guardada la información ya no será posible su modificación. ¿Está seguro(a) de guardar los datos?"))
        { e.preventDefault();
          window.history.reload();
        }
    }
 });




 //############## INGRESAR ALUMNOS A CURSO  ###############
    $("#otra_beca_field_box").hide();
    $("#field-beca").change(function ()
    {
      if($("#field-beca").val() == "Otra"){ $("#otra_beca_field_box").show(); }
      else{ $("#otra_beca_field_box").hide(); }
    });
//****************************************************************
  $("#otro_lugar_field_box").hide();
    $("#field-lugar").change(function ()
    {
      if($("#field-lugar").val() == "Otro"){ $("#otro_lugar_field_box").show(); }
      else{ $("#otro_lugar_field_box").hide(); }
    });

//******************PROYECTOS DE ALUMNOS ****************************
    $('#field-director_interno').append('<option value="0">ACADÉMICO EXTERNO </option>');

    $("#director_externo_field_box").hide();
    $("#field-director_interno").change(function ()
    {
      if($("#field-director_interno").val() == "0"){ $("#director_externo_field_box").show(); }
      else{ $("#director_externo_field_box").hide(); }
    });


//************************************************************
    $('#field-codirector_interno').append('<option value="0">ACADÉMICO EXTERNO </option>');

    $("#codirector_externo_field_box").hide();
    $("#field-codirector_interno").change(function ()
    {
      if($("#field-codirector_interno").val() == "0"){ $("#codirector_externo_field_box").show(); }
      else{ $("#codirector_externo_field_box").hide(); }
    });




//************************************************************************************
$("#printBtn").click(function(){
    //printcontent('<br/>' +'semestre'+$("#semestre_input_box").html() + '<br/>' + $(".form-div").html());
    printcontent('<br/>' +$(".container-fluid").html() + '<b>Semestre: </b>'+ $("#field-semestre.readonly_label").html() + '<br/>' + '<b>Periodo:  </b>'
                 + $("#field-periodo_anexo.readonly_label").html() + '<br/><br/>' + '<b>'+$("#avances_display_as_box").html() +'</b>' + $("#avances_input_box.form-input-box").html()+ '<br/><br/>' + '<b>'+$("#condiciones_display_as_box").html() +'</b>' + $("#condiciones_input_box.form-input-box").html()
                 + $("#firma.container-fluid").html()+ '<b>Fecha de Evaluación: </b>'+ $("#field-fecha.readonly_label").html()
                 );
});




//*************************************************************************************
$("#printBtn2").click(function(){
    printcontent('<br/>' +$(".container-fluid").html() + '<br/>' + '<b>Periodo:  </b>'
                 + $("#field-periodo_anexo.readonly_label").html() + '<br/><br/>' + '<b>'+$("#avances_academicos_display_as_box").html() +'</b>'+$("#avances_academicos_input_box").html()
                 + $("#firma.container-fluid").html()+ '<b>Fecha de Evaluación: </b>'+ $("#field-fecha.readonly_label").html()
                 );
});


//**************************************************************************************

$("#printBtn3").click(function(){
    printcontent('<br/>' +$(".container-fluid").html() + '<br/>' + '<b>Periodo:  </b>'
                 + $("#field-periodo_anexo.readonly_label").html() + '<br/><br/>' + '<P ALIGN=center><b>Evaluación de las actividades realizadas por el estudiante </b></P>'+'<b>Desempeño Acedémico: </b>'+$("#field-desempeno_academico.readonly_label").html() +'<br/><br/><b>Cumplimiento del plan de estudios: </b>'+$("#field-plan_estudio.readonly_label").html()
                 +'<br/><br/><b>Obtención del grado dentro del tiempo oficial del Plan de estudios: </b>'+$("#field-obtencion_grado.readonly_label").html()+'<br/><br/><b>Cuál es el porcentaje de avance de la tesis: </b>'+$("#field-avance_tesis.readonly_label").html()
                 +'<br/><br/><b>En caso de que el estudiante cuente con una beca de CONACYT, y considerando las respuestas anteriores, así como, el art. 24 del reglamento de becas CONACYT sobre suspención, cancelación y conclusión de la beca, recomienda:  </b>'+ $("#field-beca_CONACYT.readonly_label").html() +'<br/><br/><b>'+$("#motivo_display_as_box").html() +'</b>'+$("#motivo_input_box").html()
                 + $("#firma.container-fluid").html()+ '<b>Fecha de Evaluación: </b>'+ $("#field-fecha.readonly_label").html()
                 );
});


//**************************************************************************************
function printcontent(content)
{
    var w = window.open();
    w.document.open();
    w.document.write('<html><title>ICS-SIP</title><body>');
    var image = 'logos';
    w.document.write('<img src="/../assets/imagenes/' + image + '.jpg">');
    w.document.write(content);
    w.document.write('</body></html>');
    w.print();
    w.document.close();

    //return true;
}

//************************** PROYECTOS *************************************************************






   $("#idalumn_field_box").hide();
    $("#field-posgrado").change(function ()
    {
      if($("#field-posgrado").val()){
        var valor = $('#field-posgrado').val();
        $('#field-idalumn').find('option:not(:contains('+valor+'))').hide();
        $("#idalumn_field_box").show();
        $('#field-idalumn').trigger("liszt:updated");
         }
        else{
          $('#field-idalumn').find('option:not(:contains('+valor+'))').show();
          $("#idalumn_field_box").hide(); }
    });



//*****************************************************************************




 });
</script>





</head>
<body>
<div class="container">
     <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn-inverse btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><strong>Instituto de Ciencias de la Salud - Sistema de Información de Posgrados</strong></a>

          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i>
              <?php echo $this->session->userdata('nombre');?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a><i class="icon-barcode"> </i> <?php echo $this->session->userdata('perfil');?></a></li>
              <li class="divider"></li>
              <li><a data-toggle="modal" href="#myModal"><i class="icon-refresh"></i> Cambiar Contraseña</a></li>
              <li class="divider"></li>
              <li><a href="salir"><i class="icon-off"></i> Cerrar sesión</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

</div>
<!-- End Topbar
================================================== -->

<!--#######################Modal para cambiar contraseña################################-->
   <div id="myModal" class="modal hide fade in" style="display: none;">
      <div class="modal-header">
          <a data-dismiss="modal" class="close">×</a>
          <h3>Cambio de contraseña</h3>
       </div>
       <div class="modal-body">
           <form action="cambiar_password" method="POST">
               <!--label for="exampleInputEmail1">Nueva contraseña</label-->
               <input type="password" class="form-control" name="password" placeholder="Nueva contraseña"> </br>
               <input type="password" class="form-control" name="passconf" placeholder="Confirme nueva contraseña"></br>
           <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Cambiar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
           </div>
          </form>
      </div>
  </div>
<!--#######################################################-->

              <div class="container">
                <?php echo $contenido; ?>

<div class="footer">
<blockquote>
  <p>Instituto de Ciencias de la Salud</p>
  <small>UV -  <?php echo date('Y');?></cite>
  </small>
</blockquote>
</div>
    </div>

</body>
</html>