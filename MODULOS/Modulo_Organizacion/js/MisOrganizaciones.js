
$(document).ready(function(){

  resumen();
});

//agregarPestanas(  ); // pestanas , contenido
function agregarPestanas(html )
{


$("#pestana").html($("#pestana").html()+html);
	
						
}
function agregarcontenidotab(html , tablas)
{
	
$(".tab-content").html($(".tab-content").html()+html);
 $.each(tablas, function(index, value){

 	
 	DarDataTable_Librer(value);

 });

 $("select.form-control").selectBoxIt();

}
function agregar_Resumen(html , id_tabla)
{
  $(".tab-content").html(html);
  DarDataTable_Librer(id_tabla);
  $("#trigger0").trigger('click');  // ESTE  es  el  Auto Click que  se  hace para  que   quede  de  una  vez seleccionado 
                  // ES la Primera Pestaña por ese  motivo  tiene  la terminal 0 del  index del each (Y)
  
}

function DarDataTable_Librer(idTabla)
{

$(idTabla).dataTable({

            "language"       : {
            "sProcessing"    : "Procesando...",
            "sLengthMenu"    : 'Mostrar _MENU_ Registros', // Mostrar _MENU_ registros
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
            } ,
            "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength" : 5 
            }); // FIN DE STYLE DATATABLE
      
    

      var html = $(idTabla).find('tbody').html();
      
        $(idTabla).empty();

        $(idTabla).append(html);

        $(idTabla).dataTable().fnDestroy();

$(idTabla).dataTable({

            "language"       : {
            "sProcessing"    : "Procesando...",
            "sLengthMenu"    : 'Mostrar _MENU_ Registros', // Mostrar _MENU_ registros
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
            } ,
            "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength" : 5 
            }); // FIN DE STYLE DATATABLE        

      if(idTabla!="#Resumen"){
          $(idTabla+' tbody' ).on('click','tr',function(){
              $("#ModalOrganizacionAsoc").modal('show');
              DetallesOrganizacionSeleccionada($(this).find('td').eq(5).text());
              DepartamentosdelaOrganizacionAsociada($(this).find('td').eq(5).text());
          });
      }



}


function resumen()
{
  $.ajax({
       
        async   :true, 
       
        cache   :false,
       
        type    : "POST",
       
        url     : "../../Modulo_Postulacion/controlador/RecibePostulacion.php",
       
        dataType: "html",
       
        data    : {
        
        id_ip                      : $("#id_ip").val(),

        ResumenMiInstitutoPrincipal:'desdeLuego'

      },
      success: function (data) 
      {
 
        var Pestanaresumen = '';
        
        var contenido      ='<br>' ;
        
        var Data           = JSON.parse(data);
        
        Pestanaresumen+= "<li data-target=#tab0 data-toggle=tab><a  id=trigger0 ><strong>RESUMEN...</strong></a></li>";

          contenido +="<div class="+"'tab-pane'"+" id=tab0 ><div class='table-responsive'>"+

          "<table class="+"'table table-striped table-hover compact'"+"  id=Resumen style='cursor:pointer ; width:99%;' >"+
                   
                   "<thead><tr  >"+
                         
                         "<td><strong><center>Tipo Organizaci&oacute;n</center></strong></td>"+  //1
                         
                         "<td><strong><center>N°</center></strong></td>"+      //2
                         
                         "<td><strong><center>Organizaciones</center></strong></td>"+
                         
                         "<td><strong><center>Detalles</center></strong></td>"+
                   "</tr> </thead>";

          $.each( Data, function(index , values){
         
             
                  contenido +="<tr >"+
               
                  "<td><center>"+values['nombre_tipo_organizacion']+"</center></td>"+
                  
                  "<td><center>"+values['cantidad']+"</center></td>"+
                  
                  "<td ><center> </center></td>"+
                  
                  "<td ><center>"+values['answer']+"</center></td></tr>";
          });
          contenido +="</table></div></div>";
            
            agregarPestanas(Pestanaresumen );
            
            agregar_Resumen(contenido , "#Resumen");
            
            informacion();
              
      }               
    });
}
function informacion()
{

	     		$.ajax({
         
                async   :true, 

                cache   :false,

                type    : "POST",

                url     : "../../Modulo_Postulacion/controlador/RecibePostulacion.php",

                dataType: "html",

                data    : {

                  id_ip                     : $("#id_ip").val(),
                  
                  codigo_encargado          : $("#codigo_encargado").html(),
                  
                  codigo_sucursal           : $("#codigo_sucursal").html(),				
                  
                  OrganizacionesDelEncargado:'desdeLuego'
                },
                success: function (data) 
                {
                  
                   var pestanas  = '';
                   var contenido = '';
                   var pestanaver;
                   var cont      = 1;
                   
                   var tablas    = Array();
                   var Variable  = JSON.parse(data);

                	
		//DarDataTable_Librer('#Mytable');
		 $.each(Variable, function(index, value){

		 		if(pestanaver != value['nombre_tipo_organizacion']){
		 			
          if(index==0){contenido+="";}
		 			
          contenido +="</table></div></div>";
		 	
      pestanas  +="<li data-target=#tab"+index+1+" data-toggle=tab><a  id=trigger"+index+" ><strong>"+value['nombre_tipo_organizacion']+
      
      "</strong></a></li>";
		 	
      contenido +="<div class="+"'tab-pane'"+" id=tab"+index+1+" > <div class='table-responsive'>"+
		 	
      			 "<table class="+"'table table-striped table-hover compact'"+" id=Mytable"+cont+" style='cursor:pointer ; width : 99% '>"+
      
          				 "<thead><tr  >"+
      
                         "<td ><strong><center>Sede</           center></strong></td>"+	//1
      
                         "<td><strong><center>Nombre</          center></strong></td>"+ //2
      
                         "<td><strong><center>Estado</          center></strong></td>"+ //3
      
                         "<td><strong><center>Municipio</       center></strong></td>"+ //4
      
                         "<td><strong><center>Direcci&oacute;n</center></strong></td>"+  //5                   
      
                         "<td hidden style=display:none>"+
      
                         "<strong><center>Codigo sucursal</center></strong></td>"+       //6
      
          				 "</tr></thead>";
          				 pestanaver = value['nombre_tipo_organizacion']; 

          				 tablas[cont] = "#Mytable"+cont;
          				 cont =cont+1;
                   
          			}

			contenido +="<tr   >"+
						     
                  "<td><center>"+value['observacion']+"</center></td>"+
			          
                	"<td><center>"+value['nombre_organizacion']+"</center></td>"+
			          
                	"<td><center>"+value['nombre_estado']+"</center></td>"+
			          
                	"<td><center>"+value['nombre_municipio']+"</center></td>"+
			          
                	"<td><center>"+value['domicilio']+"</center></td>"+

			          	"<td style=display:none><center>"+value['codigo_sucursal']+"</center></td></tr>";
                  
		 									  	});	//EACH
						agregarPestanas(pestanas );
						agregarcontenidotab(contenido , tablas);

                }// SUUCCESS 
			    }); // AJAX 
                  
}



