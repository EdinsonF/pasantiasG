

    $(document).ready(function(){

        var SelectOtimizado = {autoWidth:false ,

        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 400,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 400
     };

        $("#estatus").selectBoxIt(SelectOtimizado);
        $("#tipo_e").selectBoxIt(SelectOtimizado);

      Renderidng_select();

        showselectESPECIALIDAD('');
        showselectESPECIALIDAD_AsignarPersonas('');
        showselect_PersonasAsignadas('');
        Autocomplete();
        Autocomplete_personasCedula();
        Autocomplete_personasExpediente();
        Autocomplete_personasCedulaTutor();
        Autocomplete_personasCodigo(); 
    

    }) ;

    function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"min-width": "206px" , "width": "206px" ,  "height": "35px"});
}


// CUANDO SE HACE  CLICK  EN EL BOTON ASIGNAR
    // Bloqueam
    $(document).ready(function() {
    
    $("#Asignar_Estudiante").click(function(){

        var Campos=ValidarCampos_Estudiante();

        if (Campos) {
            AsignarEstudiante();
        }
      
    
    }); 

    $("#cerrar").click(function(){

        restablecerForm();
      
    
    }); 


    
});





var thiss;
// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
$(document).ready(function() {


    $("#Modificar").click(function(){

        var Campos=ValidarCampos();
        
        if(Campos){
            ArmarTabla_Modal_SeleccionTemporada(thiss);
        }
      
    
    });

    $("#Asignar_TutorAcademico").click(function(){

        var Campos=ValidarCampos_TutorAcademico();
        
        if (Campos) {
            Asignar_Tutor_Academico();
        }
      
    
    });

    $("#Registrar").click(function(){

        var Campos=ValidarCampos();
        
        if(Campos){
            Registrar_Especialidad();
        }
      
    
    }); 


    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 



    $("#Cancelar2").click(function(){

 
            restablecerForm();
    }); 


    $("#Reporte_PersonasEspecialidad_Fecha").click(function(){

            if($("#fecha_i").val()>$("#fecha_f").val()){
                MensajeError_Fecha_Menor();
                $("#fecha_f").focus();

            }else if($("#fecha_i").val()==$("#fecha_f").val()){
                MensajeError_Fecha_Igual();
                $("#fecha_f").focus();

            }else if($("#fecha_i").val()==""){
                MensajeError_Fecha();
                $("#fecha_i").focus();

            }else if($("#fecha_f").val()==""){
                MensajeError_Fecha();
                $("#fecha_f").focus();

            }else{
                Reporte_PersonasEspecialidadFecha();
            }
            
    }); 

});






//-----LIMPIAR CAMPOS--->>>
function restablecerForm()
{

        $("#nombre").val("");
        $("#estatus").val("");
        $("#estatus").data("selectBoxIt").refresh();
        $("#tipo_e").val("");
        $("#tipo_e").data("selectBoxIt").refresh();
        $("#descripcion").val("");

        //ESTUDIENTE
        $("#expediente").val("");
        $("#cedula").val("");
        $("#nombre_e").val("");
        $("#apellido_e").val("");
        $("#observacion").val("");
        $("#nombre_especialidad").val("");
        $("#cedula").attr("disabled", false);
        $("#nombre_e").attr("disabled", false);
        $("#apellido_e").attr("disabled", false);

        //TUTOR
        $("#codigo").val("");
        $("#cedula_TA").val("");
        $("#nombre_TA").val("");
        $("#apellido_TA").val("");     
        $("#observacion_TA").val("");
        $("#nombre_especialidad2").val("");
        $("#cedula_TA").attr("disabled", false);
        $("#nombre_TA").attr("disabled", false);
        $("#apellido_TA").attr("disabled", false);

        $("#Registrar").attr("disabled", false);
        $("#Modificar").attr("disabled", true);


        showselectESPECIALIDAD('');
        showselectESPECIALIDAD_AsignarPersonas('');
        showselect_PersonasAsignadas('');

        Autocomplete();
        Autocomplete_personasCedula();
        Autocomplete_personasExpediente();
        Autocomplete_personasCedulaTutor();
        Autocomplete_personasCodigo();

        Renderidng_select();   


}



//-----ASIGNAR ESTUADIANTE A LA ESPECIALIDAD--->>>

function Reporte_PersonasEspecialidadFecha(){

    
    var fecha_i           = $("#fecha_i").val();
    var fecha_f           = $("#fecha_f").val();
    
     
    var boton  = "ReporteFecha";

    //alert(fecha_i+"--"+fecha_f);
    
      
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

            
            fecha_i            : fecha_i,
            fecha_f            : fecha_f,

            Reporte_PE_PorFecha    : boton

              },

        success: function(data){ 

                var Variable = JSON.parse(data);
            //alert(Variable);
            if (Variable=='ReporteFecha'){
                window.open('../controlador/Gestion_Especialidad_Controller.php');
            } 

    
    }
              

    });



}




function AsignarEstudiante(){

    var id_especialidad_asignar    = $("#id_especialidad_asignar").val();
    var id_instituto_asignar       = $("#id_instituto_asignar").val();
    var expediente      = $("#expediente").val();        
    var cedula          = $("#cedula").val();        
    var nombre_e        = $("#nombre_e").val();
    var apellido_e      = $("#apellido_e").val();
    var observacion_e   = $("#observacion").val();
    var fecha           = $("#fecha_r").val();
    
     
    var boton  = "Asignar_Estudiante";

    //alert(id_especialidad_asignar+id_instituto_asignar+expediente+cedula+nombre_e+apellido_e+fecha+observacion_e);
   
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
            observacion            : observacion_e,

            Asignar_Estudiante    : boton

              },
              
success: function(data){ 

alert(data);

    if(data==0){
      
    swal("A Ocurrido Un Error Durante El Proceso", "", "error");

    }else if(data==1) {
        
    swal("Asignación Exitosa!",'', "success");          

    }else if(data==2) {
        
    swal("La Persona Ya Tiene Una Especialidad En Una Temporada", "", "error");         

    }else if(data==3) {
        
    swal("El Estudiante Ya Esta Asignado A La Especialidad", "", "error");         

    }
    restablecerForm();
     $('#tabla').modal('hide');
    }
    });



}



