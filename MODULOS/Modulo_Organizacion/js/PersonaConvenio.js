

//ASIGNANDO  EVENTOS  DESDE  JQUERY ...
$("#usuarioP").keyup(ConsultaUsuarios);

    $("#PersonaEn").click(function(){

         var veri = ValidarCampos();
       
            if(veri){
          
          	 RegistrarPersonaContacto();
             

             restablecer();
             }
            
    }); 


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
          
          data    : {
        	
          usuario 	: usuariod,
        	
            Busquedausuario : 'usuario'
              },              
    
success: function(data){
   
  var variable = JSON.parse(data);

     if(variable.result==1)
     {
              
        $("#usuario").html('<img src="../../../img/Ico-master/PNG/64px/0272-cross.png"  width=20>'+" Usuario ya Existe");
        MensajeNoUsuario();
     }else{         
        $("#usuario").html(null);
        $("#usuario").empty();
        //$("#usuario").detach();
     }

    }
    });
    
    
    }

function ValidarCampos()
{
			// Obtengo las  values de los  campos del formulario de la persona encargada
      
var Instituto =  $("#codigosucursal").html();
var Cedula    =  $("#cedulaPE").val();
var nombre    =  $("#nombrePE").val();
var apellido  =  $("#apellidoPE").val();
var telefono  =  $("#telefonoPE").val();
var correo    =  $("#correoPE").val();
var usuario   =  $("#usuarioP").val();
var pass_a    =  $ ("#contrasena_a").val();
var pass_b    =  $("#contrasena_b").val();

     if(Instituto=="")
     {  
      MensajeSeleccioneinstituto();

      
      
      return false;
     }
     else if( $("#Nacionalidad").val() == '')
     {
      $("#Nacionalidad").focus();
      MensajeCamposVacios('Seleccione una institucion');
      return false;
     }
      else    if(Cedula.length<7)
     {
      $("#cedulaPE").focus();
      MensajeCamposVacios('Las cédula debe ser mayor a 6 dígitos');
      return false;
     }else  if(nombre.length<3)
     {
      $("#nombrePE").focus();
      MensajeCamposVacios('El nombre debe tener mínimo 3 caracteres');
      return false;
     }else  if(apellido.length<3)
     {
      $("#apellidoPE").focus();
      MensajeCamposVacios('El apellido debe tener mínimo 3 caracteres');
      return false;
     }else  if(telefono.length<11)
     {
      $("#telefonoPE").focus();
      MensajeCamposVacios('El Teléfono debe tener mínimo 11 caracteres');
      return false;
     }else  if(correo.length<9)
     {
      $("#correoPE").focus();
      MensajeCamposVacios('El correo debe tener mínimo 8 caracteres');
      return false;
     }else if(usuario.length<6 )
     {
      $("#usuarioP").focus();

      MensajeCamposVacios('El usuario debe tener mínimo 6 caracteres');
      return false;
     }else if($("#usuario").html() !="")
     {  
        MensajeNoUsuario();
        $("#usuarioP").focus();
        return false;
     } 
     else if(pass_a.length<6)
     {
      $("#contrasena_a").focus();
      MensajeCamposVacios('La Contraseña debe tener mínimo 6 caracteres ');
      return false;
     }else if(pass_b.length<6)
     {
      
      $("#contrasena_b").focus();
      MensajeCamposVacios('La Contraseña debe tener mínimo 6 caracteres ');
      return false;
     }else if($('#contrasena_b').val() != $('#contrasena_a').val())
      {
        $('#contrasena_b').focus();
        MensajeContrasenanoverificada();
        return false;
      }else
      if($("#pregunta").val()=='' || $("#pregunta").val().length==0){
        $("#pregunta").focus();
        MensajeCamposVacios('Esta Pregunta no es Válida');
        return false;
      }else 

    if($("#respuesta").val().length<6)
    {
        $("#respuesta").focus();
        MensajeCamposVacios('La Respuesta debe tener mínimo 6 caracteres ');
        return false;
    }
     else
    {
    	return true;
    }

}



