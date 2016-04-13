
$(document).ready(function(){

$("#Reporte").on('click',function()
  {
        AprobarHacerREporteTipoSolicitud();
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
                VerificaesteTipo();

             }
    });
    $("#Cancelar").click(function(){


            restablecerForm();
    });
    $('#myTable').dataTable({


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
        'columnDefs'   : [{
      'targets'        : 4,
      'searchable'     :true,
      'orderable'      :false,
      'className'      : 'dt-body-center'
                         }] ,

      "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
      "iDisplayLength" : 5
        });

        tablaindex() ;


        AutocompletetipoSolicitud();

              $('.toggle-demo-check').bootstrapToggle({

                on:  'Si, Con Tutores',

                off: 'No, Sin Tutores'//,

                //offstyle:'danger'

              });
 $("#estatus").selectBoxIt({autoWidth:false ,

    // Uses the jQuery 'fadeIn' effect when opening the drop down
    showEffect: "fadeIn",

    // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
    showEffectSpeed: 400,

    // Uses the jQuery 'fadeOut' effect when closing the drop down
    hideEffect: "fadeOut",

    // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
    hideEffectSpeed: 400
 });

  Renderidng_select();
});

function VerificaesteTipo()
{

  $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeTipo_Solicitud.php",

        data    : {

            tipoSolicitud      : $("#nombre").val(),

            estatus            : $("#estatus").val(),

            descripcion        : $("#description").prop('checked'),

            verificarexistencia: 'Yes'

              },

success: function(data){


        if(data == 1)
        {
                TipoSolicitudExiste($("#nombre").val());
        }else {
                ModificarTipo_Solicitud('ambos');
        }

    }
    });

} // FIN VERIFICA

function AutocompletetipoSolicitud()
{
 $.ajax({

        async   :true,

        cache   :false,

        type    : "POST",

        url     : "../controlador/recibeTipo_Solicitud.php",

        dataType: "html",

        data    : {

            BuscarParaAutoComplete:'YES'
        },
        success: function (data)
        {

            var tipoSolicitud =  JSON.parse(data);

           tipoSolicitud= toObject(tipoSolicitud);

           $('#nombre').typeahead({

            minLength: 1,
            maxItem: 5,
            order: "asc",
            //hint: true,

           source: {
               data :tipoSolicitud.nombre
            }

        });

        }
      });


}

function toObject(arr) {

  var areglo = {};

  var arreglo = Array();

  $.each(arr , function(index , values){

    arreglo[index] = values.nombre_tipo_solicitud;

  });

  areglo['nombre'] =arreglo;

  return areglo;
}

function AprobarHacerREporteTipoSolicitud()
{
  $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeReportes.php",

        data    : {

            TipoReporte : 'Tipo_Solicitud_General'
              },

        success: function(data){
            var Variable = JSON.parse(data);
            if (Variable=='Tipo_Solicitud_General') window.open('../controlador/recibeReportes.php');
        }
    });

}

function buscar_Tipo_Solicitud(){

    var porId   = $("#nombre").val();
    var porId2  = $("#estatus").val();
    var porid4  = "consulta";

    $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeTipo_Solicitud.php",

        data    : {
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
        $("#estatus").val('');

    }

    }
    });
    }

function RegistrarTipo_Solicitud(){


    var porId2 =  document.getElementById("nombre").value;
    var porId3 =  document.getElementById("estatus").value;
    var porid4  = "registra";

    $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeTipo_Solicitud.php",

        data    : {

            nombre     : porId2,
            estatus    : porId3,
            descripcion: $('#description').prop('checked'),
            Registrar  : porid4

              },

    success: function(data){

    var result = $.trim(data);

        if(data==1)
        {
           swal({ title:"Bien ",text : "Tipo Solicitud Registrado", type: "success" });

        }else
        {

          swal({  title:"Upss ",text : "Error de Programación", type: "error" });
        }

         setTimeout(function(){ restablecerForm(); },1000);

    }
    });

}

