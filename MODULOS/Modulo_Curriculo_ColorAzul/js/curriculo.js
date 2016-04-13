var FieldCount1=0;
var FieldCount=0;
//AGREGAR FORMACION ACADEMICA  -->
$(document).ready(function() {
    var x =0;
    
    var MaxInputs       = 4; //Número Maximo de Campos
    var contenedor      = $(".contenedorr_estudios"); //ID del contenedor
    var AddButton       = $("#agregarCampo_estudio"); //ID del Botón Agregar


    $(AddButton).click(function (e) {
        
        if(FieldCount1 <= MaxInputs) //max input box allowed
        {
        	FieldCount1=FieldCount1+1;
            //agregar campo
            $(contenedor).append('<div class="contenedorr_estudios">'   		
										+'<article class="exp-item"><div class="FormacionAcademica">'
                                        +'<div class="exp-holder">'
                                        +'<button type="button" id="eliminar" class="btn btn-primary btn-sm" value="'+FieldCount1+'"><img  src="complementos/cancel.png" width="18"> Eliminar sección '+FieldCount1+'</button>'
                                            +'<div class="head">'
                                            +'<input type="hidden" id="id_formacionAcademica'+FieldCount1+'" class="formacion_academica" name="formacion_academica[]" value="">'
                                            +'<div class="date-range">Fecha:<input type="date" id="inicio_curso'+FieldCount1+'" class="inicio_curso" name="inicio_curso[]">-<input type="date" id="fin_curso'+FieldCount1+'" class="fin_curso" name="fin_curso[]"></div>'
                                            +'<br><h4>Nómbre Instituto:</h4><br><input type="text" id="nombre_instituto'+FieldCount1+'" name="nombre_instituto[]"  class="form-control" placeholder="NOMBRE DE LA INSTITUCION DONDE EJERCIÓ SUS ESTUDIOS, SEGUN EL AÑO" onkeyup="this.value=this.value.toUpperCase()">'                                                        
                                        +'</div>'
                                        +'<div class="body">'
                                            +'<h4><font color="#6E6E6E">Descripción</font></h4>'
                                            +'<textarea name="descripcion_obtencion[]" id="descripcion_obtencion'+FieldCount1+'" class="descripcion_obtencion" rows="3" placeholder="DESCRIPCIÓN DE SU TITUTLO OBTENIDO Ó GRADOS CURSADO..." onkeyup="this.value=this.value.toUpperCase()"></textarea>'
                                        +'</div>'
                                        +'</div>'
                                    +'</div></article></div>'); 

       } else{
       	 swal("Maximo De Secciones");
       }                                         
            					
           
        return false;
    });
	



    //----ELIMINAR SECCION FORMACION ACADEMICA--->>>
    $("body").on("click","#eliminar", function(e){ //click en eliminar campo
            
            var numSeccion=$(this).parent().find('#Eliminar').val();//----POR MEDIO DEL BOTON ELIMINAR OBTENGO EL NUMERO PARA SACAR EL ID DE LA SECCION QUE QUIERO ELIMINAR
            //alert(numSeccion);
            	var thiss=$(this);
                var id_formacionA=$("#id_formacionAcademica"+numSeccion).val();
                var id_curriculo=$("#id_curriculo").val();
                
                    if(id_formacionA!=""){
                        			//alert("id curriculo:"+id_curriculo+" id formacion:"+id_formacionA);
                        	
		                        	//ALERT DE CONFIRMACION---->>>
		                        	swal({   
					                     title: "Atenciòn",   
					                     text:  "Seguro Que Desea Eliminar Esta Sección? ",

					                     type: "warning", 
					                     showCancelButton: true, 
					                     confirmButtonColor: "#DD6B55",
					                     confirmButtonText: "Aceptar",
					                     cancelButtonText: "Cancelar", 
					                     closeOnConfirm: false 
					                 }, 
					                     function(){

					                     	//----FUNCION PAR ELIMINAR AL HACER CLICK
					                        EliminarSeccionEstuduios_BaseD(id_curriculo, id_formacionA, thiss);
					                        
		                    			});//---FIN DEL ALERT
		                        	
					                       
                        
                    }else{

                    	$(this).parent().parent().parent().parent().remove(); //ELIMINAR SECCION PANTALLA
                    	RenombrarIds_AlEliminarEstudios();       
            
                    }//---FIN DEL IF.

        return false;
    });
});
//---FIN DE AGRAGAR SECCION FORMACION ACADEMICA


