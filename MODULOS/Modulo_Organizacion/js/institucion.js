

function RegistrarInstituto()
{


var nombre      =  $("#nombreIn").val();
var siglas      =  $("#siglasIn").val();
var rif         =  $("#rifIn").val();
var codigo      =  $("#codigoIn").val();
var tipo        =  $("#tipoIn").val();
var descripcion =  $("#descripcion").val();
var telefono    =  $("#telefonoIn").val();
var correo      =  $("#coreoIn").val();

var municipio  =   $("#municipioIn").val();
var direccion  =   $("#direccionIn").val();

    $.ajax({
          
          async   :true, 
          
          cache   :false,
          
          dataType: "html", 
          
          type    : 'POST',   
          
          url     : "../controlador/recibeInstitutoFormulario.php",
          
          data    : 
          {
          
              nombre            : $ .trim(nombre),
              rif               : $ .trim($("#letra").val()+'-'+rif ),
              tipo              : $ .trim(tipo),
              descripcion       : $ .trim(descripcion),
              telefono          : $ .trim(telefono),
              correo            : $ .trim(correo),
              municipio         : $ .trim(municipio),
              direccion         : $ .trim(direccion),
              codigo            : $ .trim(codigo),
              siglas            : $ .trim(siglas),
              RegistrarInstituto: 'Regis' 
          },              
    
success: function(data){ 

 
  var variable = JSON.parse(data);
        
    if(variable.return1==1 && variable.return3==1 && variable.return4==1)
      {
              swal({   title:'Bien' ,text: "Instituto Registrado", type: "success" });
      }else
      {
              swal({   title:'Ups' ,text: "Error De Programación , Algo no Anda Bien", type: "error" });
      }


    }
    });
    

}


function buscarmunicipios()
{
  
  var estado = $("#estadoIn").val();

    $.ajax({

          async   :true, 
         
          cache   :false,
         
          dataType: "html", 
         
          type    : 'POST',   
         
          url     : "../controlador/recibeInstitutoFormulario.php",
         
          data    :
          {
         
           select          :estado,
           buscarmunicipios: 'Regis' 
          },              
    
          success: function(data){ 

            ProcesarSelectMunicipio(JSON.parse(data) , "#municipioIn");

          }
    });
    

}

function ProcesarSelectMunicipio(variable , selectid){

    if(variable.length>0){

        $(selectid).empty();

        $(selectid).append('<option value='+''+'>'+'Seleccione...'+'</option>');
        
        options ='';

        $.each(variable, function(index, value){

            options += '<option value='+value.id_municipio+' >'+value.nombre_municipio+'</option>';

        }); 

        $(selectid).append('<optgroup label="Municipios de '+variable[0].nombre_estado+'">'+options+'</optgroup>');
         
        $(selectid).data("selectBoxIt").enable(); 

        $(selectid).data("selectBoxIt").refresh();
                
        Renderidng_select();

    }else { 

      $(selectid).empty();
      
      $(selectid).append('<option value='+''+'>'+'NO HAY MUNICIPIOS'+'</option>');
      
      $(selectid).data("selectBoxIt").refresh();

      $(selectid).data("selectBoxIt").disable(); 

      Renderidng_select();

    }

}