function DetallesOrganizacionSeleccionada( codigo_sucursal )
{
        $.ajax({
                
                async   :true, 
                
                cache   :false,
                
                type    : "POST",
                
                url     : "../controlador/recibeInstitutoFormulario.php",
                
                dataType: "html",
                
                data    : {
                
                  id_ip           : $("#id_ip").val(),
                
                  codigo_encargado: $("#codigo_encargado").html(),
                
                  codigo_sucursal : codigo_sucursal,       

                  EstaOrganizacion:'desdeLuego'
                },
                success: function (data) 
                {
                  
                  var BD = JSON.parse(data);

                  $(".informacionOrganizacionselected").html(' <pre ><br>'+
                    
                    '<label>Sede      : </label>'+BD['sede']+'<br>'+
                    
                    '<label>Siglas    : </label>'+BD['siglas']+'<br>'+
                    
                    '<label>Rif       : </label>'+BD['rif']+'<br>'+
                    
                    '<label>Ubicaci&oacute;n : </label>'+BD['ubicacion']+'<br>'+

                    '</pre>');

                  $("#Titulo").html(BD['nombre_organizacion']+' - '+ BD['tipo'] );
                }                
              });
}

function DepartamentosdelaOrganizacionAsociada(codigo_sucursal)
{
      $.ajax({

              async   :true, 

              cache   :false,

              type    : "POST",

              url     : "../controlador/recibeInstitutoFormulario.php",

              dataType: "html",

              data    : {
                
                codigo_sucursal        : codigo_sucursal,       
                
                DepartamentosdeSucursal:'desdeLuego'
              },
      success: function (data) 
      {
       
        var BD         = JSON.parse(data);

        var Error      ="error";

        var info       ="info";

        var classe     = info;

        var acumulador ='';

        $.each(BD ,function(index , value){

          acumulador +='<label >'+value['nombre_oficina']+' : '+value['personas']+'</label><br>';
        
        });
        
        if(BD==''){ acumulador ='<label >No Hay Departamentos Registrados...</label>' ;classe=Error;}
        
        $(".informacionDepartamentos").html('<pre class="alert alert-'+classe+'" >'+acumulador+'</pre>');
       
      }                
    });
}

