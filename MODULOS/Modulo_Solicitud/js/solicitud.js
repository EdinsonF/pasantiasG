// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    $(document).ready(function() {
    $("#modal_ts").click(function(){
   
     cargar_catalogo_tipo_solicitud();

      $("#tabla_modal_tipo_solicitud").modal('show'); 

          }); 
});

// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    $(document).ready(function() {
    $("#uno").click(function(){
         var especialidad  = document.getElementById("especialidad").value;
         var tipo_solicitud =document.getElementById("tipo_solicitud").value;

         if(especialidad==""){
             $("#uno").attr('checked', false);
                MensajeDatosNone();
              $("#especialidad").focus();
            }else{

     
      alert(especialidad +"--"+tipo_solicitud);
      cargar_catalogo_estudiantes(especialidad, tipo_solicitud);

      $("#id_esp").val(especialidad);      
      $("#todo").attr('checked', false);      
      $("#tabla_modal_estudiantes").modal('show'); 
}
          }); 
});
    // CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    $(document).ready(function() {
    $("#todo").click(function(){
    $("#uno").attr('checked', false);
 

          }); 
});
    //// fin de la validacion de los radio

    // CUANDO SE HACE  CLICK  EN EL BOTON REGISTRAR
    // Bloqueam
    $(document).ready(function() {
    $("#Registrar_s").click(function(){

        var Campos=ValidarCampos_2();
       
        if(Campos){
          
            Registrar_Solicitud_General();
        }
      
    
    }); 
});

    // CUANDO SE HACE  CLICK  EN EL BOTON REGISTRAR
    // Bloqueam
    $(document).ready(function() {
    $("#Registrar_Especificos").click(function(){

        var Campos=ValidarCampos_2();
       
        if(Campos){
          
            Registrar_Solicitud_Especifica();
        }
      
    
    }); 
});

 // CUANDO SE HACE  CLICK  EN EL BOTON  MODIFICAR
    $(document).ready(function() {
    $("#Modificar_s").click(function(){

        var Campos=ValidarCampos_2();
        
        if(Campos){
           
            modificar_Solicitud();
        }
      
    
    }); 
});
 // CUANDO SE HACE  CLICK  EN EL BOTON POSTULARME
// pasar el id de la tabla al modal


$('input[name=Postularme]').on('click',function (){
var id_solicitud = $(this).attr("id");

Postulacion_Solicitud(id_solicitud);
});
// fin

//---CUANDO SE HACE CLIC EN EL BOTON DE CANCELAR--->>>
    $(document).ready(function() {
    $("#Cancelar_s").click(function(){

 
            restablecerForm();
    }); 
});



//---CUANDO SE HACE CLIC EN EL BOTON DE CANCELAR--->>>
    $(document).ready(function() {
    $("#Cancelar2").click(function(){

 
            restablecerForm();
    }); 
});


//--------------VALIDACIONES--------

function ValidarCampos_2()
{
     var id_persona = document.getElementById("id_persona").value;
      var codigo_sucursal = document.getElementById("codigo_sucursal").value;
       var id_instituto = document.getElementById("id_instituto").value;
    var tipo_solicitud = document.getElementById("tipo_solicitud").value;
    var especialidad  = document.getElementById("especialidad").value;
    var cantidad  = document.getElementById("cantidad").value;
    var estatus_s = document.getElementById("estatus_s").value;
   // var requisitos  = document.getElementById("nombre_requisito[]").value;



    if((id_persona=="")||(codigo_sucursal=="")||(id_instituto=="")||(tipo_solicitud=="")||(especialidad=="")||(cantidad=="")||(estatus_s==""))
      { 
            

            if(id_persona==""){
                MensajeDatosNoneOrganizacion();
              
            }else
            if(codigo_sucursal==""){
                MensajeDatosNoneOrganizacion();
           
            }else
            if(id_instituto==""){
               MensajeDatosNoneOrganizacion();
             
            }else
            if(tipo_solicitud==""){
                MensajeDatosNone();
              $("#tipo_solicitud").focus();
            }else 
            if(especialidad==""){
                MensajeDatosNone();
              $("#especialidad").focus();
            }else
            if(cantidad==""){
                MensajeDatosNone();
              $("#cantidad").focus();
             
            }else 
            if(estatus_s==""){
                MensajeDatosNone();
              $("#estatus_s").focus();
             
            }
        
            return false;

      }else {

                return true;
        }
        

      }



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



