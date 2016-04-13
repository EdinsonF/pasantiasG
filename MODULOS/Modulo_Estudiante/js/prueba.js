
// agregarPestanas();
// tablaorganizaciones();
function tablaorganizaciones()
{

	     		$.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/RecibePostulacion.php",
                dataType: "html",
                data: {
                  codigo_estudiante :$("#codigo_estudiante").val(),
                  organizaciones:'ofcourse'
                },
                success: function (data) {
                 
                   // var html ;
                   var id_tabla ='' ;
                   var pestanas ='' ;
                   var pestanaver;
                   var contenido ='';
                   var camboi='NO';
                    var Variable = JSON.parse(data);
                     $.each(Variable, function(index, value){

                     
                     	if(pestanaver != value['nombre_tipo_organizacion']){
                     		var valor; if(index==0){valor=' active';}else{valor='';}
                     	  pestanas +="<li class="+valor+" ><a href="+"'#tab"+index+"'"+"  data-toggle="+"'tab'"+"><strong>"+value['nombre_tipo_organizacion']+"</strong></a></li>";
                     	  id_tabla = "#myTable"+index;
                     	  contenido += "<div class=tab-pane"+valor+"  id=tab"+index+">"+
                         "<table class="+"'display dataTable'"+"  id="+"'myTable'"+index+"'"+" >"+
                         "<thead><tr class="+"'well'"+">"+
                         "<td><strong><center>Sede</center></strong></td>"+
                         "<td><strong><center>Nombre</center></strong></td>"+
                         "<td><strong><center>Estado</center></strong></td>"+
                         "<td><strong><center>Municipio</center></strong></td>"+
                         "<td><strong><center>Direcci&oacute;n</center></strong></td>"+
                         
                         "<td width=15><strong><center>Postularme</center></strong></td>"+
                         "<td style=display:none><strong><center>Codigo sucursal</center></strong></td>"+
                         "</tr>"+
                         "</thead> </table></div>";

                         
                         //armartablatimereal("#myTable"+index);
                        pestanaver = value['nombre_tipo_organizacion']; 
                        }

  
                     });
						
						
                     agregarPestanas(pestanas , contenido);
                     //agregarPestanas(divisiones , 'superdiv');
                      var tabla ='';
                        $.each(Variable, function(index, value){

						        if(pestanaver != value['nombre_tipo_organizacion']){
                     		  
                           
                          if(camboi=='NO'&&index!=0){ camboi='SI';}
                          pestanaver = value['nombre_tipo_organizacion']; 
                          }
                         tabla +="<tr>"+
                         "<td><center>"+value['observacion']+"</center></td>"+
                         "<td><center>"+value['nombre_organizacion']+"</center></td>"+
                         "<td><center>"+value['nombre_estado']+"</center></td>"+
                         "<td><center>"+value['nombre_municipio']+"</center></td>"+
                         "<td><center>"+value['domicilio']+"</center></td>"+
                         "<td><center>"+value['domicilio']+"</center></td>"+
                         "<td style=display:none><center>"+value['domicilio']+"</center></td>"+
                         "</tr>";



                        //alert('Cuando Cambia? '+id_tabla +' '+camboi+' '+Variable.length);
                        if(camboi=='SI'&&index!=0)
                          { alert('haz'+value['nombre_tipo_organizacion']);
             //"+"'myTable'"+index+"           
        $("#myTable"+index).empty();
        $("#myTable"+index).append(tabla);
        $("#myTable"+index).dataTable().fnDestroy();
        $("#myTable"+index).dataTable({ // Cannot initialize it again error
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

                           // agregathistabla("#myTable"+index ,tabla); 
                           camboi='NO';  tabla=''; 
                         }
                   
                  
                             
					                });
                  
                }

            });
}


