        
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

        Renderidng_select();

        showselectOficina('');
        showselectOFICINA_AsignarPersonas('');
        showselect_PersonasAsignadas_OFICINAS('');
        Autocomplete();
        Autocomplete_personasCedula();
        });

    function Renderidng_select(){

        $(".selectboxit-container .selectboxit").css({"min-width": "206px" , "width": "206px" ,  "height": "35px"});
}



// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {
    $("#Modificar").click(function(){

        var Campos=ValidarCampos();
        
        if(Campos){
            modificarOficina();
        }
      
    
    });

    $("#cerrar").click(function(){

        restablecerForm();
      
    
    }); 



    $("#Registrar").click(function(){

        var Campos=ValidarCampos();
        
        if(Campos){
            Registrar_Oficina();
        }
       
    
    });


    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 



    $("#Reporte_PersonasOficina_Fecha").click(function(){

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

            }else {
                Reporte_PersonasOficinaFecha();
            }
            
    }); 





});







//-----RECARGAR BODY--->>>
function restablecerForm()
{
        $("#nombre").val("");
        $("#estatus").val("");
        $("#estatus").data("selectBoxIt").refresh();
        $("#descripcion").val("");

        //PERSONA
        
        $("#cedula").val("");
        $("#nombre_p").val("");
        $("#apellido_p").val("");
        $("#observacion_p").val("");
        $("#perfil").val("");
        $("#nombre_oficina_asignarP").val("");

        $("#nombre_p").attr("disabled", false);
        $("#apellido_p").attr("disabled", false);
        

        $("#Registrar").attr("disabled", false);
        $("#Modificar").attr("disabled", true);

        showselectOficina('');
        showselectOFICINA_AsignarPersonas('');
        showselect_PersonasAsignadas_OFICINAS('');
        Autocomplete();
        Autocomplete_personasCedula();

        Renderidng_select();
    
}



function Reporte_PersonasOficinaFecha(){

    
    var fecha_i           = $("#fecha_i").val();
    var fecha_f           = $("#fecha_f").val();
    
     
    var boton  = "ReporteFecha";

    //alert(fecha_i+"--"+fecha_f);
    
      
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
        data: {

            
            fecha_i            : fecha_i,
            fecha_f            : fecha_f,

            Reporte_PE_PorFecha    : boton

              },

        success: function(data){ 

                var Variable = JSON.parse(data);
            //alert(Variable);
            if (Variable=='ReporteFecha'){
                window.open('../controlador/Gestion_Oficina_Controller.php');
            } 

    
    }
              

    });



}



function Registrar_Oficina(){


    
    var id_organizacion_p  = document.getElementById("id_organizacion_p").value;
    var nombre  = document.getElementById("nombre").value;
    var estatusS = document.getElementById("estatus").value;
    var descripcionS = document.getElementById("descripcion").value;

   
    
    var boton  = "Registra";
   
    //alert(nombre+descripcionS);

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
        data: {
            
            id_organizacion_p   : id_organizacion_p,
            nombre              : nombre,
            estatus             : estatusS,
            descripcion         : descripcionS,

            Registrar           : boton

              },
              
success: function(data){ 
  var result = $.trim(data);

    //alert(data);

    if(data==1){
      
     swal("El Nombre Ya Existe");

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error");

    }else if(data==2) {
        
    swal("Oficina Registrada Exitosamente!",'', "success");
    }
    restablecerForm();
    }
    });



}