//----RENOMBRAR LOS IDS AL ELIMUINAR UNA SECCION---->>>>
function RenombrarIds_AlEliminarEstudios(){

     $('.contenedorr_estudios').each( function(index, value){
     	if(index==0){
				$(this).find(".formacion_academica").attr('id','id_formacionAcademica'+index);
		     	$(this).find(".inicio_curso").attr('id','inicio_curso'+index);
		     	$(this).find(".fin_curso").attr('id','fin_curso'+index);
		     	$(this).find(".form-control").attr('id','nombre_instituto'+index);
		     	$(this).find(".descripcion_obtencion").attr('id','descripcion_obtencion'+index);
     	}else{
	     		$(this).find(".formacion_academica").attr('id','id_formacionAcademica'+index);
		     	$(this).find(".inicio_curso").attr('id','inicio_curso'+index);
		     	$(this).find(".fin_curso").attr('id','fin_curso'+index);
		     	$(this).find(".form-control").attr('id','nombre_instituto'+index);
		     	$(this).find(".descripcion_obtencion").attr('id','descripcion_obtencion'+index);
	     		$(this).find("#eliminar").attr('value',index);//cambio el value del boton
	     		$(this).find("#eliminar").text('').prepend('<img  src="complementos/cancel.png" width="18"> Eliminar sección '+index);
     	}
     	
     	FieldCount1=index;
   
            });

}//FIN DE FUNCION RENOMBRAR


//----ELIMINAR DESD3E BASE DE DATOS---->>>
 function EliminarSeccionEstuduios_BaseD(id_curriculo, id_formacionA, thiss){
		
			$.ajax({
	        async:true, 
	        cache:false,
	        dataType:"html", 
	        type: 'POST',   
	        url: "../controlador/Gestion_Curriculo_Controller.php",
	        data: {

	            id_curriculo        : id_curriculo,
	            id_formacionA       : id_formacionA,
	            
	            EliminarSeccion     : "boton"

	              },
	              
	success: function(data){ 
	  //var result = $.trim(data);
	  
	//alert(data);

	     if(data==0) {
	        
	    swal("A Ocurrido Un Error Al Insertar", "", "error");         
	    

	    }else if(data==1) {

	    $(thiss).parent().parent().parent().parent().remove(); //ELIMINAR SECCION PANTALLA
		RenombrarIds_AlEliminarEstudios();
	    swal("Sección Eliminada!",'', "success");          
	    
	    }

	    //restablecerForm();
	    }
	    });

 		
   


}
//----FIN DE ELIMINAR



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//AGREGAR SECCION EXPERIENCIA LABORAL  ------>
$(document).ready(function() {

    var MaxInputs       = 6; //Número Maximo de Campos
    var contenedor      = $(".contenedor2_trabajo"); //ID del contenedor
    var AddButton       = $("#agregarCampo_Trabajo"); //ID del Botón Agregar

    var con=1;
   
    $(AddButton).click(function (e) {
        if(FieldCount <= MaxInputs) //max input box allowed
        {
             FieldCount = FieldCount+1; //para el seguimiento de los campos
            //agregar campo

            $(contenedor).append('<div class="contenedor2_trabajo">'   
                                        +'<article class="exp-item"><div class="ExperienciaLaboral">'
                                        +'<div class="exp-holder">'
                                        +'<button type="button" id="eliminar2" class="btn btn-primary btn-sm" value="'+FieldCount+'"><img  src="complementos/cancel.png" width="18"> Eliminar sección '+FieldCount+'</button>'
                                            +'<div class="head">'
                                            +'<input type="hidden" id="id_experienciaLaboral'+FieldCount+'" class="experiencia_laboral" name="experiencia_laboral[]">'
                                                +'<div class="date-range">Fecha:<input type="date" id="inicio_empleo'+FieldCount+'" name="inicio_empleo[]" class="inicio_empleo">-<input type="date" id="fin_empleo'+FieldCount+'" name="fin_empleo[]" class="fin_empleo"></div>'
                                                    +'<br><h4>Nómbre Empresa:</h4><br><input type="text" id="nombre_empresa'+FieldCount+'" name="nombre_empresa[]" placeholder="NOMBRE DE LA INSTITUCION O EMPRESA DONDE HA TRABAJADO" size="40" class="form-control" onkeyup="this.value=this.value.toUpperCase()"> <br><br>'
                                                    +'<h4>Cargo:</h4><input type="text" id="cargo_en_empresa'+FieldCount+'" name="cargo_en_empresa[]" class="cargo_en_empresa"  size="40" placeholder="CARGO EJERCIDO" onkeyup="this.value=this.value.toUpperCase()">'
                                                 +'</div>'
                                                 +'<div class="body"><br>'
                                                    +'<h4><font color="#6E6E6E">Descripción De Su Función</font></h4>'
                                                 +'<textarea name="funcion_en_empresa[]" id="funcion_en_empresa'+FieldCount+'" class="funcion_en_empresa" rows="3" placeholder="BREVE DESCRIPCIÓN DE SU FUNCIÓN Y DESEMPEÑO EN DICHA EMPRESA..." onkeyup="this.value=this.value.toUpperCase()"></textarea>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div></article></div>');
                                                      
                                
           
        }else{
       	 swal("Maximo De Secciones");
       } 

        return false;
    });

    $("body").on("click","#eliminar2", function(e){ //click en eliminar campo
        
           var numSeccionn=$(this).parent().find('#Eliminar2').val();//----POR MEDIO DEL BOTON ELIMINAR OBTENGO EL NUMERO PARA SACAR EL ID DE LA SECCION QUE QUIERO ELIMINAR
            //alert(numSeccionn);
            	var thiss=$(this);
                var id_ExperienciaL=$("#id_experienciaLaboral"+numSeccionn).val();
                var id_curriculo=$("#id_curriculo").val();
                
                    if(id_ExperienciaL!=""){
                        			//alert("id curriculo:"+id_curriculo+" id experiencia:"+id_ExperienciaL);
                        	
		                        	//ALERT DE CONFIRMACION---->>>
		                        	swal({   
					                     title: "Atenciòn",   
					                     text:  "Seguro Que Desea Eliminar Esta Sección? ",

					                     type: "warning", 
					                     showCancelButton: true, 
					                     confirmButtonColor: "#DD6B55",
					                     confirmButtonText: "Aceptar",
					                     cancelButtonText: "Cancelar", 
					                     closeOnConfirm: false 
					                 }, 
					                     function(){

					                     	//----FUNCION PAR ELIMINAR AL HACER CLICK
					                        EliminarSeccionTrabajo_BaseD(id_curriculo, id_ExperienciaL, thiss);
					                        
		                    			});//---FIN DEL ALERT
		                        	
					                       
                        
                    }else{

                    	$(this).parent().parent().parent().parent().remove(); //ELIMINAR SECCION PANTALLA
                    	RenombrarIds_AlEliminarExperiencia();       
            
                    }//---FIN DEL IF.
        
        return false;
    });
});


