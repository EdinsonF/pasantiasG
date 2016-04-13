function comprobar(CampodeTexto)
    { 
	    record=0; 
	    igual=1; 
	    var letraRecord 
	    var PosisionAntes=0 
	    var letra=""    
    for (PosisionDespues=1;PosisionDespues<CampodeTexto.length;PosisionDespues++)
    { 
	    if (CampodeTexto.charAt(PosisionDespues)==CampodeTexto.charAt(PosisionAntes))
	    { 
		    igual=igual+1; 
		    letra=CampodeTexto.charAt(PosisionDespues);
		} 
	    else{ 
		    if(igual>record){record=igual;letraRecord=letra} 
		    igual=1 
	    } 
	    	PosisionAntes=PosisionDespues
    } 

    if(igual>record){record=igual;letraRecord=letra} 

    if (record>1)
    {	
    	ExaminarL(letraRecord);

    }
    	
    }//Funcrion Comprobar

    function ExaminarL(letraRecord)
    {
    	var vocal = PasarporVocales(letraRecord);
    	var conso = PasarPorConsonante(letraRecord);
    	alert();
    	alert("La letra que más se repite es la "+letraRecord+" que aparece seguida "+record+" veces.")
    }

 function PasarporVocales(letra)
 {
 	if(letra=='a' || letra=='e'|| letra=='i' || letra=='o' || letra=='u' || 
 		letra=='á' || letra=='é' || letra=='í' || letra=='ó' || letra=='ú' )
 	{
 		return true;
 	}else 
 	{
 		return false;
 	}
 }

 function PasarPorConsonante(letra)
 {
 	if( letra=='b' || letra=='c'|| letra=='d' || letra=='f' || letra=='g' || 
 		letra=='h' || letra=='j' || letra=='k' || letra=='l' || letra=='m'||
 		letra=='n' || letra=='ñ' || letra=='p' || letra=='q' || letra=='r'||
 		letra=='s' || letra=='t' || letra=='v' || letra=='x' || letra=='y'||
 		letra=='z' || letra=='w' )
 	{
 		return true;
 	}else 
 	{
 		return false;
 	}
 }

 function PasarPorcaracteresSospechozos()
 {

 }