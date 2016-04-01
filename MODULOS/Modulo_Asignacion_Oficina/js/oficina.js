Autocomplete();
Autocomplete_personasCedula();

$(document).ready(function(){

    showselect_PersonasAsignadas_OFICINAS('');
    showselectOficinaAsignadas('');
    showselectOFICINASasignarPersonas('');
    showselectOficinaAsignadar('');
});

//-----RECARGAR BODY--->>>
function restablecerForm()
{
        $("#nombre").val("");
        $("#estado").val("");
        $("#descripcion").val("");
        $("#nombre_o").val("");
        $("#descripcion_o").val("");

        $("#cedula").val("");
        $("#nombre_p").val("");
        $("#nombre_p").attr("disabled", false);
        $("#apellido_p").val("");
        $("#apellido_p").attr("disabled", false);
        $("#observacion_p").val("");
        $("#perfil").val("");
        $("#nombre_oficina_asignarP").val("");

       
        $("#nombre").attr("disabled", true);
        $("#estado").attr("disabled", true);
        $("#descripcion").attr("disabled", true);

        $("#Cancelar").attr("disabled", true);
        $("#Modificar").attr("disabled", true);

        showselectOficinaAsignadas('');
        showselectOficinaAsignadar('');
        showselectOFICINASasignarPersonas('');
        showselect_PersonasAsignadas_OFICINAS('');
        Autocomplete();
        

  
}




// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {

        $("#nombre").attr("disabled", true);
        $("#estado").attr("disabled", true);
        $("#descripcion").attr("disabled", true);

    $("#Modificar").click(function(){

        var verificar=ValidarCamposaSIGNACION();
        if(verificar){
            modificarOficina();
       }
        
    });



    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 


    $("#cerrar").click(function(){

 
            restablecerForm();
    }); 



});



//---CUANDO SE HACE CLIC EN EL BOTON DE CANCELAR--->>>
    $(document).ready(function() {
    
});


  // CUANDO SE HACE  CLICK  EN EL BOTON REGISTRAR
    // Bloqueam
    $(document).ready(function() {
    $("#Registrar").click(function(){

        var verificar=ValidarCamposaSIGNACION_Nueva();
        if(verificar){
            Registrar_y_AsignarOficina();
        }
      

        
    }); 
});















    ////////////////////////

function modificarOficina(){
    
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

            Modificar           : boton

              },
              
success: function(data){ 
  var result = $.trim(data);

  //alert(data);

    if(data==1){

    swal("Ud. No Modifico Ningun Campo!");
    restablecerForm();
  
    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error");
    restablecerForm();

    }else if(data==2) {
        
    swal("Oficina Modificada Exitosamente!",'', "success");
    restablecerForm();

    }else if(data==3) {
        
    swal("El Nombre Ya Esta Registrado");
    restablecerForm();

    }else if(data==4) {
        
    swal("Esta Oficina No Puede Ser Modificada Porque Es La Principal", "", "error");
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

  //alert(data)


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

  //alert(data)

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

  //alert(data)

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

  //alert(data)

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

    //////////////777777





function modificarAsignacion(){
    
    var porId  = document.getElementById("id_organizacion").value;
    var porId2  = document.getElementById("id_oficina").value;
    var porId3 = document.getElementById("nombre").value;
    var porId4 = document.getElementById("estado").value;
    var porId5 = document.getElementById("descripcion").value;

    
    var boton  = "actualiza";
   
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/ActionPerformed.php",
        data: {
            id_organizacion : porId,      
            id_oficina : porId2,
            nombre : porId3,
            estatus :porId4,
            descripcion :porId5,
            actualiza : boton

              },
              
success: function(data){ 
  var result = $.trim(data);

  
    if(result>0){
    swal("Modificación Exitosa!",'', "success");
   

    }else {    
    swal("Estatus No Modificado", "", "error");         
    
    }
    restablecerForm();
    }
    });
    
}




