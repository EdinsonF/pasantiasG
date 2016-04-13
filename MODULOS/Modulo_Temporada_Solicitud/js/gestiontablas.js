

$(document).ready(function(){
      $('#myTable').DataTable({  
        
        "language"             : {
        "sProcessing"          : "Procesando...",
        "sLengthMenu"          : 'Mostrando _MENU_ Registros',
        "sZeroRecords"         : "No se encontraron Resultados",
        "sEmptyTable"          : "Ningún dato disponible en esta tabla",
        "sInfo"                : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty"           : "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered"        : "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix"         : "",
        "sSearch"              : "Buscar:",
        "sUrl"                 : "",
        "sInfoThousands"       : ",",
        "sLoadingRecords"      : "Cargando...",
        "oPaginate"            :  {
        "sFirst"               : "Primero",
        "sLast"                : "Último",
        "sNext"                : "Siguiente",
        "sPrevious"            : "Anterior"
                                  },
        "oAria"                : {
        "sSortAscending"       : ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending"      : ": Activar para ordenar la columna de manera descendente"
                                 }
        },
        'columnDefs'           : [{
        'targets'              : 4,
        'searchable'           :true,
        'orderable'            :false,
        
                                 }],
        'order'                : [1, 'asc'],
        "aLengthMenu"          : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength"       : 5
        });
  
    $("#Asignacion").DataTable({  
        
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
        },'columnDefs'   : [{
        'targets'        : 2,
        'searchable'     :true,
        'orderable'      :false,
        
        }],
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5
    });
      
        $("#tablaEspecialidadesadd").DataTable({  
            
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
        "iDisplayLength" : 4
        });

      $("#tablaEspecialidadesshard").DataTable({  
      
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

      $("#tablaabrirTemporadas").DataTable({  
       
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
        },'columnDefs'   : [{
        'targets'        : 3,
        'searchable'     :true,
        'orderable'      :false,
        
        }],
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5
    });
        $("#tablaEstudiante").DataTable({  
           
        "language"       : {
        "sProcessing"    : "Procesando...",
        "sLengthMenu"    : 'Mostrando _MENU_ Registros',
        "sZeroRecords"   : "No se encontraron Resultados",
        "sEmptyTable"    : "Esperando Especialidad...",
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

        $("#tablaforespecialidades").DataTable({  
            
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
        "oPaginate"      :  {
        "sFirst"         : "Primero",
        "sLast"          : "Último",
        "sNext"          : "Siguiente",
        "sPrevious"      : "Anterior"
                            },
        "oAria"          :  {
        "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
        },
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5
        });

        $("#tablaEstudianteAsignados").DataTable({  
            
        "language"       : {
        "sProcessing"    : "Procesando...",
        "sLengthMenu"    : 'Mostrando _MENU_ Registros',
        "sZeroRecords"   : "No se encontraron Resultados",
        "sEmptyTable"    : "Esperando Especialidad...",
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
        "oAria"          :  {
        "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
        },
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5
        });
        

    });

 function ArmarTabla ( tabla ,html ){

        $(tabla).empty();
        $(tabla).append(html);
        $(tabla).dataTable().fnDestroy();
        var tabla_bla =
        $(tabla).DataTable({ // Cannot initialize it again error

        "aoColumns": [
          { "bSortable": false },
          null, null, null , null ,null 
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
        'columnDefs'     : [
            {
            'targets'    : 5,
            'searchable' : false,
            'orderable'  : false,
            
            },

            {
            "targets"    : [ 0 ],
            "visible"    : false,
            "searchable" : false
            }],
        //'order'               : [0, 'asc'],
        "aLengthMenu"         : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength"      : 5
        }); 
        $("select.form-control").selectBoxIt();
            
              $(tabla+" tbody").on('click','td',function ()
              {
                
                
                if ( parseInt($(this).index() )> 0 ){
                   
                    codigo_tempo =$(this).parent().find(".code_code_code_code").html();

                    buscarEstatemporada(codigo_tempo ,"#informaciontemporadaEncargado")
                    HacerResumendeEstatemporada( codigo_tempo );
                    $("#modal_rechazar_empresa").modal('show');
                }
                  

              });
        
}

function ArmarTablaPreparada ( tabla ,html)
{

        $(tabla).empty();
        
        $(tabla).append(html);
        
        $(tabla).dataTable().fnDestroy();
        
        $(tabla).dataTable({ // Cannot initialize it again error
        
            "aoColumns"      : [
            { "bSortable"    : false },
            null, null, null , null
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
            },'columnDefs'   : [{

            'targets'        : [ 4 ],
            'searchable'     : true,
            'orderable'      : false,
            
                                },{

            'targets'        : [ 0 ],
            'searchable'     : false,
            'visible'        : false
                               }],
            'order'          : [ 1 , 'asc' ] ,
            "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength" : 5
        }); 

        $("select.form-control").selectBoxIt();

        AutoActivarTooltip();

        agregarCaptionAsignacionEstudiantes(tabla);

      $( tabla+ " tbody").on( 'click','tr', function ()
      {
          $("#modal_estudiantes").modal('show');
          //Armarestudiantes( '');
          $("#alertdescente").show();
        //var codigo_encargao = new Array();
        var codigo_temporada=$(this).closest("tr").find('.coderaperture').html(); 
        
        buscarEstatemporada(codigo_temporada , "#informacion");
       

      });
}

      function Armarestudiantes ( html)
      {
        var NoRegistros = "Esperando Especialidad...";

        if(html!='') NoRegistros= "Ningún Estudiante Disponible" ;        
        
        var rows_selected = [];
       
        $("#tablaEstudiante").empty();
       
        $("#tablaEstudiante").append(html);
       
        $("#tablaEstudiante").dataTable().fnDestroy(); var tablaaa =
       
        $("#tablaEstudiante").DataTable({ // Cannot initialize it again error
       
                    "aoColumns"         : [
                    { "bSortable"       : false },
                    null, null, null , null 
                    ],
                    
                    "language"          : {
                    "sProcessing"       : "Procesando...",
                    "sLengthMenu"       : 'Mostrando _MENU_ Registros',
                    "sZeroRecords"      : "No se encontraron Resultados",
                    "sEmptyTable"       : NoRegistros,
                    "sInfo"             : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty"        : "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered"     : "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix"      : "",
                    "sSearch"           : "Buscar:",
                    "sUrl"              : "",
                    "sInfoThousands"    : ",",
                    "sLoadingRecords"   : "Cargando...",
                    "oPaginate"         : {
                    "sFirst"            : "Primero",
                    "sLast"             : "Último",
                    "sNext"             : "Siguiente",
                    "sPrevious"         : "Anterior"
                    },
                    "oAria"             : {
                    "sSortAscending"    : ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending"   : ": Activar para ordenar la columna de manera descendente"
                    
                    }
                    },
                    'columnDefs'        : [{
                    'targets'           : 0,
                    'searchable'        :true,
                    'orderable'         :false,
                   
                    'render'            : function (data, type, full, meta){
                    return '<input type ="checkbox" >';
                    }
                    }],
                    'order'             : [1, 'asc'],
                  'rowCallback': function(row, data, dataIndex){
                     // Get row ID
                     var rowId = data[0];

                     // If row ID is in the list of selected row IDs
                     if($.inArray(rowId, rows_selected) !== -1){
                        
                        $(row).find('input[type="checkbox"]').prop('checked', true);
                        $(row).addClass('info');
                     }
                  },
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 4
        }); 

        $("select.form-control").selectBoxIt();

           $('#tablaEstudiante tbody').on('click', 'input[type="checkbox"]', function(e){
              var $row = $(this).closest('tr');

              // Get row data
              var data = tablaaa.row($row).data();

              // Get row ID
              var rowId = data[0];

              // Determine whether row ID is in the list of selected row IDs 
              var index = $.inArray(rowId, rows_selected);

              // If checkbox is checked and row ID is not in list of selected row IDs
              if(this.checked && index === -1){
                 rows_selected.push(rowId);

              // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
              } else if (!this.checked && index !== -1){
                 rows_selected.splice(index, 1);
              }

              if(this.checked){
                 $row.addClass('info');
              } else {
                 $row.removeClass('info');
              }

              // Update state of "Select all" control
              updateDataTableSelectAllCtrl(tablaaa);
              habilitarBotnModalEstudiantes();
              // Prevent click event from propagating to parent
              e.stopPropagation();
              
           });
      // Handle click on "Select all" control
           
           $('#tablaEstudiante thead input[name="select_all"]').on('click', function(e){
              if(this.checked){
                 $('#tablaEstudiante tbody input[type="checkbox"]:not(:checked)').trigger('click');
              } else {
                 $('#tablaEstudiante tbody input[type="checkbox"]:checked').trigger('click');
              }
              
              // Prevent click event from propagating to parent
              e.stopPropagation();
            
           });
        if( html!='') EventosCheckbox(tablaaa ,'#tablaEstudiante'); // Solo  para  el caso 2 Que no se puede Repetir con respocto a  el codigo de origen de el plugin extraido de la Api al que corresponde                
    
}// FIN Function Armar Tabla Estudiante




function ArmarestudiantesAsignados (html)
{
    var NoRegistros = "Esperando Especialidad...";

    if(html!='') NoRegistros= "Ningún Estudiante Asignado" ;
       
        $("#tablaEstudianteAsignados").empty();
       
        $("#tablaEstudianteAsignados").append(html);
       
        $("#tablaEstudianteAsignados").dataTable().fnDestroy();
       
        $("#tablaEstudianteAsignados").DataTable({ // Cannot initialize it again error
       
            "aoColumns"      : [
            { "bSortable"    : false },
            null, null, 
            ],
            
            "language"       : {
            "sProcessing"    : "Procesando...",
            "sLengthMenu"    : 'Mostrando _MENU_ Registros',
            "sZeroRecords"   : "No se encontraron Resultados",
            "sEmptyTable"    :  NoRegistros,
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
        $("select.form-control").selectBoxIt();
}


function ArmartablaMostrarAsignacionEspecialidades(tabla , html){

        $(tabla).empty();
        
        $(tabla).append(html);
        
        $(tabla).dataTable().fnDestroy();
        
        $(tabla).dataTable({ // Cannot initialize it again error
        
        "aoColumns"      : [
        { "bSortable"    : false },
        null, null, null ,null
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
        'columnDefs'     : [{
        'targets'        : 0,
        'searchable'     :false,
        'visible'        :false
                           }],
        'order'          : [1, 'asc'],        
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5 
        }); 
        
        $("select.form-control").selectBoxIt();

        AutoActivarTooltip();

        agregarCaptionAsignacionEspecialidad(tabla);

        $(tabla+' tbody').on('click','tr',function ()
        {
            if( ($(this).find('.codeTempor').html() != '') && ( $(this).find('.codeTempor').html() !='codigo') ){ 

                    detallesthisTemporada($(this).find('.codeTempor').html());
            }
        });
}                 



    function ArmartablaespecialidadesNoasignadas(tabla , html)
    {
        var  rows_selected =[];
        
        $(tabla).empty();
        
        $(tabla).append(html);
        
        $(tabla).dataTable().fnDestroy(); var tablaaa =
        
        $(tabla).DataTable({ // Cannot initialize it again error
        
        "aoColumns": [
          { "bSortable": false },
          null, null, null 
          ],

            "language"          : {
            "sProcessing"       : "Procesando...",
            "sLengthMenu"       : 'Mostrando _MENU_ Registros',
            "sZeroRecords"      : "No se encontraron Resultados",
            "sEmptyTable"       : "Ningún dato disponible en esta tabla",
            "sInfo"             : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty"        : "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered"     : "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix"      : "",
            "sSearch"           : "Buscar:",
            "sUrl"              : "",
            "sInfoThousands"    : ",",
            "sLoadingRecords"   : "Cargando...",
            "oPaginate"         : {
            "sFirst"            : "Primero",
            "sLast"             : "Último",
            "sNext"             : "Siguiente",
            "sPrevious"         : "Anterior"
            },
            "oAria"             : {
            "sSortAscending"    : ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending"   : ": Activar para ordenar la columna de manera descendente"
            }
            },
            "aLengthMenu"       : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength"    : 4,
            'columnDefs'        : [{
            'targets'           : 0,
            'searchable'        : false,
            'orderable'         : false,
            
            'render'            : function (data, type, full, meta){
            return '<input type ="checkbox" class=asignarespecialidad>';
            }
            }],
            'order'             : [1, 'asc'],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('info');
         }
        }
    }); 

 $(tabla+' tbody').on('click', 'input[type="checkbox"]', function(e){
              var $row = $(this).closest('tr');

              // Get row data
              var data = tablaaa.row($row).data();

              // Get row ID
              var rowId = data[0];

              // Determine whether row ID is in the list of selected row IDs 
              var index = $.inArray(rowId, rows_selected);

              // If checkbox is checked and row ID is not in list of selected row IDs
              if(this.checked && index === -1){
                 rows_selected.push(rowId);

              // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
              } else if (!this.checked && index !== -1){
                 rows_selected.splice(index, 1);
              }

              if(this.checked){
                 $row.addClass('info');
              } else {
                 $row.removeClass('info');
              }

              // Update state of "Select all" control
              updateDataTableSelectAllCtrl(tablaaa);
              habilitarBotnModalEspecialidades();
              // Prevent click event from propagating to parent
              e.stopPropagation();
              
           });
      // Handle click on "Select all" control
           
           $(tabla+' thead input[name="select_all"]').on('click', function(e){
              if(this.checked){
                 $(tabla+' tbody input[type="checkbox"]:not(:checked)').trigger('click');
              } else {
                 $(tabla+' tbody input[type="checkbox"]:checked').trigger('click');
              }
              
              // Prevent click event from propagating to parent
              e.stopPropagation();
            
           });
        if( html!='') EventosCheckbox(tablaaa , tabla); // Solo  para  el caso 2 Que no se puede Repetir con respocto a  el codigo de origen de el plugin extraido de la Api al que corresponde                
   

                      
      }

      function habilitarBotnModalEspecialidades()
      {
                if($(".asignarespecialidad").is(':checked')) {  
                    $("#asignarEspecialidad").attr('disabled', false);  
                } else {  
                    $("#asignarEspecialidad").attr('disabled', true);   
                }
      }
      function habilitarBotnModalEstudiantes()
      {
                if($('#tablaEstudiante tbody input[type="checkbox"]').is(':checked')) {  
                    $("#asignar").attr('disabled', false);  
                } else {  
                    $("#asignar").attr('disabled', true);   
                }
      }



      function ArmartablaespecialidadesSiasignadas(tabla , html)
      {

        $(tabla).empty();
        
        $(tabla).append(html);
        
        $(tabla).dataTable().fnDestroy();
        
        $(tabla).dataTable({ // Cannot initialize it again error
        
            "aoColumns"      : [
            { "bSortable"    : false },
            null
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

        $("select.form-control").selectBoxIt();
                      
      }

    function ArmarPreparadaforCurso(tabla , html)
    {

        $(tabla).empty();
        
        $(tabla).append(html);
        
        $(tabla).dataTable().fnDestroy();
        
        $(tabla).dataTable({ // Cannot initialize it again error
            
            
            "aoColumns"      : [
            { "bSortable"    : false },
            null, null ,null, null
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
            },'columnDefs'   : [{
            
            'targets'        : [ 4 ],
            'searchable'     : true,
            'orderable'      : false,
            
            },{
            'targets'        : [ 0 ],
            'searchable'     : false,
            'visible'        : false,

            }],'order':[1, 'asc'],
            "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength" : 5
        }); 
            
        $("select.form-control").selectBoxIt();

        AutoActivarTooltip();

        agregarCaptionAsignacionEntregables(tabla);
            
        $(tabla+' tbody').on('click','tr',function(){
                
            $("#modal_AbrirTEMPORADA").modal('show');

            buscarEstatemporada($(this).find('.code_temporraa').html() ,"#informacionTemporadaGeneral");
            
            EspecialidadesAsignadasSegunTemporada($(this).find('.code_temporraa').html());
            
            EntregablesAsignadasSegunTemporada(   $(this).find('.code_temporraa').html());
            
            EntregablesNoAsignadasSegunTemporada( $(this).find('.code_temporraa').html());
            
            BuscarLosEntregablesBD();

        });
}




function updateDataTableSelectAllCtrl(table){
  
   var $table             = table.table().node();
  
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
  
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
  
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }
}

function EventosCheckbox(tablaaa , idTablaVictima)
{
   // Handle click on table cells with checkboxes
   $(idTablaVictima).off('click', 'tbody td, thead th:first-child');
   
   $(idTablaVictima).on('click', 'tbody td, thead th:first-child', function(e){
      
      $(this).parent().find('input[type="checkbox"]').trigger('click');
      
   });

   // Handle table draw event

    tablaaa.on('draw', function(){
      // Update state of "Select all" control
    updateDataTableSelectAllCtrl(tablaaa);
      
   });

}

function AutoActivarTooltip(){

  $(".pagination > li.paginate_button ").click( function(){

      $('[data-toggle="tooltip"]').tooltip();

      setTimeout(function(){AutoActivarTooltip()},1000);
  }); 

  $("div.dataTables_length").find('.form-control').change(function(){

      $('[data-toggle="tooltip"]').tooltip();

      setTimeout(function(){AutoActivarTooltip()},1000);
  });

}



function agregarCaptionAsignacionEntregables( tabla )
{
    $(tabla).append(
        '<caption >'+
                    '<ul class="nav-justified" >'+

                      '<li class="icon text-primary">'+
                       
                            '<label >'+
                            '<span class="fa-stack fa-lg">'+
                            '<i class="fa fa-square-o fa-stack-2x"></i>'+
                            '<i class="fa fa-flag fa-stack-1x"></i>'+
                            '</span>'+
                            '<i class="fa fa-arrow-right"></i> Tipo Especialidad'+
                            '</label>'+
                        
                      '</li>'+

                      '<li class="icon text-primary">'+
                       
                            '<label >'+
                            '<span class="fa-stack fa-lg">'+
                            '<i class="fa fa-square-o fa-stack-2x"></i>'+
                            '<i class="fa fa-graduation-cap fa-stack-1x"></i> '+
                            '</span>'+
                            '<i class="fa fa-arrow-right"></i> Especialidad'+
                            '</label>'+
                        
                      '</li>'+
                        
                      '<li  class="icon text-primary">'+
                       
                            '<label >'+
                            '<span class="fa-stack fa-lg" aria-hidden="true">'+
                            '<i class="fa fa-square-o fa-stack-2x"></i>'+
                            '<i class="fa fa-users fa-stack-1x"></i>'+
                            '</span>'+
                            '<i class="fa fa-arrow-right"></i> Estudiantes'+
                            '</label>'+
                        
                      '</li>'+

                      '<li  class="icon text-primary">'+
                       
                            '<label >'+
                            '<span class="fa-stack fa-lg">'+
                            '<i class="fa fa-square-o fa-stack-2x"></i>'+
                            '<i class="fa fa-list-alt fa-stack-1x"></i>'+
                            '</span>'+
                            '<i class="fa fa-arrow-right"></i> Entregables'+
                            '</label>'+
                        
                      '</li>'+                      

                    '</ul>'+
        '</caption>');
     
}


function agregarCaptionAsignacionEstudiantes( tabla )
{
    $(tabla).append(
        '<caption >'+
                    '<ul class="nav-justified" >'+

                      '<li  class="icon text-primary" >'+
                       
                            '<label >'+
                              '<span class="fa-stack fa-lg">'+
                                '<i class="fa fa-square-o fa-stack-2x"></i>'+
                                '<i class="fa fa-flag fa-stack-1x"></i>'+
                              '</span>'+
                              '<i class="fa fa-arrow-right"></i> Tipo Especialidad'+
                            '</label>'+
                        
                      '</li>'+

                      '<li  class="icon text-primary">'+
                       
                            '<label >'+
                            '<span class="fa-stack fa-lg">'+
                              '<i class="fa fa-square-o fa-stack-2x"></i>'+
                              '<i class="fa fa-graduation-cap fa-stack-1x"></i> '+
                            '</span>'+
                            '<i class="fa fa-arrow-right"></i> Especialidad'+
                            '</label>'+
                        
                      '</li>'+
                        
                      '<li  class="icon text-primary">'+
                       
                            '<label >'+
                            '<span class="fa-stack fa-lg">'+
                            '<i class="fa fa-square-o fa-stack-2x"></i>'+
                            '<i class="fa fa-users fa-stack-1x"></i>'+
                            '</span>'+
                            '<i class="fa fa-arrow-right"></i> Estudiantes'+
                            '</label>'+
                        
                      '</li>'+

                    '</ul>'+
        '</caption>');
     
}

function agregarCaptionAsignacionEspecialidad( tabla )
{
    $(tabla).append(
        '<caption >'+
                    '<ul class="nav-justified" >'+

                      '<li  class="icon text-primary">'+
                        
                            '<label >'+
                              '<span class="fa-stack fa-lg">'+
                                '<i class="fa fa-square-o fa-stack-2x"></i>'+
                                '<i class="fa fa-flag fa-stack-1x"></i>'+
                              '</span>'+
                              '<i class="fa fa-arrow-right"></i> Tipo Especialidad'+
                            '</label>'+
                        
                      '</li>'+

                      '<li  class="icon text-primary">'+
                        
                            '<label >'+
                            '<span class="fa-stack fa-lg">'+
                              '<i class="fa fa-square-o fa-stack-2x"></i>'+
                              '<i class="fa fa-graduation-cap fa-stack-1x"></i> '+
                            '</span>'+
                            '<i class="fa fa-arrow-right"></i> Especialidad'+
                            '</label>'+
                        
                      '</li>'+

                    '</ul>'+
        '</caption>');
     
}