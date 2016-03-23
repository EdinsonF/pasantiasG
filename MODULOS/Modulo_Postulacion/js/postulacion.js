
	function seleccionarfila(tr){

		var nombre_organizacion=$(tr).closest("tr").find('td').eq(1).text();

		var sede=$(tr).closest("tr").find('td').eq(0).text();

		var estado=$(tr).closest("tr").find('td').eq(2).text();

		var municipio=$(tr).closest("tr").find('td').eq(3).text();

		var direccion=$(tr).closest("tr").find('td').eq(4).text();

		var codigo_sucursal=$(tr).closest("tr").find('.codigo_sucursal').html();

		$("#organizacion").val(codigo_sucursal);

		swal({ 

      title            : "Atencion!",
				
      text             :'Deseas Enviar una solicitud a la Organización :'+' '+sede+' '+nombre_organizacion+' Ubicada En : '+

				estado+' '+municipio+' '+direccion+' ',

			type             : "warning", 

      showCancelButton : true,   confirmButtonColor: "#6699FF",  

      confirmButtonText: "Si, Postularme ",   closeOnConfirm: true },

        function(){

        	           SeleccionarTemporadasasignadas( );
        });
	}

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


function SeleccionarTemporadasasignadas()
{
	$("#temporadas").modal('show');
	tabladeTemporadasSegunEstudiante();
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

function selecionartemporada(radio)
{
	
   
	if ($('input[name="Seleccte"]').is(':checked')) {}
    else{}

}

$("#enviaSolicitud").on('click',function(){
	
  var codigo_temporada =false;
	
  $('.temporada:checked').each(function(index) {
  
    var tr             = $(this).closest("tr");
 	  codigo_temporada   = tr.find('.codigo_temporada_especialidad').html(); 
         
    });

    if(codigo_temporada!=false)
    {
    		hacerSolicitud(codigo_temporada);
    }else
    {
    		SeleccioneUnaTemporada();
    }
      
	
});

function hacerSolicitud(codigo_temporada)
{
		
     
	 $.ajax({
                async   :true, 

                cache   :false,

                type    : "POST",

                url     : "../controlador/RecibePostulacion.php",

                dataType: "html",

                data    : {
                  
                  estudiante       :$("#codigo_estudiante").val(),
                  
                  sucursal         :$("#organizacion").val(),
                  
                  temporada        :codigo_temporada,
                  
                  PostularEstudents:'ofcourse'
                },
                success: function (data) {
                  
                 	if(data ==1)
                 	{
                 		swal('Bien','La solicitud Se Realizo Correctamente','success');
                 	}else 
                 	{
                 		swal('Ups','Error de Programación','error');
                 	}
                   $("#temporadas").modal("hide");
					 
					         setTimeout( function(){ informacion() },1000 ); 
				      }
            });


}


function SeleccioneUnaTemporada()
{
        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Debes Seleccionar una temporada de Solicitud para realizar la postulación'
                   },
                   theme          :'colorful',
                   
                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'bottom right',
                   clearAll       :true
                });
}



//agregarPestanas(  ); // pestanas , contenido
function agregarPestanas(html )
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

 $.each(botonselectedorganizacion ,  function (index, value){
  
    $(value).on('click',function(){

      //$(this).parent().find('table > tbody input[type=radio]:checked')
        
        if($(this).parent().find('table > tbody input[type=radio]:checked').val()){
          // esto es el codigo Sucursal  $(this).parent().find('table > tbody input[type=radio]:checked ').parent().parent().find('td').eq(6).text()
         
          // esto es el tr $(this).parent().find('table > tbody input[type=radio]:checked ').parent().parent().html()
          seleccionarfila($(this).parent().find('table > tbody input[type=radio]:checked ').parent().parent());
         
        }
        

    });

 });

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
          'targets'        : [6],
          'searchable'     : true,
          'orderable'      : false,
          'className'      : 'dt-body-center',
          'render'         : function (data, type, full, meta){
              return '<input type =radio class='+idTabla+' name='+idTabla+' >';
              }
                             },{
          'targets'        : [ 0 ],
          'searchable'     : false,
          'visible'        : false                             
                             }],

          "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          
          "iDisplayLength": 5   

      }); // FIN DE STYLE DATATABLE

         $(idTabla+" tbody ").on('click','tr',function(){
          
            if ( $(this).hasClass('info') ) {
              
              $(this).removeClass('info');
              
              $("input[type=radio]",this).prop('checked', false);
              
              $(this).parent().parent().parent().parent().parent().parent().parent().find('button').attr('disabled',true);
            }
            else {
              
              table.$('tr.info').removeClass('info');
              
              $(this).addClass('info');
              
              $("input[type=radio]",this).prop('checked', true);
              
              $(this).parent().parent().parent().parent().parent().parent().parent().find('button').attr('disabled',false);
            }

         });
        $("select").selectBoxIt();

}

$(document).ready(function() {

    informacion();

    $("#temporadas").on('shown.bs.modal', function(){

      $(this).find('table').DataTable().columns.adjust().responsive.recalc();
    });
});


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
                  
                  organizaciones   :'ofcourse'
                },
                success: function (data) 
                {
                  
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

                         "<th >Sede</th>"+			//1
                        
                         "<th >Nombre</th>"+			//2
                        
                         "<th >Estado</th>"+			//3
                        
                         "<th >Municipio</th>"+ 	//4
                        
                         "<th >Direcci&oacute;n</th>"+     //5                   
                        
                         "<th ></th>"+	//6                        
                        
          				 
                   "</tr></thead>";
          				 
          				 tablas[cont] = "#Mytable"+cont;

          				 cont =cont+1; 
          			}

			contenido +="<tr class="+"'postulacion"+"' >"+

                  "<td hidden ></td>"+  //0  

						      "<td>"+value['observacion']+"</td>"+

			          	"<td>"+value['nombre_organizacion']+"</td>"+
			          	
                  "<td>"+value['nombre_estado']+"</td>"+
			          	
                  "<td>"+value['nombre_municipio']+"</td>"+
			          	
                  "<td>"+value['domicilio']+""+
			          	
                  "<label hidden style=display:none class=codigo_sucursal>"+value['codigo_sucursal']+"</label></td>"+

                  "<td></td></tr>";

		 									  	});	//EACH
          dex = dex+1 ;

          boton ='<br><button id=tablaX'+dex+' type="button" class="btn btn-primary btn-block" disabled="disabled">Postularme</button> ';
          
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