//-----LIMPIAR CAMPOS--->>>
function restablecerForm()
{

        $("#tipo_solicitud").val("");
        $("#especialidad").val("");
        $("#cantidad").val("");
        $("#requisitos").val("");

        //ESTUDIENTE
        $("#expediente").val("");
        $("#cedula").val("");
        $("#nombre_e").val("");
        $("#apellido_e").val("");
        $("#observacion").val("");
        $("#nombre_especialidad").val("");

        //TUTOR
        $("#codigo").val("");
        $("#cedula_TA").val("");
        $("#nombre_TA").val("");
        $("#apellido_TA").val("");     
        $("#observacion_TA").val("");
        $("#nombre_especialidad2").val("");

        $("#Registrar").attr("disabled", false);
        $("#Modificar").attr("disabled", true);


        showselectESPECIALIDAD('');
        showselectESPECIALIDAD_AsignarPersonas('');
        showselect_PersonasAsignadas('');


}





function Registrar_Solicitud_General(){


    var id_instituto = document.getElementById("id_instituto").value;
    var codigo_sucursal = document.getElementById("codigo_sucursal").value;
    var id_persona = document.getElementById("id_persona").value;
    var tipo_solicitud = document.getElementById("tipo_solicitud").value;
    var especialidad  = document.getElementById("especialidad").value;
    var cantidad  = document.getElementById("cantidad").value;
    var estatus_s = document.getElementById("estatus_s").value;
    var observacion  = "GENERAL";
    var codigo_estudiante="";
     
 var nombres_paises = {};
 var id_requisitos = Array('[type=checkbox]:checked'.length);


    $(' [type=checkbox]:checked').each(function(index) {
        var nombres_paises = document.querySelectorAll("[type=checkbox]:checked");
  //nombres_paises = checkbox.length;
        nombres_paises[$(this).attr('id')] = $(this).val(); 
        //id_requisitos=[$(this).attr('id')];
        id_requisitos[index] = $(this).attr('id');
        //alert($(this).attr('id')+' index-> '+index +'---->'+id_requisitos[index]);

    });

 var Registrar  = "Registrar";
        
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Solicitud_Controller.php",
        data: {
            id_instituto           :id_instituto,
            codigo_sucursal        :codigo_sucursal,
            id_persona             :id_persona,
            tipo_solicitud         : tipo_solicitud,
            especialidad           : especialidad,      
            cantidad               : cantidad,
            estatus_s              : estatus_s,
            id_requisitos          : id_requisitos,
            observacion            : observacion,
            codigo_estudiante      : codigo_estudiante,   

            Registrar           : Registrar

              },
              
success: function(data){ 


alert(data);

    if(data==0){
    //  swal("A Ocurrido Un Error Al Insertar", "", "error");  
    alert("Error en Registro");
    document.location.reload();
    

    }else if(data==1) {
    // swal("Solicitud Registrada Exitosamente!",'', "success"); 
    alert("Registro Exitoso");          
   document.location.reload();
    }

    restablecerForm();
    }
    });



}


