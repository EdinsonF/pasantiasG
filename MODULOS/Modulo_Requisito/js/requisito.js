
 function AprobarReportedeRequisitos()
 {
    $.ajax({

        async   :true,

        cache   :false,

        type    : "POST",

        url     : "../controlador/recibeReportes.php",

        dataType: "html",

        data    : {

          TipoReporte :'Requisito_General'
        },
        success: function (data) {

            var Variable = JSON.parse(data);
            if(Variable=='Requisito_General') window.open('../controlador/recibeReportes.php');
        }

    });

 }

 function BuscarDatos(){



        $.ajax({

                async   :true,

                cache   :false,

                type    : "POST",

                url     : "../controlador/recibeRequisito.php",

                dataType: "html",

                data    : {
                   requisito  : $('#nombre').val(),
                   estatus    : $('#estatus').val(),
                   Tablafiltre:'ofcourse'
                },
                success: function (data) {

                    var Variable = JSON.parse(data);
                    var html     = "";
                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";

                    $.each(Variable, function(index, value){

            html+="<tr class=requisito onclick=seleccionarfila(this);>"+
               " <td hidden ></td>"+
            "<td class=nombre_requisito >"+value.nombre_requisito+

            "<label hidden class=id_requisito >"+value.id_requisito+"</label></td>"+

            "<td class=estatus >"+value.estatus+"</td>"+

            "<td class='text-primary'>"+Icone+"</td>"+

            "</tr>";

                    });

                    ArmarTabla(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });

      }// FION Function

    // Bloqueam



function RegistrarRequisito(){

    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;
    var porid3  = "registra";


    if(porId2=="")
    {
        porId2 = "SIN ESTATUS";
    }


    $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeRequisito.php",

        data    : {

            nombre_requisito: porId,
            estatus         : porId2,
            registra        : porid3

              },

    success: function(data){
    if(data==1){

    swal('Bien','El Requisito '+porId+' fue registrado ','success');


    }else {

    swal('Ups','El Requisito '+porId+' no se pudo registrar ','error');
    }
     setTimeout( function(){ restablecerForm() },1000 ) ;
    }
    });

}

function modificarRequisito(){

    var id     = document.getElementById("id_requisito").value;
    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;
    var porid3 = "actualiza";



    $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeRequisito.php",

        data    : {

            id_requisito    : id,
            nombre_requisito: porId,
            estatus         : porId2,
            actualiza       : porid3
              },

success: function(data){

        if(data ==1)
        {
            swal('Bien','El nuevo Requisito fue Actualizado','success');

        }
        else if(data ==0)
        {
            swal('Mal','Error de Programación','error');
        }

        setTimeout( function(){ restablecerForm() },1000 ) ;
    }
    });

}
//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR


function ValidarRegistro()
{

    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;

    $(".requisito").each(function(index,value){

            id                    = $(value).children(".id_requisito").text();
            nombre_requisitoViejo = $(value).children(".nombre_requisito").text();
            estatusViejo          = $(value).children(".estatus").text();

    });
   var id_requisitotabla = $(".id_requisito").val();
   if((id_requisitotabla==porId )&&(estatusViejo==porId2))
    {
        MensajeModificarNone();
        return false;
    }else if($("#nombre").val()=='')
    {
        MensajeDatosNone();
        $("#nombre").focus();
        return false;
    }
    else if($("#nombre").val().length<3)
    {
        MensajeminimoCaracter();
        $("#nombre").focus();
        return false;
    }else if($("#estatus").val()=='')
    {
        MensajeEstatusSelecct();
        $("#estatus").focus();
        return false;
    }
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
        MensajeEstatusSelecct();

        $("#estatus").focus();

        return false;

    }else if($("#nombre").val().length<3)
    {
            MensajeminimoCaracter();
            $("#nombre").focus();
            return false;
    }else
    {
        return true;

    }

}

function seleccionarfila(tr){

                  id_requisito     = $(tr).find(".id_requisito").html();
                  nombre_requisito = $(tr).find("td").eq(0).text();
                  estatus          = $(tr).find("td").eq(1).text();


          $("#id_requisito").val(id_requisito);
          $("#nombre").val(nombre_requisito);

          $("#estatus option[value="+ estatus +"]").prop("selected",true);
          $("#nombre").off('keyup');
          $("#estatus").off('change');

           $("#estatus").data("selectBoxIt").refresh();
          Renderidng_select();
        BuscarDatos();
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);

}

