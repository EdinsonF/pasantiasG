

$(document).ready(function(){

  $("#buscarRegistrios").click(function(){ BuscarRegistrosesss(); $(this).prop('disabled',true); });

  $("#PersonaEn").click(function(){
        
    if(ValidarCampos()){  RegistrarPersonaEncargada();  restablecer();  }
            
  }); 

  InicializarEventos();

  EventoModalBotone();

});


function EventoModalBotone( )
{
  $("#tabla").on('shown.bs.modal', function(){ 
      $(this).find('table').DataTable().columns.adjust().responsive.recalc();
      $("#buscarRegistrios").prop('disabled', true);
  });

  $("#tabla").on('hide.bs.modal', function(){ 

      $("#buscarRegistrios").prop('disabled', false);
  });
}




function MostrarInstitucionesPrincipales() 
{

$.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType: "html", 
        
        type    : 'POST',   

        url     : "../controlador/recibeInstitutoFormulario.php",

        data    : 
        {
           
            tabla : 'bla'
        },              
    
success: function(data){ 
      
  var variable = JSON.parse(data);
               
                var Contenido = '';
                $.each(variable, function(index, value){
   
                   Contenido +="<tr class=principal id="+index+" aria-hidden='true' onclick=seleccionarPrincipal(this);>"+
                    
                    "<td>" + value.siglas + "</td>"+
                    
                    "<td>" + value.nombre_estado + "</td> "+
                    
                    "<td>" + value.nombre_municipio +"</td> "+
                    
                    "<td>" + value.nombre_tipo_organizacion + "</td>"+
                    
                    "<td> <label hidden class=id_organizacion >"+value.id_ip+"</label>"+
                    
                    "<img src=../../../img/iconos/ok.png alt=Ginger class=left width=20 ./>"+

                    "<label hidden style=display:none>"+value.codigo_sucursal +"</label></td></tr>";


                });
                  ArmarTabla(Contenido);

                $("#tabla").modal('show');

    }//success
    }); // $.ajax()
}

 function ConsultaUsuarios(){

 	var usuariod= $("#usuarioP").val();

 	if(usuariod==""){
 		$("#usuario").html("");
 		return;
 	}

 $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType: "html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : 
        {
            usuario        : usuariod,
            
            Busquedausuario: 'usuario'
        },              
    
success: function(data){
   
  var variable = JSON.parse(data);

     if(variable.result==1)
     {
              
        $("#usuario").html('<img src="../../../img/Ico-master/PNG/64px/0272-cross.png"  width=20>'+" Usuario ya Existe");
             
     }else{         
        $("#usuario").html(null);
        $("#usuario").empty();
        //$("#usuario").detach();
     }

    }
    });
    
    
    }

function BuscarRegistrosesss()
{
$.ajax({
        
        async   : true, 
        
        cache   : false,
        
        dataType: "html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : 
        {           
            ContarInstitucionesPrincipales : 'SIPISs'
        },              
    
        success: function(data){ 
    
        if(data==0)
        {
            swal({   title:'Atención' , text: "No Hay Instituciones Principales",   type: "warning",  });
            $("#IDIPNEW").focus();
        }else 
        {
            MostrarInstitucionesPrincipales();
        }
                 


        }//success
    }); // $.ajax()
}


