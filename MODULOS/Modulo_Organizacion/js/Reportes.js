$(document).ready(function() {
    
    $("#ReporteGeneralPostulaciones").click(function(){

      ReporteGeneral_Postulaciones();
    
    }); 
    

    $("#ResportePostuladosAceptados").click(function(){

      ReporteGeneral_PostulacionesAceptadas();
    
    });
    

});



function ReporteGeneral_Postulaciones(){


   

    //alert(fecha_i+"--"+fecha_f);
    
      
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/RecibeReporte.php",
        data: {


            Reporte_Postulados    : "Reporte_Postulados"

              },

        success: function(data){ 
            alert(data);
                var Variable = JSON.parse(data);
            //alert(Variable);
            if (Variable=='Reporte_Postulados'){
                window.open('../controlador/RecibeReporte.php');
            } 

    
    }
              

    });



}



function ReporteGeneral_PostulacionesAceptadas(){


      
   
    $.ajax({
        async:true, 
        cache:false,
        dataType:"html", 
        type: 'POST',   
        url: "../controlador/RecibeReporte.php",
        data: {


              PsotuladosAceptados    : "Reporte_Postulados"

              },

        success: function(data){ 
            alert(data);
                var Variable = JSON.parse(data);
            //alert(Variable);
            if (Variable=='Reporte_Postulados'){
                window.open('../controlador/RecibeReporte.php');
            } 

    
    }
              

    });



}