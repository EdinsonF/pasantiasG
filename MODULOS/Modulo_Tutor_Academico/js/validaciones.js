

//<script type="text/javascript" src="validaciones.js"></script>
// \u00e1 -> á 
//  \u00e9 -> é 
//  \u00ed -> í 
//  \u00f3 -> ó 
//  \u00fa -> ú 
//  \u00c1 -> Á 
// \u00c9 -> É 
//  \u00cd -> Í 
//  \u00d3 -> Ó 
//  \u00da -> Ú 
//  \u00f1 -> ñ 
//  \u00d1 -> Ñ


// validacion del formulario consultar para registrar
function validar_estudiante() {
        //obteniendo el valor que se puso en el campo text del formulario
        cedula = document.getElementById("cedula").value;
        expediente = document.getElementById("expediente").value;
        //la condición
        if((cedula.length >0 || /^\s+$/.test(cedula)) && (expediente.length >0 || /^\s+$/.test(expediente))) {
            $("#cedula").focus();
             $("#expediente").focus(); 
         MensajeDatosNone();
         
         return false;
          
       }else if((cedula.length <1 || /^\s+$/.test(cedula)) && (expediente.length <1 || /^\s+$/.test(expediente))) {
          $("#cedula").focus();  
         MensajeDatosNoneVacios();
         
         return false;
          
       }else

       if(expediente.length <1){
		if(cedula.length <6 || /^\s+$/.test(cedula)) {
         $("#cedula").focus();
         MensajeDatosNoneMinimoCedula();
         
		 return false;   
        }
	}else{
        if(expediente.length <5 || /^\s+$/.test(expediente)) {
          $("#expediente").focus();
         MensajeDatosNoneMinimoExpediente();
         
         return false;   
        }
    }
return true;
}


 function a(){
    miCampoTexto4 = document.getElementById("telefono").value;
    miCampoTexto5 = document.getElementById("correo").value;
 if(miCampoTexto4.length <1 || /^\s+$/.test(miCampoTexto4)) {
            $("#telefono").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else
        if(miCampoTexto4.length <11 || /^\s+$/.test(miCampoTexto4)) {
            $("#telefono").focus();
         MensajeDatosNonetelefono();
         
         return false;   
        }else
         if(miCampoTexto5.length <1 || /^\s+$/.test(miCampoTexto5)) {
            $("#correo").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }
    return false;
 }
function validar_registro_estudiante() {
        //obteniendo el valor que se puso en el campo text del formulario
         miCampoTexto4 = document.getElementById("telefono").value;
        miCampoTexto5 = document.getElementById("correo").value;
        miCampoTexto1 = document.getElementById("usuario").value;
        miCampoTexto2 = document.getElementById("contrasena_a").value;
        miCampoTexto3 = document.getElementById("contrasena_b").value;
       
       

        if(miCampoTexto4.length <1 || /^\s+$/.test(miCampoTexto4)) {
            $("#telefono").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else
        if(miCampoTexto4.length <11 || /^\s+$/.test(miCampoTexto4)) {
            $("#telefono").focus();
         MensajeDatosNonetelefono();
         
         return false;   
        }else
         if(miCampoTexto5.length <1 || /^\s+$/.test(miCampoTexto5)) {
            $("#correo").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else
        if(miCampoTexto1.length <1 || /^\s+$/.test(miCampoTexto1)) {
            $("#usuario").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else 
        if(miCampoTexto1.length <6 || /^\s+$/.test(miCampoTexto1)) {
         MensajeDatosNoneMinimo();
         
         return false;   
        }else
        if(miCampoTexto2.length <1 || /^\s+$/.test(miCampoTexto3)) {
             $("#contrasena_a").focus();
         MensajeDatosNoneVacios();
         
         return false;   
        }else
         if(miCampoTexto2.length <6 || /^\s+$/.test(miCampoTexto2)) {
            $("#contrasena_a").focus();
         MensajeDatosNoneMinimo();
         
         return false;   
        }else 
        if(miCampoTexto3.length <1 || /^\s+$/.test(miCampoTexto3)) {
            $("#contrasena_b").focus();
          MensajeDatosNoneVacios();
         
         return false;   
        }else
         if(miCampoTexto2 != miCampoTexto3) {
            $("#contrasena_b").focus();
         MensajeDatosNone();
         
         return false;   
        }
    
return true;
}

//FIN validacion del formulario consultar para registrar

// Solo acepta números
function numeros(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron = /\d/; // Solo acepta números
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
// Solo acepta letras
function letras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-zñÑ´\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
// no acepta alfanumericos
function alfanumericos(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/\w/;  // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}





//fin validacion del formulario del beneficiario

function MensajeDatosNoneVacios()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'Campos Vacios'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNone()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'las contrase\u00f1as no coinciden'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}
function MensajeDatosNoneMinimoExpediente()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 5'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}
function MensajeDatosNoneMinimoCedula()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 6'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNoneMinimo()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 6'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}

function MensajeDatosNonetelefono()
{


$.amaran({
    content:{
        bgcolor:'#0066CC',
        color:'#fff',
        message:'El minimo de caracteres para este campo es de 11'
       },
    theme:'colorful',
    position:'bottom right',
    
    cssanimationIn: 'swing',
    cssanimationOut: 'bounceOut'
 
});
}
