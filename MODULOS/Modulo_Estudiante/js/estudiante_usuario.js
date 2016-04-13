$("#nombre_i").val('');
$("#id_instituto").val('');
  cargar_catalogo_institutos();

// CUANDO SE HACE  CLICK PARA MOSTRAR EL MODAL
    // Bloqueam
    $(document).ready(function() {
    $("#mostrar_modal").click(function(){
      $("#tabla_instituciones").modal('show');

    }); 
});

// cargar tabla modal estudiante

function cargar_catalogo_institutos(){

$.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/estudiante_usuario_controlador.php",
                dataType: "html",
                data: {
                  institutos_catalogos:'ofcourse'
                },
                success: function (data) {

                  
                   var html ;
                   var Variable = JSON.parse(data);

                    $.each(Variable, function(index, value){

                      html +="<tr class='institutos' >"+
                      "<td><center>"+value["id_ip"]+"</center></td>"+
                      "<td><center>"+value["siglas"]+"</center></td>"+
                      "<td><center>"+value["nombre_organizacion"]+"</center></td>"+
                      "<td><center>"+value["telefono"]+"</center></td>"+                      
                      "</tr>";
   
                    });
                   
                    armar_tabla_institutos( html);
                  
                }

            });


}

function armar_tabla_institutos ( html)
      {

        $("#TableInstituto").empty();
        $("#TableInstituto").append(html);
        $("#TableInstituto").dataTable().fnDestroy();
        $("#TableInstituto").dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null
          ],

            "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    '',
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
                      
           $("#TableInstituto tbody tr").on('click',function(){

            $("#nombre_ii").html($(this).find('td').eq(1).text());
            $("#id_institutoo").val($(this).find('td').eq(0).text());
            $("#tabla_instituciones").modal('hide');
           });           
      }



// cargar tabla modal estudiante


// filtros del catalogo 
function busqueda_cedula() {
                var tableReg = document.getElementById('Table');
                var searchText = document.getElementById('cedula').value.toLowerCase();
                                for (var i = 1; i < tableReg.rows.length; i++) {
                    var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                    var found = false;
                    for (var j = 0; j < cellsOfRow.length && !found; j++) {
                        var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                        if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                            found = true;
                        }
                    }
                    if (found) {
                        tableReg.rows[i].style.display = '';
                    } else {
                        tableReg.rows[i].style.display = 'none';

                    }
                }
            }
     
            function busqueda_expediente() {
                var tableReg = document.getElementById('Table');
                               var searchText = document.getElementById('expediente').value.toLowerCase();
                for (var i = 1; i < tableReg.rows.length; i++) {
                    var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                    var found = false;
                    for (var j = 0; j < cellsOfRow.length && !found; j++) {
                        var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                        if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                            found = true;
                        }
                    }
                    if (found) {
                        tableReg.rows[i].style.display = '';
                    } else {
                        tableReg.rows[i].style.display = 'none';

                    }
                }
            }
// fin del filtro


function seleccionarfila(tr)
{

  var cedula = "";
                $('tr .cedula').each(function() {
                  
                  cedula  = $(tr).find("td").eq(1).text();
               
                  });

  $("#cedula").val(cedula);


}


// CUANDO SE HACE  CLICK  EN EL BOTON CONSULTAR
    // Bloqueam
    $(document).ready(function() {
    $("#botConsultar").click(function(){
       
               var Campos=ValidarCampos_Estudiante_Consulta();

        if (Campos) {
           ConsultarEstudiante();
        }
      
    
    }); 
});

// CUANDO SE HACE  CLICK  EN EL BOTON REGISTRAR
    // Bloqueam
    $(document).ready(function() {
    $("#botRegistrar").click(function(){

        var Campos=validar_registro_estudiante();

        if (Campos) {
            RegistrarEstudiante();
        }
      
    
    }); 
});


// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {
    $("#botModificar").click(function(){

        var Campos=validar_registro_estudiante();

        if (Campos) {
            ModificarEstudiante();
        }
      
    
    }); 
});




    $(document).ready(function() {
    $("#Cancelar").click(function(){
            
    restablecer_de_nuevo();
          
    }); 
});