//----RENOMBRAR LOS IDS AL ELIMUINAR UNA SECCION---->>>>
function RenombrarIds_AlEliminarExperiencia(){

     $('.contenedor2_trabajo').each( function(index, value){
     	if(index==0){
				$(this).find(".experiencia_laboral").attr('id','id_experienciaLaboral'+index);
		     	$(this).find(".inicio_empleo").attr('id','inicio_empleo'+index);
		     	$(this).find(".fin_empleo").attr('id','fin_empleo'+index);
		     	$(this).find(".form-control").attr('id','nombre_empresa'+index);
		     	$(this).find(".cargo_en_empresa").attr('id','cargo_en_empresa'+index);
		     	$(this).find(".funcion_en_empresa").attr('id','funcion_en_empresa'+index);
     	}else{
	     		$(this).find(".experiencia_laboral").attr('id','id_experienciaLaboral'+index);
		     	$(this).find(".inicio_empleo").attr('id','inicio_empleo'+index);
		     	$(this).find(".fin_empleo").attr('id','fin_empleo'+index);
		     	$(this).find(".form-control").attr('id','nombre_empresa'+index);
		     	$(this).find(".cargo_en_empresa").attr('id','cargo_en_empresa'+index);
		     	$(this).find(".funcion_en_empresa").attr('id','funcion_en_empresa'+index);
	     		$(this).find("#eliminar2").attr('value',index);//cambio el value del boton
	     		$(this).find("#eliminar2").text('').prepend('<img  src="complementos/cancel.png" width="18"> Eliminar sección '+index);
     	}
     	
     	FieldCount=index;
   
            });

}//FIN DE FUNCION RENOMBRAR


//----ELIMINAR DESD3E BASE DE DATOS---->>>
 function EliminarSeccionTrabajo_BaseD(id_curriculo, id_experienciaL, thiss){
		

			$.ajax({
	        async:true, 
	        cache:false,
	        dataType:"html", 
	        type: 'POST',   
	        url: "../controlador/Gestion_Curriculo_Controller.php",
	        data: {

	            id_curriculo          : id_curriculo,
	            id_experienciaL       : id_experienciaL,
	            
	            EliminarSeccion2     : "boton"

	              },
	              
	success: function(data){ 
	  //var result = $.trim(data);
	  
	//alert(data);

	     if(data==0) {
	        
	    swal("A Ocurrido Un Error Al Insertar", "", "error");         
	    

	    }else if(data==1) {

	    $(thiss).parent().parent().parent().parent().remove(); //ELIMINAR SECCION PANTALLA
		RenombrarIds_AlEliminarExperiencia();
	    swal("Sección Eliminada!",'', "success");          
	    
	    }

	    //restablecerForm();
	    }
	    });

}
//----FIN DE ELIMINAR





