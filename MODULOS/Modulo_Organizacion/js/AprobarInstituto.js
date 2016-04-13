
function aprobar(button)
{
        var solicitud = new Array();
        solicitud     =$(button).closest("tr").find('td').eq(8).text(); 
        click_buttonAprobado(solicitud);
}

function rechazar(element)
{
        var solicitud = new Array();
        solicitud     =$(element).closest("tr").find('td').eq(8).text(); 
        click_buttonRechazar(solicitud);
}

function click_buttonAprobado( id_Solicitud)
{      
        var Solicitud    = id_Solicitud.split('$');
        
        var persona      = Solicitud[0];
        var organizacion = Solicitud[1];
        var oficina      = Solicitud[2];
          
AprobarUsuario( persona , organizacion ,oficina  );
}

function click_buttonRechazar( id_Solicitud)
{  
    $("#id_persona_oficina").val(id_Solicitud);

    $('#modal_rechazar_empresa').modal('show');

    Datos(id_Solicitud);
}


$('#Ver').click(function (){

         var solicitud    = $("#id_persona_oficina").val();
         
         var Solicitud    = solicitud.split('$');
         
         var persona      = Solicitud[0];
         var organizacion = Solicitud[1];
         var oficina      = Solicitud[2];
         
         var validar      =   validar_formn();

      if(validar)
      { 
        
        RechazarUsuario(persona , organizacion ,oficina);
      }else 
      {
        //alert('Campos Incorrectos');

      }


$('#modal_rechazar_empresa').modal('show');

});

$("#descipcion_Rechazo").val('');

function validar_formn()
{

    if($("#descipcion_Rechazo").val()=='')
    {


        $("#descipcion_Rechazo").focus();
        return false;
    }else
    if($("#fecha_rechazo").val()=='')
    {
        $("#fecha_rechazo").focus();
        return false;

    }
    else if($("#fecha_rechazo").val() < $("#fecha_solicitud").val())
        {
         alert('fecha no  valida');
        $("#fecha_rechazo").focus();
        return false;
         }
    else 
    {
        return true;
    }

}

function AprobarUsuario(persona , organizacion ,oficina){
    

    var porid4  = "actualiza";
   
    $.ajax({

        async   :true, 

        cache   :false,

        dataType:"html", 

        type    : 'POST',   

        url     : "../controlador/recibeInstitutoFormulario.php",

        data    : {
            
            action        : 'APROBADO',
            
            aprobarUsuario: 'siva',
            
            id_persona    : persona,
            
            sucursal      : organizacion,
            
            id_oficina    : oficina,
            
            actualiza     : porid4

              },
              
        success: function(data){ 

    	if(data == 1)
    	{
    		//alert('Usuario Aprobado');
    		swal('Usuario Fué Aprobado','','success');
            ActualizarTablas();
        	
    	}else 
    	{
    		swal('Upps Ocurrio Un Error','','error');
    	}

        }
    });
    
}


function RechazarUsuario(persona , organizacion ,oficina){

    var descripcion_de_rechazo = $("#descipcion_Rechazo").val();
    
    var fecha_de_rechazo       = $("#fecha_rechazo").val();
    
    var porid4                 = "actualiza";
   
    $.ajax({

        async   :true, 

        cache   :false,

        dataType:"html", 

        type    : 'POST',   

        url     : "../controlador/recibeInstitutoFormulario.php",

        data    : {

            action         : 'RECHAZADO',
            descripcion    : descripcion_de_rechazo,
            fecha_rechazo  : fecha_de_rechazo,
            rechazarUsuario: 'siva',
            id_persona     : persona,
            sucursal       : organizacion,
            id_oficina     : oficina,
            
            actualiza      : porid4

              },
              
            success: function(data){ 
               
            		if (data == 1)
            		{
            			swal('Bien','Usuario Fué Rechazado','success');
                        ActualizarTablas();

            		}else{
            			swal('Upps ','Ocurrio Un Error','error');
            		}
                    $('#modal_rechazar_empresa').modal('hide');
            	}
    });

    
}

function  Datos(ID_Solicitud) {

        var Solicitud    =ID_Solicitud.split('$');
        
        var persona      = Solicitud[0];
        var organizacion = Solicitud[1];
        var oficina      = Solicitud[2];



$.ajax({
        async   :true, 
        
        cache   :false,
        
        dataType:"html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : {
  
            id_persona : persona,
            
            sucursal   : organizacion,
            
            id_oficina : oficina,
            
            id_ip      :$("#id_ip").val(),
            
            Observacion: 'blaaaa'

              },              
        success: function(data)
        { 
         
        var variable = JSON.parse(data);
        $("#nombre_persona").val(variable.nombre+' '+variable.apellido);

        $("#telefono").val(variable.telefono);
        $("#nombre_oficina").val(variable.nombre_oficina);
        $("#nombre_oganizacion").val(variable.nombre_organizacion);
        $("#fecha_solicitud").val(variable.fecha_solicitud);
        $("#descipcion_Registro").val(variable.descripcion);
        $("#correo").val(variable.correo);
        if(variable.nombre_perfil =='Menú Empresa'){ var perfil_con_sentido = 'La Persona Contacto de una Organización' ; }
        $("#perfil").val(perfil_con_sentido);

        }

    });

 }
