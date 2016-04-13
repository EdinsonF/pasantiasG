

//-----RECARGAR BODY--->>>
function restablecerForm()
{
       
        $("#id_oficina").val("");
        $("#cedula").val("");
        $("#nombre").val("");
        $("#apellido").val("");
        $("#observacion").val("");
        $("#perfil").val("");
        $("#oficina").val("");
        $("#fecha").val("");

        $("#cedula").attr("disabled", false);
        $("#fecha").attr("disabled", false);

        $("#RegistrarPersona").attr("disabled", false);
        $("#ModificarPersona").attr("disabled", true);

        
        showselect_PersonasAsignadas_OFICINAS('');       
}


$("#Reporte").on('click',function()
  {
        window.open('../controlador/TutorEmpresarial.php?Reporte=MisAsignaciones');
  });

// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {
    $("#ModificarPersona").click(function(){

        var verificar=ValidarCampos();
        if(verificar){
            ModificarPersona();
       }
        
    }); 
});



//---CUANDO SE HACE CLIC EN EL BOTON DE CANCELAR--->>>
    $(document).ready(function() {
    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 
});


  // CUANDO SE HACE  CLICK  EN EL BOTON REGISTRAR
    // Bloqueam
    $(document).ready(function() {
    $("#RegistrarPersona").click(function(){

        var verificar=ValidarCampos();
        if(verificar){
            Registrar_Persona();
        }
      

        
    }); 
});








showselect_PersonasAsignadas_OFICINAS('');
//-------RECARGAR TABLA OFICINA  PERSONAS ASIGNADAS--->>>>
function showselect_PersonasAsignadas_OFICINAS(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../../Modulo_Departamento/controlador/Gestion_Oficina_Controller.php",
                dataType: "html",
                data: {
                  id_organizacion:$("#id_organizacion").val(),
                  Tabla_PersonasAsignadas:'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";
                    var contador=0;
                    var perfil;
                    $.each(Variable, function(index, value){

                                if(Variable[index].id_perfil==6){
                                        perfil='ENCARGADO';
                                  }else if(Variable[index].id_perfil==2){
                                        perfil='CONTACTO';
                                  }else if(Variable[index].id_perfil==5){
                                        perfil='TUTOR EMPRESARIAL';
                                  }
                    html +="<tr class='modificar' style='cursor:pointer' onclick='seleccionarfila_ParaModificar(this)'>"+
                    " <td hidden><center>"+Variable[index].id_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].cedula+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre+"</center></td>"+
                    " <td ><center>"+Variable[index].apellido+"</center></td>"+
                    " <td ><center>"+Variable[index].fecha_aceptacion+"</center></td>"+
                    " <td ><center>"+Variable[index].observacion+"</center></td>"+
                    " <td><center><img src=../../../img/iconos/edit.png alt=Ginger class=left width=20 ></center></td>"+
                    " </tr>" ;
                    contador++;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaPersonasAsignadas(html);
                    
                }

            });

      }
        

      function ArmarTablaPersonasAsignadas (html)
      {


        $("#myTable ").empty();
        $("#myTable ").append(html);
        $('#myTable ').dataTable().fnDestroy();
        $('#myTable ').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null,null, null, null
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
        },
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5,
        'order': [1, 'asc']
        }); 
                     
      }
//----FIN DE RECARGAR TABLA  PERSONAS ASIGNADAS--->>



//  SELECCIONAR FILA DELA TABLA PARA ASIGNAR

