 
// - Esta es la funcion que coloco en el evento onclick del td -

function seleccionarfila(tr){
    
                /*   $("tr .sigla ").each(function(index){
                    
                    $("#titlee").html($(tr).text());
 
                }); ME TRAE  TODA  LA  FILA SELECCIONADA DE LA TABLA */
  
                var Siglas = "";
                var idOrganizacion = $(".id_organizacion",tr).html();
  
                  Siglas = $(tr).find("td").eq(0).html();
         
            
          $("#titlee").html(Siglas); // IMPRIMIR en la  etiqueta P // IMPRIMIR en la  etiqueta P

          $("#superidOrganizacion").val(idOrganizacion); //IMPRIMIR  EN EL CAMPO OCULTO
          
    // $("#superidOrganizacion").val();


    //var sigla= $("td .sigla").text(); // -------- TODAS  LAS  COLUMNAS
    //$("#titlee").html(sigla);
    

    // El Codigo Malandro Super Tukki ..!
    // Gracias stackoverflow ...

    $('#tabla_Instituto').modal('hide');

} 

function seleccionarPrincipal(tr){
    
    NombreOrganizacion = $(tr).find("td").eq(0).html();
    codigoSucursal     = $(tr).find("td").eq(5).text();

    $("#superidOrganizacion").val(codigoSucursal); //IMPRIMIR  EN EL CAMPO OCULTO
    $("#titlee").html(NombreOrganizacion);
    $('#tabla').modal('hide');

} 
