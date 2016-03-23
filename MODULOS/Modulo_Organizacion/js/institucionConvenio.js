
$(document).ready(function(){

    $("#Subcursales").click(             function() { $("#tab3").addClass("tab-pane  active");          });

    $("#buscarRegistrios").click(        function() { BuscarRegistros(); $(this).prop('disabled',true); });

    $("#tablaInstitutoConvenio").on('click', function(){ ver_si_hay_registros('p'); $(this).prop('disabled',true);  });

    $("#subcursal").on('click',              function(){ ver_si_hay_registros('s'); $(this).prop('disabled',true);  });

    ids=Array();

    ids[0]={ id_Modal : '#tabla_Instituto'          , id_botone : '#buscarRegistrios' };
    ids[1]={ id_Modal : '#tabla_Instituto_Convenio' , id_botone : '#tablaInstitutoConvenio' };
    ids[2]={ id_Modal : '#tabla_Instituto_Convenio' , id_botone : '#subcursal' };

    $.each(ids , function(index, value){  

      $(this.id_Modal).on('shown.bs.modal', function(){ $(value.id_botone).prop('disabled',true);

      $(this).find('table').DataTable().columns.adjust().responsive.recalc();     });

      $(this.id_Modal).on('hide.bs.modal', function(){ $(value.id_botone).prop('disabled',false); });

    });    

    InicialiceTablas();

    iniciarEventosValidaciones();

    InicializarSelects();

});



function ver_si_hay_registros(action)
{

$.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType: "html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : {
              numeros : 'filas'
              },              
    
success: function(data){ 

  var variable = JSON.parse(data);
               
              if(data=='0')
              {
                  swal({   title:'Atención' , text:"No hay Organizaciones", type: "warning" });
                  $("#Institucion").focus();
              }else
              {
                      // var verificar_contenidio =contenidoverificar();

                     
                      // if(verificar_contenidio){
                              // tablaConvenio();
                              
                      // }else {
                                tablaConvenio();
                                    
                      //        }

                      $("#tabla_Instituto_Convenio").modal('show');
              }
                  $("#action").val(action);

    }//success
    }); // $.ajax()
}

function contenidoverificar( )
{
         var nombre_municipioViejo= $(".id_organizacionConvenio").val();
   

        if(nombre_municipioViejo == null){
          

          return false ;
        }
    else if(nombre_municipioViejo != null){  return  true;}
}

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

  $("#pregunta").selectBoxIt(Reutilizare);

  $("#tipoIn").selectBoxIt(Reutilizare);

  $("#estado0").selectBoxIt(Reutilizare);

  $("#municipio0").selectBoxIt(Reutilizare);

  $("#estado1").selectBoxIt(Reutilizare);

  $("#municipio1").selectBoxIt(Reutilizare);

  Renderidng_select();

  LlenarSelectsTodos(); 

}

function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"min-width": "206px" ,  "height": "35px"});
}