function Registrar_y_AsignarOficina(){

    var id_o  = document.getElementById("id_organizacion").value;
    var nombre  = document.getElementById("nombre_o").value;
    var estatus = document.getElementById("estatus_o").value;
    var descripcion = document.getElementById("descripcion_o").value;

    
    var boton  = "Registra";
 
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/ActionPerformed.php",
        data: {
            id_organizacion     : id_o,
            nombre              : nombre,      
            estatus             : estatus,
            descripcion         : descripcion,

            Registrar           : boton

              },
              
success: function(data){ 

  var result = $.trim(data);

  //alert(result);
    if(result==1){
      

    swal("Este Nómbre Ya Existe", "", "error");
    
    }else if(result==0) {    
    swal("A Ocurrido Un Error Al Asignar", "", "error");          
    

    }else if(result==2) {    
    swal("Registro y Asignacion Con Exito!",'', "success");          
    
    }
    restablecerForm();
    $('#tabla2').modal('hide');
    }
    });



}



//  SELECCIONAR FILA DELA TABLA PARA ASIGNAR

function seleccionarfila_ParaAsignar(tr){
    
                var id_organizacion= document.getElementById("id_organizacion").value;
                var id_oficina="";

                var filtro  = "Asignar";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .oficina_asignar').each(function() {
                  
                  id_oficina  = $(tr).find("td").eq(0).text();
                  descripcion  = $(tr).find("td").eq(2).text();
                  
                  

                  });
          
                            $.ajax({
                            async:true, 
                            cache:false,
                            dataType:"html", 
                            type: 'POST',   
                            url: "../controlador/ActionPerformed.php",
                            data: {
                                ID_ORGANIZACION : id_organizacion,      
                                ID_OFICINA : id_oficina,
                                DESCRIPCION: descripcion,                                
                                Asignare : filtro

                                  },
                                  
success: function(data){ 
       
  var result = $.trim(data);

    if(result==1){
      

    swal("Esta Asignación Ya Existe", "", "error"); 
    
    }else if(result==0) {    
    swal("A Ocurrido Un Error En La Asignación", "", "error");          
    
    }else if(result==2){    
    swal("Asignacion Exitosa!",'', "success");          
    
    }

    restablecerForm();
    $('#tabla').modal('hide');

    }
    });
        
        //$("#Modificar").attr("disabled",false);
        //$("#Cancelar").attr("disabled",false);

} 






//----AUTOCOMPLETADO
function Autocomplete() {

    //alert("pasooo");
    var boton  = "auto";
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Departamento/controlador/Gestion_Oficina_Controller.php",
        data: {
            

            autocompletado : boton

              },
              

    success: function(data){  
         
          var variable = JSON.parse(data);

            variable = toObject(variable);
                    $('#nombre_o').typeahead({

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

    arregloPivote[index] = values.nombre_oficina;

  });

  Arreglote['datos'] =arregloPivote;

  return Arreglote;
}
//----FIN DE AUTOCOMPLETADP



//---CAMPO DE LA CEDULA
function Autocomplete_personasCedula() {

    
    var boton  = "auto";
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Departamento/controlador/Gestion_Especialidad_Controller.php",
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
        url: "../../Modulo_Departamento/controlador/Gestion_Especialidad_Controller.php",
        data: {
          BuscarTodosDatosCedulaSeleccionada :cedula
              },              
    
        success: function(data){  
            var Variable = JSON.parse(data);

              $("#nombre_p").val(Variable.nombre);
              $("#apellido_p").val(Variable.apellido);
              $("#nombre_p").attr("disabled", true);
              $("#apellido_p").attr("disabled", true);
            
            
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
        url: "../../Modulo_Departamento/controlador/Gestion_Especialidad_Controller.php",
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









//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR

function seleccionarfila(tr){
    
        $("#nombre").attr("disabled", false);
        $("#estado").attr("disabled", false);
        $("#descripcion").attr("disabled", false);
  
                var id_oficina="";
                var nombre="";
                var estatus="";
                var descripcion="";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .oficina').each(function() {
                  
                  id_oficina  = $(tr).find("td").eq(0).text();
                  nombre = $(tr).find("td").eq(1).text();
                  estatus  = $(tr).find("td").eq(3).text();
                  descripcion  = $(tr).find("td").eq(2).text();
                  

                  });
          $("#id_oficina").val(id_oficina); 
          $("#nombre").val(nombre); 
          $("#descripcion").val(descripcion); 
          $("#estado option[value="+ estatus +"]").attr("selected",true);
       
        
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);
        
    // $("#superidOrganizacion").val();


    //var sigla= $("td .municipio").text(); // -------- TODAS  LAS  COLUMNAS
    //$("#titlee").html(sigla);
    

    // El Codigo Malandro Super Tukki ..!
    // Gracias stack overflow ...


} 




