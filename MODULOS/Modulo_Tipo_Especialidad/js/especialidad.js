



// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR

    $("#modificar").click(function(){

        var Campos=ValidarCampos();
        alert(Campos);
        if(Campos== true){
            modificarEspecialidad();
        }
      
    
    }); 


    // CUANDO SE HACE  CLICK  EN EL BOTON REGISTRAR
    // Bloqueam
    $("#registrar").click(function(){

        
        var Campos=ValidarCampos();
        
        if(Campos){
            Registrar_Especialidad();
        }
      
    
    }); 





    $("#cancelar").click(function(){

 
            restablecerForm();
    }); 

//-----LIMPIAR CAMPOS--->>>
function restablecerForm()
{

        $("#nombre_tipo_especialidad").val("");
        $("#estatus").val("");
        $("#descripcion").val("");


        $("#registrar").attr("disabled", false);
        $("#modificar").attr("disabled", true);


        showselectESPECIALIDAD('');

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
  

  //alert(data)

    if(data==1){
     
     swal("Ud. No Modifico Ningun Campo!");
     restablecerForm();

    }else if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error");   
    restablecerForm();      
    

    }  

    }
    });
}







//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR

function seleccionarfila(id_especialidad ,nombre , estatus , descripcion){
    
          $("#id_tipo_especialidad").val(id_especialidad); 
          $("#nombre_tipo_especialidad").val(nombre); 
          $("#estatus option[value="+ estatus +"]").attr("selected",true);
          $("#descripcion").val(descripcion); 
       
        $("#registrar").attr("disabled",true);
        $("#modificar").attr("disabled",false);
        $("#cancelar").attr("disabled",false);
        
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

showselectESPECIALIDAD('');
//-------RECARGAR TABLA ESPECIALIDAD--->>>>
function showselectESPECIALIDAD(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/TipoEspecialidad_Controller.php",
                dataType: "html",
                data: {
                  RecargarTab:'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";
                    
                    
                    $.each(Variable, function(index, value){

                    html +="<tr style=cursor:pointer class='especialidadd' id="+Variable[index].id_tipo_especialidad+"  onMouseOver=ResaltarFila("+Variable[index].id_tipo_especialidad+") onMouseOut=RestablecerFila("+Variable[index].id_tipo_especialidad+") >"+
                    " <td ><center>g"+Variable[index].id_tipo_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_tipo_especialidad+"</center></td>"+
                    " <td ><center>"+Variable[index].estado+"</center></td>"+
                    " <td ><center>"+Variable[index].descripcion +"</center></td>"+
                    " <td><center><img src=../../../img/iconos/edit.png alt=Ginger class=left width=20 ></center></td>"+
                    " </tr>" ;
                               
                    });
                   
                    ArmarTablaESPECIALIDAD(html);
                    
                }

            });

      }
        

      function ArmarTablaESPECIALIDAD (html)
      {


        $('#Table').empty();
        $('#Table').append(html);
        $('#Table').dataTable().fnDestroy();
        $('#Table').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null
          ]
        }); 
                   $('#Table tbody').on('click' ,' tr' , function(){
                    
                    seleccionarfila($(this).find('td').eq(0).text()  ,
                    $(this).find('td').eq(1).text() ,
                    $(this).find('td').eq(2).text() ,
                    $(this).find('td').eq(3).text()  );
                   });  
      }
//----FIN DE RECARGAR TABLA ESPECIALIDAD--->>



//--------------VALIDACIONES--------

function ValidarCampos()
{
    alert($("#nombre_tipo_especialidad").val());
    var nombre = $("#nombre_tipo_especialidad").val();
    var estatus  = $("#estatus").val();
    var descripcion  = $("#descripcion").val();



   
            if(nombre==""){
              $("#nombre_tipo_especialidad").focus();return false ;
            }else 
            if(estatus==""){
              $("#estatus").focus();return false ;
            }else
            if(descripcion==""){
              $("#descripcion").focus();
             return false ;
            }else return true ;
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