function modificarOficina(){
    
    var id_organizacion_p   = document.getElementById("id_organizacion_p").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estatus").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
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

  alert(result);

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
    
    var id_organizacion_p   = document.getElementById("id_organizacion_p").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estatus").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
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
    
    var id_organizacion_p   = document.getElementById("id_organizacion_p").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estatus").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
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
    
     var id_organizacion_p   = document.getElementById("id_organizacion_p").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estatus").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
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
    
    var id_organizacion_p   = document.getElementById("id_organizacion_p").value;
    var id_oficina          = document.getElementById("id_oficina").value;
    var nombre              = document.getElementById("nombre").value;
    var estatusS            = document.getElementById("estatus").value;
    var descripcionS        = document.getElementById("descripcion").value;

    //alert(id_organizacion_p+id_oficina+nombre+estatusS+descripcionS);
    var boton  = "actualiza";
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
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



//SELECCIONAR FILA DELA TABLA PARA MODIFICAR

function seleccionarfila(tr){
    
                var id_oficina="";
                var nombre="";
                var estatus="";
                var descripcion="";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .oficina').each(function() {
                  
                  id_oficina        = $(tr).find("td").eq(0).text();
                  nombre            = $(tr).find("td").eq(1).text();
                  descripcion       = $(tr).find("td").eq(2).text();
                  estatus           = $(tr).find("td").eq(3).text();
                  
                  

                  });

          $("#id_oficina").val(id_oficina); 
          $("#nombre").val(nombre); 
          $("#estatus").val(estatus);
          $("#estatus").data("selectBoxIt").refresh();
          $("#descripcion").val(descripcion); 
       
            $("#Registrar").attr("disabled",true);
            $("#Modificar").attr("disabled",false);
            $("#Cancelar").attr("disabled",false);

        Renderidng_select();
} 




