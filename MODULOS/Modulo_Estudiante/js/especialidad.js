




// CUANDO SE HACE  CLICK  EN EL BOTON ASIGNAR
    // Bloqueam
    $(document).ready(function() {
    $("#Asignar_Estudiante").click(function(){

        var Campos=ValidarCampos_Estudiante();

        if (Campos) {
            AsignarEstudiante();
        }
      
    
    }); 
});



// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {
    $("#Modificar").click(function(){

        var Campos=ValidarCampos();
        
        if(Campos){
            modificarEspecialidad();
        }
      
    
    }); 
});

    // CUANDO SE HACE  CLICK  EN EL BOTON REGISTRAR
    // Bloqueam
    $(document).ready(function() {
    $("#Registrar").click(function(){

        var Campos=ValidarCampos();
        
        if(Campos){
            Registrar_Especialidad();
        }
      
    
    }); 
});



//---CUANDO SE HACE CLIC EN EL BOTON DE CANCELAR--->>>
    $(document).ready(function() {
    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 
});


//---CUANDO SE HACE CLIC EN EL BOTON DE CANCELAR--->>>
    $(document).ready(function() {
    $("#Cancelar2").click(function(){

 
            restablecerForm();
    }); 
});
//----BUSQUEDA EN EL CAMPO NOMBRE--->>>>
function BUSQUEDA() {
                var TablaDatos = document.getElementById('Table');
                var CampoBusqueda = document.getElementById('search').value.toLowerCase();
                                for (var i = 1; i < TablaDatos.rows.length; i++) {
                    var cellsOfRow = TablaDatos.rows[i].getElementsByTagName('td');
                    var found = false;
                    for (var j = 0; j < cellsOfRow.length && !found; j++) {
                        var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                        if (CampoBusqueda.length == 0 || (compareWith.indexOf(CampoBusqueda) > -1)) {
                            found = true;
                        }
                    }
                    if (found) {
                        TablaDatos.rows[i].style.display = '';
                    } else {
                        TablaDatos.rows[i].style.display = 'none';

                    }
                }
            }


//-----BUSQUEDA EN TIEMPO REAL--->>>>
function ConsultaTiempoReal(strr){

        var xmlhttp;
        if (strr.length==0) {

            document.getElementById('resultado').innerHTML="";
            return;
        }

        // Version moderna de navegadores...
        if(window.XMLHttpRequest){
            xmlhttp =new XMLHttpRequest();
        }else{
            //----version antigua....

            xmlhttp =new ActiveXObject("Microsoft.XMLHTTP");
        }
        //---COMPROVAMOS CONEXION...
            xmlhttp.onreadystatechange=function(){

                if(xmlhttp.readyState==4 && xmlhttp.status==200){

                    document.getElementById('resultado').innerHTML=xmlhttp.responseText;
                }

            }
            xmlhttp.open("GET", "../controlador/Gestion_Especialidad_Controller.php?V="+strr, true);
            xmlhttp.send();

    }



//-----RECARGAR BODY--->>>
function restablecerForm()
{

        $( "#page" ).load( "../vista/Gestion_Especialidad.php");
}







//-----ASIGNAR ESTUADIANTE A LA ESPECIALIDAD--->>>

function AsignarEstudiante(){

    var id_especialidad_asignar             = document.getElementById("id_especialidad_asignar").value;
    var id_instituto_asignar                = document.getElementById("id_instituto_asignar").value;
    var expediente                          = document.getElementById("expediente").value;
    var cedula                              = document.getElementById("cedula").value;
    var nombre_e                            = document.getElementById("nombre_e").value;
    var apellido_e                          = document.getElementById("apellido_e").value;
    var fecha                               = document.getElementById("fecha").value;
    var observacion                         = document.getElementById("observacion").value
    
     
    var boton  = "Asignar_Estudiante";

    //alert(id_especialidad_asignar+id_instituto_asignar+expediente+cedula+nombre_e+apellido_e+fecha+observacion);
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

            id_especialidad        : id_especialidad_asignar,
            id_instituto           : id_instituto_asignar,      
            expediente_e           : expediente,
            cedula_e               : cedula,
            nombre_e               : nombre_e,
            apellido_e             : apellido_e,
            fecha                  : fecha,
            observacion            : observacion,

            Asignar_Estudiante    : boton

              },
              
success: function(data){ 

alert(data);

    if(data==0){
      
    alert("Error en la Asignación");
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }else if(data==1) {
        
    alert("Asignación Exitosa");          
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }

    }
    });



}

function Registrar_Especialidad(){

    var id_instituto  = document.getElementById("id_instituto").value;
    var nombre  = document.getElementById("nombre").value;
    var tipo_e  = document.getElementById("tipo_e").value;
    var estatusS = document.getElementById("estatus").value;
    var descripcionS = document.getElementById("descripcion").value;

   
    
    var boton  = "Registra";
   


    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

            id_instituto        : id_instituto,
            nombre              : nombre,      
            tipo_especialidad   : tipo_e,
            estatus             : estatusS,
            descripcion         : descripcionS,

            Registrar           : boton

              },
              
