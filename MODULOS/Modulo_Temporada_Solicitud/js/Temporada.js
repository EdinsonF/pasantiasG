

function IniEventos(){


    $("#tablamistemporadaespecialidad").hide();

    $("#tabasgnaratemp").on('click',function(){

      $("#tablatrampa").hide();

      $("#tablamistemporadaespecialidad").hide();

      llenartablaparaAsignacion();
      // AQUI LLAMAR LA TABLA DE TEMPORADAS PREPARADAS
    });


    $("#cancelar").click(function(){
        
        $("#studparaasignarbur").hide();

        $("#studasignadosbur").hide(); 

       Armarestudiantes( '');

        ArmarestudiantesAsignados( '');
    });

    $("#tabmaestrio").on('click',function(){

      $("#tablatrampa").show();

      $("#tablamistemporadaespecialidad").hide();
      
    });

    $("#tabasasignarespecialidades").on('click',function(){
      $("#tablatrampa").hide();
      
      $("#tablamistemporadaespecialidad").show();

      tablamisTemporadas();

    });

    $("#tabAbrirTemporadas").on('click',function(){

      $("#tablatrampa").hide();
    });

    $("#periodo").on('change',function(){

      buscarLapsoacademico();

    });

    $("#Registrar").on('click',function(){

       var booleano = ValidarTemporada();

       if(booleano)
       {
             registrar();

       }else{

        MensajeCamposVacios();

       }
    });
}
function AventoDElSelecTPeluo()
{    
  $("#alertdescente").hide();
    if($("#especialidadesTemporada").val() != '')
    {
       buscarestudiantessegunespecialidadesdeTemporadas($("#especialidadesTemporada").val());

       buscarEstudiantesAsignadosEspecialidadesdeTemporadas($("#especialidadesTemporada").val());
    }
}

function ValidarTemporada()
{
    if( $("#encargado").val()=='' )
    { $("#encargado").focus();
       return false;
    }else if($("#periodo").val() =='')
    { $("#periodo").focus();
       return false;
    }else if($("#tipo_solicitud").val()=='')
    { $("#tipo_solicitud").focus();
       return false;
    }else if($("#estatus").val()=='')
    { $("#estatus").focus();
       return false;
    }else
    {
      return true;
    }
                   
}

$("#asignar").on('click',function(){
      var estudiantes = Array();
      var veri        = false;
$('#tablaEstudiante tbody input[type="checkbox"]:checked').each(function(index) {
  var codigo_estudiante=$(this).closest("tr").find('td').eq(4).text(); 
        
        //buscarEstatemporada(codigo_encargao);
          
        estudiantes[index]=codigo_estudiante;
        
            if(index==0){
            veri=true;
            }
    });
  
  if(veri==true)
  {     
      asignarEstudiantesTemporada( $("#especialidadesTemporada").val(), $("#temporada").val(),estudiantes);
  }

    $("#studparaasignarbur").hide();

    $("#studasignadosbur").hide(); 

    setTimeout(function(){

          llenartablaparaAsignacion();
    
          Armarestudiantes( '' );

          ArmarestudiantesAsignados( '' );

    },1000);


});





function Selectperiodo(){

        $.ajax({
               
                async   : true, 
               
                cache   : false,
               
                type    : "POST",
               
                url     : "../controlador/recibeTemporada.php",
               
                dataType: "html",

                data    : {
                
                  selectperiodo:$("#encargado").val()
                },
                success : function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html     = "";

                    if(Variable.length > 0){
                      $("#periodo").empty();

                      $("#periodo").append('<option value=""  >Seleccione...</option>');

                    $.each(Variable, function(index, value){
                      
                       $("#periodo").append('<option  value='+value['id_periodo']+'  >'
                                              +value['fecha_inicio']+ ' a ' +value['fecha_fin']+'</option>');
                       //$("#periodo option[value="+ value +"]").attr("selected",true);
   
                    });

                    $("#periodo").data("selectBoxIt").refresh();

                    $("#periodo").data("selectBoxIt").enable();

                      Renderidng_select();
                   }else 
                   {    
                      $("#periodo").html('<option value="" >Sin periodo Disponible</option>');
                      
                      $("#periodo").data("selectBoxIt").refresh();

                      $("#periodo").data("selectBoxIt").disable();

                        Renderidng_select();
                   }
                }

            });

}

function buscarEspecialidadesAsignadasTemporada( codigo_temporada){
      $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : 
                {                 
                  especialidadesTemporadas:codigo_temporada
                },
                success : function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html     = "";

                      $("#especialidadesTemporada").empty();
                      $("#especialidadesTemporada").append('<option value="" >Seleccione...</option>');
                    $.each(Variable, function(index, value){
                      
                       $("#especialidadesTemporada").append('<option value='+value['id_especialidad']+' >'
                                              +value['nombre_especialidad']+ ' - ' +value['nombre_tipo_especialidad']+'</option>');
                       //$("#periodo option[value="+ value +"]").attr("selected",true);
                       

   
                    });
                    $("#especialidadesTemporada").data("selectBoxIt").refresh();
                    
                } 


            });
}

function SelecttipoSolicitud(){

      $.ajax({
             
                async   : true, 
             
                cache   : false,
             
                type    : "POST",
             
                url     : "../controlador/recibeTemporada.php",
             
                dataType: "html",
             
                data    : {

                  selecttipoSolicitud:'ofcourse'
                },
                success: function (data) {
                   
                    var Variable = JSON.parse(data);
                    
                    var html     = "";

                    if(Variable.length > 0){
                    
                        $("#tipo_solicitud").append('<option value="" >Seleccione...</option>');
                    
                    $.each(Variable, function(index, value){
                      
                       $("#tipo_solicitud").append('<option value='+value['id_tipo_solicitud']+' >'
                                              +value['nombre_tipo_solicitud']+'</option>');
                       //$("#periodo option[value="+ value +"]").attr("selected",true);
                    });

                      $("#tipo_solicitud").data("selectBoxIt").refresh();

                      Renderidng_select();

                    }
                   
                }

            });

}

function tablamisTemporadas()
{
       $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : {

                  tablamistemporadasparaespecialidades :  $("#encargado").val()
                  
                },
                success: function (data) {
                  
                var variable = JSON.parse(data);
                var html     ='';

                $.each(variable, function(index, value){

                  html+="<tr  >"+

                  "<td hidden></td>"+

                  "<td >"+value['nombre_tipo_solicitud']+"</td>"+
                  
                  "<td >"+value['periodo']+"</td>"+
                  
                  "<td >"+value['estatus']+"</td>"+
                  
                  "<td class='icon text-primary'><span class='text-default'>"+value['detalles']+"</span>"+ 
                  
                  "<label hidden class=codeTempor>"+value['codigo_temporada']+"</label></td></tr>";
   
                });
                   
                    ArmartablaMostrarAsignacionEspecialidades( '#tablaforespecialidades', html);
                    $('[data-toggle="tooltip"]').tooltip();
                }// SUCCESS



              });//ajax

}


