

$(document).ready(function() {

    

    $("#temporadas").on('shown.bs.modal', function(){

      $(this).find('table').DataTable().columns.adjust().responsive.recalc();
      
    });

    hacerTabla();

    informacion();
});



function armartabla(Contenido)
{

	     $("#myTable").empty();
       
       $("#myTable").append(Contenido);
       
       $("#myTable").dataTable().fnDestroy();
       
       $("#myTable").dataTable({ // Cannot initialize it again error
       
          "aoColumns"      : [
          { "bSortable"    : false },
          null, null, null, null, null, null, null
          ],

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
          "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength" : 5
        
        }); 

}



//agregarPestanas(  ); // pestanas , contenido
function agregarPestanas(html)
{


$("#pestana").html(html);
	
					
}

function agregarcontenidotab(html , tablas , botonselectedorganizacion , autoclicked)
{
	

$(".tab-content").html(html);
 $.each(tablas, function(index, value){

 	
 	DarDataTable_Librer(value);

 });

  haceresponsiveporclick(  autoclicked );


    $("#autoclic0").trigger('click');

}


function DarDataTable_Librer(idTabla)
{
var table = 
$(idTabla).DataTable({
                 
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

          "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          
          "iDisplayLength": 5    
    	}); // FIN DE STYLE DATATABLE


      var Contenido = $(idTabla).find('tbody').html();

       $(idTabla).empty();
       
       $(idTabla).append(Contenido);
       
       $(idTabla).dataTable().fnDestroy();

       $(idTabla).DataTable({
                  
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
          
                             },{
          'targets'        : [ 0 ],
          'searchable'     : false,
          'visible'        : false                             
                             }],

          "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          
          "iDisplayLength": 5   

      }); // FIN DE STYLE DATATABLE

}



function informacion()
{

	     		$.ajax({
                
                async   :true, 
                
                cache   :false,
                
                type    : "POST",
                
                url     : "../controlador/RecibePostulacion.php",
                
                dataType: "html",
                
                data    : 
                {
                  
                  codigo_estudiante: $("#codigo_estudiante").val(),
                  
                  MisPostulaciones   :'ofcourse'
                },
                success: function (data) 
                {
                  //alert(data);
                  
                   var pestanas  = '';
                   var contenido = '<br>';
                   var pestanaver;
                   var cont      = 0 , dex = 0 , tipo = 0; 
                   var tablas    = Array() , botonselectedorganizacion = Array() , autoclicked = Array();
                   var Variable  = JSON.parse(data);

                	  
		//DarDataTable_Librer('#Mytable');
		 $.each(Variable,function (index , value){
      


		 		if(pestanaver != value['nombre_tipo_organizacion']){
            tipo = 1 ; 
          
            boton ='<br><button id=tablaX'+dex+' type="button" class="btn btn-primary btn-block" disabled="disabled">Postularme</button> ';
  		 		 
            if(index>0) {contenido +="</table></div>"+boton+"</div>"; botonselectedorganizacion[botonselectedorganizacion.length] = '#tablaX'+dex; } 

      		  pestanaver = value['nombre_tipo_organizacion']; autoclicked[autoclicked.length] = "#autoclic"+index;

            pestanas  +="<li ><a data-target=#tab"+index+" id=autoclic"+index+" data-toggle=tab><strong>"+value['nombre_tipo_organizacion']+" <span class=badge></span></strong></a></li>";
            
            contenido +="<div class="+"'tab-pane'"+" id=tab"+index+" >"+
		 				 
             "<div class=table-responsive><table class="+"'table table-striped table-hover dt-responsive nowrap compact'"+" id=Mytable"+cont+" style="+"'cursor:pointer ;width:99%'"+">"+
          				
                   "<thead><tr >"+
                        
                         "<th hidden ></th>"+  //0      

                         "<th >Nombre</th>"+			//1
                        
                         "<th >Ubicación</th>"+			//2
                        
                         "<th >Direcci&oacute;n</th>"+ //3
                        
                         "<th >Solicitud de</th>"+ 	//4

                         "<th >T. Empresarial</th>"+ //5
                        
                         "<th >T. Académico</th>"+     //6                   
                        
                         "<th > Estado - Solicitu</th>"+	//7                        
                        
          				 
                   "</tr></thead>";
          				 
          				 tablas[cont] = "#Mytable"+cont;

          				 cont =cont+1; 
          			}

			contenido +="<tr class="+"'postulacion"+"' >"+

                  "<td hidden ></td>"+  //0  

						      "<td>"+value['nombre_organizacion']+" ("+value['observacion']+")<label hidden style=display:none class=codigo_sucursal>"+value['codigo_sucursal']+"</label></td>"+

			          	"<td>"+value['ubicacion']+"</td>"+
			          	
                  "<td>"+value['domicilio']+"</td>"+
			          	
                  "<td>"+value['nombre_tipo_solicitud']+"</td>";

                if(value['descripcion']=="false"){
                  
                    contenido +="<th>NO REQUERIDO</th>"+
                                "<th>NO REQUERIDO</th>";

                    if(value['estatus']=='APROBADO ORGANIZACION'){

                        contenido +="<td>APROBADO</td>";

                    }else{

                        contenido +="<td>"+value['estatus']+"</td></tr>";

                    }
                  
                }else{

                    if(value['estatus']=='LISTO'){

                        contenido +="<th>EN ESPERA</th>"+
                                    "<th>EN ESPERA</th>"+
                                    "<td>APROBADO</td></tr>";

                    }else if (value['estatus']=='ASIGNADO'){

                        contenido +="<th>ASIGNADO</th>"+
                                    "<th>EN ESPERA</th>"+
                                    "<td>APROBADO (ambos)</td></tr>";

                    }else{

                        contenido +="<th>REQUERIDO</th>"+
                                    "<th>REQUERIDO</th>"+
                                    "<td>"+value['estatus']+"</td></tr>";

                    }
                    
                }

                  

		 									  	});	//EACH
          dex = dex+1 ;

          boton ='<br><button id=tablaX'+dex+' type="button" class="btn btn-primary btn-block" disabled="disabled">Reporte</button> ';
          
            contenido +="</table></div>"+boton+"</div>";     

            botonselectedorganizacion[botonselectedorganizacion.length] = '#tablaX'+dex;
					
          	agregarPestanas(pestanas );

						agregarcontenidotab(contenido , tablas , botonselectedorganizacion , autoclicked);

            

                }// SUUCCESS 
			    }); // AJAX 
                  
}