success: function(data){ 
  var result = $.trim(data);
  

    if(data==1){
      
    alert("Este Nombre Ya Existe");
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }else if(data==0) {
        
    alert("Ha Ocurrido Un Error Al Insertar");          
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }else if(data==2) {
        
    alert("Registro  Éxitoso");          
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");
    }

    }
    });



}



function modificarEspecialidad(){
    
    var id_instituto  = document.getElementById("id_instituto").value;
    var id_especialidad  = document.getElementById("id_especialidad").value;
    var nombre  = document.getElementById("nombre").value;
    var tipo_e  = document.getElementById("tipo_e").value;
    var estatusS = document.getElementById("estatus").value;
    var descripcionS = document.getElementById("descripcion").value;

    
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

            id_instituto        : id_instituto,
            id                  : id_especialidad,  
            nombre              : nombre,      
            tipo_especialidad   : tipo_e,
            estatus             : estatusS,
            descripcion         : descripcionS,

            Modificar           : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);

  alert(data)

    if(data==1){

    alert("Ud. No Modifico Ninguna Información");
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }else if(data==0) {
        
    alert("Ha Ocurrido Un Error Al Modificar");          
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");

    }else if(data==2) {
        
    alert("Modificacion Exitosa");          
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");
    }else if(data==3) {
        
    alert("El Nombre Con El Tipo Especialidad Ya Existe");          
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");
    }else if(data==4) {
        //----HAGO UN NUEVO REGISTRO--->>
        
    var confirmacion=confirm("Ud. Modificó El Nombre ó Tipo De Especialidad... Debe Tener Encuenta Que Existen Estudiantes "+
        "Asignados A Dicha Especialidad. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
         "Deseado Y Los Estudiantes De La Anterior Especialidad Pasaran A La Nueva Modificacion, Es Decir Cambiaran Sus "+
          "Especialidades. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.");
    if(confirmacion==true){

        //alert("usted dio aceptar");

    }else{
        //alert("usted dio cancelar");
    }

    $( "#page" ).load( "../vista/Gestion_Especialidad.php");
    }else if(data==5) {
        //----HAGO UNA NUEVA ASIGNACION, REGISTRO SOLO EN LA INTERMEDIA---->
        
    var confirmacion=confirm("Ud. Modificó El Nombre ó Tipo De Especialidad... Debe Tener Encuenta Que Existen Estudiantes "+
        "Asignados A Dicha Especialidad. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
         "Deseado Y Los Estudiantes De La Anterior Especialidad Pasaran A La Nueva Modificacion, Es Decir Cambiaran Sus "+
          "Especialidades. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.");
    if(confirmacion==true){
        
        //alert("usted dio aceptar");

    }else{
        //alert("usted dio cancelar");
    }

    $( "#page" ).load( "../vista/Gestion_Especialidad.php");
    }

    }
    });
    
}




//  SELECCIONAR FILA DELA TABLA PARA ASIGNAR

function seleccionarfila_AsignarPersona(tr){
    
                var id_instituto= document.getElementById("id_instituto").value;
                var id_especialidad="";

                
                var filtro  = "Asignar";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .especialidad_AsignarPersona').each(function() {
                  
                  id_especialidad  = $(tr).find("td").eq(0).text();
                  especialidad  = $(tr).find("td").eq(1).text();
                  
                  });

                
          
                $("#id_especialidad_asignar").val(id_especialidad);
                $("#id_instituto_asignar").val(id_instituto);
                $("#nombre_especialidad").val(especialidad);
  


} 





//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR

function seleccionarfila(tr){
    
                
                var id_especialidad="";
                var nombre="";
                var tipo_e = $(".id_tipo_e",tr).val();
                var estatus="";
                var descripcion="";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .especialidad').each(function() {
                  
                  id_especialidad   = $(tr).find("td").eq(0).text();
                  nombre            = $(tr).find("td").eq(1).text();
                  estatus           = $(tr).find("td").eq(4).text();
                  descripcion       = $(tr).find("td").eq(3).text();
                  

                  });
          $("#id_especialidad").val(id_especialidad); 
          $("#nombre").val(nombre); 
          $("#tipo_e option[value="+ tipo_e +"]").attr("selected",true);
          $("#estatus option[value="+ estatus +"]").attr("selected",true);
          $("#descripcion").val(descripcion); 
       
        $("#Registrar").attr("disabled",true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);
        



} 



function Autocomplete() {

    //alert("pasooo");
    var boton  = "auto";
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
            

            autocompletado : boton

              },
              

    success: function(data) {

      var Datos = $.parseJSON(data); // lo convierte a Array

      $( "#nombre" ).completer({
      source: Datos
    });

    }

    });

    
}



//--------------VALIDACIONES--------