function buscarLapsoacademico()
{

      $.ajax({
      
                async   : true, 
      
                cache   : false,
      
                type    : "POST",
      
                url     : "../controlador/recibeTemporada.php",
      
                dataType: "html",

                data    : {

                  id_periodo    :  $("#periodo").val(),
                  
                  lapsoacademico:'ofcourse'
                },
                success: function (data) {

                $("#lapso").val($.parseJSON(data));
                }

            });
}


function buscarestudiantessegunespecialidadesdeTemporadas(especialidad)
{     

        $.ajax({
               
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : 
                {
                  codigo_temporada: $("#temporada").val(),

                  estudiantesSegunEspecialidad : especialidad
                },
                success: function (data) {
                  
                   var html ;
                   var Variable = JSON.parse(data);
                   $("#studparaasignarbur").show();
                   $("#studparaasignarbur").html(0);

                    $.each(Variable, function(index, value){

                      html +="<tr>"+
                      "<td> <input class=estudiante id="+index+" type=checkbox ></td>"+
                      
                      "<td>"+value["estudiante"]+"</td>"+
                      
                      "<td>"+value["expediente"]+"</td>"+
                      
                      "<td>"+value["cedula"]+"</td>"+                                     
                      
                       "<td hidden style=display:none>"+value["codigo_estudiante"]+"</td>"+
                       "</tr>";
                      $("#studparaasignarbur").html(index+1);
                    });
                     
                    Armarestudiantes( html);
                  
                }

            });
}

function buscarEstudiantesAsignadosEspecialidadesdeTemporadas(especialidad)
{     

        $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : {
                    codigo_temporada : $("#temporada").val(),

                    estudiantesAsignadosEspecialidad : especialidad
                },
                success: function (data) {
                  
                   var html ;
                   var Variable = JSON.parse(data);
                   $("#studasignadosbur").show();
                   $("#studasignadosbur").html(0);

                    $.each(Variable, function(index, value){
                      html +="<tr>"+                      
                     
                      "<td>"+value["estudiante"]+"</td>"+
                     
                      "<td>"+value["expediente"]+"</td>"+
                     
                      "<td>"+value["cedula"]+"</td>"+                                     
                     
                      "</tr>";
                     
                      $("#studasignadosbur").html(index+1);
                    });
                     
                    ArmarestudiantesAsignados( html);
                  
                }//success

            });//ajax
}

function registrar()
{

        $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
              
                dataType: "html",

                data    : {

                  encargado        :$("#encargado").val(),
                  
                  id_periodo       :$("#periodo").val(),
                  
                  id_tipo_solicitud:$("#tipo_solicitud").val(),
                  
                  estatus          :$("#estatus").val(),

                  registrartemporada:'ofcourse'
                },
                success: function (data) {
               

                    if(data==1)
                      {
                         swal('Bien','Temporada Registrada','success');
                      }else
                    {
                         swal('Error','error de programacion','error');
                    }
                    
                    setTimeout(function(){ restablecerform() },1000);
                }

            });

}


 function asignarEstudiantesTemporada( id_especialidad ,temporada,estudiantes)
 {

      $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : {

                  codigo_temporada  : temporada,
                  
                  id_especialidad   : id_especialidad,
                  
                  codigo_estudiante : estudiantes,
                  
                  asignarestudiantes:'ofcourse'
                },
                success: function (data) {
               
                    if(data == 1){
                           swal('Bien','El Estudiante fué Asignado','success');
                    }
                    else  if(data>0)
                    {
                           swal('Bien','Los Estudiantes fueron Asignados','success');
                    }else
                    {
                           swal('Error','error de programacion','error');
                    }
                    $("#especialidadesTemporada").val('');
                    $("#especialidadesTemporada").focus();
                }

            });

 }

function llenartablaTemporadas()
{
      $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : 
                {
                  codigo_encargao:$("#codigo_sucursal").val(),
                  tablaGeneral   :'ofcourse'
                },
                success: function (data) {
                   var html ;
                   var Variable = JSON.parse(data);
                   var ids_tr = new Array();
            $.each(Variable, function(index, value){

            html+="<tr  id=encargado"+index+" >"+
            
            "<td hidden style=display:none></td>"+
            
            "<td >"+value['encargado']+"</td>"+   
            
            "<td >"+value['nombre_tipo_solicitud']+"</td>"+
            
            "<td >"+value['periodo_solicitud']+"</td>"+

            "<td >"+value['estatus']+"</td>"+ 

            "<td><span class="+'"glyphicon glyphicon-search"'+"></span>"+
            
            "<label hidden class=code_code_code_code>"+value['codigo_temporada']+"</label></td></tr>";
            
            ids_tr[index] ='#encargado'+index;
                    });
                   
                    ArmarTabla( '#myTable', html );
                  
                }

            });


}


function llenartablaparaAsignacion()
{
      $.ajax({

                async   : true, 
               
                cache   : false,
               
                type    : "POST",
               
                url     : "../controlador/recibeTemporada.php",
               
                dataType: "html",
               
                data    : {
                  
                  MisTemporadasPreparadas: $("#encargado").val()
                },
                success: function (data) {
                
                   var html ;
                   var Variable = JSON.parse(data);
            $.each(Variable, function(index, value){

             html+="<tr  id="+value[index]+" >"+

             "<td hidden></td>"+
             
             "<td >"+value['nombre_tipo_solicitud']+"</td>"+
             
             "<td >"+value['periodo_solicitud']+"</td>"+

             "<td >"+value['estatus']+"</td>"+
            
             "<td class='icon text-primary'>"+value['detalles']+" "+
             
             "<label hidden class=coderaperture>"+value['codigo_temporada']+"</label></td></tr>";
   
                    });
                   
                    ArmarTablaPreparada( '#Asignacion', html);
                  $('[data-toggle="tooltip"]').tooltip();
                }

            });


}