function seleccionarfila_ParaModificar(tr){
   
    
                var id_organizacion= $('#id_organizacion').val();
                var id_oficina="";

                var cedula ='';
                var nombre ='';
                var apellido ='';
                var fecha ='';
                var observacion ='';

                 $("#cedula").attr("disabled", true);
                 $("#fecha").attr("disabled", true);

       
                //var id_estado = $(".id_estado",tr).val();
                $(tr ).each(function() {
                  
                  id_oficina   = $(this).find("td").eq(0).text();
                  cedula       = $(this).find("td").eq(2).text();
                  nombre       = $(this).find("td").eq(3).text();
                  apellido     = $(this).find("td").eq(4).text();
                  fecha     = $(this).find("td").eq(5).text();
                  observacion     = $(this).find("td").eq(6).text();

                  
                  });

                    $("#id_oficina").val(id_oficina);
                    $("#cedula").val(cedula);
                    $("#nombre").val(nombre);
                    $("#apellido").val(apellido);
                    $("#fecha").val(fecha);
                    $("#observacion").val(observacion);

                    $("#oficina option[value="+ id_oficina +"]").attr("selected",true);
                    
                    $("#RegistrarPersona").attr("disabled", true);
                    $("#ModificarPersona").attr("disabled", false);

                
                

} 




//-----ASIGNAR PERSONA A LA PERSONAS OFICINA--->>>

function Registrar_Persona(){

    var id_organizacion                     = $('#id_organizacion').val();
    var cedula                              = $('#cedula').val();
    var nombre                              = $('#nombre').val();
    var apellido                            = $('#apellido').val();
    var fecha                               = $('#fecha').val();
    var observacion                         = $('#observacion').val();
    var oficina_select                      = $('#oficina').val();
    //alert(id_organizacion+"-"+cedula+"-"+nombre+"-"+apellido+"-"+fecha+"-"+observacion+"-"+oficina_select);
    
     
    var boton  = "Asignar_Estudiante";

    //alert(id_especialidad_asignar+id_instituto_asignar+expediente+cedula+nombre_e+apellido_e+fecha+observacion);
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/TutorEmpresarial.php",
        data: {


            id_organizacion        : id_organizacion,      
            cedula                 : cedula,
            nombre                 : nombre,
            apellido               : apellido,
            fecha                  : fecha,
            observacion            : observacion,
            oficina_select         : oficina_select,

            Registrar    : boton

              },
              
success: function(data){ 

//alert(data);

    if(data==0){
      
    swal("A Ocurrido Un Error Al Registrar", "", "error"); 

    }else if(data==1) {
        
    swal("Asignación Exitosa!",'', "success"); 

    }else if(data==2) {
        
    swal("Asignación Exitosa!",'', "success"); 

    }else if(data==3) {
        
    swal("Esta Persona Ya Está Asignada A Esta Oficina!"); 

    }
    restablecerForm();
    
    }
    });



} 



    ////////////////////////

