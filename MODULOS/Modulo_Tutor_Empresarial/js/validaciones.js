

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
function validar_tutor() {
        //obteniendo el valor que se puso en el campo text del formulario
        miCampoTexto = document.getElementById("cedula").value;
        miCampoTexto2 = document.getElementById("codigo").value;
        miCampoTexto3 = document.getElementById("id_empresa").value;
        miCampoTexto4 = document.getElementById("id_instituto").value;
        //la condición
         if((miCampoTexto3.length == 0 || /^\s+$/.test(miCampoTexto3)) && (miCampoTexto4.length == 0 || /^\s+$/.test(miCampoTexto4))) {
         alert("No Selecciono una Organizaci\u00f3n");
         
         return false;
       }else
        if((miCampoTexto.length >0 || /^\s+$/.test(miCampoTexto)) && (miCampoTexto2.length >0 || /^\s+$/.test(miCampoTexto))) {
         alert("La consulta de realizarse por cedula o expediente");
         
         return false;
       }else if(miCampoTexto2.length <1){
		if(miCampoTexto.length <6 || /^\s+$/.test(miCampoTexto)) {
         alert("Debe escribir 6 o mas caracteres en el campo cedula");
         
		 return false;   
        }
	}else{
        if(miCampoTexto2.length <4 || /^\s+$/.test(miCampoTexto2)) {
         alert("Debe escribir 4 o mas caracteres en el campo expediente");
         
         return false;   
        }
    }
return true;
}

function validar_registro_estudiante() {
        //obteniendo el valor que se puso en el campo text del formulario
        
        miCampoTexto1 = document.getElementById("usuario").value;
        miCampoTexto2 = document.getElementById("contrasena_a").value;
        miCampoTexto3 = document.getElementById("contrasena_b").value;
       
        if(miCampoTexto1.length <3 || /^\s+$/.test(miCampoTexto1)) {
         alert("El usuarioes muy corto");
         
         return false;   
        }else 
         if(miCampoTexto2.length <3 || /^\s+$/.test(miCampoTexto2)) {
         alert("La contrase\u00f1a es muy corta");
         
         return false;   
        }else 
        if(miCampoTexto3.length <1 || /^\s+$/.test(miCampoTexto3)) {
         alert("campo repita contraseña vacio");
         
         return false;   
        }else
         if(miCampoTexto2 != miCampoTexto3) {
         alert("las contrase\u00f1as no coinciden");
         
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




//validacion del formulario del usuario del sistema
function validar_registro_usuario() {

		//obteniendo el valor que se puso en el campo text del formulario
       
        //obteniendo el valor que se puso en el campo text del formulario
        miCampoTexto = document.getElementById("nombre").value;
        //la condición
        if (miCampoTexto.length == 0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo nombre vacio ");
		 document.getElementById("nombr").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("nombr").style.border = "";
		}
		if(miCampoTexto.length <3 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 3 o mas caracteres en el campo nombre ");
         document.getElementById("nombr").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("nombr").style.border = "";
		}
	
	//obteniendo el valor que se puso en el campo text del formulario
        miCampoTexto = document.getElementById("apellido").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo apellido vacio ");
		 document.getElementById("apelli").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("apelli").style.border = "";
		}
		if(miCampoTexto.length <3 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 3 o mas caracteres en el campo apellido");
         document.getElementById("apelli").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("apelli").style.border = "";
		}
	
	//obteniendo el valor que se puso en el campo text del formulario
        miCampoTexto = document.getElementById("usuario").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo usuario vacio ");
		 document.getElementById("usuari").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("usuari").style.border = "";
		} 
		if(miCampoTexto.length <4 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 4 o mas caracteres en el campo usuario");
         document.getElementById("usuari").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("usuari").style.border = "";
		}
	//obteniendo el valor que se puso en el campo text del formulario
        miCampoTexto = document.getElementById("contrase").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo contrase\u00f1a vacio ");
		 document.getElementById("clave").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("clave").style.border = "";
		}
		if(miCampoTexto.length <4 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 4 o mas caracteres en el campo contrase\u00f1a");
         document.getElementById("clave").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("clave").style.border = "";
		}
	
	//validar select tipo de usuario
	
	var combo1 = document.getElementById("tipo_u")
if(combo1.value == null || combo1.value == "") {
alertify.alert("Seleccione el tipo de usuario");
document.getElementById("tipo").style.border = "2px solid red";
return false;
} else {
document.getElementById("tipo").style.border = "";
}

return true;
}
//fin de las validaciones del usuario



//validacion del formulario del estudiante

function validar_registro_beneficiario() {

//cedula
        miCampoTexto = document.getElementById("txtcedula").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo cedula vacio ");
		 return false;   
			
        } if(miCampoTexto.length <6 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 6 o mas caracteres en el campo cedula ");
         return false;
    }