function restablecerform()
{

    $("#periodo").val('');

    $("#lapso").val('');

    $("#tipo_solicitud").val('');

    $("#estatus").val('');

    $('.toggle-demo-check').bootstrapToggle('destroy');

    $('.toggle-demo-check').bootstrapToggle({

    off: 'Esperando Tipo Solicitud',

    offstyle:'danger'

    }); 

    llenartablaTemporadas();

    Selectperiodo();

    $("#tipo_solicitud").data("selectBoxIt").refresh();

    $("#estatus").data("selectBoxIt").refresh();

    Renderidng_select();    
}





      function buscarEstatemporada(codigo ,idHtmlInformation)
      {   
        $("#temporada").val(codigo);
        $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : 
                {                  
                  estaTemporada:  codigo
                },
                success: function (data) 
                {
                     
                     var preparada  = '<span class="glyphicon glyphicon-folder-close"></span>';
                     var ENcurso    = '<span class="glyphicon glyphicon-folder-open"></span>';
                     var CErrada    = '<span class="glyphicon glyphicon-lock"></span>';
                     var imagenicon = '';
                        
                var varia = JSON.parse(data);
                
                if(varia['estatus']!='EN CURSO' && varia['estatus']=='CERRADO') imagenicon=CErrada; else if (varia['estatus']!='EN CURSO' && varia['estatus']!='CERRADO') imagenicon = preparada; else imagenicon=ENcurso;

                varia['encargado']  = varia['encargado']+'<label class="text-primary"> <span class="glyphicon glyphicon-user"></span></label>';

        $(idHtmlInformation).html('<pre ><br> <label >Persona Encargada : </label> '+varia['encargado'] +'<br> '+
        
                                 '<label >Tipo de Solicitud : </label> '+varia['nombre_tipo_solicitud']+'<br> '+
        
                                 '<label >Estatus           : </label> '+varia['estatus']+'  '+imagenicon+'<br> '+
        
                                 '<label >Periodo           : </label> '+varia['periodo']+'<br> '+
        
                                 '<label >Lapso Acad&eacute;mico   : </label> '+varia['lapsoacademico']+'<br> </pre>');                 

                }



            });
             
              buscarEspecialidadesAsignadasTemporada(codigo);
      } 


function detallesthisTemporada(codigo_temporada)
{
      buscarEstatemporada(codigo_temporada ,"#informacionTemporadaEspecialidades");

      especialidadesnoasignacas(codigo_temporada);// Funcion que llena tablas

      especialidadesasignadas(codigo_temporada);// Funcion que llena tablas
      $("#temporada").val(codigo_temporada);

      $("#modal_especialidades_asignar").modal('show');

}

function especialidadesnoasignacas(codigo_temporada)
{ 


      $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : 
                {

                  buscarEspecialidadesNoasignadasthisTemporada : codigo_temporada
                  
                },
                success: function (data) {
                   
               var variable = JSON.parse(data);
               
               var html     ='';

               $("#numberwithout").html(0);

               $.each(variable, function(index, value){

                 html+="<tr >"+
                 "<td ><input type=checkbox class=asignarespecialidad ></td>"+ 

                 "<td >"+value['nombre_especialidad']+"</td>"+

                 "<td >"+value['nombre_tipo_especialidad']+"</td>"+
                            
                 "<td hidden style=display:none>"+value['id_especialidad']+"</td></tr>";

                  $("#numberwithout").html(index+1);
                });
                   
                    ArmartablaespecialidadesNoasignadas( '#tablaEspecialidadesadd', html);
               //tablaEspecialidadesadd
                }

              });
}
function especialidadesasignadas(codigo_temporada)
{
        $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : 
                {

                  tablamistemporadasconespecialidadesAsignadas :  codigo_temporada
                  
                },
                success: function (data) {

               var variable = JSON.parse(data);
               
               var html     ='';

               $("#numberwith").html(0);

               $.each(variable, function(index, value){

                  html+="<tr ><td >"+value['nombre_especialidad']+"</td>"+

                  "<td >"+value['nombre_tipo_especialidad']+"</td></tr>";

                  $("#numberwith").html(index+1);
               });
                   
                    ArmartablaespecialidadesSiasignadas( '#tablaEspecialidadesshard', html);                   
               
               //tablaEspecialidadesshard
                }

       });
  
}


$("#asignarEspecialidad").on('click',function(){

      var especialidad = Array();
      
      var veri         = false;

$('.asignarespecialidad:checked').each(function(index) {

  var id_especialidad=$(this).closest("tr").find('td').eq(3).text(); 
        
        //buscarEstatemporada(codigo_encargao);
          
        especialidad[index]=id_especialidad;
        
            if(index==0){
            veri=true;
            }
    });
  
  if(veri==true)
  {     
          asignarEspecialidadesTemporada($("#temporada").val(),especialidad);
  }else 
  {


  } 

    
});


$("#asignarEspecialidad").attr('disabled', true); 

$("#ver").on('click',function(){
      $("#asignarEspecialidad").attr('disabled', true); 

});

$("#agregar").on('click',function(){

      if($(".asignarespecialidad").is(':checked')) {  

          $("#asignarEspecialidad").attr('disabled', false);  

      } else {  

          $("#asignarEspecialidad").attr('disabled', true);   
      }
              //var $burbuja = $('#numberwithout');
                 
});



$("#studparaasignar").click(function(){
habilitarBotnModalEstudiantes();

});

$("#studasignados").click(function(){
 $("#asignar").attr('disabled', true);   
  
});


function asignarEspecialidadesTemporada( temporada,especialidad )
{

       $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : 
                {
                  temporadacode       : temporada,
                  
                  asignarEspecialidads: especialidad
                },
                success: function (data) {
                 
                      if(data >= 1)
                      {
                        swal('Bien','La Asignación se Realizó','success');
                      }else 
                      {
                        swal('Error','ocurrio un error','error');
                      }

                      setTimeout(function(){

                          tablamisTemporadas();
                          detallesthisTemporada(temporada);   

                      },1000);

                }

            });

}

function CargarPreparadasParaCurso()
{
            $.ajax({
                   
                async   : true, 
               
                cache   : false,
               
                type    : "POST",
               
                url     : "../controlador/recibeTemporada.php",
               
                dataType: "html",
               
                data    : 
                {
                    
                    codigoEncargadoForCursar: $("#encargado").val(),
                    
                    BuscarPreparadasListas  : 'Ready'
                },
                success: function (data) {
                   
                     
                     var html     = '';
                     var variable = JSON.parse(data);
                     var imagenicon = '';
                      $.each(variable, function(index, value){

                        
             html+="<tr >"+

             "<td hidden ></td>"+
             
             "<td >"+value['nombre_tipo_solicitud']+"</td>"+
             
             "<td >"+value['periodo']+"</td>"+
             
             "<td >"+value['estatus']+"</td>"+           
             
             "<td class='icon text-primary'>"+value['detalles']+""+
             
             "<label hidden class=code_temporraa >"+value['codigo_temporada']+"</label></td></tr>";
              
                    });

                  ArmarPreparadaforCurso('#tablaabrirTemporadas' , html);
                  $('[data-toggle="tooltip"]').tooltip();
                }

            });

}



  // función que modifica el valor de la burbuja y la agranda


  $("#tabAbrirTemporadas").click(function(){

    CargarPreparadasParaCurso();

  });




$("#Abrirsesson").click(function(){
              
                    
abrirTemporada();
});