//-------RECARGAR TABLA OFICINA--->>>>
function showselectOficinaAsignadas(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/ActionPerformed.php",
                dataType: "html",
                data: {
                  id_organizacion:$("#id_organizacion").val(),
                  Tabla_OficinaAsignada:'ofcourse'
                },
                success: function (data) {
                    //alert(data);
                    var Variable = JSON.parse(data);
                    var html = "";
                    
                    $.each(Variable, function(index, value){

                    html +="<tr  class='oficina' onclick=seleccionarfila(this); style=cursor:pointer  >"+
                    " <td hidden><center>"+Variable[index].id_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td ><center>"+Variable[index].estado+"</center></td>"+
                    " <td><center><img src=../../../img/iconos/edit.png alt=Ginger class=left width=20 ></center></td>"+
                    " </tr>" ;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaOFICINA(html);
                    
                }

            });

      }
        

      function ArmarTablaOFICINA (html)
      {


        $("#myTable ").empty();
        $("#myTable ").append(html);
        $('#myTable ').dataTable().fnDestroy();
        $('#myTable ').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null
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
//----FIN DE RECARGAR TABLA OFIICNA--->>


//-------RECARGAR TABLA OFICINAAsigbnar--->>>>
function showselectOficinaAsignadar(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/ActionPerformed.php",
                dataType: "html",
                data: {
                  //id_organizacion:$("#id_organizacion").val(),
                  Tabla_OficinaAsignar:'ofcourse'
                },
                success: function (data) {
                    //alert(data);
                    var Variable = JSON.parse(data);
                    var html = "";
                    var contador=0;
                    $.each(Variable, function(index, value){

                    html +="<tr  class='oficina_asignar' onclick=seleccionarfila_ParaAsignar(this); style=cursor:pointer  >"+
                    " <td hidden><center>"+Variable[index].id_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td><center><img src=../../../img/iconos/add.png alt=Ginger class=left width=18 ></center></td>"+
                    " </tr>" ;
                    contador++;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaOFICINAAsignar(html);
                    
                }

            });

      }
        

      function ArmarTablaOFICINAAsignar (html)
      {

        $("#myTable2 ").empty();
        $("#myTable2 ").append(html);
        $('#myTable2 ').dataTable().fnDestroy();
        $('#myTable2 ').dataTable({ // Cannot initialize it again error
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
        },
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5,
        'order': [1, 'asc']
        }); 
                     
      }
//----FIN DE RECARGAR TABLA OFIICNA--->>






//-------RECARGAR TABLA ASIGNARp PERRSONAS--->>>>
function showselectOFICINASasignarPersonas(str){

                
                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/ActionPerformed.php",
                dataType: "html",
                data: {
                  id_organizacion:$("#id_organizacion").val(),
                  Tabla_OficinaAsignarPersonas:'ofcourse'
                },
                success: function (data) {
                    //alert(data);
                    var Variable = JSON.parse(data);
                    var html = "";
                    var contador=0;
                    $.each(Variable, function(index, value){

                    html +="<tr href='#tablaPersonas'   data-toggle='modal' class='oficina_AsignarPersonas' onclick='seleccionarfila_AsignarPersonas(this)'; style=cursor:pointer  >"+
                    " <td hidden><center>"+Variable[index].id_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td ><center>"+Variable[index].estado+"</center></td>"+
                    " <td><center><img src=../../../img/iconos/add-group.png alt=Ginger class=left width=20 ></center></td>"+
                    " </tr>" ;
                    contador++;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaOFICINAAsignarPersonas(html);
                    
                }

            });

      }
        

      function ArmarTablaOFICINAAsignarPersonas (html)
      {

        $("#myTable3 ").empty();
        $("#myTable3 ").append(html);
        $('#myTable3 ').dataTable().fnDestroy();
        $('#myTable3 ').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null
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
//----FIN DE RECARGAR TABLA OFIICNA ASIGNARp PERRSONAS--->>





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
                    html +="<tr   >"+
                    " <td hidden><center>"+Variable[index].id_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion+"</center></td>"+
                    " <td ><center>"+Variable[index].estado +"</center></td>"+
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


        $("#myTable4 ").empty();
        $("#myTable4 ").append(html);
        $('#myTable4 ').dataTable().fnDestroy();
        $('#myTable4 ').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null,null,null,null,null
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
        'order': [4, 'asc']
        }); 
                     
      }