function RegistrarPersonaContacto(){
    
var Instituto = $("#codigosucursal").html();
var Cedula 	  = $("#cedulaPE").val();
var nombre 	  = $("#nombrePE").val();
var apellido  = $("#apellidoPE").val();
var telefono  = $("#telefonoPE").val();
var correo    = $("#correoPE").val();
var usuario   = $("#usuarioP").val();
var pass_b    = $("#contrasena_b").val();
var porid4    = "registra";
    
    $.ajax({
          async   : true, 
          cache   : false,
          dataType: "html", 
          type    : 'POST',   
          url     : "../controlador/recibeInstitutoFormulario.php",
          data    : 
          {
                idOrganizacionConvenio : Instituto,
                cedula                 : Cedula,
                nombre                 : nombre,
                apellido               : apellido,
                telefono               : telefono,
                correo                 : correo,
                usuario                : usuario,
                contrasena             : pass_b,
                pregunta               : $("#pregunta").val(),
                respuesta              : $("#respuesta").val(),
                descripcion            :$("#Dedica").val(),
                registraPersonaContacto: porid4
          },              
    
success: function(data){  
  
 
  var variable = JSON.parse(data);
  
     if(variable.PERSONA.result ==  1){
             swal({   title:'Bien' , text:"Persona Asignada",  type: "success" });

     }else { swal({   title: 'Upss', text:"Error De Programación", type: "error" }); }

    }
    });
    
}

function restablecer()
{
 $("#codigosucursal").html("");
 $("#cedulaPE").val("");
 $("#nombrePE").val("");
 $("#apellidoPE").val("");
 $("#telefonoPE").val("");
 $("#correoPE").val("");
 $("#usuarioP").val("");
 $("#contrasena_b").val("");
 $("#contrasena_a").val("");
 $("#titlee_pepple").html("");
 $("#Dedica").val("");
 $("#pregunta").val("");
 $("#respuesta").val("");
}




function MensajeCamposVacios(texto)
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :texto
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'swing',
        cssanimationOut: 'bounceOut',
        'clearAll'     :true
        
});
}

function MensajeSeleccioneinstituto()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Seleccione Su Organización'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
 
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
                   position       :'top right',
                   'clearAll'     :true
                });

}


function MensajeContrasenanoverificada()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'verifique su contraseña'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
        
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


                 //$('#cedulaPE').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou');
                $('#nombrePE').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou. ');
                $('#apellidoPE').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou. ');
                $('#correoPE').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou0123456789_-@.');
                $('#usuarioP').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou');
                $('#Dedica').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou0123456789.-, ');


                //Para escribir solo numeros    
                $('#cedulaPE').validCampoFranz('0123456789');
                $('#telefonoPE').validCampoFranz('0123456789'); 

