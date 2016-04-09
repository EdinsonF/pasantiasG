$(document).ready(function(){

    crearPestañas();
});

function crearPestañas()
{
                $.ajax({
                        
                        async   : true, 
                        
                        cache   : false,
                        
                        type    : "POST",
                        
                        url     : "../controlador/recibeTemporada.php",
                        
                        dataType: "html",
                        
                        data    : {                 

                  TemporadasCurso:$("#encargado").val()
                  
                },
                success: function (data) {
                   
                    var Variable        = JSON.parse(data);
                    
                    var pesta           ='';
                    
                    var id_tabs         = Array();
                    
                    var codigo_temporada= Array();
                    
                    $.each(Variable, function(index, value){

                    	pesta += '<li id='+index+' data-target=#tab'+index+'  data-toggle=tab ><a >'+
                    	
                      '<strong>'+value['nombre_tipo_solicitud']+' - '+value['periodo']+'</strong></a>'+
                    	
                      '<label class=codigo hidden style=display:none>'+value['codigo_temporada']+'</label></li>';
                    	
                    	id_tabs[index]=index;
                    	
                    });
                    
                    if(Variable.length==0)
                    {

                    	pesta+=

                      '<li data-target=#tab data-toggle=tab><a >'+
                    	
                      '<strong>No Hay Temporadas en Curso</strong></a></li>';

                    }
                   
                   agregarPestanas(pesta , id_tabs );
                }

            });



}


function agregarPestanas(html ,id_tabs )
{


$("#pestana").html(html);

     $('#pestana li').click(function(e) 
     {
     BuscarEspecialidadesTemporada($(".codigo",this).text());
     });

					
}
function agregarcontenidotab(html , tablas)
{
	
$("#contenidoEspecial").html(html);
 $.each(tablas, function(index, value){

 	DarDataTable_Librer(value);

 });

		
}


function BuscarEspecialidadesTemporada( codigo_temporada){
 				$.ajax({
                async   : true, 
               
                cache   : false,
               
                type    : "POST",
               
                url     : "../controlador/recibeTemporada.php",
               
                dataType: "html",
               
                data    : 
                {                 
                  EspecialidadesdeTemporadasCurso:codigo_temporada
                },
                success: (data) => {
                    
                    ids          = Array();
                    var Variable = JSON.parse(data);
                    if (Variable) {
                      var Paneles= '<br><div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';//<ul class="nav nav-tabs" id=especialidad >';
                    
                    }
                     $.each(Variable, (index, value) => {

                     	// pestañasEspecialidades+='<li ><a href=#especialidad'+index+' data-toggle=tab>'+
                						// 		'<strong>'+value['especialidad']+'</strong></a>'+
                						// 		'<label class=codigo_temporada_especialidad  style=display:none>'+value['codigo_temporada_especialidad']+'</label></li>'
                            ids[index]= '#Especialicollapse'+index;

  Paneles+="<div class='panel panel-info'>"+

  "<div class='panel-heading collapsed' role=tab id=Especialicollapse"+index+" data-toggle=collapse data-parent=#accordion aria-expanded='false' aria-controls=EspecialidadOpenm"+index+" data-target=#EspecialidadOpenm"+index+" style='cursor:pointer ; width:99%'>"+
                  
  "<h4 class=panel-title ><span >"+value['especialidad']+"</span> <span class=badge id='with"+index+"'>Total Estudiantes ( "+value['cantidadestudiantes']+" )</span></h4><label class=codigo_temporada_especialidad hidden style=display:none>"+value['codigo_temporada_especialidad']+"</label> </div>"+
  
  "<div id=EspecialidadOpenm"+index+" class='panel-collapse collapse' role=tabpanel aria-labelledby=Especialicollapse"+index+">"+
  
  "<div class=panel-body></i></div></div></div>";
                     });
                    //pestañasEspecialidades+='</ul>';
                    
                    buscarEstatemporada(codigo_temporada , Paneles , ids);
                }

            });
}


function buscarEstatemporada(codigo , pestañasEspecialidades , ids)
{   
        
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
                success: function (data) {

                  var varia = JSON.parse(data);

                  if (varia){

                var mensaje_dias_calculados = '<span class="glyphicon glyphicon-hourglass"></span> '+varia['calculo_tiempo']+' <br>';
               

                if(varia['colore']=='warning') varia['estatus'] += ' ADMINISTRADOR';

                varia['descripcion'] = ( varia['descripcion'] == 'true' ) ?

                  '<label class="text-success">SI <span class="glyphicon glyphicon-ok-sign"></span></label>' :
                  '<label class="text-warning">NO <span class="glyphicon glyphicon-alert"></span></label>' ;

                  varia['estatus'] = (varia['colore'])  ? 

                    '<label class="text-'+varia['colore']+'">'+varia['estatus']+'</label>' : 
                    '<label class="text-'+varia['colore']+'">'+varia['estatus']+'</label>' ;

            var html = '<br><pre ><br> <label >Persona Encargada : </label> '+varia['encargado'] +'      <br> '+
                                 
                                 '<label >Tipo de Solicitud : </label> '+varia['nombre_tipo_solicitud']+'<br> '+

                                 '<label >Tutores           : </label> '+varia['descripcion']+'          <br> '+
                                 
                                 '<label >Estatus           : </label> '+varia['estatus']+'              <br> '+
                                 
                                 '<label >Periodo           : </label> '+varia['periodo']+'              <br> '+

                                 '<label >Tiempo Periodo    : </label> '+varia['calculodeperiodo']+'     <br> '+
                                 
                                 '<label >Lapso Acad&eacute;mico   : </label> '+varia['lapsoacademico']+'<br> </pre>'; 
                                 
                                 html+='<button onClick="CerrarTemporadaEvento(this)" class="btn btn-lg btn-primary btn-block" ><strong><span class="glyphicon glyphicon-level-up" ></span> Cerrar Temporada</strong><label class=codigo_cerrar hidden style=display:none>'+codigo+'</label></button>';
                    
                    if(varia['colore']=='warning') 
                    {
                       html+= '<br><div class="alert alert-warning" role="alert"> '+mensaje_dias_calculados+' <span class="glyphicon glyphicon-info-sign"></span><strong> Advertencia!</strong> La Fecha Actual ( '+varia['very_now']+' ) está Fuera de Rango del periodo de Solicitud ... <br> El Estatus "<strong>En Curso Administrador</strong>" Explica que el periodo de solicitud no le será habilitado a los estudiantes esta temporada, puesto que para ellos ( los Estudiantes ),<br> el Periodo aún no ha comenzado ó ya expiró .</div>';   
                    
                    }else { html+= '<br><div class="alert alert-success" role="alert"> La Fecha Actual ( '+varia['very_now']+' )<br> '+mensaje_dias_calculados+'</div>';  }

                  pestañasEspecialidades = html + pestañasEspecialidades;
                  
                  }
                  var id_boton = "#cerrar_temporada"+codigo;
                  crearPestanasdeEspecialidesThis( pestañasEspecialidades , ids , id_boton); 
                 
                }
                 
            });
} 

function crearPestanasdeEspecialidesThis(especialidades ,ids , id_boton)
{

    $("#contenidoEspecial").html(especialidades);

    $.each(ids , ( index , values ) =>{

      $(values).click(function(e) 
      { 
          icono = "<center><i class='fa fa-spinner fa-pulse fa-2x'></i> Cargando...</center>";
          
          $(this).parent().find(".panel-body").html(icono);

          BuscarEstudiantesEsepcialidadTemporada($(".codigo_temporada_especialidad",this).text() , $(this).parent().find('.panel-body'));
      });  
         
    });

}

function CerrarTemporadaEvento( button )
{ 

CerrarTemporada($(button).find('.codigo_cerrar').html());
}

