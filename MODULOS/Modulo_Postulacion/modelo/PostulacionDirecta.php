<?php


class Postulacion{ 


          function buscarOrganizaciones($codigo_estudiante)
          {
                  $sql = pg_query(" SELECT  organizacionmunicipio.observacion,  organizacion.nombre_organizacion , 

                    siglas, domicilio , nombre_municipio , nombre_estado, 

                    organizacion.id_organizacion ,nombre_tipo_organizacion , organizacionmunicipio.codigo_sucursal--,
                    
                      FROM pasantias.organizacion 
                
                INNER JOIN pasantias.convenio_organizacion 
                
                      ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
                
                INNER JOIN pasantias.organizacionmunicipio 
                
                      ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
                
                INNER JOIN pasantias.municipio 
                
                      ON municipio.id_municipio = organizacionmunicipio.id_municipio 
                
                INNER JOIN pasantias.estado 
                
                      ON estado .id_estado = municipio.id_estado 
                
                INNER JOIN pasantias.tipo_organizacion 
                
                      ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
                
                INNER JOIN pasantias.instituto_principal 
                
                      ON instituto_principal.id_ip = convenio_organizacion.id_ip
                
                INNER JOIN pasantias.persona_instituto_especialidad 
                
                      ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip
                
                INNER JOIN pasantias.estudiante 
                
                    ON estudiante.id_ip = persona_instituto_especialidad.id_ip 
                
                    AND estudiante.id_persona = persona_instituto_especialidad.id_persona
                
                    AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
                
                    AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil 

                    AND estudiante.codigo_estudiante='$codigo_estudiante'  

                  ORDER BY nombre_tipo_organizacion
                    ;");

          return $sql;
          }
          

          function buscarcodigo()
          {
             $sql= pg_query("SELECT CAST(MAX(codigo_solicitud) as int) + 1 as codigo , 1 as auxiliar FROM pasantias.solicitud ;");
             $var = pg_fetch_array($sql);
             if($var[0]==''){
              $var[0]=$var[1];
            }
             return $var[0];
          }

          function registrarPostulacion($array=array())
          {
            $codigo     = $this->buscarcodigo();
            $estudiante = $array['estudiante'];
            $sucursal   = $array['sucursal'];
            $temporada  = $array['temporada'];
            

            $insreSolicitud=pg_query("INSERT INTO pasantias.solicitud (codigo_solicitud ,codigo_temporada_especialidad,codigo_estudiante,fecha_solicitud,cantidad_postulantes,estatus)
             VALUES ('$codigo','$temporada','$estudiante',now(),'1','ACTIVO');");

            $insertenviadas =pg_query("INSERT INTO pasantias.solicitudes_enviadas (codigo_solicitud,table_column,valor ,estatus)
             VALUES ('$codigo','estudiante.codigo_estudiante','$estudiante','MOSTRAR');");
            
            $insertrecibudas =pg_query("INSERT INTO pasantias.solicitudes_recibidas (codigo_solicitud,table_column,valor ,estatus)
             VALUES ('$codigo','organizacionmunicipio.codigo_sucursal','$sucursal','EN ESPERA') ;");

            return pg_affected_rows($insreSolicitud);

          }


          function BuscarTemporadaspara($codigo_estudiante)
          {

            $sql = pg_query("SELECT persona.nombre ||'  '|| persona.apellido as encargado, 
            
            tipo_solicitud.nombre_tipo_solicitud, 
            
            periodo_solicitud.fecha_inicio ||' al '|| periodo_solicitud.fecha_fin as periodo ,
            
            lapso_academico.numero_lapso , temporadas_especialidad.codigo_temporada_especialidad
            
              FROM pasantias.temporadas_solicitud 
            
              INNER JOIN pasantias.temporadas_especialidad 
            
                    ON temporadas_solicitud.codigo_temporada = temporadas_especialidad.codigo_temporada
            
              INNER JOIN pasantias.temporadas_estudiantes 
            
                    ON temporadas_especialidad.codigo_temporada_especialidad=temporadas_estudiantes.codigo_temporada_especialidad
            
              INNER JOIN pasantias.estudiante 
            
                    ON estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante 
            
                    AND estudiante.codigo_estudiante='$codigo_estudiante'
            
              INNER JOIN pasantias.tipo_solicitud 
            
                    ON tipo_solicitud.id_tipo_solicitud = temporadas_solicitud.id_tipo_solicitud 
            
              INNER JOIN pasantias.periodo_solicitud 
            
                    On periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo
            
              INNER JOIN pasantias.lapso_academico 
            
                    ON lapso_academico.id_lapso = periodo_solicitud.id_lapso
            
              INNER JOIN pasantias.encargado 
            
                    ON encargado.codigo_encargado = temporadas_solicitud.codigo_encargado
            
              INNER JOIN pasantias.persona_organizacion_oficina 
            
                    ON encargado.id_persona = persona_organizacion_oficina.id_persona
            
                    AND  encargado.id_oficina = persona_organizacion_oficina.id_oficina
            
                    AND  encargado.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
            
                    AND  encargado.id_perfil = persona_organizacion_oficina.id_perfil
            
              INNER JOIN pasantias.persona 
            
                    ON persona.id_persona = persona_organizacion_oficina.id_persona;");

            return $sql;
          }


<<<<<<< HEAD
  ///------EDINSON--->>>>>
          function BuscarMis_Postulaciones($codigo_estudiante)
          {

            $sql = pg_query("SELECT persona.nombre ||'  '|| persona.apellido as encargado, 
            tipo_solicitud.nombre_tipo_solicitud, 
            periodo_solicitud.fecha_inicio ||' al '|| periodo_solicitud.fecha_fin as periodo ,
            lapso_academico.numero_lapso , temporadas_especialidad.codigo_temporada_especialidad,encargado_tipo_solicitud.descripcion
            FROM pasantias.temporadas_solicitud 
            INNER JOIN pasantias.temporadas_especialidad 
                    ON temporadas_solicitud.codigo_temporada = temporadas_especialidad.codigo_temporada
            INNER JOIN pasantias.temporadas_estudiantes 
                    ON temporadas_especialidad.codigo_temporada_especialidad=temporadas_estudiantes.codigo_temporada_especialidad
            INNER JOIN pasantias.estudiante 
                    ON estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante 
                    AND estudiante.codigo_estudiante='$codigo_estudiante'
            INNER JOIN pasantias.tipo_solicitud 
                    ON tipo_solicitud.id_tipo_solicitud = temporadas_solicitud.id_tipo_solicitud
            INNER JOIN pasantias.encargado_tipo_solicitud
                    ON encargado_tipo_solicitud.id_tipo_solicitud=tipo_solicitud.id_tipo_solicitud 
            INNER JOIN pasantias.periodo_solicitud 
                    ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo
            INNER JOIN pasantias.lapso_academico 
                    ON lapso_academico.id_lapso = periodo_solicitud.id_lapso
            INNER JOIN pasantias.encargado 
                    ON encargado.codigo_encargado = temporadas_solicitud.codigo_encargado 
            INNER JOIN pasantias.persona_organizacion_oficina 
                    ON encargado.id_persona = persona_organizacion_oficina.id_persona
                    AND  encargado.id_oficina = persona_organizacion_oficina.id_oficina
                    AND  encargado.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
                    AND  encargado.id_perfil = persona_organizacion_oficina.id_perfil
            INNER JOIN pasantias.persona 
                    ON persona.id_persona = persona_organizacion_oficina.id_persona");

            $data = array();

            while($reg=pg_fetch_array($sql)){
              $tutores            =$reg['descripcion'];
              $codTem_especialidad=$reg['codigo_temporada_especialidad'];
              if($tutores=='false'){

              $sql2=pg_query("SELECT temporadas_solicitud.codigo_temporada,temporadas_especialidad.codigo_temporada_especialidad , organizacionmunicipio.codigo_sucursal, organizacionmunicipio.observacion,  organizacion.nombre_organizacion, 
                              siglas, domicilio , nombre_municipio ||'-'|| nombre_estado AS ubicacion, 
                              organizacion.id_organizacion ,nombre_tipo_organizacion , tipo_solicitud.nombre_tipo_solicitud, solicitudes_recibidas.estatus, encargado_tipo_solicitud.descripcion
                              FROM pasantias.organizacion 
                              INNER JOIN pasantias.convenio_organizacion 
                                      ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
                              INNER JOIN pasantias.organizacionmunicipio 
                                      ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
                              INNER JOIN pasantias.municipio 
                                      ON municipio.id_municipio = organizacionmunicipio.id_municipio 
                              INNER JOIN pasantias.estado 
                                      ON estado .id_estado = municipio.id_estado 
                              INNER JOIN pasantias.tipo_organizacion 
                                      ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
                                
                              INNER JOIN pasantias.solicitudes_recibidas
                                      ON solicitudes_recibidas.valor=organizacionmunicipio.codigo_sucursal
                              INNER JOIN pasantias.solicitudes_enviadas
                                      ON solicitudes_enviadas.codigo_solicitud=solicitudes_recibidas.codigo_solicitud
                              INNER JOIN pasantias.solicitud
                                      ON solicitud.codigo_solicitud=solicitudes_enviadas.codigo_solicitud
                              INNER JOIN pasantias.temporadas_especialidad
                                      ON temporadas_especialidad.codigo_temporada_especialidad=solicitud.codigo_temporada_especialidad
                                      AND temporadas_especialidad.codigo_temporada_especialidad='$codTem_especialidad'
                              INNER JOIN pasantias.temporadas_solicitud
                                      ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
                              INNER JOIN pasantias.tipo_solicitud
                                      ON tipo_solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud
                              INNER JOIN pasantias.encargado_tipo_solicitud
                                      ON encargado_tipo_solicitud.id_tipo_solicitud=tipo_solicitud.id_tipo_solicitud
                                      AND encargado_tipo_solicitud.descripcion='$tutores'
   
                              INNER JOIN pasantias.instituto_principal 
                                      ON instituto_principal.id_ip = convenio_organizacion.id_ip
                              INNER JOIN pasantias.persona_instituto_especialidad 
                                      ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip
                              INNER JOIN pasantias.estudiante 
                                      ON estudiante.id_ip = persona_instituto_especialidad.id_ip 
                                      AND estudiante.id_persona = persona_instituto_especialidad.id_persona
                                      AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
                                      AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil
                                      AND estudiante.codigo_estudiante='$codigo_estudiante'
                              ORDER BY nombre_tipo_organizacion");

                          
                          while ($fila = pg_fetch_assoc($sql2))
                          { 
                            
                            $data[]=$fila;
                          }

                          
              
            //---FIN DEL IF
            }else{

                      $sql3=$this->BuscarMisPostulaciones_tutor($tutores, $codTem_especialidad, $codigo_estudiante);
                      if((pg_num_rows($sql3))==0){

                          $sql3=$this->BuscarMisPostulacione_TutoEspera($tutores, $codTem_especialidad, $codigo_estudiante);

                      }
                      while ($fila = pg_fetch_assoc($sql3))
                          { 
                            
                            $data[]=$fila;
                          }
            }
            }//---FIN DEL WHILE

                          return $data ;




            
          }//fin class



function BuscarMisPostulaciones_tutor($tutores, $codTem_especialidad, $codigo_estudiante){


            $sql2 = pg_query("SELECT temporadas_solicitud.codigo_temporada,temporadas_especialidad.codigo_temporada_especialidad , organizacionmunicipio.codigo_sucursal, organizacionmunicipio.observacion,  organizacion.nombre_organizacion, 
                      siglas, domicilio , nombre_municipio ||'-'|| nombre_estado AS ubicacion, 
                      organizacion.id_organizacion ,nombre_tipo_organizacion , tipo_solicitud.nombre_tipo_solicitud, responsables.estatus, encargado_tipo_solicitud.descripcion
                      FROM pasantias.organizacion 
                      INNER JOIN pasantias.convenio_organizacion 
                              ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
                      INNER JOIN pasantias.organizacionmunicipio 
                              ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
                      INNER JOIN pasantias.municipio 
                              ON municipio.id_municipio = organizacionmunicipio.id_municipio 
                      INNER JOIN pasantias.estado 
                              ON estado .id_estado = municipio.id_estado 
                      INNER JOIN pasantias.tipo_organizacion 
                              ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
                        
                      INNER JOIN pasantias.solicitudes_recibidas
                              ON solicitudes_recibidas.valor=organizacionmunicipio.codigo_sucursal
                      INNER JOIN pasantias.solicitudes_enviadas
                              ON solicitudes_enviadas.codigo_solicitud=solicitudes_recibidas.codigo_solicitud
                      INNER JOIN pasantias.solicitud
                              ON solicitud.codigo_solicitud=solicitudes_enviadas.codigo_solicitud

                      INNER JOIN pasantias.solicitudes_aprobadas
                              ON solicitudes_aprobadas.codigo_solicitud=solicitud.codigo_solicitud
                      INNER JOIN pasantias.responsables
                              ON responsables.codigo_solicitud=solicitudes_aprobadas.codigo_solicitud
                             AND responsables.table_column='tutor_empresarial.codigo_tutor_empresarial'

                                                          
                      INNER JOIN pasantias.temporadas_especialidad
                              ON temporadas_especialidad.codigo_temporada_especialidad=solicitud.codigo_temporada_especialidad
                              AND temporadas_especialidad.codigo_temporada_especialidad='$codTem_especialidad'
                      INNER JOIN pasantias.temporadas_solicitud
                              ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
                      INNER JOIN pasantias.tipo_solicitud
                              ON tipo_solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud
                      INNER JOIN pasantias.encargado_tipo_solicitud
                              ON encargado_tipo_solicitud.id_tipo_solicitud=tipo_solicitud.id_tipo_solicitud
                              AND encargado_tipo_solicitud.descripcion='$tutores'

                      INNER JOIN pasantias.instituto_principal 
                              ON instituto_principal.id_ip = convenio_organizacion.id_ip
                      INNER JOIN pasantias.persona_instituto_especialidad 
                              ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip
                      INNER JOIN pasantias.estudiante 
                              ON estudiante.id_ip = persona_instituto_especialidad.id_ip 
                              AND estudiante.id_persona = persona_instituto_especialidad.id_persona
                              AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
                              AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil
                              AND estudiante.codigo_estudiante='$codigo_estudiante'
                      ORDER BY nombre_tipo_organizacion");
                            
              return $sql2;

                            

}


  function BuscarMisPostulacione_TutoEspera($tutores, $codTem_especialidad, $codigo_estudiante){

          $sql=pg_query("SELECT temporadas_solicitud.codigo_temporada,temporadas_especialidad.codigo_temporada_especialidad , organizacionmunicipio.codigo_sucursal, organizacionmunicipio.observacion,  organizacion.nombre_organizacion, 
                  siglas, domicilio , nombre_municipio ||'-'|| nombre_estado AS ubicacion, 
                  organizacion.id_organizacion ,nombre_tipo_organizacion ,  tipo_solicitud.nombre_tipo_solicitud, solicitudes_recibidas.estatus, encargado_tipo_solicitud.descripcion
                  FROM pasantias.organizacion 
                  INNER JOIN pasantias.convenio_organizacion 
                          ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
                  INNER JOIN pasantias.organizacionmunicipio 
                          ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
                  INNER JOIN pasantias.municipio 
                          ON municipio.id_municipio = organizacionmunicipio.id_municipio 
                  INNER JOIN pasantias.estado 
                          ON estado .id_estado = municipio.id_estado 
                  INNER JOIN pasantias.tipo_organizacion 
                          ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
                    
                  INNER JOIN pasantias.solicitudes_recibidas
                          ON solicitudes_recibidas.valor=organizacionmunicipio.codigo_sucursal
                  INNER JOIN pasantias.solicitudes_enviadas
                          ON solicitudes_enviadas.codigo_solicitud=solicitudes_recibidas.codigo_solicitud
                  INNER JOIN pasantias.solicitud
                          ON solicitud.codigo_solicitud=solicitudes_enviadas.codigo_solicitud
                  INNER JOIN pasantias.temporadas_especialidad
                          ON temporadas_especialidad.codigo_temporada_especialidad=solicitud.codigo_temporada_especialidad
                          AND temporadas_especialidad.codigo_temporada_especialidad='$codTem_especialidad'
                  INNER JOIN pasantias.temporadas_solicitud
                          ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
                  INNER JOIN pasantias.tipo_solicitud
                          ON tipo_solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud
                  INNER JOIN pasantias.encargado_tipo_solicitud
                          ON encargado_tipo_solicitud.id_tipo_solicitud=tipo_solicitud.id_tipo_solicitud
                          AND encargado_tipo_solicitud.descripcion='$tutores'

                  INNER JOIN pasantias.instituto_principal 
                          ON instituto_principal.id_ip = convenio_organizacion.id_ip
                  INNER JOIN pasantias.persona_instituto_especialidad 
                          ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip
                  INNER JOIN pasantias.estudiante 
                          ON estudiante.id_ip = persona_instituto_especialidad.id_ip 
                          AND estudiante.id_persona = persona_instituto_especialidad.id_persona
                          AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
                          AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil
                          AND estudiante.codigo_estudiante='$codigo_estudiante'
                  ORDER BY nombre_tipo_organizacion");

          return $sql;


  }


          function CargarInfo_MiSolicitud($vista=array()){

            $codigo_sucursal                =$vista['codigo_sucursal'];
            $codigo_temporada_especialidad  =$vista['codigo_temporada_especialidad'];
            $codigo_estudiante              =$vista['codigo_estudiante'];
            $codigo_temporada               =$vista['codigo_temporada'];

            $sql=pg_query("SELECT persona.nombre ||' '|| persona.apellido as encargado, tipo_solicitud.nombre_tipo_solicitud ,

            to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo,

            lapso_academico.numero_lapso ||' :: '||

            to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY')

            as lapsoacademico , temporadas_solicitud.estatus , encargado_tipo_solicitud.descripcion ,

            case WHEN (current_date > periodo_solicitud.fecha_fin) OR (current_date < periodo_solicitud.fecha_inicio) then 'warning'

            WHEN (current_date BETWEEN periodo_solicitud.fecha_inicio AND periodo_solicitud.fecha_fin) then 'success' END as colore ,

            CASE WHEN (current_date > periodo_solicitud.fecha_fin)    

            THEN
        REPLACE(
          REPLACE(
            REPLACE(
              REPLACE(
                REPLACE(
                  REPLACE(
                  
                    age(current_date , periodo_solicitud.fecha_fin) ::TEXT,
                    
                  'years','AÑOS'),
                'year','AÑO'),
              'mons','MESES'),
            'mon','MES'),
           'days','DIAS'),
        'day','DIA') || '<strong> ¡ Posterior al PERIODO !</strong>'

            WHEN (current_date < periodo_solicitud.fecha_inicio) THEN
        REPLACE(
          REPLACE(
            REPLACE(
              REPLACE(
                REPLACE(
                  REPLACE(
                  
                    age(periodo_solicitud.fecha_inicio , current_date) ::TEXT,
                    
                  'years','AÑOS'),
                'year','AÑO'),
              'mons','MESES'),
            'mon','MES'),
           'days','DIAS'),
        'day','DIA') || '<strong> ¡ Anterior al PERIODO !</strong>'

            WHEN (current_date BETWEEN  periodo_solicitud.fecha_inicio AND periodo_solicitud.fecha_fin) THEN
        REPLACE(
          REPLACE(
            REPLACE(
              REPLACE(
                REPLACE(
                  REPLACE(

                    age( current_date , periodo_solicitud.fecha_inicio) ::TEXT,

                  'years','AÑOS'),
                'year','AÑO'),
              'mons','MESES'),
            'mon','MES'),
           'days','DIAS'),
        'day','DIA')  || '<strong> ¡ De haber Iniciado La Temporada !</strong> Y ' ||

        REPLACE(
          REPLACE(
            REPLACE(
              REPLACE(
                REPLACE(
                  REPLACE(
                  
                    age( periodo_solicitud.fecha_fin , current_date) ::TEXT ,
                    
                  'years','AÑOS'),
                'year','AÑO'),
              'mons','MESES'),
            'mon','MES'),
           'days','DIAS'),
        'day','DIA')      || '<strong> ¡ Para Finalizar La Temporada !</strong>'
        END as calculo_tiempo ,

            to_char(current_date, 'DD, TMMonth YYYY') as very_now ,
            
          '<label class=text-success>' ||
          
            REPLACE(
              REPLACE(
                REPLACE(
                  REPLACE(
                    REPLACE(
                      REPLACE(
                      
                        age(periodo_solicitud.fecha_fin , periodo_solicitud.fecha_inicio) ::TEXT,
                        
                      'years','Años'),
                    'year','Año'),
                  'mons','Meses'),
                'mon','Mes'),
               'days','Dias'),
            'day','Dia')  || '</label>' as CalculodePeriodo
            
          FROM pasantias.temporadas_solicitud 
          JOIN pasantias.encargado
              ON  temporadas_solicitud.codigo_encargado = encargado.codigo_encargado
          JOIN pasantias.persona_organizacion_oficina
              ON  persona_organizacion_oficina.id_persona = encargado.id_persona
              AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
              AND persona_organizacion_oficina.id_perfil = encargado.id_perfil
              AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal
          JOIN pasantias.persona
              ON persona.id_persona  = persona_organizacion_oficina.id_persona
          JOIN pasantias.tipo_solicitud
              ON temporadas_solicitud.id_tipo_solicitud= tipo_solicitud.id_tipo_solicitud
          JOIN pasantias.periodo_solicitud
              ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo
          JOIN pasantias.lapso_academico
              ON lapso_academico.id_lapso  = periodo_solicitud.id_lapso
          JOIN pasantias.encargado_tipo_solicitud
              On encargado_tipo_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud
          WHERE temporadas_solicitud.codigo_temporada='$codigo_temporada'");
          

        $list=pg_fetch_assoc($sql);

          

        return $list;

          }




          /////////////////


=======
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
          function cargarorganizacinesEncargado( $combo =array())
          { 
            $id_ip = $combo['id_ip'];

            $sql = pg_query("SELECT organizacionmunicipio.observacion,  organizacion.nombre_organizacion ,

             siglas, domicilio , nombre_municipio , nombre_estado,

             organizacion.id_organizacion ,nombre_tipo_organizacion , organizacionmunicipio.codigo_sucursal 
              
              FROM pasantias.organizacion 
                
                INNER JOIN pasantias.convenio_organizacion 

                      ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
                
                INNER JOIN pasantias.organizacionmunicipio 

                      ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
                
                INNER JOIN pasantias.municipio 

                      ON municipio.id_municipio = organizacionmunicipio.id_municipio 
                
                INNER JOIN pasantias.estado 

                      ON estado .id_estado = municipio.id_estado 
                
                INNER JOIN pasantias.tipo_organizacion 

                      ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
                
                INNER JOIN pasantias.instituto_principal 

                      ON instituto_principal.id_ip = convenio_organizacion.id_ip
                
                AND convenio_organizacion.id_ip = '$id_ip' 
                
                ORDER BY nombre_tipo_organizacion;");

            return $sql;
          }

          function ContarSegunTipoOrganizacion( $id_ip ) 
          {

            $sql = pg_query("SELECT  nombre_tipo_organizacion, COUNT(organizacionmunicipio.codigo_sucursal ) as cantidad ,
                
                CASE  WHEN COUNT(organizacionmunicipio.codigo_sucursal ) =0 then 'No Aplica' 
                
                WHEN COUNT(organizacionmunicipio.codigo_sucursal ) >1 then 'Esperando Organización...' END as ANSWER 
                
                FROM pasantias.organizacion 
                
                INNER JOIN pasantias.convenio_organizacion 
                
                      ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
                
                INNER JOIN pasantias.organizacionmunicipio 
                
                      ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
                
                INNER JOIN pasantias.municipio 
                
                      ON municipio.id_municipio = organizacionmunicipio.id_municipio 
                
                INNER JOIN pasantias.estado 
                
                      ON estado .id_estado = municipio.id_estado 
                
                INNER JOIN pasantias.tipo_organizacion 
                
                      ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
                
                INNER JOIN pasantias.instituto_principal 

                      ON instituto_principal.id_ip = convenio_organizacion.id_ip
                
                      AND convenio_organizacion.id_ip = '$id_ip'

                GROUP BY nombre_tipo_organizacion  ORDER BY nombre_tipo_organizacion ;");
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