function Asignar_Tutor_Academico(){

    var id_especialidad_asignar             = document.getElementById("id_especialidad_asignar2").value;
    var id_instituto_asignar                = document.getElementById("id_instituto_asignar2").value;
    var codigo                              = document.getElementById("codigo").value;
    var cedula_TA                           = document.getElementById("cedula_TA").value;
    var nombre_TA                           = document.getElementById("nombre_TA").value;
    var apellido_TA                         = document.getElementById("apellido_TA").value;
    var observacion                         = document.getElementById("observacion_TA").value
    var fecha_TA                            = document.getElementById("fecha_TA").value;
     
    var boton  = "Asignar_TutorAcademico";

    //alert(id_especialidad_asignar+id_instituto_asignar+codigo+cedula_TA+nombre_TA+apellido_TA+fecha+observacion);
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

            id_especialidad        : id_especialidad_asignar,
            id_instituto           : id_instituto_asignar,      
            codigo                 : codigo,
            cedula_TA              : cedula_TA,
            nombre_TA              : nombre_TA,
            apellido_TA            : apellido_TA,
            observacion            : observacion,
            fecha                  : fecha_TA,

            Asignar_TutorAcademico   : boton

              },
              
success: function(data){ 

alert(data);

    if(data==0){
      
    swal("A Ocurrido Un Error Durante El Proceso", "", "error");
    
    }else if(data==1) {
        
    swal("Asignación Exitosa!",'', "success");        
    
    }else if(data==2) {
        
    swal("La Persona Ya Está Asignada A La Especialidad", "", "error");         

    }else if(data==3) {
        
    swal("El Codigo Ya Está Asignado A Otra Especialidad", "", "error");         

    }
    restablecerForm();
    $('#tabla').modal('hide');
    $ ("#tab1").tab({selectable: true});

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
  //var result = $.trim(data);
  
//alert(result);

    if(data==1){
     
     swal("Este Registro Ya Existe!");

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error");         
    

    }else if(data==2) {
        
    swal("Especialidad Registrada Exitosamente!",'', "success");          
    
    }

    restablecerForm();
    }
    });



}



function modificarEspecialidad(list, thiss){
    
    var id_instituto  = document.getElementById("id_instituto").value;
    var id_especialidad  = document.getElementById("id_especialidad").value;
    var nombre  = document.getElementById("nombre").value;
    var tipo_e  = document.getElementById("tipo_e").value;
    var estatusS = document.getElementById("estatus").value;
    var descripcionS = document.getElementById("descripcion").value;

      var especialidad  = $(thiss).find("td").eq(1).text();
      var tipo          = $(".id_tipo_e",thiss).val();
      var descripcion   = $(thiss).find("td").eq(3).text();
      var estatus       = $(thiss).find("td").eq(4).text();

                          
          if((especialidad==nombre)&&(tipo==tipo_e)&&
            (descripcion==descripcionS)&&(estatus==estatusS)){
            
            swal("Ud. No Modifico Ningún Campo!");
          }else{
            
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
          

          alert(data);

            if(data==1){
             
             swal("Ud. No Modifico Ningún Campo!");
             restablecerForm();

            }else if(data==0) {
                
            swal("A Ocurrido Un Error Al Insertar", "", "error");   
            restablecerForm();      
            

            }else if(data==2) {
                
            swal("Especialidad Modificada Exitosamente!",'', "success");
            restablecerForm();          
            
            }else if(data==3) {
                
            swal("El Nombre Con El Tipo Especialidad Ya Existe");
            restablecerForm();          
            
            }else if(data==4) {
                //----HAGO UN NUEVO REGISTRO--->>

                                swal({   
                                     title: "Atenciòn",   
                                     text:  "Ud. Modificó El Nombre ó Tipo De Especialidad... Debe Tener Encuenta Que Existen Estudiantes "+
                                            "Asignados A Dicha Especialidad. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
                                            "Deseado Y Los Estudiantes De La Anterior Especialidad Pasaran A La Nueva Modificacion, Es Decir Cambiaran Sus "+
                                            "Especialidades. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.",
                                     
                                     type: "warning", 
                                     showCancelButton: true, 
                                     confirmButtonColor: "#DD6B55",
                                     confirmButtonText: "Aceptar",
                                     cancelButtonText: "Cancelar", 
                                     closeOnConfirm: false 
                                 }, 
                                     function(){  
                                     
                                        //alert("usted dio aceptar, REALIZO NUEVO REGISTRO");
                                        RegistraNuevaEspecialidad_HaciendoTraspasoEstudiantes(list);

                                    });
            }else if(data==5) {
                //----HAGO UNA NUEVA ASIGNACION, REGISTRO SOLO EN LA INTERMEDIA---->
                                swal({   
                                     title: "Atenciòn",   
                                     text:  "Ud. Modificó El Nombre ó Tipo De Especialidad... Debe Tener Encuenta Que Existen Estudiantes "+
                                            "Asignados A Dicha Especialidad. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
                                            "Deseado Y Los Estudiantes De La Anterior Especialidad Pasaran A La Nueva Modificacion, Es Decir Cambiaran Sus "+
                                            "Especialidades. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.",
                                     
                                     type: "warning", 
                                     showCancelButton: true, 
                                     confirmButtonColor: "#DD6B55",
                                     confirmButtonText: "Aceptar",
                                     cancelButtonText: "Cancelar", 
                                     closeOnConfirm: false 
                                 }, 
                                     function(){  
                                     
                                        //alert("usted dio aceptar, REALIZO NUEVO REGISTRO Intermedia");
                                        RegistrarIntermedia_Especialidad_HaciendoTraspasoEstudiantes(list);

                                    });
                            

            }else if(data==6) {
                    //----MODIFICO TODO---->
                
                            swal({   
                                     title: "Atenciòn",   
                                     text:  "Ud. Modificó El Nombre ó Tipo De Especialidad... Debe Tener Encuenta Que Existen Estudiantes "+
                                            "Asignados A Dicha Especialidad. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
                                            "Deseado Y Los Estudiantes De La Anterior Especialidad Pasaran A La Nueva Modificacion, Es Decir Cambiaran Sus "+
                                            "Especialidades. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.",
                                     
                                     type: "warning", 
                                     showCancelButton: true, 
                                     confirmButtonColor: "#DD6B55",
                                     confirmButtonText: "Aceptar",
                                     cancelButtonText: "Cancelar",  
                                     closeOnConfirm: false 
                                 }, 
                                     function(){  
                                     
                                        //alert("usted dio aceptar, MODIFICO TODO");
                                         MdificarTodo_TraspasoEstudiantes(list);

                                    });
                           
            }else if(data==7) {
                //----CAMBIO ESTATUS---->
                
                                swal({   
                                     title: "Atenciòn",   
                                     text:  "Ud. Modificó El Nombre ó Tipo De Especialidad... Debe Tener Encuenta Que Existen Estudiantes "+
                                            "Asignados A Dicha Especialidad. Seguro Que Desea Realizar La Modificación?... Si Presiona 'Aceptar' Se Modificara Lo "+
                                            "Deseado Y Los Estudiantes De La Anterior Especialidad Pasaran A La Nueva Modificacion, Es Decir Cambiaran Sus "+
                                            "Especialidades. De Lo Contrario Haga Clic En 'Cancelar' Y Realize Un Nuevo Registro Con Los Datos Deseados.",
                                     
                                     type: "warning", 
                                     showCancelButton: true, 
                                     confirmButtonColor: "#DD6B55",
                                     confirmButtonText: "Aceptar",
                                     cancelButtonText: "Cancelar", 
                                     closeOnConfirm: false 
                                 }, 
                                     function(){  
                                     
                                        //alert("usted dio aceptar, MODIFICO STATUS");
                                         CambiarEstatus_TraspasoEstudiantes(list);

                                    });
                            
            }


            

            }
            });


          }

            
        
    
}//---FIN DE LA CLASE