function BuscarEstudiantesEsepcialidadTemporada(codigo_temporada_especialidad , imprimir_info)
{

		$.ajax({
        async   : true, 
        
        cache   : false,
        
        type    : "POST",
        
        url     : "../controlador/recibeTemporada.php",
        
        dataType: "html",
        
        data    : 
        {
          VerEstudiantesdeEstaTemporadaCurso:codigo_temporada_especialidad
        },
        success: (data) =>{
          
            var Var              = JSON.parse(data);
            var ordenespestaneos = Array();

        $.each(Var, (index , value) => {
              
            if(index === 'Ejecutar')

            RecibirOrdenes(ordenespestaneos , value[0] , imprimir_info);

            else
               
              if(value[0] > 0)

              ordenespestaneos[ordenespestaneos.length] =  buscarCoincidencia( value[1] ) ;

        });

			       
        }

    	});

}


function buscarCoincidencia( Model )
{ 
    if(Model === 'BuscarEstudiantesNoPostulados')return  BuscarEstudiantesNoPostulados;
    if(Model === 'BuscarEstudiantesPostulados')  return  BuscarEstudiantesPostulados;
    if(Model === 'BuscarEstudiantesAprobados')   return  BuscarEstudiantesAprobados;
    if(Model === 'BuscarEstudiantesSinTutores')  return  BuscarEstudiantesSinTutores;
    if(Model === 'BuscarEstudiantesConTutores')  return  BuscarEstudiantesConTutores;
    if(Model === 'BuscarEstudiantesNoSolventes') return  BuscarEstudiantesNoSolventes;
    if(Model === 'BuscarEstudiantesSolventes')   return  BuscarEstudiantesSolventes;
}


var li                = '';

var div               = '';

var ids_tablas        = Array();

var id_boton_reportes = Array();

function RecibirOrdenes(ordenes , codigo_temporada_especialidad , imprimir_info)
{

  li                = '';

  div               = '';

  ids_tablas        = Array();

  id_boton_reportes = Array();

        if(ordenes.length > 0)
        {
          ordenes[0](imprimir_info ,codigo_temporada_especialidad,ordenes,0,ordenes.length-1);
        }
        if(ordenes.length==0)
        {

          li ='<li ><a  data-toggle=tab><strong>Sin Información Disponible</strong></a></li>';
                   
          PestanasEstudiantes(imprimir_info ,li , '' , ids_tablas , id_boton_reportes);

        }
}


function BuscarEstudiantesNoPostulados ( donde_imprimir ,codigo_temporada_especialidad , siguiente ,yo,  ultimo)
{
           var  pestañasEstudiantes ='<li data-target=#NoPostulados data-toggle=tab ><a >'+
           
                  '<strong>No Postulados</strong></a></li>';
           
           var html='';

                  html += '<div class=tab-pane id=NoPostulados><br><div class="table-responsive">'; 
           
                  html +='<table class="table table-striped table-hover dt-responsive nowrap compact" id=tableNoPostulados style='+'"cursor:pointer ; width:99%"'+'>'+
                    
                    '<thead><tr>'+
                      
                      '<th>Expediente</th>'+
                      
                      '<th>C&eacute;dula</th>'+
                      
                      '<th>Estudiante</th>'+
                      
                      '<th>Correo</th>'+
                      
                      '<th>Tel&eacute;fono</th>'+
                      
                      '<th hidden>codigo_estudiante</th>'+
                    
                    '</tr></thead>';

        $.ajax({

                async   : true, 

                cache   : false,

                type    : "POST",

                url     : "../controlador/recibeTemporada.php",

                dataType: "html",

                data    : {
                  BuscarEstudiantesNoPostulados:codigo_temporada_especialidad
                },
                success: function (data){
                      var saltoslast   ='<br>';   
                      var boton_Reporte='';
                      var Variable     = JSON.parse(data);
                     $.each(Variable, function(index, value){
              
              html+='<tr>'+

              '<td>'+value['expediente']+'</td>'+
              
              '<td>'+value['cedula']+'</td>'+
              
              '<td>'+value['estudiante']+'</td>'+
              
              '<td>'+value['correo']+'</td>'+
              
              '<td>'+value['telefono']+'</td>'+
              
              '<td hidden>'+value['codigo_estudiante']+'</td></tr>';
              
              //saltoslast +='<>';
              boton_Reporte = '<button id=ReporteNoPostulado class="btn btn-primary btn-block" ><strong><span class="glyphicon glyphicon-download-alt"></span> Reporte ('+ parseInt( 1+index ) +') Estudiantes</strong>  <label hidden class="codigo_temporada_reportar" >'+codigo_temporada_especialidad+'</label></button>';
                       });
              html +='</table></div>'+saltoslast+ boton_Reporte+'</div>';
                    li    += pestañasEstudiantes;
                    div   += html;
                    ids_tablas[yo]  = '#tableNoPostulados';
                    id_boton_reportes[yo] = {id_boton : "#ReporteNoPostulado" , descripcion : REPORTE_NO_POSTULADOS };
                     if( yo ==  ultimo)
                     {
                       PestanasEstudiantes(donde_imprimir ,li , div , ids_tablas , id_boton_reportes);
                     }else { siguiente[yo+1]( donde_imprimir,codigo_temporada_especialidad , siguiente ,yo+1,  ultimo); }
                }

              });
     

}

function BuscarEstudiantesPostulados ( donde_imprimir ,codigo_temporada_especialidad , siguiente ,yo,  ultimo)
{
   var  pestañasEstudiantes ='<li data-target=#Postulados data-toggle=tab><a >'+
                  
                  '<strong>Postulados</strong></a></li>';
    
   var html='';
              
      html += '<div class=tab-pane id=Postulados><br><div class="table-responsive">';
                  
      html +='<table class="table table-striped table-hover dt-responsive nowrap compact"  id=tablePostulados style='+'"cursor :pointer ; width:99%"'+'>'+
                   
                    '<thead><tr>'+
                   
                      '<th >Organizaci&oacute;n</th>'+
                   
                      '<th >Sede</th>'+
                   
                      '<th >Realizada Por</th>'+
                   
                      '<th >Expediente</th>'+
                   
                      '<th >C&eacute;dula</th>'+
                   
                      '<th >Estudiante</th>'+
                   
                      '<th >Correo</th>'+
                   
                      '<th >Tel&eacute;fono</th>'+
                                      
                    '</tr></thead>';

        $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : {
                 
                  BuscarEstudiantesPostulados:codigo_temporada_especialidad
                },
                success: function (data){
                  
            var saltoslast=''; 
            var boton_Reporte='';                 
                    var Variable = JSON.parse(data);
                     $.each(Variable, function(index, value){
                          html+='<tr>'+
              
              '<td>'+value['nombre_organizacion']+'</td>'+
              
              '<td><img src=../../../img/Ico-master/PNG/64px/0135-search.png alt=Ginger class=left width=20 ./>'+
              
              '<label hidden class=sucursal>'+value['sucursal']+'</label></td>'+
              
              '<td>'+value['solicitant']+'</td>'+
              
              '<td>'+value['expediente']+'</td>'+
              
              '<td>'+value['cedula']+'</td>'+
              
              '<td>'+value['estudiante']+'</td>'+
              
              '<td>'+value['correo']+'</td>'+
              
              '<td>'+value['telefono']+'</td></tr>';
              
              saltoslast +='<br>';
              
              boton_Reporte = '<button id=ReportePostulado class="btn btn-primary btn-block" ><strong><span class="glyphicon glyphicon-download-alt"></span> Reporte ('+ parseInt( 1+index ) +') Estudiantes</strong>  <label hidden class="codigo_temporada_reportar" >'+codigo_temporada_especialidad+'</label></button>';
                       });
              html +='</table></div>'+saltoslast+ boton_Reporte+'</div>';
                   
                    li    += pestañasEstudiantes;
                   
                    div   += html;
                   
                    ids_tablas[yo] = '#tablePostulados';
                   
                    id_boton_reportes[yo] = {id_boton : "#ReportePostulado" , descripcion : REPORTE_POSTULADOS };
                   
                     if( yo ==  ultimo)
                   
                     {
                   
                       PestanasEstudiantes(donde_imprimir ,li , div , ids_tablas , id_boton_reportes);
                   
                     }else { siguiente[yo+1](donde_imprimir,codigo_temporada_especialidad , siguiente ,yo+1,  ultimo); }                 
                }

              });
	
}