function ModificarPersona(){
    
    var id_oficina                          = $('#id_oficina').val();
    var id_organizacion                     = $('#id_organizacion').val();
    var cedula                              = $('#cedula').val();
    var nombre                              = $('#nombre').val();
    var apellido                            = $('#apellido').val();
    var fecha                               = $('#fecha').val();
    var observacion                         = $('#observacion').val();
    var oficina_select                      = $('#oficina').val();
    //alert(id_oficina+"-"+id_organizacion+"-"+cedula+"-"+nombre+"-"+apellido+"-"+fecha+"-"+observacion+"-"+oficina_select);

    var boton  = "actualiza";
   

   $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/TutorEmpresarial.php",
        data: {


            id_oficina             : id_oficina,
            id_organizacion        : id_organizacion,      
            cedula                 : cedula,
            nombre                 : nombre,
            apellido               : apellido,
            fecha                  : fecha,
            observacion            : observacion,
            oficina_select         : oficina_select,

            Modificar           : boton

              },
              
success: function(data){ 
  var result = $.trim(data);

  alert(data);

    if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error");
    restablecerForm();

    }else if(data==1) {
        
    swal("Modificación Exitosa!",'', "success");
    restablecerForm();

    }else if(data==3) {
        
    swal("Esta Persona Ya Está Asignada A Esta Oficina!");
    restablecerForm();

    }else if(data==4) {
        
    swal("Usted No Modificó Ningún Campo!");
    restablecerForm();

    }else if(data==5) {
            //----HAGO UNA NUEVA ASIGNACION, REGISTRO SOLO EN LA INTERMEDIA---->
                        swal({   
                             title: "Atenciòn",   
                             text:  "Ud. Modificó El Nombre De La Oficina... Debe Tener Encuenta Que Existen Personas "+
                                    "Asignadas A Dicha Oficina. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
                                    "Deseado Y Las Personas De La Anterior Oficina Pasaran A La Nueva Modificacion, Es Decir Cambiaran El "+
                                    "Nombre De La Oficina De La Cual Son Encargados. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.",
                             
                             type: "warning", 
                             showCancelButton: true, 
                             confirmButtonColor: "#DD6B55",
                             confirmButtonText: "Sì, Modificar!", 
                             closeOnConfirm: false 
                         }, 
                             function(){  
                             
                                alert("usted dio aceptar, REALIZO NUEVO REGISTRO Intermedia");
                                RegistrarIntermedia_Oficina_HaciendoTraspasoPersonas();

                            });


    }else if(data==6) {
            //----HAGO UN NUEVO REGISTRO--->>

                        swal({   
                             title: "Atenciòn",   
                             text:  "Ud. Modificó El Nombre De La Oficina... Debe Tener Encuenta Que Existen Personas "+
                                    "Asignadas A Dicha Oficina. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
                                    "Deseado Y Las Personas De La Anterior Oficina Pasaran A La Nueva Modificacion, Es Decir Cambiaran El "+
                                    "Nombre De La Oficina De La Cual Son Encargados. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.",
                             
                             type: "warning", 
                             showCancelButton: true, 
                             confirmButtonColor: "#DD6B55",
                             confirmButtonText: "Sì, Modificar!", 
                             closeOnConfirm: false 
                         }, 
                             function(){  
                             
                                alert("usted dio aceptar, REALIZO NUEVO REGISTRO");
                                RegistraNuevaOficina_HaciendoTraspasoPersonas();

                            });
        

    }else if(data==7) {
            //----MODIFICO TODO---->
        
                    swal({   
                             title: "Atenciòn",   
                             text:  "Ud. Modificó El Nombre De La Oficina... Debe Tener Encuenta Que Existen Personas "+
                                    "Asignadas A Dicha Oficina. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
                                    "Deseado Y Las Personas De La Anterior Oficina Pasaran A La Nueva Modificacion, Es Decir Cambiaran El "+
                                    "Nombre De La Oficina De La Cual Son Encargados. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.",
                             
                             type: "warning", 
                             showCancelButton: true, 
                             confirmButtonColor: "#DD6B55",
                             confirmButtonText: "Sì, Modificar!", 
                             closeOnConfirm: false 
                         }, 
                             function(){  
                             
                                alert("usted dio aceptar, MODIFICO TODO");
                                 MdificarTodo_TraspasoPersonas();

                            });
        

    }else if(data==8) {
                //----CAMBIO ESTATUS---->
        
                        swal({   
                             title: "Atenciòn",   
                             text:  "Ud. Modificó El Nombre De La Oficina... Debe Tener Encuenta Que Existen Personas "+
                                    "Asignadas A Dicha Oficina. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
                                    "Deseado Y Las Personas De La Anterior Oficina Pasaran A La Nueva Modificacion, Es Decir Cambiaran El "+
                                    "Nombre De La Oficina De La Cual Son Encargados. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.",
                             
                             type: "warning", 
                             showCancelButton: true, 
                             confirmButtonColor: "#DD6B55",
                             confirmButtonText: "Sì, Modificar!", 
                             closeOnConfirm: false 
                         }, 
                             function(){  
                             
                                alert("usted dio aceptar, MODIFICO STATUS");
                                 CambiarEstatus_TraspasoPersonas();

                            });
        
    }
    
    }
    });
    
}




















