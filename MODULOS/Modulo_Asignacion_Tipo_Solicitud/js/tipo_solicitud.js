$("#Reporte").on('click',function()
  {
        window.open('../controlador/recibeReportesTS.php?General=todo');
  });


$('#nombre').on('keyup', function (e) {
      buscar_Tipo_Solicitud();
      showselect($('#nombre').val());
      if ($('#nombre').val()==null){
        showselect('');
      }
      var key = e.keyCode || e.which;
      if(key==13)
      $('#estatus').focus();
      }); 

$('#estatus').on('keyup', function (e) {
    
      var key = e.keyCode || e.which;
      if(key==13)
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
           var porId= document.getElementById("nombre").value;
          var porId2=document.getElementById("estatus").value;
           }
          }
          if(str!=""){
          var porId= document.getElementById("nombre").value;
          var porId2=document.getElementById("estatus").value;
          var porId3="Tipo_Solicitud";
      
      if(porId=="")
        {
          var porId3="Todo";}

          xmlhttp.open("GET","../controlador/recibeTipo_SolicitudUrl.php?nombre="+porId+"&estatus="+porId2+"&clase="+porId3,true);
          xmlhttp.send();
        
        }

      }

    
    $(document).ready(function(){
     $('#myTable').dataTable();
      new Tablesort(document.getElementById('table-id'));
    });

    $("#Registrar").click(function(){
    		
        	var veri =  ValidarCampos();
      
            if(veri){
          
            RegistrarTipo_Solicitud();

            }
    }); 

     $("#Modificar").click(function(){

        
         var veri =  ValidarRegistro();
       			
             if(veri){
          
             ModificarTipo_Solicitud();
             }
    }); 
    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 



function buscar_Tipo_Solicitud(){

    var porId   = $("#nombre").val();
    var porId2  = $("#estatus").val();
    var porid4  = "consulta";
 
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibeEstado.php",
        data: {
            estatus : porId2,      
            nombre : porId,
            consulta : porid4
              },
              
success: function(data){ 

     

    var variable = JSON.parse(data);
    if(variable.num === 1){
        
        var estatus=variable.estatus;//
       
     
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);
        $("#estatus").val(estatus);
    }else {              
        $("#Registrar").attr("disabled", false);
        $("#Modificar").attr("disabled",true);
        $("#Cancelar").attr("disabled",true);        
        $("#estatus").val("");
       
    }

    }
    });
    }

function RegistrarTipo_Solicitud(){
    
    
    var porId2 =  document.getElementById("nombre").value;
    var porId3 =  document.getElementById("estatus").value;
    var porid4  = "registra";

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibeTipo_Solicitud.php",
        data: {
      
            nombre 		: porId2,
            estatus 		: porId3,
            Registrar 	: porid4

              },
              
    success: function(data){ 
    var result = $.trim(data);

      if(data==1)
      {
          //MensajeModificar();
           swal({ title: "Tipo_Solicitud Registrado", type: "success" });
    
        }else 
        {

          //MensajeNoRegistrado();          
   
          swal({   title: "Tipo_Solicitud Registrado", type: "error" });
        }
        
        location.reload();
    }
    });
    
}

function ModificarTipo_Solicitud(){
    var id = '';
    var porId2 = document.getElementById("nombre").value;
    var porId3 = document.getElementById("estatus").value;
    var porid4  = "actualiza";

    $(".tipo_solicitud").each(function(index,value){

            id= $(value).children(".id_tipo_solicitud").text();
           

   });

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibeTipo_Solicitud.php",
        data: {
            id_tipo_solicitud : id,      
            nombre : porId2,
            estatus : porId3,
            Modificar : porid4

              },
              
success: function(data){ 
  
      if(data==1)
      {
          swal({ title: "Tipo_Solicitud Modificado", type: "success" });
    
        }else{

          swal({   title: "Tipo_Solicitud Modificada", type: "error" });
        }

    restablecerForm();

    }
    });
    
}

function ValidarCampos()
{

    
    var porId2 = document.getElementById("nombre").value;
    var porId3  = document.getElementById("estatus").value;

        
        if(porId2=="")
        {

        	MensajeDatosNone();
        	$("#nombre").focus();
          	
          	return false;

        } 
        if(porId3=="")
 
        {

        	MensajeDatosNone();
        	$("#estatus").focus();
          	return false;
        } 
        if ((porId2!="")&&(porId2!="")) 
        {

        	return true;
        }
        
       

}


function ValidarRegistro()
{

    
    var porId2 = document.getElementById("nombre").value;
    var porId3 = document.getElementById("estatus").value;
    

    $(".Tipo_Solicitud").each(function(index,value){

            
            id= $(value).children(".id_tipo_solicitud").text();
            nombre_Tipo_SolicitudViejo= $(value).children(".nombre_Tipo_Solicitud").text();
            estatusViejo= $(value).children(".estatus").text();

    });
    
    var nombre_Tipo_SolicitudViejo = $(".id_requisito").val();
    if((nombre_Tipo_SolicitudViejo==porId2)&&(estatusViejo==porId3))
    { 
        swal({ title:'Debe Modificar los Campos',type: 'warning'});
        return false;

    }else if(porId2=='')
    {
    	MensajeDatosNone();
        return false;
    }else if(porId3=='')
    {
    	MensajeDatosNone();
        return false;
    }
        if(porId3.length<3)
    {	
    	swal({ title:'El número de caracteres es invalido (rango 3 - 25)',type: 'warning'});
    	return false ;
    }else 

        if(porId2.length<3)
    {	
    	swal({  title:'El número de caracteres es invalido (rango: 3 - 25)',type: 'warning'});
    	return false ;
    }else 

           if(porId2.length>25)
    {	
    	swal({  title:'El número de caracteres es invalido (rango 3 - 25)',type: 'warning'});

    	return false ;

    	restablecerForm();

    }else 

    
    {
        return true;
    }

}


function seleccionarfila(tr){
    
                var id_tipo_solicitud
                var nombre_tipo_solicitud= "";
                var estatus = "";
                $('tr .Tipo_Solicitud').each(function() {
                  
                  id_tipo_solicitud =  $(tr).find("td").eq(0).text();
                  nombre_tipo_solicitud =  $(tr).find("td").eq(1).text();
                  estatus  = $(tr).find("td").eq(2).text();

                  });


                $("#id_tipo_solicitud").val(id_tipo_solicitud);
          $("#nombre").val(nombre_tipo_solicitud); 
        
           $("#estatus").val(estatus); 
           showselect();
          
        $("#nombre").off('keyup');
     
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);
} 

function restablecerForm()
{

  location.reload();

        // $("#nombre").val("");
        
        // $("#estatus").val("");
        // $("#nombre").keyup(buscar_Tipo_Solicitud,showselect);
        // $("#es}").change(showselect);
       
        // $("#Registrar").attr("disabled", false);
        // $("#Modificar").attr("disabled",true);
        // $("#Cancelar").attr("disabled",true);
        // showselect();

       //$( "#page" ).load( "../vista/Municipio.phtml");

}

function MensajeRegistrado()
{
        $.amaran({
        content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Tipo Solicitud Registrada'
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
        message:'Tipo Solicitud No Registrada'
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
        message:'Modifique alguno de los Campos'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});

}
function MensajeModificar()
{

$.amaran({
    content:{
        bgcolor:'#3366FF',
        color:'#fff',
        message:'Modifique Exitosa'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});

}