function abrirTemporada()
{
    
       $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : 
                {
                  codigo_encargado :$("#codigo_encargado").html(),
                    abrirTemporada :$("#temporada").val()
                },
                success: function (data) 
                {
                 
                  if(data > 0){

                    swal('Bien','La Temporada Fué Abierta','success');

                  }else if ( data ==0){

                    swal('Error ','De Programación','error');
                  }
                  setTimeout(function(){ $("#litab4").trigger('click'); },1000);

                }
              });

}

function EspecialidadesAsignadasSegunTemporada( codigo_temporada)
{
    $.ajax({
            
            async   : true, 
            
            cache   : false,
            
            type    : "POST",
            
            url     : "../controlador/recibeTemporada.php",
            
            dataType: "html",
            
            data    : {
        
        codigo_temporada               :codigo_temporada,
        
        EspecialidadesAsignadasFroCurso:'BuscarEspecialidadesInfoAbrir'
    },
    success: function (data) 
    {
     
         var variable = JSON.parse(data); 
         
         if(variable[0].estatus=='EN CURSO') $("#Abrirsesson").attr('disabled',true);

         if(variable[0].estatus!='EN CURSO') $("#Abrirsesson").attr('disabled',false);

          llenarespacioEspecialidadesparaAbrirTemporada(variable);

         EventoReporte();

    $('#collapsEstudents').parent().find(".nav-pills > li.active > a").css({ "color": "#31708F", "background-color" : "#CDE7F5"});
    $('#collapsEstudents').parent().find(".nav-pills > li.active > a > span.badge").css({ "color": "#d9edf7", "background-color" : "#31708F"}); //( ./.../-/---//.-../..-/.//..-/-.-./---/.--./../.-//-.--//.--././--./.-//-.././.-..//---/-/.-./---/-../../.- )

    }
  });

}
function CrearEventosparaReportes(arreglo)
{
     $.each(arreglo,function(index , values){

        $(values).on('click',function(){
                manarReporteFormaSeguro('Reporte_EspecificoTemporada',$(".codigo",this).text() ) ;
           
        });
     });

}

function EventoReporte(){

  $("#ReporteGeneral").click(function(){
             manarReporteFormaSeguro ('Reporte_GeneralTemporada' , $("#temporada").val() );
    
  });
}

function manarReporteFormaSeguro(TipoReporte , codigo)
{
  $.ajax({
          
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../reportes/recibeReporte.php",
          
          dataType: "html",
          
          data    : 
          {
             codigo      : codigo,
             TipoReporte : TipoReporte,
             AprobarReporte: 'BuscarEntregables'
          },
          success: function (data) 
          { 
           
            window.open('../reportes/recibeReporte.php');
          }
          });
}

function EntregablesAsignadasSegunTemporada( codigo_temporada)
{
  $.ajax({
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../controlador/recibeTemporada.php",
          
          dataType: "html",
          
          data    : 
          {

             codigo_temporada    : codigo_temporada,

             EntregablesAsignados: 'BuscarEntregables'
          },
          success: function (data) 
          {
            
             var variable = JSON.parse(data);

             var html ='';

             $("#totalEntregables").html(' Total Entregalbes ( 0 ) ');

             var CrearEventos_Editar_entregable = new Array();

             var CrearEventos_Eliminar_entregable = new Array();

                 if(variable.length>0)
                 {    
                      $.each(variable,function(index , values){

                        html += '<li class="list-group-item"><span class=nameentregable>'+values['nombre_entregable']+'</span><label class=entregableVerificar hidden>'+values['nombre_entregable']+'</label>'+
                '<span class="alinear" ><div class="btn-group"  >'+
                    '<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                      'Opci&oacute;n <span class="caret"></span>'+
                      '<span class="sr-only">Toggle Dropdown</span>'+
                    '</button>'+
                    '<ul class="dropdown-menu dropdown-menu-right">'+
                      '<li id=editar_entregable'+index+'><a ><span class="glyphicon glyphicon-pencil"></span> Editar </a><label class=codigo_entregable hidden>'+values['id_entregable']+'</label></li>'+
                     
                      '<li id=eliminar_entregable'+index+'><a ><span class="glyphicon glyphicon-trash"></span> Eliminar</a><label class=codigo_entregable hidden>'+values['id_entregable']+'</label></li>'+
                    '</ul>'+
                '</div></span></li>';

                CrearEventos_Editar_entregable   [index]="#editar_entregable"+index;

                CrearEventos_Eliminar_entregable [index]="#eliminar_entregable"+index;

                $("#totalEntregables").html(' Total Entregalbes ( '+parseInt(index+1)+' ) ');

                      });
                      
                      $("#entregableCount").html(variable[0].cuantosEntregables);

                 }else $("#entregableCount").html(0);

             $("#informacionEntregables").html(html);

             procesarEventos_change_entregables(CrearEventos_Editar_entregable ,CrearEventos_Eliminar_entregable);
          }
        });

}

function EntregablesNoAsignadasSegunTemporada( codigo_temporada)
{
  $.ajax({
         
          async   : true, 
         
          cache   : false,
         
          type    : "POST",
         
          url     : "../controlador/recibeTemporada.php",
         
          dataType: "html",
         
          data    : 
          {
             codigo_temporada    : codigo_temporada,
             EntregablesNoAsignados: 'BuscarEntregablesNo'
          },
          success: function (data) 
          {
             var variable = JSON.parse(data);
             var html     ='';
             var eventoA  = Array();
                 if(variable.length>0)
                 {    
                    html += '<div class="list-group">'+

                    ' <a class="list-group-item" id=quetaa ><span class="label label-primary" >Marcar Todo</span><span class="label label-danger alinear">Desmarcar Todo</span></a>';

                      $.each(variable,function(index , values){
                        
                        html +='<a class="list-group-item" id=quetaa'+index+'>'+values['nombre_entregable']+
                        
                        '<span class="alinear"><input type="checkbox" class=toggle-demo-check data-size="mini" ></span>'+

                        '<label hidden class=id_entregableAsiiiiiiiiii>'+values['id_entregable']+'</label></a>';

                        eventoA[index]='#quetaa'+index;
                      });
                      
                      html +='<a class="list-group-item" id=lineAsignacion>'+
                      '<div align=right><button class="btn btn-primary btn-xs" id=AsignarEntregablesbaca>Asignar</button></div></a>'
                    html +='</div>';
                    

                      $("#entregablenoCount").html(variable[0].cuantosEntregables);

                 }else $("#entregablenoCount").html(0);

             $("#informacionEntregableNoAsignados").html(html);
             CrearEventoforliSeleccionableSimulandoTablasconLi(eventoA);
             
          }
        });

}

$('#entregabletxt').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiouó ');