//------CAMBIAR ESTATUS----->VINE DE LA MODIFICACION--->>
function CambiarEstatus_TraspasoEstudiantes(list){
    
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
            list                : list,

            Modificar5           : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);

  //alert(data);

    if(data==1){

    swal("El Nombre Con El Tipo Especialidad Ya Existe"); 

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error"); 

    }else if(data==2) {
        
    swal("Especialidad Modificada Exitosamente!",'', "success");          
              

    }
    restablecerForm();
    }
    });
    
}

    
//------HACER UNA NUEVA INSERSION EN DEPARTAMENTO, ESPECIALIDA, INTERMEDIA, CON TRASPASO----->VINE DE LA MODIFICACION--->>
function RegistraNuevaEspecialidad_HaciendoTraspasoEstudiantes(list){
    
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
            list                : list,

            Modificar3           : boton

              },
              
success: function(data){ 
  

  alert(data);

    if(data==1){

    swal("El Nombre Con El Tipo Especialidad Ya Existe"); 

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error"); 

    }else if(data==2) {
        
    swal("Especialidad Modificada Exitosamente!",'', "success");          
              

    }
    restablecerForm();
    }
    });
    
}



//------HACER UNA NUEVA INSERSION EN LA INTERMEDIA, CON TRASPASO----->VINE DE LA MODIFICACION--->>
function RegistrarIntermedia_Especialidad_HaciendoTraspasoEstudiantes(list){
    
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
            list                : list,

            Modificar2           : boton

              },
              
success: function(data){ 

  //alert(data);

    if(data==1){

    swal("El Nombre Con El Tipo Especialidad Ya Existe"); 

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error"); 

    }else if(data==2) {
        
    swal("Especialidad Modificada Exitosamente!",'', "success");          
              

    }
    restablecerForm();
    }
    });
    
}



//------MODIFICACION EN TODOS LADOS, ESPECIALIDA, INTERMEDIA, sin TRASPASO----->VINE DE LA MODIFICACION--->>
function MdificarTodo_TraspasoEstudiantes(list){
    
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
            list                : list,

            Modificar4           : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);

  //alert(data);

    if(data==1){

    swal("El Nombre Con El Tipo Especialidad Ya Existe"); 

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error"); 

    }else if(data==2) {
        
    swal("Especialidad Modificada Exitosamente!",'', "success");          
              

    }
    restablecerForm();
    }
    });
    
}


//--------------------FIN DE TODOS LOS MODIFICAR-------->>>>>



//-----------CONTAR CHECBOX SELECCIONADOS DE LA TABLA---->>>>
$("#ModificarTemporada").on('click',function(){
    

      var list = Array();
      var veri = false;
$('.seleccionado:checked').each(function(index) {
  var tipo_solicitud=$(this).closest("tr").find('td').eq(1).text(); 
        
        //buscarEstatemporada(codigo_encargao);
          
        list[index]=tipo_solicitud;
        
            if(index==0){
            veri=true;
            }
    });
  //alert(list);
  if(veri==true)
  {     
          modificarEspecialidad(list, thiss);
          $("#ModalTemporadasCusro").modal('hide');
  }else 
  {


  } 

    
});



//---------ARAMAR TABLA SI TIENE TEMPORADAS EN CURSO--->>>
function ArmarTabla_Modal_SeleccionTemporada(thiss){
    
     var id_especialidad=$("#id_especialidad").val();
     $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Especialidad_Controller.php",
                dataType: "html",
                data: {
                  id_especialidad: id_especialidad,
                  Temporada_Curso: 'ofcourse'
                },
                success: function (data) {
                   
                    var Variable = JSON.parse(data);
                    //alert(data);

                     if(data!='[]'){

                          var especialidad  = $(thiss).find("td").eq(1).text();
                          var tipo_e        = $(thiss).find("td").eq(2).text();
                          var descripcion   = $(thiss).find("td").eq(3).text();
                          var estatus       = $(thiss).find("td").eq(4).text();

                          var tipo          = $(".id_tipo_e",thiss).val();
                          var tipo_eSelected= $("#tipo_e option:selected").text();//---MOSTRAR EN EL LERT

                          
                          if((especialidad==$("#nombre").val())&&(tipo==$("#tipo_e").val())&&
                            (descripcion==$("#descripcion").val())&&(estatus==$("#estatus").val())){

                            swal("Ud. No Modifico Ningún Campo!");
                          }else if((especialidad==$("#nombre").val())&&(tipo==$("#tipo_e").val())&&(
                            (descripcion!=$("#descripcion").val())||(estatus!=$("#estatus").val()))) {
                            //alert("entro");

                            modificarEspecialidad(list, thiss);
                          }else{
                             $("#alertdescente").html("<strong>¡Atención!</strong> Ud. se dispone a modificar la especialidad <strong>"+especialidad+" - "+tipo_e+"</strong> por <strong>"+$("#nombre").val()+" - "+tipo_eSelected+"</strong>. Debe tener en cuenta que dicha especialidad se encuentra presente en las siguientes Temporadas... Seleccione las Temporadas donde quiere hacer efectiva la modificación.");
                             $("#ModalTemporadasCusro").modal('show');
                          }
                          
                    }else{
                        var list=[];

                        modificarEspecialidad(list, thiss);
                    }
                    

                    var html = "";
                    
                    $.each(Variable, function(index, value){

                    html +="<tr style=cursor:pointer>"+
                    "<td ><center ><input type=checkbox class=seleccionado ></center></td>"+ 
                    " <td hidden><center>"+Variable[index].id_tipo_solicitud+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_tipo_solicitud+"</center></td>"+
                     " <td ><center>"+Variable[index].periodo+"</center></td>"+
                    " </tr>" ;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTabla_TemporadaCurso('#Temporadas',html);
                    
                }

            });


}



