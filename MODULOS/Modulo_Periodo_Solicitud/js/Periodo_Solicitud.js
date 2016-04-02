$(document).ready(function(){

      $('#myTable').DataTable({  
        "language"       : {
        "sProcessing"    :  "Procesando...",
        "sLengthMenu"    :  'Mostrando _MENU_ Registros',
        "sZeroRecords"   :  "No se encontraron Resultados",
        "sEmptyTable"    :  "Ningún dato disponible en esta tabla",
        "sInfo"          :  "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty"     :  "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered"  :  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix"   :  "",
        "sSearch"        :  "Buscar:",
        "sUrl"           :  "",
        "sInfoThousands" :  ",",
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
        'className'      : 'dt-body-center',}],
        "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength" : 5
        });
      
      $('#lapsos_academicos_tabla').DataTable({  
        "language"       : {
        "sProcessing"    :  "Procesando...",
        "sLengthMenu"    :  'Mostrando _MENU_ Registros',
        "sZeroRecords"   :  "No se encontraron Resultados",
        "sEmptyTable"    :  "Ningún dato disponible en esta tabla",
        "sInfo"          :  "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty"     :  "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered"  :  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix"   :  "",
        "sSearch"        :  "Buscar:",
        "sUrl"           :  "",
        "sInfoThousands" :  ",",
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

    $("#Modificar").click(function(){

        var veri =  ValidarRegistro();
       
            if(veri){
            validarPeriodoLapsoAcademicoModificar();
            
         }
    }); 

    $("#Registrar").click(function(){

        var veri =  ValidarCampos();

            if(veri){
            
            validarPeriodoLapsoAcademico();
            }
    });     


    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 

    
    $("#ass").click(function(){

    if($('.lapsoSeleccionar_radio:checked').closest("tr").find('td').eq(2).text() == '' ) swal('Upss',' Como te Dicen? el id no Está en esta posicion de la tabla!','error');
    else {
        
        $("#numero_lapso option[value="+ $('.lapsoSeleccionar_radio:checked').closest("tr").find('td').eq(2).text() +"]").prop("selected",true);
        fechas_lapso();
    }
    
    });

    $("#Reporte").on('click',function(){
    
    AprobarHacerReporteGeneral();

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
          
          $('#Registrar').focus();
          }); 
        
    $("#numero_lapso").on('change',function() 
    {
      fechas_lapso();
    });


        
        $("#estatus").selectBoxIt({autoWidth:false,
        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 400,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 400       });
        Renderidng_select();
        LlenarLapsosAcademicos();
        TablaTodo();

    }); // $(document).ready ()

 function LlenarLapsosAcademicos() 
 {
  $.ajax({
          
          async   :true, 
          
          cache   :false,
          
          type    : "POST",
          
          url     : "../controlador/Recibe_Periodo_Solicitud.php",
          
          dataType: "html",
          
          data    : {
        
          BuscarLapsoAcademico :'PeriodoGeneral'
    },
    success : function (data) {
       
        var Variable = JSON.parse(data);
        
        if(Variable.length>0)
        {
            $.each(Variable ,  function(index , value){
                
                atr = (value['estatus']=='INACTIVO') ? 'disabled' :'';
                
                value['numero_lapso'] += (value['estatus']=='INACTIVO') ? ' '+value['estatus'] : '';

                $("#numero_lapso").append('<option value='+value['id_lapso']+' '+atr+'>'+value['numero_lapso']+'</option>');

            });
            
            InitializeLapso();

        }
    }

  });
 }

function InitializeLapso()
{
  $("#numero_lapso").selectBoxIt({ 
        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 400,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 400       });

  Renderidng_select();

}

 function AprobarHacerReporteGeneral()
 {
 
  $.ajax({
          
          async   :true, 
          
          cache   :false,
          
          type    : "POST",
          
          url     : "../controlador/recibeReportes.php",
          
          dataType: "html",
          
          data    : {
        
        TipoReporte :'PeriodoGeneral'
    },
    success : function (data) {
       
          var Variable = JSON.parse(data);
          if(Variable=='PeriodoGeneral')window.open('../controlador/recibeReportes.php');
    }

  });
 }




  function fechas_lapso() {

    $.ajax({
            
            async   :true, 
            
            cache   :false,
            
            dataType:"html", 
            
            type    : 'POST',   
            
            url     : "../controlador/Recibe_Periodo_Solicitud.php",
            
            data    : {

              select : $("#numero_lapso").val()
              },
              
    success: function(data){ 
      
      var variable = JSON.parse(data);
          if(variable){
          $("#inicio").val(variable.ano_i);
          $("#fin").val(variable.ano_f);
          }

    }
    });

}



 function showselect(str){

     $.ajax({
               
                async   :true, 
               
                cache   :false,
               
                type    : "POST",
               
                url     : "../controlador/Recibe_Periodo_Solicitud.php",
               
                dataType: "html",
               
                data    : {
                    periodo_solicitud:$("#periodo").val(),
                    Tablafield       :'ofcourse'
                },
                success: function (data) {
                   
                    var Variable = JSON.parse(data);
                    var html = "";

                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";
                    
                    $.each(Variable, function(index, value){

            html+="<tr class=periodo_solicitud  onclick=seleccionarfila(this);>"+
                    
                    "<td hidden></td>"+
                    
                    "<td class=fecha_inicio>"+value['fecha_inicio']+"</td>"+
                    
                    "<td class=fecha_fin>"+value['fecha_fin']+"</td>"+      
                    
                    "<td class=numero_lapso>"+value['numero_lapso']+
                    
                    "<input type=hidden class=id_numero_lapso value="+value['id_lapso']+"></td>"+
                    
                    "<td class=estatus >"+value['estatus']+"</td>"+
                    
                    "<td class='text-primary'>"+Icone+"<label hidden class=id_periodo>"+value['id_periodo']+"</label></td></tr>";
   
                    });
                   
                    ArmarTabla(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });

     }



 //-------------------------------
//  // BUSQUEDA  CON  PURO AJAX 
//  //LUEGO COMIENZA  PURO JQUERY con ayuda de  javascript vieja escuela 

// // BUSQUEDA TIEMPO REAL

// // CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
//     // Bloqueam
//---------------------------------


function validarPeriodoLapsoAcademico()
{

  $.ajax({

          async   :true, 

          cache   :false,

          dataType:"html", 

          type    : 'POST',   

          url     : "../controlador/Recibe_Periodo_Solicitud.php",

          data    : {
                      id_lapso            :$("#numero_lapso").val(),
                      fecha_inicio        :$("#fecha_inicio").val(),
                      fecha_fin           :$("#fecha_fin").val(),
                      validarlapsoyperiodo:'Yes'
                },
                success: function(data)
                {
                    
                  if(data==1)Registrar_periodo(); else if (data==2)  swal('Atención','No Hay Lapso Existente que aplique para este Periodo','warning');
                  else if ( JSON.parse(data) )  
                      {       
                          var html ='';
                            $.each(JSON.parse(data),function(index , value)
                              {
                                
                                html+="<tr>"+
                                "<td hidden ><center></center></td>"+
                                "<td><center>"+value.lapsoacademico+"</center></td>"+
                                "<td hidden ><center><label class=id_lapso_sugengrido>"+value.id_lapso+"</label></center></td>"+
                                "<td></td>"+
                                "</tr>";
                              });
                            tabla_lapsosAcademicos_Sugeridos(html);
                            $("#modal_lapsos_academicos_aplicables").modal('show');
                      }
                } //success.! 
        });

}

function validarPeriodoLapsoAcademicoModificar()
{

$.ajax({

          async   :true, 

          cache   :false,

          dataType:"html", 

          type    : 'POST',   

          url     : "../controlador/Recibe_Periodo_Solicitud.php",

          data    : {
                      id_lapso            :$("#numero_lapso").val(),
                      fecha_inicio        :$("#fecha_inicio").val(),
                      fecha_fin           :$("#fecha_fin").val(),
                      validarlapsoyperiodo:'Yes'
                },
                success: function(data)
                {
                    
                  if(data==1)modificar_periodo_solicitud(); else if (data==2)  swal('Atención','No Hay Lapso Existente que aplique para este Periodo','warning');
                  else if ( JSON.parse(data) )  
                      {       
                          var html ='';
                            $.each(JSON.parse(data),function(index , value)
                              {
                                
                                html+="<tr>"+
                                "<td hidden ><center></center></td>"+
                                "<td><center>"+value.lapsoacademico+"</center></td>"+
                                "<td hidden ><center><label class=id_lapso_sugengrido>"+value.id_lapso+"</label></center></td>"+
                                "<td></td>"+
                                "</tr>";
                              });
                            tabla_lapsosAcademicos_Sugeridos(html);
                            $("#modal_lapsos_academicos_aplicables").modal('show');
                      }
                } //success.! 
        });

}


function Registrar_periodo(){
    
  
    var porId = document.getElementById("fecha_inicio").value;
    var porId2 = document.getElementById("fecha_fin").value;
    var porId3 = document.getElementById("numero_lapso").value;
    var porId4 = document.getElementById("estatus").value;
    var porid5 = "registra";
    

    $.ajax({

        async   :true, 

        cache   :false,

        dataType:"html", 

        type    : 'POST',   

        url     : "../controlador/Recibe_Periodo_Solicitud.php",

        data    : {

                
                fecha_inicio: porId,
                fecha_fin   : porId2,
                numero_lapso: porId3,
                estatus     : porId4,
                registra    : porid5
              },
              
    success: function(data){ 
           
    if(data==1){
      
    swal('Bien',' Periodo de Solicitud Registrado','success');

    }else {    
    swal('Error','error de programación','error');       
    
    }
      setTimeout( function(){restablecerForm();},1000);
    }
    });
    
}

function modificar_periodo_solicitud(){

  
     var porId  = $("#fecha_inicio").val();
     var porId2 = $("#fecha_fin").val();
     var porId3 = $("#numero_lapso").val();
     var porId4 = $("#estatus").val();
     var porid5 = "actualiza";
    $.ajax({
       
        async   :true, 
       
        cache   :false,
       
        dataType:"html", 
       
        type    : 'POST',   
       
        url     : "../controlador/Recibe_Periodo_Solicitud.php",
       
        data    : {
          
            
             fecha_inicio: porId,
             fecha_fin   : porId2,
             numero_lapso: porId3,      
             estatus     : porId4,
             id_periodo  :$("#periodo").val(),
             actualiza   : porid5

              },
              
success: function(data){ 
  
    if(data==1){
      
    swal('Bien','Periodo de Solicitud Modificado','success');

    }else {    
    swal('Error',' Error De Programación','error');         
    
    }
     setTimeout(function(){restablecerForm();},1000); 
    }
    });
    
}

//--------------------------------------------
// //  SELECCIONAR FILA DELA TABLA PARA MODIFICAR
//-----------------------------------------------



function ValidarRegistro()
{

   
     var fecha_inicio_Viejo =""; //;
     var fecha_fin_Viejo    = ""; //;
     var numero_lapso_Viejo =""; //$("#lapso").val();
     var estatus_Viejo      = ""; //;
    

    $(".periodo_solicitud").each(function(index,value){


            fecha_inicio_Viejo = $(value).children(".fecha_inicio").text();
            fecha_fin_Viejo    = $(value).children(".fecha_fin").text();
            numero_lapso_Viejo = $(value).children(".lapso").text();
            estatus_Viejo      = $(value).children(".estatus").text();

    });
   var id_periodo_tabla = $(".id_periodo").html();

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
    if($("#numero_lapso").val()==''){
      MensajeDatosNone();
      $("#numero_lapso").focus();
         return false;
   }else
   
   if((fecha_inicio_Viejo==$("#fecha_inicio").val()) 
    &&(fecha_fin_Viejo   ==$("#fecha_fin").val()   ) 
    &&(numero_lapso_Viejo==$("#numero_lapso").val())
    &&(estatus_Viejo     ==$("#estatus").val())    )
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

      var porId  = document.getElementById("fecha_inicio").value;
      var porId2 = document.getElementById("fecha_fin").value;
      var porId3 = document.getElementById("numero_lapso").value;
      var porId4 = document.getElementById("estatus").value;
      var porId5 = document.getElementById("inicio").value;

    if(porId=="")
      { 
        MensajeDatosNone();
     
          $("#fecha_inicio").focus();

        return false;

     // }else  if(porId5 > porId)
    //  { 
    //   MensajeFecha();
     
     //     $("#fecha_inicio").focus();

     //   return false;

      }else if(porId2=="")
      { 
        MensajeDatosNone();
     
          $("#fecha_fin").focus();

        return false;

	  }else if(porId3=="")
      { 
        MensajeDatosNone();
     
          $("#numero_lapso").focus();

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
    
                  
                  fecha_inicio = $(tr).find("td").eq(0).text();
                  fecha_fin    = $(tr).find("td").eq(1).text();
                  numero_lapso = $(tr).find("td").eq(2).text();
                  estatus      = $(tr).find("td").eq(3).text();
              $("#periodo").val($(tr).find(".id_periodo").html());

         
          $("#fecha_inicio").val(fecha_inicio);

		      $("#fecha_fin").val(fecha_fin);		  
          
          $("#estatus option[value="+ estatus +"]").prop("selected",true);
        
          $("#estatus").off('change');
          
          $("#numero_lapso option[value="+ $(".id_numero_lapso",tr).val() +"]").prop("selected",true);

          $("#estatus").data("selectBoxIt").refresh();
          $("#numero_lapso").data("selectBoxIt").refresh();

        Renderidng_select();
        fechas_lapso();
        showselect();

        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);

} 

function restablecerForm()
{
//------------------
        $("#fecha_inicio").val("");
	       $("#fecha_fin").val("");  
         $("#inicio").val("");  
        $("#fin").val("");  
        $("#numero_lapso").val("");
        $("#estatus").val("");
        $("#Registrar").attr("disabled",false);
        $("#Modificar").attr("disabled",true);


        $("#estatus").data("selectBoxIt").refresh();
        $("#numero_lapso").data("selectBoxIt").refresh();   
        Renderidng_select();        
        TablaTodo();
//------------------

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
            cssanimationIn : 'bounceInRight',
            cssanimationOut: 'bounceOut',
            clearAll       : true 
     
    });

}

function MensajeFecha()
{

    $.amaran({
            content        :{
            bgcolor        :'#0066CC',
            color          :'#fff',
            message        :'Verificar Fecha De Inicio'
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


function TablaTodo()
{

        $.ajax({
                
                async   :true, 
                
                cache   :false,
                
                type    : "POST",
                
                url     : "../controlador/Recibe_Periodo_Solicitud.php",
                
                dataType: "html",
                
                data    : {
      
                  TablaGeneral :'ofcourse'
                },
                success: function (data) {
                   
                    var Variable = JSON.parse(data);
                    var html     = "";

                    Icone =
                    "<abbr data-toggle='tooltip' data-placement='left' title='Modificar' >"+
                          
                          "<span class=' fa fa-paint-brush' ></span>"+
                          
                      "</abbr>";
                    
                    $.each(Variable, function(index, value){

            html+="<tr class=periodo_solicitud  onclick=seleccionarfila(this);>"+
                    
                    "<td hidden></td>"+
                    
                    "<td class=fecha_inicio>"+value['fecha_inicio']+"</td>"+
                    
                    "<td class=fecha_fin>"+value['fecha_fin']+"</td>"+      
                    
                    "<td class=numero_lapso>"+value['numero_lapso']+
                    
                    "<input type=hidden class=id_numero_lapso value="+value['id_lapso']+"></td>"+
                    
                    "<td class=estatus >"+value['estatus']+"</td>"+
                    
                    "<td class='text-primary'>"+Icone+"<label hidden class=id_periodo>"+value['id_periodo']+"</label></td></tr>";
   
   
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
        $("#myTable").DataTable({  
        "aoColumns": [
          { "bSortable": false },
          null, null, null , null, null
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
               'targets'   : [ 5 ],
               'searchable': true,
               'orderable' : false,
               'className' : 'dt-body-center'
             },
             {
               'targets'   : [ 0 ],               
               'visible'   : false 
               }],
               'order':[ 1 , 'asc'],
           "aLengthMenu"   : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
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


	 $('#fecha_inicio').datetimepicker({
 timepicker:false,
 formatDate:'Y/m/d',
 minDate   :'-1970/01/02',//yesterday is minimum date(for today use 0 or -1970/01/01)
 maxDate   :'+1971/01/02'//tommorow is maximum date calendar //un año
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
 minDate:'-1970/01/02',//yesterday is minimum date(for today use 0 or -1970/01/01)
 maxDate:'+1971/01/02'//tommorow is maximum date calendar //un año
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



function tabla_lapsosAcademicos_Sugeridos(html)
{

  $("#lapsos_academicos_tabla ").empty();
        $("#lapsos_academicos_tabla ").append(html);
        $('#lapsos_academicos_tabla').dataTable().fnDestroy();
        $("#lapsos_academicos_tabla").DataTable({  
        "aoColumns"         : [
        { "bSortable"       : false },
        null, null , null
        ],
        
        "language"          : {
        "sProcessing"       : "Procesando...",
        "sLengthMenu"       : '',
        "sZeroRecords"      : "No se encontraron Resultados",
        "sEmptyTable"       : "Ningún dato disponible en esta tabla",
        "sInfo"             : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty"        : "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered"     : "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix"      : "",
        "sSearch"           : "Buscar:",
        "sUrl"              : "",
        "sInfoThousands"    : ",",
        "sLoadingRecords"   : "Cargando...",
        "oPaginate"         : {
        "sFirst"            : "Primero",
        "sLast"             : "Último",
        "sNext"             : "Siguiente",
        "sPrevious"         : "Anterior"
        },
        "oAria"             : {
        "sSortAscending"    : ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending"   : ": Activar para ordenar la columna de manera descendente"
        }
        },
        'columnDefs'        : [{
        'targets'           : 3,
        'searchable'        : true,
        'orderable'         : false,
        'className'         : 'dt-body-center',
        'render'            : function (data, type, full, meta){
        return '<input type ="radio" class=lapsoSeleccionar_radio  >';
        }
        }],
        'order'             : [1, 'asc'],
        "aLengthMenu"       : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
        "iDisplayLength"    : 5                  

        });

     $("#lapsos_academicos_tabla tbody tr").click(function(){

            if($(".lapsoSeleccionar_radio",this).is(':checked')==false)
            {   
                $(".lapsoSeleccionar_radio",this).prop("checked", true);
                $("#ass").attr('disabled',false); 
            }
            else 
            {
                $(".lapsoSeleccionar_radio",this).prop("checked", false);
                $("#ass").attr('disabled',true);  
            }
     });

}