function Validad()
{

 var nombre      = $("#nombreIn").val();
 var siglas      = $("#siglasIn").val();
 
 var rif         = $("#rifIn").val();
 var codigo      = $("#codigoIn").val();
 var tipo        = $("#tipoIn").val();
 var descripcion = $("#descripcion").val();
 var telefono    = $("#telefonoIn").val();
 var correo      = $("#coreoIn").val();
 var estado      = $("#estadoIn").val();
 var municipio   = $("#municipioIn").val();
 var direccion   = $("#direccionIn").val();

 if (nombre==""){

      MensajeCamposVacios();
      $("#nombreIn").focus();
      return false;
 }else if (siglas==""){

      MensajeCamposVacios();
      $("#siglasIn").focus();
      return false;
 }
else if ( $("#letra").val() =="" || $("#letra").val() ==" "){

      MensajeCamposVacios();
      $("#letra").focus();
      return false;
 }
else if (rif==""){

      MensajeCamposVacios();
      $("#rifIn").focus();
      return false;
 }else if (codigo==""){

      MensajeCamposVacios();
       $("#codigoIn").focus();
      return false;
 }else if (tipo==""){

      MensajeCamposVacios();
       $("#tipoIn").focus();
      return false;
 }else if (descripcion==""){

      MensajeCamposVacios();
       $("#descripcion").focus();
      return false;
 }else if (telefono==""){
  
      MensajeCamposVacios();
       $("#telefonoIn").focus();
      return false;
 }else if (correo==""){

      MensajeCamposVacios();
       $("#coreoIn").focus();
      return false;
 }else  if (estado==""){

      MensajeCamposVacios();
       $("#estadoIn").focus();
      return false;
 }else  if (municipio==""){

      MensajeCamposVacios();
       $("#municipioIn").focus();
      return false;
 }else if (direccion==""){

      MensajeCamposVacios();
       $("#direccionIn").focus();
      return false;
 }else {
      return true;
 }

}

function restablecerFormulario()
{
  $("#nombreIn")    .val('');
  $("#siglasIn")    .val('');
  $("#letra")       .val('');
  $("#rifIn")       .val('');
  $("#codigoIn")    .val('');
  $("#tipoIn")      .val('');
  $("#descripcion") .val('');
  $("#telefonoIn")  .val('');
  $("#coreoIn")     .val('');
  $("#estadoIn ")   .val('');
  $("#municipioIn ").val('');
  $("#direccionIn") .val('');


  $("#municipioIn").html('<option value='+''+'>Esperando Estado</option>');
 
  $("#tipoIn").data("selectBoxIt").refresh();

  $("#estadoIn").data("selectBoxIt").refresh();

  $("#municipioIn").data("selectBoxIt").refresh();

  Renderidng_select();

}

function BuscarLlenarSelects()
{
    $.ajax({
          
          async   :true, 
          
          cache   :false,
          
          dataType: "json", 
          
          type    : 'POST',   
          
          url     : "../controlador/recibeInstitutoFormulario.php",
          
          data    : 
          {
              BuscarInformacionDeTodosLosSelectsDelConvenio: 'Regis' 
          },              
    
          success: function(data){ 
            if(data['TipoOrganizacion'].length > 0){

                $.each(data['TipoOrganizacion'] , function( keys ,values ){

                    $("#tipoIn").append('<option value='+values['id_tipo_organizacion']+'>'+values['nombre_tipo_organizacion']+'</option>');

                });

                $("#tipoIn").data("selectBoxIt").refresh();
                 Renderidng_select();
            }

              if(data['Estado'] .length > 0){

                $.each(data['Estado'], function ( keys , values ){

                    $("#estadoIn").append('<option value='+values['id_estado']+'>'+values['nombre_estado']+'</option>');

                });

                $("#estadoIn").data("selectBoxIt").refresh();

                Renderidng_select();
              }

          }
    });
}

  $(document).ready(function(){
  $("#myTable").dataTable({  

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

      $("#CancelarPersona").click(function(){

        restablecer();

      });

      $("#RegistrarInstituto").click(function(){
   
      if(Validad()){

        RegistrarInstituto(); // REGISTRA
        
        restablecerFormulario();  // LIMPIA  CAMPOS  COMO  EN JAVA! MI  AMOR  JAVA

      }
    
      });

      $("#cancelarInstituto").click(function(){

          restablecerFormulario();  // LIMPIA  CAMPOS  COMO  EN JAVA! MI  AMOR  JAVA
      });

     $("#estadoIn").change(buscarmunicipios);
     $("#nombreIn").val('');
     $("#descripcion").val('');
     $("#direccionIn").val('');

     
      InicializarSelects();

  });

function InicializarSelects()
{
    var Reutilizare = { 
        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 400,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 400       };

        $("#tipoIn").     selectBoxIt( Reutilizare );
        $("#estadoIn").   selectBoxIt( Reutilizare );
        $("#municipioIn").selectBoxIt( Reutilizare );
        $("#pregunta").   selectBoxIt( Reutilizare );

   BuscarLlenarSelects();

}

function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"min-width": "206px" ,  "height": "35px"});
}