//------CAMBIAR ESTATUS----->VINE DE LA MODIFICACION--->>
function CambiarEstatus_TraspasoPersonas(){
    
    var id_organizacion_p   = document.getElementById("id_organizacion").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estado").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Departamento/controlador/Gestion_Oficina_Controller.php",
        data: {
            
            id                  : id_oficina,
            id_organizacion_p   : id_organizacion_p,  
            nombre              : nombre,      
            estatus             : estatusS,
            descripcion         : descripcionS,

            Modificar5           : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);

  alert(data)


    if(data==1){

    swal("El Nombre Ya Existe"); 

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error"); 

    }else if(data==2) {
        
    swal("Oficina Modificada Exitosamente!",'', "success");          
              
    }
    restablecerForm();
    }
    });
    
}


//------HACER UNA NUEVA INSERSION EN DEPARTAMENTO, OFICINA, INTERMEDIA, CON TRASPASO----->VINE DE LA MODIFICACION--->>
function RegistraNuevaOficina_HaciendoTraspasoPersonas(){
    
    var id_organizacion_p   = document.getElementById("id_organizacion").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estado").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Departamento/controlador/Gestion_Oficina_Controller.php",
        data: {
            
            id                  : id_oficina,
            id_organizacion_p   : id_organizacion_p,  
            nombre              : nombre,      
            estatus             : estatusS,
            descripcion         : descripcionS,

            Modificar2           : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);

  alert(data)

    if(data==1){

    swal("El Nombre Ya Existe"); 

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error"); 

    }else if(data==2) {
        
    swal("Oficina Modificada Exitosamente!",'', "success");          
              
    }
    restablecerForm();
    }
    });
    
}

//------HACER UNA NUEVA INSERSION  EN LA INTERMEDIA, CON TRASPASO----->VINE DE LA MODIFICACION--->>
function RegistrarIntermedia_Oficina_HaciendoTraspasoPersonas(){
    
     var id_organizacion_p   = document.getElementById("id_organizacion").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estado").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Departamento/controlador/Gestion_Oficina_Controller.php",
        data: {
            
            id                  : id_oficina,
            id_organizacion_p   : id_organizacion_p,  
            nombre              : nombre,      
            estatus             : estatusS,
            descripcion         : descripcionS,

            Modificar3           : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);

  alert(data)

    if(data==1){

    swal("El Nombre Ya Existe"); 

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error"); 

    }else if(data==2) {
        
    swal("Oficina Modificada Exitosamente!",'', "success");          
              
    }
    restablecerForm();
    }
    });
    
}

//------MODIFICACION EN TODOS LADOS, OFICNA, INTERMEDIA, sin TRASPASO----->VINE DE LA MODIFICACION--->>
function MdificarTodo_TraspasoPersonas(){
    
    var id_organizacion_p   = document.getElementById("id_organizacion").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estado").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Departamento/controlador/Gestion_Oficina_Controller.php",
        data: {
            
            id                  : id_oficina,
            id_organizacion_p   : id_organizacion_p,  
            nombre              : nombre,      
            estatus             : estatusS,
            descripcion         : descripcionS,

            Modificar4           : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);

  alert(data)

    if(data==1){

    swal("El Nombre Ya Existe"); 

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error"); 

    }else if(data==2) {
        
    swal("Oficina Modificada Exitosamente!",'', "success");          
              
    }
    restablecerForm();
    }
    });
    
}

   















function Autocomplete() {



    //alert("pasooo");
    var boton  = "auto";
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/TutorEmpresarial.php",
        data: {
            

            autocompletado : boton

              },
              

    success: function(data) {

      var Datos = $.parseJSON(data); // lo convierte a Array
      //alert(data);
      $("#cedula").completer({
      source: Datos
    });

    }

    });

    
}