function BuscarEstudiantesAprobados ( donde_imprimir ,codigo_temporada_especialidad , siguiente ,yo,  ultimo)
{
   var  pestañasEstudiantes = '<li data-target=#AprobadosOrganizacion data-toggle=tab><a >'+
                   
                              '<strong>Aprobados Por Organizaci&oacute;n</strong></a></li>';
    var html='';
        
        html += '<div class=tab-pane id=AprobadosOrganizacion><br><div class="table-responsive">';
                  
        html +='<table class="table table-striped table-hover dt-responsive nowrap compact"  id=tablePostuladosAprobadosOrganizacion style='+'"cursor :pointer ; width:99%"'+'>'+
                   
                    '<thead><tr>'+
                   
                      '<th>Organizaci&oacute;n</th>'+
                   
                      '<th>Sede</th>'+ 
                   
                      '<th>Realizada Por</th>'+                   
                   
                      '<th>Expediente</th>'+
                   
                      '<th>C&eacute;dula</th>'+
                   
                      '<th >Estudiante</th>'+
                   
                      '<th >Correo</th>'+
                   
                      '<th >Tel&eacute;fono</th>'+
                   
                      '<th  >Aprobar</th>'+
                   
                      '<th hidden >codigosolicitud</th>'+
                   
                      '<th hidden >codigoestudiante</th>'+
                   
                    '</tr></thead>';

        $.ajax({
               
                async   : true, 
               
                cache   : false,
               
                type    : "POST",
               
                url     : "../controlador/recibeTemporada.php",
               
                dataType: "html",
               
                data    : 
                {
                  BuscarEstudiantesAprobadosOrganizacion:codigo_temporada_especialidad
                },
                success: function (data){
                  	var boton_Reporte='';                 

                    var saltoslast='';                  
                    var Variable = JSON.parse(data);
                     $.each(Variable, function(index, value){
                          html+='<tr>'+
              
              '<td>'+value['nombre_organizacion']+'</td>'+
              
              '<td><img src=../../../img/Ico-master/PNG/64px/0135-search.png alt=Ginger class=left width=20 ./>'+
              
              '<label hidden style=display:none class=sucursal>'+value['sucursal']+'</label></td>'+
              
              '<td>'+value['solicitant']+'</td>'+
              
              '<td>'+value['expediente']+'</td>'+
              
              '<td>'+value['cedula']+'</td>'+
              
              '<td>'+value['estudiante']+'</td>'+
              
              '<td>'+value['correo']+'</td>'+
              
              '<td>'+value['telefono']+'</td>'+
              
              '<td><img src=../../../img/iconos/ok.png alt=Ginger class=left width=20 ./></td>'+
              
              '<td hidden >'+value['codigo_solicitud']+'</td>'+
              
              '<td hidden >'+value['codigo_estudiante']+'</td></tr>';
              
              saltoslast +='<br>';
              boton_Reporte = '<button id=ReporteAprobados_Organizacion class="btn btn-primary btn-block" ><strong><span class="glyphicon glyphicon-download-alt"></span> Reporte ('+ parseInt( 1+index ) +') Estudiantes</strong>  <label hidden class="codigo_temporada_reportar" >'+codigo_temporada_especialidad+'</label></button>';

                       });
                var boton_aprobar_estudiantes = '<button id=Aprobar_Solicitudes class="btn btn-primary btn-block" disabled="disabled" ><strong> Aprobar  Estudiante(s)</strong> </button>';

              html +='</table></div>'+saltoslast+  boton_Reporte+'</div>';
                    li    += pestañasEstudiantes;
                    div   += html;
                    ids_tablas[yo] = '#tablePostuladosAprobadosOrganizacion';
                    id_boton_reportes[yo] = {id_boton : "#ReporteAprobados_Organizacion" , descripcion : REPORTE_APROBADOS };

                     if( yo ==  ultimo)
                     {
                       PestanasEstudiantes(donde_imprimir ,li , div , ids_tablas , id_boton_reportes);
                     }else { siguiente[yo+1](donde_imprimir,codigo_temporada_especialidad , siguiente ,yo+1,  ultimo); }                 
                }

              }); 
}

function BuscarEstudiantesSinTutores ( donde_imprimir ,codigo_temporada_especialidad , siguiente ,yo,  ultimo)
{

   var  pestañasEstudiantes ='<li data-target=#EstudiantesSinTutores data-toggle=tab><a >'+
                             '<strong>Sin Tutor Académico</strong></a></li>';
    var html='';
        
        html += '<div class=tab-pane id=EstudiantesSinTutores><br><div class="table-responsive">';
        
        html +='<table class="table table-striped table-hover dt-responsive nowrap compact"  id=tableEstudiantesSinTutores style='+'"cursor :pointer ; width:99%"'+'>'+
                    
                    '<thead><tr>'+
                    
                      '<th >Organizaci&oacute;n</th>'+
                    
                      '<th ></th>'+                    
                    
                      '<th >Expediente</th>'+
                    
                      '<th >C&eacute;dula</th>'+
                    
                      '<th >Estudiante</th>'+
                    
                      '<th >Correo</th>'+
                    
                      '<th >Tel&eacute;fono</th>'+
                    
                      '<th ></th>'+
                    
                      '<th hidden >codigosolicitud</th>'+
                    
                    '</tr></thead>';

    var boton_asignar_tutor = '<button type=reset id=Asignacion_estudiante class="btn btn-success btn-block" disabled ><span class="glyphicon glyphicon-check"></span><strong> Asignar Tutor Académico </strong> </button>';
                
      $.ajax({
                
                async   : true, 
                
                cache   : false,
                
                type    : "POST",
                
                url     : "../controlador/recibeTemporada.php",
                
                dataType: "html",
                
                data    : {  BuscarEstudiantesSinTutores:codigo_temporada_especialidad },

                success: function (data){
                  	var boton_Reporte='';                 

                    var saltoslast='';                  
                    var Variable = JSON.parse(data);
                    //alert(data);
                     $.each(Variable, function(index, value){

              html+='<tr>'+

              '<td>'+value['nombre_organizacion']+'</td>'+
              
              '<td><img src=../../../img/Ico-master/PNG/64px/0135-search.png alt=Ginger class=left width=20 ./>'+
              
              '<label hidden style=display:none class=sucursal>'+value['sucursal']+'</label></td>'+
              
              '<td>'+value['expediente']+'</td>'+
              
              '<td>'+value['cedula']+'</td>'+
              
              '<td>'+value['estudiante']+'</td>'+
              
              '<td>'+value['correo']+'</td>'+
              
              '<td>'+value['telefono']+'</td>'+
              
              '<td><img src=../../../img/iconos/ok.png alt=Ginger class=left width=20 ./></td>'+
              
              '<td hidden >'+value['codigo_solicitud']+'<label class="buscar_codigo_para_los_Tutores" >'+value['codigo_solicitud']+'</label></td></tr>';
              
              saltoslast +='<br>';

              boton_Reporte = '<button type=reset id=ReporteAprobados_SinTutor class="btn btn-primary btn-block" ><strong><span class="glyphicon glyphicon-download-alt"></span> Reporte ('+ parseInt( 1+index ) +') Estudiantes</strong>  <label hidden class="codigo_temporada_reportar" >'+codigo_temporada_especialidad+'</label></button>';

                       });
              
              html +='</table></div>'+saltoslast+boton_asignar_tutor+boton_Reporte+'<div id=OpinionTutores></div></div>';
                    
                    li    += pestañasEstudiantes;
                    
                    div   += html;
                    
                    ids_tablas[yo] = '#tableEstudiantesSinTutores';
                    
                    id_boton_reportes[yo] = {id_boton : "#ReporteAprobados_SinTutor" , descripcion : REPORTE_SIN_TUTOR , hacer_esta : informaciondeTutoresAcademicosSegunEspecialidadTemporada ,  dondeimprimir :'#OpinionTutores',codigo : codigo_temporada_especialidad };
                    
                     if( yo ==  ultimo)
                     {

                       PestanasEstudiantes(donde_imprimir ,li , div , ids_tablas , id_boton_reportes);

                     }else { siguiente[yo+1](donde_imprimir,codigo_temporada_especialidad , siguiente ,yo+1,  ultimo); }                 
                     
                }

              });                

}