// CUANDO SE HACE  CLICK  EN EL BOTON Registrar
    // Bloqueam
    $(document).ready(function() {
    $("#Registrar").click(function(){

            Registar_Curriculo();
            
    
    }); 
});


    $(document).ready(function() {
    $("#Actualizar").click(function(){

            Actualizar_Curriculo();
            
    
    }); 
});

//FIN DE INTERACCION DE LA PAGINA DEL CURRICULO.






    function Registar_Curriculo(){

        
        var inicio_curso=new Array();
        var fin_curso=new Array();
        var nombre_instituto=new Array();
        var descripcion_obtencion=new Array();
        var inicio_empleo=new Array();
        var fin_empleo=new Array();
        var nombre_empresa=new Array();
        var cargo_en_empresa=new Array();
        var funcion_en_empresa=new Array();

	    var id_persona              = $("#id_persona").val();
	    var profesion               = $("#profesion").val();
	    var descripcion_profesion   = $("#descripcion_profesion").val();
    
    

    //alert(id_persona+profesion+descripcion_profesion);
    //alert(inicio_curso+fin_curso+nombre_instituto+descripcion_obtencion);
    //alert(inicio_empleo+fin_empleo+nombre_empresa+cargo_en_empresa+funcion_en_empresa);
    

    $('div .FormacionAcademica').each(function(contador){
        //FORMACION ACADEMICA
     inicio_curso[contador]          = $("#inicio_curso"+contador).val();
     fin_curso[contador]             = $("#fin_curso"+contador).val();
     nombre_instituto[contador]      = $("#nombre_instituto"+contador).val();
     descripcion_obtencion[contador] = $("#descripcion_obtencion"+contador).val();
         
         
        //alert(nombre_instituto);
    });

    $('div .ExperienciaLaboral').each(function(contador) {
        //ESPERIENCIA LABORAL
     inicio_empleo[contador]      = $("#inicio_empleo"+contador).val();
     fin_empleo[contador]         = $("#fin_empleo"+contador).val();
     nombre_empresa[contador]     = $("#nombre_empresa"+contador).val();
     cargo_en_empresa[contador]   = $("#cargo_en_empresa"+contador).val();
     funcion_en_empresa[contador] = $("#funcion_en_empresa"+contador).val();
         
        //alert(nombre_empresa);
    });

    var boton  = "Registra";

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Curriculo_Controller.php",
        data: {

            id_persona              : id_persona,
            profesion               : profesion,
            descripcion_profesion   : descripcion_profesion,
            inicio_curso            : inicio_curso,
            fin_curso               : fin_curso,
            nombre_instituto        : nombre_instituto,
            descripcion_obtencion   : descripcion_obtencion,
            inicio_empleo           : inicio_empleo,
            fin_empleo              : fin_empleo,
            nombre_empresa          : nombre_empresa,
            cargo_en_empresa        : cargo_en_empresa,
            funcion_en_empresa      : funcion_en_empresa,

            Registrar_Curriculo     : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);
  
alert(data);

     if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error");         
    

    }else if(data==1) {
        
    swal("Currículo Registrado Exitosamente!",'', "success");          
    location.reload();
    }

    //restablecerForm();
    }
    });

}//-----FIN DE REGISTRAR