$('#cedulaPE').on('keyup', function (e) {
    
      var ultimocaracter = $("#cedulaPE").val();

      var cadena =ultimocaracter.substring($("#cedulaPE").val().length-1);
      var newValor = $("#cedulaPE").val().split('´');
     
      $("#cedulaPE").val(newValor[0]);
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#nombrePE').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
 $('#nombrePE').on('keyup', function (e) {
    
      var newValor = $("#nombrePE").val().split('´');
     
      $("#nombrePE").val(newValor[0]);
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#apellidoPE').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
 $('#apellidoPE').on('keyup', function (e) {
    
      var newValor = $("#apellidoPE").val().split('´');
     
      $("#apellidoPE").val(newValor[0]);
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#Dedica').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  

 $("#Dedica").on('keyup',function(e){
      var newValor = $("#Dedica").val().split('´');
     
      $("#Dedica").val(newValor[0]);
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#telefonoPE').focus();
 });
 $('#telefonoPE').on('keyup', function (e) {
    
      var newValor = $("#telefonoPE").val().split('´');
     
      $("#telefonoPE").val(newValor[0]);
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#correoPE').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
 $('#correoPE').on('keyup', function (e) {
    

      var newValor = $("#correoPE").val().split('--');
     
      $("#correoPE").val(newValor[0]);
      var newValor = $("#correoPE").val().split('..');
     
      $("#correoPE").val(newValor[0]);
      var newValor = $("#correoPE").val().split('´');
     
      $("#correoPE").val(newValor[0]);


      var newValor = $("#correoPE").val().split('__');
     
      $("#correoPE").val(newValor[0]);

      var newValor = $("#correoPE").val().split('@@');
     
      $("#correoPE").val(newValor[0]);


      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#usuarioP').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
                                  
 $('#usuarioP').on('keyup', function (e) {
    
      var newValor = $("#usuarioP").val().split('´');
     
      $("#usuarioP").val(newValor[0]);
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#contrasena_a').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
        
                                  
 $('#contrasena_a').on('keyup', function (e) {
    
      var newValor = $("#contrasena_a").val().split('´');
     
      $("#contrasena_a").val(newValor[0]);
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#contrasena_b').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
        
 $('#contrasena_b').on('keyup', function (e) {
    
      var newValor = $("#contrasena_b").val().split('´');
     
      $("#contrasena_b").val(newValor[0]);
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#PersonaEn').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
        


        function BuscarCedulasRegistradas()
        {

        $.ajax({
                
                async   :true, 
                
                cache   :false,
                
                dataType: "html", 
                
                type    : 'POST',   
                
                url     : "../controlador/recibeInstitutoFormulario.php",
                
                data    : {
          
                  BuscarPersonasRegistradas :'OfCourse'
              },              
    
              success: function(data){  
         
          var variable = JSON.parse(data);

            personas = toObject(variable);
            
                    $('#cedulaPE').typeahead({

                      minLength: 1,
                      maxItem: 5,
                      order: "asc",
                      //hint: true,
                      
                      source: { 
                         data :personas.cedulas
                      }
                        ,

    callback: {
       onClick: function (node, a, obj, e) {
   
                      cedulaSeleccionada($(a).find('.typeahead-display').text());

        },
        onMouseEnter: function (node, a, item, event) {

             
                if (!$(a).find('.popover')[0]) {
                  nombreApellidoCedula (a , $(a).find('.typeahead-display').text()); 
                         } else {
                $(a).find('.popover').removeClass('out').addClass('in');
                //$(a).popover('show');
            }
            
        },
        onMouseLeave: function (node, a, item, event) {
 
            $(a).find('.popover').removeClass('in').addClass('out');
        }
    },debug: false
                      });

            }
        });
        }

function toObject(json) {

  var Arreglote = {};

  var arregloPivote = Array();

  $.each(json , function(index , values){

    arregloPivote[index] = values.cedula;

  });

  Arreglote['cedulas'] =arregloPivote;

  return Arreglote;
}




function nombreApellidoCedula (a , cedula)
{
$.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType: "html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : 
        {
          BuscarDatospersona :cedula
        },              
    
        success: function(data){  
          

          var persona = JSON.parse(data);

                
                $(a).append(

                    $('<div/>', {
                        
                        "class":"popover fade right in",
                        "role":"tooltip" ,                        
                        "style":"top: -18.6023px; left: 217.753px; display: block;",
                        "html": 
                        "<h3 class='popover-title' ><span class='label label-default'>Nombre - Apelliodo</span></h3>"+
                        "<div class='popover-content'><span class='label label-primary'>"+persona.datos+"</span></div>"
                        
                    }).prepend($('<div/>', {
                            "class": "arrow",
                            "style":"right: 50%;"
                        }))
                );
              

        }
      });

}

function cedulaSeleccionada(cedula)
{
    $.ajax({
            
            async   :true, 
            
            cache   :false,
            
            dataType: "html", 
            
            type    : 'POST',   
            
            url     : "../controlador/recibeInstitutoFormulario.php",
            
            data    : 
            {
              BuscarTodosDatosCedulaSeleccionada :cedula
            },              
    
        success: function(data){  
            var Variable = JSON.parse(data);
           
            if(Variable.caso=='1'){ 

              $("#nombrePE").val(Variable.nombre);

              $("#apellidoPE").val(Variable.apellido);

              $("#correoPE").val(Variable.correo);

              $("#telefonoPE").val(Variable.telefono);

              $("#usuarioP").val(Variable.usuario);

              $("#contrasena_a").val(Variable.contrasena);

              $("#contrasena_b").val(Variable.contrasena);

            } else if(Variable.caso=='2')
            {
              $("#nombrePE").val(Variable.nombre);

              $("#apellidoPE").val(Variable.apellido);

              $("#correoPE").val(Variable.correo);

              $("#telefonoPE").val(Variable.telefono);
            }
        } // success
    });

   

}

$("#LimpiarCampos").click(function(){
    $("#cedulaPE").val('');
    
    $("#nombrePE").val('');

    $("#apellidoPE").val('');

    $("#correoPE").val('');

    $("#telefonoPE").val('');

    $("#usuarioP").val('');

    $("#contrasena_a").val('');

    $("#contrasena_b").val('');
      
    $("#respuesta").val('');

    $("#pregunta").val('');
    
    $("#Dedica").val('');

    $("#pregunta").data("selectBoxIt").refresh();
    
    Renderidng_select();
});

