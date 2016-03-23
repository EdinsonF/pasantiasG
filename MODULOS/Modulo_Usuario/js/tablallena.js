
 function ConsultaUsuarios(strr){
    var xmlhttp;
    if (strr.length==0) {
    document.getElementById('usuario').innerHTML="";
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
    document.getElementById('usuario').innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET", "../modelo/ConsultaUser.php?V="+strr, true);
    xmlhttp.send();
    }
    

      function showselect(str){
        var xmlhttp; 
        if (str=="")
          {
          document.getElementById("txtHint").innerHTML="";
          return;
          }
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
           {
           document.getElementById("mySelect").innerHTML=xmlhttp.responseText;
           var porId=document.getElementById("js").value;
           }
          }

          var porId=document.getElementById("estado").value;

          var porId4="Instituto";


          xmlhttp.open("GET","../controlador/recibeInstitutoUrl.php?select="+porId+"&clase="+porId4,true);
          xmlhttp.send();
      }


      function showselect2(str){
        var xmlhttp; 
        if (str=="")
          {
          document.getElementById("txtHint").innerHTML="";
          return;
          }
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
           {
           document.getElementById("mySelect2").innerHTML=xmlhttp.responseText;
           
           }
          }

          var porId=document.getElementById("estado2").value;

          var porId4="Instituto";


          xmlhttp.open("GET","../controlador/recibeInstitutoUrl.php?select="+porId+"&clase="+porId4,true);
          xmlhttp.send();
      }

// - Esta es la funcion que coloco en el evento onclick del td -

function seleccionarfila(tr){
    

    
    var sigla= $("tr  #sigla").text();

    var id= $('#id_organizacion').val();
    
    $("#titlee").html(sigla);
    
    $("#superidOrganizacion").val(id);
    // El Codigo Malandro Super Tukki ..!
    // Gracias stackoverflow ...

    $("#tabla").removeClass("in");
    $(".modal-backdrop").remove();
    $('#tabla').modal('hide');

}

function ResaltarFila(id_fila) 
{

    document.getElementById(id_fila).style.backgroundColor = '#ADD8E6';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 

function limpiarCampos(){
    
    $("#nombre_denominacion").val("");
    $("#consultar").removeAttr("disabled");
    $("#registrar").attr("disabled",true);
    $("#modificar").attr("disabled",true);
    $("#eliminar").attr("disabled",true);
    $("#ver_registros").fadeIn(1);
}


$(document).ready(function(){
    // Bloqueamos el SELECT de los cursos
    //$("#slt-cursos").prop('disabled', true);

    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
    $("#estado2").change(function(){
        // Guardamos el select de cursos
        var id_estado = $("#estado2").val();
        
        // Guardamos el select de alumnos
        var alumnos = $(this);

        if($(this).val() != '')
        {
            $.ajax({
                data: { id : id_estado.val() },
                url:   '../controlador/recibeInstitutoFormulario.php',
                type:  'POST',
                dataType: 'json',
                
                success:  function (r) 
                {
                    alumnos.prop('disabled', false);

                    // Limpiamos el select
                    id_estado.find('option').remove();

                    $(r).each(function(i, v){ // indice, valor
                        id_estado.append('<option value="' + v.id + '">' + v.Nombre + '</option>');
                    })

                    id_estado.prop('disabled', false);
                },
                error: function()
                {
                    alert('Ocurrio un error en el servidor ..');
                    alumnos.prop('disabled', false);
                }
            });
        }
        else
        {
            cursos.find('option').remove();
            cursos.prop('disabled', true);
        }
    })
})