function Registrar_Solicitud_Especifica(){


    var id_instituto = document.getElementById("id_instituto").value;
    var codigo_sucursal = document.getElementById("codigo_sucursal").value;
    var id_persona = document.getElementById("id_persona").value;
    var tipo_solicitud = document.getElementById("tipo_solicitud").value;
    var especialidad  = document.getElementById("especialidad").value;
    var cantidad  = document.getElementById("cantidad").value;
    var estatus_s = document.getElementById("estatus_s").value;
  var observacion  = "ESPECIFICA";
    
 var nombres_paises = {};
 var estudiante ={}
 var id_requisitos = Array();
 var codigo_estudiante = Array();


    $('.id_requisito:checked').each(function(index) {
        var nombres_paises = document.querySelectorAll("[type=checkbox]:checked");
  //nombres_paises = checkbox.length;
        nombres_paises[$(this).attr('id')] = $(this).val(); 
        //id_requisitos=[$(this).attr('id')];
        id_requisitos[index] = $(this).attr('id');
       
    });

     $('.codigo_estudiante:checked').each(function(index) {
        var estudiante = document.querySelectorAll("[type=checkbox]:checked");
  //nombres_paises = checkbox.length;
        estudiante[$(this).attr('id')] = $(this).val(); 
        //id_requisitos=[$(this).attr('id')];
        codigo_estudiante[index] = $(this).attr('id');
       
    });
      alert(codigo_estudiante+"---"+id_requisitos);
       
    var Registrar  = "Registrar";
        
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Solicitud_Controller.php",
        data: {
            id_instituto           :id_instituto,
            codigo_sucursal        :codigo_sucursal,
            id_persona             :id_persona,
            tipo_solicitud         : tipo_solicitud,
            especialidad           : especialidad,      
            cantidad               : cantidad,
            estatus_s              : estatus_s,
            id_requisitos          : id_requisitos,
            observacion            : observacion,
            codigo_estudiante      : codigo_estudiante,           

            Registrar           : Registrar

              },
              
success: function(data){ 


alert(data);

    if(data==0){
    //  swal("A Ocurrido Un Error Al Insertar", "", "error");  
    alert("Error en Registro");
    document.location.reload();
    

    }else if(data==1) {
    // swal("Solicitud Registrada Exitosamente!",'', "success"); 
    alert("Registro Exitoso");          
   document.location.reload();
    }

    restablecerForm();
    }
    });



}


function modificar_Solicitud(){
    
    var id_instituto = document.getElementById("id_instituto").value;
    var id_solicitud = document.getElementById("id_solicitud").value;
    var tipo_solicitud = document.getElementById("tipo_solicitud").value;
    var especialidad  = document.getElementById("especialidad").value;
    var cantidad  = document.getElementById("cantidad").value;
    var requisitos  = document.getElementById("requisitos").value;

    var Modificar  = "Modificar";
       
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Solicitud_Controller.php",
        data: {
            id_instituto           :id_instituto,
            id_solicitud           :id_solicitud,
            tipo_solicitud         : tipo_solicitud,
            especialidad           : especialidad,      
            cantidad               : cantidad,
            requisitos             : requisitos,
            

            Modificar           : Modificar

              },
              
success: function(data){ 


alert(data);

    if(data==0){
      document.location.reload();
   // alert("Error en Registro");
    swal("A Ocurrido Un Error Al Insertar", "", "error");  

    }else if(data==1) {
       document.location.reload();
    //alert("Registro Exitoso");          
    swal("Solicitud Modificada Exitosamente!",'', "success"); 

    }

    restablecerForm();
    }
    });

}


function Postulacion_Solicitud(id_solicitud){

var codigo_estudiante = document.getElementById("codigo_estudiante").value;

 var Postulacion  = "Postulacion";
        
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
       url: "../controlador/Gestion_Solicitud_Controller.php",
        data: {
            codigo_estudiante   :codigo_estudiante,
            id_solicitud        :id_solicitud,
                    

            Postulacion           : Postulacion

              },
              
success: function(data){ 

    if(data==0){
    //  document.location.reload();
    //alert("Error en Registro");
    swal("A Ocurrido Un Error Al Realizar la Postulacion", "", "error");  

    }else if(data==2) {
     //  document.location.reload();
   // alert("Registro Exitoso");          
    swal("Postulacion Realizada Exitosamente!",'', "success"); 

    }else if(data==1) {
     //  document.location.reload();
   // alert("Registro Exitoso");          
    swal("Ya estas Postulado a esta Solicitud!",'', "success"); 

    }

    restablecerForm();
    }
    });



}


