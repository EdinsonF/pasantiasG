

function RestablecerForm(){

tablacargar('');
tablacargarPostulacionesAceptadas('');
PostulacionesAceptadas_AsignarTutores('');
tablacargarPostulaciones_ConTutoresEmpresariales('');

}


function tablacargar()
{
	
	 $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibePostulacionOrganizacion.php",
        data: {
            sucursal :$("#codigo_sucursal").val(),
            BuscarPostulaciones : 'BuscarPendientes'

              },
              
            success: function(data)
            { 
                    	
                    var Variable = JSON.parse(data);
                    var html = "";
                   
                                          
                    $.each(Variable, function(index, value){
                        
                     html +="<tr>"+
                     "<td hidden><center></center></td>"+
                     "<td><center>"+value['nombre_organizacion']+"</center></td>"+
                     "<td><center>"+Variable[index][1]+" </center></td>"+
                     "<td><center>"+Variable[index][2]+" </center></td>"+
                     "<td><center>"+Variable[index][3]+" </center></td>"+
                     "<td onclick=redireccionar(this)><center> <img src=../../../img/Ico-master/PNG/64px/0135-search.png alt=Ginger class=left width=20 ></center></td>"+
                     "<td ><center><button class="+" 'btn btn-default' "+" > <img src='../../../img/iconos/ok.png' width=20 ></button></center></td>"+
                     "<td hidden><center><strong>"+Variable[index]['codigo_estudiante']+"</strong></center></td>"+
                     "<td hidden><center><strong>"+Variable[index]['codigo_solicitud']+"</strong></center></td>"+
                     "</tr>";

                                
                     });

                      ArmarTabla(html);
            }
        }); // ajax 
}


function ArmarTabla(contenido){

        $('#mitavle').empty();
        $('#mitavle').append(contenido);
        $('#mitavle').dataTable().fnDestroy();
        $('#mitavle').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null, null, null, null, null
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


          $("#mitavle td").click(function() {     
                                 
                                        var column_num = parseInt( $(this).index() ) ;
                                        var row_num = parseInt( $(this).parent().index() );    
                                         if(column_num==6) {
                                          
                                            aprobarPostulacion($("#codigo_sucursal").val() ,$(this).parent().find('td').eq(8).text());
                                        }   
                                        
                                    });

}












//---POSTULACIONES ACEPTADAS- EDINSON
function tablacargarPostulacionesAceptadas()
{
  
   $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibePostulacionOrganizacion.php",
        data: {
            sucursal :$("#codigo_sucursal").val(),
            PostulacionesAprobadas : 'BuscarPendientes'

              },
              
            success: function(data)
            { 
                      
                    var Variable = JSON.parse(data);
                    var html = "";
                   
                                          
                    $.each(Variable, function(index, value){
                        
                     html +="<tr >"+
                     "<td hidden><center>"+value['codigo_solicitud']+"</center></td>"+
                     "<td><center>"+value['nombre_organizacion']+"</center></td>"+
                     "<td><center>"+Variable[index]['estudiante']+" </center></td>"+
                     "<td><center>"+Variable[index]['nombre_especialidad']+" </center></td>"+
                     "<td><center>"+Variable[index]['solicitud_realizada']+" </center></td>"+
                     "<td><center>"+Variable[index]['fecha_postulacion']+" </center></td>"+
                     "<td onclick=redireccionar(this)><center> <img src=../../../img/Ico-master/PNG/64px/0135-search.png alt=Ginger class=left width=20 ></center></td>"+
                     "<td hidden><center><strong>"+Variable[index]['codigo_estudiante']+"</strong></center></td>"+
                     "</tr>";

                                
                     });

                      ArmarTablaPostulacionesAceptadas(html);
            }
        }); // ajax 
}


function ArmarTablaPostulacionesAceptadas(contenido){

        $('#mitavle2').empty();
        $('#mitavle2').append(contenido);
        $('#mitavle2').dataTable().fnDestroy();
        $('#mitavle2').dataTable({ // Cannot initialize it again error
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
        },

        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5
        
        }); 

}




//---POSTULACIONES ACEPTADAS-ASIGNAR TURORES EDINSON
function PostulacionesAceptadas_AsignarTutores()
{
  
   $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibePostulacionOrganizacion.php",
        data: {
            sucursal :$("#codigo_sucursal").val(),
            PostulacionesAprobadas_Ambas : 'BuscarPendientes'

              },
              
            success: function(data)
            { 
                      
                    var Variable = JSON.parse(data);
                    var html = "";
                   
                                          
                    $.each(Variable, function(index, value){
                        
                     html +="<tr href=#ModalTutores  data-toggle=modal '>"+
                     "<td hidden><center>"+value['codigo_solicitud']+"</center></td>"+
                     "<td><center>"+value['nombre_organizacion']+"</center></td>"+
                     "<td><center>"+Variable[index]['estudiante']+" </center></td>"+
                     "<td><center>"+Variable[index]['nombre_especialidad']+" </center></td>"+
                     "<td><center>"+Variable[index]['solicitud_realizada']+" </center></td>"+
                     "<td><center>"+Variable[index]['fecha_postulacion']+" </center></td>"+
                     "<td hidden><center><strong>"+Variable[index]['codigo_estudiante']+"</strong></center></td>"+
                     "</tr>";

                                
                     });

                      ArmarTablaPostulacionesAceptadas_AsignarTutores(html);
            }
        }); // ajax 
}