function BuscarEstudiantesConTutores ( donde_imprimir ,codigo_temporada_especialidad , siguiente ,yo,  ultimo)
{

   var  pestañasEstudiantes = '<li data-target=#EstudiantesConTutores data-toggle=tab><a >'+
                              '<strong>Con Tutor Académico</strong></a></li>';
    var html='';
        
        html += '<div class=tab-pane id=EstudiantesConTutores><br> <div class="table-responsive">';
        
        html +='<table class="table table-striped table-hover dt-responsive nowrap compact" id=tableEstudiantesConTutores style='+'"cursor :pointer ; width:99%"'+'>'+
                    
                    '<thead><tr>'+
                    
                      '<th >Organizaci&oacute;n</th>'+
                    
                      '<th >Expediente</th>'+
                    
                      '<th >C&eacute;dula</th>'+
                    
                      '<th >Estudiante</th>'+
                    
                      '<th >Tutor Académico</th>'+
                    
                      '<th hidden >codigosolicitud</th>'+
                    
                    '</tr></thead>';

 
      $.ajax({
               
                async   : true, 
               
                cache   : false,
               
                type    : "POST",
               
                url     : "../controlador/recibeTemporada.php",
               
                dataType: "html",
               
                data    : {
                 
                  BuscarEstudiantesConTutores:codigo_temporada_especialidad
                },
                success: function (data){
                    var boton_Reporte ='';
                    var saltoslast    ='';                  
                    var Variable      = JSON.parse(data);
                    
                     $.each(Variable, function(index, value){
                          html+='<tr>'+
              
              '<td>'+value['nombre_organizacion']+'</td>'+
              
              '<td>'+value['expediente']+'</td>'+
              
              '<td>'+value['cedula']+'</td>'+
              
              '<td>'+value['estudiante']+'</td>'+
              
              '<td>'+value['tutor_academico']+'</td>'+
              
              '<td hidden >'+value['codigo_solicitud']+'</td></tr>';
              
              saltoslast +='<br>';
              
              boton_Reporte = '<button id=ReporteConTutores class="btn btn-primary btn-block" ><strong><span class="glyphicon glyphicon-download-alt"></span> Reporte ('+ parseInt( 1+index ) +') Estudiantes</strong>  <label hidden class="codigo_temporada_reportar" >'+codigo_temporada_especialidad+'</label></button>';

                       });
              html +='</table> </div>'+saltoslast+ boton_Reporte +'</div>';
                    
                    li    += pestañasEstudiantes;
                    
                    div   += html;
                    
                    ids_tablas[yo] = '#tableEstudiantesConTutores';
                    
                    id_boton_reportes[yo] = {id_boton : "#ReporteConTutores" , descripcion : REPORTE_ESTUDIANTES_TUTORES };
                    
                     if( yo ==  ultimo)
                     {
                    
                       PestanasEstudiantes(donde_imprimir ,li , div , ids_tablas , id_boton_reportes);
                    
                     }else { siguiente[yo+1](donde_imprimir,codigo_temporada_especialidad , siguiente ,yo+1,  ultimo); }                 
                }

              });                

}


function BuscarEstudiantesNoSolventes( donde_imprimir ,codigo_temporada_especialidad , siguiente ,yo,  ultimo )
{

  var  pestañasEstudiantes ='<li data-target=#Estudiantes_no_Solventes data-toggle=tab><a >'+
                            '<strong>No Solventes</strong></a></li>';
  var html='';
      
      html += '<div class=tab-pane id=Estudiantes_no_Solventes><br> <div class="table-responsive">';
      
      html +='<table class="table table-striped table-hover dt-responsive nowrap compact" id=tableEstudiantesNoSolventeses style='+'"cursor :pointer ; width:99%"'+'>'+
                    
                    '<thead><tr>'+
                    
                      '<th >Expediente</th>'+
                    
                      '<th >C&eacute;dula</th>'+
                    
                      '<th >Nombre</th>'+
                    
                      '<th >Apellido</th>'+
                    
                      '<th >Entregables</th>'+
                    
                      '<th width="30" ></th>'+
                                        
                    '</tr></thead>';
 
        $.ajax({

                 async   : true, 

                 cache   : false,

                 type    : "POST",

                 url     : "../controlador/recibeTemporada.php",

                 dataType: "html",

                 data    : {

                 
                   BuscarEstudiantesNoSolventes:codigo_temporada_especialidad
                 },
                 success: function (data){
                  
                    var boton_Reporte ='';
                    var saltoslast    ='';                  
                    var Variable      = JSON.parse(data); var  conteo_total_entregables; 
                    
               $.each(Variable, function(index, value){

               html+='<tr>'+

               '<td>'+value['expediente']+'</td>'+

               '<td>'+value['cedula']+'</td>'+
               
               '<td>'+value['nombre']+'</td>'+
               
               '<td>'+value['apellido']+'</td>'+
               
               '<td>'+value['entregable_asignado']+' de '+value['conteo_general']+

               '<label hidden class="codigo_estudiante" >'+value['codigo_estudiante']+'</label></td>'+
               
               '<td></td></tr>';
               
                boton_Reporte = '<button id=ReporteNoSolventes class="btn btn-primary btn-block" ><strong><span class="glyphicon glyphicon-download-alt"></span> Reporte ('+ parseInt( 1+index ) +') Estudiantes</strong>  <label hidden class="codigo_temporada_reportar" >'+codigo_temporada_especialidad+'</label></button>';
                
                //<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">    60%  </div></div>
                conteo_total_entregables = value['conteo_general'];
                
                });

              saltoslast +='<br>';

              var boton_asignar_entregable = '<button type=reset id=Asignar_entregable class="btn btn-success btn-block" disabled="disabled" ><strong><span class="glyphicon glyphicon-check"></span> Asignar Entregable </strong> <label hidden class="codigo_temporada_v_entregable" >'+codigo_temporada_especialidad+'</label> <label class="total_deentregables_this_temporada">'+conteo_total_entregables+'</label></button>';
              
              html +='</table></div>'+ saltoslast + boton_asignar_entregable + boton_Reporte+'</div>';
                     
                     li    += pestañasEstudiantes;
                     
                     div   += html;
                     
                     ids_tablas[yo] = '#tableEstudiantesNoSolventeses';
                     
                     //id_boton_reportes[yo] = {id_boton : "#ReporteNoSolventes" , descripcion : REPORTE_ESTUDIANTES_TUTORES };
                     
                     if( yo ==  ultimo)
                     
                     {
                     
                       PestanasEstudiantes(donde_imprimir ,li , div , ids_tablas , id_boton_reportes);
                     
                     }else { siguiente[yo+1](donde_imprimir,codigo_temporada_especialidad , siguiente ,yo+1,  ultimo); }

                 } // success ... 

               });  
  

}