// cargar  consulta estudiante

function ConsultarEstudiante(){

  var id_instituto  = document.getElementById("id_institutoo").value;
  var cedula       = document.getElementById("cedula_c").value;
  var expediente   = document.getElementById("expediente_c").value;
      

    var boton  = "consultar_estudiante";

      $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/estudiante_usuario_controlador.php",
        data: {            
            id_instituto         : id_instituto,   
            cedula               : cedula,
            expediente           : expediente,            
            consultar_estudiante    : boton

              },
              
success: function(data){ 
 
 
var arreglo = JSON.parse(data);
 if(arreglo[0]==null){
      restablecer_de_nuevo();

      swal('Error','No se Encontraron Resultados','error');

    }else{
         
        

$("#modal_registro_usuario").modal('show');

 
 $("#id_persona").val(arreglo[0].id_persona);
 $("#expediente").val(arreglo[0].expediente);
 $("#cedula").val(arreglo[0].cedula);
 $("#nombre").val(arreglo[0].nombre);
 $("#apellido").val(arreglo[0].apellido);
 $("#especialidad").val(arreglo[0].nombre_especialidad);
 $("#fecha_solicitud").val(arreglo[0].fecha_solicitud);
 $("#telefono").val(arreglo[0].telefono);
 $("#correo").val(arreglo[0].correo);

 if((arreglo[1].usuario==null)||(arreglo[1].contrasena==null))
 {
           
         $("#botRegistrar").show(); 
         $("#botModificar").hide(); 

 }else if(arreglo[0].fecha_solicitud==null)
 { 
     
         $("#botModificar").hide();
         $("#botRegistrar").show(); 
 }else{
     
         $("#botRegistrar").hide();
         $("#botModificar").show(); 
 }

 
$("#id_usuario").val(arreglo[1].id_usuario);
 $("#usuario").val(arreglo[1].usuario);
 $("#contrasena_a").val(arreglo[1].contrasena);
 $("#contrasena_b").val(arreglo[1].contrasena);
 $("#pregunta").val(arreglo[1].pregunta);
 $("#respuesta").val(arreglo[1].respuesta);



   }

    }    

  });

}

// fin de la consulta de estudiante




//-----REGISTRAR ESTUADIANTE A LA ESPECIALIDAD--->>>

function RegistrarEstudiante(){

    var id_instituto                    = document.getElementById("id_institutoo").value;
    var id_persona                      = document.getElementById("id_persona").value;
    var fecha_solicitud                 = document.getElementById("fecha_solicitud").value;
    var telefono                        = document.getElementById("telefono").value;
    var correo                          = document.getElementById("correo").value;
    var usuario                         = document.getElementById("usuario").value
    var contrasena_b                    = document.getElementById("contrasena_b").value;
    var pregunta                        = document.getElementById("pregunta").value
    var respuesta                       = document.getElementById("respuesta").value;
      
    
    var boton  = "Registrar";

   // alert(id_instituto+"\n"+id_persona+"\n"+fecha_solicitud+"\n"+telefono+"\n"+correo+"\n"+usuario+"\n"+contrasena_b+"\n"+pregunta+"\n"+respuesta);
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/estudiante_usuario_controlador.php",
        data: {

            
            id_instituto           : id_instituto,   
            id_persona             : id_persona,   
            fecha_solicitud        : fecha_solicitud,
            telefono               : telefono,
            correo                 : correo,
            usuario                : usuario,
            contrasena_b           : contrasena_b,
            pregunta               : pregunta,
            respuesta              : respuesta,

            Registrar    : boton

              },
              
success: function(data){ 


    if(data==0){

      restablecer_de_nuevo();
      
      swal('Error','Ocurrió un error de Programación','error');

    }else if(data==1) {
      restablecer_de_nuevo();
      
     swal('Datos Registrados Con Exito','','success');

    }

    }    

  });



}

//-----REGISTRAR ESTUADIANTE A LA ESPECIALIDAD--->>>

