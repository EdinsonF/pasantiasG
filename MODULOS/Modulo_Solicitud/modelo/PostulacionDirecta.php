<?php


class Postulacion{ 


              function cargarorganizacinesEncargado( $combo =array())
          { 
            $id_ip = $combo['id_ip'];

            $sql = pg_query("SELECT organizacionmunicipio.observacion,  organizacion.nombre_organizacion , siglas, domicilio , nombre_municipio , nombre_estado
                    ,organizacion.id_organizacion ,nombre_tipo_organizacion , organizacionmunicipio.codigo_sucursal, 
                    pasantias.persona_organizacion_oficina.id_persona, nombre || ' ' || apellido as datos_encargado
                      FROM pasantias.organizacion 
                INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
                INNER JOIN pasantias.organizacionmunicipio ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 

                INNER JOIN pasantias.persona_organizacion_oficina ON persona_organizacion_oficina.serial=(SELECT MAX(serial) FROM pasantias.persona_organizacion_oficina where persona_organizacion_oficina.codigo_sucursal=organizacionmunicipio.codigo_sucursal)
    INNER JOIN pasantias.persona ON persona.id_persona=pasantias.persona_organizacion_oficina.id_persona
                INNER JOIN pasantias.municipio ON municipio.id_municipio = organizacionmunicipio.id_municipio 
                INNER JOIN pasantias.estado ON estado .id_estado = municipio.id_estado 
                INNER JOIN pasantias.tipo_organizacion ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
                INNER JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip
                AND convenio_organizacion.id_ip = '$id_ip' 
                
                ORDER BY nombre_tipo_organizacion;");

            return $sql;
          }

          function ContarSegunTipoOrganizacion( $id_ip ) 
          {

            $sql = pg_query("SELECT  nombre_tipo_organizacion, COUNT(organizacionmunicipio.codigo_sucursal ) as cantidad ,
                CASE  WHEN COUNT(organizacionmunicipio.codigo_sucursal ) =0 then 'No Aplica' 
                
                WHEN COUNT(organizacionmunicipio.codigo_sucursal ) >1 then 'Esperando Organzación...' END as ANSWER 
                
                FROM pasantias.organizacion 
                INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
                INNER JOIN pasantias.organizacionmunicipio ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion
                INNER JOIN pasantias.persona_organizacion_oficina ON persona_organizacion_oficina.serial=(SELECT MAX(serial) FROM pasantias.persona_organizacion_oficina where persona_organizacion_oficina.codigo_sucursal=organizacionmunicipio.codigo_sucursal)
                INNER JOIN pasantias.municipio ON municipio.id_municipio = organizacionmunicipio.id_municipio 
                INNER JOIN pasantias.estado ON estado .id_estado = municipio.id_estado 
                INNER JOIN pasantias.tipo_organizacion ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
                INNER JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip
                AND convenio_organizacion.id_ip = '$id_ip' GROUP BY nombre_tipo_organizacion  ORDER BY nombre_tipo_organizacion ;");
            return $sql;
          }

          function DetallesResumidoOrganizacionAsociada( $nombre_tipo_organizacion , $id_ip )
          {
            $sql = pg_query("SELECT    organizacion.nombre_organizacion
              FROM pasantias.organizacionmunicipio 
              INNER JOIN pasantias.organizacion 
                ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
              INNER JOIN pasantias.convenio_organizacion
                ON convenio_organizacion.id_organizacion = organizacion.id_organizacion
                AND convenio_organizacion.id_ip =$id_ip 
              INNER JOIN pasantias.organizacion_oficina 
                ON organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
              INNER JOIN pasantias.oficina 
                ON oficina.id_oficina = organizacion_oficina.id_oficina 
              INNER JOIN pasantias.tipo_organizacion 
                ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
              AND tipo_organizacion.nombre_tipo_organizacion = '$nombre_tipo_organizacion' GROUP BY nombre_organizacion ;");


            return $sql;
          }






}








?>