//-------RECARGAR TABLA OFICINA--->>>>
function showselectOficina(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Oficina_Controller.php",
                dataType: "html",
                data: {
                  id_organizacion:$("#id_organizacion_p").val(),
                  Tabla_Oficina:'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";
                    
                    $.each(Variable, function(index, value){

                    html +="<tr  class='oficina' onclick=seleccionarfila(this);  style=cursor:pointer>"+
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


        $("#mYTable").empty();
        $("#mYTable").append(html);
        $('#mYTable').dataTable().fnDestroy();
        $('#mYTable').dataTable({ // Cannot initialize it again error
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


//-------RECARGAR TABLA OFICINA PARA ASIGTNAR PERSONAS--->>>>
function showselectOFICINA_AsignarPersonas(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Oficina_Controller.php",
                dataType: "html",
                data: {
                  id_organizacion:$("#id_organizacion_p").val(),
                  TablaE_AsignarPersonas:'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";
                    var contador=0;
                    $.each(Variable, function(index, value){
                   
                    html +="<tr href='#tablaPersonas'  data-toggle='modal'  class='oficina_AsignarPersonas' onclick='seleccionarfila_AsignarPersonas(this)'; style=cursor:pointer >"+
                    " <td hidden><center>"+Variable[index].id_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_oficina+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td ><center>"+Variable[index].estado+"</center></td>"+
                    " <td ><center><img src=../../../img/iconos/add-group.png alt=Ginger class=left width='20' ></center></td>"+
                    " </tr>" ;
                    contador++;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaOFICINA_AsignarP(html);
                    
                }

            });

      }
        

      function ArmarTablaOFICINA_AsignarP (html)
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
//----FIN DE RECARGAR TABLA ESPECIALIDAD PARA ASIGNAR PERSONAS--->>

//-------RECARGAR TABLA OFICINA  PERSONAS ASIGNADAS--->>>>
function showselect_PersonasAsignadas_OFICINAS(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Oficina_Controller.php",
                dataType: "html",
                data: {
                  id_organizacion:$("#id_organizacion_p").val(),
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
                   
                    html +="<tr  >"+
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


        $("#myTable2 ").empty();
        $("#myTable2 ").append(html);
        $('#myTable2 ').dataTable().fnDestroy();
        $('#myTable2 ').dataTable({ // Cannot initialize it again error
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


//--------------------VALIDACIONES--------------  >>>



function ValidarCampos()
{
    var nombre = document.getElementById("nombre").value;
    var estatus  = document.getElementById("estatus").value;
    


    if((nombre=="")||(estatus==""))
      { 
            MensajeDatosNone();

            if(nombre==""){
              $("#nombre").focus();
            }else 
            if(estatus==""){
              $("#estatus").focus();
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
        var observacion_p = document.getElementById("observacion_p").value;
        var perfil = document.getElementById("perfil").value;
        


    if((cedula=="")||(nombre_p=="")||(apellido_p=="")||(observacion_p=="")||(perfil==""))
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








      //--------------------VALIDACIONES--------------  >>>


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


















///////////////////////////////////////A S I G N A C IONES---------------->>>>

$(document).ready(function() {
    $("#Modificar_2").click(function(){

      modificarAsignacion();
    
    }); 
});

$(document).ready(function() {
    $("#Cancelar_2").click(function(){

 
            restablecerForm();
    }); 
});


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



//-----ASIGNAR ESTUADIANTE A LA PERSONAS OFICINA--->>>

function Asignar_PersonasOficina_Organizacion(){

    var id_oficina_asignar                  = document.getElementById("id_oficina_asignarP").value;
    var id_organizacion_asignar             = document.getElementById("id_organizacion_asignarP").value;
    var cedula                              = document.getElementById("cedula").value;
    var nombre_p                            = document.getElementById("nombre_p").value;
    var apellido_p                          = document.getElementById("apellido_p").value;
    var observacion                         = document.getElementById("observacion_p").value;
    var perfil                              = document.getElementById("perfil").value;
    
     
    var boton  = "Asignar_Estudiante";

    //alert(id_especialidad_asignar+id_instituto_asignar+expediente+cedula+nombre_e+apellido_e+fecha+observacion);
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
        data: {

            id_oficina             : id_oficina_asignar,
            id_organizacion        : id_organizacion_asignar,      
            cedula_p               : cedula,
            nombre_p               : nombre_p,
            apellido_p             : apellido_p,
            observacion            : observacion,
            perfil                 : perfil,

            Asignar_Persona        : boton

              },
              
success: function(data){ 

alert(data);

    if(data==0){
      
    swal("A Ocurrido Un Error Al Asignar", "", "error"); 

    }else if(data==1) {
        
    swal("Asignación Exitosa!",'', "success"); 

    }else if(data==2) {
        
    swal("La Persona Ya Esta Registrada En Esta Oficina", "", "error"); 

    }
    restablecerForm();
    $('#tablaPersonas').modal('hide');
    }
    });



}



function seleccionarfila_AsignarPersonas(tr){
    
                var id_organizacion= document.getElementById("id_organizacion_p").value;
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

//----AUTOCOMPLETADO
function Autocomplete() {

    //alert("pasooo");
    var boton  = "auto";
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Oficina_Controller.php",
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







function seleccionarfila_oficinas_Asignas(tr){
    

                var id_oficina="";
                var nombre="";
                var estatus="";
                var descripcion="";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .oficinas_Asignas').each(function() {
                  
                  id_oficina  = $(tr).find("td").eq(0).text();
                  nombre = $(tr).find("td").eq(1).text();
                  estatus  = $(tr).find("td").eq(3).text();
                  descripcion  = $(tr).find("td").eq(2).text();
                  

                  });
          $("#id_oficina_2").val(id_oficina); 
          $("#nombre_2").val(nombre); 
          $("#descripcion_2").val(descripcion); 
          $("#estado_2 option[value="+ estatus +"]").attr("selected",true);
       
        
        $("#Modificar_2").attr("disabled",false);
        
        
 

} 






function modificarAsignacion(){
    
    var porId  = document.getElementById("id_organizacion").value;
    var porId2  = document.getElementById("id_oficina_2").value;
    var porId3 = document.getElementById("nombre_2").value;
    var porId4 = document.getElementById("estado_2").value;
    var porId5 = document.getElementById("descripcion_2").value;

    
    var boton  = "actualiza";
   
   

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Asignacion_Oficina/controlador/ActionPerformed.php",
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
    alert("Estatus Modificado");
    $( "#page" ).load( "../vista/Gestion_Oficina.php");

    }else {    
    alert("Estatus No Modificado");          
    $( "#page" ).load( "../vista/Gestion_Oficina.php");
    }

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
        url: "../../Modulo_Asignacion_Oficina/controlador/ActionPerformed.php",
        data: {
            id_organizacion     : id_o,
            nombre              : nombre,      
            estatus             : estatus,
            descripcion         : descripcion,

            Registrar           : boton

              },
              
success: function(data){ 
  var result = $.trim(data);

  alert(result);
    if(result==1){
      

    alert("Este Nombre Ya Existe");
    $( "#page" ).load( "../vista/Gestion_Oficina.php");


    }else if(result==0) {    
    alert("Ha Ocurrido Un Error Al Insertar");          
    $( "#page" ).load( "../vista/Gestion_Oficina.php");
    }else if(result==2) {    
    alert("Registro y Asignación con Éxito");          
    $( "#page" ).load( "../vista/Gestion_Oficina.php");
    }

    }
    });



}



//  SELECCIONAR FILA DELA TABLA PARA ASIGNAR

function seleccionarfila_ParaAsignar(tr){
    
                var id_organizacion= document.getElementById("id_organizacion").value;
                var id_oficina="";
                var descripcion="";

                var filtro  = "Asignar";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .oficina_asignar').each(function() {
                  
                  id_oficina  = $(tr).find("td").eq(0).text();
                  descripcion = $(tr).find("td").eq(2).text();
                  
                  

                  });
          
                           

                            $.ajax({
                            async:true, 
                            cache:false,
                            dataType:"html", 
                            type: 'POST',   
                            url: "../../Modulo_Asignacion_Oficina/controlador/ActionPerformed.php",
                            data: {
                                ID_ORGANIZACION : id_organizacion,      
                                ID_OFICINA : id_oficina,  
                                DESCRIPCION : descripcion,                               
                                Asignare : filtro

                                  },
                                  
success: function(data){ 
  var result = $.trim(data);
   
   
  
    if(result==1){
      

    alert("Esta Asignacion Ya Existe");
    $( "#page" ).load( "../vista/Gestion_Oficina.php");


    }else if(result==0) {    
    alert("Error En La Asignación");          
    $( "#page" ).load( "../vista/Gestion_Oficina.php");
    }else if(result==2){    
    alert("Asignacion Con Exito");          
    $( "#page" ).load( "../vista/Gestion_Oficina.php");
    }

    }
    });
        
        //$("#Modificar").attr("disabled",false);
        //$("#Cancelar").attr("disabled",false);
        
   


} 







//////////---------------------VALIDACIONES DE MAXIMO, MINIMO, NUMEROS Y LETRAS-------------------->>>
//--------------------------------------VALIDACION DE OFICINA------------------------------->>>

                    $('#nombre').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                    $('#descripcion').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789 ');
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


//-----------------------------------FIN DE VALIDACION DE OFICINA------------------------------->>>





//----------------------------------FORMULARIO DE ASIGNACION PERSONAS----------------------------->>
                    
                    $('#cedula').validCampoFranz('0123456789');
                    $('#nombre_p').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                    $('#apellido_p').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                    $('#observacion_p').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789 ');
                    
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
                                    //alert();
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
                              $('#observacion_p').focus();
                              });



                    //---OBSERVACION
                    $('#observacion_p').on('keypress', function (e) {
                     
                     

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

//////////----------------VALIDACIONES DE MAXIMO, MINIMO, NUMEROS Y LETRAS------------------------------->>>





//T A B L A  TRADUCIR---->>>

$(document).ready(function(){


$('#mYTable').dataTable({  

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



$('#myTable3').dataTable({  

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
        "iDisplayLength": 5
        });

$('myTable2').dataTable({  

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
        "iDisplayLength": 5
        });




});