function ArmarTablaPostulacionesAceptadas_AsignarTutores(contenido){

        $('#mitavle3').empty();
        $('#mitavle3').append(contenido);
        $('#mitavle3').dataTable().fnDestroy();
        $('#mitavle3').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null, null, null
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
        },
    
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5
        
        }); 


                              $("#mitavle3 td").click(function() {     
                                  
                                           $("#codigo_estudiante").val($(this).parent().find('td').eq(6).text());
                                           $("#codigo_solicitud").val($(this).parent().find('td').eq(0).text());
                                           CargarCatalago_Tutores();
                                          
                                        
                                    });

}




function CargarCatalago_Tutores(){

              alert("paso");
                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibePostulacionOrganizacion.php",
                dataType: "html",
                data: {
                  id_organizacion:$("#codigo_sucursal").val(),
                  Tabla_Tutores:'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";
                    
                    $.each(Variable, function(index, value){
                    
                    html +="<tr >"+
                    " <td hidden><center>"+Variable[index].codigo_tutor_empresarial+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion+"</center></td>"+
                    " </tr>" ;
                    
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaTutores_paraAsignar(html);
                    
                }

            });

      }
        

      function ArmarTablaTutores_paraAsignar (html)
      {


        $('#mitavle5').empty();
        $('#mitavle5').append(html);
        $('#mitavle5').dataTable().fnDestroy();
        $('#mitavle5').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null
          ],
 
        }); 


                          $("#mitavle5 td").click(function() {     
                            
                                     $("#codigo_estudiante").val();
                                     var codigo_tutor=($(this).parent().find('td').eq(0).text());
                                     var codigo_solicitud=$("#codigo_solicitud").val();
                                     
                                     //alert(codigo_solicitud+"dwadawdwad"+codigo_tutor);
                                     Asignar_TutoresEmpresariales(codigo_tutor,codigo_solicitud);
                                    
                                  
                               });
                     
      }





      ///----ASIGNAR TUTORES--->>>
 function Asignar_TutoresEmpresariales ( codigo_tutor, codigo_solicitud )
 {
            
            
            //alert(id_persona);
            
            $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibePostulacionOrganizacion.php",
                dataType: "html",
                data: {
                        codigo_tutor                            :codigo_tutor,
                        codigo_solicitud                       :codigo_solicitud,
                        AsignarTutoresEmpresarial : 'APROBAR'
                },
                success: function (data) {
                   
                   alert(data);
                    if(data==1)
                    {
                             swal('Bien','El Tutor Fue Asignado','success');
                    }else 
                    {
                             swal('Ups','Hay un Problema','error');
                    }

                    RestablecerForm();
                   
                   
                }
            });

 }





//---POSTULACIONES ACEPTADAS CON TUTORES EMPRESARIALES
function tablacargarPostulaciones_ConTutoresEmpresariales()
{
  
   $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibePostulacionOrganizacion.php",
        data: {
            sucursal :$("#codigo_sucursal").val(),
            ConTutores : 'BuscarPendientes'

              },
              
            success: function(data)
            { 
                      
                    var Variable = JSON.parse(data);
                    var html = "";
                   
                     //alert(data);                     
                    $.each(Variable, function(index, value){
                        
                     html +="<tr>"+
                     "<td hidden><center>"+value['codigo_solicitud']+"</center></td>"+
                     "<td><center>"+value['nombre_organizacion']+"</center></td>"+
                     "<td><center>"+Variable[index]['estudiante']+" </center></td>"+
                     "<td><center>"+Variable[index]['nombre_especialidad']+" </center></td>"+
                     "<td><center>"+Variable[index]['solicitud_realizada']+" </center></td>"+
                     "<td><center>"+Variable[index]['tutor_empresarial']+" </center></td>"+
                     "<td><center>"+Variable[index]['nombre_oficina']+" </center></td>"+
                     "</tr>";

                                
                     });

                      ArmarTablaPostulaciones_ConTutoresEmpresariales(html);
            }
        }); // ajax 
}


function ArmarTablaPostulaciones_ConTutoresEmpresariales(contenido){

        $('#mitavle4').empty();
        $('#mitavle4').append(contenido);
        $('#mitavle4').dataTable().fnDestroy();
        $('#mitavle4').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null, null, null
          ],
        
        }); 

}










































 function redireccionar(tr)
 {
    var codigo_estudiante= $(tr).closest("tr").find('td').eq(7).text(); 
    
    //alert(codigo_estudiante);
     $.ajax({
          async:true, 
          cache:false,
          dataType:"html", 
          type: 'POST',   
          url: "../controlador/recibePostulacionOrganizacion.php",
          data: {
           
               buscar_curriculo : codigo_estudiante

                },
              
              success: function(data)
              { 
		
               
                if (data=='null') {
                  
                   swal({   title: "Este Estudiante No Posee Curriculo", type: "warning" });
                }else{

	 var id_persona=parseInt(JSON.parse(data));
              window.open('../../Modulo_Curriculo_ColorAzul/vista/VistaPrevia.php?action=vistaprevia&id_persona='+id_persona);
              }
            }
          }); // ajax 

 }


///----APROBACION DIRECTA--->>>
 function aprobarPostulacion ( codigo_sucursal, codigo_solicitud )
 {
            
            var id_persona=$('#ID_PERSONA').val();
            //alert(id_persona);
            
            $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibePostulacionOrganizacion.php",
                dataType: "html",
                data: {
                        id_persona                            :id_persona,
                        codigo_sucursal                       :codigo_sucursal,
                    AprobarPostulacion_SolicitudesEstudiantes : codigo_solicitud
                },
                success: function (data) {
                   
                   //alert(data);
                    if(data==1)
                    {
                             swal('Bien','El Estudiante Fué Aprobado','success');
                    }else 
                    {
                             swal('Ups','Hay un Problema','error');
                    }

                    RestablecerForm();
                   
                   
                }
            });

 }