function BuscarEstudiantesSolventes( donde_imprimir ,codigo_temporada_especialidad , siguiente ,yo,  ultimo )
{

  var  pestañasEstudiantes ='<li data-target=#Estudiantes_Solventes data-toggle=tab><a >'+
                            '<strong>Solventes</strong></a></li>';
  var html='';
      
      html += '<div class=tab-pane id=Estudiantes_Solventes><br> <div class="table-responsive">';
      
      html +='<table class="table table-striped table-hover dt-responsive nowrap compact" id=tableEstudiantesSolventeses style='+'"cursor :pointer ; width:99%"'+'>'+
                    
                    '<thead><tr>'+
                    
                      '<th >Expediente</th>'+
                    
                      '<th >C&eacute;dula</th>'+
                    
                      '<th >Nombre</th>'+
                    
                      '<th >Apellido</th>'+
                    
                    '</tr></thead>';
 
  $.ajax({

           async   : true, 

           cache   : false,

           type    : "POST",

           url     : "../controlador/recibeTemporada.php",

           dataType: "html",

           data    :
           {                 
             BuscarEstudiantesSolventes:codigo_temporada_especialidad
           },
           success: function (data){
                  
                    var boton_Reporte , saltoslast , conteo_total_entregables ;               
                    var Variable      = JSON.parse(data); 
                    
               $.each(Variable, function(index, value){

               html+='<tr>'+

               '<td>'+value['expediente']+'</td>'+

               '<td>'+value['cedula']+'</td>'+
               
               '<td>'+value['nombre']+'</td>'+
               
               '<td>'+value['apellido']+'</td>'+
               
               '</tr>';
               
                boton_Reporte = '<button id=ReporteNoSolventes class="btn btn-primary btn-block" ><strong><span class="glyphicon glyphicon-download-alt"></span> Reporte ('+ parseInt( 1+index ) +') Estudiantes</strong>  <label hidden class="codigo_temporada_reportar" >'+codigo_temporada_especialidad+'</label></button>';
                
                //<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">    60%  </div></div>
                conteo_total_entregables = value['conteo_general'];
                
                });

              saltoslast ='<br>';

              //var boton_asignar_entregable = '<button type=reset id=Asignar_entregable class="btn btn-success btn-block" disabled="disabled" ><strong><span class="glyphicon glyphicon-check"></span> Asignar Entregable </strong> <label hidden class="codigo_temporada_v_entregable" >'+codigo_temporada_especialidad+'</label> <label class="total_deentregables_this_temporada">'+conteo_total_entregables+'</label></button>';
              
              html +='</table></div>'+ saltoslast  + boton_Reporte+'</div>';
                     
                     li    += pestañasEstudiantes;
                     
                     div   += html;
                     
                     ids_tablas[yo] = '#tableEstudiantesSolventeses';
                     
                     //id_boton_reportes[yo] = {id_boton : "#ReporteNoSolventes" , descripcion : REPORTE_ESTUDIANTES_TUTORES };
                     
                     if( yo ==  ultimo)
                     
                     {
                     
                       PestanasEstudiantes(donde_imprimir ,li , div , ids_tablas , id_boton_reportes);
                     
                     }else { siguiente[yo+1](donde_imprimir,codigo_temporada_especialidad , siguiente ,yo+1,  ultimo); }

            } // success ... 

          });  
  

}


function PestanasEstudiantes(donde_imprimir , li , div , idstablas , id_boton_reportes)
{	

  $("#estudiantes").remove();
  
  $("#GestionEstudiantes").remove();

	$( donde_imprimir ).html(

		'<ul class="nav nav-tabs " id=estudiantes ><br>'+li+'</ul>'+		

	 	'<div class=tab-content id=GestionEstudiantes style=padding-bottom: 9px; border-bottom: 1px solid #ddd;>'

    +div+'</div>');

	 $('#especialidad li').click(function(e) 
     { 
          BuscarEstudiantesEsepcialidadTemporada($(".codigo_temporada_especialidad",this).text());
     });

   $.each( idstablas ,  function(index , values){

        styleTabla(values);
                
        if(index==0) 
        { 
          id = $(values).parent().parent().parent().parent().parent().parent().parent().attr('data-target');

               $(values).parent().parent().parent().parent().parent().parent().parent().find('li > a').trigger('click');
        }
       
   });

   $.each( id_boton_reportes, function( index , value){
     
      $(value.id_boton).on('click',function(){

         //alert($(this).find(".codigo_temporada_reportar").html() + '' + $(this).find(".que_reporte").html());
         // --/...-/-/./-./--./---//./.-..//-.-./---/-../../--./---//
         
         value.descripcion( $(this).find(".codigo_temporada_reportar").html() );
      });

      if(value.id_boton=='#ReporteAprobados_SinTutor')
      {
          //value.hacer_esta;
          // hacer_esta : informaciondeTutoresAcademicosSegunEspecialidadTemporada ,  
          // dondeimprimir :'#OpinionTutores',
          // codigo : codigo_temporada_especialidad
          value.hacer_esta( value.dondeimprimir , value.codigo );

      }

   });
     
}

function Activarevento_asignarTutor()
{
  var codigo_solicituid = false ;
  $("#Asignacion_estudiante").click(function(){

    $('.temporada:checked').each(function(index) {
    var tr = $(this).parent().parent();
    codigo_solicituid=$(this).parent().parent().find(".buscar_codigo_para_los_Tutores").html(); //.parent().find(.buscar_codigo_para_los_Tutores)
        
    });

    if(codigo_solicituid!=false)
    {
       BuscarTutoresSegunsolicitudAprobada(codigo_solicituid);
    }else 
    {
        swal( 'Importante' , 'Es necesario tener un una de las filas de esta tabla seleccionada' , 'info' );
    }
    
  });
  
}


function Activar_evento_entregables() 
{ 
  var codigo           = false;
  var codigo_temporada = "";

  $("#Asignar_entregable").click(function(){

    $('.estudiantegable:checked').each(function(index) {
    var tr = $(this).parent().parent();
    codigo=$(this).parent().parent().find(".codigo_estudiante").html(); //.parent().find(.buscar_codigo_para_los_Tutores)
        
    });

    if(codigo!=false)
    {
       Buscar_entregables_este_estudiante(codigo , $(this).find(".codigo_temporada_v_entregable").html() , $(this).find(".total_deentregables_this_temporada").html());
       
    }else 
    {
        swal( 'Importante' , 'Es necesario tener un una de las filas de esta tabla seleccionada' , 'info' );
    }

  });  
}




function datosSucursal(codigo_sucursal)
{
$.ajax({
      
      async   : true, 
      
      cache   : false,
      
      type    : "POST",
      
      url     : "../controlador/recibeTemporada.php",
      
      dataType: "html",
      
      data    : 
      {
      
        buscarDatosSucursal:codigo_sucursal

      },
      success: function (data) {
      		  
      		var Variable = JSON.parse(data);

          var html='';
         
          html+='<a class="list-group-item">NOMBRE<span class="alinear" >'+Variable.nombre_organizacion+'</span></a>';
         
          html+='<a class="list-group-item">SIGLAS<span class="alinear" >'+Variable.siglas+'</span></a>';
         
          html+='<a class="list-group-item">RIF   <span class="alinear" >'+Variable.rif+'</span></a>';
         
          html+='<a class="list-group-item">SEDE  <span class="alinear" >'+Variable.observacion+'</span></a>';
         
          html+='<a class="list-group-item">TIPO  <span class="alinear" >'+Variable.nombre_tipo_organizacion+'</span></a>';
         
          html+='<a class="list-group-item">DESCRIPCIÓN <span class="alinear" >'+Variable.descripcion+'</span></a>';
         
          html+='<a class="list-group-item">ESTADO <span class="alinear" >'+Variable.nombre_estado+'</span></a>';
         
          html+='<a class="list-group-item">MUNICIPIO <span class="alinear" >'+Variable.nombre_municipio+'</span></a>';
         
          html+='<a class="list-group-item">DIRECCIÓN <span class="alinear" >'+Variable.domicilio+'</span></a>';

          $("#infothesede").html(html);

          agregareventodelistgroup();
      }

  });

}

function agregareventodelistgroup()
{
  $('.list-group-item').on('click',function(){

      if($( this ).attr('class')=='list-group-item active'){
       
        $( '.list-group-item' ).removeClass( "list-group-item active" ).addClass( "list-group-item" );
        
        $( this ).removeClass( "list-group-item active" ).addClass( "list-group-item" );
      }
      else{
       
        $( '.list-group-item' ).removeClass( "list-group-item active" ).addClass( "list-group-item" );
        
        $( this ).removeClass( "list-group-item" ).addClass( "list-group-item active" );
      }
   
  });

}