$("#Agregarentregable").click(function(){
		//comprobar($("#entregabletxt").val());
	if($("#entregabletxt").val()=='')
	{
		$("#entregabletxt").focus();

		Mensajes('El Campo Esta Vacío');
	}else
	if($("#entregabletxt").val().length <=3)
	{
		$("#entregabletxt").focus();
		Mensajes('Ingrese al menos 4 letras');
	}
	if($("#entregabletxt").val().length > 3 && $("#entregabletxt").val() != '')
	{
			AgregarEntregableNuevo();
	}
});


function AgregarEntregableNuevo()
{
$.ajax({

        async   : true, 
        
        cache   : false,
        
        type    : "POST",
        
        url     : "../controlador/recibeTemporada.php",
        
        dataType: "html",
        
        data    : 
        {
            Nombre_Entregable   :$ .trim($("#entregabletxt").val()),

            temporada_solicitud :$ .trim($("#temporada").val()),

            RegistrarAsignarEntregableTemporada:'YES'
        },
        success: function (data) 
        {	
            
        	var variable = JSON.parse(data);

        	if(variable.asignacion==1 && variable.Registro==1 || variable.Registro =='Ya Existe' && variable.asignacion==1 ){ swal("Bien","El Entregable Se Asignó Correctamente","success");}
        		 if(variable.asignacion=='Ya Existe Asignado' ){swal("Atención",$("#entregabletxt").val()+" ya está asignado","warning");}
        			 if( variable.Registro=='No Se Pudo Registrar' ){ swal("Upss","Ocurrió un error","warning");}
              
              setTimeout(function(){
                
                  EntregablesAsignadasSegunTemporada( $("#temporada").val());

                  EntregablesNoAsignadasSegunTemporada($("#temporada").val());
                
                  BuscarLosEntregablesBD();

                  $("#litab4").trigger('click');  // .-. . ..-. .-. ... -.-. .- .-. / .-.. .- / - .- -... .-.. .- / -.. . / .- -... .- .--- ---
                
                },1000);
         
                
                $("#entregabletxt").val('');
      
                $("#headingOne").trigger('click');
        }
  });
    


}


function Mensajes(txt)
{
		$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :txt
        },
        theme          :'colorful',
        position       :'bottom right',        
        cssanimationIn : 'bounceIn',
        cssanimationOut: 'bounceOut',
        clearAll       : true
		});
}
 
function MensajeCamposVacios()
{
$.amaran({
           content        :{
           bgcolor        :'#0066CC',
           color          :'#fff',
           message        :'Por Favor Seleccione una opción Válida'
           },
           theme          :'colorful',           
           cssanimationIn :'bounceIn',
           cssanimationOut:'rollOut',
           position       :'bottom right',
           clearAll       : true
        });

}


function BuscarLosEntregablesBD()
{

     $.ajax({
        
        async   : true, 
        
        cache   : false,
        
        type    : "POST",
        
        url     : "../controlador/recibeTemporada.php",
        
        dataType: "html",
        
        data    : {
           
            temporada_solicitud :$("#temporada").val(),
            BuscarParaAutoComplete:'YES'
        },
        success: function (data) 
        {               
           
            var entregable =  JSON.parse(data);

           entregable= toObject(entregable);

           $('#entregabletxt').typeahead({

            minLength: 1,
            maxItem: 5,
            order: "asc",
            //hint: true,
            
           source: { 
               data :entregable.named
            }
                                
        });
                              
        }
      });

    
}
function toObject(arr) {

  var rv      = {};
  
  var arreglo = Array();

  $.each(arr , function(index , values){

    arreglo[index] = values.nombre_entregable;

  });

  rv['named'] =arreglo;

  return rv;
}

function CrearEventoforliSeleccionableSimulandoTablasconLi(etiqueta_a)
{
              $('.toggle-demo-check').bootstrapToggle({

                on:  '<span class="glyphicon glyphicon-ok-sign"></span>',

                off: '<span class="glyphicon glyphicon-remove-sign"></span>',

                offstyle:'danger'

              });
  $.each(etiqueta_a,function(index , values){

      $(values).on('click',function(eve){
              console.log(eve.type);
         
              ActivarCheckbox(this);

      });

  });
    checkboxMano(".toggle-demo-check");

  $("#quetaa").click(function(){

     $(".toggle-demo-check").off('change');

    if($(".toggle-demo-check").prop('checked'))
    {
        $(".toggle-demo-check").bootstrapToggle('off');
        $("#AsignarEntregablesbaca").attr('disabled',true);
    }else 
    {
        $(".toggle-demo-check").bootstrapToggle('on');
        $("#AsignarEntregablesbaca").attr('disabled',false);
    }
     checkboxMano(".toggle-demo-check");
  });

    $("#AsignarEntregablesbaca").click(function(){
      
      var idsEntregables = Array();

      $(".toggle-demo-check:checked").each( function(index , values){
        
         var algo = $(this).parent(); 

         var thing = algo.parent();

         var padre = thing.parent();

         var id_Entregable= padre.find('label[class=id_entregableAsiiiiiiiiii]');
          
          idsEntregables[index]= id_Entregable.html();
      });
      
      if(idsEntregables.length>0)  AsignarEstosEntregables( idsEntregables, $("#temporada").val());
      else Mensajes( ' Seleccione uno o varios de la lista ' );
      
    });
}

function ActivarCheckbox(id)
{
      $(".toggle-demo-check").off('change');

      $(".toggle-demo-check",id).bootstrapToggle('toggle');


      checkboxMano(".toggle-demo-check");
}
function checkboxMano(id_check)
{

$(id_check).on('change', function(eve){

  var element= $(this).parent();

  var p = element.parent();

  var sp = p.parent();

  console.log(eve.type);

  $(sp).trigger('click');

});

      var idsEntregables = Array();

      $(".toggle-demo-check:checked").each( function(index , values){
         var algo = $(this).parent(); 

         var thing = algo.parent();

         var padre = thing.parent();

         var id_Entregable= padre.find('label[class=id_entregableAsiiiiiiiiii]');
          
          idsEntregables[index]= id_Entregable.html();
      });
      
      if(idsEntregables.length>0) $("#AsignarEntregablesbaca").attr('disabled',false);
         else  $("#AsignarEntregablesbaca").attr('disabled',true);


}