function Postulacion_Solicitud_Directa(id_solicitud){

var codigo_estudiante = document.getElementById("codigo_estudiante").value;

 var Postulacion  = "Postulacion";
        
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
       url: "../controlador/Gestion_Solicitud_Controller.php",
        data: {
            codigo_estudiante   :codigo_estudiante,
            id_solicitud        :id_solicitud,
                    

            Postulacion           : Postulacion

              },
              
success: function(data){ 

    if(data==0){
    //  document.location.reload();
    //alert("Error en Registro");
    swal("A Ocurrido Un Error Al Realizar la Postulacion", "", "error");  

    }else if(data==2) {
     //  document.location.reload();
   // alert("Registro Exitoso");          
    swal("Postulacion Realizada Exitosamente!",'', "success"); 

    }else if(data==1) {
     //  document.location.reload();
   // alert("Registro Exitoso");          
    swal("Ya estas Postulado a esta Solicitud!",'', "success"); 

    }

    restablecerForm();
    }
    });



}


// cargar tabla modal estudiante

function cargar_catalogo_estudiantes(especialidad, tipo_solicitud){

$.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Solicitud_Controller.php",
                dataType: "html",
                data: {
                  id_especialidad: especialidad,
                  tipo_solicitud:  tipo_solicitud,
                  estudiantes:'ofcourse'
                },
                success: function (data) {

                  
                   var html ;
                   var Variable = JSON.parse(data);

                   alert(Variable);
                    $.each(Variable, function(index, value){

                      html +="<tr>"+
                      "<td><center>"+value["estudiantedate"]+"</center></td>"+
                      "<td><center>"+value["expediente"]+"</center></td>"+
                      "<td><center>"+value["nombre_especialidad"]+"</center></td>"+                      
                      "<td><center> <input type='checkbox' class=codigo_estudiante name='codigo_estudiante[]' id='"+value["codigo_estudiante"]+"'  value='"+value["codigo_estudiante"]+"' ></center></td>"+
                       "<td style=display:none><center><strong>"+value["codigo_estudiante"]+"</strong></center></td>"+
                       "</tr>";
   
                    });
                   
                    Armarestudiantes( html);
                  
                }

            });


}

// cargar tabla modal estudiante

function cargar_catalogo_tipo_solicitud(){

$.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Gestion_Solicitud_Controller.php",
                dataType: "html",
                data: {
                  
                  tipo_solicitud:'ofcourse'
                },
                success: function (data) {

                  
                   var html ;
                   var Variable = JSON.parse(data);

                  
                    $.each(Variable, function(index, value){

                      html +="<tr class='tipo_solicitud' onclick=seleccionarfila_tipo_solicitud(this);>"+
                      "<td><center>"+value["nombre_tipo_solicitud"]+"</center></td>"+
                      "<td><center>"+value["numero_lapso"]+"</center></td>"+
                      "<td><center>"+value["nombre_especialidad"]+" "+value["nombre_tipo_especialidad"]+" </center></td>"+                      
                      "<td><center>"+value["fecha_inicio"]+"</center></td>"+
                      "<td><center>"+value["fecha_fin"]+"</center></td>"+
                      "<td style=display:none><center>"+value["codigo_temporada_especialidad"]+"</center></td>"+
                      "<td style=display:none><center>"+value["id_especialidad"]+"</center></td>"+
                       "</tr>";
                                // style=display:none
                    });
                   
                    Armartipo_solicitud( html);
                  
                }

            });


}



function Armarestudiantes ( html)
      {

        $("#tablaEstudiante").empty();
        $("#tablaEstudiante").append(html);
        $("#tablaEstudiante").dataTable().fnDestroy();
        $("#tablaEstudiante").dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null , null 
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
        }
        }); 
                     
      }