function aprobarsolicitudEncargado(codigo_solicitud ,codigo_estudiante , sucursal)
{
      $.ajax({
              
              async   : true, 
              
              cache   : false,
              
              type    : "POST",
              
              url     : "../controlador/recibeTemporada.php",
              
              dataType: "html",
              
              data    : {

              estudiantecaleta         : codigo_estudiante,
              
              supervisor               : $("#encargado").val(),
              
              codigo_sucursal          : sucursal,
              
              aprobarsolicitudEncargado:codigo_solicitud
        },
        success: function (data) {
          
        	
          	if(data==1)
          	{
          		swal('Bien','El Estudiante Fué Aprobado','success');
          	}else if(data !=1)
          	{
          		swal('Upss','Error de Programación','error');
          	}
        }

      });
}

function BuscarTutoresSegunsolicitudAprobada(codigo_solicitud)
{
  
  $("#codigocaleta").val(codigo_solicitud);
       $.ajax({

              async   : true, 
             
              cache   : false,
             
              type    : "POST",
             
              url     : "../controlador/recibeTemporada.php",
             
              dataType: "html",
             
              data    : {
        
          buscarTutoresParaEsteEstudiante:codigo_solicitud
        },
        success: function (data) {
          var Arr = JSON.parse(data);
          var html ='';
          $.each(Arr , function(index , valor){

            html +='<tr>'+

            '<td hidden style=display:none><center></center></td>'+
           
            '<td><center>'+valor['cedula']+'</center></td>'+
           
            '<td><center>'+valor['nombre']+'</center></td>'+
           
            '<td><center>'+valor['apellido']+'</center></td>'+
           
            '<td><center><input type=radio class=tutor name="Seleccte"></center></td>'+
           
            '<td hidden style=display:none><center>'+valor['codigo_tutor_academico']+'</center></td>'+
           
            '</tr>';
          });
          TablaTutores(html);
          
          if(Arr.length>0) $("#modal_tutors").modal('show'); 

          else { swal('Atención','No Hay Tutor(s) Disponible(s) según esta especialidad','info'); }
          
        }

        });

}