function ValidarCampos()
{
    var nombre = document.getElementById("nombre").value;
    var estatus  = document.getElementById("estatus").value;
    var tipo_e  = document.getElementById("tipo_e").value;



    if((nombre=="")||(estatus=="")||(tipo_e==""))
      { 
            MensajeDatosNone();

            if(nombre==""){
              $("#nombre").focus();
            }else 
            if(estatus==""){
              $("#estatus").focus();
            }else
            if(tipo_e==""){
              $("#tipo_e").focus();
             
            }
        
            return false;

      }else {

                return true;
        }
        

      }

      function ValidarCampos_Estudiante()
    {

        var expediente = document.getElementById("expediente").value
        var cedula = document.getElementById("cedula").value
        var nombre_e = document.getElementById("nombre_e").value;
        var apellido_e  = document.getElementById("apellido_e").value;
        var fecha = document.getElementById("fecha").value
        var observacion_p = document.getElementById("observacion").value;
        


    if((expediente=="")||(cedula=="")||(nombre_e=="")||(apellido_e=="")||(fecha=="")||(observacion_p==""))
      { 
            MensajeDatosNone();

            if(expediente==""){
              $("#expediente").focus();
            }else
            if(cedula==""){
              $("#cedula").focus();
            }else 
            if(nombre_e==""){
              $("#nombre_e").focus();
            }else
            if(apellido_e==""){
              $("#apellido_e").focus();
            }else 
            if(fecha==""){
              $("#fecha").focus();
            }else
            if(observacion_p==""){
              $("#observacion").focus();
            }
            
        
            return false;

      }else {

                return true;
        }
        

      }

//--------------FIN DE VALIDACIONES--------


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
//<<<<<<<<------------------F I N MESNAJES--////////




//----PINTAR LAS FILAS Y COLUMNAS Y DESMARCAR--->>>>
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#5882FA';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}













//----------------ASIGNACION DE ESPECIALIDAD------------------------>>>



//---CUANDO SE HACE CLIC EN EL BOTON DE CANCELAR--->>>
    $(document).ready(function() {
    $("#Modificar2").click(function(){

 
            modificarAsignacion();
    }); 
});

//  SELECCIONAR FILA ASIGNADA---->>

function seleccionarfilaAsignada(tr){
    
                /*   $("tr .sigla ").each(function(index){
                    
                    $("#titlee").html($(tr).text());
 
                }); ME TRAE  TODA  LA  FILA SELECCIONADA DE LA TABLA */
  
                var id_especialidad="";
                var nombre="";
                var estatus="";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .especialidad_asignada').each(function() {
                  
                  id_especialidad  = $(tr).find("td").eq(0).text();
                  nombre = $(tr).find("td").eq(1).text();
                  estatus  = $(tr).find("td").eq(4).text();
                  

                  });
                
          $("#id_especialidad2").val(id_especialidad); 
          $("#nombre2").val(nombre); 
          $("#estado2 option[value="+ estatus +"]").attr("selected",true);
       
        
        $("#Modificar2").attr("disabled",false);
        $("#Cancelar2").attr("disabled",false);
        
   


} 


function modificarAsignacion(){
    
    var porId  = document.getElementById("id_institucion").value;
    var porId2  = document.getElementById("id_especialidad2").value;
    var porId3 = document.getElementById("nombre2").value;
    var porId4 = document.getElementById("estado2").value;

    
    var boton  = "actualiza";
   


    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Asignacion_Especialidad/controlador/ActionPerformed.php",
        data: {
            id_instituto : porId,      
            id_especialidad : porId2,
            nombre : porId3,
            estatus :porId4,
            actualiza : boton

              },
              
success: function(data){ 
  var result = $.trim(data);

  
    if(result>0){
      

    alert("Estatus Modificado");
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");


    }else {    
    alert("Estatus No Modificado");          
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");
    }

    }
    });
    
}


//  SELECCIONAR FILA DELA TABLA PARA ASIGNAR

function seleccionarfila_ParaAsignar(tr){
    
                var id_instituto= document.getElementById("id_institucion").value;
                var id_especialidad="";

                var filtro  = "Asignar";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .especialidad_asignar').each(function() {
                  
                  id_especialidad  = $(tr).find("td").eq(0).text();
                  
                  

                  });
          
                           

                            $.ajax({
                            async:true, 
                            cache:false,
                            dataType:"html", 
                            type: 'POST',   
                            url: "../../Modulo_Asignacion_Especialidad/controlador/ActionPerformed.php",
                            data: {
                                ID_INSTITUTO : id_instituto,      
                                ID_ESPECIALIDAD : id_especialidad,                                
                                Asignare : filtro

                                  },
                                  
success: function(data){ 
  var result = $.trim(data);
   
  
    if(result==1){
      

    alert("Esta Asignacion Ya Existe");
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");


    }else {    
    alert("Asignacion Con Exito");          
    $( "#page" ).load( "../vista/Gestion_Especialidad.php");
    }

    }
    });
        

} 