function Armartipo_solicitud( html)
      {

        $("#tablaTipoSolicitudes").empty();
        $("#tablaTipoSolicitudes").append(html);
        $("#tablaTipoSolicitudes").dataTable().fnDestroy();
        $("#tablaTipoSolicitudes").dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null , null , null , null 
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
        }
        }); 
                     
      }

//fin de cargar modal de estudiante


//  SELECCIONAR FILA DELA TABLA PARA ASIGNAR

function seleccionarfila_tipo_solicitud(tr){
    
                
                var codigo_temporada="";
                var id_especialidad="";
                var nombre_especialidad="";
                var nombre_tipo_solicitud = "";
                var numero_lapso = "";
                                
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .tipo_solicitud').each(function() {
                  
                  nombre_tipo_solicitud      = $(tr).find("td").eq(0).text();
                  numero_lapso   = $(tr).find("td").eq(1).text();
                  nombre_especialidad = $(tr).find("td").eq(2).text();
                  codigo_temporada    = $(tr).find("td").eq(5).text();
                  id_especialidad   = $(tr).find("td").eq(6).text();
                
                                  

                  });
          $("#nombre_solicitud").val(nombre_tipo_solicitud+" "+numero_lapso); 
          $("#nombre_especialidad").val(nombre_especialidad); 
          $("#tipo_solicitud").val(codigo_temporada); 
          $("#especialidad").val(id_especialidad); 
       
       //$("#tabla_modal_tipo_solicitud").modal('');

} 





//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR

function seleccionarfila_solicitud(tr){
    
                
                var id_solicitud="";
                var id_tipo_solicitud="";
                var tipo_solicitud="";
                var id_especialidad = "";
                 var especialidad = "";
                var cantidad="";
                var observacion="";
                
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .especialidad').each(function() {
                  
                  id_solicitud      = $(tr).find("td").eq(0).text();
                  id_tipo_solicitud = $(tr).find("td").eq(1).text();
                  tipo_solicitud    = $(tr).find("td").eq(2).text();
                  id_especialidad   = $(tr).find("td").eq(3).text();
                  especialidad      = $(tr).find("td").eq(4).text();
                  cantidad          = $(tr).find("td").eq(5).text();
                  observacion       = $(tr).find("td").eq(8).text();
                  

                  });
          $("#id_solicitud").val(id_solicitud); 
          $("#tipo_solicitud option[value="+id_tipo_solicitud+"]").attr("selected",true);
          $("#especialidad option[value="+id_especialidad+"]").attr("selected",true);
          $("#cantidad").val(cantidad); 
          $("#requisitos").val(observacion); 
       
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

                    html +="<tr style=cursor:pointer class='especialidad' onclick=seleccionarfila(this);  id="+Variable[index].id_especialidad+"  onMouseOver=ResaltarFila("+Variable[index].id_especialidad+") onMouseOut=RestablecerFila("+Variable[index].id_especialidad+") >"+
                    " <td ><center>"+Variable[index].id_especialidad+"</center></td>"+
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
          null, null, null, null,null
          ]
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
                
                    html +="<tr href='#tabla'  data-toggle='modal' style=cursor:pointer class='especialidad_AsignarPersona' onclick=seleccionarfila_AsignarPersona(this);  id='f_"+contador+"'  onMouseOver=ResaltarFila('f_"+contador+"') onMouseOut=RestablecerFila('f_"+contador+"') >"+
                    " <td ><center>"+Variable[index].id_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_especialidad+" </center></td>"+
                    " <td ><center><input type=hidden class='id_tipo_e' value='"+Variable[index].id_tipo_especialidad+"'>"+Variable[index].nombre_tipo_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td ><center>"+Variable[index].estatus+"</center></td>"+
                    " <td><center><img src='icon/add.png' alt=Ginger class=left width=20 ></center></td>"+
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


        $("#myTable3 ").empty();
        $("#myTable3 ").append(html);
        $('#myTable3 ').dataTable().fnDestroy();
        $('#myTable3 ').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null,null
          ]
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
                    html +="<tr  id='f_2"+contador+"'  onMouseOver=ResaltarFila('f_2"+contador+"') onMouseOut=RestablecerFila('f_2"+contador+"') >"+
                    " <td ><center>"+Variable[index].id_especialidad+"</center></td>"+
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
          ]
        }); 
                     
      }