function TablaTutores(html)
{
        $("#tableTutors").empty();
        $("#tableTutors").append(html);
        $("#tableTutors").dataTable().fnDestroy();
        var table =
        $("#tableTutors").dataTable({ // Cannot initialize it again error

                   "aoColumns"      : [
                   { "bSortable"    : false },
                   null, null, null, null , null 
                   ],
                   "language"       : {
                   "sProcessing"    : "Procesando...",
                   "sLengthMenu"    : ' _MENU_ Registros',
                   "sZeroRecords"   : "No se encontraron Resultados",
                   "sEmptyTable"    : "Ningún dato disponible en esta tabla",
                   "sInfo"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                   "sInfoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
                   "sInfoFiltered"  : "(filtrado de un total de _MAX_ registros)",
                   "sInfoPostFix"   : "",
                   "sSearch"        : "Buscar:",
                   "sUrl"           : "",
                   "sInfoThousands" : ",",
                   "sLoadingRecords": "Cargando...",
                   "oPaginate"      : {
                   "sFirst"         : "Primero",
                   "sLast"          : "Último",
                   "sNext"          : "Siguiente",
                   "sPrevious"      : "Anterior"
                                      },
                   "oAria"          : {
                   "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
                   "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                      }
                                      },

                   'columnDefs'     : [{
                   'targets'        : 5,
                   'searchable'     :true,
                   'orderable'      :false,
                   'className'      : 'dt-body-center'
                                      }] 
                   
                   ,'order'         : [1, 'asc'],
                   "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
                   "iDisplayLength" : 5
        
        });
 
            $("#tableTutors tbody ").on('click','tr',function() 
            {   
                  if($(".tutor",this).is(':checked')==false)
                  {       
                          $(".tutor",this).prop("checked", true);
                          $("#ass").attr('disabled',false); 
                  }
                  else 
                  {
                          $(".tutor",this).prop("checked", false);
                          $("#ass").attr('disabled',true);  
                  }
                            
                  if ( $(this).hasClass('info') ) {
                      $(this).removeClass('info');
                  }
                  else {
                      table.$('tr.info').removeClass('info');
                      $(this).addClass('info');
                  }
            });

}

function TablaTutoresResumen(html)
{
        $("#tutoresDisponiblesTemporada").empty();
        $("#tutoresDisponiblesTemporada").append(html);
        $("#tutoresDisponiblesTemporada").dataTable().fnDestroy();
        var table =
        $("#tutoresDisponiblesTemporada").dataTable({ // Cannot initialize it again error
          "aoColumns"      : [
          { "bSortable"    : false },
          null, null, null, null , null 
          ],
          "language"       : {
          "sProcessing"    : "Procesando...",
          "sLengthMenu"    : ' _MENU_ ',
          "sZeroRecords"   : "No se encontraron Resultados",
          "sEmptyTable"    : "Ningún dato disponible en esta tabla",
          "sInfo"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered"  : "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix"   : "",
          "sSearch"        : "Buscar:",
          "sUrl"           : "",
          "sInfoThousands" : ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate"      :  {
          "sFirst"         : "Primero",
          "sLast"          : "Último",
          "sNext"          : "Siguiente",
          "sPrevious"      : "Anterior"
                              },
          "oAria"          :    {
          "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                             }, 
          
          'columnDefs'     : 
            [{
          'targets'        : 4,
          'searchable'     :false,
          'orderable'      :false
            }],
          'order'          : [1, 'asc'],
          "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength" : 5
        
        });
 
            $("#tutoresDisponiblesTemporada tbody ").on('click','tr',function() 
            {   
                  if($(".tutor",this).is(':checked')==false)
                      { 
                        $(".tutor",this).prop("checked", true);
                        $("#ass").attr('disabled',false); 
                      }
                  else {
                        $(".tutor",this).prop("checked", false);
                        $("#ass").attr('disabled',true);  
                  }

            });
            
}

function prepararTablaTutores()
{
      $("#tableTutors").dataTable({  
          "language"       : {
          "sProcessing"    : "Procesando...",
          "sLengthMenu"    : 'Mostrando _MENU_ Registros',
          "sZeroRecords"   : "No se encontraron Resultados",
          "sEmptyTable"    : "Ningún dato disponible en esta tabla",
          "sInfo"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered"  : "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix"   : "",
          "sSearch"        : "Buscar:",
          "sUrl"           : "",
          "sInfoThousands" : ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate"      :    {
          "sFirst"         : "Primero",
          "sLast"          : "Último",
          "sNext"          : "Siguiente",
          "sPrevious"      : "Anterior"
                                },
          "oAria"          :    {
          "sSortAscending" :  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                             }, 
          "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength" : 5
        });

      $("#tutoresDisponiblesTemporada").dataTable({  
          "language"       :  {
          "sProcessing"    : "Procesando...",
          "sLengthMenu"    : '_MENU_ ',
          "sZeroRecords"   : "No se encontraron Resultados",
          "sEmptyTable"    : "Ningún dato disponible en esta tabla",
          "sInfo"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered"  : "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix"   : "",
          "sSearch"        : "Buscar:",
          "sUrl"           : "",
          "sInfoThousands" : ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate"      : {
          "sFirst"         : "Primero",
          "sLast"          : "Último",
          "sNext"          : "Siguiente",
          "sPrevious"      : "Anterior"
                              },
          "oAria"          :    {
          "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                              }, 
          "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength" : 5
        });
}


function AsignarTutor(CodigoTutor_sospechoso)
{
    $.ajax({
  
            async   : true, 
  
            cache   : false,
  
            type    : "POST",
  
            url     : "../controlador/recibeTemporada.php",
  
            dataType: "html",
  
            data    : {

                  codigo_solicitud_caleta:$("#codigocaleta").val(),
                  codigo_tutor_caleta    :CodigoTutor_sospechoso,
                  Asignartutor           :'Vallalo'
                  },
    success  : function (data) {

            if(data == 1)
            {
            swal('Bien','Tutor Asignado Correctamente','success');

            }else 
            {
            swal('Upss','Error de Programación','error');
            }

    }

    });
}

function informaciondeTutoresAcademicosSegunEspecialidadTemporada( donde_imprimir,codigo_temporada_especialidad)
{
     $.ajax({
            
            async   : true, 
            
            cache   : false,
            
            type    : "POST",
            
            url     : "../controlador/recibeTemporada.php",
            
            dataType: "html",
            
            data    : {
        
          InformacionTutoresEspecifico:codigo_temporada_especialidad
        },
        success: function (data) {
              //alert(data);
             if(data > 0)
              {
                          $(donde_imprimir).html('<br><div class="alert alert-success" role="alert">'
                          +'<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>'
                          +'<strong> Bien! </strong> <button id=buscarTutores class="btn btn-success btn-xs" >Ver</button> '+data+' Tutor(es) Disponible(s) para Asignar </div>');

                          $("#buscarTutores").click(function(){
                               verTutoresResumen(codigo_temporada_especialidad);
                              $("#modal_tutorsMostrar").modal('show');

                          });
              }else 

              if(data == 0 ) 
              {
                          $(donde_imprimir).html('<br><div class="alert alert-warning" role="alert">'
                          +'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'
                          +'<strong> Atención! </strong> No hay Tutores Académicos en esta especialidad para asignar...</div>');
              }
        }

    });

}

function verTutoresResumen(codigo_temporada_especialidad)
{

  $.ajax({
        
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../controlador/recibeTemporada.php",
          
          dataType: "html",
          
          data    : {
        
          buscarTutoresResumen:codigo_temporada_especialidad
        },
        success: function (data) {
          
          var Arr  = JSON.parse(data);
          
          var html ='';
          
          $("#titleTutor").html('Tutor(es) Acad&eacute;mico(s)');
          
          $.each(Arr , function(index , valor){

            html +='<tr>'+
            
            '<td hidden style=display:none><center>  </center></td>'+
            
            '<td><center>'+valor['cedula']+'  </center></td>'+
            
            '<td><center>'+valor['nombre']+'  </center></td>'+
            
            '<td><center>'+valor['apellido']+'</center></td>'+
            
            '<td><center><span class="label label-primary">'+valor['observacion']+'</span></center></td>'+
            
            '<td hidden style=display:none><center><span class="label label-success">'+valor['codigo_tutor_academico']+'</span></center></td>'+
            
            '</tr>';
            
            if ( index ==0 ) $("#titleTutor").html($("#titleTutor").html()+' ' + valor['especialidad']);

          });
          
          TablaTutoresResumen(html);
          
        }

        });
}


function VerificandoEcistenciaDelTutor(CodigoTutor_sospechoso)
{

      $.ajax({
              
              async   : true, 
              
              cache   : false,
              
              type    : "POST",
              
              url     : "../controlador/recibeTemporada.php",
              
              dataType: "html",
              
              data    : {
        
          verificaCodigoTutor:CodigoTutor_sospechoso
        },
        success : function (data){
          
          if (data !=1) swal('Atención','Este Codigo no Existe en la Base de Datos','warning'); 

            else if (data==1) { AsignarTutor(CodigoTutor_sospechoso);}

        }

        });

}


function CerrarTemporada( Codigo_Temprada)
{
      $.ajax({
              
              async   : true, 
              
              cache   : false,
              
              type    : "POST",
              
              url     : "../controlador/recibeTemporada.php",
              
              dataType: "html",
              
              data    : {

               El_que_quiere_cerrar_la_temporada:$("#encargado").val(),

               Cerrar_temporada                 :Codigo_Temprada

        },
        success : function (data){
          
          if (data !=1) swal('Atención',JSON.parse(data),'warning'); 
            else if (data==1) 
              {
               crearPestañas();$("#pestana").html('');
               $("#contenidoEspecial").html('');
               swal('Bien','La Temporada se ha cerrado de manera Correcta,para ver sus respectivos reportes, ir al modulo de historial de temporadas','success');
              }
        }

        });
}


function Buscar_entregables_este_estudiante(codigo_estudiante ,  codigo_temporada_especialidad , total_de_entregables)
{ 
$.ajax({
       
        async   : true, 
       
        cache   : false,
       
        type    : "POST",
       
        url     : "../controlador/recibeTemporada.php",
       
        dataType: "html",
       
        data    : 
        {              
              temporade_full_boleta             : codigo_temporada_especialidad,

              buscar_entregables_estudiante_this: codigo_estudiante
        },
        success : function (data){
            

            var extract = JSON.parse(data);
            
            var html = ""; $("#id_entregables_no").html(''); 
            
            $("#panel_asignados").hide(); $("#panel_noasignados").hide();
            
            //<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">    60%  </div></div>
            
            var progreso ;
             // Ecmascript6 so so Yisus 2016...
            $.each( extract.estudiantes_p , (index , values) => {  progreso = values.proceso  });           
              

            $("#informacionStudiante").html(

              '<pre ><br>'+
              
              '<label> Especialidad : '+extract.estudiantes_d.nombre_especialidad+'</label><br>'+
                            
              '<label> Estudiante   : '+extract.estudiantes_d.estudiante+'         </label><br>'+
              
              '<label> Cédula       : '+extract.estudiantes_d.cedula+'             </label><br>'+
              
              '<label> Expediente   : '+extract.estudiantes_d.expediente+'         </label><br>'+

              '<label> Progreso     : '+progreso+'            </label><br>'+
              
              ' </pre>');              
   
              
          if (extract.estudiantes_n.length>0)
          {   
                  var eventoA = Array();

                  html = '<div class="list-group">'+

                  '<a class="list-group-item" id=quetaa ><span class="label label-primary" >Marcar Todo</span><span class="label label-danger alinear">Desmarcar Todo</span></a>';

              $.each(extract.estudiantes_n , function(index , value ){
                
                  // html +='<a class="list-group-item" id=quetaa'+index+'><label>#'+ +'</label> - '++
                  input      = 
                  '<span style="position: absolute;right: 10px;">'+

                  '<div class="input-group input-group-sm"><input placeholder="Descripción" type="text" class="form-control" disabled></div>'+
                  
                  '</span>';
                  
                  Contador   = parseInt(index + 1);

                  Entregable = value.nombre_entregable;

                  html+='<a class="list-group-item" id=quetaa'+index+'> '+

                  '<label hidden class=id_entregableAsiiiiiiiiii>'+value['id_entregable']+'</label>'+

                  CrearCampoinline(Contador , input ,  Entregable )+

                  '</a>';

                  eventoA[index]='#quetaa'+index;

                  $("#totalEntregablesEstudiantes_no").html(parseInt(index+1)+' de '+total_de_entregables);
              });


              $("#id_entregables_no").html(html);

              $(".codigo_temporada_especialidad_estudiante_entregable").html(codigo_temporada_especialidad);
             
              $("#panel_noasignados").show();
             
              $("#modal_estudiante_entregables").modal("show");

              CrearEventoforliSeleccionableSimulandoTablasconLi(eventoA , codigo_estudiante);

          if (extract.estudiantes_a.length>0)
          {   
                  html = '';

              $.each(extract.estudiantes_a , function(index , value ){

                if(value.descripcion=='f')value.descripcion = '<span class="glyphicon glyphicon-thumbs-down"></span>';

                  else if (value.descripcion=='t') value.descripcion= '<span class="glyphicon glyphicon-thumbs-up"></span>';

                
                   html +='<tr>'+

                  '<td><center>'+parseInt(index + 1)+'</center></td>'+

                  '<td><center>'+value.nombre_entregable+'</center></td>'+
                  
                  '<td><center>'+value.fecha_entrega+'</center></td>'+

                  '<td><center>'+value.descripcion+'</center></td></tr>';

                  $("#totalEntregablesEstudiantes_si").html(parseInt(index+1)+' de '+total_de_entregables);

              });

              $("#progres_solvencia").html(
               '<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow=100;" style="width: '+parseInt( 100 - ( ( total_de_entregables - extract.estudiantes_a .length) / total_de_entregables )* 100 )+'%;"> <label> '+parseInt( 100 - ( ( total_de_entregables - extract.estudiantes_a .length) / total_de_entregables )* 100 )+'% Solvente </label> </div></div>'
               );
              
              $("#id_entregables_si").find('tbody').html('');
              
              $("#id_entregables_si").find('tbody').html(html);
              
              $("#panel_asignados").show();
          }

          }else if (extract.estudiantes_a.length>0)
          {
                  html = '';

              $.each(extract.estudiantes_a , function(index , value ){

                if(value.descripcion=='f')value.descripcion = '<span class="glyphicon glyphicon-thumbs-down"></span>';

                  else if (value.descripcion=='t') value.descripcion= '<span class="glyphicon glyphicon-thumbs-up"></span>';

                   html +='<tr>'+

                  '<td><center>'+ parseInt(index + 1)+'</center></td>'+

                  '<td><center>'+value.nombre_entregable+'</center></td>'+
                  
                  '<td><center>'+value.fecha_entrega+'</center></td>'+

                  '<td><center>'+value.descripcion+'</center></td></tr>';

                  $("#totalEntregablesEstudiantes_si").html(parseInt(index+1)+' de '+total_de_entregables);

              });
              $("#progres_solvencia").html(
               '<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow=100;" style="width: '+parseInt( 100 - ( ( total_de_entregables - extract.estudiantes_a .length) / total_de_entregables )* 100 )+'%;"> <label> '+parseInt( 100 - ( ( total_de_entregables - extract.estudiantes_a .length) / total_de_entregables )* 100 )+'% Solvente </label> </div></div>'
               );
             
              var mensaje = '<div class="alert alert-success" role="alert"><strong>Bien Hecho!</strong>¡ El Estudiante Está Solvente Felicidades !</div>';
              
              $("#progres_solvencia").html(mensaje+$("#progres_solvencia").html());
              
              $("#id_entregables_si").find('tbody').html('');

              $("#id_entregables_si").find('tbody').html(html);
              
              $("#panel_asignados").show();

          } else swal('Upss','El Estudiante Posiblemente Esté Solvente','info');
           
        }

        });  
}

function CrearEventoforliSeleccionableSimulandoTablasconLi(etiqueta_a , codigo_estudiante)
{
              $('.toggle-demo-check').bootstrapToggle({

                on:  '<span class="glyphicon glyphicon-thumbs-up"></span>',

                off: '<span class="glyphicon glyphicon-thumbs-down"></span>',

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

        $("#guardar_entregables_estudiante").attr('disabled',true);

        $(".toggle-demo-check").parent().parent().find('.form-control').attr('disabled', true);
    }else 
    {
        $(".toggle-demo-check").bootstrapToggle('on');

        $("#guardar_entregables_estudiante").attr('disabled',false);

        $(".toggle-demo-check").parent().parent().find('.form-control').attr('disabled', false);

        $(".toggle-demo-check").parent().parent().find('.form-control').focus();
    }
        checkboxMano(".toggle-demo-check");
  });

$(".codigo_estudiante_para_entregableAsignacion").html(codigo_estudiante);


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
          
         $(this).parent().parent().find('.form-control').attr('disabled', false);

          $(this).parent().parent().find('.form-control').focus();

             idsEntregables[index]= id_Entregable.html();
      });

      $(".toggle-demo-check:not(:checked)").each(function (index , value){

         $(this).parent().parent().find('.form-control').attr('disabled', true);

      });
      
      if(idsEntregables.length>0) $("#guardar_entregables_estudiante").attr('disabled',false);
         
         else  $("#guardar_entregables_estudiante").attr('disabled',true);

}