/// EVENTOS --------------------------------------------------------------------------




  $('#siglasIn').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou.');
    
  $('#nombreIn').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou ');
  
  $('#letra').validCampoFranz('abcdefghijklmnñopqrstuvwxyz');
  
  $('#descripcion').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou ');

  //Para escribir solo numeros    
 
  $('#telefonoIn').validCampoFranz('0123456789'); 
  
  $('#rifIn').validCampoFranz('0123456789'); 

$('#nombreIn').on('keyup', function (e) {
    
 var ultimocaracter = $("#nombreIn").val();

      var cadena =ultimocaracter.substring($("#nombreIn").val().length-1);
      if(cadena == 0 || cadena>0 ) {
        if(cadena==' '){}else{
            $("#nombreIn").val(ultimocaracter.substring(0,$("#nombreIn").val().length-1));
        }
      }

      
      if(cadena =="´") {

      $("#nombreIn").val(ultimocaracter.substring(0,$("#nombreIn").val().length-1));
            var newValor = $("#nombreIn").val().split('´');
     
      $("#nombreIn").val(newValor[0]);} else
      {
      var newValor = $("#nombreIn").val().split('´');
     
      $("#nombreIn").val(newValor[0]);
      }
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#siglasIn').focus();
}); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE ! 

$('#siglasIn').on('keyup', function (e) {
                   var key = e.keyCode || e.which;
                   var ultimocaracter = $("#siglasIn").val();
                   var cadena =ultimocaracter.substring($("#siglasIn").val().length-1);
                             if(cadena =="´") {

                        $("#siglasIn").val(ultimocaracter.substring(0,$("#siglasIn").val().length-1));
                              var newValor = $("#siglasIn").val().split('´');
                       
                        $("#siglasIn").val(newValor[0]);}else
                        {
                        var newValor = $("#siglasIn").val().split('´');
                       
                        $("#siglasIn").val(newValor[0]);
                        }
                        if(key==13)
                        $('#letra').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  

$('#letra').on('keyup', function (e) {
    
                    var ultimocaracter = $("#letra").val();

                      var cadena =ultimocaracter.substring($("#letra").val().length-1);
                      if(cadena == '´') {
                      $("#letra").val(ultimocaracter.substring(0,$("#letra").val().length-1));}else
                      {
                      var newValor = $("#letra").val().split('´');
                     
                      $("#letra").val(newValor[0]);
                      }
                      
                      
                      var key = e.keyCode || e.which;
                      if(key==13)
                      $('#rifIn').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE ! 
$('#rifIn').on('keyup', function (e) {
    
                    var ultimocaracter = $("#rifIn").val();

                      var cadena =ultimocaracter.substring($("#rifIn").val().length-1);
                      if(cadena =="´") {

                      $("#rifIn").val(ultimocaracter.substring(0,$("#rifIn").val().length-1));
                            var newValor = $("#rifIn").val().split('´');
                     
                      $("#rifIn").val(newValor[0]);}else
                      {
                      var newValor = $("#rifIn").val().split('´');
                     
                      $("#rifIn").val(newValor[0]);
                      }
                      
                      var key = e.keyCode || e.which;
                      if(key==13)
                      $('#tipoIn').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
 
$('#tipoIn').on('change', function (e) {
    

                          $('#descripcion').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
$('#descripcion').on('keyup', function (e) {
    
                              var ultimocaracter = $("#descripcion").val();

                                var cadena =ultimocaracter.substring($("#descripcion").val().length-1);
                                if(cadena =="´") {

                                $("#descripcion").val(ultimocaracter.substring(0,$("#descripcion").val().length-1));
                                      var newValor = $("#descripcion").val().split('´');
                               
                                $("#descripcion").val(newValor[0]);}else
                                {
                                var newValor = $("#descripcion").val().split('´');
                               
                                $("#descripcion").val(newValor[0]);
                                }
                                
                                var key = e.keyCode || e.which;
                                if(key==13)
                                $('#telefonoIn').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
$('#telefonoIn').on('keyup', function (e) {
    
                              // var ultimocaracter = $("#telefonoIn").val();
                           var ultimocaracter = $("#telefonoIn").val();
                           var cadena =ultimocaracter.substring($("#telefonoIn").val().length-1);
                                if(cadena =="´") {

                                $("#telefonoIn").val(ultimocaracter.substring(0,$("#telefonoIn").val().length-1));
                                var newValor = $("#telefonoIn").val().split('´');
                               
                                $("#telefonoIn").val(newValor[0]);}else
                                {
                                var newValor = $("#telefonoIn").val().split('´');
                               
                                $("#telefonoIn").val(newValor[0]);
                                }
                              //   var cadena =ultimocaracter.substring($("#telefonoIn").val().length-1);
                              //   if(cadena != 0 && cadena != 1 &&
                              //      cadena != 2 && cadena != 3 &&
                              //      cadena != 4 && cadena != 5 &&
                              //      cadena != 6 && cadena != 7 &&
                              //      cadena != 8 && cadena != 9 ) {
                              //   $("#telefonoIn").val(ultimocaracter.substring(0,$("#telefonoIn").val().length-1));}
                              //   if($("#telefonoIn").val().length==4){$("#telefonoIn").val($("#telefonoIn").val()+'-');}
                              //   if($("#telefonoIn").val().length==8){$("#telefonoIn").val($("#telefonoIn").val()+'-');}
                              //   if($("#telefonoIn").val().length==11){$("#telefonoIn").val($("#telefonoIn").val()+'-');}
                                var key = e.keyCode || e.which;
                                if(key==13)
                                $('#coreoIn').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
$('#coreoIn').on('keyup', function (e) {
    
                             var ultimocaracter = $("#coreoIn").val();
                             var cadena =ultimocaracter.substring($("#coreoIn").val().length-1);
                                  if(cadena =="´") {

                                  $("#coreoIn").val(ultimocaracter.substring(0,$("#coreoIn").val().length-1));
                                        var newValor = $("#coreoIn").val().split('´');
                                 
                                  $("#coreoIn").val(newValor[0]);}else
                                  {
                                  var newValor = $("#coreoIn").val().split('´');
                                 
                                  $("#coreoIn").val(newValor[0]);
                                  }
                                  
                                  var key = e.keyCode || e.which;
                                  if(key==13)
                                  $('#estadoIn').focus();
      }); //
$('#estadoIn').on('change', function (e) {
    
                                    $('#municipioIn').focus();
}); //


$('#municipioIn').on('change', function (e) {

                                    $('#direccionIn').focus();

      }); //

$('#direccionIn').on('keyup', function (e) {
    
                               var ultimocaracter = $("#direccionIn").val();
                               var cadena =ultimocaracter.substring($("#direccionIn").val().length-1);
                                    if(cadena =="´") {

                                    $("#direccionIn").val(ultimocaracter.substring(0,$("#direccionIn").val().length-1));
                                          var newValor = $("#direccionIn").val().split('´');
                                   
                                    $("#direccionIn").val(newValor[0]);}else
                                    {
                                    var newValor = $("#direccionIn").val().split('´');
                                   
                                    $("#direccionIn").val(newValor[0]);
                                    }
                                    
                                    var key = e.keyCode || e.which;
                                    if(key==13)
                                    $('#RegistrarInstituto').focus();
}); //