//----FIN DE RECARGAR TABLA  PERSONAS ASIGNADAS--->>





      
      function ValidarCampos_TutorAcademico()
    {

        var codigo = document.getElementById("codigo").value
        var cedula = document.getElementById("cedula_TA").value
        var nombre_e = document.getElementById("nombre_TA").value;
        var apellido_e  = document.getElementById("apellido_TA").value;
        var fecha = document.getElementById("fecha_TA").value
        var observacion_p = document.getElementById("observacion_TA").value;
        


    if((codigo=="")||(cedula=="")||(nombre_e=="")||(apellido_e=="")||(fecha=="")||(observacion_p==""))
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
            if(fecha==""){
              $("#fecha_TA").focus();
            }else
            if(observacion_p==""){
              $("#observacion_TA").focus();
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
            if(fecha==""){
              $("#fecha").focus();
              MensajeError_Fecha();
            }else
            if(observacion_p==""){
              $("#observacion").focus();
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

function MensajeDatosNoneOrganizacion()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'¡Debe Seleccionar Una Organización!...'
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




//////////---------------------VALIDACIONES DE MAXIMO, MINIMO, NUMEROS Y LETRAS-------------------->>>
//--------------------------------------VALIDACION DE ESPECIALIDAD------------------------------->>>

                    $('#nombre').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789');
                    $('#descripcion').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789');
                    
                    //---NOMBRE
                    $('#nombre').on('keyup', function (e) {
    
                          var cadena = $("#nombre").val();

                          var ultimocaracter =cadena.substring($("#nombre").val().length-1);
                          if(ultimocaracter== '°' || ultimocaracter== '|' || 
                             ultimocaracter== '¬' || ultimocaracter== '!' || ultimocaracter== '"' || ultimocaracter== '@' || 
                             ultimocaracter== '#' || ultimocaracter== '$' || ultimocaracter== '%' || ultimocaracter== '&' || 
                             ultimocaracter== '/' || ultimocaracter== '(' || ultimocaracter== ')' || ultimocaracter== '=' || 
                             ultimocaracter== '?' || ultimocaracter== '¡' || ultimocaracter== '´' || ultimocaracter== '+' || 
                             ultimocaracter== '*' || ultimocaracter== '{' || ultimocaracter== '}' || ultimocaracter== '[' || 
                             ultimocaracter== ']' || ultimocaracter== '-' || ultimocaracter== '_' || ultimocaracter== '.' || 
                             ultimocaracter== ':' || ultimocaracter== ';' || ultimocaracter== ',' || ultimocaracter== '^' || 
                             ultimocaracter== '¿' || ultimocaracter== "'" || ultimocaracter=='♫')
                             {
                            if(ultimocaracter==' '){}else{
                                $("#nombre").val(cadena.substring(0,$("#nombre").val().length-1));
                              }
                            }                          
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
                              $('#tipo_e').focus();
                              });

                    //---TIPO ESÉCIALIDAD
                    $('#tipo_e').on('change', function (e) {
    
                                //---SALTAR AL OTRO CAMPO CON ENTER--->>
                              $('#descripcion').focus();
                              });


                    //---DESCRIPCION
                    $('#descripcion').on('keyup', function (e) {
                     
                     /*var FechaForm = $("#fecha").val();
                     var d = new Date(); 
                     var FechaHoy = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

                     if(FechaForm<FechaHoy){
                        alert("fecha mayor")
                     }*/

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


//----------------------------------FORMULARIO DE ASIGNACION ESTUDIANTE----------------------------->>
                    
                    $('#expediente').validCampoFranz('0123456789');
                    $('#cedula').validCampoFranz('0123456789');
                    $('#nombre_e').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#apellido_e').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#observacion').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789');
                     
                    //----EXPEDIENTE
                    $('#expediente').on('keyup', function (e) {
            
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


                    //---CEDULA
                    $('#cedula').on('keyup', function (e) {
    
                          var cadena = $("#cedula").val();

                          var ultimocaracter =cadena.substring($("#cedula").val().length-1);
                          if(ultimocaracter != 0 && ultimocaracter != 1 &&
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
                              $('#nombre_e').focus();
                              });


                    //---NOMBRE
                    $('#nombre_e').on('keyup', function (e) {
    
                          var cadena = $("#nombre_e").val();

                          var ultimocaracter =cadena.substring($("#nombre_e").val().length-1);
                          if(ultimocaracter== 0   || ultimocaracter>  0   || ultimocaracter== '°' || ultimocaracter== '|' || 
                             ultimocaracter== '¬' || ultimocaracter== '!' || ultimocaracter== '"' || ultimocaracter== '@' || 
                             ultimocaracter== '#' || ultimocaracter== '$' || ultimocaracter== '%' || ultimocaracter== '&' || 
                             ultimocaracter== '/' || ultimocaracter== '(' || ultimocaracter== ')' || ultimocaracter== '=' || 
                             ultimocaracter== '?' || ultimocaracter== '¡' || ultimocaracter== '´' || ultimocaracter== '+' || 
                             ultimocaracter== '*' || ultimocaracter== '{' || ultimocaracter== '}' || ultimocaracter== '[' || 
                             ultimocaracter== ']' || ultimocaracter== '-' || ultimocaracter== '_' || ultimocaracter== '.' || 
                             ultimocaracter== ':' || ultimocaracter== ';' || ultimocaracter== ',' || ultimocaracter== '^' || 
                             ultimocaracter== '¿' || ultimocaracter== "'" || ultimocaracter=='♫')
                             {
                            if(ultimocaracter==' '){}else{
                                $("#nombre_e").val(cadena.substring(0,$("#nombre_e").val().length-1));
                              }
                            }                          
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
                    $('#apellido_e').on('keyup', function (e) {
    
                     var cadena = $("#apellido_e").val();

                          var ultimocaracter =cadena.substring($("#apellido_e").val().length-1);
                          if(ultimocaracter== 0   || ultimocaracter>  0   || ultimocaracter== '°' || ultimocaracter== '|' || 
                             ultimocaracter== '¬' || ultimocaracter== '!' || ultimocaracter== '"' || ultimocaracter== '@' || 
                             ultimocaracter== '#' || ultimocaracter== '$' || ultimocaracter== '%' || ultimocaracter== '&' || 
                             ultimocaracter== '/' || ultimocaracter== '(' || ultimocaracter== ')' || ultimocaracter== '=' || 
                             ultimocaracter== '?' || ultimocaracter== '¡' || ultimocaracter== '´' || ultimocaracter== '+' || 
                             ultimocaracter== '*' || ultimocaracter== '{' || ultimocaracter== '}' || ultimocaracter== '[' || 
                             ultimocaracter== ']' || ultimocaracter== '-' || ultimocaracter== '_' || ultimocaracter== '.' || 
                             ultimocaracter== ':' || ultimocaracter== ';' || ultimocaracter== ',' || ultimocaracter== '^' || 
                             ultimocaracter== '¿' || ultimocaracter== "'" || ultimocaracter=='♫')
                             {
                            if(ultimocaracter==' '){}else{
                                $("#apellido_e").val(cadena.substring(0,$("#apellido_e").val().length-1));
                              }
                            }                          
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
                    $('#observacion').on('keyup', function (e) {
                     
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
                    $('#nombre_TA').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#apellido_TA').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
                    $('#observacion_TA').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú0123456789');

                    //----CODIGO
                    $('#codigo').on('keyup', function (e) {
            
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


                    //---CEDULA
                    $('#cedula_TA').on('keyup', function (e) {
    
                          var cadena = $("#cedula_TA").val();

                          var ultimocaracter =cadena.substring($("#cedula_TA").val().length-1);
                          if(ultimocaracter != 0 && ultimocaracter != 1 &&
                             ultimocaracter != 2 && ultimocaracter != 3 &&
                             ultimocaracter != 4 && ultimocaracter != 5 &&
                             ultimocaracter != 6 && ultimocaracter != 7 &&
                             ultimocaracter != 8 && ultimocaracter != 9 ) {
                             $("#cedula_TA").val(cadena.substring(0,$("#cedula_TA").val().length-1));}
                          
                                //Comprobamos la longitud de caracteres
                                if (cadena.length<10){
                                    
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


                    //---NOMBRE
                    $('#nombre_TA').on('keyup', function (e) {
    
                          var cadena = $("#nombre_TA").val();

                          var ultimocaracter =cadena.substring($("#nombre_TA").val().length-1);
                          if(ultimocaracter== 0   || ultimocaracter>  0   || ultimocaracter== '°' || ultimocaracter== '|' || 
                             ultimocaracter== '¬' || ultimocaracter== '!' || ultimocaracter== '"' || ultimocaracter== '@' || 
                             ultimocaracter== '#' || ultimocaracter== '$' || ultimocaracter== '%' || ultimocaracter== '&' || 
                             ultimocaracter== '/' || ultimocaracter== '(' || ultimocaracter== ')' || ultimocaracter== '=' || 
                             ultimocaracter== '?' || ultimocaracter== '¡' || ultimocaracter== '´' || ultimocaracter== '+' || 
                             ultimocaracter== '*' || ultimocaracter== '{' || ultimocaracter== '}' || ultimocaracter== '[' || 
                             ultimocaracter== ']' || ultimocaracter== '-' || ultimocaracter== '_' || ultimocaracter== '.' || 
                             ultimocaracter== ':' || ultimocaracter== ';' || ultimocaracter== ',' || ultimocaracter== '^' || 
                             ultimocaracter== '¿' || ultimocaracter== "'" || ultimocaracter=='♫')
                             {
                            if(ultimocaracter==' '){}else{
                                $("#nombre_TA").val(cadena.substring(0,$("#nombre_TA").val().length-1));
                              }
                            }                          
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
                    $('#apellido_TA').on('keyup', function (e) {
    
                     var cadena = $("#apellido_TA").val();

                          var ultimocaracter =cadena.substring($("#apellido_TA").val().length-1);
                          if(ultimocaracter== 0   || ultimocaracter>  0   || ultimocaracter== '°' || ultimocaracter== '|' || 
                             ultimocaracter== '¬' || ultimocaracter== '!' || ultimocaracter== '"' || ultimocaracter== '@' || 
                             ultimocaracter== '#' || ultimocaracter== '$' || ultimocaracter== '%' || ultimocaracter== '&' || 
                             ultimocaracter== '/' || ultimocaracter== '(' || ultimocaracter== ')' || ultimocaracter== '=' || 
                             ultimocaracter== '?' || ultimocaracter== '¡' || ultimocaracter== '´' || ultimocaracter== '+' || 
                             ultimocaracter== '*' || ultimocaracter== '{' || ultimocaracter== '}' || ultimocaracter== '[' || 
                             ultimocaracter== ']' || ultimocaracter== '-' || ultimocaracter== '_' || ultimocaracter== '.' || 
                             ultimocaracter== ':' || ultimocaracter== ';' || ultimocaracter== ',' || ultimocaracter== '^' || 
                             ultimocaracter== '¿' || ultimocaracter== "'" || ultimocaracter=='♫')
                             {
                            if(ultimocaracter==' '){}else{
                                $("#apellido_TA").val(cadena.substring(0,$("#apellido_TA").val().length-1));
                              }
                            }                          
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
                              $('#fecha_TA').focus();
                              });


                    //---FECHA
                    $('#fecha_TA').on('click', function (e) {

                            
                              $('#observacion_TA').focus();
                              });


                    //---OBSERVACION
                    $('#observacion_TA').on('keyup', function (e) {
                     
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




