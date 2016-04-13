
$("#Reporte").on('click',function()
  {
       MandarAConfirmarReporte();
  });

                $('#nombre').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou ');

                //Para escribir solo numeros
                $('#codigo').validCampoFranz('0123456789');


$('#nombre').on('keyup', function (e) {

      buscarEstado();
      showselect($('#nombre').val());
      var key = e.keyCode || e.which;
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

                url     : "../controlador/recibeEstado.php",

                dataType: "html",

                data    : 
                {

                  nombre       :$("#nombre").val(),

                  codigo       :$("#codigo").val(),

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

            html+="<tr class=estado id="+value.id_estado+" onclick=seleccionarfila(this);>"+

            "<td hidden></td>"+

            "<td class=nombre_estado>"+value.nombre_estado+"</td>"+

            "<td class=codigo>"+value.codigo+"</td>"+

            "<td >"+value.contermunicipios+"</td>"+

            "<td class='text-primary'>"+Icone+"<label hidden class=id_estado >"+value.id_estado+"</label></td></tr>";

                    });

            ArmarTabla(html);
            $('[data-toggle="tooltip"]').tooltip();
            
                }

            });

      }

      function MandarAConfirmarReporte()
      {
    $.ajax({

            async   :true,

            cache   :false,

            type    : "POST",

            url     : "../controlador/recibeReportes.php",

            dataType: "html",

            data    : {

              TipoReporte :'estadoGeneral'
            },
            success: function (data) {

                var Variable = JSON.parse(data);
                if(Variable == 'estadoGeneral'){

                    window.open('../controlador/recibeReportes.php');
                }


            }

            });
      }
      function ArmarTabla (html)
      {

        $("#myTable").empty();
        $("#myTable").append(html);
        $('#myTable').dataTable().fnDestroy();
        $('#myTable').dataTable({ // Cannot initialize it again error
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
      'searchable'     :true,
      'orderable'      :false,
      'className'      : 'dt-body-center'

      },{
      'targets'        : [0],
      'searchable'     : false,
      'visible'        : false
      }] ,
      "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
      "iDisplayLength" : 5
      });
          $("select.form-control").selectBoxIt();
          AutoActivarTooltip();
      }





    $("#Registrar").click(function(){

        	var veri =  ValidarCampos();

            if(veri){
            buscardatos( $("#codigo").val() ,$("#nombre").val() , 'R'  );

            }
    });

     $("#Modificar").click(function(){


         var veri =  ValidarRegistro();

             if(veri){
             buscardatos( $("#codigo").val() ,$("#nombre").val() ,'M' );

             }
    });
    $("#Cancelar").click(function(){


            restablecerForm();
    });