function AsignarEstosEntregables_a_estudiantes( idsEntregables, codigo_estudiante)
{
 $.ajax({
          
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../controlador/recibeTemporada.php",
          
          dataType: "html",

          data    : {

             tregables      : idsEntregables,
            
             estudiante_c   : codigo_estudiante,
            
             estudiante_t   : $(".codigo_temporada_especialidad_estudiante_entregable").html() ,
            
             Asignar_entregables_estudiante : 'Metetele'
          },
          success: function (data) 
          { 
              //var dec = JSON.parse(data);
              //alert(data +'  -  -  -  ' + idsEntregables.length);
           if(data==idsEntregables.length && data > 1){ swal('Bien','Entregables Asignados Correctamente','success'); }
           else if (data==idsEntregables.length && data == 1) { swal('Bien','Entregable Asignado Correctamente','success'); }  else { swal('Mal','algo no Anda bien con estos datos','error'); }

          Buscar_entregables_este_estudiante(codigo_estudiante ,  
            $(".codigo_temporada_especialidad_estudiante_entregable").html() ,
            $("#Asignar_entregable").find(".total_deentregables_this_temporada").html() );

          }
          });

}



function CrearCampoinline(num , input , Entregable)
{
  str =

  '<div class="form-inline">'+

      //'<div class="form-group">'+
          '<input type="checkbox" class=toggle-demo-check data-size="mini" >'+

          '    <label>#'+num+'</label> - '+Entregable+
          
          input+
                
      //'</div>'+

  '</div>';
return str;
}

// Funciones de REportes  Casi todas Son iguales Que perdida de Tiempo
// Funciones de REportes  Casi todas Son iguales Que perdida de Tiempo
// Funciones de REportes  Casi todas Son iguales Que perdida de Tiempo
// Funciones de REportes  Casi todas Son iguales Que perdida de Tiempo
// Funciones de REportes  Casi todas Son iguales Que perdida de Tiempo
// Funciones de REportes  Casi todas Son iguales Que perdida de Tiempo
// Funciones de REportes  Casi todas Son iguales Que perdida de Tiempo
// Funciones de REportes  Casi todas Son iguales Que perdida de Tiempo
function REPORTE_NO_POSTULADOS( codigo_temporada_especialidad )
{

 $.ajax({
          
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../reportes/recibeReporte.php",
          
          dataType: "html",
          
          data    : {

             codigo        : codigo_temporada_especialidad,
             TipoReporte   : 'ESTUDIANTES_NO_POSTULADOS',
             AprobarReporte: 'reportar_estudiantes_no_postulados'
          },
          success: function (data) 
          { 

            window.open('../reportes/recibeReporte.php');
          }
          });

}


function REPORTE_POSTULADOS( codigo_temporada_especialidad )
{


 $.ajax({
          
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../reportes/recibeReporte.php",
          
          dataType: "html",
          
          data    : {

             codigo        : codigo_temporada_especialidad,
             TipoReporte   : 'REPORTE_POSTULADOS',
             AprobarReporte: 'reportar_estudiantes_postulados'
          },
          success: function (data) 
          { 
            //alert(data);
            window.open('../reportes/recibeReporte.php');
          }
          });

}


function REPORTE_APROBADOS( codigo_temporada_especialidad )
{


 $.ajax({
          
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../reportes/recibeReporte.php",
          
          dataType: "html",
          
          data    : {

             codigo        : codigo_temporada_especialidad,
             TipoReporte   : 'REPORTE_APROBADOS',
             AprobarReporte: 'reportar_estudiantes_postulados'
          },
          success: function (data) 
          { 
            
            window.open('../reportes/recibeReporte.php');
          }
          });

}

function REPORTE_SIN_TUTOR( codigo_temporada_especialidad )
{
 $.ajax({
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../reportes/recibeReporte.php",
          
          dataType: "html",
          
          data    : {

             codigo        : codigo_temporada_especialidad,
             TipoReporte   : 'REPORTE_SIN_TUTOR',
             AprobarReporte: 'reportar_estudiantes_Sin_tutor_academico'
          },
          success: function (data) 
          { 
            
            window.open('../reportes/recibeReporte.php');
          }
          });
}

function REPORTE_ESTUDIANTES_TUTORES( codigo_temporada_especialidad )
{

 $.ajax({
          
          async   : true, 
          
          cache   : false,
          
          type    : "POST",
          
          url     : "../reportes/recibeReporte.php",
          
          dataType: "html",
          
          data    : {

             codigo        : codigo_temporada_especialidad,
             TipoReporte   : 'REPORTE_ESTUDIANTES_TUTORES',
             AprobarReporte: 'reportar_estudiantes_con_tutores'
          },
          success: function (data) 
          { 
            
            window.open('../reportes/recibeReporte.php');
          }
          });

}
