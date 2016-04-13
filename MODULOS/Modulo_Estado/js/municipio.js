
$("#Reporte").on('click',function()
  {
       ConfirmarReporteMunicipioGeneral();
  });
 

                $('#nombre').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou ');

                //Para escribir solo numeros    
                $('#codigo').validCampoFranz('0123456789'); 

$('#estado').on('change', function (e) {


      showselect($('#estado').val());
      $('#nombre').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !
 
$('#nombre').on('keyup', function (e) {
    
      showselect($('#nombre').val());
      var key = e.keyCode || e.which;
      $("#Registrar").attr("disabled",false);
      $("#Cancelar").attr("disabled",false);
      if(key==13)
      $('#codigo').focus();
      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !


$('#codigo').on('keyup', function (e) {
    
      var key = e.keyCode || e.which;
      if(key==13)
      $('#Registrar').focus();

      }); // PROGRAMANDO LA TECHA  ENTER MI  PANA  ANGELO METETELE !
      

 function showselect(str){
      
        $.ajax({
                
                async   :true, 
                
                cache   :false,
                
                type    : "POST",
                
                url     : "../controlador/recibeMunicipio.php",
                
                dataType: "html",
                
                data    : {
                
                  select       : $("#estado").val(),
                  nombre       : $("#nombre").val(),
                  codigo       : $("#codigo").val(),
                  
                  filDiferncial: 'ofcourse'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html     = "";

                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";
                    
                  $.each(Variable, function(index, value){

            html +="<tr class=municipio id="+value.id_municipio+" onclick=seleccionarfila(this)>"+
            
            "<td hidden></td>"+
            
            "<td>"+value.nombre_estado+"</td>"+
            
            "<td class=nombre_municipio >"+value.nombre_municipio+"</td>"+
            
            "<td class=codigo >"+value.codigo+"</td>"+
            
            "<td class='text-primary' > " + Icone +
            
            "<label hidden class=id_estado >"+value.id_estado+"</label>"+

            "<label class=id_municipio hidden>"+value.id_municipio+"</label></td></tr>";
                                
                    });
                   
                    ArmarTabla(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });
           
      }
      function ConfirmarReporteMunicipioGeneral()
      {
         $.ajax({
                
                async   :true, 
                
                cache   :false,
                
                type    : "POST",
                
                url     : "../controlador/recibeReportes.php",
                
                dataType: "html",
                
                data: {

                  TipoReporte : 'municipiosGeneral'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    if(Variable=='municipiosGeneral') 
                    
                     window.open('../controlador/recibeReportes.php');
                }

            });
        
      }

      function ArmarTabla (html)
      {

        $("#myTable ").empty();
        $("#myTable ").append(html);
        $('#myTable ').dataTable().fnDestroy();
        $('#myTable ').dataTable({ // Cannot initialize it again error
                "aoColumns": [
                  { "bSortable": false },
                  null, null, null, null
                  ],
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
          },'columnDefs'   : [{
          'targets'        : 4,
          'searchable'     : true,
          'orderable'      : false,
          'className'      : 'dt-body-center'
          
          },{
          'targets'        : [ 0 ],
          'searchable'     : false,
          'visible'        : false,                                
          }],
          'order'          : [1,'asc'],
          "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength" : 5
        }); 
              $("select.form-control").selectBoxIt();  
              AutoActivarTooltip();
    
      }

function buscarMunicipio(){
    
    var porId=document.getElementById("estado").value;
    var porId2=document.getElementById("nombre").value;
    var porid4  = "consulta";

    $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType:"html", 
        
        type    : 'POST',   
        
        url     : "../controlador/recibeMunicipio.php",
        
        data    : {
            select  : porId,      
            nombre  : porId2,
            consulta: porid4
              },
              
success: function(data){ 
  var result = $.trim(data);

     if(result){
        var variable = JSON.parse(data);
        var codigo=variable.codigo;//

    
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);
        $("#codigo").val(codigo);
      }else {              
        $("#Registrar").attr("disabled", false);
        $("#Modificar").attr("disabled",true);
        $("#Cancelar").attr("disabled",true);        
        $("#codigo").val("");
       
    }

    }
    });
    }


// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {
    $("#Modificar").click(function(){

        var veri =  ValidarRegistro();
       
            if(veri){
          
            modificarMunicipio();

            }
    }); 
});

    $(document).ready(function() {
    $("#Registrar").click(function(){

        var veri =  ValidarCampos();
       
            if(veri){
          
            RegistrarMunicipio();
            }
    }); 
});

    $(document).ready(function() {
    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 
});


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



function RegistrarMunicipio(){
    
    var porId  = document.getElementById("estado").value;
    var porId2 = document.getElementById("nombre").value;
    var porId3 = document.getElementById("codigo").value;
    var porid4  = "registra";
    
    if(porId3=="")
    {
        porId3 = "SIN CODIGO";
    }


    $.ajax({
       
        async   :true, 
       
        cache   :false,
       
        dataType:"html", 
       
        type    : 'POST',   
       
        url     : "../controlador/recibeMunicipio.php",
       
        data    : {

            id_estado: porId,      
            nombre   : porId2,
            codigo   : porId3,
            registra : porid4

              },
              
    success: function(data){ 
    var result = $.trim(data);
    
    if(data==1){
      
    swal("Bien",'Municipio Registrado!', "success");
   

    }else {    
    swal("Ups", "Error", "error");     
    
    }
    setTimeout(function(){restablecerForm();},1000);

    }
    });
    
}