function Probar( Codigo , Accion )
{   


    if(Accion=='Codificar')
    {   
        var Var = Codigo.split('-');

        var Criptado="'";

            for(var i = 0 ; i < Var.length ; i++ )
            {                   
                for(var i2 = 0 ; i2 < Var[i].length ; i2++ )
                {   
                    var bit = Blindar( Var[i].charAt(i2) );
                    Criptado +=bit; 
                    if(i==Var.length-1 ){ Criptado +="'" } else
                    if( i2 == Var[i].length-1){ Criptado +='-' ;}                
                    
                }
            }
           return Criptado;

    }else if(Accion=='DeCodificar')
    {

        var Var = Codigo.split('-');

        var Criptado="";

            for(var i = 0 ; i < Var.length ; i++ )
            {                   
                for(var i2 = 0 ; i2 < Var[i].length ; i2++ )
                {   
                    var bit = UNBlindar( Var[i].charAt(i2) );
                    Criptado +=bit; 
                    if(i==Var.length-1 ){ Criptado +="" } else
                    if( i2 == Var[i].length-1){ Criptado +='-' ;}                
                    
                }
            }
           //alert(Criptado);
               $("#id_persona_oficina").val(Criptado);

               $('#modal_rechazar_empresa').modal('show');
               Datos(Criptado);


    }else if(Accion=='Aprobar') 
    {   

        var Separadores = Codigo.split('-');

        var Criptado="";

            for(var i = 0 ; i < Separadores.length ; i++ )
            {                   
                for(var i2 = 0 ; i2 < Separadores[i].length ; i2++ )
                {   
                    var bit = UNBlindar( Separadores[i].charAt(i2) );
                    Criptado +=bit; 
                    if(i==Separadores.length-1 ){ Criptado +="" } else
                    if( i2 == Separadores[i].length-1){ Criptado +='-' ;}                
                    
                }
            }

            click_buttonAprobado( Criptado);

    }
    
} //FIN ENCRIPTACION JESUS ANTI OPERACIONES MATEMATICAS....
function ActualizarTablas()
{
    $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType:"html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : {

            id_ip           : $("#id_ip").val(), 

            BuscarPendientes: 'BuscarPendientes'

              },
              
            success: function(data)
            { 
                    
                    var Variable = JSON.parse(data);
                    var html     = "";
                   
                                           
                   $.each(Variable, function(index, value){
                        
                        var Caccion        = 'Codificar';
                        var codigodelBoton =  Probar( Variable[index].solicitud ,Caccion );

                    html +="<tr>"+
                    
                    "<td><center>"+Variable[index][4]+" </center></td><td><center>"+Variable[index][5]+" </center></td>"+
                    
                    "<td><center>"+Variable[index][6]+" </center></td>"+
                    
                    "<td><center>"+Variable[index][0]+" - "+Variable[index][1]+"</center></td>"+
                    
                    "<td><center>"+Variable[index][2]+"</center></td><td><center>"+Variable[index][3]+"</center></td>"+
                    
                    "<td><center>"+Variable[index][8]+"</center></td>"+
                    
                    "<td ><center>"+
                    
                    "<button class="+" 'btn btn-default btn-xs' "+" onclick=aprobar(this) name="+"'Aprobar'"+"> "+
                    
                    "<img  src=../../../img/iconos/ok.png  width=20 ./> </button> "+
                    
                    "<button class="+" 'btn btn-default btn-xs' "+"  onclick=rechazar(this) name="+" 'Rechazar' "+" >"+
                    
                    "<img  src=../../../img/iconos/cancel.png  width=20 ./> </button>"+
                    
                    "</center></td><td hidden style=display:none>"+value['solicitud']+"</td></tr>" ;

                    $("#CantidadP").html(index+1);
                                
                    });
                        
                     ArmarTabla( "#Pendienet", html);
            }
        }); // ajax 


    $.ajax({
       
        async   :true, 
       
        cache   :false,
       
        dataType:"html", 
       
        type    : 'POST',   
       
        url     : "../controlador/recibeInstitutoFormulario.php",
       
        data    : {
       
            id_ip          : $("#id_ip").val(), 
            
            BuscarAprobados: 'BuscarAprobados'

              },
              
            success: function(data)
            { 
                    
                    var Variable = JSON.parse(data);
                   
                    var html     = "";
                                                              
                   $.each(Variable, function(index, value){


                    html +="<tr>"+
                    
                    "<td>"+value[4]+" </td><td>"+value[5]+" </td>"+
                    
                    "<td>"+value[6]+" </td>"+
                    
                    "<td>"+value[0]+" - "+value[1]+"</td>"+
                    
                    "<td>"+value[2]+"</td><td>"+value[3]+"</td>"+
                    
                    "<td>"+value[8]+"</td>"+
                    
                    "<td >"+
                    //"<button class="+" 'btn btn-default' "+" onclick=alert("+codigodelBoton+")  name=Aprobar> "+
                    //"<img  src=../../../img/iconos/ok.png  width=20 ./> </button> "+
                    //"<button class="+" 'btn btn-default' "+" onclick=Probar("+codigodelBoton+","+"'DeCodificar'"+")  name=Rechazar >"+
                    //"<img  src=../../../img/iconos/cancel.png  width=20 ./> </button>"+
                    "</td><td hidden style=display:none>"+value['solicitud']+"</td></tr>" ;

                           $("#CantidadA").html(index+1);     
                    });
                      
                     ArmarTabla( '#Aprobad', html);
            }
        }); // ajax 


    $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType:"html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : {

            id_ip           : $("#id_ip").val(), 

            BuscarRechazados: 'BuscarRechazados'

              },
              
            success: function(data)
            { 
                    
                    var Variable = JSON.parse(data);

                    var html     = "";
                   
                   $.each(Variable, function(index, value){
                        
                    var Caccion = 'Codificar';
                        
                    html +="<tr>"+

                    "<td>"+value[4]+" </td><td>"+value[5]+" </td>"+
                    
                    "<td>"+value[6]+" </td>"+
                    
                    "<td>"+value[0]+" - "+value[1]+"</td>"+
                    
                    "<td>"+value[2]+"</td><td>"+value[3]+"</td>"+
                    
                    "<td>"+value[8]+"</td>"+
                    
                    "<td>"+
                    //"<button class="+" 'btn btn-default' "+" onclick=alert("+codigodelBoton+")  name=Aprobar> "+
                    //"<img  src=../../../img/iconos/ok.png  width=20 ./> </button> "+
                    //"<button class="+" 'btn btn-default' "+" onclick=Probar("+codigodelBoton+","+"'DeCodificar'"+")  name=Rechazar >"+
                    //"<img  src=../../../img/iconos/cancel.png  width=20 ./> </button>"+
                    "</td><td hidden style=display:none>"+value['solicitud']+"</td></tr>" ;
                                
                                $("#CantidadR").html(index+1);   
                    });
                     ArmarTabla( '#Rechazad', html);
            }
        }); // ajax 