function buscarEstado(){

    var porId   = $("#nombre").val();
    var porId2  = $("#codigo").val();
    var porid4  = "consulta";

    $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeEstado.php",

        data    : {
            codigo  : porId2,
            nombre  : porId,
            consulta: porid4
              },

success: function(data){



    var variable = JSON.parse(data);
    if(variable.num === 1){

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

function RegistrarEstado(){


    var porId2 =  $("#nombre").val();
    var porId3 =  $("#codigo").val();
    var porid4 = "registra";


    if(porId3=="")
    {
        porId3 = "SIN CODIGO";
    }


    $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeEstado.php",

        data    : {

            nombre   : porId2,
            codigo   : porId3,
            Registrar: porid4

              },

    success: function(data){
    var result = $.trim(data);

    if(data==1){

    swal("Bien",'Estado Registrado!', "success");

    }else {
    swal("Ups", "Ocurrio un Error", "error");

    }

      setTimeout( function(){restablecerForm();},1000);
    }
    });

}


function modificarEstado(){


    var porId2 = document.getElementById("nombre").value;
    var porId3 = document.getElementById("codigo").value;
    var porid4  = "actualiza";


    $.ajax({

        async   :true,

        cache   :false,

        dataType:"json",

        type    : 'POST',

        url     : "../controlador/recibeEstado.php",

        data    : {

            id_estado: $("#id_estado").val(),
            nombre   : porId2,
            codigo   : porId3,

            Modificar: porid4

              },

success: function(data){


    if(data==1){


    swal("Bien",'Estado Modificado!', "success");



    }else {
    swal("UPs", "Algo anda mal en el Servidor", "error");


    }
    setTimeout( function(){restablecerForm();},1000);


    }
    });


        //showselect('');


}

function ValidarCampos()
{

    var porId  = document.getElementById("codigo").value;
    var porId2 = document.getElementById("nombre").value;


        if(porId2=="")
        {

        	MensajeDatosNone();
        	$("#nombre").focus();
          	//$("#codigo").focus();
          	return false;

        }
        else
        if(porId=="")
        {

        	MensajeDatosNone();
        	$("#codigo").focus();
          	//$("#codigo").focus();
          	return false;
        }
        else
        if (porId2.length <= 3)
        {
            MensajeNombreCorto();
        	$("#nombre").focus();

            return false;
        }
        else if((porId2!="")&&(porId2!=""))
        {

             return true;
        }



}

function buscardatos( codigo , nombre ,decision)
{


    $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeEstado.php",

        data    : {

            nombre : nombre,
            codigo : codigo,

            VerificarDatos : 'plo'

              },

success: function(data){


        var variable = JSON.parse(data);
        if(variable.nombre==1 && variable.codigo==1)
        {
            MensajeEsteRegistroYaExiste(codigo, nombre);

        }
        else
        if(variable.nombre==1 && decision=='R')
        {
            MensajeEsteDatoYaExiste(  );
                $("#nombre").focus();
        }else if(variable.codigo==1 && decision=='R')
        {
             MensajeEsteDatoYaExiste();
             $("#codigo").focus();

        }else if (variable.nombre==0 && variable.codigo==0)
        {
                    if(decision=='R')
                    {
                        RegistrarEstado();

                    }else if(decision=='M')
                    {
                        modificarEstado();
                    }
        } else if((variable.nombre==1 && variable.codigo==0) || (variable.nombre==0 && variable.codigo==1))
        {
                    if(decision=='M')
                    {
                        modificarEstado();
                    }
        }


    }
    });

}


function ValidarRegistro()
{


    var porId2 = document.getElementById("nombre").value;
    var porId3 = document.getElementById("codigo").value;
    var nombre_estadoViejo;
    var codigoViejo;

    $(".estado").each(function(index,value){

      nombre_estadoViejo = $(value).children(".nombre_estado").text();
      codigoViejo        = $(value).children(".codigo").text();

    });

    if((nombre_estadoViejo==porId2)&&(codigoViejo==porId3))
    {
        MensajeModificarNone();
        return false;
    }else if(porId2=='')
    {
    	MensajeDatosNone();
        return false;
    }else if(porId3=='')
    {
    	MensajeDatosNone();
        return false;
    }else
    {
        return true;
    }

}


function seleccionarfila(tr){

          estado =  $(tr).find("td").eq(0).text();
          codigo = $(tr).find("td").eq(1).text();

          $("#id_estado").val($(tr).find(".id_estado").html());



        $("#nombre").val(estado);

        $("#codigo").val(codigo);

         showselect();

        $("#nombre").off('keyup');

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

        $("#codigo").val("");
        $("#nombre").on('keyup', function (e) {

      buscarEstado();
      showselect($('#nombre').val());
      var key = e.keyCode || e.which;
      if(key==13)
      $('#codigo').focus();
        });

        $("#codigo").change(showselect);

        $("#Registrar").attr("disabled", false);
        $("#Modificar").attr("disabled",true);
        $("#Cancelar").attr("disabled",true);
        showselect();

       //$( "#page" ).load( "../vista/Municipio.phtml");

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

        cssanimationIn : 'bounceInRight',
        cssanimationOut: 'bounceOut',
        clearAll       : true

});
}

function MensajeNombreCorto(){

        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Nombre Muy corto'
                   },
                   theme          :'colorful',

                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'bottom right',
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



function MensajeEsteRegistroYaExiste(codigo, nombre)
{
        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'El Estado :'+nombre+' y Código :'+codigo+' ya existen'
                   },
                   theme          :'colorful',

                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'bottom right',
                   clearAll       : true
                });

}

function MensajeEsteDatoYaExiste()
{
        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Este dato ya fue registrado'
                   },
                   theme          :'colorful',

                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'bottom right',
                   clearAll       : true
                });

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