//---------ACTYUALIZAR---->>>>
function Actualizar_Curriculo(){

        var id_formacionA= new Array();
        var inicio_curso=new Array();
        var fin_curso=new Array();
        var nombre_instituto=new Array();
        var descripcion_obtencion=new Array();

        var id_ExperienciaL=new Array();
        var inicio_empleo=new Array();
        var fin_empleo=new Array();
        var nombre_empresa=new Array();
        var cargo_en_empresa=new Array();
        var funcion_en_empresa=new Array();

        var id_curriculo            = $("#id_curriculo").val();
	    var id_persona              = $("#id_persona").val();
	    var profesion               = $("#profesion").val();
	    var descripcion_profesion   = $("#descripcion_profesion").val();
    
    

    //alert(id_persona+profesion+descripcion_profesion);
    //alert(inicio_curso+fin_curso+nombre_instituto+descripcion_obtencion);
    //alert(inicio_empleo+fin_empleo+nombre_empresa+cargo_en_empresa+funcion_en_empresa);
    

    $('div .FormacionAcademica').each(function(contador){
        //FORMACION ACADEMICA
 	 id_formacionA[contador]         = $("#id_formacionAcademica"+contador).val();  
     inicio_curso[contador]          = $("#inicio_curso"+contador).val();
     fin_curso[contador]             = $("#fin_curso"+contador).val();
     nombre_instituto[contador]      = $("#nombre_instituto"+contador).val();
     descripcion_obtencion[contador] = $("#descripcion_obtencion"+contador).val();
         
         
        //alert(nombre_instituto);
    });

    $('div .ExperienciaLaboral').each(function(contador) {
        //ESPERIENCIA LABORAL
 	 id_ExperienciaL[contador]    = $("#id_experienciaLaboral"+contador).val();       
     inicio_empleo[contador]      = $("#inicio_empleo"+contador).val();
     fin_empleo[contador]         = $("#fin_empleo"+contador).val();
     nombre_empresa[contador]     = $("#nombre_empresa"+contador).val();
     cargo_en_empresa[contador]   = $("#cargo_en_empresa"+contador).val();
     funcion_en_empresa[contador] = $("#funcion_en_empresa"+contador).val();
         
        //alert(nombre_empresa);
    });

    var boton  = "Actualiza";

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Curriculo_Controller.php",
        data: {

            id_persona              : id_persona,
            id_curriculo 			: id_curriculo,
            profesion               : profesion,
            descripcion_profesion   : descripcion_profesion,
            id_formacionA           : id_formacionA,
            inicio_curso            : inicio_curso,
            fin_curso               : fin_curso,
            nombre_instituto        : nombre_instituto,
            descripcion_obtencion   : descripcion_obtencion,
            id_ExperienciaL         : id_ExperienciaL,
            inicio_empleo           : inicio_empleo,
            fin_empleo              : fin_empleo,
            nombre_empresa          : nombre_empresa,
            cargo_en_empresa        : cargo_en_empresa,
            funcion_en_empresa      : funcion_en_empresa,

            Actualizar 		        : boton

              },
              
success: function(data){ 
  //var result = $.trim(data);
  
alert(data);

     if(data==0) {
        
    swal("A Ocurrido Un Error Al Insertar", "", "error");         
    

    }else if(data==1) {
        
    swal("Currículo Actualizado Exitosamente!",'', "success");          
    
    }

    //restablecerForm();
    }
    });

}//-----FIN DE ACTUALIZAR