//nombre
        miCampoTexto = document.getElementById("nombre").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo nombre vacio ");
		 document.getElementById("nombr").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("nombr").style.border = "";
		}
		if(miCampoTexto.length <3 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 3 o mas caracteres en el campo nombre ");
         document.getElementById("nombr").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("nombr").style.border = "";
		}
	
//apellido
        miCampoTexto = document.getElementById("apellido").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo apellido vacio ");
		 document.getElementById("apelli").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("apelli").style.border = "";
		}
		if(miCampoTexto.length <3 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 3 o mas caracteres en el campo apellido");
         document.getElementById("apelli").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("apelli").style.border = "";
		}
	
//validar select tipo de estudiante
	
	var combo1 = document.getElementById("tipo_e")
if(combo1.value == null || combo1.value == "") {
alertify.alert("Seleccione el tipo de estudiante");
document.getElementById("tipo").style.border = "2px solid red";
return false;
} else {
document.getElementById("tipo").style.border = "";
}


//año que cursa
        miCampoTexto = document.getElementById("ano_curso").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo grado de instrucc\u00edon vacio ");
		 document.getElementById("curso").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("curso").style.border = "";
		}
		


//validar select fecha de nacimiento

//mes
	var combo1 = document.getElementById("fecha_nacimiento")
if(combo1.value == null || combo1.value == "") {
alertify.alert("Seleccione el a\u00f1o de nacimiento");
document.getElementById("mes").style.border = "2px solid red";
return false;
} else {
document.getElementById("mes").style.border = "";
}

//municipio
	var combo1 = document.getElementById("municipio")
if(combo1.value == null || combo1.value == "") {
alertify.alert("Seleccione el municipio");
document.getElementById("municipios").style.border = "2px solid red";
return false;
} else {
document.getElementById("municipios").style.border = "";
}

//sexo
var a = 0, rdbtn=document.getElementsByName("sexo")
for(i=0;i<rdbtn.length;i++) {
if(rdbtn.item(i).checked == false) {
a++;
}
}
if(a == rdbtn.length) {
alertify.alert("Seleccione el tipo de sexo");
document.getElementById("sex").style.border = "2px solid red";
return false;
} else {
document.getElementById("sex").style.border = "";
}

//estado civil
	var combo1 = document.getElementById("estado_c")
if(combo1.value == null || combo1.value == "") {
alertify.alert("Seleccione el estado civil");
document.getElementById("estado_civil").style.border = "2px solid red";
return false;
} else {
document.getElementById("estado_civil").style.border = "";
}

//telefono
        miCampoTexto = document.getElementById("telefono").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo telefono vacio ");
		 document.getElementById("telefon").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("telefon").style.border = "";
		}
		if(miCampoTexto.length <11 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 11 caracteres en el campo telefono");
        document.getElementById("telefon").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("telefon").style.border = "";
		}
//telefono local
        miCampoTexto = document.getElementById("telefono_a").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo telefono local vacio ");
		 document.getElementById("telefono_l").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("telefono_l").style.border = "";
		}
		if(miCampoTexto.length <11 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 11 caracteres en el campo telefono local");
         document.getElementById("telefono_l").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("telefono_l").style.border = "";
		}
//direccion
        miCampoTexto = document.getElementById("direccion").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo direccion vacio ");
		 document.getElementById("direccio").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("direccio").style.border = "";
		}
		
//fecha de registro
        miCampoTexto = document.getElementById("fecha_r").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alert("Campo fecha de registro vacio ");
		 return false;   
        } 
	
	return true;	
	}
	
//fin campos vacio ingreso   y egresos
//fin validacion del formulario del estudio socio economico

//validacion de las opciones de configuracion del sistema
//validacion registro del representante

function validar_representante() {
       //obteniendo el valor que se puso en el campo text del formulario
        miCampoTexto = document.getElementById("cedula_r").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
        alertify.alert("Campo cedula vacio ");
		 document.getElementById("resalta").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("resalta").style.border = "";
        }
		if(miCampoTexto.length <6 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 6 o mas caracteres en el campo cedula");
         document.getElementById("resalta").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("resalta").style.border = "";
        }
	


        //obteniendo el valor que se puso en el campo text del formulario
        miCampoTexto = document.getElementById("nombre_representante").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo nombre vacio ");
		 document.getElementById("nombres").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("nombres").style.border = "";
		}
		if(miCampoTexto.length <3 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 3 o mas caracteres en el campo nombre ");
         document.getElementById("nombres").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("nombres").style.border = "";
		}
	
	//obteniendo el valor que se puso en el campo text del formulario
        miCampoTexto = document.getElementById("apellido_representante").value;
        //la condición
        if (miCampoTexto.length ==0 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Campo apellido vacio ");
		 document.getElementById("apellid").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("apellid").style.border = "";
		}
		if(miCampoTexto.length <3 || /^\s+$/.test(miCampoTexto)) {
         alertify.alert("Debe escribir 3 o mas caracteres en el campo apellido");
         document.getElementById("apellid").style.border = "2px solid red";
		 return false;   
        }else {
		document.getElementById("apellid").style.border = "";
		}

return true;
}
