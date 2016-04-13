
$("#nombre_i").val('');
$("#id_instituto").val('');
// CUANDO SE HACE  CLICK  EN EL BOTON REGISTRAR
    // Bloqueam
    $(document).ready(function() {
    $("#Registrar").click(function(){

        var Campos=ValidarCampos_Estudiante();

        if (Campos) {
            RegistrarEstudiante();
        }
      
    
    }); 
});


// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {
    $("#Modificar").click(function(){

        var Campos=ValidarCampos_Estudiante();

        if (Campos) {
            ModificarEstudiante();
        }
      
    
    }); 
});




    $(document).ready(function() {
    $("#Cancelar").click(function(){

    $("#id_persona").val('');
    $("#expediente").val('');
    $("#cedula").val('');
    $("#nombre_e").val('');
    $("#apellido_e").val('');
    $("#fecha").val('');
    $("#observacion").val('');
    $("#id_especialidad").val('');
   

  
        $("#Registrar").attr("disabled",false);
        $("#Modificar").attr("disabled",true);
        $("#Eliminar").attr("disabled",true);
        $("#Cancelar").attr("disabled",false);    
    
    }); 
});







//-----REGISTRAR ESTUADIANTE A LA ESPECIALIDAD--->>>

function RegistrarEstudiante(){

    
    var id_instituto_asignar                = document.getElementById("id_instituto_asignar").value;
    var id_persona                          = document.getElementById("id_persona").value;
    var expediente                          = document.getElementById("expediente").value;
    var cedula                              = document.getElementById("cedula").value;
    var nombre_e                            = document.getElementById("nombre_e").value;
    var apellido_e                          = document.getElementById("apellido_e").value;
  //  var fecha                               = document.getElementById("fecha").value;
    var observacion                         = document.getElementById("observacion").value
    var id_especialidad                     = document.getElementById("id_especialidad").value;
      
      alert(id_persona);
    var boton  = "Registrar";

    //alert(id_especialidad_asignar+id_instituto_asignar+expediente+cedula+nombre_e+apellido_e+fecha+observacion);
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/estudiante_controlador.php",
        data: {

            
            id_instituto           : id_instituto_asignar,   
            id_persona           : id_persona,   
            expediente_e           : expediente,
            cedula_e               : cedula,
            nombre_e               : nombre_e,
            apellido_e             : apellido_e,
          //  fecha                  : fecha,
            observacion            : observacion,
            id_especialidad        : id_especialidad,

            Registrar    : boton

              },
              
success: function(data){ 

alert(data);

    if(data==0){
      document.location.reload();
    alert("Error en Registro");
    //$( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }else if(data==1) {
       document.location.reload();
    alert("Registro Exitoso");          
    //$( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }

    }    

  });



}

//-----REGISTRAR ESTUADIANTE A LA ESPECIALIDAD--->>>

function ModificarEstudiante(){

    
    var id_instituto_asignar                = document.getElementById("id_instituto_asignar").value;
    var id_persona                          = document.getElementById("id_persona").value;
    var expediente                          = document.getElementById("expediente").value;
    var cedula                              = document.getElementById("cedula").value;
    var nombre_e                            = document.getElementById("nombre_e").value;
    var apellido_e                          = document.getElementById("apellido_e").value;
    //var fecha                               = document.getElementById("fecha").value;
    var observacion                         = document.getElementById("observacion").value
    var id_especialidad                     = document.getElementById("id_especialidad").value;
     
    var boton  = "Modificar";

    //alert(id_especialidad_asignar+id_instituto_asignar+expediente+cedula+nombre_e+apellido_e+fecha+observacion);
   alert(cedula);
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/estudiante_controlador.php",
        data: {

            
            id_instituto           : id_instituto_asignar,
            id_persona           : id_persona,      
            expediente_e           : expediente,
            cedula_e               : cedula,
            nombre_e               : nombre_e,
            apellido_e             : apellido_e,
           // fecha                  : fecha,
            observacion            : observacion,
            id_especialidad        : id_especialidad,

            Modificar    : boton

              },
              
success: function(data){ 

alert(data);

    if(data==0){
      document.location.reload();
    alert("Error en Registro");
    //$( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }else if(data==1) {
       document.location.reload();
    alert("Registro Exitoso");          
    //$( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }

    }    

  });



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

	$("#cedula").val(cedula);


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
                  expediente  = $(tr).find("td").eq(2).text();
                  cedula  = $(tr).find("td").eq(3).text();
                  nombre  = $(tr).find("td").eq(4).text();
                  apellido  = $(tr).find("td").eq(5).text();
                  especialidad  = $(tr).find("td").eq(6).text();
                  observacion  = $(tr).find("td").eq(9).text();
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
 
    if(especialidad=="-----"){
      $("#id_especialidad").val('');
     }else{
    $("#id_especialidad option[value="+especialidad+"]").attr("selected",true);
       }  
        
  
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



///////////////////-------M E N S A J E S--------------->>>>
function MensajeDatosNone()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Campos Vacios'
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
function MensajeDatosNoneMinimoNombreApellido()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 2'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

//<<<<<<<<------------------F I N MESNAJES--////////


      function ValidarCampos_Estudiante()
    {

        var expediente = document.getElementById("expediente").value
        var cedula = document.getElementById("cedula").value
        var nombre_e = document.getElementById("nombre_e").value;
        var apellido_e  = document.getElementById("apellido_e").value;
        //var fecha = document.getElementById("fecha").value
        var observacion_p = document.getElementById("observacion").value;
        var id_especialidad = document.getElementById("id_especialidad").value;
        
 
    if((expediente=="")||(cedula=="")||(nombre_e=="")||(apellido_e=="")||(observacion_p=="")||(id_especialidad==""))
      { 
            

            if(expediente==""){
                MensajeDatosNone();
              $("#expediente").focus();
            }else 
            if(expediente.length <5){
                $("#expediente").focus();
                MensajeDatosNoneMinimoExpediente();                
            }else
            if(cedula==""){
                MensajeDatosNone();
              $("#cedula").focus();
            }else
             if(cedula.length <6){
                $("#cedula").focus();
                MensajeDatosNoneMinimoCedula();
            }else 
            if(nombre_e==""){
                MensajeDatosNone();
              $("#nombre_e").focus();
            }else
            if(nombre_e.length <3){
                $("#nombre_e").focus();
                MensajeDatosNoneMinimoNombreApellido();
            }else
            if(apellido_e==""){
                MensajeDatosNone();
              $("#apellido_e").focus();
            }else 
            if(apellido_e.length <3){
                $("#apellido_e").focus();
                MensajeDatosNoneMinimoNombreApellido();
            }else
              if(observacion_p==""){
                MensajeDatosNone();
              $("#observacion").focus();
            }else
            if(observacion_p.length <3){
                $("#observacion").focus();
                MensajeDatosNoneMinimoNombreApellido();
            }else
            if(id_especialidad==""){
                MensajeDatosNone();
              $("#id_especialidad").focus();
            }
            
        
            return false;

      }else {

                return true;
        }
        

      }

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




