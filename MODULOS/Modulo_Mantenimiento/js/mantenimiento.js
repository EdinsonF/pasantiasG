

$("#Respaldar").click(function(){



         $.ajax({
        async:true, 
        cache:false,
        dataType: "html", 
        type: 'POST',   
        url: "../controlador/recibeMantenimiento.php",
        data: {
           
            Respaldar : 'bla'
              },              
    
		success: function(data){ 
      swal({   title: "La Base de Datos Respaldada", type: "success", 
        showCancelButton: true,   confirmButtonColor: "#6699FF",  
        confirmButtonText: "Guardar ",   closeOnConfirm: true }, function(){   
         window.location.replace("../controlador/recibeMantenimiento.php?Guardar=Guardarsd") ;});
            
    }//success
    }); // $.ajax()
});
$('input[type=file]').change(function () {
    console.log(this.files[0]);
});


$("#Recuperar").click(function(){

    if($("#Archivo").val() ==0 ){
      swal( 'Debes Seleccionar Tu Respaldo .SQL','','warning');
      $("#Archivo").focus();
    } else 
    {
      Hacer();
    }

  });

function Hacer(){
 
      var archivos = document.getElementById("Archivo");//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'path'
      var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
      var archivos = new FormData();

    /* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
    Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
    indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/

    archivos.append('Archivo',archivo[0]); //Añadimos cada archivo a el arreglo con un indice direfente
      $('#Recuperar').attr("disabled","disabled");

         $.ajax({
        async:true, 
        contentType:false,
        processData:false,
        cache:false ,        
        type: 'POST',   
        url: "../controlador/recibeMantenimiento.php",
         data: archivos,
        
		success: function(data){ 
      
     $('#Recuperar').attr("disabled",false);
     $("#Archivo").val('');
     $("#textMostrart").val('');
    //alert(data);
  	if (data =='') swal('Bien','La Base de Datos Se Actualizó','success');
               
    }//success
    }); // $.ajax()
}


$("#btnlaCoba").click(function(){
$("#Archivo").trigger('click');
});
$("#Archivo").on('change',function(){
  var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
$("#textMostrart").val(filename);
});

