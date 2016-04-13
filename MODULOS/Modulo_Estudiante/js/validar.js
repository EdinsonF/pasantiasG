<<<<<<< HEAD

// validar estudiant

// Solo acepta letras
function letras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-zñÑŽ\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
	
function v_numeros ( ) {
var telf=document.form.telefono.value;
 if(isNaN(telf)) {
 alert("Debe ingresar solo numeros");
 document.form.telefono.value=""; }
  
=======

// validar estudiant

// Solo acepta letras
function letras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-zñÑŽ\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
	
function v_numeros ( ) {
var telf=document.form.telefono.value;
 if(isNaN(telf)) {
 alert("Debe ingresar solo numeros");
 document.form.telefono.value=""; }
  
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
}