function procesarEventos_change_entregables(CrearEventos_Editar_entregable ,CrearEventos_Eliminar_entregable)
{
    $.each(CrearEventos_Editar_entregable,function(index , values){

        $(values).on('click',function(){

          var ul= $(this).parent();

          var btn= $(ul).parent();

          var div= $(btn).parent();

          var li= $(div).parent();

          var spannombre = li.find('span[class=nameentregable]');

          var btn= li.find('span[class=alinear]');

          var id_entregable = $(".codigo_entregable",this).html();

          btn.html('');

          spannombre.html('<div class="input-group input-group-sm"><input type="text" class="form-control" size="50" id=entregable_editar'+index+' maxlength="30" placeholder="Entregable"  value="'+spannombre.html()+'"><span class="input-group-btn"><button class="btn btn-primary" disabled="true" type="button" id=aceptarModificacion'+index+' data-toggle="tooltip" data-placement="top" title="Modificar"><span class="glyphicon glyphicon-ok-sign"></span></button><button class="btn btn-danger" type="button" id=cancelarModificacion'+index+' data-toggle="tooltip" data-placement="top" title="Cancelar"><span class="glyphicon glyphicon-remove-sign"></span></button></span></div>');
      
          $("#aceptarModificacion"+index).click(function(){

              if( $("#entregable_editar"+index).val() == li.find('.entregableVerificar').html() || 

                  $("#entregable_editar"+index).val().toUpperCase() == li.find('.entregableVerificar').html() ){

                  Mensajes('No existe una diferencia con:'+li.find('.entregableVerificar').html());

                  $("#entregable_editar"+index).focus();

              }else if( $("#entregable_editar"+index).val() != li.find('.entregableVerificar').html() )

              {
                  ActualizarEntregable($("#entregable_editar"+index).val() , li.find('.entregableVerificar').html(), id_entregable , $("#temporada").val());
              }

          }); // Si Hace Click En el Boton Aceptar Modificacion  o Si  o  listo lo que  sea el Boton Azul 

         $("#cancelarModificacion"+index).click(function(){

            EntregablesAsignadasSegunTemporada( $("#temporada").val());

         });
             $("#aceptarModificacion"+index).tooltip('toggle');
             $("#aceptarModificacion"+index).tooltip('toggle');
             $("#cancelarModificacion"+index).tooltip('toggle');
             $("#cancelarModificacion"+index).tooltip('toggle');

        $('#entregable_editar'+index).validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');

        $('#entregable_editar'+index).on('keyup',function(){

            if( $("#entregable_editar"+index).val() == li.find('.entregableVerificar').html() || 

              $("#entregable_editar"+index).val().toUpperCase() == li.find('.entregableVerificar').html() ||

              $("#entregable_editar"+index).val()==''  ){

                $('#aceptarModificacion'+index).attr('disabled',true);

            }else if($("#entregable_editar"+index).val().length<4){

                $('#aceptarModificacion'+index).attr('disabled',true);

            }else{

               $('#aceptarModificacion'+index).attr('disabled',false);
            }
          
        });
        
        });
     });
    $.each(CrearEventos_Eliminar_entregable,function(index , values){

        $(values).on('click',function(){
          var ul  = $(this).parent();
          
          var btn = $(ul).parent();
          
          var div = $(btn).parent();
          
          var li  = $(div).parent();

          var spannombre = li.find('span[class=nameentregable]');

          var btn= li.find('span[class=badge]');

          var id_entregable = $(".codigo_entregable",this).html();
         

          swal({  

              title             :"Atención",
              
              text              :"¿ Estas Seguro de Eliminar esta Asignación ?",
              
              type              :"warning", 
              
              showCancelButton  : true,
              
              confirmButtonColor: "#6699FF",  
              
              confirmButtonText : "Eliminar ",
              
              closeOnConfirm    : false }

              , function(){  QuitarAsignacion( spannombre.html() , id_entregable ,  $("#temporada").val() ) }); // SWAL()//Function()
          
        });
     });
}

function ActualizarEntregable(newEntregable , oldEntregable, id_entregable , codigo_temporada)
{
   $.ajax({
       
       async   : true, 
       
       cache   : false,
       
       type    : "POST",
       
       url     : "../controlador/recibeTemporada.php",
       
       dataType: "html",
       
       data    : 
     {
       
         entregable_N        : newEntregable,

         entregable_O        : oldEntregable,

         id_entregableviejo  : id_entregable,

         codigo_temporada    : codigo_temporada,

         ActualizarEntregable: 'YES'
     },
     success: function (data) 
     {               
        var variable = JSON.parse(data); 

        swal(variable.title, variable.messge, variable.alert); 
        
        setTimeout(function(){

            EntregablesAsignadasSegunTemporada(  $("#temporada").val());

            EntregablesNoAsignadasSegunTemporada($("#temporada").val());

        },1000);

     }
   });
}


function QuitarAsignacion(Entregable, id_entregable , codigo_temporada)
{

$.ajax({
               
         async   : true, 
         
         cache   : false,
         
         type    : "POST",
         
         url     : "../controlador/recibeTemporada.php",
         
         dataType: "html",
         
         data    : 
         {
           
             entregable          : Entregable,

             id_entregableviejo  : id_entregable,

             codigo_temporada    : codigo_temporada,

             QuitarTHisAsignacion: 'YES'
         },
         success: function (data) 
         {          
            var variable = JSON.parse(data); 

            swal(variable.titled, variable.textmesagge, variable.alert); 

            setTimeout(function(){

                EntregablesAsignadasSegunTemporada(  $("#temporada").val());

                EntregablesNoAsignadasSegunTemporada($("#temporada").val());

                $("#litab4").trigger('click');  // .-. . ..-. .-. ... -.-. .- .-. / .-.. .- / - .- -... .-.. .- / -.. . / .- -... .- .--- ---
              

            },1000);

         }
       });
}

function AsignarEstosEntregables(ids_Entre , codigo_temporada)
{
   $.ajax({
          
         async   : true, 
        
         cache   : false,
        
         type    : "POST",
        
         url     : "../controlador/recibeTemporada.php",
        
         dataType: "html",
        
         data    : 
         {
           
             ids  : ids_Entre,

             codigo_temporada    : codigo_temporada,

             AsignarLoteEntregables: 'YES'
         },
         success: function (data) 
         {          //alert(data);
            var variable = JSON.parse(data); 
            if(data==ids_Entre.length)
              {
                  swal("Bien", "La Asignación se hizo Correctamente", "success"); 
              }else if (data<ids_Entre.length && data>0) 
              {
                  swal("ups", "Algunos de los Entregables No se asignaron", "warning"); 
              }else if(data ==0)
              {
                  swal("Error", "Ocurrio un error En el Servidor", "error"); 
              }
            setTimeout(function(){

              EntregablesAsignadasSegunTemporada(  $("#temporada").val());

              EntregablesNoAsignadasSegunTemporada($("#temporada").val()); 

              $("#litab4").trigger('click');  // .-. . ..-. .-. ... -.-. .- .-. / .-.. .- / - .- -... .-.. .- / -.. . / .- -... .- .--- ---
                

            },1000);


         }
       });
}

