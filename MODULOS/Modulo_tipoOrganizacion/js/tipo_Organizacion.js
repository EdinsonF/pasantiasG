$(document).ready(function(){

$("#Reportes").on('click',function()
  {
       MandarConfirmar_hacerReporte();
  });
 

                $('#nombre').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéíóú ');
                $('#descripcion').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú1234567890 ');

                //Para escribir solo numeros    
                //$('#descripcion').validCampoFranz('0123456789'); 

$('#nombre').on('keyup', function (e) {
    
      showselect($('#nombre').val());
      var key = e.keyCode || e.which;
      if(key==13)
      $('#clasif').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
$('#clasif').on('change', function (e) {
    
      showselect($('#clasif').val());
      $('#descripcion').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
$('#descripcion').on('keyup', function (e) {
    
    var key = e.keyCode || e.which;
      if(key==13)
      $('#Registrar').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  

$("#descripcion").val('');


$("#Registrar").click(function(){

    var Ver = ValidarRegistro();

    if(Ver){
    Registrar();
    
    
    }else 
    {
      
    }
  


});

$(document).on('ready', function(){

         $("#Estatus").selectBoxIt({autoWidth:false , 
        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 400,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 400       });
        Renderidng_select();
});

$("#Modificar").click(function(){

    var Ver = ValidarModificar();
   
     if(Ver){
     Modificar();
     
    
     }else 
     {
      
     }
  
});

$("#Cancelar").click(function(){

restablecer();

  
});



});

       
 function showselect(str){


        $.ajax({
               
                async   :true, 
               
                cache   :false,
               
                type    : "POST",
               
                url     : "../controlador/Recibeformulario.php",
               
                dataType: "html",
               
                data    : {
               
                  nombre       :$("#nombre").val(),
                  estatus      :$("#Estatus").val(),
                  filDiferncial:'ofcourse'
                },
                success: function (data) {
                  
                    var Variable = JSON.parse(data);
                    var html     = "";

                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";
                    
                    $.each(Variable, function(index, value){

                    html +="<tr class=tipoOrganizacion onclick=seleccionarfila(this); > "+
                    
                    "<td hidden></td>"+
                    
                    "<td class=nombretipo>"+value.nombre_tipo_organizacion +"</td>"+
                    
                    "<td class=descripcion>"+value.descripcion +"</td>"+
                    
                    "<td class=estatus>"+value.estatus+"</td>"+
                    
                    "<td class='text-primary'>"+ Icone +

                    "<label class=id_tipo_organizacion hidden>"+value.id_tipo_organizacion+"</label></td></tr>" ;
                                
                    });

                    if(Variable.length==0) $("#Cancelar").attr("disabled",false);
                   
                    ArmarTabla(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });

      }
        
function MandarConfirmar_hacerReporte()
{
   $.ajax({
          
          async   :true, 
          
          cache   :false,
          
          type    : "POST",
          
          url     : "../controlador/recibeReportes.php",
          
          dataType: "html",
          
          data    : {

          TipoReporte:'tipoGeneral'
        },
        success: function (data) {
          
            var Variable = JSON.parse(data);
            if(Variable=='tipoGeneral') window.open('../controlador/recibeReportes.php');
            
        }// Success
    });

}
      function ArmarTabla (html)
      {


        $("#myTable ").empty();
        $("#myTable ").append(html);
        $('#myTable ').dataTable().fnDestroy();
        $('#myTable ').dataTable({ // Cannot initialize it again error
          "aoColumns"  : [
          { "bSortable": false },
          null, null, null, null
          ], "language": {
      "sProcessing"    :"Procesando...",
      "sLengthMenu"    :"Mostrar _MENU_ Registros",
      "sZeroRecords"   :"No se encontraron Resultados",
      "sEmptyTable"    :"Ningún dato disponible en esta tabla",
      "sInfo"          :"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty"     :"Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered"  :"(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix"   :"",
      "sSearch"        :"Buscar:",
      "sUrl"           :"",
      "sInfoThousands" :",",
      "sLoadingRecords":"Cargando...",
      "oPaginate"      : {
      "sFirst"         :"Primero",
      "sLast"          :"Último",
      "sNext"          :"Siguiente",
      "sPrevious"      : "Anterior"
      },
      "oAria"          : {
      "sSortAscending" :  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
      },'columnDefs'   : [{
      'targets'        : 4,
      'searchable'     :true,
      'orderable'      :false,
      'className'      : 'dt-body-center'

      },
      {
      'targets'        : [ 0 ],
      'searchable'     : false,
      'visible'        : false,        
      }] ,
      "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
      "iDisplayLength" : 5
        }); 

     $("select.form-control").selectBoxIt();

     AutoActivarTooltip();
}
    

function AutoActivarTooltip(){

  $(".pagination > li.paginate_button ").click( function(){

      $('[data-toggle="tooltip"]').tooltip();

      setTimeout(function(){AutoActivarTooltip()},1000);
  }); 

  $("div.dataTables_length").find('.form-control').change(function(){

      $('[data-toggle="tooltip"]').tooltip();

      setTimeout(function(){AutoActivarTooltip()},1000);
  });

}


      function ValidarRegistro()
      {
    
      	if($('#nombre').val() == "")
		{	 
      MensajeCamposVacios();
			 $('#nombre').focus();
			return false;
		}else if($("#descripcion").val()=="")
    {
      MensajeCamposVacios();
      $("#descripcion").focus();
      return false;

    } else  if($("#Estatus").val()=='')
    {         
       MensajeSeleccioneEstatus();
       $("#Estatus").focus();
      return false;
    }
		{
			return true;
		}


      } // function validar  del  registro

     function ValidarModificar()
    {
      var       nombre   ="";
      var  clasificacion ="";
      var  descripcion   ="";
     

    $(".tipoOrganizacion").each(function(index,value){

            
            nombre        = $(value).children(".nombretipo").text();
            clasificacion = $(value).children(".estatus").text();
            descripcion   = $(value).children(".descripcion").text();

    });
    
  
   if((nombre==$("#nombre").val() )&&( clasificacion==$("#Estatus").val() ) && ( descripcion==$("#descripcion").val() ) )
    { 
       swal({ title:'Atención',  text:'Datos no Modificados' ,type:'warning'});
        return false;
    }else if($("#nombre").val() == "")
    { 
      MensajeCamposVacios();
      $("#nombre").focus();
      return false;
    }else if($("#descripcion").val()=="")
    {
      MensajeCamposVacios();
      $("#descripcion").focus();
      return false;

    } else  if($("#Estatus").val()=="")
    {
      MensajeCamposVacios();
      $("#Estatus").focus();
      return false;

    } else
    {
        return true;
    }
    }// VALIDAR  DEL  MODIFICAR

// REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO
      function Registrar()
	  {


    var nombre      =	$('#nombre').val();
    var estatus     = $('#Estatus').val();
    var descripcion =	$('#descripcion').val();
    var porid4      = "registra";
 
    $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType:"html", 
        
        type    : 'POST',   
        
        url     : "../controlador/Recibeformulario.php",
        
        data    : 
        {

            nombre     : nombre,
            clasif     : estatus,
            descripcion: descripcion,
            Registrar  : porid4

        },
              
        success: function(data){ 
        if(data==1)
        {
        swal("Bien",'Registro Realizado!', "success");
        }else{
        swal("Error",'Registro No Realizado!', "error");
        }
         
         setTimeout(function(){ restablecer(); },1000);
        
    }
    });
	}
// REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO
// REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO REGISTRO

function BuscarEistencia()
{
  $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType:"html", 
        
        type    : 'POST',   
        
        url     : "../controlador/Recibeformulario.php",
        
        data    : 
        {
            
            nombre             : $("#nombre").val(),
            
            VerificarExistencia: 'please'

        },
              
        success: function(data){ 
     
          if(data==1)
            {
                swal("Atención",'Este Tipo De Organización Ya existe', "warning");
            }else{
                Modificar();
            }

        }
    });
}


      function Modificar()
    {


    var nombre      =  $('#nombre').val();
    var estatus     = $('#Estatus').val();
    var descripcion = $('#descripcion').val();

        var id_tipo = ""; 

    $(".tipoOrganizacion").each(function(index,value){
            
            id_tipo= parseInt($(value).children().children(".id_tipo_organizacion").text());
    });

    var porid4  = "modificar";
 
    $.ajax({
       
        async   :true, 
       
        cache   :false,
       
        dataType:"html", 
       
        type    : 'POST',   
       
        url     : "../controlador/Recibeformulario.php",
       
        data    : {
       
            id         : id_tipo,
       
            nombre     : nombre,
       
            clasif     : estatus,
       
            descripcion: descripcion,
       
            Modificar  : porid4

              },
              
    success: function(data){ 
     
  if(data==1)
    {
        swal("Bien",'Modificación Realizada!', "success");
    }else{
        swal("Lo Sentimos",'Modificación No Realizada!', "error");
    }
      setTimeout(function(){ restablecer(); },1000);
    }

    });
  }

function seleccionarfila(tr){

  
                var id_municipio ="";
                var nombre       ="";
                var estatus      ="";
                var descripcion  = "";
                

                  nombre      = $(tr).find("td").eq(0).text();
                  estatus     = $(tr).find("td").eq(2).text();
                  descripcion = $(tr).find("td").eq(1).text();

          $("#nombre").val(nombre); 
          $('#Estatus').val(estatus);
         
            
          $("#Estatus").data("selectBoxIt").refresh();
          Renderidng_select();
          $("#descripcion").val(descripcion); 

         $("#Registrar").attr("disabled", true);
         $("#Modificar").attr("disabled",false);
         $("#Cancelar").attr("disabled",false);
        
         $( "#nombre" ).keyup();

         $("#nombre").off('keyup');
                


} 
function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"width": "206px" ,  "height": "35px"});
}

function MensajeCamposVacios()
{
    $.amaran({
            content        :{
            bgcolor        :'#0066CC',
            color          :'#fff',
            message        :'Campos Vacios'
            },
            theme          :'colorful',
            position       :'bottom right',
            
            cssanimationIn : 'swing',
            cssanimationOut: 'bounceOut'
            
    });

}

function MensajeSeleccioneEstatus()
{
    $.amaran({
            content        :{
            bgcolor        :'#0066CC',
            color          :'#fff',
            message        :'Seleccione Estatus'
            },
            theme          :'colorful',
            position       :'bottom right',
            
            cssanimationIn : 'swing',
            cssanimationOut: 'bounceOut'
     
    });

}



	  function restablecer()
	  {
	  	$('#nombre').val("");
		$('#Estatus').val("");
		$('#descripcion').val("");
    $("#Estatus").data("selectBoxIt").refresh();
    Renderidng_select();
$('#nombre').on('keyup', function (e) {
    
      showselect($('#nombre').val());
      var key = e.keyCode || e.which;
      if(key==13)
      $('#clasif').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
$('#Estatus').on('change', function (e) {
    
      showselect($('#Estatus').val());
      $('#descripcion').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
$('#descripcion').on('keyup', function (e) {
    
    var key = e.keyCode || e.which;
      if(key==13)
      $('#Registrar').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  

$("#descripcion").val('');

showselect('');


         $("#Registrar").attr("disabled", false);
         $("#Modificar").attr("disabled",true);
         $("#Cancelar").attr("disabled",true);
	  }