function ModificarEstudiante(){

    var id_usuario                      = document.getElementById("id_usuario").value;
    var id_persona                      = document.getElementById("id_persona").value;
  //var fecha_solicitud                 = document.getElementById("fecha_solicitud").value;
    var telefono                        = document.getElementById("telefono").value;
    var correo                          = document.getElementById("correo").value;
    var usuario                         = document.getElementById("usuario").value
    var contrasena_b                    = document.getElementById("contrasena_b").value;
    var pregunta                        = document.getElementById("pregunta").value
    var respuesta                       = document.getElementById("respuesta").value;
           
    var boton  = "Modificar";

   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/estudiante_usuario_controlador.php",
        data: {

            
            id_usuario             : id_usuario,   
            id_persona             : id_persona,   
            //fecha_solicitud        : fecha_solicitud,
            telefono               : telefono,
            correo                 : correo,
            usuario                : usuario,
            contrasena_b           : contrasena_b,
            pregunta               : pregunta,
            respuesta              : respuesta,

            Modificar    : boton

              },
              
success: function(data){ 

    if(data==0){

    restablecer_de_nuevo();
    
    swal('Error','Ocurrió un error de Programación','error'); 

    }else if(data==1) {
      
      restablecer_de_nuevo();
     
    swal('Datos Modificados Con Exito','','success');
   
    }
    
    }    

  });



}

function restablecer_de_nuevo() {
   $("#modal_registro_usuario").modal('hide');
    $("#expediente_c").val('');
    $("#cedula_c").val('');
    $("#id_persona").val('');
    $("#id_usuario").val('');
    $("#expediente").val('');
    $("#cedula").val('');
    $("#nombre").val('');
    $("#apellido").val('');
    $("#fecha_solicitud").val('');
    $("#telefono").val('');
    $("#correo").val('');
    $("#usuario").val('');
    $("#contrasena_a").val('');
    $("#contrasena_b").val('');
}




// pasar el id de la tabla al modal


$('input[name=btnRechazar]').click(function (){
var id_p = $(this).attr("id");
$("#id_personam").val(id_p);
$('#tabla_modal').modal('show');
});
// fin

// filtros del catalogo 
function busqueda_cedula() {
                var tableReg = document.getElementById('Table');
                var searchText = document.getElementById('cedula').value.toLowerCase();
                                for (var i = 1; i < tableReg.rows.length; i++) {
                    var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                    var found = false;
                    for (var j = 0; j < cellsOfRow.length && !found; j++) {
                        var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                        if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                            found = true;
                        }
                    }
                    if (found) {
                        tableReg.rows[i].style.display = '';
                    } else {
                        tableReg.rows[i].style.display = 'none';

                    }
                }
            }
     
            function busqueda_expediente() {
                var tableReg = document.getElementById('Table');
                               var searchText = document.getElementById('expediente').value.toLowerCase();
                for (var i = 1; i < tableReg.rows.length; i++) {
                    var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                    var found = false;
                    for (var j = 0; j < cellsOfRow.length && !found; j++) {
                        var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                        if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                            found = true;
                        }
                    }
                    if (found) {
                        tableReg.rows[i].style.display = '';
                    } else {
                        tableReg.rows[i].style.display = 'none';

                    }
                }
            }
// fin del filtro


function seleccionarfila(tr)
{

	var cedula = "";
                $('tr .cedula').each(function() {
                  
                  cedula  = $(tr).find("td").eq(1).text();
               
                  });

	$("#cedula_c").val(cedula);


}