//----------CON CHEKBOX----->>>

function ArmarTabla_TemporadaCurso (tabla, html)
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

            "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    ' ',
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
        "iDisplayLength": 4,
         'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" class=seleccionado>';
         }
      }],
      'order': [2, 'asc'],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
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
                 $row.addClass('selected');
              } else {
                 $row.removeClass('selected');
              }

              // Update state of "Select all" control
              updateDataTableSelectAllCtrl(tablaaa);
              habilitarBotnModal();
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

function habilitarBotnModal()
      {

                if($(".seleccionado").is(':checked')) {  
                    $("#ModificarTemporada").attr('disabled', false);  
                } else {  
                    $("#ModificarTemporada").attr('disabled', true);   
                }
      }

//------------------FIN DEL PUTO CHEKBOX------>>>>>




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
                $("#id_especialidad_asignar2").val(id_especialidad);
                $("#id_instituto_asignar").val(id_instituto);
                $("#id_instituto_asignar2").val(id_instituto);
                $("#nombre_especialidad").val(especialidad);
                $("#nombre_especialidad2").val(especialidad);
  


} 





//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR

function seleccionarfila(tr){
    
                thiss=tr;
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
          $("#tipo_e").val(tipo_e);
          $("#tipo_e").data("selectBoxIt").refresh();
          $("#estatus").val(estatus);
          $("#estatus").data("selectBoxIt").refresh();
          $("#descripcion").val(descripcion); 
       
        $("#Registrar").attr("disabled",true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);
        
        Renderidng_select();


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
              

    success: function(data){  
         
          var variable = JSON.parse(data);

            variable = toObject(variable);
                    $('#nombre').typeahead({

                      minLength: 1,
                      maxItem: 5,
                      order: "asc",
                      //hint: true,
                      
                      source: { 
                         data :variable.datos
                      },debug: false
                        
                      });

            }
        });
        }

function toObject(json) {

  var Arreglote = {};

  var arregloPivote = Array();

  $.each(json , function(index , values){

    arregloPivote[index] = values.nombre_especialidad;

  });

  Arreglote['datos'] =arregloPivote;

  return Arreglote;
}



//---CAMPO DE LA CEDULA
function Autocomplete_personasCedula() {

    //alert("pasooo");
    var boton  = "auto";
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
            

            autocompletado_personasCedula : boton

              },
              

    success: function(data){  
         
          var variable = JSON.parse(data);

            variable = toObjectConverter(variable);
                    $('#cedula').typeahead({

                      minLength: 1,
                      maxItem: 5,
                      order: "asc",
                      //hint: true,
                      
                      source: { 
                         data :variable.datos
                      },

    callback: {
       onClick: function (node, a, obj, e) {
   
                      cedulaSeleccionada($(a).find('.typeahead-display').text());

         }
        ,
        onMouseEnter: function (node, a, item, event) {

             
                if (!$(a).find('.popover')[0]) {
                  nombreApellidoCedulaEstudiante (a , $(a).find('.typeahead-display').text()); 
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

function toObjectConverter(json) {

  var Arreglote = {};

  var arregloPivote = Array();

  $.each(json , function(index , values){

    arregloPivote[index] = values.cedula;

  });

  Arreglote['datos'] =arregloPivote;

  return Arreglote;
}

function cedulaSeleccionada(cedula)
{

    $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
          BuscarTodosDatosCedulaSeleccionada :cedula
              },              
    
        success: function(data){  
            var Variable = JSON.parse(data);

              $("#nombre_e").val(Variable.nombre);
              $("#apellido_e").val(Variable.apellido);
              $("#nombre_e").attr("disabled", true);
              $("#apellido_e").attr("disabled", true);
            
            
        } // success
    });

   

}


function nombreApellidoCedulaEstudiante(a , cedula)
{
        $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

          BuscarTodosDatosCedulaSeleccionada :cedula
              },              
    
        success: function(data){  
          

          var persona = JSON.parse(data);
          
                
                $(a).append(

                    $('<div/>', {
                        
                        "class":"popover fade right in",
                        "role":"tooltip" ,                        
                        "style":"top: -18.6023px; left: 217.753px; display: block;",
                        "html": 
                        "<h3 class='popover-title' ><span class='label label-default'> NOMBRE  -  APELLIDO</span></h3>"+
                        "<div class='popover-content'><span class='label label-primary'>"+persona.nombre+" - "+persona.apellido+"</span></div>"
                        
                    }).prepend($('<div/>', {
                            "class": "arrow",
                            "style":"right: 50%;"
                        }))
                );
              

        }
      });

}

//---FIN DEL CAMPO DE LA CEDULA



