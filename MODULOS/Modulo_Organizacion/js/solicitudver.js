

        llenarTabla();
        function llenarTabla()
        {



                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibePostulacionOrganizacion.php",
                dataType: "html",
                data: {
                  
                  BuscarSolicitudesEthis : $("#codigo_sucursal").val()
                },
                success: function (data) {
                    
                        
                    var Variable = JSON.parse(data);
                    var html='';
                      $.each(Variable, function(index, value){

                        html +="<tr  >"+
                        "<td><center>"+value['nombre_organizacion']+"</center></td>"+
                        "<td><center>"+value['fecha_solicitud']+"</center></td>"+
                        "<td><center>"+value['cantidad_postulantes']+"</center></td>"+
                        "<td><center>"+value['responsable']+"</center></td>"+
                        "<td><center>"+value['area']+"</center></td>"+
                        "<td ><center><img src=../../../img/Ico-master/PNG/64px/0135-search.png width=20 ></center></td>"+
                        "<td ><center><img src=../../../img/Ico-master/PNG/64px/0207-eye.png width=20 ></center></td>"+
                        "<td style=display:none><center>"+value['codigo_solicitud']+"</center></td>"+
                        "</tr>";
                      });
                      armartablaTEmporada(html);
                     
                }
            });
        }

        function armartablaTEmporada(html)
        {
        //$("#mitavle").empty();
        $("#mitavle").append(html);
        //$("#mitavle").dataTable().fnDestroy();

            $('#mitavle').dataTable({  
        
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
                         
                                var column_num = parseInt( $(this).index() ) + 1;
                                var row_num = parseInt( $(this).parent().index() )+1;    
                                if(column_num== 6)
                                {       
                                    ModalDetalles($(this).parent().find('td').eq(7).text());
            
                                }else if(column_num==7) {
                                    ModalPostulados($(this).parent().find('td').eq(7).text());
                                }   
                                
                            });

        }


function ModalDetalles(codigo_solicitud)
{
   

     $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibePostulacionOrganizacion.php",
                dataType: "html",
                data: {
                  
                  BuscarDetallesSolicitud : codigo_solicitud
                },
                success: function (data) {
                    
                    
                    // var Variable = JSON.parse(data);
                    // var html='';
                    //   $.each(Variable, function(index, value){

                    //     html +="<tr  >"+
                    //     "<td><center>"+value['nombre_organizacion']+"</center></td>"+
                    //     "<td><center>"+value['fecha_solicitud']+"</center></td>"+
                    //     "<td><center>"+value['cantidad_postulantes']+"</center></td>"+
                    //     "<td><center>"+value['responsable']+"</center></td>"+
                    //     "<td ><center><img src=../../../img/Ico-master/PNG/64px/0135-search.png width=20 ></center></td>"+
                    //     "<td ><center><img src=../../../img/Ico-master/PNG/64px/0207-eye.png width=20 ></center></td>"+
                    //     "<td style=display:none><center>"+value['codigo_solicitud']+"</center></td>"+
                    //     "</tr>";
                    //   });
                    //   armartablaTEmporada(html);
                     
                }
            });

    
     $("#modal_detalles").modal('show');

}


function ModalPostulados(codigo_solicitud)
{

                $("#codigo_solicitud").val(codigo_solicitud);
                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibePostulacionOrganizacion.php",
                dataType: "html",
                data: {
                  codigo_sucursal : $("#codigo_sucursal").val(),
                  BuscarPostuladosthisCode : codigo_solicitud
                },
                success: function (data) {
                        
                     var Variable = JSON.parse(data);
                     var html='';
                       $.each(Variable, function(index, value){

                         html +="<tr  >"+
                         "<td><center>"+value['estudiante']+"</center></td>"+
                         "<td><center>"+value['fecha_postulacion']+"</center></td>"+
                         
                         "<td ><center><img src=../../../img/Ico-master/PNG/64px/0135-search.png width=20 ></center></td>"+
                         "<td><center><button class="+" 'btn btn-default' "+" > "+
                         "<img  src=../../../img/iconos/ok.png  width=20 ./> </button> </center></td>"+
                         "<td style=display:none><center>"+value['codigo_estudiante']+"</center></td>"+
                         "</tr>";
                       });
                      armartablaPostulados(html);
                    

                    $("#modal_postulados").modal('show');    
                }
            });

}

function armartablaPostulados(Contenido)
{  
        $("#tablaPostulados").empty();
        $("#tablaPostulados").append(Contenido);
        $("#tablaPostulados").dataTable().fnDestroy();
        $("#tablaPostulados").dataTable({  
        
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
                            $("#tablaPostulados td").click(function() {     
                         
                                var column_num = parseInt( $(this).index() ) + 1;
                                var row_num = parseInt( $(this).parent().index() )+1;    
                                if(column_num== 3)
                                {       
                                    //ModalDetalles($(this).parent().find('td').eq(4).text());
                                   
                                    redireccionar($(this).parent().find('td').eq(4).text());
                                    //alert($(this).parent().find('td').eq(6).text());
                                    //$($(this).parent()).closest("tr").find('td').eq(0).text();

                                }else if(column_num==4) {
                                    aprobarPostulacion( $("#codigo_solicitud").val() ,$(this).parent().find('td').eq(4).text());
                                }   
                                
                            });

}


              $(document).ready(function(){
            $('#tablaPostulados').dataTable({
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
});






 function redireccionar(tr)
 {
    var codigo_estudiante= tr; 
  

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
              window.open('../../Modulo_Curriculo_ColorAzul/vista/VistaPrevia.php?action=vistaprevia&id_persona='+data);
              }
          }); // ajax 

   //


 }

//-----APROBACION DEL ESTUDIANTE DESPUES DE POSTULARSE A MI SOLICITUD: YO EMPRESA
 function aprobarPostulacion ( codigo_solicitud , codigo_estudiante)
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
                        id_persona:id_persona,
                        estudiante:codigo_estudiante,
                  AprobarPostulacion_SolicitudesEmpresa : codigo_solicitud
                },
                success: function (data) {
                   
                   
                    if(data==1)
                    {
                             swal('Bien','El Estudiante Fué Aprobado','success');
                    }else 
                    {
                             swal('Ups','Hay un ProblemaSSSS','error');
                    }
                   
                   
                }
            });

 }