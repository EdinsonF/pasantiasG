function MensajeDatosNoneCedula()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El Campo cedula Esta Vacio'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNoneRespuesta()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El Campo Respuesta Esta Vacio'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNoneUsuario()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El Campo Usuario Esta Vacio'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNoneContrasena()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El Campo Contraseña Esta Vacio'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNoneCodigo()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El Campo codigo Esta Vacio'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNoneCodigoError()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El Codigo No Coincide Con El De la Imagen'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}


$("#contrasena").on('keyup', function (e) {
    
      
      var key = e.keyCode || e.which;
      if(key==13)
      inicio_sesion();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !


    $("#ingresar").click(function(){

        var usuario =   $("#usuario").val() ;
        var contrasena = $("#contrasena").val();
        var captcha_a =$("#captcha_a").val();
        var captcha_b =$("#captcha_b").val();
        
            
            if(usuario==""){
              MensajeDatosNoneUsuario();
                $("#usuario").focus();
                // alert("el campo usuario esta vacio");
        }else
            if(contrasena==""){
               MensajeDatosNoneContrasena();
                $("#contrasena").focus();
                 //alert("el campo contraseña esta vacio");
        }else
            if(captcha_b==""){
                MensajeDatosNoneCodigo();
                $("#captcha_b").focus();
                 //alert("el campo codigo esta vacio");
        }else
            if(captcha_a != captcha_b){
                MensajeDatosNoneCodigoError();
                $("#captcha_b").focus();
                //alert("el codigo no coincide con el de la imagen");
            }else{

          inicio_sesion();
      }

});

function contador(){

       ccc = $('#Modal_Bloqueo').modal('hide');
       ccc.delay(5000);
}



function inicio_sesion(){
    
    var usuario =   $("#usuario").val() ;
    var contrasena = $("#contrasena").val();
    var boton  = "ingresar";

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibejquery.php",
        data: {
            usuario : usuario,      
            contrasena : contrasena,
           
            ingresar : boton

              },
              
success: function(data){ 
           
      var variable = JSON.parse(data);
      //alert(data);
  
    if(variable.num == 0)
    {
        var num =   $("#num").val() ;  
        r=(num+1);
        $("#num").val(r);
        //alert('Usuario y/o Contraseña Incorrectos ');
        swal( 'Atención','Usuario y/o Contraseña Incorrectos ','warning');

        if(r==1111){
           contador();
           
            $("#num").val('1') ;
            $('#Modal_Bloqueo').modal('show');
     }

    }else if (variable.num == 1) 
    { // EXISTE  EN  UNA  SOLA   ORGANIZACION  APROBADO
       
        redireccionarMenu (  variable.personadatos, variable.persona ,  variable.organizacion, variable.id_perfil, variable.perfil ,variable.codigo_sucursal );
    

    }else if (variable.num > 1) 
    { // EXISTE  MAS DE  UNA  VEZ  COMO  USUARIO DE  UNA  ORGANIZACION TIPO OCUPADO 

         llenarTabla ( variable.id_perfil, variable.persona , variable.perfil );


        $('#Modals').modal('show');

    }


    }
    });
}
var Persona ="";
function llenarTabla (id_perfil ,  persona , nombre_perfil )
{

    $("#id_persona").val(persona);
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibejquery.php",
        data: {
            id_persona : persona,      
                       
            tabla_modals : 'boton'

              },
              
success: function(data){ 
      alert(data);
      var variable = JSON.parse(data);
      
      if(variable.length>0) $("#Personad").html('<img src="../../../img/Ico-master/PNG/64px/0114-user.png" alt=Ginger class=left width=40 >Usuario: '+' '+variable[0].nombre+' '+variable[0].apellido);
     //$("#myTable tr").detach();
             //tabla_head();
              Persona = variable[0].nombre+' '+variable[0].apellido;
             
                var html='';
                $.each(variable, function(index, value){

                    html+="<tr class=usuario aria-hidden='true' onclick=seleccionarfila(this); id="+index+" style=cursor:pointer >"+
                    "<td><center> " +  
                    "<input type=hidden class=id_perfil value="+
                    variable[index].id_perfil+">"+
                    variable[index].nombre_perfil +
                    "</center></td> <td><center>" + 
                    "<label hidden class=id_organizacion> "+ variable[index].id_organizacion+"</label>"+
                    "<label hidden class=codigo_sucursal> "+ variable[index].codigo_sucursal+"</label>"+
                    variable[index].siglas + 
                    "</center></td> <td><center>"+ 
                    variable[index].nombre_estado + " " + variable[index].nombre_municipio + 
                    "</center></td></tr>";
                });

                borrarDatosTabla(html);
    }
    });

}



function tabla_head()
{//$("#myTable tbody").detach();
     $("#myTable ").append('<thead>'+
      +'<tr>'+
        +'<td><center><strong>Nombre</strong></center>'+ 
          
        +'</td>'+
        +'<td><center><strong>Apellido</strong></center>'+ 
          
        '</td>'+
        +'<td><center><strong>Perf&iacute;l</strong></center>'+ 
          
        +'</td>'+
        +'<td><center><strong>Organizaci&oacute;n</strong></center>'+ 
          
        +'</td>'+   
        +'<td><center><strong>Estado - Municipio</strong></center></td></tr>'+
    +'</thead>');

}

