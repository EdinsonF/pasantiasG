
     

$("#Reporte").on('click',function()
  {
       AprobarHacerReporte();
  });
 eventos();

function AprobarHacerReporte()
{
        $.ajax({
                
                async   :true, 
                
                cache   :false,
                
                type    : "POST",
                
                url     : "../controlador/recibeReportes.php",
                
                dataType: "html",
                
                data    : {
     
                  TipoReporte :'LapsosGeneral'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    if( Variable=='LapsosGeneral') window.open('../controlador/recibeReportes.php');
                }

            });
}

 function showselect(str){
       
        $.ajax({
               
                async   :true, 
               
                cache   :false,
               
                type    : "POST",
               
                url     : "../controlador/Recibe_Lapso_Academico.php",
               
                dataType: "html",
               
                data    : {
                       lapso      : $('#lapso').val(),
                       
                       estatus    : $('#estatus').val(),
                       
                       tablaFiltre:'course'
                },
                success: function (data) {
                    
                    var Variable = JSON.parse(data);
                    var html = "";

                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";
                    
                    $.each(Variable, function(index, value){

            html+="<tr class=lapso_academico onclick=seleccionarfila(this);>"+
                 
                  "<td hidden></td>"+
                 
                  "<td class=lapso >"+value.numero_lapso+"</td>"+
                 
                  "<td class=fecha_inicio>"+value.ano_i+"</td>"+
                 
                  "<td class=fecha_fin>"+value.ano_f+"</td>"+
                 
                  "<td class=estatus>"+value.estatus+"</td>"+
                 
                  "<td  class='text-primary' >"+Icone+
                 
                  "<label class=id_lapso hidden >"+value.id_lapso+"</label></td></tr> ";
   
                    });
                   
                    ArmarTabla(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });


     }

//  // BUSQUEDA  CON  PURO AJAX 
//  //LUEGO COMIENZA  PURO JQUERY con ayuda de  javascript vieja escuela 

// // BUSQUEDA TIEMPO REAL

// // CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
//     // Bloqueam

    $("#Modificar").click(function(){

        var veri =  ValidarRegistro();
       
            if(veri){
          
            modificar_lapso_academico();
            }
    }); 


    $("#Registrar").click(function(){


        var veri =  ValidarCampos();

            if(veri){
          
            Registrar_lapso();

            }
    });     


    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 



function Registrar_lapso(){
    

    var porid5  = "registra";
  $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType:"html", 
        
        type    : 'POST',   
        
        url     : "../controlador/Recibe_Lapso_Academico.php",
        
        data    : {

            lapso         : $("#lapso").val(),
            fecha_inicio  : $("#fecha_inicio").val(),
			      fecha_fin     : $("#fecha_fin").val(),
            estatus       : $("#estatus").val(),
            registra : porid5
        },
              
    success: function(data){ 
      
    if(data==1
      ){
      
    swal('Bien','Lapso Académico '+ $("#lapso").val()+' fué Registrado','success');    

    }else {    
    swal('Error','Ocurrió un error de Programación','error');        
    
    }
     setTimeout(function(){restablecerForm();},1000);
    }
    });
    
}

function modificar_lapso_academico(){

    var porid5  = "actualiza";
    var id_lapso ="";   
    $(".lapso_academico").each(function(index,value){

            
            
            id_lapso= $(value).find(".id_lapso").html();
 

    });


    $.ajax({
        
        async   :true, 
        
        cache   :false,
        
        dataType:"json", 
        
        type    : 'POST',   
        
        url     : "../controlador/Recibe_Lapso_Academico.php",
        
        data    : {
          
            lapso        : $("#lapso").val(),      
            fecha_inicio :  $("#fecha_inicio").val(),
			      fecha_fin    : $("#fecha_fin").val(),
            estatus      : $("#estatus").val(),
            id_lapso     :id_lapso,
            actualiza    : porid5

        },
              
success: function(data){ 

        var result = $.trim(data);
       
          if(data==1)
          {
            swal('Bien','Lapso Académico fué Modificado','success');
          }else if(data != 1)
          {    
            swal('Error','Lapso No Modificado','error');   
          }
      setTimeout(function(){restablecerForm();},1000);
    }
    });
    
}
// //  SELECCIONAR FILA DELA TABLA PARA MODIFICAR