//----FIN DE RECARGAR TABLA  PERSONAS ASIGNADAS--->>


//------ASIGNAR PERSONAS----->>>

function seleccionarfila_AsignarPersonas(tr){
    
                var id_organizacion= document.getElementById("id_organizacion").value;
                var id_oficina="";

                
                var filtro  = "Asignar";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .oficina_AsignarPersonas').each(function() {
                  
                  id_oficina  = $(tr).find("td").eq(0).text();
                  oficina  = $(tr).find("td").eq(1).text();
                  
                  });

                
          
                $("#id_oficina_asignarP").val(id_oficina);
                $("#id_organizacion_asignarP").val(id_organizacion);
                $("#nombre_oficina_asignarP").val(oficina);
        



}


// CUANDO SE HACE  CLICK  EN EL BOTON ASIGNAR
    // Bloqueam
    $(document).ready(function() {
    $("#Asignar_Personas").click(function(){

        var validar=ValidarCampos_Personas();
        if(validar){
            Asignar_PersonasOficina_Organizacion();
        }
    }); 
});

//-----ASIGNAR PERSONA A LA PERSONAS OFICINA--->>>

function Asignar_PersonasOficina_Organizacion(){

    var id_oficina_asignar                  = document.getElementById("id_oficina_asignarP").value;
    var id_organizacion_asignar             = document.getElementById("id_organizacion_asignarP").value;
    var cedula                              = document.getElementById("cedula").value;
    var nombre_p                            = document.getElementById("nombre_p").value;
    var apellido_p                          = document.getElementById("apellido_p").value;
    var fecha                               = document.getElementById("fecha").value;
    var observacion                         = document.getElementById("observacion_p").value;
    var perfil                              = document.getElementById("perfil").value;
    
     
    var boton  = "Asignar_Estudiante";

    //alert(id_especialidad_asignar+id_instituto_asignar+expediente+cedula+nombre_e+apellido_e+fecha+observacion);
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Departamento/controlador/Gestion_Oficina_Controller.php",
        data: {

            id_oficina             : id_oficina_asignar,
            id_organizacion        : id_organizacion_asignar,      
            cedula_p               : cedula,
            nombre_p               : nombre_p,
            apellido_p             : apellido_p,
            fecha                  : fecha,
            observacion            : observacion,
            perfil                 : perfil,

            Asignar_Persona    : boton

              },
              
success: function(data){ 

//alert(data);

    if(data==0){
      
    swal("A Ocurrido Un Error Al Asignar", "", "error"); 

    }else if(data==1) {
        
    swal("Asignación Exitosa!",'', "success"); 

    }else if(data==2) {
        
    swal("Esta Persona Ya Está Registrada", "", "error"); 

    }
    restablecerForm();
    $('#tablaPersonas').modal('hide');
    }
    });



} 




















//--------------VALIDACIONES--------

function ValidarCamposaSIGNACION()
{
    var nombre = document.getElementById("nombre").value;
    var estatus  = document.getElementById("estado").value;
    



    if((nombre=="")||(estatus==""))
      { 
            MensajeDatosNone();

            if(nombre==""){
              $("#nombre").focus();
            }else 
            if(estatus==""){
              $("#estado").focus();
            }
        
            return false;

      }else {

                return true;
        }
        

      }


      function ValidarCamposaSIGNACION_Nueva()
{
    var nombre = document.getElementById("nombre_o").value;
    var estatus  = document.getElementById("estatus_o").value;
    



    if((nombre=="")||(estatus==""))
      { 
            MensajeDatosNone();

            if(nombre==""){
              $("#nombre_o").focus();
            }else 
            if(estatus==""){
              $("#estatus_o").focus();
            }
        
            return false;

      }else {

                return true;
        }
        

      }