function ValidarCampos()
    {

        var cedula = $('#cedula').val();
        var nombre = $('#nombre').val();
        var apellido  = $('#apellido').val();
        var fecha = $('#fecha').val();
        var observacion = $('#observacion').val();
        var perfil = $('#perfil').val();
        var oficina = $('#oficina').val();
        


    if((cedula=="")||(nombre=="")||(apellido=="")||(fecha=="")||(observacion=="")||(perfil=="")||(oficina==""))
      { 
            

            if(cedula==""){
              $("#cedula").focus();
              MensajeDatosNone();
            }else 
            if(nombre==""){
              $("#nombre").focus();
              MensajeDatosNone();
            }else
            if(apellido==""){
              $("#apellido").focus();
              MensajeDatosNone();
            }else 
            if(fecha==""){
              $("#fecha").focus();
              MensajeError_Fecha();
            }else
            if(observacion==""){
              $("#observacion").focus();
              MensajeDatosNone();
            }else
            if(perfil==""){
              $("#perfil").focus();
              MensajeDatosNone();
            }else
            if(oficina==""){
              $("#oficina").focus();
              MensajeDatosNone();
            }
            
        
            return false;

      }else {

                return true;
        }
        

      }




      ///----- FIN DE VALIDACIONES-------->>>


      ///////////////////-------M E N S A J E S--------------->>>>
function MensajeDatosNone()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡Campos Vacios!...'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}


function MensajeMaximo_Caracteres()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡Maximo De Caracteres Permitidos!'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeError_Fecha()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡La Fecha Seleccionada Es Invalida!'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}
//<<<<<<<<------------------F I N MESNAJES--////////




//----------------------------------FORMULARIO DE ASIGNACION PERSONAS----------------------------->>
                    
                    $('#cedula').validCampoFranz('0123456789');
                    $('#nombre').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#apellido').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#observacion').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789');
                    
                    //---CEDULA
                    $('#cedula').on('keypress', function (e) {
    
                          var cadena = $("#cedula").val();

                          var ultimocaracter =cadena.substring($("#cedula").val().length-1);
                          if(cadena != 0 && ultimocaracter != 1 &&
                             ultimocaracter != 2 && ultimocaracter != 3 &&
                             ultimocaracter != 4 && ultimocaracter != 5 &&
                             ultimocaracter != 6 && ultimocaracter != 7 &&
                             ultimocaracter != 8 && ultimocaracter != 9 ) {
                             $("#cedula").val(cadena.substring(0,$("#cedula").val().length-1));}
                          
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<9){
                                    
                                }
                                else {
                                    $("#cedula").val(cadena.substring(0,$("#cedula").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#nombre').focus();
                              });


                    //---NOMBRE
                    $('#nombre').on('keypress', function (e) {
    
                          var cadena = $("#nombre").val();

                          var ultimocaracter =cadena.substring($("#nombre").val().length-1);
                                                    
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#nombre").val(cadena.substring(0,$("#nombre").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#apellido').focus();
                              });


                    //---APELLIDO
                    $('#apellido').on('keypress', function (e) {
    
                     var cadena = $("#apellido").val();

                          var ultimocaracter =cadena.substring($("#apellido").val().length-1);
                                                  
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#apellido").val(cadena.substring(0,$("#apellido").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#fecha').focus();
                              });


                    //---FECHA
                    $('#fecha').on('change', function (e) {

                            //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#observacion').focus();
                              });


                    //---OBSERVACION
                    $('#observacion').on('keypress', function (e) {
                     
                     /*var FechaForm = $("#fecha").val();
                     var d = new Date(); 
                     var FechaHoy = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

                     if(FechaForm<FechaHoy){
                        alert("fecha mayor")
                     }*/

                     var cadena = $("#observacion").val();
                       
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<100){
                                    
                                }
                                else {
                                    $("#observacion").val(cadena.substring(0,$("#observacion").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#perfil').focus();
                              });

                    //---PERFIL
                    $('#perfil').on('change', function (e) {

                            //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#Asignar_Personas').focus();
                              });
//--------------------------FIN DE FORMULARIO DE ASIGNACION DE  PERSONAS--------------------------------->>