function ValidarCampos()
{
			// Obtengo las  values de los  campos del formulario de la persona encargada
var Instituto =  $("#superidOrganizacion").val();
var Cedula    =  $("#cedulaPE").val();
var nombre    =  $("#nombrePE").val();
var apellido  =  $("#apellidoPE").val();
var telefono  =  $("#telefonoPE").val();
var correo    =  $("#correoPE").val();
var usuario   =  $("#usuarioP").val();
var pass_a    =  $("#contrasena_a").val();
var pass_b    =  $("#contrasena_b").val();

     if(Instituto=="")
     {
      $("#buscarRegistrios").prop("disabled",true);
      setInterval(function(){ $("#buscarRegistrios").prop("disabled",false); },5000);

      MensajeSeleccioneinstituto();
      return false;
     }
      else    if(Cedula=="")
     {
      $("#cedulaPE").focus();
      MensajeCamposVacios();
      return false;
     }else  if(nombre=="")
     {
      $("#nombrePE").focus();
      MensajeCamposVacios();
      return false;
     }else  if(apellido=="")
     {
      $("#apellidoPE").focus();
      MensajeCamposVacios();
      return false;
     }else  if(telefono=="")
     {
      $("#telefonoPE").focus();
      MensajeCamposVacios();
      return false;
     }else  if(correo=="")
     {
      $("#correoPE").focus();
      MensajeCamposVacios();
      return false;
     }else if(usuario=="" )
     {
      $("#usuarioP").focus();

      MensajeCamposVacios();
      return false;
     }else if($("#usuario").html() !="")
     {  
       
        MensajeNoUsuario();
        $("#usuarioP").focus();
        return false;
     } 
     else if(pass_a=="")
     {
      $("#contrasena_a").focus();
      MensajeCamposVacios();
      return false;
     }else if(pass_b=="")
     {
      
      $("#contrasena_b").focus();
      MensajeCamposVacios();
      return false;
     }else if($('#contrasena_b').val() != $('#contrasena_a').val())
      {
        $('#contrasena_b').val('');
        $('#contrasena_b').focus();
        MensajeContrasenanoverificada();
      }
      else
      if($("#pregunta").val()=='' || $("#pregunta").val().length==0){
        $("#pregunta").focus();
        MensajeDinamico('Esta Pregunta no es Válida');
        return false;
      }else 

    if($("#respuesta").val().length < 2)
    {
        $("#respuesta").focus();
        MensajeDinamico('La Respuesta debe tener mínimo 2 caracteres ');
        return false;
    }
     else
    {
      return true;
    }

}



function RegistrarPersonaEncargada(){
    
var Instituto = $("#superidOrganizacion").val();
var Cedula 	  = $("#cedulaPE").val();
var nombre 	  = $("#nombrePE").val();
var apellido  = $("#apellidoPE").val();
var telefono  = $("#telefonoPE").val();
var correo    = $("#correoPE").val();
var usuario   = $("#usuarioP").val();
var pass_b    = $("#contrasena_b").val();
var porid4    = "registra";
    
    $.ajax({
          
          async   :true, 
          
          cache   :false,
          
          dataType: "html", 
          
          type    : 'POST',   
          
          url     : "../controlador/recibeInstitutoFormulario.php",
          
          data    : 
          {
            Instituto               : Instituto,
            cedula                  : Cedula,
            nombre                  : nombre,
            apellido                : apellido,
            telefono                : telefono,
            correo                  : correo,
            usuario                 : usuario,
            contrasena              : pass_b,
            pregunta                : $("#pregunta").val(),
            respuesta               : $("#respuesta").val(),
            descripcion             : $("#Dedica").val(),
            registraPersonaEncargada: porid4
          },              
    
        success: function(data){ 


      //alert(data);
      var variable = JSON.parse(data);


        if(variable.PERSONA.result == 1)
        { 
          swal({   title:'Bien' , text: "Persona Asignada", type: "success" });
        } else if(variable.PERSONA.result=='Ya  Existe')
        {
          swal({ title:'Atención',  text: "Asignación Ya Existe", type: "warning" });
        }
        else{ 
          swal({ title:'Ups',  text: "Error De Programación, Algo No anda bien", type: "error" }); }
         
        }
    });
    
}

function restablecer()
{
 $("#superidOrganizacion").val("");
 $("#cedulaPE").val("");
 $("#nombrePE").val("");
 $("#apellidoPE").val("");
 $("#telefonoPE").val("");
 $("#correoPE").val("");
 $("#usuarioP").val("");
 $("#contrasena_b").val("");
 $("#contrasena_a").val("");
 $("#titlee").html("");
 $("#Dedica").val("");
 $("#pregunta").val("");
 $("#respuesta").val("");

 $("#pregunta").data("selectBoxIt").refresh();

 Renderidng_select();
}


function MensajeCamposVacios()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Campos Vacíos'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'swing',
        cssanimationOut: 'bounceOut'
 
});
}

function MensajeDinamico(mensaje)
{
  $.amaran({
        content        :
        {
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        : mensaje
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'swing',
        cssanimationOut: 'bounceOut'
 
});
}

function MensajeSeleccioneinstituto()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Seleccione la Organización'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut'
 
});
}