//---CAMPO DE LA CEDULA Tutor
function Autocomplete_personasCedulaTutor() {

    //alert("pasooo");
    var boton  = "auto";
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
            

            autocompletado_personasCedula : boton

              },
              

    success: function(data){  
         
          var variable = JSON.parse(data);

            variable = toObjectConverter(variable);
                    $('#cedula_TA').typeahead({

                      minLength: 1,
                      maxItem: 5,
                      order: "asc",
                      //hint: true,
                      
                      source: { 
                         data :variable.datos
                      },

    callback: {
       onClick: function (node, a, obj, e) {
   
                      cedulaSeleccionadaTutor($(a).find('.typeahead-display').text());

         }
        ,
        onMouseEnter: function (node, a, item, event) {

             
                if (!$(a).find('.popover')[0]) {
                  nombreApellidoCedulaTutor (a , $(a).find('.typeahead-display').text()); 
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

function toObjectConverter(json) {

  var Arreglote = {};

  var arregloPivote = Array();

  $.each(json , function(index , values){

    arregloPivote[index] = values.cedula;

  });

  Arreglote['datos'] =arregloPivote;

  return Arreglote;
}


function cedulaSeleccionadaTutor(cedula)
{

    $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
          BuscarTodosDatosCedulaSeleccionada :cedula
              },              
    
        success: function(data){  
            var Variable = JSON.parse(data);

              $("#nombre_TA").val(Variable.nombre);
              $("#apellido_TA").val(Variable.apellido);
              $("#nombre_TA").attr("disabled", true);
              $("#apellido_TA").attr("disabled", true);
            
            
        } // success
    });

   

}

function nombreApellidoCedulaTutor (a , cedula)
{
        $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

          BuscarTodosDatosCedulaSeleccionada :cedula
              },              
    
        success: function(data){  
          

          var persona = JSON.parse(data);
          
                
                $(a).append(

                    $('<div/>', {
                        
                        "class":"popover fade right in",
                        "role":"tooltip" ,                        
                        "style":"top: -18.6023px; left: 217.753px; display: block;",
                        "html": 
                        "<h3 class='popover-title' ><span class='label label-default'> NOMBRE  -  APELLIDO</span></h3>"+
                        "<div class='popover-content'><span class='label label-primary'>"+persona.nombre+" - "+persona.apellido+"</span></div>"
                        
                    }).prepend($('<div/>', {
                            "class": "arrow",
                            "style":"right: 50%;"
                        }))
                );
              

        }
      });

}
//---FIN DEL CAMPO DE LA CEDULA TUTOR





//-------CAMPO DEL EXPEDINETE
function Autocomplete_personasExpediente() {
    var intituto=$("#id_instituto").val();
    //alert("pasooo");
    var boton  = "auto";
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
            
            instituto_principal               : intituto,
            autocompletado_personasExpediente : boton

              },
              

    success: function(data){  
         
          var variable = JSON.parse(data);

            variable = toObjectConverterExpediente(variable);
                    $('#expediente').typeahead({

                      minLength: 1,
                      maxItem: 5,
                      order: "asc",
                      //hint: true,
                      
                      source: { 
                         data :variable.datos
                      },

    callback: {
       onClick: function (node, a, obj, e) {
   
                      ExpedienteSeleccionada($(a).find('.typeahead-display').text());

         },
     
         
        
        onMouseEnter: function (node, a, item, event) {

             
                if (!$(a).find('.popover')[0]) {
                  nombreApellidoExpediente (a , $(a).find('.typeahead-display').text()); 
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

        $('#cedula').on('click', function (e) {
                                  
                             ExpedienteSeleccionada($('#expediente').val());
                                  
                                      });
        $('#cedula').on('keypress', function (e) {
                                   
                             ExpedienteSeleccionada($('#expediente').val());
                                  
                                      });
        $('#expediente').on('keypress', function (e) {
                                   
                             
                            $("#cedula").val("");
                            $("#nombre_e").val("");
                            $("#apellido_e").val("");
                            $("#cedula").attr("disabled", false);
                            $("#nombre_e").attr("disabled", false);
                            $("#apellido_e").attr("disabled", false);
                                  
                                      });

            }
        });

        }


function toObjectConverterExpediente(json) {

  var Arreglote = {};

  var arregloPivote = Array();

  $.each(json , function(index , values){

    arregloPivote[index] = values.expediente;

  });

  Arreglote['datos'] =arregloPivote;

  return Arreglote;
}



function ExpedienteSeleccionada(expediente)
{

    var instituto_principal=$("#id_instituto").val();
    
    $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
           instituto_principal                   :instituto_principal, 
          BuscarTodosDatosExpedienteSeleccionado :expediente
              },              
    
        success: function(data){

            var Variable = JSON.parse(data);


            if(Variable==false){
            
            }else{
                  $("#cedula").val(Variable.cedula);
                  $("#nombre_e").val(Variable.nombre);
                  $("#apellido_e").val(Variable.apellido);
                  $("#cedula").attr("disabled", true);
                  $("#nombre_e").attr("disabled", true);
                  $("#apellido_e").attr("disabled", true);
            }


              
            
            
        } // success
    });

}


function nombreApellidoExpediente (a , expediente)
{
        var instituto_principal=$("#id_instituto").val();
    
    $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

           instituto_principal                   :instituto_principal, 
           BuscarTodosDatosExpedienteSeleccionado :expediente
              },              
    
        success: function(data){  
          

          var persona = JSON.parse(data);
          
                
                $(a).append(

                    $('<div/>', {
                        
                        "class":"popover fade right in",
                        "role":"tooltip" ,                        
                        "style":"top: -18.6023px; left: 217.753px; display: block;",
                        "html": 
                        "<h3 class='popover-title' ><span class='label label-default'> NOMBRE  -  APELLIDO</span></h3>"+
                        "<div class='popover-content'><span class='label label-primary'>"+persona.nombre+" - "+persona.apellido+"</span></div>"
                        
                    }).prepend($('<div/>', {
                            "class": "arrow",
                            "style":"right: 50%;"
                        }))
                );
              

        }
      });

}



//----FIN DE L CAMPO DEL EXPEDINETE





//-------CAMPO DEL CODIGO
function Autocomplete_personasCodigo() {

    var instituto_principal=$("#id_instituto").val();
    
    $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
            instituto_principal           :instituto_principal,
            autocompletado_personasCodigo : 'boton'

              },
              

    success: function(data){  
         
          var variable = JSON.parse(data);

            variable = toObjectConverterCodigo(variable);
                    $('#codigo').typeahead({

                      minLength: 1,
                      maxItem: 5,
                      order: "asc",
                      //hint: true,
                      
                      source: { 
                         data :variable.datos
                      },

    callback: {
       onClick: function (node, a, obj, e) {
   
                      CodigoSeleccionada($(a).find('.typeahead-display').text());

         }
        ,
        onMouseEnter: function (node, a, item, event) {

             
                if (!$(a).find('.popover')[0]) {
                  nombreApellidoCodigo (a , $(a).find('.typeahead-display').text()); 
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

             $('#cedula_TA').on('click', function (e) {
                                  
                             CodigoSeleccionada($('#codigo').val());
                                  
                                      });
            $('#cedula_TA').on('keypress', function (e) {
                                       
                                 CodigoSeleccionada($('#codigo').val());
                                      
                                          });
            $('#codigo').on('keypress', function (e) {
                                       
                                 
                                $("#cedula_TA").val("");
                                $("#nombre_TA").val("");
                                $("#apellido_TA").val("");
                                $("#cedula_TA").attr("disabled", false);
                                $("#nombre_TA").attr("disabled", false);
                                $("#apellido_TA").attr("disabled", false);
                                      
                                          });

            }
        });
        }

function toObjectConverterCodigo(json) {

  var Arreglote = {};

  var arregloPivote = Array();

  $.each(json , function(index , values){

    arregloPivote[index] = values.codigo;

  });

  Arreglote['datos'] =arregloPivote;

  return Arreglote;
}



function CodigoSeleccionada(codigo)
{
    var instituto_principal=$("#id_instituto").val();
    
    $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {
          instituto_principal                :instituto_principal,
          BuscarTodosDatosCodigoSeleccionado :codigo
              },              
    
        success: function(data){  
            var Variable = JSON.parse(data);

            if(Variable==false){

            }else{
                  $("#cedula_TA").val(Variable.cedula);
                  $("#nombre_TA").val(Variable.nombre);
                  $("#apellido_TA").val(Variable.apellido);
                  $("#cedula_TA").attr("disabled", true);
                  $("#nombre_TA").attr("disabled", true);
                  $("#apellido_TA").attr("disabled", true);

            }
          
              
            
            
        } // success
    });

}


