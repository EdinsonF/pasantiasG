
$(document).ready(function(){


	buscardatos_persona();
});

function buscardatos_persona()
{
	 $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibejquery.php",
        data: {
                
            id_persona : $("#id_persona").val(),
           
            Datossession : 'sds'

              },

              
success: function(data){ 

      var variable = JSON.parse(data);

  	$("#cedulaPE").val(variable.cedula);
	$("#nombrePE").val(variable.nombre);
	$("#apellidoPE").val(variable.apellido);
	$("#telefonoPE").val(variable.telefono);
	$("#correoPE").val(variable.correo);
	$("#usuarioP").val(variable.usuario);
	$("#contrasena_a").val(variable.contrasena);


    }
    });
}
   

    $("#Modificar").on('click',function()
    	{

    		ModificarDatos();
    	});

    function ModificarDatos()
    {

    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/recibejquery.php",
        data: {                
            id_persona : $("#id_persona").val(),
            telefono:$("#telefonoPE").val(),
			correo:$("#correoPE").val(),
			usuario:$("#usuarioP").val(),
			contrasena:$("#contrasena_a").val(),
            ModificarDatos : 'sshSql'

              },
              
		success: function(data)
		{ 
		      
		      var variable = JSON.parse(data);
		      if(data==1)
		      	{
		      			swal("Datos Modificado!",'', "success");
		      			buscardatos_persona();
		      	}else
		      	{
		      		    swal("Error !",'', "error");
		      	}

		}
    });

    }