//-------Consultar EL CURRICULO
function ConsultarCurriculo() 
        {
    
           var id_persona = $('#id_persona').val();
           var boton="Registra";

           
        //alert(id_persona);
        $.ajax({
                async:true, 
                cache:false,
                dataType:"html", 
                type: 'POST',   
                url: "../controlador/Gestion_Curriculo_Controller.php",
                data:{
                       id_persona : id_persona,
                       MostrarCurriculo : 'boton'     
              
                },
              
                success: function(array){ 
                //alert(personal);
                  var datos = JSON.parse(array);
                  

                  //alert(datos.PERSONAL);


        //DATOS PERSONALES----->>>
        $.each(datos.PERSONAL, function(index, value){

        //alert(value['foto']);
        $('#profesion').val(value['profesion']);
        $('#descripcion_profesion').val(value['descripcion']);
        $('#fotografia').attr("src", value['foto']);
        
        $("#Registrar").attr("disabled", true);
        $("#Actualizar").attr("disabled", false);
        $("#VistaPrevia").attr("disabled", false);            
        });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        var contenedor  = $(".contenedorr_estudios"); //ID del contenedor
        //$('#contenedorr_estudios div').remove(); //eliminar LA SECCION EXISTENTE.
        //FORMACION ACADEMICA----->>>
        var countt=0;
        $.each(datos.ACADEMICA, function(index, value){

        if(index==0){
        	$('#id_curriculo').val(value['id_curriculum']);
        	$('#id_formacionAcademica'+index).val(value['id_formacion']);
            $('#nombre_instituto'+index).val(value['nombre_instituto']);
            $('#descripcion_obtencion'+index).val(value['observacion']);
            //DESCONCATENAR FECHA
            var fechai = (value['ano_egreso']).split('/')[0];
            var fechaf = (value['ano_egreso']).split('/')[1];
            $('#inicio_curso'+index).val(fechai);
            $('#fin_curso'+index).val(fechaf);
        }else{
            //CREO LA SECCION---->>
            $(contenedor).append('<div class="contenedorr_estudios">'                    
                                    +'<article class="exp-item"><div class="FormacionAcademica">'
                                    +'<div class="exp-holder">'
                                    +'<button type="button" id="eliminar" class="btn btn-primary btn-sm" value="'+index+'"><img  src="complementos/cancel.png" width="18"> Eliminar sección '+index+'</button>'
                                        +'<div class="head">'
                                            +'<input type="hidden" id="id_formacionAcademica'+index+'" class="formacion_academica" name="formacion_academica[]">'
                                            +'<div class="date-range">Fecha:<input type="date" id="inicio_curso'+index+'" class="inicio_curso" name="inicio_curso[]">-<input type="date" id="fin_curso'+index+'" class="fin_curso" name="fin_curso[]"></div>'
                                            +'<br><h4>Nómbre Instituto:</h4><br><input type="text" id="nombre_instituto'+index+'" name="nombre_instituto[]"  class="form-control" placeholder="NOMBRE DE LA INSTITUCION DONDE EJERCIÓ SUS ESTUDIOS, SEGUN EL AÑO" onkeyup="this.value=this.value.toUpperCase()">'                                                        
                                        +'</div>'
                                        +'<div class="body">'
                                            +'<h4><font color="#6E6E6E">Descripción</font></h4>'
                                            +'<textarea name="descripcion_obtencion[]" id="descripcion_obtencion'+index+'" class="descripcion_obtencion" rows="3" placeholder="DESCRIPCIÓN DE SU TITUTLO OBTENIDO Ó GRADOS CURSADO..." onkeyup="this.value=this.value.toUpperCase()"></textarea>'
                                        +'</div>'
                                    +'</div>'
                                +'</div></article></div>');
                
                $('#id_formacionAcademica'+index).val(value['id_formacion']);
                $('#nombre_instituto'+index).val(value['nombre_instituto']);
                $('#descripcion_obtencion'+index).val(value['observacion']);
                //DESCONCATENAR FECHA
                var fechai = (value['ano_egreso']).split('/')[0];
                var fechaf = (value['ano_egreso']).split('/')[1];
                $('#inicio_curso'+index).val(fechai);
                $('#fin_curso'+index).val(fechaf);
                

            }

            FieldCount1=index;
       
        });

/////////////////////////////////////////////////////////////////////////////////////////////////7

        var contenedor2  = $(".contenedor2_trabajo"); //ID del contenedor
        //$('#contenedor2_trabajo div').remove(); //eliminar LA SECCION EXISTENTE.
        //FORMACION ACADEMICA----->>>
        $.each(datos.LABORAL, function(index, value){

            //----SI TIENE UNA SOLA SECCION AGREGO EN LA PRIMIRA, SIN CREAR
            if(index==0){
            		$('#id_experienciaLaboral'+index).val(value['id_experiencia']);
                    $('#nombre_empresa'+index).val(value['nombre_empresa']);
                    $('#cargo_en_empresa'+index).val(value['cargo']);
                    $('#funcion_en_empresa'+index).val(value['funcion']);
                    //DESCONCATENAR FECHA
                    var fechai = (value['duracion']).split('/')[0];
                    var fechaf = (value['duracion']).split('/')[1];
                    $('#inicio_empleo'+index).val(fechai);
                    $('#fin_empleo'+index).val(fechaf);
            }else{
                //---SI HAY MAS DE UNA CREO LA SECCION COMPLETA

                 //CREO LA SECCION---->>
                $(contenedor2).append('<div class="contenedor2_trabajo">'   
                                            +'<article class="exp-item"><div class="ExperienciaLaboral">'
                                            +'<div class="exp-holder">'
                                            +'<button type="button" id="eliminar2" class="btn btn-primary btn-sm" value="'+index+'"><img  src="complementos/cancel.png" width="18"> Eliminar sección '+index+'</button>'
                                                +'<div class="head">'
                                                +'<input type="hidden" id="id_experienciaLaboral'+index+'" class="experiencia_laboral" name="experiencia_laboral[]">'
                                                    +'<div class="date-range">Fecha:<input type="date" id="inicio_empleo'+index+'" name="inicio_empleo[]" class="inicio_empleo">-<input type="date" id="fin_empleo'+index+'" name="fin_empleo[]" class="fin_empleo"></div>'
                                                        +'<br><h4>Nómbre Empresa:</h4><br><input type="text" id="nombre_empresa'+index+'" name="nombre_empresa[]" placeholder="NOMBRE DE LA INSTITUCION O EMPRESA DONDE HA TRABAJADO" size="40" class="form-control" onkeyup="this.value=this.value.toUpperCase()"> <br><br>'
                                                        +'<h4>Cargo:</h4><input type="text" id="cargo_en_empresa'+index+'" name="cargo_en_empresa[]" class="cargo_en_empresa"  size="40" placeholder="CARGO EJERCIDO" onkeyup="this.value=this.value.toUpperCase()">'
                                                     +'</div>'
                                                     +'<div class="body"><br>'
                                                        +'<h4><font color="#6E6E6E">Descripción De Su Función</font></h4>'
                                                     +'<textarea name="funcion_en_empresa[]" id="funcion_en_empresa'+index+'" class="funcion_en_empresa" rows="3" placeholder="BREVE DESCRIPCIÓN DE SU FUNCIÓN Y DESEMPEÑO EN DICHA EMPRESA..." onkeyup="this.value=this.value.toUpperCase()"></textarea>'
                                                +'</div>'
                                            +'</div>'
                                        +'</div></article></div>');

					$('#id_experienciaLaboral'+index).val(value['id_experiencia']);
                    $('#nombre_empresa'+index).val(value['nombre_empresa']);
                    $('#cargo_en_empresa'+index).val(value['cargo']);
                    $('#funcion_en_empresa'+index).val(value['funcion']);
                    //DESCONCATENAR FECHA
                    var fechai = (value['duracion']).split('/')[0];
                    var fechaf = (value['duracion']).split('/')[1];
                    $('#inicio_empleo'+index).val(fechai);
                    $('#fin_empleo'+index).val(fechaf);



            }

      			FieldCount=index;
            });
                  

                    //restablecerForm();
                    }
                    });
        }







