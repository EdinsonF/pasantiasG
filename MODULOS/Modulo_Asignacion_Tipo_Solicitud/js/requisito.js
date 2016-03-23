$("#Reporte").on('click',function()
  {
        window.open('../controlador/recibeReportes.php?General=todo');
  });

$('#nombre').on('keyup', function (e) {
      
      showselect($('#nombre').val());
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#estatus').focus();
      });

$('#estatus').on('change', function (e) {
      showselect($('#estatus').val());
      $('#Registrar').focus();
      });        
  

 function showselect(str){
        var xmlhttp; 

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
           document.getElementById("myTable").innerHTML=xmlhttp.responseText;
           var porId=document.getElementById("nombre").value;
           var porId3=document.getElementById("estatus").value;
           }
          }
          if(str=!""){
          var porId=document.getElementById("nombre").value;
          var porId3=document.getElementById("estatus").value;
          var porId4="requisito";
          if(porId==''){porId4="todo"}

          xmlhttp.open("GET","../controlador/recibeRequisitoUr.php?requisito="+porId+"&estatus="+porId3+"&clase="+porId4,true);
          xmlhttp.send();

           }
           
      }
 // BUSQUEDA  CON  PURO AJAX 
 //LUEGO COMIENZA  PURO JQUERY con ayuda de  javascript vieja escuela 


//$("#descripcion").val('');
// BUSQUEDA TIEMPO REAL

// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {
    $("#Modificar").click(function(){

        var veri =  ValidarRegistro();
       
            if(veri){
          
            modificarRequisito();
            }
    }); 
});


    $("#Registrar").click(function(){

        var veri =  ValidarCampos();

            if(veri){
          
            RegistrarRequisito();
            }
    });     

    $(document).ready(function() {
    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 
});

function RegistrarRequisito(){
    
    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;
    var porid3  = "registra";

    
    if(porId2=="")
    {
        porId2 = "SIN ESTATUS";
    }


    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibeRequisito.php",
        data: {

            nombre_requisito : porId,   
            estatus : porId2,
            registra : porid3

              },
              
    success: function(data){ 
    if(data==1){
      
    MensajeRegistrado();
    restablecerForm();
    

    }else {    
    MensajeNoRegistrado()         
    restablecerForm();
    }

    }
    });
    
}

function modificarRequisito(){
    
    var id  = document.getElementById("id_requisito").value;
    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;
    var porid3  = "actualiza";
   


    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibeRequisito.php",
        data: {
            id_requisito     : id,
            nombre_requisito : porId,      
            estatus : porId2,
            actualiza : porid3
              },
              
success: function(data){ 
  var result = $.trim(data);
 restablecerForm();
    if(result){
      
    MensajeModificado();
    

    }else {    
   MensajeNoModificado();          
   
    }
    //restablecerForm();
    }
    });
    
}
//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR


function ValidarRegistro()
{

    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;
    
    $(".requisito").each(function(index,value){
        
            id= $(value).children(".id_requisito").text();
            nombre_requisitoViejo= $(value).children(".nombre_requisito").text();
            estatusViejo= $(value).children(".estatus").text();

    });
   var id_requisitotabla = $(".id_requisito").val();
   if((id_requisitotabla==porId )&&(estatusViejo==porId2))
    { 
        MensajeModificarNone();
        return false;
    }else
    {
        return true;
    }

}

function ValidarCampos()
{

    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;

    if(porId=="")
      { 
        MensajeDatosNone();
     
          $("#nombre").focus();

        return false;

      }else if(porId2=="")
      { 
        MensajeDatosNone();
     
          $("#estatus").focus();

        return false;

      }else
      {
        return true;
       
      }

}

function seleccionarfila(tr){
    
                var id_requisito="";
                var nombre_requisito="";
                var estatus = "";
                $('tr .requisito').each(function() {
                  
                  id_requisito = $(tr).find("td").eq(0).text();
                  nombre_requisito = $(tr).find("td").eq(1).text();
                  estatus            = $(tr).find("td").eq(2).text();

                  });

          $("#id_requisito").val(id_requisito);      
          $("#nombre").val(nombre_requisito); 
         
          $("#estatus option[value="+ estatus +"]").attr("selected",true);
          $("#nombre").off('keyup'); 
          $("#estatus").off('change');

        
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);

} 

function restablecerForm()
{

       location.reload();   
}



function MensajeRegistrado()
{
        $.amaran({
        content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Operación Exitoso'
        },
        theme:'colorful',
                   
        cssanimationIn    :'bounceInRight',
        cssanimationOut   :'rollOut',
        position          :'top right'
                });

}

function MensajeNoRegistrado()
{
        $.amaran({
        content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Requisito No Registrado'
        },
        theme:'colorful',
                   
        cssanimationIn    :'bounceInRight',
        cssanimationOut   :'rollOut',
        position          :'top right'
                });
}
function MensajeModificado()
{
        $.amaran({
        content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Operación Exitosa'
        },
        theme:'colorful',
                   
        cssanimationIn    :'bounceInRight',
        cssanimationOut   :'rollOut',
        position          :'top right'
        });
}
function MensajeNoModificado()
{

        $.amaran({
        content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Requisito No Modificado'
        },
        theme:'colorful',
                   
        cssanimationIn    :'bounceInRight',
        cssanimationOut   :'rollOut',
        position          :'top right'
                });
}

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
function MensajeModificarNone()
{

$.amaran({
    content:{
        bgcolor:'#3366FF',
        color:'#fff',
        message:'Modifique alguno de los  campos'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});

}