$("#cerrarSwite").click(function(){
  borrarDatosTabla('');

});



function borrarDatosTabla(html){


          $("#myTable").empty();
        $("#myTable").append(html);
        $("#myTable").dataTable().fnDestroy();
        $("#myTable").DataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null
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
        }        ,
                    'order': [1, 'asc'],
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5
        }); 
}

function seleccionarfila(tr){
    
                //alert($(tr).find("td").eq(0).html());
                var Perfil = "";
                 var Nombre = "";
                  var Apellido = "";
                var id_organizacion = $(".id_organizacion",tr).html();
                var codigo_sucursal = $(".codigo_sucursal",tr).html();

                var id_perfil = $(".id_perfil",tr).val();
                $(tr).each(function() {

                 Perfil = $(tr).find("td").eq(0).text();

                });

    $("#myTable").removeClass("in");
    $(".modal-backdrop").remove();
    $('#myTable').modal('hide');
                
                redireccionarMenu ( Persona,$("#id_persona").val() , id_organizacion,  id_perfil, Perfil , codigo_sucursal);


} 


function redireccionarMenu ( persona , id_persona, id_organizacion,  id_perfil ,  nombre_perfil ,codigo_sucursal  )
{   
            var url = "../controlador/iniciar_sesion.php?";
            url +=   'nombre_perfil='+$.trim(nombre_perfil)
                    +'&id_perfil='+$.trim(id_perfil)
                    +'&id_organizacion='+$.trim(id_organizacion)
                    +'&persona='+$.trim(persona)
                    +'&id_persona='+$.trim(id_persona)
                    +'&codigo_sucursal='+$.trim(codigo_sucursal);
            window.location.replace(url);
//METEEEEEEEEEETELEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEeee  NOJOMMMBRE!"" ... 

}


// METEEEEEEEEETELEEEEEEEEEE....

//NOJOMMMBRE!" "

//  !  ..... RECUPERAR CONTRASEÑA
 $(document).ready(function() {
    $("#recuperar_contraseña").click(function(){


       $('#recuperar').modal('show');
       $('#cedula_recuperar_contrasena').val('');
       $('#respuesta').val('');
       $('#for_consulta').show();
       $('#mostar_dato_p').hide();
       $('#rspuesta_mostrar').hide();
       $('#mostar_usuario_contraseña').hide();     
    
    }); 
});

$(document).ready(function() {
    $("#consultar_recuperar_contrasena").click(function(){
                var cedula       = document.getElementById("cedula_recuperar_contrasena").value;
            if(cedula==""){
                MensajeDatosNoneCedula();
            }else{
         consultar_pregunta();
      }
    }); 
});

$(document).ready(function() {
    $("#verificar_respuesta").click(function(){
           var respuesta       = document.getElementById("respuesta").value;
            if(respuesta==""){
                MensajeDatosNoneRespuesta();
            }else{
         consultar_el_usuario();
      }
    }); 

      $('#myTable').DataTable({  

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
        }         ,
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5
        });

});

// cargar  consultar_pregunta usuario

function consultar_pregunta(){

  var cedula       = document.getElementById("cedula_recuperar_contrasena").value;
      

    var boton  = "consultar_pregunta_usuario";

      $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recuperar_contrasena.php",
        data: {            
              
            cedula               : cedula,
                       
            consultar_pregunta_usuario    : boton

              },
              
success: function(data){ 
 

var arreglo = JSON.parse(data);

  if(arreglo==""){
      $('#cedula_recuperar_contrasena').val('');
      swal('Error','Persona No Existe','error');

    }else{
$('#for_consulta').hide();
$('#mostar_dato_p').show();
$('#rspuesta_mostrar').show();

$('#id_persona').val(arreglo[0].id_persona);
$('#id_usuario').val(arreglo[0].id_usuario);
$("#nombre_apellido").html(arreglo[0].nombre+" "+arreglo[0].apellido);
$("#pregunta").html(arreglo[0].pregunta);


  }

    }    

  });

}

// fin de la consulta de la pregunta



// cargar  consulta el usuario

function consultar_el_usuario(){

  var id_usuario       = document.getElementById("id_usuario").value
  var id_persona       = document.getElementById("id_persona").value
  var respuesta       = document.getElementById("respuesta").value;
      

    var boton  = "consultar_usuario";

      $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recuperar_contrasena.php",
        data: {            
              
            id_usuario               : id_usuario,
            id_persona               : id_persona,
            respuesta                : respuesta,
                               
            consultar_usuario    : boton

              },
              
success: function(data){ 
 

var arreglo = JSON.parse(data);
  if(arreglo==""){
    $('#respuesta').val('');
      swal('Error','Respuesta Fallida','error');

    }else{
$('#for_consulta').hide();
$('#mostar_usuario_contraseña').show();
$('#rspuesta_mostrar').hide();


$("#usuario_recuperado").html(arreglo[0].usuario);
$("#contrasena_recuperado").html(arreglo[0].contrasena);

}
  

    }    

  });

}

// fin de la consulta de la pregunta

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