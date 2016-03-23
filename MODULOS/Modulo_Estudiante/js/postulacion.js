
 

	function seleccionarfila(tr){
		var nombre_organizacion=$(tr).closest("tr").find('td').eq(1).text();
		var sede=$(tr).closest("tr").find('td').eq(0).text();
		var estado=$(tr).closest("tr").find('td').eq(2).text();
		var municipio=$(tr).closest("tr").find('td').eq(3).text();
		var direccion=$(tr).closest("tr").find('td').eq(4).text();
		var codigo_sucursal=$(tr).closest("tr").find('td').eq(6).text();
		$("#organizacion").val(codigo_sucursal);
    
		//alert(codigo_sucursal);
		swal({  title: "Atencion!",
				text:'Deseas Enviar una solicitud a la Organización :'+' '+sede+' '+nombre_organizacion+' Ubicada En : '+
				 estado+' '+municipio+' '+direccion+' '
				,type: "warning", 
        showCancelButton: true,   confirmButtonColor: "#6699FF",  
        confirmButtonText: "Si, Postularme ",   closeOnConfirm: true }, function()
        {
        	SeleccionarTemporadasasignadas( );
        });
	}

function armartabla(Contenido)
{

	    $("#myTable").empty();
        $("#myTable").append(Contenido);
        $("#myTable").dataTable().fnDestroy();
        $("#myTable").dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null, null, null, null
          ],

            "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    'Mostrando _MENU_ Registros',
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






function SeleccionarTemporadasasignadas()
{
	$("#temporadas").modal('show');
	tabladeTemporadasSegunEstudiante();
}


function tabladeTemporadasSegunEstudiante()
{
	
	 			$.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/RecibePostulacion.php",
                dataType: "html",
                data: {
                  
                  TemporadasAsignadaspupu:$("#codigo_estudiante").val()
                },
                success: function (data) {
                 	 
                    var Variable = JSON.parse(data);
                 	var html='';
                      $.each(Variable, function(index, value){

                      	html +="<tr  >"+
                      	"<td><center>"+value['encargado']+"</center></td>"+
                      	"<td><center>"+value['nombre_tipo_solicitud']+"</center></td>"+
                      	"<td><center>"+value['periodo']+"</center></td>"+
                      	"<td><center>"+value['numero_lapso']+"</center></td>"+
                      	"<td><center><input type=radio class=temporada onclick=selecionartemporada(this) name=Seleccte ></center></td>"+
                      	"<td style=display:none><center>"+value['codigo_temporada_especialidad']+"</center></td>"+
                      	"</tr>";
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
        $("#tabla-temporadas").dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null, null
          ],

            "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    'Mostrando _MENU_ Registros',
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

function selecionartemporada(radio)
{
	
   
	if ($('input[name="Seleccte"]').is(':checked')) {}
    else{}

}

$("#enviaSolicitud").on('click',function(){
	var codigo_temporada =false;
	$('.temporada:checked').each(function(index) {
 	codigo_temporada=$(this).closest("tr").find('td').eq(5).text(); 
        
        //buscarEstatemporada(codigo_encargao);
          
        
       
          
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
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/RecibePostulacion.php",
                dataType: "html",
                data: {
                  
                  estudiante :$("#codigo_estudiante").val(),
                  sucursal   :$("#organizacion").val(),
                  temporada  :codigo_temporada,
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
					
					
				}
            });


}


function SeleccioneUnaTemporada()
{
        $.amaran({
        content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Debes Seleccionar una temporada de Solicitud para realizar la postulación'
        },
        theme:'colorful',
                   
        cssanimationIn    :'bounceInRight',
        cssanimationOut   :'rollOut',
        position          :'bottom right'
                });
}








//agregarPestanas(  ); // pestanas , contenido
function agregarPestanas(html )
{


$("#pestana").html(html);
	
					
}
function agregarcontenidotab(html , tablas)
{
	
$(".tab-content").html(html);
 $.each(tablas, function(index, value){

 	
 	DarDataTable_Librer(value);

 });

		
}


function DarDataTable_Librer(idTabla)
{

$(idTabla).dataTable({

  		"language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    'Mostrar _MENU_ Registros', // Mostrar _MENU_ registros
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
    	}); // FIN DE STYLE DATATABLE

}

informacion();

function informacion()
{

	     		$.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/RecibePostulacion.php",
                dataType: "html",
                data: {
                  codigo_estudiante : $("#codigo_estudiante").val(),
                  organizaciones:'ofcourse'
                },
                success: function (data) 
                {
                 	var pestanas = '';
                 	var contenido = '';
                 	var pestanaver;
                 	var cont = 0;
                 	var tablas = Array();
                	var Variable = JSON.parse(data);

                	
		//DarDataTable_Librer('#Mytable');
		 $.each(Variable, function(index, value){

		 		if(pestanaver != value['nombre_tipo_organizacion']){
		 			if(index==0){contenido+="<br>";}
		 			contenido +="</table></div>";
		 	pestanas  +="<li ><a href=#tab"+index+" data-toggle=tab><strong>"+value['nombre_tipo_organizacion']+"</strong></a></li>";
		 	contenido +="<div class="+"'tab-pane'"+" id=tab"+index+" >"+
		 				 "<table class=display dataTable id=Mytable"+cont+" style=cursor:pointer >"+
          				 "<thead><tr class=well >"+
                         "<td width=15><strong><center>Sede</center></strong></td>"+				//1
                         "<td><strong><center>Nombre</center></strong></td>"+			//2
                         "<td><strong><center>Estado</center></strong></td>"+			//3
                         "<td><strong><center>Municipio</center></strong></td>"+ 		//4
                         "<td><strong><center>Direcci&oacute;n</center></strong></td>"+     //5                   
                         "<td width=15><strong><center>Postularme</center></strong></td>"+	//6
                         "<td style=display:none><strong><center>Codigo sucursal</center></strong></td>"+ //7
          				 "</tr></thead>";
          				 pestanaver = value['nombre_tipo_organizacion']; 

          				 tablas[cont] = "#Mytable"+cont;
          				 cont =cont+1;
          			}

			contenido +="<tr class="+"'postulacion"+"' onclick=seleccionarfila(this) >"+
						      "<td><center>"+value['observacion']+"</center></td>"+
			          	"<td><center>"+value['nombre_organizacion']+"</center></td>"+
			          	"<td><center>"+value['nombre_estado']+"</center></td>"+
			          	"<td><center>"+value['nombre_municipio']+"</center></td>"+
			          	"<td><center>"+value['domicilio']+"</center></td>"+
			          	"<td><center><img  src=../../../img/iconos/ok.png  width=20 ./></center></td>"+	

			          	"<td style=display:none><center>"+value['codigo_sucursal']+"</center></td></tr>";

		 									  	});	//EACH
						agregarPestanas(pestanas );
						agregarcontenidotab(contenido , tablas);

                }// SUUCCESS 
			    }); // AJAX 
                  
}