limpiarMOdal();

}


      function ArmarTabla (  tabla , Contenido)
      {

        $(tabla).empty();

        $(tabla).append(Contenido);

        $(tabla).dataTable().fnDestroy();

        $(tabla).dataTable({ // Cannot initialize it again error
          "aoColumns"  : [
          
          { "bSortable": false },
          null, null, null, null, null, null , null , null 
          ],

           "language"        : {
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
            },
            'columnDefs'     : [{
            'targets'        : 7,
            'searchable'     :true,
            'orderable'      :false,
             
                                }],
            "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength" : 5 
            }); // FIN DE STYLE DATATABLE
            
            $('select').selectBoxIt();
      }


      function limpiarMOdal()
      {
        $("#id_persona_oficina").val('');
       
        $("#nombre_persona").val('');
       
        $("#telefono").val('');
       
        $("#nombre_oficina").val('');
       
        $("#nombre_oganizacion").val('');
       
        $("#fecha_solicitud").val('');
       
        $("#descipcion_Registro").val('');
       
        $("#correo").val('');
       
        $("#perfil").val('');
        
        $("#descipcion_Rechazo").val('');
       
        $("#fecha_rechazo").val('');
      }


      function Blindar( BIT )
      {

       var A = 0;
       var S = 1;
       var D = 2;
       var F = 3;
       var G = 4;
       var H = 5;
       var J = 6;
       var K = 7;
       var L = 8;
       var Ñ = 9;
             if( BIT==A){ return 'A'; }
        else if( BIT==S){ return 'S'; } 
        else if( BIT==D){ return 'D'; }
        else if( BIT==F){ return 'F'; }
        else if( BIT==G){ return 'G'; }
        else if( BIT==H){ return 'H'; }
        else if( BIT==J){ return 'J'; }
        else if( BIT==K){ return 'K'; }
        else if( BIT==L){ return 'L'; }
        else if( BIT==Ñ){ return 'Ñ'; }
      }

      function UNBlindar(BIT)
      {

             if( BIT=='A'){ return 0; }
        else if( BIT=='S'){ return 1; } 
        else if( BIT=='D'){ return 2; }
        else if( BIT=='F'){ return 3; }
        else if( BIT=='G'){ return 4; }
        else if( BIT=='H'){ return 5; }
        else if( BIT=='J'){ return 6; }
        else if( BIT=='K'){ return 7; }
        else if( BIT=='L'){ return 8; }
        else if( BIT=='Ñ'){ return 9; }
      }




$(document).ready(function(){

        $('#Pendienet').dataTable({  

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
            $('#Aprobad').dataTable({  

             "language"      : {
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
            $('#Rechazad').dataTable({  

             "language"      : {
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
            },'columnDefs'   : [{
            'targets'        : 8,
            'searchable'     :true,
            'orderable'      :false,
                       
                    }],
            "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
            "iDisplayLength" : 5 
            }); // FIN DE STYLE DATATABLE

        ActualizarTablas();

        });