function seleccionarfilaPersona(tr)
{
     var id ="";
    var expediente ="";
    var cedula ="";
    var nombre = ""; 
    var apellido ="";
    //var fecha ="";
    var observacion ="";
    var especialidad ="";
                $('tr .cedula').each(function() {
                  id  = $(tr).find("td").eq(0).text();
                  expediente  = $(tr).find("td").eq(1).text();
                  cedula  = $(tr).find("td").eq(2).text();
                  nombre  = $(tr).find("td").eq(3).text();
                  apellido  = $(tr).find("td").eq(4).text();
                  especialidad  = $(tr).find("td").eq(5).text();
                  observacion  = $(tr).find("td").eq(8).text();
                 // fecha  = $(tr).find("td").eq(9).text();


                  });

                if(expediente=="-----")
                    {

    
 $("#id_persona").val(id);
 $("#expediente").val('');
 $("#cedula").val(cedula);
 $("#nombre_e").val(nombre);
 $("#apellido_e").val(apellido);
 $("#observacion").val('');
    $("#id_especialidad option[value="+ +"]").attr("selected",true);
        
  
  $("#Registrar").attr("disabled",false);
  $("#Modificar").attr("disabled",true);
  $("#Eliminar").attr("disabled",true);
  $("#Cancelar").attr("disabled",false);
}else{

$("#id_persona").val(id);
    $("#expediente").val(expediente);
    $("#cedula").val(cedula);
    $("#nombre_e").val(nombre);
    $("#apellido_e").val(apellido);
  
    $("#observacion").val(observacion);
    $("#id_especialidad option[value="+especialidad+"]").attr("selected",true);
         
       
        $("#Registrar").attr("disabled",true);
        $("#Modificar").attr("disabled",false);
        $("#Eliminar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);

}
}

function seleccionarfila2(tr)
{

	var nombre = "";
	var id = "";
                $('tr .nombre').each(function() {
                  
                  id  = $(tr).find("td").eq(0).text();
                  nombre  = $(tr).find("td").eq(2).text();
               
                  });

	$("#nombre_ii").val(nombre);
	$("#id_institutoo").val(id);
	$("#tabla_modal").modal('hide');

}



 // validaciones

// validacion del formulario consultar para registrar
function ValidarCampos_Estudiante_Consulta() {
        //obteniendo el valor que se puso en el campo text del formulario
        id_institutoo = document.getElementById("id_institutoo").value
        cedula = document.getElementById("cedula_c").value;
        expediente = document.getElementById("expediente_c").value;
        //la condición
         if(id_institutoo.length <1 || /^\s+$/.test(id_institutoo)){
            $("#mostrar_modal").focus();
             
         MensajeDatosNoSeleccionoUnInstituto();
         
         return false;
          
       }else if((cedula.length >0 || /^\s+$/.test(cedula)) && (expediente.length >0 || /^\s+$/.test(expediente))) {
            $("#cedula").focus();
             $("#expediente").focus(); 
         MensajeDatosNone();
         
         return false;
          
       }else if((cedula.length <1 || /^\s+$/.test(cedula)) && (expediente.length <1 || /^\s+$/.test(expediente))) {
          $("#cedula").focus();  
         MensajeDatosNoneVacios();
         
         return false;
          
       }else

       if(expediente.length <1){
        if(cedula.length <6 || /^\s+$/.test(cedula)) {
         $("#cedula").focus();
         MensajeDatosNoneMinimoCedula();
         
         return false;   
        }
    }else{
        if(expediente.length <5 || /^\s+$/.test(expediente)) {
          $("#expediente").focus();
         MensajeDatosNoneMinimoExpediente();
         
         return false;   
        }
    }
return true;
}


 function a(){
    miCampoTexto4 = document.getElementById("telefono").value;
    miCampoTexto5 = document.getElementById("correo").value;
 if(miCampoTexto4.length <1 || /^\s+$/.test(miCampoTexto4)) {
            $("#telefono").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else
        if(miCampoTexto4.length <11 || /^\s+$/.test(miCampoTexto4)) {
            $("#telefono").focus();
         MensajeDatosNonetelefono();
         
         return false;   
        }else
         if(miCampoTexto5.length <1 || /^\s+$/.test(miCampoTexto5)) {
            $("#correo").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }
    return false;
 }
function validar_registro_estudiante() {
        //obteniendo el valor que se puso en el campo text del formulario
         miCampoTexto4 = document.getElementById("telefono").value;
        miCampoTexto5 = document.getElementById("correo").value;
        miCampoTexto1 = document.getElementById("usuario").value;
        miCampoTexto2 = document.getElementById("contrasena_a").value;
        miCampoTexto3 = document.getElementById("contrasena_b").value;
       
       

        if(miCampoTexto4.length <1 || /^\s+$/.test(miCampoTexto4)) {
            $("#telefono").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else
        if(miCampoTexto4.length <11 || /^\s+$/.test(miCampoTexto4)) {
            $("#telefono").focus();
         MensajeDatosNonetelefono();
         
         return false;   
        }else
         if(miCampoTexto5.length <1 || /^\s+$/.test(miCampoTexto5)) {
            $("#correo").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else
        if(miCampoTexto1.length <1 || /^\s+$/.test(miCampoTexto1)) {
            $("#usuario").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else 
        if(miCampoTexto1.length <6 || /^\s+$/.test(miCampoTexto1)) {
         $("#usuario").focus();
         MensajeDatosNoneMinimo();
         
         return false;   
        }else
        if(miCampoTexto2.length <1 || /^\s+$/.test(miCampoTexto3)) {
             $("#contrasena_a").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else
         if(miCampoTexto2.length <6 || /^\s+$/.test(miCampoTexto2)) {
            $("#contrasena_a").focus();
         MensajeDatosNoneMinimo();
         
         return false;   
        }else 
        if(miCampoTexto3.length <1 || /^\s+$/.test(miCampoTexto3)) {
            $("#contrasena_b").focus();
          MensajeDatosNoneVacios();
         
         return false;   
        }else
         if(miCampoTexto2 != miCampoTexto3) {
            $("#contrasena_b").focus();
         MensajeDatosNoneContrasena();
         
         return false;   
        }
    
return true;
}

//FIN validacion del formulario consultar para registrar

// Solo acepta números
function numeros(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron = /\d/; // Solo acepta números
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
// Solo acepta letras
function letras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-zñÑ´\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
// no acepta alfanumericos
function alfanumericos(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/\w/;  // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}





//fin validacion del formulario del beneficiario

function MensajeDatosNoneContrasena(){
$.amaran({
    content:{
      
        bgcolor:'#0066CC',

        color:'#fff',

        message:'Las Contraseñas No Coinciden'

       },
    theme:'colorful',

    position:'bottom right',
    
    cssanimationIn: 'swing',

    cssanimationOut: 'bounceOut',

    clearAll :true
 
});

}



function MensajeDatosNoneVacios()
{

$.amaran({
    content:{
      
        bgcolor:'#0066CC',

        color:'#fff',

        message:'Campos Vacíos'

       },
    theme:'colorful',

    position:'bottom right',
    
    cssanimationIn: 'swing',

    cssanimationOut: 'bounceOut',

    clearAll :true
 
});
}

function MensajeDatosNone()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'la consulta es por cedula o expediente'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}
function MensajeDatosNoneMinimoExpediente()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 5'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}
function MensajeDatosNoneMinimoCedula()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 6'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}


function MensajeDatosNoSeleccionoUnInstituto()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'No Seleciono Un Instituto'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNoneMinimo()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 6'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNonetelefono()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 11'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut',
    clearAll :true
 
});
}



 //fin de validaciones


      //////////--------La tecla enter---->>>

           
            $('#expediente').on('keyup', function (e) {
            	
                var key = e.keyCode || e.which;
                if(key==13)
                $('#cedula').focus();
             });

             $('#cedula').on('keyup', function (e) {
                var key = e.keyCode || e.which;
                if(key==13)
                $('#nombre_e').focus();
             });
              $('#nombre_e').on('keyup', function (e) {
                var key = e.keyCode || e.which;
                if(key==13)
                $('#apellido_e').focus();
             });
                 $('#apellido_e').on('keyup', function (e) {
                var key = e.keyCode || e.which;
                if(key==13)
                $('#observacion').focus();
             });
                $('#observacion').on('keyup', function (e) {
                var key = e.keyCode || e.which;
                if(key==13)
                $('#id_especialidad').focus();
             });


            //////////--------La tecla enter---->>>


// Solo acepta números
function numeros(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron = /\d/; // Solo acepta números
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
// Solo acepta letras
function letras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-zñÑ´\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
// no acepta alfanumericos
function alfanumericos(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/\w/;  // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}



