$(document).ready(function() {

buscarInformacion();

});

function buscarInformacion()
{

 $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Curriculo_Controller.php",
        data: {

            hacervistaP              : "Vista_Previa"

              },
                      
                success: function(array){ 
       			var datos = JSON.parse(array);

       			//alert(array);
            


            //DATOS PERSONALES----->>>

         $('#fotografia').attr("src", datos.PERSONAL.fotografia);
        $('#profesion').html("&nbsp; &nbsp; "+datos.PERSONAL.profesion);
        $('#descripcion_profesion').html("&nbsp; &nbsp; "+datos.PERSONAL.descripcion_profesion);
       
        
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        var contenedor  = $("#contenedorr_estudios"); //ID del contenedor
        // //FORMACION ACADEMICA----->>>
        $.each(datos.ACADEMICA, function(index, value){

        //CREO LA SECCION---->>
        $(contenedor).append('<article class="exp-item">'                  
                                  +'<div class="FormacionAcademica">'
                                    +'<div class="exp-holder">'
                                        +'<div class="head">'
                                            +'<div class="date-range">Fecha:<br><font color="#D8FFFB">'+value['inicio_curso']+' - '+value['fin_curso']+'</font></div>'
                                            +'<br><h4>INSTITUTO</h4><br><font color="#D8FFFB" size="3">'+value['nombre_instituto']+'</font><br>'                                                       
                                        +'</div>'
                                        +'<div class="body">'
                                            +'<br><font color="#3F4D52">'+value['descripcion_obtencion']+'</p>'
                                        +'</div>'
                                    +'</div>'
                              +'</div></article>');
        
        });
        
 

/////////////////////////////////////////////////////////////////////////////////////////////////7

        var contenedor2  = $("#contenedor2_trabajo"); //ID del contenedor    
        // //FORMACION ACADEMICA----->>>
        $.each(datos.LABORAL, function(index, value){

        //CREO LA SECCION---->>
        $(contenedor2).append('<article class="exp-item">'              
                                      +'<div class="ExperienciaLaboral">'
                                        +'<div class="exp-holder">'
                                            +'<div class="head">'
                                                +'<div class="date-range">Fecha:<br><font color="#D8FFFB">'+value['inicio_empleo']+' - '+value['fin_empleo']+'</font></div>'
                                                    +'<br><h4>EMPRESA</h4><br><font color="#D8FFFB" size="3">'+value['nombre_empresa']+'</font><br><hr>'
                                                    +'<h4>CARGO</h4><br> <font color="#D8FFFB" size="3">'+value['cargo_en_empresa']+'</font>'
                                                  +'</div>'
                                                  +'<div class="body"><br>'
                                                +'<font color="#3F4D52">'+value['funcion_en_empresa']+'</font>'
                                            +'</div>'
                                        +'</div>'
                                  +'</div></article>');


            });
 
    }
    });

}