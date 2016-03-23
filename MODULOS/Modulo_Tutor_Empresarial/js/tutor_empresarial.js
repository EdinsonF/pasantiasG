

showselectTutorEmpresarial();

//-------RECARGAR TABLA OFICINA PARA ASIGTNAR PERSONAS--->>>>
function showselectTutorEmpresarial(str){


                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/Ctr_TutorEmpresarial.php",
                dataType: "html",
                data: {
                  
                  TablaE_Tutores:'ofcourse'
                },
                success: function (data) {
                    
                    //alert(data);
                    var Variable = JSON.parse(data);
                    var html = "";
                    var contador=0;
                    $.each(Variable, function(index, value){
                   
                    html +="<tr >"+
                    " <td ><center>"+Variable[index].cedula+"</center></td>"+
                    " <td ><center>"+Variable[index].nombre+"</center></td>"+
                    " <td ><center>"+Variable[index].apellido +"</center></td>"+
                    " <td ><center>"+Variable[index].nombre_oficina+"</center></td>"
                    " </tr>" ;
                    contador++;
                    //<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';            
                    });
                   
                    ArmarTablaTutoresEmpresarial(html);
                    
                }

            });

      }
        

      function ArmarTablaTutoresEmpresarial(html)
      {


        $("#Table ").empty();
        $("#Table ").append(html);
        $('#Table ').dataTable().fnDestroy();
        $('#Table ').dataTable({ // Cannot initialize it again error
        "aoColumns": [
          { "bSortable": false },
          null, null, null
          ]
        }); 
                     
      }
//----FIN DE RECARGAR TABLA TUTORES ACADEMICO--->>













$('#tabla').modal({
  show: true //Activo el modal en la carga de la pagina
});






// CUANDO SE HACE  CLICK  EN EL BOTON MODIFICAR
    // Bloqueam
    $(document).ready(function() {
    $("#Modificar").click(function(){

      modificarAsignacion();

        
    }); 
});



//---CUANDO SE HACE CLIC EN EL BOTON DE CANCELAR--->>>
    $(document).ready(function() {
    $("#Cancelar").click(function(){

 
            restablecerForm();
    }); 
});


//-----RECARGAR BODY--->>>
function restablecerForm()
{


        $( "#page" ).load( "../vista/Asignacion_Oficina.php");

}





function modificarAsignacion(){
    
    var porId  = document.getElementById("id_organizacion").value;
    var porId2  = document.getElementById("id_oficina").value;
    var porId3 = document.getElementById("nombre").value;
    var porId4 = document.getElementById("estado").value;

    
    var boton  = "actualiza";
   
    alert(porId+porId2+porId3+porId4);

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/ActionPerformed.php",
        data: {
            id_organizacion : porId,      
            id_oficina : porId2,
            nombre : porId3,
            estatus :porId4,
            actualiza : boton

              },
              
success: function(data){ 
  var result = $.trim(data);

  
    if(result>0){
      

    alert("Estatus Modificado");
    $( "#page" ).load( "../vista/Asignacion_Oficina.php");


    }else {    
    alert("Estatus No Modificado");          
    $( "#page" ).load( "../vista/Asignacion_Oficina.php");
    }

    }
    });
    
}



//  SELECCIONAR FILA DELA TABLA PARA ASIGNAR

function seleccionarfila_ParaAsignar(tr){
    
                var id_organizacion= document.getElementById("id_organizacion").value;
                var id_oficina="";

                var filtro  = "Asignar";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .oficina_asignar').each(function() {
                  
                  id_oficina  = $(tr).find("td").eq(0).text();
                  
                  

                  });
          
                           

                            $.ajax({
                            async:true, 
                            cache:false,
                            dataType:"html", 
                            type: 'POST',   
                            url: "../controlador/ActionPerformed.php",
                            data: {
                                ID_ORGANIZACION : id_organizacion,      
                                ID_OFICINA : id_oficina,                                
                                Asignare : filtro

                                  },
                                  
success: function(data){ 
  var result = $.trim(data);
   
  
    if(result==1){
      

    alert("Esta Asignacion Ya Existe");
    $( "#page" ).load( "../vista/Asignacion_Oficina.php");


    }else {    
    alert("Asignacion Con Exito");          
    $( "#page" ).load( "../vista/Asignacion_Oficina.php");
    }

    }
    });
        
        //$("#Modificar").attr("disabled",false);
        //$("#Cancelar").attr("disabled",false);
        
   


} 












//  SELECCIONAR FILA DELA TABLA PARA MODIFICAR

function seleccionarfila(tr){
    
                /*   $("tr .sigla ").each(function(index){
                    
                    $("#titlee").html($(tr).text());
 
                }); ME TRAE  TODA  LA  FILA SELECCIONADA DE LA TABLA */
  
                var id_oficina="";
                var nombre="";
                var estatus="";
       
                //var id_estado = $(".id_estado",tr).val();
                $('tr .oficina').each(function() {
                  
                  id_oficina  = $(tr).find("td").eq(0).text();
                  nombre = $(tr).find("td").eq(1).text();
                  estatus  = $(tr).find("td").eq(3).text();
                  

                  });
          $("#id_oficina").val(id_oficina); 
          $("#nombre").val(nombre); 
          $("#estado option[value="+ estatus +"]").attr("selected",true);
       
        
        $("#Modificar").attr("disabled",false);
        $("#Cancelar").attr("disabled",false);
        
    // $("#superidOrganizacion").val();


    //var sigla= $("td .municipio").text(); // -------- TODAS  LAS  COLUMNAS
    //$("#titlee").html(sigla);
    

    // El Codigo Malandro Super Tukki ..!
    // Gracias stack overflow ...


} 


//----PINTAR LAS FILAS Y COLUMNAS Y DESMARCAR--->>>>
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#5882FA';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}