function ValidarRegistro()
{

    var lapso_academico_Viejo =""; //$("#lapso").val();
    var fecha_inicio_Viejo    =""; //;
    var fecha_fin_Viejo       = ""; //;
    var estatusViejo          = ""; //;
    

    $(".lapso_academico").each(function(index,value){
            
            lapso_academico_Viejo = $(value).children(".lapso").text();
            fecha_inicio_Viejo    = $(value).children(".fecha_inicio").text();
            fecha_fin_Viejo       = $(value).children(".fecha_fin").text();
            estatusViejo          = $(value).children(".estatus").text();

    });
   var id_lapso_tabla = $(".id_lapso").val();

   if($("#lapso").val()==''){
      MensajeDatosNone();
      $("#lapso").focus();
         return false;
   }else
   if($("#fecha_inicio").val()==''){
     MensajeDatosNone();
    $("#fecha_inicio").focus();
       return false;
   }else
   if($("#fecha_fin").val()==''){
     MensajeDatosNone();
    $("#fecha_fin").focus();
       return false;
   }else


   if((lapso_academico_Viejo==$("#lapso").val() )&&(fecha_inicio_Viejo==$("#fecha_inicio").val()) &&(fecha_fin_Viejo==$("#fecha_fin").val()) &&(estatusViejo==$("#estatus").val()))
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

    var porId  = document.getElementById("lapso").value;
    var porId2 = document.getElementById("fecha_inicio").value;
    var porId3 = document.getElementById("fecha_fin").value;
    var porId4 = document.getElementById("estatus").value;

    if(porId=="")
      { 
        MensajeDatosNone();
     
          $("#lapso").focus();

        return false;

      }else if(porId.length <6 || /^\s+$/.test(porId))
      { 
        MensajeDatosNoneMinimoLapso();
     
          $("#lapso").focus();

        return false;

    }else if(porId2=="")
      { 
        MensajeDatosNone();
     
          $("#fecha_inicio").focus();

        return false;
	  }else if(porId3=="")
      { 
        MensajeDatosNone();
     
          $("#fecha_fin").focus();

        return false;

      }else if(porId4=="")
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
    
                  lapso        = $(tr).find("td").eq(0).text();
                  fecha_inicio = $(tr).find("td").eq(1).text();
                  fecha_fin    = $(tr).find("td").eq(2).text();
                  estatus      = $(tr).find("td").eq(3).text();

                
          $("#lapso").val(lapso); 
         
          $("#fecha_inicio").val(fecha_inicio);

		      $("#fecha_fin").val(fecha_fin );		  

          $("#estatus option[value="+ estatus +"]").prop("selected",true);
         
          $("#lapso").off('keyup'); 
          $("#estatus").off('change');
           showselect();
          $("#estatus").data("selectBoxIt").refresh();

        Renderidng_select();
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);

} 

function restablecerForm()
{

         $("#lapso").val("");
         $("#fecha_inicio").val("");
		     $("#fecha_fin").val("");
         $("#estatus").val("");
         $("#Registrar").attr("disabled",false);
         $("#Modificar").attr("disabled",true);
         
      
          $("#estatus").data("selectBoxIt").refresh();
          tablaDatosGeneral();
          eventos();
          Renderidng_select();
}

function Renderidng_select()
{
  $(".selectboxit-container .selectboxit").css({"width": "206px" ,  "height": "35px"});
}


function MensajeRegistrado()
{
        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Operación Exitosa'
                   },
                   theme          :'colorful',
                   
                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'top right'
                });

}

function MensajeNoRegistrado()
{
        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Lapso Academico No Registrado'
                   },
                   theme          :'colorful',
                   
                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'top right'
                });
}
function MensajeModificado()
{
        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Operación Exitosa'
                   },
                   theme          :'colorful',
                   
                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'top right'
        });
}
function MensajeNoModificado()
{

        $.amaran({
                   content        :{
                   bgcolor        :'#0066CC',
                   color          :'#fff',
                   message        :'Lapso Academico No Modificado'
                   },
                   theme          :'colorful',
                   
                   cssanimationIn :'bounceInRight',
                   cssanimationOut:'rollOut',
                   position       :'top right'
                });
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
        
        cssanimationIn : 'swing',
        cssanimationOut: 'bounceOut'
 
});



 }

 function MensajeDatosNoneMinimoLapso()
{


$.amaran({
        content        :{
        bgcolor        :'#0066CC',
        color          :'#fff',
        message        :'El minimo de caracteres para este campo es de 6'
        },
        theme          :'colorful',
        position       :'bottom right',
        
        cssanimationIn : 'swing',
        cssanimationOut: 'bounceOut'
 
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
        
        cssanimationIn : 'swing',
        cssanimationOut: 'bounceOut'
 
});
 }