function iniciarEventosValidaciones()
{

      $('#nombreIn').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou.0123456789 ');
      $('#siglasIn').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou. ');
      $('#letra').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou');
      $('#rifIn').validCampoFranz('0123456789');
      $('#descripcion').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou0123456789 ');
      $('#telefonoIn').validCampoFranz('0123456789');
      $('#direccionIn').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou0123456789,.- ');

      $('#nombreIn').on('keyup', function (e) {

          var ultimocaracter = $("#nombreIn").val();

          var cadena =ultimocaracter.substring($("#nombreIn").val().length-1);

          var newValor = $("#nombreIn").val().split('´');

          $("#nombreIn").val(newValor[0]);

          var key = e.keyCode || e.which;

          if(key==13) $('#siglasIn').focus();

      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE ! 



      $('#siglasIn').on('keyup', function (e) {
          var key = e.keyCode || e.which;
              if(($("#siglasIn").val()==0)||
              ( $("#siglasIn").val()>0 ) )
              {   
                  var camp = $("#siglasIn").val();
                  var validado = camp.substring(0, camp.length-1);
                  $("#siglasIn").val(validado);
              }   
          var ultimocaracter = $("#siglasIn").val();

          var cadena =ultimocaracter.substring($("#siglasIn").val().length-1);

            if(cadena == 0 || cadena>0) {
            $("#siglasIn").val(ultimocaracter.substring(0,$("#siglasIn").val().length-1));}
            if(cadena =="´") {
            $("#siglasIn").val(ultimocaracter.substring(0,$("#siglasIn").val().length-1));}

          var newValor = $("#siglasIn").val().split('´');

          $("#siglasIn").val(newValor[0]);

          if(key==13) $('#letra').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  

      $('#rifIn').on('keyup', function (e) {

          var ultimocaracter = $("#rifIn").val();

          var cadena =ultimocaracter.substring($("#rifIn").val().length-1);

          if(cadena != 0 && cadena != 1 &&
          cadena != 2 && cadena != 3 &&
          cadena != 4 && cadena != 5 &&
          cadena != 6 && cadena != 7 &&
          cadena != 8 && cadena != 9 ) {
          $("#rifIn").val(ultimocaracter.substring(0,$("#rifIn").val().length-1));}

          var newValor = $("#rifIn").val().split('´');

          $("#rifIn").val(newValor[0]);

          var key = e.keyCode || e.which;
          if(key==13)  $('#tipoIn').focus();

      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  

      $('#tipoIn').on('change', function (e) {

            $('#descripcion').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  

      $('#letra').on('keyup', function (e) {

          var ultimocaracter = $("#letra").val();


          var cadena =ultimocaracter.substring($("#letra").val().length-1);

          if(cadena =="´") {
          $("#letra").val(ultimocaracter.substring(0,$("#letra").val().length-1));}
          //$('#rifIn').focus();
          var key = e.keyCode || e.which;
          if(key==13) $('#rifIn').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !

      $('#descripcion').on('keyup', function (e) {

            var ultimocaracter = $("#descripcion").val();
            
            var cadena         = ultimocaracter.substring($("#descripcion").val().length-1);

            if(cadena =="´") {
              $("#descripcion").val(ultimocaracter.substring(0,$("#descripcion").val().length-1));}
            
            var newValor = $("#descripcion").val().split('´');

            $("#descripcion").val(newValor[0]);
            
            var key = e.keyCode || e.which;
            
            if(key==13) $('#telefonoIn').focus();

      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  
      

      $('#telefonoIn').on('keyup', function (e) {

          var ultimocaracter = $("#telefonoIn").val();
          
          var cadena         =ultimocaracter.substring($("#telefonoIn").val().length-1);

          if(cadena =="´") {
          $("#telefonoIn").val(ultimocaracter.substring(0,$("#telefonoIn").val().length-1));}


          var newValor = $("#telefonoIn").val().split('´');

          $("#telefonoIn").val(newValor[0]);

          var key = e.keyCode || e.which;
          if(key==13)   $('#coreoIn').focus();

      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !  

      $('#coreoIn').on('keyup', function (e) {

      var ultimocaracter = $("#coreoIn").val();

      var cadena =ultimocaracter.substring($("#coreoIn").val().length-1);

      if(cadena =="´") {
          $("#coreoIn").val(ultimocaracter.substring(0,$("#coreoIn").val().length-1));}
     
      var newValor = $("#coreoIn").val().split('´');

      $("#coreoIn").val(newValor[0]);
     
      var key = e.keyCode || e.which;
     
      if(key==13)  $('#estado0').focus();
      }); //

      $('#estado0').on('change', function (e) {

              $('#municipio0').focus();

      }); //


      $('#municipio0').on('change', function (e) {

              $('#direccionIn').focus();
      }); //
      $('#direccionIn').on('keyup', function (e) {

          var ultimocaracter = $("#direccionIn").val();

          var cadena =ultimocaracter.substring($("#direccionIn").val().length-1);

          if(cadena =="´") {
          $("#direccionIn").val(ultimocaracter.substring(0,$("#direccionIn").val().length-1));}
          
          var newValor = $("#direccionIn").val().split('´');

          $("#direccionIn").val(newValor[0]);

          var key = e.keyCode || e.which;
          
          if(key==13) $('#RegistrarInstituto').focus();

      }); //

      var municipio1 = '#municipio1';
      var municipio2 = '#municipio0';

      $("#estado1").change( function (){ buscarmunicipios("#estado1",municipio1); });
      
      $("#estado0").change( function (){ buscarmunicipios("#estado0",municipio2); });
      
      $("#nombreIn").val('');
      
      $("#descripcion").val('');
      
      $("#direccionIn").val('');
      
      $("#RegistrarInstituto").click(function(){

          var verificarCampos = Validad();
          if(verificarCampos){

          RegistrarInstituto(); // REGISTRA

          restablecerFormulario();  // LIMPIA  CAMPOS  COMO  EN JAVA! MI  AMOR  JAVA

          }

      });

}



function LlenarSelectsTodos()
{
  $.ajax({
        
        async   : true, 
        
        cache   : false,
        
        dataType: "json", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : 
        {
            
            BuscarInformacionDeTodosLosSelectsDelConvenio : 'Yesssss!'

        },              
    
        success: function(data)
        {  

            if(data['TipoOrganizacion'].length > 0){

                $.each(data['TipoOrganizacion'] , function( keys ,values ){

                    $("#tipoIn").append('<option value='+values['id_tipo_organizacion']+'>'+values['nombre_tipo_organizacion']+'</option>');

                });

                $("#tipoIn").data("selectBoxIt").refresh();
                 Renderidng_select();
            }

              if(data['Estado'] .length > 0){

                $.each(data['Estado'], function ( keys , values ){

                    $("#estado0").append('<option value='+values['id_estado']+'>'+values['nombre_estado']+'</option>');

                    $("#estado1").append('<option value='+values['id_estado']+'>'+values['nombre_estado']+'</option>');
                });

                $("#estado0").data("selectBoxIt").refresh();

                $("#estado1").data("selectBoxIt").refresh();
                Renderidng_select();
              }

        }
  });

}

function tablaConvenio(){
          

$.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType: "html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : {
            
              tablainstitutoConvenio : 'Convenio'
              },              
    
        success: function(data){ 

        var variable = JSON.parse(data);
               
                  var contenido ;
          $.each(variable, function(index, value){
            

             contenido +="<tr class=Convenio id="+variable[index].id_organizacion+" onclick=seleccionarfilaConvenio(this);  >"+
              
              "<td>" + variable[index].siglas + "</td>"+
              
              "<td>" + variable[index].institutoPrincipal + "</td>"+

              "<td>" + variable[index].nombre_tipo_organizacion + "</td>"+

              "<td> "+"<input type=hidden class=id_organizacionConvenio value="+variable[index].id_organizacion+">"+

              "<img src=../../../img/iconos/ok.png alt=Ginger class=left width=20 ./></td></tr>";

          });

          ArmarTablaPRO(  "#tabla-Convenio",'<tbody>'+contenido+'</tbody>');
          
    }//success
    }); // $.ajax()
    

}
 
function ArmarTablaPRO (  tabla , Contenido)
{

        $(tabla).empty();
        $(tabla).append(Contenido);
        $(tabla).dataTable().fnDestroy();
        $(tabla).dataTable({ // Cannot initialize it again error
        "aoColumns"      : [
        { "bSortable"    : false },
        null, null, null
        ],
        
        "language"       : {
        "sProcessing"    : "Procesando...",
        "sLengthMenu"    : 'Mostrar _MENU_ Registros',
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
        } ,
        "oAria"          : {
        "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        },
        'columnDefs'     : [{
        'targets'        : 3,
        'searchable'     : true,
        'orderable'      : false,
        'className'      : 'dt-body-center'
        }] 
        
        ,
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5

        }); 
  
            var dataTable= $(tabla).DataTable();
            //recalculate the dimensions
            dataTable.columns.adjust().responsive.recalc();

$("select").selectBoxIt();
} // FIN ARMAR tablas DATA TABLE PROSZX'DA
 

function BuscarRegistros(){
       
   $.ajax({

            async   :true, 

            cache   :false,

            dataType: "html", 

            type    : 'POST',   

            url     : "../controlador/recibeInstitutoFormulario.php",

            data    : {
            
            numerosPrincipales : 'filas'
              },              
    
success: function(data){ 
 
    
    
  if(data==0)
    {
         swal({  title:'Atención', text: "No hay Instituciones Principales", type: "warning" });
    }else{
          MostrarInstitutoPrincipal();
    }
               

    }//success
    }); // $.ajax()

}
 

function MostrarInstitutoPrincipal()
{

$.ajax({
        
          async   :true, 
          
          cache   :false,
          
          dataType: "html", 
          
          type    : 'POST',   
          
          url     : "../controlador/recibeInstitutoFormulario.php",
          
          data    : {
            
            tabla : 'bla'
              },              
    
success: function(data){ 
    
  var variable = JSON.parse(data);
               
                  var contenido ='' ;
                $.each(variable, function(index, value){
   
                   contenido +="<tr class=sigla aria-hidden='true' onclick=seleccionarfila(this);  id="+index+"  >"+
                    
                    "<td>" + value.siglas +  "</td>"+
                    
                    "<td>" + value.nombre_estado + "</td>"+
                    
                    "<td>" + value.nombre_municipio + "</td>"+
                    
                    "<td>" + value.nombre_tipo_organizacion + "</td>"+
                    
                    "<td> <img src=../../../img/iconos/ok.png alt=Ginger class=left width=20 ./>" +
                    
                    "<label hidden class=id_organizacion >"+value.id_ip+"</label></td></tr>";


                });
                  ArmarTabla (  '#myTable' , '<tbody>'+contenido+'</tbody>');
                $("#tabla_Instituto").modal('show');

    }//success
    }); // $.ajax()
    

}

      function ArmarTabla (  tabla , Contenido)
      {

        $(tabla).empty();
        $(tabla).append(Contenido);
        $(tabla).dataTable().fnDestroy();
        $(tabla).dataTable({ // Cannot initialize it again error
          "aoColumns"      : [
          { "bSortable"    : false },
          null, null, null, null
          ],
          
          "language"       : 
          {
          "sProcessing"    : "Procesando...",
          "sLengthMenu"    : 'Mostrar _MENU_ Registros',
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
          'columnDefs'     : 
          [{
          'targets'        : 4,
          'searchable'     : true,
          'orderable'      : false
          }],

          "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength" : 5,responsive:true
        }); 
    
  $("select").selectBoxIt();

} // FIN ARMAR tablas DATA TABLE PROSZX'DA



function  ArmarTablaSucursal( tabla , contenido)
{
        $(tabla).empty();
        $(tabla).append(contenido);
        $(tabla).dataTable().fnDestroy();
        $(tabla).dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null, null
          ],

        "language"       : {
        "sProcessing"    : "Procesando...",
        "sLengthMenu"    : 'Mostrar _MENU_ Registros',
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
        'columnDefs'     : [{
        'targets'        : [ 4 ],
        'searchable'     : true,
        'orderable'      : false
                           }],

        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5,responsive:true
        }); 
        //$("select").selectBoxIt();
        $("select.form-control").selectBoxIt();

      $(tabla+" tbody").on('click','tr',function(){

        var codigo= $(this).find('td').eq(5).text();
        $("#codigosucursal").html(codigo);
          
      });

} // fin de  function armartabla  sucursal


function RegistrarInstituto()
{

var id_ip       =   $("#superidOrganizacion").val();
var nombre      =   $("#nombreIn").val();
var siglas      =   $("#siglasIn").val();
var rif         =   $("#rifIn").val();
var codigo      =   $("#codigoIn").val();
var tipo        =   $("#tipoIn").val();
var descripcion =   $("#descripcion").val();
var telefono    =   $("#telefonoIn").val();
var correo      =   $("#coreoIn").val();

var municipio   =   $("#municipio0").val();
var direccion   =   $("#direccionIn").val();

    $.ajax({
           
            async   :true, 
           
            cache   :false,
           
            dataType: "html", 
           
            type    : 'POST',   
           
            url     : "../controlador/recibeInstitutoFormulario.php",
           
            data    : 
            {
       
              id_ip            : id_ip,
              codigo           : codigo,
              nombre           : $ .trim(nombre),
              rif              : $ .trim($("#letra").val()+'-'+rif ),
              tipo             : $ .trim(tipo),
              descripcion      : $ .trim(descripcion),
              telefono         : $ .trim(telefono),
              correo           : $ .trim(correo),
              municipio        : $ .trim(municipio),
              direccion        : $ .trim(direccion),          
              siglas           : $ .trim(siglas), 
              InstitutoConvenio: 'Regisrta' 
            },              
    
          success: function(data){ 
 
 
            var variable = JSON.parse(data);

            if(variable.return1 == 1 && variable.return3==1 && variable.return4==1)
            {
              swal({  title:'Bien', text: "Organización Registrada", type: "success" });
            
            }else {
                swal({  title:'Upss', text: "Error De Programación", type: "error" });
            }

    }
    });
    

}

var mensajeEmerjente;
function buscarmunicipios(estadoid,selectid)
{
  
  var estado = $(estadoid).val();

    $.ajax({

          async   :true, 
          
          cache   :false,
          
          dataType: "html", 
          
          type    : 'POST',   
          
          url     : "../controlador/recibeInstitutoFormulario.php",
          
          data    : {
          
           select          :estado,
           buscarmunicipios: 'Regis' 
              },              
    
        success: function(data){ 
        
        var variable = JSON.parse(data);
            
            
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
                
                $(selectid).data("selectBoxIt").search('');

                $("#Subcursales").focus();
                
                Renderidng_select();

                mensajeEmerjente= MensajeSeleccioneMunicipio(variable[0].nombre_estado);
            }else { 

              $(selectid).empty();
              
              $(selectid).append('<option value='+''+'>'+'NO HAY MUNICIPIOS'+'</option>');
              
              $(selectid).data("selectBoxIt").refresh();

              $(selectid).data("selectBoxIt").disable(); 

              Renderidng_select();

            }

    }
    });
    

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
 var estado      = $("#estado0").val();
 var municipio   = $("#municipio0").val();
 var direccion   = $("#direccionIn").val();


if($("#superidOrganizacion").val()==''){

      MensajeInstitunoNoSeleccionado();
      
      return false;
}else

 if (nombre==""){

      MensajeCamposVaciosOrganizacion();
      $("#nombreIn").focus();
      return false;
 
 }else if($("#letra").val()=='' || $("#letra").val()==' ' ){

      MensajeCamposVaciosOrganizacion();
      $("#letra").focus();
      return false;
 }else if (rif=="" || rif==" " ){

      MensajeCamposVaciosOrganizacion();
      $("#rifIn").focus();
      return false;
 }else if (codigo==""){

      MensajeCamposVaciosOrganizacion();
       $("#codigoIn").focus();
      return false;
 }else if (tipo==""){

      MensajeCamposVaciosOrganizacion();
       $("#tipoIn").focus();
      return false;
 }else if (descripcion==""){

      MensajeCamposVaciosOrganizacion();
       $("#descripcion").focus();
      return false;
 }else if (telefono==""){
  
      MensajeCamposVaciosOrganizacion();
       $("#telefonoIn").focus();
      return false;
 }else if (correo==""){

      MensajeCamposVaciosOrganizacion();
       $("#coreoIn").focus();
      return false;
 }else  if (estado==""){

      MensajeCamposVaciosOrganizacion();
       $("#estado0").focus();
      return false;
 }else  if (municipio==""){

      MensajeCamposVaciosOrganizacion();
       $("#municipio0").focus();
      return false;
 }else if (direccion==""){

      MensajeCamposVaciosOrganizacion();
       $("#direccionIn").focus();
      return false;
 }else {
      return true;
 }

}

function restablecerFormulario()
{
  $("#titlee").html('')
  $("#superidOrganizacion").val('');
  $("#nombreIn").val('');
  $("#siglasIn").val('');
  $("#letra").val('');
  $("#rifIn").val('');
  $("#codigoIn").val('');
  $("#tipoIn").val('');
  $("#descripcion").val('');
  $("#telefonoIn").val('');
  $("#coreoIn").val('');
  $("#estado0 ").val('');
  $("#municipio0 ").val('');
  $("#direccionIn").val('');

  $("#municipio0").html('<option value='+''+'>Esperando Estado</option>');

  $("#tipoIn").data("selectBoxIt").refresh();

  $("#estado0").data("selectBoxIt").refresh();

  $("#municipio0").data("selectBoxIt").refresh();

  Renderidng_select();

}


function seleccionarfilaConvenio(tr){
    
          if ($("#action").val() == 'p')
          {  
          
            Buscarsucursales($(".id_organizacionConvenio",tr).val());

          }else if ($("#action").val() == 's')
          {
            datoscentral($(".id_organizacionConvenio",tr).val());

          }

} 

$("#municipio1").on('change' , function (){

  $("#domiciliosucur").focus();
});

$("#Registrarsucursal").on('click', function(){

  var verificar = validarsucursal();
        if(verificar)
        {
            EstaSucursalR();
        }else 
        {

        }
});


function  Buscarsucursales(idOrganizacion)
{

 $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType: "html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeInstitutoFormulario.php",
        
        data    : {
            
                BuscarSucursales : idOrganizacion
              },              
    
success: function(data){ 


      var resul = JSON.parse(data);
     
    if(resul[0].numero == 0 )
    {
         swal({   title: "LOQUITO", type: "warning" });
    }else if(resul[0].numero == 1)
    {          
         $("#titlee_pepple").html(resul[0].nombre_organizacion);
         MensajeInformacionOrganizacion(resul[0].nombre_organizacion ,resul[0].observacion ,resul[0].nombre_estado ,resul[0].nombre_municipio ,resul[0].domicilio );
          
         $("#codigosucursal").html(resul[0].codigo_sucursal);
    }else if(resul[0].numero > 1)
    {     
          if( resul[0].siglas=='')
          {
                resul[0].siglas=resul[0].nombre_organizacion;
          }
         
          $("#headorganizacion").html('<img src="../../../img/Ico-master/PNG/64px/local-sucursal.png" width="40"> '+'Nombre Oraganizaci&oacute;n : '+resul[0].siglas);
            var contenido;
              $.each(resul, function(index, value){

                    
                   contenido +="<tr class=sucursaltable  id="+"'cursal"+index+"'"+"  onclick=SeleccionaSucursal(this,"+"'"+value.siglas+"'"+") >"+
                    
                    "<td>" + value.nombre_estado +  "</td> "+

                    "<td>" + value.nombre_municipio +  "</td> "+
                    
                    "<td>" + value.domicilio +"</td>"+

                    "<td>" + value.observacion + "</td>"+

                    "<td > <img src=../../../img/iconos/ok.png alt=Ginger class=left width=20 ./>"+
                    
                    "<label hidden style=display:none class=codesuccursel >" +value.codigo_sucursal+ "</label></td> </tr>";


                });

                  ArmarTablaSucursal(  '#sucursales', '<tbody>'+contenido+'</tbody>'); // ACTUALIZO LA  TABLA
                 $(' #tabla_sucursales').modal('show');         //MUESTRO MODAL  CON TABLA  LLENA
                

    }
               
    
    }//success
    }); // $.ajax()

                      //$("#titlee_pepple").html(Siglas); // IMPRIMIR en la  etiqueta P // IMPRIMIR en la  etiqueta P
                      $("#id_Organizacion_convenio").val(idOrganizacion); //IMPRIMIR  EN EL CAMPO OCULTO
                      $(' #tabla_Instituto_Convenio').modal('hide');
                     


}


function SeleccionaSucursal( tr , nombre_organizacion )
{                  
          
                var codigo_sucursal = "";
                var Estado          = "";
                var Municipio       = "";
                var direccion       = "";
                var sede            = "";

                  codigo_sucursal = $(tr).find(".codesuccursel").html();
                  Estado          = $(tr).find("td").eq(0).text();
                  Municipio       = $(tr).find("td").eq(1).text();
                  direccion       = $(tr).find("td").eq(2).text();
                  sede            = $(tr).find("td").eq(3).text();


            
          $("#codigosucursal").html(codigo_sucursal);
          $("#titlee_pepple").html(nombre_organizacion);
          $(' #tabla_sucursales').modal('hide');         //MUESTRO MODAL  CON TABLA  LLENA
          MensajeInformacionOrganizacion(nombre_organizacion ,sede ,Estado ,Municipio,direccion);


}

function EstaSucursalR()
{

   $.ajax({
          
          async   :true, 
          
          cache   :false,
          
          dataType: "html", 
          
          type    : 'POST',   
          
          url     : "../controlador/recibeInstitutoFormulario.php",
          
          data    : 
          {
            
           id_organizacion:$ .trim($("#centralorganizacion").val()),
           id_estado      :$ .trim($("#estado1").val()),
           id_municipio   :$ .trim($("#municipio1").val()),
           direccion      :$ .trim($("#domiciliosucur").val()),
           Sucursal       : 'YEA'
          },              
    
          success: function(data){ 

        
              if(data==0)
              {
                   swal({   title: "Error De Asignación", type: "error" });
              }else{
                   swal({   title: "Sucursal Asignada Correctamente", type: "success" });
              }
                         
              limpiarFormsucursal ();
          }//success
    }); // $.ajax()

}

function validarsucursal ()
{
 
      if( $("#centralorganizacion").val() =='' )
      {

        MensajeSeleccioneCentral();
          return false;
      }
      else if($("#estado1").val()=='')
      { 
        MensajeSeleccioneEstado();
          $("#estado1").focus();
          return false;
      }else if ($("#municipio1").val()=='')
      { 
        MensajeSeleccioneMunicipio(mensajeEmerjente);
        $("#municipio1").focus();
        return false;
      }else if($("#domiciliosucur").val()=='')
      { 
        MensajedomicilioSucursal();
          $("#domiciliosucur").focus();
        return false;
      }else 
      {
        return true;
      }
}
 function limpiarFormsucursal()
 {
              $("#centralorganizacion").val('');
              $("#estado1").val('');
              $("#municipio1").val('');
              $("#domiciliosucur").val('');
              $("#centralname").val('');
              $("#centraltipo").val('');
              $("#centralestado").val('');
              $("#centralmunicipio").val('');
              $("#centraldomicilio").val('');
              $("#centralorganizacion").val('');

  $("#municipio1").html('<option value='+''+'>Esperando Estado</option>');

  $("#estado1").data("selectBoxIt").refresh();

  $("#municipio1").data("selectBoxIt").refresh();

  Renderidng_select();
 }

function datoscentral(id_organizacion)
{
        
        $.ajax({
      
                async   :true, 
      
                cache   :false,
      
                dataType: "html", 
      
                type    : 'POST',   
      
                url     : "../controlador/recibeInstitutoFormulario.php",
      
                data    : {
            
            datosfromcentral : id_organizacion
              },              
    
        success: function(data)
        { 
 
        
        var decode = JSON.parse(data);
              
              $("#centralname").val(decode.nombre_organizacion);
              
              $("#centraltipo").val(decode.nombre_tipo_organizacion);
              
              $("#centralestado").val(decode.nombre_estado);
              
              $("#centralmunicipio").val(decode.nombre_municipio);
              
              $("#centraldomicilio").val(decode.domicilio);
              
              $("#centralorganizacion").val(id_organizacion);

        }//success
        }); // $.ajax()

              $(" #tabla_Instituto_Convenio").removeClass("in");
              $(".modal-backdrop").remove();
              $(' #tabla_Instituto_Convenio').modal('hide');

}


function MensajeCamposVaciosOrganizacion()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Este Campo Vacío'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
 
});

}
function MensajeInstitunoNoSeleccionado()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Instituto No Seleccionado'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
 
});
}

function MensajeRegistrado()
{
$.amaran({
           content        :{
           bgcolor        :'#0066CC',
           color          :'#fff',
           message        :'Operacion Exitosa'
           },
           theme          :'colorful',
           
           cssanimationIn :'bounceInRight',
           cssanimationOut:'rollOut',
           position       :'top right',
           'clearAll'     :true
        });

}

function MensajeInstitutoNoRegistrado()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'No hay Organizaciones'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
 
});
}