function nombreApellidoCodigo (a , codigo)
{
        var instituto_principal=$("#id_instituto").val();
    
    $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/Gestion_Especialidad_Controller.php",
        data: {

          instituto_principal                :instituto_principal,
          BuscarTodosDatosCodigoSeleccionado :codigo
              },              
    
        success: function(data){  
          

          var persona = JSON.parse(data);
          
                
                $(a).append(

                    $('<div/>', {
                        
                        "class":"popover fade right in",
                        "role":"tooltip" ,                        
                        "style":"top: -18.6023px; left: 217.753px; display: block;",
                        "html": 
                        "<h3 class='popover-title' ><span class='label label-default'> NOMBRE  -  APELLIDO</span></h3>"+
                        "<div class='popover-content'><span class='label label-primary'>"+persona.nombre+" - "+persona.apellido+"</span></div>"
                        
                    }).prepend($('<div/>', {
                            "class": "arrow",
                            "style":"right: 50%;"
                        }))
                );
              

        }
      });

}

//----FIN DE L CAMPO DEL CODIGO















//-------RECARGAR TABLA ESPECIALIDAD--->>>>
function showselectESPECIALIDAD(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Especialidad_Controller.php",
                dataType: "html",
                data: {
                  id_instituto:$("#id_instituto").val(),
                  Tabla_Especialidad:'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";
                    
                    $.each(Variable, function(index, value){

                    html +="<tr style=cursor:pointer class='especialidad' onclick=seleccionarfila(this); >"+
                    " <td hidden><center>"+Variable[index].id_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_especialidad+"</center></td>"+
                    " <td ><center><input type=hidden class='id_tipo_e' value='"+Variable[index].id_tipo_especialidad+"'>"+Variable[index].nombre_tipo_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td ><center>"+Variable[index].estatus+"</center></td>"+
                    " <td><center><img src=../../../img/iconos/edit.png alt=Ginger class=left width=20 ></center></td>"+
                    " </tr>" ;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaESPECIALIDAD(html);
                    
                }

            });

      }
        

      function ArmarTablaESPECIALIDAD (html)
      {


        $("#Table ").empty();
        $("#Table ").append(html);
        $('#Table ').dataTable().fnDestroy();
        $('#Table ').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null , null ,null
          ],
            
            "language"     : {
            "sProcessing"  :    "Procesando...",
            "sLengthMenu"  :    '',
            "sZeroRecords" :   "No se encontraron Resultados",
            "sEmptyTable"  :    "Ningún dato disponible en esta tabla",
            "sInfo"        :          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty"   :     "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix"   :   "",
            "sSearch"        :        "Buscar:",
            "sUrl"           :           "",
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
//----FIN DE RECARGAR TABLA ESPECIALIDAD--->>


//-------RECARGAR TABLA ESPECIALIDAD PARA ASIGTNAR PERSONAS--->>>>
function showselectESPECIALIDAD_AsignarPersonas(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Especialidad_Controller.php",
                dataType: "html",
                data: {
                  id_instituto:$("#id_instituto").val(),
                  TablaE_AsignarPersonas:'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";
                    var contador=0;
                    $.each(Variable, function(index, value){
                
                    html +="<tr href='#tabla'  data-toggle='modal' style=cursor:pointer class='especialidad_AsignarPersona' onclick=seleccionarfila_AsignarPersona(this);  >"+
                    " <td hidden><center>"+Variable[index].id_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_especialidad+"</center></td>"+
                    " <td ><center><input type=hidden class='id_tipo_e' value='"+Variable[index].id_tipo_especialidad+"'>"+Variable[index].nombre_tipo_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td ><center>"+Variable[index].estatus+"</center></td>"+
                    " <td><center><img src=../../../img/iconos/add-group.png class=left width=20></center></td>"+
                    " </tr>" ;
                    contador++;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaESPECIALIDAD_AsignarP(html);
                    
                }

            });

      }
        

      function ArmarTablaESPECIALIDAD_AsignarP (html)
      {


        $("#myTable").empty();
        $("#myTable").append(html);
        $("#myTable").dataTable().fnDestroy();
        $("#myTable").dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null,null
          ],
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
        },
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5,
        'order': [1, 'asc']
        }); 
                     
      }
//----FIN DE RECARGAR TABLA ESPECIALIDAD PARA ASIGNAR PERSONAS--->>

