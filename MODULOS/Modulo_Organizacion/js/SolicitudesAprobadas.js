

llenarTabla();
function llenarTabla()
{

                $.ajax({
                async:true, 
                cache:false,
                type: "POST",
                url: "../controlador/recibePostulacionOrganizacion.php",
                dataType: "html",
                data: {
                  
                  BuscarSolicitudesAprobadasPorOrganizacion : $("#encargado").val()
                },
                success: function (data) {
                    
                        alert(data);
                    var Variable = JSON.parse(data);
                    var html='';
                      $.each(Variable, function(index, value){

                        html +="<tr  >"+
                      
                        "<td><center>"+value['nombre_organizacion']+"</center></td>"+
                      
                        "<td><center>"+value['fecha_solicitud']+"</center></td>"+
                      
                        "<td><center>"+value['cantidad_postulantes']+"</center></td>"+
                      
                        "<td><center>"+value['responsable']+"</center></td>"+
                      
                        "<td><center>"+value['area']+"</center></td>"+
                      
                        "<td ><center><img src=../../../img/Ico-master/PNG/64px/0135-search.png width=20 ></center></td>"+
                      
                        "<td ><center><img src=../../../img/Ico-master/PNG/64px/0207-eye.png width=20 ></center></td>"+
                      
                        "<td style=display:none><center>"+value['codigo_solicitud']+"</center></td>"+
                      
                        "</tr>";
                      });
                      //armartablaTEmporada(html);
                     
                }
            });
}