function haceresponsiveporclick( autoclicked ){

  $.each(autoclicked , function (index , value){

    $(value).click(function(){

      setTimeout( function(){ 
    $(value).parent().parent().parent().find('.tab-pane  table').DataTable().columns.adjust().responsive.recalc(); 
  },120);

    });


  });

} 




function hacerTabla()
{



  
$('#tabla-temporadas').dataTable({

  "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    '_MENU_ Registros', // Mostrar _MENU_ registros
        "sZeroRecords":   "No se encontraron Resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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


}






































function tabladeTemporadasSegunEstudiante()
{
  
    $.ajax({
       
        async   :true, 
       
        cache   :false,
       
        type    : "POST",
       
        url     : "../controlador/RecibePostulacion.php",
       
        dataType: "html",
       
        data    : {
          
          TemporadasAsignadaspupu:$("#codigo_estudiante").val()
        },
        success: function (data) {
           
            var Variable = JSON.parse(data);
            var html='';
              $.each(Variable, function(index, value){

                html +="<tr  >"+
               
                "<td hidden></td>"+
              
                "<td>"+value['encargado']+"</td>"+
              
                "<td>"+value['nombre_tipo_solicitud']+"</td>"+
              
                "<td>"+value['periodo']+"</td>"+
              
                "<td>"+value['numero_lapso']+""+
              
                "<label hidden class=codigo_temporada_especialidad>"+value['codigo_temporada_especialidad']+"</label></td>"+

                "<td></td></tr>";
              });
        armartablaTEmporada(html);
   
        }
    });
}



function armartablaTEmporada(Contenido)
{

        $("#tabla-temporadas").empty();
        
        $("#tabla-temporadas").append(Contenido);
        
        $("#tabla-temporadas").dataTable().fnDestroy();
        
        var table=
        $("#tabla-temporadas").DataTable({ // Cannot initialize it again error
        
        "aoColumns": [
        
          { "bSortable": false },
        
          null, null, null, null, null
        
          ],

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
         'columnDefs': [
         {
             'targets'   : 5,
             'searchable':true,
             'orderable' :false,
             'className' : 'dt-body-center',
             'render': function (data, type, full, meta){
                 return '<input type=radio class=temporada onclick=selecionartemporada(this) name=Seleccte >';
                    }
          },{

            'targets'        : [ 0 ],
            'searchable'     : false,
            'visible'        : false
                               }],
                'order': [1, 'asc']
         ,
          "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength": 5                
        
        }); 
         $("#tabla-temporadas tbody ").on('click','tr',function(){
          
          
            if ( $(this).hasClass('info') ) {
              $(this).removeClass('info');
              $(".temporada",this).prop('checked', false);
            }
            else {
                table.$('tr.info').removeClass('info');
                $(this).addClass('info');
              $(".temporada",this).prop('checked', true);
            }
        
         });
         $("select").selectBoxIt();

}