function MensajeContrasenanoverificada()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Verifique su contraseña'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut'
 
});
}

function MensajeRegistrado()
{
        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Operacion Exitosa'
                   },
                   theme          :'colorful',
                   
                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'top right'
                });

}


function MensajeNoRegistrado()
{
        $.amaran({
                   content        :{
                   bgcolor        :'#FF3300',
                   color          :'#fff',
                   message        :'Operación No Exitosa'
                   },
                   theme          :'colorful',
                   
                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'top right'
                });

}


function MensajeNoUsuario()
{
        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Usuario No Permitido'
                   },
                   theme          :'colorful',
                   
                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'bottom right'
                });

}




        
function ArmarTabla( Contenido )
{

        $("#myTable").empty();
        $("#myTable").append(Contenido);
        $("#myTable").dataTable().fnDestroy();
        $("#myTable").dataTable({ // Cannot initialize it again error
                "aoColumns"      : [
                { "bSortable"    : false },
                null, null, null , null
                ],
                
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
                "oAria"          : {
                "sSortAscending" :  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                   }
                },'columnDefs'   : 
                [{
                'targets'        : 4,
                'searchable'     : true,
                'orderable'      : false
                
                }] ,
                "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
                "iDisplayLength" : 5
        }); 
      $("select").selectBoxIt();
}