function restablecerForm()
{
        $("#nombre").val('');
        $("#estatus").val('');

        $("#Registrar").attr("disabled", false);
        $("#Modificar").attr("disabled",true);

        $("#estatus").data("selectBoxIt").refresh();

        tablaindex();
        eventos();
        Renderidng_select();

}

function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"width": "206px" ,  "height": "35px"});
}



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

        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        clearAll       : true 

});

}
function MensajeModificarNone()
{

$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'Modifique alguno de los  campos'
        },
        theme          :'colorful',
        position       :'bottom right',

        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        clearAll       : true 

});

}
function MensajeminimoCaracter()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'El nombre del requisito es muy corto'
        },
        theme          :'colorful',
        position       :'bottom right',

        cssanimationIn : 'bounceInUp',
        cssanimationOut: 'rollOut',
        clearAll       : true 

});
}

function MensajeEstatusSelecct()
{


$.amaran({
            content        :{
            bgcolor        :'#0066CC',
            color          :'#fff',
            message        :'Seleccione Un Estatus'
            },
            theme          :'colorful',
            position       :'bottom right',

            cssanimationIn : 'bounceInUp',
            cssanimationOut: 'rollOut',
            clearAll       : true 

});
}

function tablaindex()
{
       $.ajax({

                async   :true,

                cache   :false,

                type    : "POST",

                url     : "../controlador/recibeRequisito.php",

                dataType: "html",

                data    : {

                  todaTabla:'ofcourse'
                },
                success: function (data) {

                    var Variable = JSON.parse(data);
                    var html     = "";

                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";

                    $.each(Variable, function(index, value){

            html+="<tr class=requisito onclick=seleccionarfila(this);>"+

            " <td hidden ></td>"+

            "<td class=nombre_requisito >"+value.nombre_requisito+"</td>"+

            "<td class=estatus >"+value.estatus+"</td>"+

            "<td class='text-primary'>"+Icone+"<label hidden class=id_requisito >"+value.id_requisito+"</label></td>"+

            "</tr>";

                    });

                    ArmarTabla(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });

      }

    function ArmarTabla(html){

        $("#myTable ").empty();
        $("#myTable ").append(html);
        $('#myTable').dataTable().fnDestroy();
        $('#myTable').DataTable({
        "aoColumns": [
          { "bSortable": false },
          null, null , null
          ],
        "language"       :
        {
        "sProcessing"    : "Procesando...",
        "sLengthMenu"    : "Mostrar _MENU_ Registros",
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
        "oPaginate"      :  {
        "sFirst"         : "Primero",
        "sLast"          : "Último",
        "sNext"          : "Siguiente",
        "sPrevious"      : "Anterior"
                            },
        "oAria"          :  {
        "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
        },
        'columnDefs'     :
        [{
        'targets'        : 3,
        'searchable'     :true,
        'orderable'      :false

        },{

        'targets'        : [0],
        'searchable'     : true,
        'orderable'      : false,
        'visible'        : false
        }] ,
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5
      });

    $("select").selectBoxIt();

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

    function eventos()
    {

    $('#nombre').on('keyup', function (e) {

      if($('#nombre').val()!= '' ){
                BuscarDatos();
      }else{    tablaindex();}
      var key = e.keyCode || e.which;
      if(key==13)
      $('#estatus').focus();
      });

    $('#estatus').on('change', function (e) {

        BuscarDatos();
        $('#Registrar').focus();

        });

    $("#Reporte").on('click',function(){

                AprobarReportedeRequisitos();
          });


    $("#Modificar").click(function(){

        var veri =  ValidarRegistro();

            if(veri){

                modificarRequisito();
            }
        });
    $("#Cancelar").click(function(){


            restablecerForm();
    });

    $("#Registrar").click(function(){

        var veri =  ValidarCampos();

        if(veri){
            RegistrarRequisito();
        }
        });

    }

    $(document).ready(function(){


        eventos();
    });