function HacerResumendeEstatemporada( codigo_temporada )
{
    $.ajax({
         
         async   : true, 
         
         cache   : false,
         
         type    : "POST",
         
         url     : "../controlador/recibeTemporada.php",
         
         dataType: "html",
         
         data    : 
         {

             hacerResumenTemporada: codigo_temporada
         },
         success: function (data) 
         {         // alert(data);
            var sql = JSON.parse(data);

            listaentregables = '' ;

            $.each( sql[1] , function (index ,  values){

              listaentregables+='<a class="list-group-item"><span class=namentregableresumen>'+

              values['nombre_entregable']+'</span> </a>';

              $("#with2").html("Total Entregables ( "+ parseInt(index+1) +" )");

            });

            $("#ResumenEntregablesTemporada").html( listaentregables );

            CREANDOpanelsegun_TipoEspecialidad( sql[0] );
           
         }// success ..... other words : .../..-/-.-./-.-././.../...
      });
}

function hacerEventosdedetallesEspecialidadess( class_list_item,ids_popovers)
{   
    $.each( ids_popovers , function(index , value){

       $(value).popover({

        title    : '<h5 class="panel-title" ><span class="label label-primary" >Esperando Consultas</span></h5>',
        
        content  :'<span class="label label-primary" >En Construccion</span>',
        
        html     : true,
        
        trigger  : '',
        
        placement:'left'});

    $(value).on('click',function(a){
          $(this).parent().off('click');
     
          if( $(this).parent().find('.arrow').is(':visible') )  $(this).popover('hide');
  
            else if(! $(this).parent().find('.arrow').is(':visible') ) $(this).popover('show');                             

             delete_popover_BEROREConfirm(class_list_item , value);

              $(this).parent().on('click',function(){

              $(this).off('click');

              OnLi(class_list_item,value);

             });  // Si REcuerdas este Dia sabras de que hablo! ( ./._.. _../../._  _ _._/.._/. ._ _./._./._/_._./_/../_._./._/_.../._ )( --/---/._./.../. -.-./---/-. .-../.-/... --/..-/-.-./.-/-.-./.-/... ) ( -----/----. .----/.---- ..---/-----/.----/..... )   
    });  
    OnLi(class_list_item,value);

     });

    $('#accoResum').find(".nav-pills>li ").css({"float":"right"}); // ( ./.-..//-../../.-//--.-/..-/.//.--././.-./-.././/--/..//.--././-./-../.-./../...-/./.-./ )
    $('#accoResum').parent().find(".nav-pills > li.active > a").css({ "color": "#31708F", "background-color" : "#CDE7F5"});// ( ..-./.-./../-../.-/-.--//../-.//-/...././/.-/..-./-/./.-./-./..-/-. )
    $('#accoResum').parent().find(".nav-pills > li.active > a > span.badge").css({ "color": "#d9edf7", "background-color" : "#31708F"}); //( -/..../../.-./-/././-.//---/..-.//-./---/...-/./-./--/-..././.-. )
    
}

function OnLi(class_list_item,value)
{
    $(value).parent().on('click',function(){ 

          $(class_list_item).each(function ( index ){

              if('#list-item'+index!= value && $(this).find('.arrow').is(':visible')){

              $(this).find('#list-item'+index).popover('toggle'); // THANK's LORD

              }
          });

        if( $(this).find('.arrow').is(':visible') ) $(this).find(value).popover('hide'); 

          else $(this).find(value).popover('show');
    });
}

function delete_popover_BEROREConfirm(class_list_item , value)
{
    $(class_list_item).each(function ( index ){

    if('#list-item'+index!= value && $(this).find('.arrow').is(':visible')){

    $(this).find('#list-item'+index).popover('hide'); // THANK's LORD

    } 
      
    });
    
}

$(document).ready(function(){
  
    Selectperiodo();
  
    SelecttipoSolicitud();

    IniEventos();

    iniSelects();

              $('.toggle-demo-check').bootstrapToggle({

                on      :  'Esperando Tipo Solicitud',
                
                off     : 'Esperando Tipo Solicitud',
                
                offstyle:'danger'

              });
            $("#tipo_solicitud").change(function(){

              if($("#tipo_solicitud").val() !='')BuscardescripciontipoSolicitud();
              else   {
                    $('.toggle-demo-check').bootstrapToggle('destroy');

                    $('.toggle-demo-check').bootstrapToggle({

                    off: 'Esperando Tipo Solicitud',

                    offstyle:'danger'

                  }); 
              }
            });
    llenartablaTemporadas();
});

function iniSelects()
{
  Reutilise = { 
      // Uses the jQuery 'fadeIn' effect when opening the drop down
      showEffect: "fadeIn",

      // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
      showEffectSpeed: 400,

      // Uses the jQuery 'fadeOut' effect when closing the drop down
      hideEffect: "fadeOut",

      // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
      hideEffectSpeed: 400 };

    $("#periodo").selectBoxIt(Reutilise);
    $("#tipo_solicitud").selectBoxIt(Reutilise);
    $("#estatus").selectBoxIt(Reutilise);
    $("#especialidadesTemporada").selectBoxIt(Reutilise);
    Renderidng_select();
}

function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"min-width": "206px" ,  "height": "35px"});
}

function BuscardescripciontipoSolicitud()
{
  $.ajax({
        
        async   : true, 
        
        cache   : false,
        
        type    : "POST",
        
        url     : "../controlador/recibeTemporada.php",
        
        dataType: "html",
        
        data    : 
        {
        
            tipo_solicitud:$("#tipo_solicitud").val(),
            BuscardescripciontipoSolicitud:'descripcion'
        },
        success: function (data) 
        {

        var Variable = JSON.parse(data);
          $(".toggle-demo-check").bootstrapToggle('destroy');
             $(".toggle-demo-check").bootstrapToggle({
              on:  'Esperando Tipo Solicitud',
              off: Variable.descripcion ,
              offstyle : Variable.style
             });
             $(".toggle-demo-check").bootstrapToggle('off');
        }// .../..-/-.-./-.-././.../...//

  });

}