function ModificarTipo_Solicitud(cual){

    $.ajax({

        async   :true,

        cache   :false,

        dataType:"html",

        type    : 'POST',

        url     : "../controlador/recibeTipo_Solicitud.php",

        data    : {
            id_tipo_solicitud: $("#id_tipo").val(),
            nombre           : $("#nombre").val(),
            estatus          : $("#estatus").val(),
            descripcion      : $('#description').prop('checked'),
            cual             : cual,
            Modificar        : 'actualiza'

              },

success: function(data){


        if(data==1)
        {
          swal( 'Bien', "Tipo Solicitud Modificado",  "success" );

        }else{

          swal( 'Mal', "Tipo Solicitud No modificada , Es posíble que ya existe asignada",  "error" );
        }

    setTimeout(function(){ restablecerForm() },1000);

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


            id                         = $(value).children(".id_tipo_solicitud").text();
            nombre_Tipo_SolicitudViejo = $(value).children(".nombre_Tipo_Solicitud").text();
            estatusViejo               = $(value).children(".estatus").text();

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

              var id_tipo_solicitud     =  $(tr).find(".id_tipo_solicitud").html();
              var nombre_tipo_solicitud =  $(tr).find("td").eq(0).text();
              var estatus               =  $(tr).find("td").eq(1).text();

                $('tr .Tipo_Solicitud').removeClass('info');

                $('tr .Tipo_Solicitud').each( function(index , value){

                  $(this).find("td").eq(3).addClass('text-primary');

                });
              
                $(tr).addClass('info');

                $(tr).find("td").eq(3).removeClass('text-primary');
                
          $("#id_tipo").val(id_tipo_solicitud);

          $("#nombre").val(nombre_tipo_solicitud);

          $("#estatus").val(estatus);
            //alert($(tr).find(".variabletutor").html());
            //parseB($(tr).find(".variabletutor").html());


            var booleano =  $(tr).find(".variabletutor").html() ;

            if( $(tr).find(".variabletutor").html() == 'true') booleano='on';
                else booleano = 'off';

            $('#description').bootstrapToggle(booleano);



        $("#nombre").off('keyup');
        $("#estatus").off('change');

        $("#estatus").data("selectBoxIt").refresh();
        Renderidng_select();
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);

}

function restablecerForm()
{


         $("#nombre").val("");

         $("#estatus").val("");
         $("#nombre").on('keyup');
         $("#estatus").on('change');

         $("#estatus").data("selectBoxIt").refresh();

         $("#Registrar").attr("disabled", false);
         $("#Modificar").attr("disabled",true);

         $('#description').bootstrapToggle('off');

         tablaindex();
         Renderidng_select();

}
function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"min-width": "206px" , "width": "206px" ,  "height": "35px"});
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
          clearAll       :  true 

  });
}


function TipoSolicitudExiste(tipoSolicitud)
{
    $.amaran({
               content        :{
               bgcolor        :'#0066CC',
               color          :'#fff',
               message        :'El tipo de Solicitud :'+tipoSolicitud+' está igual que antes'
               },
               theme          :'colorful',

               cssanimationIn :'bounceInRight',
               cssanimationOut:'rollOut',
               position       :'bottom right',
              clearAll       :  true 
            });
}





function tablaindex()
{
       $.ajax({

                async   :true,

                cache   :false,

                type    : "POST",

                url     : "../controlador/recibeTipo_Solicitud.php",

                dataType: "html",

                data    : {

                    registrostabla : 'yea'
                },
                success: function (data) {
                    var Variable = JSON.parse(data);
                    var html     = "";
                    
                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";

                    $.each(Variable, function(index, value){

            html+="<tr class=Tipo_Solicitud onclick=seleccionarfila(this); >"+

            "<td hidden></td>"+

            "<td class=nombre_tipo_solicitud>"+value.nombre_tipo_solicitud+"</td>"+

            "<td class=estatus>"+value.estatus+"</td>"+

            "<td >"+value.descripcion+"<label hidden class=variabletutor>"+value.checked+"</label></td>"+

            "<td class='text-primary ' >"+ Icone +

            "<label hidden class=id_tipo_solicitud >"+value.id_tipo_solicitud+"</label></td></tr> ";

                    });

                    ArmarTabla(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });


}

function ArmarTabla (html)
      {

        $("#myTable ").empty();
        $(" #myTable ").append(html);
        $('#myTable').dataTable().fnDestroy();
        $('#myTable').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null,null
          ],

            "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    'Mostrando _MENU_ Registros',
        "sZeroRecords":   "No se encontraron Resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        },'columnDefs': [{

            'targets'   : 4,
            'searchable':true,
            'orderable' :false,
            'className' : 'dt-body-center'
            },{
            'targets'   : [0],
            'searchable':false,
            'orderable' :false,
            'visible'   :false

                              }] ,
        "aLengthMenu": [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength": 5
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


      function aventosON()
      {
      $('#nombre').on('keyup', function (e) {

      var key = e.keyCode || e.which;
      if(key==13)
      $('#estatus').focus();
      });

      $('#estatus').on('change', function (e) {

      var key = e.keyCode || e.which;
      if(key==13)
      $('#Registrar').focus();
      });
      }
