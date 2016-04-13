
function styleTabla( id_tabla){

            if(id_tabla=="#tableEstudiantesSinTutores")
            { 
              var table=
              $(id_tabla).dataTable({ // Cannot initialize it again error

              "language"       : 
              {
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
              "oAria"          :  {
              "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
              },'columnDefs'   : 
              [{
                   'targets'   : 7,
                   'searchable':true,
                   'orderable' :false,
                   'className' : 'dt-body-center',
                   'render'    : function (data, type, full, meta){
                    return '<input type=radio class=temporada name="QUEFASTIDIO" >';
                                                                  } 
              }],

              "aLengthMenu"   : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
              "iDisplayLength": 5
              
              });    

            $(id_tabla+" tbody ").on('click', 'tr',function()
            {
                  if($(".temporada",this).is(':checked')==false)
                  {
                          $(".temporada",this).prop("checked", true);
                          $("#Asignacion_estudiante").attr('disabled',false); 
                  }
                  else 
                  {
                          $(".temporada",this).prop("checked", false);
                          $("#Asignacion_estudiante").attr('disabled',true);  
                  }
                            
                  if ( $(this).hasClass('info') )
                  {
                       $(this).removeClass('info');
                  }
                  else 
                  {
                      table.$('tr.info').removeClass('info');
                      $(this).addClass('info');
                  } 

            }); 

          Activarevento_asignarTutor();

            }else if(id_tabla=="#tableEstudiantesNoSolventeses")
            {

              var table=
              $(id_tabla).DataTable({ // Cannot initialize it again error

            "language"         : {
            "sProcessing"      : "Procesando...",
            "sLengthMenu"      : 'Mostrando _MENU_ Registros',
            "sZeroRecords"     : "No se encontraron Resultados",
            "sEmptyTable"      : "Ningún dato disponible en esta tabla",
            "sInfo"            : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty"       : "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered"    : "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix"     : "",
            "sSearch"          : "Buscar:",
            "sUrl"             : "",
            "sInfoThousands"   : ",",
            "sLoadingRecords"  : "Cargando...",
            "oPaginate"        : {
            "sFirst"           : "Primero",
            "sLast"            : "Último",
            "sNext"            : "Siguiente",
            "sPrevious"        : "Anterior"
            },
            "oAria"            : {
            "sSortAscending"   : ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending"  : ": Activar para ordenar la columna de manera descendente"
            }
            },'columnDefs'     : [{
            'targets'          : 5,
            'searchable'       : true,
            'orderable'        : false,
            'className'        : 'dt-body-center',
            'render'           : function (data, type, full, meta){
            return '<input type=radio class=estudiantegable name=blopers>';
            }
                                 }] ,

            "aLengthMenu"      : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength"   : 5
              
              });    

            $("#tableEstudiantesNoSolventeses tbody").on( 'click','tr',function() 
            {   

                  if($(".estudiantegable",this).is(':checked')==false)
                  {       
                          $(".estudiantegable",this).prop("checked", true);
                          $("#Asignar_entregable").attr('disabled',false); 
                  }
                  else 
                  {
                          $(".estudiantegable",this).prop("checked", false);
                          $("#Asignar_entregable").attr('disabled',true);  
                  }
                            
                if ( $(this).hasClass('info') ) {
                     $(this).removeClass('info');
                }
                else {
                    table.$('tr.info').removeClass('info');
                    $(this).addClass('info');
                }
            });

            Activar_evento_entregables();




            }else
            {
              $(id_tabla).dataTable({ // Cannot initialize it again error

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
              "oPaginate"      : 
                  {
                  "sFirst"         : "Primero",
                  "sLast"          : "Último",
                  "sNext"          : "Siguiente",
                  "sPrevious"      : "Anterior"
                  },
              "oAria"          : 
                    {
                  "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
              },

              "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
              "iDisplayLength" : 5

              });               
            }
		
        

       var html = $(id_tabla).find('tbody').html();
    
        $(id_tabla).empty();
        
        $(id_tabla).append(html);
        
        $(id_tabla).dataTable().fnDestroy();   

            if(id_tabla=="#tableEstudiantesSinTutores")
            { 
              var table=
              $(id_tabla).dataTable({ // Cannot initialize it again error

              "language"       : 
              {
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
              "oAria"          :  {
              "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
              },'columnDefs'   : 
              [{
                   'targets'   : 7,
                   'searchable':true,
                   'orderable' :false,
                   'className' : 'dt-body-center',
                   'render'    : function (data, type, full, meta){
                    return '<input type=radio class=temporada name="QUEFASTIDIO" >';
                                                                  } 
              }],

              "aLengthMenu"   : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
              "iDisplayLength": 5
              
              });    

            $(id_tabla+" tbody ").on('click', 'tr',function()
            {
                  if($(".temporada",this).is(':checked')==false)
                  {
                          $(".temporada",this).prop("checked", true);
                          $("#Asignacion_estudiante").attr('disabled',false); 
                  }
                  else 
                  {
                          $(".temporada",this).prop("checked", false);
                          $("#Asignacion_estudiante").attr('disabled',true);  
                  }
                            
                  if ( $(this).hasClass('info') )
                  {
                       $(this).removeClass('info');
                  }
                  else 
                  {
                      table.$('tr.info').removeClass('info');
                      $(this).addClass('info');
                  } 

            }); 

          

            }else if(id_tabla=="#tableEstudiantesNoSolventeses")
            {

              var table=
              $(id_tabla).DataTable({ // Cannot initialize it again error

            "language"         : {
            "sProcessing"      : "Procesando...",
            "sLengthMenu"      : 'Mostrando _MENU_ Registros',
            "sZeroRecords"     : "No se encontraron Resultados",
            "sEmptyTable"      : "Ningún dato disponible en esta tabla",
            "sInfo"            : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty"       : "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered"    : "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix"     : "",
            "sSearch"          : "Buscar:",
            "sUrl"             : "",
            "sInfoThousands"   : ",",
            "sLoadingRecords"  : "Cargando...",
            "oPaginate"        : {
            "sFirst"           : "Primero",
            "sLast"            : "Último",
            "sNext"            : "Siguiente",
            "sPrevious"        : "Anterior"
            },
            "oAria"            : {
            "sSortAscending"   : ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending"  : ": Activar para ordenar la columna de manera descendente"
            }
            },'columnDefs'     : [{
            'targets'          : 5,
            'searchable'       : true,
            'orderable'        : false,
            'className'        : 'dt-body-center',
            'render'           : function (data, type, full, meta){
            return '<input type=radio class=estudiantegable name=blopers>';
            }
                                 }] ,

            "aLengthMenu"      : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength"   : 5
              
              });    

            $("#tableEstudiantesNoSolventeses tbody").on( 'click','tr',function() 
            {   

                  if($(".estudiantegable",this).is(':checked')==false)
                  {       
                          $(".estudiantegable",this).prop("checked", true);
                          $("#Asignar_entregable").attr('disabled',false); 
                  }
                  else 
                  {
                          $(".estudiantegable",this).prop("checked", false);
                          $("#Asignar_entregable").attr('disabled',true);  
                  }
                            
                if ( $(this).hasClass('info') ) {
                     $(this).removeClass('info');
                }
                else {
                    table.$('tr.info').removeClass('info');
                    $(this).addClass('info');
                }
            });


            }else
            {
              $(id_tabla).dataTable({ // Cannot initialize it again error

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
              "oPaginate"      : 
                  {
                  "sFirst"         : "Primero",
                  "sLast"          : "Último",
                  "sNext"          : "Siguiente",
                  "sPrevious"      : "Anterior"
                  },
              "oAria"          : 
                    {
                  "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
              },

              "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
              "iDisplayLength" : 5

              });               
            }
    
        if(id_tabla=='#tablePostulados')
        {
            $(id_tabla+" td").click(function() 
            {   
                var column_num = parseInt( $(this).index() ) + 1;
                 if((column_num==2) && ( $(".sucursal",this).text() !='') ) 
                 {
                    datosSucursal($(".sucursal",this).text());
                    $("#modal_detallesSucursal").modal('show');
                 }
            });
           
        }
         if(id_tabla=='#tablePostuladosAprobadosOrganizacion')
        {
            $(id_tabla+" td").click(function() 
            {     
                var column_num = parseInt( $(this).index() ) + 1;    
                 if( (column_num==2) && ( $(".sucursal",this).text()!='' ) )
                 {  
                    datosSucursal( $(".sucursal",this).text() );
                    $("#modal_detallesSucursal").modal('show');
                 }else  if ( (column_num==9) && (  $(this).parent().find('td').eq(9).text()+'-'+$(this).parent().find('td').eq(10).text() != 'codigosolicitud-codigoestudiante') )
                 { 
                    aprobarsolicitudEncargado( $(this).parent().find('td').eq(9).text(),$(this).parent().find('td').eq(10).text() , $(".sucursal",$(this).parent()).text() );
                 }

            });

        }
        if(id_tabla=='#tableEstudiantesSinTutores')
        {
          
          
            $(id_tabla+" tbody tr td").click(function() 
            {     
                 var column_num = parseInt( $(this).index() ) + 1;    
                 if( (column_num==2) && ($(".sucursal",this).text()!='') ) 
                 { 
                    // alert(parseInt( $(this).parent().index() )); asi sacar el nimero de la fila! xomento algo ps que esque  hay 2 filas 0 como tal el de head cabecera y la  0 del boy Tiene sentido no ? XD volvi 11 de Septiembre (Y)
                    datosSucursal( $(".sucursal",this).text() );
                    $("#modal_detallesSucursal").modal('show');
                 }

            }); 

        }
            if ($("#posiblesModals").val()=='')
            {
              
              $("#posiblesModals").load('PosiblesModalsEncurso.html');
              $("#Modalt").load('ModalTutores.html');

            }

            $('select').selectBoxIt();
}