function CREANDOpanelsegun_TipoEspecialidad( sql )
{
  $("#accoResum").html("");$("#TotalEspecialidadesGeneral").html(0);

  var Cerrar_Panel1 ="</div> <!-- CIERRO PANEL BODY -->"+
  
  "<div class=panel-footer>"+
    
  "<ul class='nav nav-pills' role='tablist' >"+

  "<li role='presentation' class='active' ><a  >Total Estudiantes";

  var Cerrar_Panel2="</span></a></li>"+
    
  "</ul>"+ 
  
  "</div>"+

  "</div>"+

  "</div> <!-- Panel -Especialidades Asignados-->";

            listaespecialidades = '' ; tipo_especialidad ='';
            var total = 0 ;  ids_popovers= Array();
            
            $.each( sql,function (index ,  values){
              
              if(tipo_especialidad !=values['nombre_tipo_especialidad'] &&  index>0 ){listaespecialidades +=Cerrar_Panel1 +' '+tipo_especialidad +'<span class="badge">' +total+Cerrar_Panel2;  total = 0}

              if(index==0 || tipo_especialidad !=values['nombre_tipo_especialidad'] )listaespecialidades +=  

  "<div class='panel panel-info'>"+

  "<div class='panel-heading collapsed'  role=tab id=Rsmen"+index+" data-toggle=collapse data-parent=#accoResum aria-expanded='false' aria-controls=EspecialidadRs"+index+" data-target=#EspecialidadRs"+index+" style='cursor:pointer'>"+
                  
  "<h4 class=panel-title ><span >"+values['nombre_tipo_especialidad']+"</span> <span class=badge id='with"+index+"'>Total Especialidades ( "+values['cantidad_especialidades_d']+" )</span></h4> </div>"+
  
  "<div id=EspecialidadRs"+index+" class='panel-collapse collapse' role=tabpanel aria-labelledby=Rsmen"+index+">"+
  
  "<div class=panel-body>";

               listaespecialidades+='<a class="list-group-item" ><span class=namespecialidadresumen>'+

               values['nombre_especialidad']+'</span><span '+

               'class="badge badge-info" id=list-item'+index+'> Estudiantes ( '+

               values['cantidad_estudiantes']+' )</span> </a>';

               total = total+parseInt(values['cantidad_estudiantes']);

               ids_popovers[index]='#list-item'+index;  tipo_especialidad = values['nombre_tipo_especialidad'];
               
               $("#totalespecialidades").html( 'Total Especialidades ( '+ parseInt(index +1) +' )' );

               $("#TotalEspecialidadesGeneral").html(parseInt(values['cantidad_estudiantes'])+ parseInt($("#TotalEspecialidadesGeneral").html() ) );
            }); 

            $("#accoResum").html(listaespecialidades+ Cerrar_Panel1 +' '+tipo_especialidad +'<span class=badge>'+total+Cerrar_Panel2 +$("#accoResum").html() );
            
            hacerEventosdedetallesEspecialidadess( '.list-group-item' , ids_popovers );
}


  $("#ReporteTEmporadaDetalles").click(function(){
        AprobarReporteDetallesTemporadasucursal();
  });


function AprobarReporteDetallesTemporadasucursal()
{

  $.ajax({
          
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../reportes/recibeReporte.php",
          
          dataType: "html",
          
          data    : 
          {
            codigo        :$("#temporada").val(),
            AprobarReporte:'SiiiiChico',
            TipoReporte   :'Reporte_DetalleTemporada'
          },
          success: function (data) {

            var Variable = JSON.parse(data);
              if(Variable=='Reporte_DetalleTemporada') window.open("../reportes/recibeReporte.php");
          }// .../..-/-.-./-.-././.../...//

  });

}



function llenarespacioEspecialidadesparaAbrirTemporada(variable)
{

 $("#totalEstudiantes").html(0);

  var Cerrar_Panel1 ="</div> <!-- CIERRO PANEL BODY -->"+
  
  "<div class=panel-footer>"+
    
  "<ul class='nav nav-pills' role='tablist' >"+


  "<li role='presentation' class='active' ><a  >Total Estudiantes";

  var Cerrar_Panel2="</span></a></li>"+
    
  "</ul>"+ 
  
  "</div>"+

  "</div>"+

  "</div> <!-- Panel -Especialidades Asignados-->";

          tipo_especialidad =''; var total = 0 ;  

   html =''; contenedor_eventos= new Array();  totalEstudiantes =0;  claseReporte = '';

   $.each(variable,function(index , values){

              if(tipo_especialidad !=values['nombre_tipo_especialidad'] &&  index>0 ){html +=Cerrar_Panel1 +' '+tipo_especialidad +'<span class="badge">' +totalEstudiantes+Cerrar_Panel2;  totalEstudiantes = 0}

              if(index==0 || tipo_especialidad !=values['nombre_tipo_especialidad'] )html +=  

  "<div class='panel panel-info'>"+

  "<div class='panel-heading collapsed' role=tab id=Especialicollapse"+index+" data-toggle=collapse data-parent=#informacionEspecialidadesAsignadas aria-expanded='false' aria-controls=EspecialidadOpenm"+index+" data-target=#EspecialidadOpenm"+index+" style='cursor:pointer'>"+
                  
  "<h4 class=panel-title ><span > "+values['nombre_tipo_especialidad']+"</span> <span class=badge id='with"+index+"'>Total Especialidades ( "+values['numespecialidadestipo']+" )</span></h4> </div>"+
  
  "<div id=EspecialidadOpenm"+index+" class='panel-collapse collapse' role=tabpanel aria-labelledby=Especialicollapse"+index+">"+
  
  "<div class=panel-body>";

          if( values['numeroEstudiantes']==0){claseReporte='class=disabled';}else claseReporte='';

          html +='<li class="list-group-item">'+values['nombre_especialidad']+''+

          //'<span class="badge badge-info">'+values['numeroEstudiantes']+' &nbsp;&nbsp; ESTUDIANTES</span></li>';
         
          '<span class="alinear"><div class="btn-group" >'+
         
         '<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
         
            'Detalles <span class="caret"></span>'+
          
            '<span class="sr-only">Toggle Dropdown</span>'+
          
          '</button>'+
          
          '<ul class="dropdown-menu dropdown-menu-right">'+
          
            '<li><a >Estudiantes <span class="badge badge-info">'+values['numeroEstudiantes']+'</span> </a></li>'+
           
            '<li role="separator" class="divider"></li>'+
          
            '<li '+claseReporte+' id=reporte'+index+' ><a > <span class="glyphicon glyphicon-download-alt"></span> Reporte</a><label class=codigo hidden>'+values['codigo_temporada_especialidad']+'</label></li>'+
          
          '</ul>'+
        
        '</div></span></li>';
        
        totalEstudiantes = parseInt(values['numeroEstudiantes'])+totalEstudiantes;
        
        $("#totalEstudiantes").html(parseInt($("#totalEstudiantes").html())+parseInt(values['numeroEstudiantes']) );

        contenedor_eventos[index]='#reporte'+index;

        tipo_especialidad = values['nombre_tipo_especialidad']; 
         });

         $("#totalEspecialidades").html( 'Total Especialidades ( '+ variable.length + ' )' );

         
         html +=Cerrar_Panel1 +' '+tipo_especialidad +'<span class="badge">' +totalEstudiantes+Cerrar_Panel2;  
         $("#informacionEspecialidadesAsignadas").html(html);

         CrearEventosparaReportes(contenedor_eventos);
}