function MensajeSeleccioneMunicipio(nombreEstado)
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Selecciona un municipio del estado '+nombreEstado+''
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
 
});
return nombreEstado;
}

function MensajeSeleccioneEstado ()
{
$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Selecciona un Estado para la Sucursal'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
});
}

function MensajeSeleccioneCentral ()
{
$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Selecciona una Organizacion Central'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
});

}

function MensajedomicilioSucursal()
{
  $.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Escribe la dirección de la sucursal'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
});
}

function MensajeInstitutoPrincipalesNOExiste()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'No hay Organizaciones'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        'clearAll'     :true
 
});
}


function MensajeInformacionOrganizacion(nombre_organizacion ,sede ,Estado ,Municipio,direccion)
{


$.amaran({
            content        :{
            bgcolor        :'#0066CC',
            color          :'#fff',
            align          :"center",
            'message'      : '<strong>'+nombre_organizacion+'</strong><br>'+sede+'<br>'+Estado+'<br>'+Municipio+'<br>'+direccion
            },
            theme          :'colorful',
            position       :'bottom right',
            'sticky'       :true,
            'closeOnClick' :false,
            cssanimationIn : 'bounceInUp',
            cssanimationOut: 'rollOut',
            'clearAll'     :true
 
});
    

}

function InicialiceTablas()
{
    $('#myTable').DataTable({

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
      "sSortAscending" :  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                         }

      },

      "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
      "iDisplayLength" : 5
  });
  
  $('#tabla-Convenio').DataTable({

  
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
      "sSortAscending" :  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                         }

      },

      "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
      "iDisplayLength" : 5
      });


  $('#sucursales').DataTable({

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
      "sSortAscending" :  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                         }

      },

      "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
      "iDisplayLength" : 5
    });
}