ver();

function ver()
{
    if($("#persona").val()!=null){
//alert($("#persona").val())
        VistaPrevia();
    }else{
        $("#Registrar").attr("disabled", false);
        $("#Actualizar").attr("disabled", true);
        $("#VistaPrevia").attr("disabled", true);
        ConsultarCurriculo();

    }
        
    }





// CUANDO SE HACE  CLICK  EN EL BOTON Registrar
    // Bloqueam
    $(document).ready(function() {
    $("#VistaPrevia").click(function(){

        VistaPrevia_TiempoReal();
            
    }); 
});


    function VistaPrevia_TiempoReal(){

       
        var inicio_curso=new Array();
        var fin_curso=new Array();
        var nombre_instituto=new Array();
        var descripcion_obtencion=new Array();

        
        var inicio_empleo=new Array();
        var fin_empleo=new Array();
        var nombre_empresa=new Array();
        var cargo_en_empresa=new Array();
        var funcion_en_empresa=new Array();

        //var id_curriculo            = $("#id_curriculo").val();
        //var id_persona              = $("#id_persona").val();
        var profesion               = $("#profesion").val();
        var descripcion_profesion   = $("#descripcion_profesion").val();
    	var fotografia				= $("#fotografia").attr('src');
    	
    $('div .FormacionAcademica').each(function(contador){
        //FORMACION ACADEMICA
     inicio_curso[contador]          = $("#inicio_curso"+contador).val();
     fin_curso[contador]             = $("#fin_curso"+contador).val();
     nombre_instituto[contador]      = $("#nombre_instituto"+contador).val();
     descripcion_obtencion[contador] = $("#descripcion_obtencion"+contador).val();
         
         
        //alert(nombre_instituto);
    });
    
    $('div .ExperienciaLaboral').each(function(contador) {
        //ESPERIENCIA LABORAL   
     inicio_empleo[contador]      = $("#inicio_empleo"+contador).val();
     fin_empleo[contador]         = $("#fin_empleo"+contador).val();
     nombre_empresa[contador]     = $("#nombre_empresa"+contador).val();
     cargo_en_empresa[contador]   = $("#cargo_en_empresa"+contador).val();
     funcion_en_empresa[contador] = $("#funcion_en_empresa"+contador).val();
         
        //alert(nombre_empresa);
    });

    

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/Gestion_Curriculo_Controller.php",
        data: {

            //id_persona              : id_persona,
            //id_curriculo            : id_curriculo,
            fotografia				: fotografia,
            profesion               : profesion,
            descripcion_profesion   : descripcion_profesion,
            //id_formacionA           : id_formacionA,
            inicio_curso            : inicio_curso,
            fin_curso               : fin_curso,
            nombre_instituto        : nombre_instituto,
            descripcion_obtencion   : descripcion_obtencion,
            //id_ExperienciaL         : id_ExperienciaL,
            inicio_empleo           : inicio_empleo,
            fin_empleo              : fin_empleo,
            nombre_empresa          : nombre_empresa,
            cargo_en_empresa        : cargo_en_empresa,
            funcion_en_empresa      : funcion_en_empresa,

            Vista_Previa              : "Vista_Previa"

              },
                      
                success: function(data){ 
                    alert(data);
        		var variable = JSON.parse(data);
                if(variable=='Vista_Previa'){
                    window.open('VistaPrevia_TiempoReal.php');
                }
 
    }
    });
    }