function tablaDatosGeneral()
{
        $.ajax({
                async   :true, 
                cache   :false,
                type    : "POST",
                url     : "../controlador/Recibe_Lapso_Academico.php",
                dataType: "html",
                data    : {
                  tablaGeneral :'course'
                },
                success: function (data) {

                    var Variable = JSON.parse(data);
                    var html = "";

                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";
                    
                    $.each(Variable, function(index, value){

            html+="<tr class=lapso_academico onclick=seleccionarfila(this);>"+
                 
                  "<td hidden></td>"+
                 
                  "<td class=lapso >"+value.numero_lapso+"</td>"+
                 
                  "<td class=fecha_inicio>"+value.ano_i+"</td>"+
                 
                  "<td class=fecha_fin>"+value.ano_f+"</td>"+
                 
                  "<td class=estatus>"+value.estatus+"</td>"+
                 
                  "<td  class='text-primary' >"+Icone+
                 
                  "<label class=id_lapso hidden >"+value.id_lapso+"</label></td></tr> ";
   
                    });
                   
                    ArmarTabla(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });

} //FIN FUNCTION  tablaDatosGeneral();


   function ArmarTabla (html)
      {

        $("#myTableLapso ").empty();
        $("#myTableLapso ").append(html);
        $('#myTableLapso').dataTable().fnDestroy();
        $('#myTableLapso').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null ,null, null
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
                         'targets'   : 5,
                         'searchable': true,
                         'orderable' : false,
                         'className' : 'dt-body-center'
                         },
                         
                         {
                         'targets'   : 0,
                         'searchable': false,
                         'orderable' : false,
                         'visible'   : false

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


      function eventos()
      {

 
      $('#lapso').on('keyup', function (e) {
      if($('#lapso').val()!='')
      {
          showselect($('#lapso').val());
      }else 
      {
            tablaDatosGeneral();
      }
      
      
      var key = e.keyCode || e.which;
      if(key==13)
    $('#fecha_inicio').focus();
      }); 


$('#fecha_inicio').on('keyup', function (e) {
    
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#fecha_fin').focus();
      });
    
$('#fecha_fin').on('keyup', function (e) {
    
      
      var key = e.keyCode || e.which;
      if(key==13)
      $('#estatus').focus();
      });

    
$('#estatus').on('change', function (e) {

      if($('#estatus').val()!='')
      {
          showselect();
      }else
      {
          tablaDatosGeneral();
      }
      
      $('#Registrar').focus();
      });        
      }


$('#fecha_inicio').datetimepicker({
 timepicker:false,
 formatDate:'Y/m/d',
 // minDate:'-1970/01/02',//yesterday is minimum date(for today use 0 or -1970/01/01)
 // maxDate:'+1971/01/02'//tommorow is maximum date calendar //un año
});

var dateToDisable = new Date();
  dateToDisable.setDate(dateToDisable.getDate() + 2);
$('#datetimepicker11').datetimepicker({
  beforeShowDay: function(date) {
    if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
      return [false, ""]
    }

    return [true, ""];
  }
});


 $('#fecha_fin').datetimepicker({
 timepicker:false,
 formatDate:'Y/m/d',
 // minDate:'-1970/01/02',//yesterday is minimum date(for today use 0 or -1970/01/01)
// maxDate:'+1971/01/02'//tommorow is maximum date calendar //un año
});

var dateToDisable = new Date();
  dateToDisable.setDate(dateToDisable.getDate() + 2);
$('#datetimepicker11').datetimepicker({
  beforeShowDay: function(date) {
    if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
      return [false, ""]
    }

    return [true, ""];
  }
});