//-------RECARGAR TABLA ESPECIALIDAD  PERSONAS ASIGNADAS--->>>>
function showselect_PersonasAsignadas(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Especialidad_Controller.php",
                dataType: "html",
                data: {
                  id_instituto:$("#id_instituto").val(),
                  Tabla_PersonasAsignadas:'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";
                    var contador=0;
                    $.each(Variable, function(index, value){
                    
                    var perfil="";
                        if(Variable[index].id_perfil==3){
                                   perfil="Estudiante";

                            }else if(Variable[index].id_perfil==4){
                                    perfil="Tutor Académico";

                                  }
                    html +="<tr  >"+
                    " <td hidden><center>"+Variable[index].id_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_especialidad+"</center></td>"+
                    " <td ><center><input type=hidden class='id_tipo_e' value='"+Variable[index].id_tipo_especialidad+"'>"+Variable[index].nombre_tipo_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td ><center>"+Variable[index].estatus+"</center></td>"+
                    " <td ><center>"+Variable[index].cedula+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre+"</center></td>"+
                    " <td ><center>"+Variable[index].apellido+"</center></td>"+
                    " <td ><center>"+perfil+"</center></td>"+
                    " <td><center>----!</center></td>"+
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


        $("#myTable2 ").empty();
        $("#myTable2 ").append(html);
        $('#myTable2 ').dataTable().fnDestroy();
        $('#myTable2 ').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null,null,null,null,null,null
          ],
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
        },
        "aLengthMenu": [[2,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5,
        'order': [2, 'asc']
        }); 
                     
      }
//----FIN DE RECARGAR TABLA  PERSONAS ASIGNADAS--->>



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

      
      function ValidarCampos_TutorAcademico()
    {

        var codigo = document.getElementById("codigo").value;
        var cedula = document.getElementById("cedula_TA").value;
        var nombre_e = document.getElementById("nombre_TA").value;
        var apellido_e  = document.getElementById("apellido_TA").value;
        var observacion_p = document.getElementById("observacion_TA").value;
        var fecha_TA      = document.getElementById("fecha_TA").value;
        


    if((codigo=="")||(cedula=="")||(nombre_e=="")||(apellido_e=="")||(observacion_p=="")||(fecha_TA==""))
      { 
            MensajeDatosNone();

            if(codigo==""){
              $("#codigo").focus();
            }else
            if(cedula==""){
              $("#cedula_TA").focus();
            }else 
            if(nombre_e==""){
              $("#nombre_TA").focus();
            }else
            if(apellido_e==""){
              $("#apellido_TA").focus();
            }else
            if(observacion_p==""){
              $("#observacion_TA").focus();
            }else
            if(fecha_TA==""){
              $("#fecha_TA").focus();
            }
            
        
            return false;

      }else {

                return true;
        }
        

      }



      function ValidarCampos_Estudiante()
    {

        var expediente      = $("#expediente").val();        
        var cedula          = $("#cedula").val();        
        var nombre_e        = $("#nombre_e").val();
        var apellido_e      = $("#apellido_e").val();
        var observacion_p   = $("#observacion").val();
        var fecha           = $("#fecha_r").val();
        


    if((expediente=="")||(cedula=="")||(nombre_e=="")||(apellido_e=="")||(observacion_p=="")||(fecha==""))
      { 
            

            if(expediente==""){
              $("#expediente").focus();
              MensajeDatosNone();
            }else
            if(cedula==""){
              $("#cedula").focus();
              MensajeDatosNone();
            }else 
            if(nombre_e==""){
              $("#nombre_e").focus();
              MensajeDatosNone();
            }else
            if(apellido_e==""){
              $("#apellido_e").focus();
              MensajeDatosNone();
            }else 
            if(observacion_p==""){
              $("#observacion").focus();
              MensajeDatosNone();
            }else 
            if(fecha==""){
              $("#fecha_r").focus();
              MensajeDatosNone();
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
        message:'¡Campos Vacios!...'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}


function MensajeMinimo_Caracteres()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡La Cédula Es Muy Corta!'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}


function MensajeMinimo_CaracteresExp()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡El Expediente Es Muy Corto!'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeMinimo_CaracteresCod()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡El Codigo Es Muy Corto!'
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
        message:'¡Formato De La Fecha Incorrecto!'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeError_Fecha_Menor()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡La Fecha Fin Es Menor A La Fecha De Inicio!'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeError_Fecha_Igual()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡Los Rangos De Fechas Son Iguales!'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}
//<<<<<<<<------------------F I N MESNAJES--////////

















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




//////////---------------------VALIDACIONES DE MAXIMO, MINIMO, NUMEROS Y LETRAS-------------------->>>
//--------------------------------------VALIDACION DE ESPECIALIDAD------------------------------->>>

                    $('#nombre').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                    $('#descripcion').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789 ');
                    
                    //---NOMBRE
                    $('#nombre').on('keypress', function (e) {
                            
                           
                          var cadena = $("#nombre").val();
                         
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<45){
                                    
                                }
                                else {
                                    $("#nombre").val(cadena.substring(0,$("#nombre").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;

                              if(key==13)
                              $('#tipo_e').focus();
                              });

                                //---TIPO ESÉCIALIDAD
                                $('#tipo_e').on('change', function (e) {
                
                                            //---SALTAR AL OTRO CAMPO CON ENTER--->>
                                          $('#estatus').focus();
                                          });
//---ESTATUS
                                $('#estatus').on('change', function (e) {
                
                                            //---SALTAR AL OTRO CAMPO CON ENTER--->>
                                          $('#descripcion').focus();
                                          });

                                //---DESCRIPCION
                                $('#descripcion').on('keypress', function (e) {
                                 
                                 var cadena = $("#descripcion").val();
                                   
                                            //Comprobamos la longitud de caracteres
                                            if (cadena.length<100){
                                                
                                            }
                                            else {
                                                $("#descripcion").val(cadena.substring(0,$("#descripcion").val().length-1));
                                                MensajeMaximo_Caracteres();//----MENSAJE...
                                            }
                                            //---SALTAR AL OTRO CAMPO CON ENTER--->>
                                          var key = e.keyCode || e.which;
                                          if(key==13)
                                          $('#Registrar').focus();
                                          });


//-----------------------------------FIN DE VALIDACION DE ESPECIALIDAD------------------------------->>>

$("#Asignar_TutorAcademico").hide();

$('#estudiantesss').click(function(){

    $("#Asignar_Estudiante").show();
    $("#Asignar_TutorAcademico").hide();     

});
$('#tutorrr').click(function(){

    $("#Asignar_Estudiante").hide();
    $("#Asignar_TutorAcademico").show();     

});


//----------------------------------FORMULARIO DE ASIGNACION ESTUDIANTE----------------------------->>
                    
                    $('#expediente').validCampoFranz('0123456789');
                    $('#cedula').validCampoFranz('0123456789');
                    $('#nombre_e').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                    $('#apellido_e').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                    $('#observacion').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789 ');
                     
                            

                    //----EXPEDIENTE
                    $('#expediente').on('keypress', function (e) {
            
                          var ultimocaracter = $("#expediente").val();

                          var cadena =ultimocaracter.substring($("#expediente").val().length-1);
                          if(cadena != 0 && cadena != 1 &&
                             cadena != 2 && cadena != 3 &&
                             cadena != 4 && cadena != 5 &&
                             cadena != 6 && cadena != 7 &&
                             cadena != 8 && cadena != 9 ) {
                             $("#expediente").val(ultimocaracter.substring(0,$("#expediente").val().length-1));}
                          
                                //Comprobamos la longitud de caracteres
                                if (ultimocaracter.length<7){
                                    
                                }
                                else {
                                    $("#expediente").val(ultimocaracter.substring(0,$("#expediente").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...

                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                                  var key = e.keyCode || e.which;
                                  if(key==13)
                                  $('#cedula').focus();
                                  });

                    
                                
                                $('#cedula').click(function(){
                                    //alert();
                                    var cadena = $("#expediente").val();
                                    if(cadena.length<4){
                                         MensajeMinimo_CaracteresExp();//----MENSAJE...
                                        $('#expediente').focus();
                                    }else{}
                                    
                               });

                        //---CEDULA
                    $('#cedula').on('keypress', function (e) {
    
                          var cadena = $("#cedula").val();

                          var ultimocaracter =cadena.substring($("#cedula").val().length-1);
                          if(ultimocaracter != 0 && ultimocaracter != 1 &&
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
                              $('#nombre_e').focus();
                              });

                                    
                                    $('#nombre_e,#apellido_e,#observacion').click(function(){
                                    //alert();
                                    var cadena = $("#cedula").val();
                                    if(cadena.length<7){
                                       MensajeMinimo_Caracteres();//----MENSAJE...
                                        $('#cedula').focus();
                                    }else{}
                                    
                               });        


                    //---NOMBRE
                    $('#nombre_e').on('keypress', function (e) {
    
                          var cadena = $("#nombre_e").val();

                          var ultimocaracter =cadena.substring($("#nombre_e").val().length-1);
                                                   
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#nombre_e").val(cadena.substring(0,$("#nombre_e").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#apellido_e').focus();
                              });


                    //---APELLIDO
                    $('#apellido_e').on('keypress', function (e) {
    
                     var cadena = $("#apellido_e").val();

                          var ultimocaracter =cadena.substring($("#apellido_e").val().length-1);
                                                   
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#apellido_e").val(cadena.substring(0,$("#apellido_e").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#fecha').focus();
                              });


                    //---FECHA
                    $('#fecha').on('click', function (e) {

                            //---SALTAR AL OTRO CAMPO CON ENTER--->>
                             
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
                              $('#Asignar_Estudiante').focus();
                              });
//--------------------------FIN DE FORMULARIO DE ASIGNACION DE ESTUDIANTE--------------------------------->>

//----------------------------------FORMULARIO DE ASIGNACION TUTOR ACADEMICO----------------------------->>

                    $('#codigo').validCampoFranz('0123456789');
                    $('#cedula_TA').validCampoFranz('0123456789');
                    $('#nombre_TA').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                    $('#apellido_TA').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                    $('#observacion_TA').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789 ');

                    //----CODIGO
                    $('#codigo').on('keypress', function (e) {
            
                          var ultimocaracter = $("#codigo").val();

                          var cadena =ultimocaracter.substring($("#codigo").val().length-1);
                          if(cadena != 0 && cadena != 1 &&
                             cadena != 2 && cadena != 3 &&
                             cadena != 4 && cadena != 5 &&
                             cadena != 6 && cadena != 7 &&
                             cadena != 8 && cadena != 9 ) {
                             $("#codigo").val(ultimocaracter.substring(0,$("#codigo").val().length-1));}
                          
                                //Comprobamos la longitud de caracteres
                                if (ultimocaracter.length<7){
                                    
                                }
                                else {
                                    $("#codigo").val(ultimocaracter.substring(0,$("#codigo").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...

                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                                  var key = e.keyCode || e.which;
                                  if(key==13)
                                  $('#cedula_TA').focus();
                                  });

                                    $('#cedula_TA').click(function(){
                                        //alert();
                                        var cadena = $("#codigo").val();
                                        if(cadena.length<3){
                                            MensajeMinimo_CaracteresCod();//----MENSAJE...
                                            $('#codigo').focus();
                                        }else{}
                                        
                                   });


                    //---CEDULA
                    $('#cedula_TA').on('keypress', function (e) {
    
                          var cadena = $("#cedula_TA").val();

  
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<9){
                                    
                                }
                                else {
                                    $("#cedula_TA").val(cadena.substring(0,$("#cedula_TA").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#nombre_TA').focus();
                              });

                                $('#nombre_TA,#apellido_TA,#observacion_TA').click(function(){
                                        //alert();
                                        var cadena = $("#cedula_TA").val();
                                        if(cadena.length<7){
                                            MensajeMinimo_Caracteres();//----MENSAJE...
                                            $('#cedula_TA').focus();
                                        }else{}
                                        
                                   });


                    //---NOMBRE
                    $('#nombre_TA').on('keypress', function (e) {
    
                          var cadena = $("#nombre_TA").val();

                          var ultimocaracter =cadena.substring($("#nombre_TA").val().length-1);
                                                    
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#nombre_TA").val(cadena.substring(0,$("#nombre_TA").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#apellido_TA').focus();
                              });


                    //---APELLIDO
                    $('#apellido_TA').on('keypress', function (e) {
    
                     var cadena = $("#apellido_TA").val();

                          var ultimocaracter =cadena.substring($("#apellido_TA").val().length-1);
                                                    
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#apellido_TA").val(cadena.substring(0,$("#apellido_TA").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#observacion_TA').focus();
                              });


                    


                    //---OBSERVACION
                    $('#observacion_TA').on('keypress', function (e) {
                     
                     /*var FechaForm = $("#fecha").val();
                     var d = new Date(); 
                     var FechaHoy = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

                     if(FechaForm<FechaHoy){
                        alert("fecha mayor")
                     }*/

                     var cadena = $("#observacion_TA").val();
                       
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<100){
                                    
                                }
                                else {
                                    $("#observacion_TA").val(cadena.substring(0,$("#observacion_TA").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#Asignar_TutorAcademico').focus();
                              });
//--------------------------FIN DE FORMULARIO DE ASIGNACION DE  TUTOR ACADEMICO--------------------------------->>

//////////----------------VALIDACIONES DE MAXIMO, MINIMO, NUMEROS Y LETRAS------------------------------->>>












//T A B L A  TRADUCIR---->>>

$(document).ready(function(){


$('#Table').dataTable({  

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
        "iDisplayLength": 5
        });



$('#myTable').dataTable({  

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
        "sSortAscending" :  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        },
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5
        });

$('#myTable2').dataTable({  

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




});