//-------MOSTRAR EL CURRICULO
function VistaPrevia(){
    
           //var id_persona      = document.getElementById("id_persona").value;
           var id_persona= $("#persona").val();
           var boton="Registra";

           
        	
        $.ajax({
                async:true, 
                cache:false,
                dataType:"html", 
                type: 'POST',   
                url: "../controlador/Gestion_Curriculo_Controller.php",
                data:{
                       id_persona : id_persona,
                       MostrarCurriculo : 'boton'     
              
                },
              
                success: function(array){  
                
                  var datos = JSON.parse(array);
                  

                  //alert(datos.PERSONAL);


        //DATOS PERSONALES----->>>
        $.each(datos.PERSONAL, function(index, value){

        //alert(value['foto']);
        $('#profesion').html("&nbsp; &nbsp; "+value['profesion']);
        $('#descripcion_profesion').html("&nbsp; &nbsp; "+value['descripcion']);
        $('#fotografia').attr("src", value['foto']);

        $('#nombre_persona').html(value['nombre']);
        $('#datos').html(value['nombre']+" Estudiante de "+value['especialidad']+", <br> en "+value['siglas']);
        
                    
        });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        var contenedor  = $("#contenedorr_estudios"); //ID del contenedor
        // //FORMACION ACADEMICA----->>>
        $.each(datos.ACADEMICA, function(index, value){

        //CREO LA SECCION---->>
        $(contenedor).append('<article class="exp-item">'                  
                                  +'<div class="FormacionAcademica">'
                                    +'<div class="exp-holder">'
                                        +'<div class="head">'
                                            +'<div class="date-range">Fecha:<br><font color="#D8FFFB">'+value['ano_egreso']+'</font></div>'
                                            +'<br><h4>INSTITUTO</h4><br><font color="#D8FFFB" size="3">'+value['nombre_instituto']+'</font><br>'                                                       
                                        +'</div>'
                                        +'<div class="body">'
                                            +'<br><font color="#3F4D52">'+value['observacion']+'</p>'
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
                                                +'<div class="date-range">Fecha:<br><font color="#D8FFFB">'+value['duracion']+'</font></div>'
                                                    +'<br><h4>EMPRESA</h4><br><font color="#D8FFFB" size="3">'+value['nombre_empresa']+'</font><br><hr>'
                                                    +'<h4>CARGO</h4><br> <font color="#D8FFFB" size="3">'+value['cargo']+'</font>'
                                                  +'</div>'
                                                  +'<div class="body"><br>'
                                                +'<font color="#3F4D52">'+value['funcion']+'</font>'
                                            +'</div>'
                                        +'</div>'
                                  +'</div></article>');


            });
                   
 
 	                   //restablecerForm();
    				}                

                    });
        }






   




//----SUBIR FOTO Temporal--->>>

$(function() 
        {
            // Botón para subir la firma
            var btn_firma = $('#addImage'), interval;
            
            var RutaImagen='../images/ImagenPrevia';
            
            new AjaxUpload('#addImage', 
            {
                action: '../controlador/includesImages/uploadFile.php',
                type: "POST",
                data: 
                {
                            Ruta:'../'+RutaImagen,
                            Nombre:'Photo'
                },
                onSubmit : function(file , ext)
                {
                    if (! (ext && /^(jpg|png)$/.test(ext)))
                    {
                        // extensiones permitidas
                        alert('Sólo se permiten Imagenes .jpg o .png');
                        // cancela upload
                        return false;
                    }
                    else 
                    {
                        $('#loaderAjax').show();
                        btn_firma.text('Espere...');
                        this.disable();
                    }
                },
                onComplete: function(event, respuesta)
                {

                    btn_firma.text('').prepend('Cambiar Imagen <img  src="complementos/image.png" width="15">');
                    var dato = eval("(" + respuesta + ")");
                    if(dato.respuesta == 'done')
                    {
                        $('#fotografia').removeAttr('src');
                        $('#fotografia').attr('src',RutaImagen+'/'+dato.fileName);
                        $('#loaderAjax').show();
                        // alert(respuesta.mensaje);
                    }
                    else
                    {
                        alert(dato.mensaje);
                    }       
                    $('#loaderAjax').hide();    
                    this.enable();  
                }
            });
        });
