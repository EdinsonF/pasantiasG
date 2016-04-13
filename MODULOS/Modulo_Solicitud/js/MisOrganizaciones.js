

function Organizacion_Selecionada(nombre_organizacion ,sede ,Estado ,Municipio)
{


$.amaran({
            content        :{
            bgcolor        :'#0066CC',
            color          :'#fff',
            align          :"center",
            'message'      : '<strong>'+'Organizacion:'+nombre_organizacion+'</strong><br><strong>Tipo:</strong>'+sede+'<br><strong>Ubicación</strong><br>'+Estado+'-'+Municipio
            },
            theme          :'colorful',
            position       :'bottom right',
            'sticky'       :true,
            'closeOnClick' :false,
            cssanimationIn : 'bounceInUp',
            cssanimationOut: 'rollOut',
            'clearAll'     :true
 
});
    

}


// CUANDO SE HACE  CLICK  PARA MOSTAR MODAL
    $(document).ready(function() {
    $("#mostar_modal").click(function(){
   
    $("#tabla_modal_organizaciones").modal('show'); 

          }); 
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
    	} ,
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5 
    	}); // FIN DE STYLE DATATABLE
      
      if(idTabla!="#Resumen"){
          $(idTabla+' tbody' ).on('click','tr',function(){
           
              Organizacion_Selecionada($(this).find('td').eq(1).text(),$(this).find('td').eq(0).text(),$(this).find('td').eq(2).text(),$(this).find('td').eq(3).text());
              $("#codigo_sucursal").val($(this).find('td').eq(5).text());
              $("#id_persona").val($(this).find('td').eq(6).text());
              $("#id_instituto").val($(this).find('td').eq(7).text());
	      $("#tabla_modal_organizaciones").modal('hide'); 
              //$("#codigo_sucursal").value($(this).find('td').eq(5).text());
             // DetallesOrganizacionSeleccionada($(this).find('td').eq(5).text());
              //DepartamentosdelaOrganizacionAsociada($(this).find('td').eq(5).text());
          });
      }

}

resumen();
function resumen()
{
      $.ajax({
      async:true, 
      cache:false,
      type: "POST",
     url: "../../Modulo_Postulacion/controlador/RecibePostulacion.php",
      dataType: "html",
      data: {
        
       id_ip : $("#id_ip").val(),
        ResumenMiInstitutoPrincipal:'desdeLuego'
      },
      success: function (data) 
      {
 
        var Pestanaresumen = '';
        var contenido ='<br>' ;
        var Data = JSON.parse(data);
        Pestanaresumen+= "<li ><a href=#tab0 id=trigger0 data-toggle=tab><strong>RESUMEN...</strong></a></li>";

          contenido +="<div class="+"'tab-pane'"+" id=tab0 >"+
          "<table class="+'display dataTable'+" id=Resumen style=cursor:pointer >"+
                   "<thead><tr  >"+
                         
                         "<td><strong><center>Tipo Organizaci&oacute;n</center></strong></td>"+  //1
                         "<td><strong><center>cantidad</center></strong></td>"+      //2
                         "</tr></thead>";
          $.each( Data, function(index , values){
         
             
                  contenido +="<tr >"+
               
                  "<td><center>"+values['nombre_tipo_organizacion']+"</center></td>"+
                  "<td><center>"+values['cantidad']+"</center></td>"+
                  "</tr>";
          });
          contenido +="</table></div>";
            
            agregarPestanas(Pestanaresumen );
            agregar_Resumen(contenido , "#Resumen");
            informacion();
              
      }               
    });
}
function informacion()
{

	     		$.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../../Modulo_Postulacion/controlador/RecibePostulacion.php",
                dataType: "html",
                data: {
                  id_ip : $("#id_ip").val(),
                  codigo_encargado	: $("#codigo_encargado").html(),
				  codigo_sucursal	: $("#codigo_sucursal").html(),				

                  OrganizacionesDelEncargado:'desdeLuego'
                },
                success: function (data) 
                {
                  
                 	var pestanas = '';
                 	var contenido = '';
                 	var pestanaver;
                 	var cont = 1;
                  
                 	var tablas = Array();
                	var Variable = JSON.parse(data);

                	
		//DarDataTable_Librer('#Mytable');
		 $.each(Variable, function(index, value){

		 		if(pestanaver != value['nombre_tipo_organizacion']){
		 			if(index==0){contenido+="";}
		 			contenido +="</table></div>";
		 	pestanas  +="<li ><a href=#tab"+index+1+" id=trigger"+index+" data-toggle=tab><strong>"+value['nombre_tipo_organizacion']+
      "</strong></a></li>";
		 	contenido +="<div class="+"'tab-pane'"+" id=tab"+index+1+" >"+
		 				 "<table class=display dataTable id=Mytable"+cont+" style=cursor:pointer >"+
          				 "<thead><tr  >"+
                         "<td width=15><strong><center>Sede</center></strong></td>"+				//1
                         "<td><strong><center>Nombre</center></strong></td>"+			          //2
                         "<td><strong><center>Estado</center></strong></td>"+			          //3
                         "<td><strong><center>Municipio</center></strong></td>"+ 		        //4
                         "<td><strong><center>Persona Encargada</center></strong></td>"+     //5                   
                         "<td hidden style=display:none><strong><center>sucursal</center></strong></td>"+          //6
                         "<td hidden style=display:none><strong><center>persona</center></strong></td>"+
                         "<td hidden style=display:none><strong><center>organizacion</center></strong></td>"+
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
			          	"<td><center>"+value['dato_encargado']+"</center></td>"+
			          	

			          	"<td style=display:none><center>"+value['codigo_sucursal']+"</center></td>"+
                  "<td style=display:none><center>"+value['id_persona']+"</center></td>"+
                  "<td style=display:none><center>"+value['id_organizacion']+"</center></td>"+

                  "</tr>";
                  
		 									  	});	//EACH
						agregarPestanas(pestanas );
						agregarcontenidotab(contenido , tablas);

                }// SUUCCESS 
			    }); // AJAX 
                  
}





