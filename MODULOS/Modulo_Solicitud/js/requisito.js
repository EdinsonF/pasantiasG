$("#Reporte").on('click',function()
  {
        window.open('../controlador/recibeReportes.php?General=todo');
  });
  
  tablaindex();


 eventos();
   
  

 function BuscarDatos(){
       


        $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibeRequisito.php",
                dataType: "html",
                data: {
                   requisito     : $('#nombre').val(),
                   estatus       : $('#estatus').val(),
                  Tablafiltre :'ofcourse'
                },
                success: function (data) {
                  
                    var Variable = JSON.parse(data);
                    var html = "";
                    
                    $.each(Variable, function(index, value){

            html+="<tr class=requisito onclick=seleccionarfila(this);>"+
            "<td class=id_requisito ><center >"+Variable[index].id_requisito+"</center></td>"+
            "<td class=nombre_requisito ><center >"+Variable[index].nombre_requisito+"</center></td>"+
            "<td class=estatus ><center >"+Variable[index].estatus+"</center></td>"+
            "<td><center><img src=../../../img/iconos/edit.png alt=Ginger class=left width=20 ></center>"+
            "</td></tr>";
   
                    });
                   
                    ArmarTabla(html);
                    
                }

            });
           
      }// FION Function

    // Bloqueam
    $(document).ready(function() {
    $("#Modificar").click(function(){

        var veri =  ValidarRegistro();
       
            if(veri){
          
            modificarRequisito();
            }
    }); 
});


    $("#Registrar").click(function(){

        var veri =  ValidarCampos();

            if(veri){
          
            RegistrarRequisito();
            }
    });     

    $(document).ready(function() {
    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 
});

function RegistrarRequisito(){
    
    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;
    var porid3  = "registra";

    
    if(porId2=="")
    {
        porId2 = "SIN ESTATUS";
    }


    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Requisito/controlador/recibeRequisito.php",
        data: {

            nombre_requisito : porId,   
            estatus : porId2,
            registra : porid3

              },
              
    success: function(data){ 
        alert(data);
    if(data==1){
      
    //swal('Bien','El Requisito '+porId+' fue registrado ','success');
    alert('El Requisito '+porId+' fue registrado ');
    document.location.reload();

    }else {    
           
   // swal('Ups','El Requisito '+porId+' no se pudo registrar ','error');
    alert('El Requisito '+porId+' no se pudo registrar');
    document.location.reload();
    }
    restablecerForm();
    }
    });
    
}

function modificarRequisito(){
    
    var id  = document.getElementById("id_requisito").value;
    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;
    var porid3  = "actualiza";
   
    

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../../Modulo_Requisito/controlador/recibeRequisito.php",
        data: {
            id_requisito     : id,
            nombre_requisito : porId,      
            estatus : porId2,
            actualiza : porid3
              },
              
success: function(data){ 
        alert(data);

        if(data ==1)
        {   
            //swal('El nuevo Requisito fue Actualizado','','success');
            alert('El nuevo Requisito fue Actualizado');
            document.location.reload();
            

        }
        else if(data ==0)
        {
            //swal('Error de Programaci&ocute;n','','error');
            alert('Error de Programaci&ocute;n');
            document.location.reload();
        }

        restablecerForm();
    }
    });
    
}
//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR


function ValidarRegistro()
{

    var porId  = document.getElementById("nombre").value;
    var porId2 = document.getElementById("estatus").value;
    
    $(".requisito").each(function(index,value){
        
            id= $(value).children(".id_requisito").text();
            nombre_requisitoViejo= $(value).children(".nombre_requisito").text();
            estatusViejo= $(value).children(".estatus").text();

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

function seleccionarfila_solicitud(tr){
    alert();
                var id_requisito="";
                var nombre_requisito="";
                var estatus = "";
                $('tr .requisito').each(function() {
                  
                  id_requisito = $(tr).find("td").eq(0).text();
                  nombre_requisito = $(tr).find("td").eq(1).text();
                  estatus            = $(tr).find("td").eq(2).text();

                  });

          $("#id_requisito").val(id_requisito);      
          $("#nombre").val(nombre_requisito); 
         
          $("#estatus option[value="+ estatus +"]").attr("selected",true);
          $("#nombre").off('keyup'); 
          $("#estatus").off('change');

      BuscarDatos();
        $("#Registrar").attr("disabled", true);
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);

} 

function restablecerForm()
{
      $("#nombre").val('');
      $("#estatus").val('');
      tablaindex();
       eventos();
        $("#Registrar").attr("disabled", false);
        $("#Modificar").attr("disabled",true);
        $("#Cancelar").attr("disabled",true);
  
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
    
    cssanimationIn: 'bounceInUp',
    cssanimationOut: 'rollOut'
 
});

}
function MensajeModificarNone()
{

$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Modifique alguno de los  campos'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'bounceInUp',
    cssanimationOut: 'rollOut'
 
});

}
function MensajeminimoCaracter()
{


$.amaran({
        content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El nombre del requisito es muy corto'
        },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'bounceInUp',
    cssanimationOut: 'rollOut'
 
});
}

function MensajeEstatusSelecct()
{


$.amaran({
        content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Seleccione Un Estatus'
        },
            theme:'colorful',
            position:'bottom right',
    
            cssanimationIn: 'bounceInUp',
            cssanimationOut: 'rollOut'
 
});
}

function tablaindex()
{ 
                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibeRequisito.php",
                dataType: "html",
                data: {
                  todaTabla:'ofcourse'
                },
                success: function (data) {

                    var Variable = JSON.parse(data);
                    var html = "";
                    
                    $.each(Variable, function(index, value){

            html+="<tr class=requisito onclick=seleccionarfila(this);>"+
            "<td class=id_requisito ><center >"+Variable[index].id_requisito+"</center></td>"+
            "<td class=nombre_requisito ><center >"+Variable[index].nombre_requisito+"</center></td>"+
            "<td class=estatus ><center >"+Variable[index].estatus+"</center></td>"+
            "<td><center><img src=../../../img/iconos/edit.png alt=Ginger class=left width=20 ></center>"+
            "</td></tr>";
   
                    });
                   
                    ArmarTabla(html);
                    
                }

            });
        
      }

    function ArmarTabla(html){

        $("#myTable ").empty();
        $(" #myTable ").append(html);
        $('#myTable').dataTable().fnDestroy();
        tablareforma();
    }
$(document).ready(function(){
  tablareforma();


    });

    function tablareforma()
    {

            $('#myTable').dataTable({  
        "aoColumns": [
          { "bSortable": false },
          null, null, null 
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
        }
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
    }