function ValidarCampos_Personas()
    {

        var cedula = document.getElementById("cedula").value
        var nombre_p = document.getElementById("nombre_p").value;
        var apellido_p  = document.getElementById("apellido_p").value;
        var fecha = document.getElementById("fecha").value
        var observacion_p = document.getElementById("observacion_p").value;
        var perfil = document.getElementById("perfil").value;
        


    if((cedula=="")||(nombre_p=="")||(apellido_p=="")||(fecha=="")||(observacion_p=="")||(perfil==""))
      { 
            

            if(cedula==""){
              $("#cedula").focus();
              MensajeDatosNone();
            }else 
            if(nombre_p==""){
              $("#nombre_p").focus();
              MensajeDatosNone();
            }else
            if(apellido_p==""){
              $("#apellido_p").focus();
              MensajeDatosNone();
            }else 
            if(fecha==""){
              $("#fecha").focus();
              MensajeError_Fecha();
            }else
            if(observacion_p==""){
              $("#observacion_p").focus();
              MensajeDatosNone();
            }else
            if(perfil==""){
              $("#perfil").focus();
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
                    $('#nombre_p').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#apellido_p').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#observacion_p').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789');

                    $("#nombre_o").validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#descripcion_o').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789');

                    //---NOMBRE
                    $('#nombre_o').on('keypress', function (e) {
    
                          var cadena = $("#nombre_o").val();

                          var ultimocaracter =cadena.substring($("#nombre_o").val().length-1);
                                                  
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#nombre_o").val(cadena.substring(0,$("#nombre_o").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#estatus_o').focus();
                              });


                    //---ESTATUS
                    $('#estatus_o').on('change', function (e) {
    
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              $('#descripcion_o').focus();
                              });

                    //---DESCRIPCION
                    $('#descripcion_o').on('keypress', function (e) {

                     var cadena = $("#descripcion_o").val();
                       
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<100){
                                    
                                }
                                else {
                                    $("#descripcion_o").val(cadena.substring(0,$("#descripcion_o").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#Registrar').focus();
                              });


                    
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
                                if (cadena.length<10){
                                    
                                }
                                else {
                                    $("#cedula").val(cadena.substring(0,$("#cedula").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#nombre_p').focus();

                              });

                        $('#nombre_p,#apellido_p,#fecha,#observacion_p').click(function(){
                                    var cadena = $("#cedula").val();
                                    if(cadena.length<7){
                                        MensajeMinimo_Caracteres();//----MENSAJE...
                                        $('#cedula').focus();
                                    }else{}
                                    
                               });


                    //---NOMBRE
                    $('#nombre_p').on('keypress', function (e) {
    
                          var cadena = $("#nombre_p").val();

                          var ultimocaracter =cadena.substring($("#nombre_p").val().length-1);
                                                   
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#nombre_p").val(cadena.substring(0,$("#nombre_p").val().length-1));
                                    MensajeMaximo_Caracteres();//----MENSAJE...
                                }
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              var key = e.keyCode || e.which;
                              if(key==13)
                              $('#apellido_p').focus();
                              });


                    //---APELLIDO
                    $('#apellido_p').on('keypress', function (e) {
    
                     var cadena = $("#apellido_p").val();

                          var ultimocaracter =cadena.substring($("#apellido_p").val().length-1);
                                                    
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<25){
                                    
                                }
                                else {
                                    $("#apellido_p").val(cadena.substring(0,$("#apellido_p").val().length-1));
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
                              $('#observacion_p').focus();
                              });


                    //---OBSERVACION
                    $('#observacion_p').on('keypress', function (e) {
                     
                     /*var FechaForm = $("#fecha").val();
                     var d = new Date(); 
                     var FechaHoy = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

                     if(FechaForm<FechaHoy){
                        alert("fecha mayor")
                     }*/

                     var cadena = $("#observacion_p").val();
                       
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<100){
                                    
                                }
                                else {
                                    $("#observacion_p").val(cadena.substring(0,$("#observacion_p").val().length-1));
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