function modificarMunicipio(){
    
    var porId  = document.getElementById("estado").value;
    var porId2 = document.getElementById("nombre").value;
    var porId3 = document.getElementById("codigo").value;
    var porid4  = "actualiza";
   
    $(".municipio").each(function(index,value){
            
            id_municipio= $(value).find(".id_municipio").html();

    });



    $.ajax({
       
        async   :true, 
       
        cache   :false,
       
        dataType:"html", 
       
        type    : 'POST',   
       
        url     : "../controlador/recibeMunicipio.php",
       
        data    : {
            id_estado   : porId,      
            nombre      : porId2,
            codigo      : porId3,
            id_municipio:id_municipio,
            actualiza   : porid4

              },
              
success: function(data){ 
  var result = $.trim(data);
    
    if(result){
      

    swal("Bien",'Municipio Modificado!', "success");
    

    }else {    
    swal("Ups", "Error", "error");           
    
    }

    setTimeout(function(){restablecerForm();},1000);
    }
    });
    
}
//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR


function ValidarRegistro()
{

    var porId  = document.getElementById("estado").value;
    var porId2 = document.getElementById("nombre").value;
    var porId3 = document.getElementById("codigo").value;
    

    $(".municipio").each(function(index,value){

            
            
            nombre_municipioViejo= $(value).children(".nombre_municipio").text();
            codigoViejo= $(value).children(".codigo").text();

    });
   var id_estadotabla = $(".id_estado").val();
   if((id_estadotabla==porId )&&(nombre_municipioViejo==porId2) &&(codigoViejo==porId3))
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

    var porId  = document.getElementById("estado").value;
    var porId2 = document.getElementById("nombre").value;

    if((porId<1)||(porId2==""))
      { 
        MensajeDatosNone();
        if((porId<1)||(porId=="")){
          $("#estado").focus();
        } 
        if(porId2==""){
          $("#nombre").focus();
        }
        
        
        return false;

      }else
      {
        return true;
       
      }

}

function seleccionarfila(tr){
    
                /*   $("tr .sigla ").each(function(index){
                    
                    $("#titlee").html($(tr).text());
 
                }); ME TRAE  TODA  LA  FILA SELECCIONADA DE LA TABLA */
  
                var id_municipio     ="";
                var nombre_estado    ="";
                var nombre_municipio ="";
                var codigo           = "";
                var id_estado        = $(".id_estado",tr).html();
                $('tr .municipio').each(function() {
                  
                  id_municipio     = $(tr).find("id_municipio").html();
                  nombre_estado    = $(tr).find("td").eq(0).text();
                  nombre_municipio = $(tr).find("td").eq(1).text();
                  codigo           = $(tr).find("td").eq(2).text();

                  });

                
          $("#nombre").val(nombre_municipio); 

         
          $("#codigo").val(codigo); 

          $("#estado option[value="+ id_estado +"]").prop("selected",true);

          $("#estado").data("selectBoxIt").refresh();
          Renderidng_select();

          $( "#nombre" ).keyup();

          buscarMunicipio();


         $("#nombre").off('keyup');
         $("#estado").off('change');
        
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);
    // $("#superidOrganizacion").val();


    //var sigla= $("td .municipio").text(); // -------- TODAS  LAS  COLUMNAS
    //$("#titlee").html(sigla);
    

    // El Codigo Malandro Super Tukki ..!
    // Gracias stack overflow ...


} 

function restablecerForm()
{

        $("#nombre").val("");
        $("#estado").val("");
        $("#codigo").val("");
        $("#nombre").keyup(buscarMunicipio,showselect);
        $("#estado").change(showselect);
        $( "#estado" ).change(function () { showselect });
        showselect();
        $("#estado").data("selectBoxIt").refresh();
         Renderidng_select();
       //$( "#page" ).load( "../vista/Municipio.phtml");

}
function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"width": "206px" ,  "height": "35px"});
}
$(document).ready(function() {

//nos quedaría definir el comportamiento usando jQuery:

// para cada fila del body de la tabla table_customer
// defino el comporatamiento que tendrá cuando el ratón
// pase por encima

$(".dataTables_paginate paging_simple_numbers").on('click', function(){
    $('[data-toggle="tooltip"]').tooltip();alert();
});

$('.municipio td').mouseover(function() {
     // a la fila sobre la que esté el ratón (this)
     // le añado la clase que la resaltará
     $(this).addClass("tr_hover");
    
});

// para cada fila del body de la tabla table_customer
// defino el comporatamiento que tendrá cuando el ratón
// deje de estar encima
$(".municipio td").mouseout(function() {
     // a la fila sobre la que esté el ratón (this)
     // le quito la clase que hace que resalte
     $(this).removeClass("tr_hover");
});
 });



function MensajeDatosNone()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Campos Vacios'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInRight',
        cssanimationOut: 'bounceOut',
        clearAll       : true
 
});



}
function MensajeModificarNone()
{


$.amaran({
        content        :{
        bgcolor        :'#3366FF',
        color          :'#fff',
        message        :'Modifique alguno de los  campos'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'bounceInRight',
        cssanimationOut: 'bounceOut',
        clearAll       : true
 
});

}