function InicializarEventos (){

$('#nombrePE').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou ');
$('#apellidoPE').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou ');
$('#Dedica').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou ');


$('#correoPE').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou0123456789_-@.');

//Para escribir solo numeros    
$('#cedulaPE').validCampoFranz('0123456789'); 

$('#telefonoPE').validCampoFranz('0123456789'); 
//ASIGNANDO  EVENTOS  DESDE  JQUERY ...
$("#usuarioP").keyup(ConsultaUsuarios);


$('#cedulaPE').on('keyup', function (e) {
      var ultimocaracter = $("#cedulaPE").val();

      var cadena =ultimocaracter.substring($("#cedulaPE").val().length-1);
      if(cadena != 0 && cadena != 1 &&
         cadena != 2 && cadena != 3 &&
         cadena != 4 && cadena != 5 &&
         cadena != 6 && cadena != 7 &&
         cadena != 8 && cadena != 9 ) {
      $("#cedulaPE").val(ultimocaracter.substring(0,$("#cedulaPE").val().length-1));

      }
            if(cadena =="´") {

      $("#cedulaPE").val(ultimocaracter.substring(0,$("#cedulaPE").val().length-1));
            var newValor = $("#cedulaPE").val().split('´');
     
      $("#cedulaPE").val(newValor[0]);}else
      {
      var newValor = $("#cedulaPE").val().split('´');
     
      $("#cedulaPE").val(newValor[0]);
      }
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#nombrePE').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
 $('#nombrePE').on('keyup', function (e) {
    
    var ultimocaracter = $("#nombrePE").val();

      var cadena =ultimocaracter.substring($("#nombrePE").val().length-1);
            if(cadena =="´") {

      $("#nombrePE").val(ultimocaracter.substring(0,$("#nombrePE").val().length-1));
            var newValor = $("#nombrePE").val().split('´');
     
      $("#nombrePE").val(newValor[0]);}else
      {
      var newValor = $("#nombrePE").val().split('´');
     
      $("#nombrePE").val(newValor[0]);
      }
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#apellidoPE').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
 $('#apellidoPE').on('keyup', function (e) {
    
    var ultimocaracter = $("#apellidoPE").val();

      var cadena =ultimocaracter.substring($("#apellidoPE").val().length-1);
            if(cadena =="´") {

      $("#apellidoPE").val(ultimocaracter.substring(0,$("#apellidoPE").val().length-1));
            var newValor = $("#apellidoPE").val().split('´');
     
      $("#apellidoPE").val(newValor[0]);}
      else
      {
      var newValor = $("#apellidoPE").val().split('´');
     
      $("#apellidoPE").val(newValor[0]);
      }
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#Dedica').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  


$("#Dedica").on('keyup',function(e){

   var ultimocaracter = $("#Dedica").val();

      var cadena =ultimocaracter.substring($("#Dedica").val().length-1);
            if(cadena =="´") {

      $("#Dedica").val(ultimocaracter.substring(0,$("#Dedica").val().length-1));
            var newValor = $("#Dedica").val().split('´');
     
      $("#Dedica").val(newValor[0]);}
        else
      {
      var newValor = $("#Dedica").val().split('´');
     
      $("#Dedica").val(newValor[0]);
      }
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#telefonoPE').focus();
});

 $('#telefonoPE').on('keyup', function (e) {
        var ultimocaracter = $("#telefonoPE").val();

      // var cadena =ultimocaracter.substring($("#telefonoPE").val().length-1);
      // if(cadena != 0 && cadena != 1 &&
      //    cadena != 2 && cadena != 3 &&
      //    cadena != 4 && cadena != 5 &&
      //    cadena != 6 && cadena != 7 &&
      //    cadena != 8 && cadena != 9 ) {
      //$("#telefonoPE").val(ultimocaracter.substring(0,$("#telefonoPE").val().length-1));}
      //if($("#telefonoPE").val().length==4){$("#telefonoPE").val($("#telefonoPE").val()+'-');}
      //if($("#telefonoPE").val().length==8){$("#telefonoPE").val($("#telefonoPE").val()+'-');}
      //if($("#telefonoPE").val().length==11){$("#telefonoPE").val($("#telefonoPE").val()+'-');}

      var cadena =ultimocaracter.substring($("#telefonoPE").val().length-1);
            if(cadena =="´") {

      $("#telefonoPE").val(ultimocaracter.substring(0,$("#telefonoPE").val().length-1));
            var newValor = $("#telefonoPE").val().split('´');
     
      $("#telefonoPE").val(newValor[0]);}
              else
      {
      var newValor = $("#telefonoPE").val().split('´');
     
      $("#telefonoPE").val(newValor[0]);
      }

      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#correoPE').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
 $('#correoPE').on('keyup', function (e) {
             var ultimocaracter = $("#correoPE").val();
      var cadena =ultimocaracter.substring($("#correoPE").val().length-1);
            if(cadena =="´") {

      $("#correoPE").val(ultimocaracter.substring(0,$("#correoPE").val().length-1));
            var newValor = $("#correoPE").val().split('´');
     
      $("#correoPE").val(newValor[0]);}
                    else
      {
      var newValor = $("#correoPE").val().split('´');
     
      $("#correoPE").val(newValor[0]);
      }
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#usuarioP').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
                                  
 $('#usuarioP').on('keyup', function (e) {
    
      var ultimocaracter = $("#usuarioP").val();
      var cadena =ultimocaracter.substring($("#usuarioP").val().length-1);
            if(cadena =="´") {

      $("#usuarioP").val(ultimocaracter.substring(0,$("#usuarioP").val().length-1));
            var newValor = $("#usuarioP").val().split('´');
     
      $("#usuarioP").val(newValor[0]);}
                          else
      {
      var newValor = $("#usuarioP").val().split('´');
     
      $("#usuarioP").val(newValor[0]);
      }
      
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#contrasena_a').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
        
                                  
 $('#contrasena_a').on('keyup', function (e) {
    
      var ultimocaracter = $("#contrasena_a").val();
      var cadena =ultimocaracter.substring($("#contrasena_a").val().length-1);
            if(cadena =="´") {

      $("#contrasena_a").val(ultimocaracter.substring(0,$("#contrasena_a").val().length-1));
            var newValor = $("#contrasena_a").val().split('´');
     
      $("#contrasena_a").val(newValor[0]);}else
      {
      var newValor = $("#contrasena_a").val().split('´');
     
      $("#contrasena_a").val(newValor[0]);
      }
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#contrasena_b').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
        
 $('#contrasena_b').on('keyup', function (e) {
          var ultimocaracter = $("#contrasena_b").val();
      var cadena =ultimocaracter.substring($("#contrasena_b").val().length-1);
            if(cadena =="´") {

      $("#contrasena_b").val(ultimocaracter.substring(0,$("#contrasena_b").val().length-1));
            var newValor = $("#contrasena_b").val().split('´');
     
      $("#contrasena_b").val(newValor[0]);}else
      {
      var newValor = $("#contrasena_b").val().split('´');
     
      $("#contrasena_b").val(newValor[0]);
      }

      var key = e.keyCode || e.which;
      if(key==13)
      $('#PersonaEn').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE ! 

}