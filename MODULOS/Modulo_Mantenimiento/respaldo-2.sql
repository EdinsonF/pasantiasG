DROP SCHEMA IF EXISTS pasantias CASCADE;
CREATE SCHEMA pasantias
  			AUTHORIZATION postgres; 
  			GRANT ALL ON SCHEMA pasantias TO postgres;
--
-- Estrutura de la tabla 'pasantias.curriculum_formacion_academica'
--

CREATE TABLE pasantias.curriculum_formacion_academica (
id_formacion bigint NOT NULL,
id_curriculum bigint NOT NULL,
ano_egreso character varying NOT NULL,
nombre_instituto character varying NOT NULL,
observacion character varying NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.curriculum_formacion_academica'
--

INSERT INTO  pasantias.curriculum_formacion_academica (id_formacion,id_curriculum,ano_egreso,nombre_instituto,observacion,estatus)  VALUES ('8','8','2015-10-01/2015-11-06','IUTY','Programador','ACTIVO');

--
CREATE SEQUENCE pasantias.curriculum_formacion_academica_id_formacion_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	18
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.curriculum_formacion_academica ALTER COLUMN id_formacion SET DEFAULT nextval('pasantias.curriculum_formacion_academica_id_formacion_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.departamento'
--

CREATE TABLE pasantias.departamento (
id_departamento bigint NOT NULL,
estado character varying NOT NULL,
descripcion character varying  NULL
);

--
-- Informacion de la tabla 'pasantias.departamento'
--

INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('35','INACTIVO','Persona encargada de Pasantias');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('36','INACTIVO','Persona contacto de Organización');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('37','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('38','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('39','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('40','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('41','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('42','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('43','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('44','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('45','ACTIVO','NO DESCRIPCION');
INSERT INTO  pasantias.departamento (id_departamento,estado,descripcion)  VALUES ('46','ACTIVO','NO DESCRIPCION');

--
CREATE SEQUENCE pasantias.departamento_id_departamento_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	47
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.departamento ALTER COLUMN id_departamento SET DEFAULT nextval('pasantias.departamento_id_departamento_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.encargado'
--

CREATE TABLE pasantias.encargado (
codigo_encargado character varying NOT NULL DEFAULT 'nothing'::character varying,
codigo_sucursal character varying NOT NULL,
id_persona bigint NOT NULL,
id_oficina bigint NOT NULL,
id_perfil integer NOT NULL
);

--
-- Informacion de la tabla 'pasantias.encargado'
--

INSERT INTO  pasantias.encargado (codigo_encargado,codigo_sucursal,id_persona,id_oficina,id_perfil)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO - 108 - 22 - 6','308 - 1 - CALLE 32 FRENTE A FARMATODO','108','22','6');
INSERT INTO  pasantias.encargado (codigo_encargado,codigo_sucursal,id_persona,id_oficina,id_perfil)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO - 110 - 22 - 6','308 - 1 - CALLE 32 FRENTE A FARMATODO','110','22','6');
INSERT INTO  pasantias.encargado (codigo_encargado,codigo_sucursal,id_persona,id_oficina,id_perfil)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO - 114 - 22 - 6','308 - 1 - CALLE 32 FRENTE A FARMATODO','114','22','6');
INSERT INTO  pasantias.encargado (codigo_encargado,codigo_sucursal,id_persona,id_oficina,id_perfil)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','308 - 1 - CALLE 32 FRENTE A FARMATODO','87','22','6');


--
-- Estrutura de la tabla 'pasantias.curriculum_experiencia_laboral'
--

CREATE TABLE pasantias.curriculum_experiencia_laboral (
id_experiencia bigint NOT NULL,
id_curriculum bigint NOT NULL,
duracion character varying NOT NULL,
cargo character varying NOT NULL,
nombre_empresa character varying NOT NULL,
funcion character varying NOT NULL,
observacion character varying NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.curriculum_experiencia_laboral'
--

INSERT INTO  pasantias.curriculum_experiencia_laboral (id_experiencia,id_curriculum,duracion,cargo,nombre_empresa,funcion,observacion,estatus)  VALUES ('7','8','2015-10-01/2015-10-16','programador ','DASSA','Base de datos','NO OBSERVACION','ACTIVO');

--
CREATE SEQUENCE pasantias.curriculum_experiencia_laboral_id_experiencia_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	14
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.curriculum_experiencia_laboral ALTER COLUMN id_experiencia SET DEFAULT nextval('pasantias.curriculum_experiencia_laboral_id_experiencia_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.lapso_academico'
--

CREATE TABLE pasantias.lapso_academico (
id_lapso bigint NOT NULL,
ano_i date NOT NULL,
ano_f date NOT NULL,
estatus character varying NOT NULL,
numero_lapso character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.lapso_academico'
--

INSERT INTO  pasantias.lapso_academico (id_lapso,ano_i,ano_f,estatus,numero_lapso)  VALUES ('6','2015-01-14','2015-12-24','ACTIVO','2015-2');
INSERT INTO  pasantias.lapso_academico (id_lapso,ano_i,ano_f,estatus,numero_lapso)  VALUES ('7','2015-12-01','2015-12-31','ACTIVO','2015-0');
INSERT INTO  pasantias.lapso_academico (id_lapso,ano_i,ano_f,estatus,numero_lapso)  VALUES ('40','2016-01-01','2016-01-31','ACTIVO','2016-0');

--
CREATE SEQUENCE pasantias.lapso_academico_id_lapso_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	41
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.lapso_academico ALTER COLUMN id_lapso SET DEFAULT nextval('pasantias.lapso_academico_id_lapso_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.estado'
--

CREATE TABLE pasantias.estado (
id_estado bigint NOT NULL,
nombre_estado character varying NOT NULL,
codigo character varying  NULL
);

--
-- Informacion de la tabla 'pasantias.estado'
--

INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('1','AMAZONAS','144');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('2','ANZOATEGUI','146');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('3','APURE','145');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('4','ARAGUA','123');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('5','BARINAS','143');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('6','BOLIVAR','142');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('7','CARABOBO','141');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('8','COJEDES','140');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('9','DELTA AMACURO','139');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('10','FALCÓN','138');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('11','GUARICO','137');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('12','LARA','136');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('13','MERIDA','135');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('14','MIRANDA','134');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('15','MONAGAS','133');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('16','NUEVA ESPARTA','132');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('17','PORTUGUESA','131');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('18','SUCRE','130');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('19','TACHIRA','129');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('20','TRUJILLO','128');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('21','VARGAS','127');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('22','YARACUY','126');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('23','ZULIA','125');
INSERT INTO  pasantias.estado (id_estado,nombre_estado,codigo)  VALUES ('24','DEPENDENCIA FEDERAL','124');

--
CREATE SEQUENCE pasantias.estado_id_estado_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	25
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.estado ALTER COLUMN id_estado SET DEFAULT nextval('pasantias.estado_id_estado_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.entregable'
--

CREATE TABLE pasantias.entregable (
nombre_entregable character varying NOT NULL,
fecha_registro date NOT NULL,
id_entregable bigint NOT NULL
);

--
-- Informacion de la tabla 'pasantias.entregable'
--

INSERT INTO  pasantias.entregable (nombre_entregable,fecha_registro,id_entregable)  VALUES ('CD PROYECTO','2015-11-14','32');
INSERT INTO  pasantias.entregable (nombre_entregable,fecha_registro,id_entregable)  VALUES ('INFORME','2015-10-27','29');
INSERT INTO  pasantias.entregable (nombre_entregable,fecha_registro,id_entregable)  VALUES ('NOTAS ACADEMICAS','2015-10-27','30');
INSERT INTO  pasantias.entregable (nombre_entregable,fecha_registro,id_entregable)  VALUES ('NOTAS ACADÉMICAS','2015-12-08','33');
INSERT INTO  pasantias.entregable (nombre_entregable,fecha_registro,id_entregable)  VALUES ('NOTAS EMPRESARIALES','2015-10-27','31');

--
CREATE SEQUENCE pasantias.entregable_id_entregable_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	34
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.entregable ALTER COLUMN id_entregable SET DEFAULT nextval('pasantias.entregable_id_entregable_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.estudiantes_entregables'
--

CREATE TABLE pasantias.estudiantes_entregables (
id_estudiantes_entregables bigint NOT NULL,
codigo_temporada_especialidad character varying NOT NULL,
codigo_estudiante character varying NOT NULL,
id_entregable bigint NOT NULL,
fecha_entrega date NOT NULL
);

--
-- Informacion de la tabla 'pasantias.estudiantes_entregables'
--


--
CREATE SEQUENCE pasantias.estudiantes_entregables_id_estudiantes_entregables_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	1
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.estudiantes_entregables ALTER COLUMN id_estudiantes_entregables SET DEFAULT nextval('pasantias.estudiantes_entregables_id_estudiantes_entregables_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.instituto_principal'
--

CREATE TABLE pasantias.instituto_principal (
id_ip bigint NOT NULL,
id_organizacion bigint NOT NULL,
estatus character varying NOT NULL,
fecha_r date NOT NULL
);

--
-- Informacion de la tabla 'pasantias.instituto_principal'
--

INSERT INTO  pasantias.instituto_principal (id_ip,id_organizacion,estatus,fecha_r)  VALUES ('1','1','ACTIVO','2015-10-27');

--
CREATE SEQUENCE pasantias.instituto_principal_id_ip_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	2
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.instituto_principal ALTER COLUMN id_ip SET DEFAULT nextval('pasantias.instituto_principal_id_ip_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.especialidad_instituto_principal'
--

CREATE TABLE pasantias.especialidad_instituto_principal (
id_ip bigint NOT NULL,
id_especialidad bigint NOT NULL,
estatus character varying NOT NULL,
observacion character varying  NULL DEFAULT 'NO OBSERVACION'::character varying,
descripcion character varying  NULL DEFAULT 'No Descripcion'::character varying
);

--
-- Informacion de la tabla 'pasantias.especialidad_instituto_principal'
--

INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion,descripcion)  VALUES ('1','26','MODIFICADO','NO OBSERVACION','COMPUTACION');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion,descripcion)  VALUES ('1','27','ACTIVO','NO OBSERVACION','CONTABILIDAD');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion,descripcion)  VALUES ('1','28','ACTIVO','NO OBSERVACION','ALIMENTO');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion,descripcion)  VALUES ('1','29','ACTIVO','NO OBSERVACION','ENFERMERAS');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion,descripcion)  VALUES ('1','30','ACTIVO','NO OBSERVACION','NINGUNA');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion)  VALUES ('1','31','ACTIVO','NO OBSERVACION');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion,descripcion)  VALUES ('1','32','MODIFICADO','NO OBSERVACION','COMPUTACION');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion,descripcion)  VALUES ('1','33','ACTIVO','NO OBSERVACION','COMPUTACION');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion,descripcion)  VALUES ('1','34','ACTIVO','NO OBSERVACION','CASI TERMINANDO EL TRABAJO');
INSERT INTO  pasantias.especialidad_instituto_principal (id_ip,id_especialidad,estatus,observacion)  VALUES ('1','35','ACTIVO','NO OBSERVACION');


--
-- Estrutura de la tabla 'pasantias.funcion'
--

CREATE TABLE pasantias.funcion (
id_funcion integer NOT NULL,
ruta_funcion character varying NOT NULL,
nombre_funcion character varying NOT NULL,
id_perfil integer NOT NULL
);

--
-- Informacion de la tabla 'pasantias.funcion'
--

INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('1','../../Index/vista/index_principal.php','Inicio','1');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('2','#','Gestión de Usuarios','1');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('3','#','Sitios de Interes','1');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('4','../../Modulo_Usuario/vista/inicio_sesion.php','Iniciar Sesión','1');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('5','../../Index/vista/index_empresa.php','Inicio','2');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('6','#','Administrar','2');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('7','#','Gestionar','2');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('9','../../Index/vista/index_estudiante.php','Inicio','3');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('10','#','Gestionar','3');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('12','../../Index/vista/index_tutor_academico.php','Inicio','4');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('13','#','Gestionar','4');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('15','../../Index/vista/index_tutor_empresarial.php','Inicio','5');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('16','#','Gestionar','5');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('18','../../Index/vista/index_administrador.php','Inicio','6');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('19','#','Administrar','6');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('20','#','Gestionar','6');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('21','#','Configurar','6');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('22','#','Mantenimiento','6');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('24','#','Solicitud','1');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('25','#','Listado de Solicitudes','3');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('26','../../Modulo_Tutor_Academico/vista/CatalagoTutorAcademico.phtml','Ver Tutores','6');
INSERT INTO  pasantias.funcion (id_funcion,ruta_funcion,nombre_funcion,id_perfil)  VALUES ('27','../../Modulo_Tutor_Empresarial/vista/CatalagoTutorEmpresarial.phtml','Ver Tutores','2');

--
CREATE SEQUENCE pasantias.funcion_id_funcion_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	28
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.funcion ALTER COLUMN id_funcion SET DEFAULT nextval('pasantias.funcion_id_funcion_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.especialidad'
--

CREATE TABLE pasantias.especialidad (
id_departamento bigint NOT NULL,
id_especialidad bigint NOT NULL,
id_tipo_especialidad bigint NOT NULL,
nombre_especialidad character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.especialidad'
--

INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('37','26','1','INFORMATICA III');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('38','27','1','ADMINISTRACION');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('39','28','1','AGROALIMENTACION');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('40','29','1','ENFERMERIA');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('41','30','1','FONOAUDIOLOGIA');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('42','31','1','HIGIENE Y SEGURIDAD I');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('43','32','1','INFORMATICA IIII');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('44','33','1','INFORMATICA');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('45','34','2','ALIMENTOS');
INSERT INTO  pasantias.especialidad (id_departamento,id_especialidad,id_tipo_especialidad,nombre_especialidad)  VALUES ('46','35','2','INFORMATICA');

--
CREATE SEQUENCE pasantias.especialidad_id_especialidad_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	36
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.especialidad ALTER COLUMN id_especialidad SET DEFAULT nextval('pasantias.especialidad_id_especialidad_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.municipio'
--

CREATE TABLE pasantias.municipio (
id_municipio bigint NOT NULL,
id_estado bigint NOT NULL,
nombre_municipio character varying NOT NULL,
codigo character varying  NULL
);

--
-- Informacion de la tabla 'pasantias.municipio'
--

INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('1','1','ALTO ORINOCO','0159');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('2','1','ATABAPO','1230');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('3','1','ATURES','0101');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('4','1','AUTANA','0102');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('5','1','MANAPIARE','0012');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('6','1','MAROA','0103');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('7','1','RIO NEGRO','0105');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('8','2','ANACO','0106');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('9','2','ARAGUA','0108');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('10','2','DIEGO BAUTISTA URBANEJA','0109');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('11','2','FERNANDO DE PEÑALVER','0110');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('12','2','FRANCISCO DE CARMEN CARVAJAL','0111');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('13','2','FRANCISCO DE MIRANDA','0003');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('14','2','GUANTA','0001');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('15','2','INDEPENDENCIA','0002');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('16','2','JOSE GREGORIO MONAGAS','0005');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('17','2','JUAN ANTONIO SOTILLO','1017');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('18','2','JUAN MANUEL CAJIGAL','0004');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('19','2','LIBERTAD','1019');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('20','2','MANUEL EZEQUIEL BRUZUAL','1020');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('21','2','PEDRO MARIA FREITES','1021');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('22','2','PIRITU','1023');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('23','2','SAN JOSE DE GUANIPA','1024');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('24','2','SAN JUAN DE CAPISTRANO','1025');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('25','2','SANTA ANA','1026');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('26','2','SIMON BOLIVAR','1028');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('27','2','SIMON RODRIGUEZ','1019');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('28','2','SIR ARTUR MCGREGOR','1029');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('29','3','ACHAGUAS','1030');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('30','3','BIRUACA','1015');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('31','3','MUÑOZ','1052');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('32','3','PAEZ','0005');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('33','3','PEDRO CAMEJO','0006');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('34','3','ROMULO GALLEGOS','0006');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('35','3','SAN FERNANDO','0007');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('36','4','BOLIVAR','0008');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('37','4','CAMATAGUA','0009');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('38','4','FRANCISCO LINARES ALCANTARA','1111');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('39','4','GIRARDOT','005');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('40','4','JOSE ANGEL LAMAS','0005');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('41','4','JOSE FELIX RIBAS','0003');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('42','4','JOSE RAFAEL REVENGA','0005');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('43','4','LIBERTADOR','0005');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('44','4','MARIO BRICEÑO IRAGORRY','0321');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('45','4','OCUMARE DE LA COSTA DE ORO','0010');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('46','4','SAN CASIMIRO','0253');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('47','4','SAN SEBASTIAN','1234');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('48','4','SANTIAGO MARIÑO','0153');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('49','4','SANTOS MICHELENA','0251');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('50','4','SUCRE','1040');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('51','4','TOVAR','1029');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('52','4','URDANETA','0250');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('53','4','ZAMORA','0249');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('54','5','ALBERTO ARVELO TORREALBA','0248');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('55','5','ANDRES ELOY BLANCO','0247');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('56','5','ANTONIO JOSE DE SUCRE','0246');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('57','5','ARISMENDI','0245');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('58','5','BARINAS','1244');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('59','5','BOLIVAR','1243');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('60','5','CRUZ PAREDES','1243');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('61','5','EZEQUIEL ZAMORA','0125');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('62','5','OBISPOS','1242');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('63','5','PEDRAZA','1241');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('64','5','ROJAS','1943');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('65','5','SOSA','1239');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('66','6','CARONI','1236');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('67','6','CEDEÑO','0323');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('68','6','EL CALLAO','1236');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('69','6','GRAN SABANA','1235');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('70','6','HERES','1034');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('71','6','PADRE PEDRO CHIEN','1233');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('72','6','PIAR','1232');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('73','6','RAUL LEONI','1231');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('74','6','ROSCIO','1230');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('75','6','SIFONTES','1229');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('76','6','SUCRE','1228');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('77','7','BEJUMA','0001');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('78','7','CARLOS ARVELO','0012');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('79','7','DIEGO IBARRA','0013');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('80','7','GUACARA','1017');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('81','7','JUAN JOSE MORA','1110');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('82','7','LIBERTADOR','1143');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('83','7','LOS GUAYOS','1212');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('84','7','MIRANDA','1223');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('85','7','MOLTANBAN','1224');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('86','7','NAGUANAGUA','1225');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('87','7','PUERTO CABELLO','1225');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('88','7','SAN DIEGO','1226');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('89','7','SAN JOAQUIN','1240');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('90','7','VALENCIA','0246');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('91','8','ANZOATEGUI','0254');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('92','8','EL PAO DE SAN JUAN BAUTISTA','0155');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('93','8','FALCON','0250');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('94','8','GIRARDOT','0251');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('95','8','LIMA BLANCO','0252');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('96','8','RICAURTE','0253');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('97','8','ROMULO GALLEGOS','0254');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('98','8','SAN CARLOS DE AUSTRIA','0255');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('100','8','TINACO','0256');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('101','9','ANTONIO DIAZ','0257');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('102','9','CASACOIMA','0258');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('103','9','PEDERNALES','0259');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('104','9','TUCUPITA','0260');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('105','10','ACOSTA','0261');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('106','10','BOLIVAR','0262');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('107','10','BUCHIVACOA','0155');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('108','10','CACIQUE MANAURE','1110');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('110','10','CARIRUBANA','1111');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('111','10','COLINA','1112');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('112','10','DABAJURO','1113');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('113','10','DEMOCRACIA','1114');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('114','10','FALCON','1116');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('115','10','FEDERACION','1117');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('116','10','JACURA','1118');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('117','10','LOS TAQUES','1116');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('118','10','MAUROA','1117');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('119','10','MIRANDA','1118');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('120','10','MONSEÑOR ITURRIZA','1119');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('121','10','PALMASOLA','0246');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('122','10','PETIT','1121');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('123','10','PIRUTI','1123');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('124','10','SAN FRANCISCO','1124');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('125','10','SILVA','1125');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('126','10','SUCRE','1130');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('127','10','TOCOPERO','1033');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('128','10','UNION','1034');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('129','10','URUMACO','1136');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('130','10','ZAMORA','1134');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('131','11','CAMAGUAN','1128');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('132','11','CHAGUARAMAS','1132');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('133','11','EL SOCORRO','1131');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('134','11','FRANCISCO DE MIRANDA','1129');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('135','11','JOSE FELIX RIBAS','1125');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('136','11','JOSE TADEO MONAGAS','1122');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('137','11','JUAN GERMAN ROSCIO','1120');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('138','11','JULIAN MELLADO','1119');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('139','11','LAS MERCEDES','0011');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('140','11','LEONARDO INFANTE','1013');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('141','11','ORTIZ','1014');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('142','11','PEDRO ZARAZA','1016');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('143','11','SAN GERONIMO DE GUAYABAL','1016');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('144','11','SAN JOSE DE GUARIBE','1041');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('145','11','SANTA MARIA DE IPIRE','1047');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('146','12','ANDRES ELOY BLANCO','1048');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('147','12','CRESPO','1049');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('148','12','IRIBARREN','1045');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('149','12','JIMENEZ','1060');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('150','12','MORAN','1061');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('151','12','PALAVECINO','1062');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('152','12','SIMON PLANAS','1046');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('153','12','TORRES','1044');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('154','12','URDANETA','1057');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('155','13','ALBERTO ADRIANI','1057');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('157','13','ANTONIO PINTO SALINAS','1058');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('159','13','ANDRES BELLO','1063');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('160','13','ARICAGUA','1064');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('161','13','ARZOBISPO CHACON','1058');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('162','13','CAMPO ELIAS','1059');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('163','13','CARACCIOLO PARRA OLMEDO','1060');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('164','13','CARDENAL QUINTERO','1062');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('165','13','GUARAQUE','1063');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('166','13','JULIO CESAR SALAS','1020');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('167','13','JUSTO BRICEÑO','1065');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('168','13','LIBERTADOR','1065');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('169','13','MIRANDA','1029');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('170','13','OBISPO RAMOS DE LORA','1066');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('171','13','PADRE NOGUERA','1067');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('172','13','PUEBLO LLANO','1053');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('173','13','RANGEL','1026');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('174','13','RIVAS DAVILA','1052');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('175','13','SANTOS MARQUINA','1042');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('176','13','SUCRE','1054');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('177','13','TOVAR','1053');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('178','13','TULIO FEBRES CORDERO','1032');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('179','13','ZEA','1034');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('180','14','ACEVEDO','1035');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('181','14','ANDRES BELLO','1036');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('182','14','BARUTA','1037');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('183','14','BRION','1038');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('184','14','BUROZ','1039');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('185','14','CARRIZAL','1052');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('186','14','CHACAO','1031');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('187','14','CRISTOBAL ROJAS','1032');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('188','14','EL HATILLO','1033');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('189','14','GUAICAIPURO','1034');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('190','14','INDEPENDENCIA','1035');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('191','14','LANDER','1035');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('192','14','LOS SALIAS','1037');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('193','14','PAEZ','1037');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('194','14','PAZ CASTILLO','1038');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('195','14','PEDRO GUAL','1049');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('196','14','PLAZA','1039');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('197','14','SIMON BOLIVAR','140');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('198','14','SUCRE','1041');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('199','14','URDANETA','1042');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('200','14','ZAMORA','1043');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('201','15','ACOSTA','1044');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('202','15','AGUASAY','1045');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('203','15','BOLIVAR','1045');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('204','15','CARIPE','1047');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('205','15','CEDEÑO','1047');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('206','15','EZEQUIEL ZAMORA','1048');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('207','15','LIBERTADOR','1049');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('208','15','MATURIN','1049');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('209','15','PIAR','1050');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('210','15','PUNCERES','1051');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('211','15','SANTA BARBARA','1052');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('212','15','SOTILLO','1053');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('213','15','URACOA','1044');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('214','16','ANTOLIN DEL CAMPO','1054');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('215','16','ARISMENDI','1056');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('216','16','DIAZ','1001');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('217','16','GARCIA','1002');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('218','16','GOMEZ','1003');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('219','16','MANEIRO','1004');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('220','16','MARCANO','1004');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('221','16','MARIÑO','1005');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('222','16','PENINSULA DE MACANAO','1006');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('223','16','TUBORES','1007');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('224','16','VILLALBA','1009');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('225','17','AGUA BLANCA','1010');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('226','17','ARAURE','1011');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('227','17','ESTELLER','1012');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('228','17','GUANARE','1013');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('229','17','GUANARITO','1014');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('230','17','MONSEÑOR JOSE VICENTE DE UNDA','1015');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('231','17','OSPINO','1016');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('232','17','PAEZ','1017');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('233','17','PAPELON','1018');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('234','17','SAN GENARO DE BOCONOITO','1019');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('235','17','SAN RAFAEL DE ONOTO','1020');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('236','17','SANTA ROSALIA','10021');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('237','17','SUCRE','1022');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('238','17','TUREN','1023');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('239','18','ANDRES ELOY BLANCO','1024');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('240','18','ANDRES MATA','1025');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('241','18','ARISMENDI','1026');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('242','18','BENITEZ','1027');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('243','18','BERMUDEZ','1028');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('244','18','BOLIVAR','1029');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('245','18','CAJIGAL','1030');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('246','18','CRUZ SALMERON ACOSTA','0153');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('247','18','LIBERTADOR','1065');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('248','18','MARIÑO','0180');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('249','18','MEJIA','1066');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('250','18','MONTES','1067');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('251','18','RIBERO','1057');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('252','18','SUCRE','1058');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('253','18','VALDEZ','0169');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('254','19','ANDRES BELLO','0171');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('255','19','ANTONIO ROMULO COSTA','1073');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('256','19','AYACUCHO','1074');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('257','19','BOLIVAR','1075');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('258','19','CARDENAS','1077');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('259','19','CORDOBA','0178');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('260','19','FERNANDEZ FEO','1079');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('261','19','FRANCISCO DE MIRANDA','0182');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('262','19','GARCIA DE HEVIA','1074');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('263','19','GUASIMOS','0175');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('264','19','INDEPENDENCIA','0177');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('265','19','JAUREGUI','0178');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('266','19','JOSE MARIA VARGAS','1076');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('267','19','JUNIN','1091');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('268','19','LIBERTAD','0190');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('269','19','LIBERTADOR','1072');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('270','19','LOBATERA','01365');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('271','19','MICHELENA','0164');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('272','19','PANAMERICANO','0164');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('273','19','PEDRO MARIA UREÑA','0164');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('274','19','RAFAEL URDANETA','0162');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('275','19','SAMUEL DARIO MALDONADO','0160');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('276','19','SAN CRISTOBAL','0133');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('277','19','SAN JUDAS TADEO','0134');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('278','19','SEBORUCO','0134');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('279','19','SIMON RODRIGUEZ','0136');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('280','19','SUCRE','0137');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('281','19','TORBES','0138');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('282','19','URIBANTE','0139');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('283','20','ANDRES BELLO','0140');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('284','20','BOCONO','0141');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('285','20','BOLIVAR','0143');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('286','20','CANDELARIA','0144');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('287','20','CARACHE','0145');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('288','20','ESCUQUE','0146');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('289','20','JOSE FELIPE MARQUEZ CAÑIZALES','0147');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('290','20','JOSE VICENTE CAMPO ELIAS','0148');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('291','20','LA CEIBA','0148');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('292','20','MIRANDA','0150');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('293','20','MONTE CARMELO','0151');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('294','20','MOTATAN','0152');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('295','20','PAMPAN','0153');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('296','20','PAMPANITO','0153');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('297','20','RAFAEL RANGEL','0154');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('298','20','SAN RAFAEL DE CARVAJAL','0155');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('299','20','SUCRE','0155');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('300','20','TRUJILLO','1056');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('301','20','URDANETA','1056');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('302','20','VALERA','0157');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('303','21','VARGAS','0157');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('304','22','ARISTIDES BASTIDAS','0158');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('305','22','BOLIVAR','1058');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('306','22','BRUZUAL','0103');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('307','22','COCOROTE','1032');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('308','22','INDEPENDENCIA','1031');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('309','22','JOSE ANTONIO PAEZ','1030');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('310','22','LA TRINIDAD','1029');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('311','22','MANUEL MONGE','1034');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('312','22','NIRGUA','1021');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('313','22','PEÑA','1027');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('314','22','SAN FELIPE','1026');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('315','22','SUCRE','1025');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('316','22','URACHICHE','1025');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('317','22','VEROES','1024');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('318','23','ALMIRANTE PADILLA','1025');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('319','23','BARALT','1022');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('320','23','CABIMAS','1023');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('321','23','CATATUMBO','1021');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('322','23','COLON','1020');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('323','23','FRANCISCO JAVIER PULGAR','1019');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('324','23','JESUS ENRIQUE LOSADA','1010');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('325','23','JESUS MARIA SEMPRUN','1018');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('326','23','LA CAÑADA DE URDANETA','1016');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('327','23','LAGUNILLAS','1015');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('328','23','MACHIQUES DE PERIJA','1012');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('329','23','MARA','1014');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('330','23','MARACAIBO','1011');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('331','23','MIRANDA','1013');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('332','23','PAEZ','1009');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('333','23','ROSARIO DE PERIJA','1007');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('334','23','SAN FRANCISCO','1006');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('335','23','SANTA RITA','1005');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('336','23','SIMON BOLIVAR','0104');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('337','23','SUCRE','0103');
INSERT INTO  pasantias.municipio (id_municipio,id_estado,nombre_municipio,codigo)  VALUES ('338','23','VALMORE RODRIGUEZ','1034');

--
CREATE SEQUENCE pasantias.municipio_id_municipio_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	339
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.municipio ALTER COLUMN id_municipio SET DEFAULT nextval('pasantias.municipio_id_municipio_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.organizacion'
--

CREATE TABLE pasantias.organizacion (
id_organizacion bigint NOT NULL,
id_tipo_organizacion bigint NOT NULL,
rif character varying NOT NULL,
nombre_organizacion character varying NOT NULL,
correo character varying NOT NULL,
telefono character varying NOT NULL,
descripcion character varying  NULL,
siglas character varying  NULL
);

--
-- Informacion de la tabla 'pasantias.organizacion'
--

INSERT INTO  pasantias.organizacion (id_organizacion,id_tipo_organizacion,rif,nombre_organizacion,correo,telefono,descripcion,siglas)  VALUES ('1','13','J-032432432','UNIVERSIDAD POLITÉCNICA TERRITORIAL ARISTIDES BASTIDAS DE YARACUY','UPTABY@GMAIL.COM','02542324324','UNIVERSIDAD DE YARACUY','U.P.T.A.B.Y');
INSERT INTO  pasantias.organizacion (id_organizacion,id_tipo_organizacion,rif,nombre_organizacion,correo,telefono,descripcion,siglas)  VALUES ('2','15','T-32555655','Macro','jeisd@gmail.com','02549879879','asdd','M');

--
CREATE SEQUENCE pasantias.organizacion_id_organizacion_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	3
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.organizacion ALTER COLUMN id_organizacion SET DEFAULT nextval('pasantias.organizacion_id_organizacion_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.oficina'
--

CREATE TABLE pasantias.oficina (
id_departamento bigint NOT NULL,
id_oficina bigint NOT NULL,
nombre_oficina character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.oficina'
--

INSERT INTO  pasantias.oficina (id_departamento,id_oficina,nombre_oficina)  VALUES ('35','22','PASANTIAS');
INSERT INTO  pasantias.oficina (id_departamento,id_oficina,nombre_oficina)  VALUES ('36','23','CONTACTO');

--
CREATE SEQUENCE pasantias.oficina_id_oficina_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	24
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.oficina ALTER COLUMN id_oficina SET DEFAULT nextval('pasantias.oficina_id_oficina_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.persona_instituto_especialidad'
--

CREATE TABLE pasantias.persona_instituto_especialidad (
id_persona bigint NOT NULL,
id_especialidad bigint NOT NULL,
id_ip bigint NOT NULL,
id_perfil integer NOT NULL,
estado character varying NOT NULL DEFAULT 'PENDIENTE'::character varying,
descripcion character varying NOT NULL DEFAULT 'NO DESCRIPCION'::character varying,
observacion character varying NOT NULL DEFAULT 'NO OBSERVACION'::character varying,
fecha_solicitud date  NULL,
fecha_aceptacion date  NULL,
id_responsable_asignacion bigint  NULL
);

--
-- Informacion de la tabla 'pasantias.persona_instituto_especialidad'
--

INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('89','27','1','3','PENDIENTE','NO DESCRIPCION','NO OBSERVACION');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('90','27','1','3','PENDIENTE','NO DESCRIPCION','ESTUDIANTE');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion,fecha_solicitud)  VALUES ('91','27','1','3','PENDIENTE','NO DESCRIPCION','ESTUDIANTE','2015-12-23');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('92','28','1','3','PENDIENTE','NO DESCRIPCION','ESTUDIANTE');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('93','28','1','3','PENDIENTE','NO DESCRIPCION','ESTUDIANTE');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('94','28','1','3','APROBADO','NO DESCRIPCION','ESTUDIANTE');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('95','28','1','3','PENDIENTE','NO DESCRIPCION','ESTUDIANTE');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('96','30','1','3','PENDIENTE','NO DESCRIPCION','ESTUDIANTE');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion,fecha_solicitud)  VALUES ('97','30','1','3','PENDIENTE','NO DESCRIPCION','ESTUDIANTE','2015-12-07');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion,fecha_solicitud,fecha_aceptacion,id_responsable_asignacion)  VALUES ('98','30','1','3','APROBADO','NO DESCRIPCION','ESTU','2015-12-07','2015-12-08','87');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('99','30','1','3','PENDIENTE','NO DESCRIPCION','ESTUDIANTE');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('100','31','1','3','APROBADO','NO DESCRIPCION','OKKKK');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('101','31','1','3','APROBADO','NO DESCRIPCION','NO PRESENTO');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('102','31','1','3','APROBADO','NO DESCRIPCION','NO');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('103','31','1','3','APROBADO','NO DESCRIPCION','NO VINO');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('104','29','1','3','APROBADO','NO DESCRIPCION','CERTII');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion,fecha_solicitud)  VALUES ('105','33','1','3','APROBADO','NO DESCRIPCION','ENCARGADO SISTEMA','2015-11-17');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('106','33','1','4','PENDIENTE','NO DESCRIPCION','TUTOR');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion,fecha_solicitud)  VALUES ('110','28','1','3','PENDIENTE','NO DESCRIPCION','456TYUWE','2015-12-29');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('111','34','1','3','APROBADO','NO DESCRIPCION','NOTHING');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('112','35','1','3','APROBADO','NO DESCRIPCION','CUIDADO');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion,fecha_solicitud,fecha_aceptacion)  VALUES ('116','30','1','4','APROBADO','NO DESCRIPCION','ASD','2015-12-18','2015-12-18');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion,fecha_solicitud,fecha_aceptacion)  VALUES ('117','30','1','4','APROBADO','NO DESCRIPCION','S','2015-12-18','2015-12-18');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion,fecha_solicitud,fecha_aceptacion,id_responsable_asignacion)  VALUES ('118','35','1','3','APROBADO','NO DESCRIPCION','WDDAWD','2015-12-01','2015-12-23','87');
INSERT INTO  pasantias.persona_instituto_especialidad (id_persona,id_especialidad,id_ip,id_perfil,estado,descripcion,observacion)  VALUES ('119','27','1','3','PENDIENTE','NO DESCRIPCION','ASSDASDASD');


--
-- Estrutura de la tabla 'pasantias.requisito'
--

CREATE TABLE pasantias.requisito (
id_requisito bigint NOT NULL,
nombre_requisito character varying NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.requisito'
--

INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('1','PASANTIAS','INACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('2','EGRESADO','INACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('3','PRACTICA PROFESIONAL','ACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('4','CEDULA','ACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('5','DS','INACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('6','DSFDF','ACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('7','RETRTR','ACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('8','RIF','ACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('9','OTHER','INACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('10','TRANSPORTE PARTICULAR','ACTIVO');
INSERT INTO  pasantias.requisito (id_requisito,nombre_requisito,estatus)  VALUES ('11','METETELE','ACTIVO');

--
CREATE SEQUENCE pasantias.requisito_id_requisito_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	12
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.requisito ALTER COLUMN id_requisito SET DEFAULT nextval('pasantias.requisito_id_requisito_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.perfil'
--

CREATE TABLE pasantias.perfil (
id_perfil integer NOT NULL,
nombre_perfil character varying NOT NULL,
descripcion character varying NOT NULL DEFAULT 'En Espera'::character varying
);

--
-- Informacion de la tabla 'pasantias.perfil'
--

INSERT INTO  pasantias.perfil (id_perfil,nombre_perfil,descripcion)  VALUES ('1','Menú Principal','En Espera');
INSERT INTO  pasantias.perfil (id_perfil,nombre_perfil,descripcion)  VALUES ('2','Menú Empresa','En Espera');
INSERT INTO  pasantias.perfil (id_perfil,nombre_perfil,descripcion)  VALUES ('3','Menú Estudiante','En Espera');
INSERT INTO  pasantias.perfil (id_perfil,nombre_perfil,descripcion)  VALUES ('4','Menú Tutor Academico','En Espera');
INSERT INTO  pasantias.perfil (id_perfil,nombre_perfil,descripcion)  VALUES ('5','Menú Tutor Empresarial','En Espera');
INSERT INTO  pasantias.perfil (id_perfil,nombre_perfil,descripcion)  VALUES ('6','Menú Administrador','En Espera');
INSERT INTO  pasantias.perfil (id_perfil,nombre_perfil,descripcion)  VALUES ('7','Menú Super Usuario','En Espera');

--
CREATE SEQUENCE pasantias.perfil_id_perfil_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	8
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.perfil ALTER COLUMN id_perfil SET DEFAULT nextval('pasantias.perfil_id_perfil_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.responsables'
--

CREATE TABLE pasantias.responsables (
id_serial bigint NOT NULL,
codigo_solicitud character varying NOT NULL,
table_column character varying NOT NULL,
valor character varying NOT NULL,
estatus character varying NOT NULL,
fecha_asignacion date NOT NULL DEFAULT now()
);

--
-- Informacion de la tabla 'pasantias.responsables'
--

INSERT INTO  pasantias.responsables (id_serial,codigo_solicitud,table_column,valor,estatus,fecha_asignacion)  VALUES ('25','1','persona.id_persona','113','REALIZADO','2015-12-08');
INSERT INTO  pasantias.responsables (id_serial,codigo_solicitud,table_column,valor,estatus,fecha_asignacion)  VALUES ('32','1','tutor_academico.codigo_tutor_academico','116 - 30 - 1 - 4','ASIGNADO','2015-12-21');

--
CREATE SEQUENCE pasantias.responsables_id_serial_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	33
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.responsables ALTER COLUMN id_serial SET DEFAULT nextval('pasantias.responsables_id_serial_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.periodo_solicitud'
--

CREATE TABLE pasantias.periodo_solicitud (
id_periodo bigint NOT NULL,
id_lapso bigint NOT NULL,
fecha_inicio date NOT NULL,
fecha_fin date NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.periodo_solicitud'
--

INSERT INTO  pasantias.periodo_solicitud (id_periodo,id_lapso,fecha_inicio,fecha_fin,estatus)  VALUES ('9','6','2015-10-26','2015-10-31','ACTIVO');
INSERT INTO  pasantias.periodo_solicitud (id_periodo,id_lapso,fecha_inicio,fecha_fin,estatus)  VALUES ('10','7','2015-12-25','2015-12-31','ACTIVO');

--
CREATE SEQUENCE pasantias.periodo_solicitud_id_periodo_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	11
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.periodo_solicitud ALTER COLUMN id_periodo SET DEFAULT nextval('pasantias.periodo_solicitud_id_periodo_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.publicacion'
--

CREATE TABLE pasantias.publicacion (
id_publicacion integer NOT NULL,
id_perfil integer NOT NULL,
titulo character varying  NULL,
texto character varying NOT NULL,
foto character varying  NULL,
fecha date  NULL
);

--
-- Informacion de la tabla 'pasantias.publicacion'
--


--
CREATE SEQUENCE pasantias.publicacion_id_publicacion_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	1
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.publicacion ALTER COLUMN id_publicacion SET DEFAULT nextval('pasantias.publicacion_id_publicacion_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.organizacion_oficina'
--

CREATE TABLE pasantias.organizacion_oficina (
codigo_sucursal character varying NOT NULL,
id_oficina bigint NOT NULL,
estado character varying  NULL DEFAULT 'EN ESPERA'::character varying,
descripcion character varying NOT NULL DEFAULT 'NO DESCRIPCION'::character varying,
observacion character varying NOT NULL DEFAULT 'NO OBSERVACION'::character varying
);

--
-- Informacion de la tabla 'pasantias.organizacion_oficina'
--

INSERT INTO  pasantias.organizacion_oficina (codigo_sucursal,id_oficina,estado,descripcion,observacion)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO','22','ACTIVO','NO DESCRIPCION','Registro Interno Del Sistema');
INSERT INTO  pasantias.organizacion_oficina (codigo_sucursal,id_oficina,estado,descripcion,observacion)  VALUES ('31 - 2 - asddd','23','ACTIVO','NO DESCRIPCION','Registro Interno Del Sistema');


--
-- Estrutura de la tabla 'pasantias.temporadas_solicitud'
--

CREATE TABLE pasantias.temporadas_solicitud (
codigo_temporada character varying NOT NULL DEFAULT 'nothing'::character varying,
id_tipo_solicitud bigint NOT NULL,
id_periodo bigint NOT NULL,
codigo_encargado character varying NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.temporadas_solicitud'
--

INSERT INTO  pasantias.temporadas_solicitud (codigo_temporada,id_tipo_solicitud,id_periodo,codigo_encargado,estatus)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','1','9','308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','EN CURSO');
INSERT INTO  pasantias.temporadas_solicitud (codigo_temporada,id_tipo_solicitud,id_periodo,codigo_encargado,estatus)  VALUES ('2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','2','10','308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','PREPARADA');


--
-- Estrutura de la tabla 'pasantias.solicitud'
--

CREATE TABLE pasantias.solicitud (
codigo_solicitud character varying NOT NULL,
fecha_solicitud date NOT NULL,
cantidad_postulantes character varying NOT NULL,
estatus character varying NOT NULL,
descripcion character varying NOT NULL DEFAULT 'General'::character varying,
codigo_estudiante character varying NOT NULL,
codigo_temporada_especialidad character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.solicitud'
--

INSERT INTO  pasantias.solicitud (codigo_solicitud,fecha_solicitud,cantidad_postulantes,estatus,descripcion,codigo_estudiante,codigo_temporada_especialidad)  VALUES ('1','2015-12-08','1','ACTIVO','General','98 - 30 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 30');


--
-- Estrutura de la tabla 'pasantias.temporadas_estudiantes'
--

CREATE TABLE pasantias.temporadas_estudiantes (
codigo_estudiante character varying NOT NULL,
codigo_temporada_especialidad character varying NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.temporadas_estudiantes'
--

INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('100 - 31 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 31','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('101 - 31 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 31','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('102 - 31 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 31','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('103 - 31 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 31','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('104 - 29 - 1 - 3','2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 29','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('105 - 26 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 33','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('112 - 35 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 35','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('112 - 35 - 1 - 3','2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 35','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('118 - 35 - 1 - 3','2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 35','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('89 - 27 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 27','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('90 - 27 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 27','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('91 - 27 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 27','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('96 - 30 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 30','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('97 - 30 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 30','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('98 - 30 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 30','PREPARADO');
INSERT INTO  pasantias.temporadas_estudiantes (codigo_estudiante,codigo_temporada_especialidad,estatus)  VALUES ('99 - 30 - 1 - 3','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 30','PREPARADO');


--
-- Estrutura de la tabla 'pasantias.submenu'
--

CREATE TABLE pasantias.submenu (
id_submenu integer NOT NULL,
ruta_submenu character varying NOT NULL,
nombre_submenu character varying NOT NULL,
id_funcion integer NOT NULL
);

--
-- Informacion de la tabla 'pasantias.submenu'
--

INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('1','../../Modulo_Estudiante/vista/gestion_usuario_estudiante.phtml','Estudiante','2');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('2','../../Modulo_Tutor_Academico/vista/consultar_usuario_estudiante.phtml','Tutor Académico','2');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('4','../../Modulo_Tutor_Empresarial2/vista/Gestionar_Tutores.php','Tutores','6');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('5','../../Modulo_Asignacion_Oficina/vista/Asignacion_Oficina.php','Departamentos','6');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('6','../../Modulo_Solicitud/vista/Gestion_Solicitud.php','Solicitud','7');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('8','../../Modulo_Postulacion/vista/PostulacionDirigida.phtml','Solicitud','10');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('9','../../Modulo_Temporada_Solicitud/vista/TemporadasCurso.phtml','Temporadas en Curso','20');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('10','#','Evaluación de Pasantes','13');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('11','#','Seguimiento de Pasantes','13');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('12','#','Datos Personales','13');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('13','#','Evaluación de Pasantes','16');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('14','#','Seguimiento de Pasantes','16');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('15','#','Datos Personales','16');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('17','#','Organización','19');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('18','#','Aprobar','19');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('23','../../Modulo_Organizacion/vista/Instituto.phtml','Datos Básicos','21');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('24','../../Modulo_Requisito/vista/Requisito.phtml','Requisitos','21');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('26','#','Instrumentos','21');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('27','../../Modulo_Nuevo_Lapso/vista/Gestion_Lapso_Academico.php','Lapso Académico','21');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('29','../../Modulo_Periodo_Solicitud/vista/Gestion_Periodo_Solicitud.php','Periodos de Solicitud','21');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('31','../../Modulo_Mantenimiento/vista/mantenimiento.phtml','Base de Datos','22');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('33','../../Modulo_Mantenimiento/vista/bitacora.phtml','Bitácora','22');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('34','#','Ayuda','22');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('35','#','Transferencias de Datos','22');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('36','#','Gestionar Localidad','21');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('37','../../Modulo_Tipo_Solicitud/vista/Tipo_Solicitud.phtml','Tipo Solicitud','21');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('38','../../Modulo_Registrar_Roles_Perfiles/vista/publicar_roles_perfiles.php','Publicar Roles Perfiles','21');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('40','../../Modulo_Organizacion/vista/InstitutoConvenio.phtml','Organización Convenio','24');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('41','../../Modulo_Organizacion/vista/Instituto.phtml','Organización Principal','24');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('42','../../Modulo_Temporada_Solicitud/vista/Temporada_Solicitud.phtml','Temporada de Solicitud','20');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('43','#','Personas','19');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('44','#','Usuarios','19');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('45','../../Modulo_Curriculo_ColorAzul/vista/Gestion_Curriculo.php','Gestionar Curriculo','10');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('46','../../Modulo_Organizacion/vista/Solicitudes.phtml','Postulaciones','7');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('47','../../Modulo_Organizacion/vista/Mis_Solicitudes.phtml','Mis Solicitudes','7');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('48','../../Modulo_Solicitud/vista/Mostrar_Solicitudes.php','General','25');
INSERT INTO  pasantias.submenu (id_submenu,ruta_submenu,nombre_submenu,id_funcion)  VALUES ('49','../../Modulo_Solicitud/vista/Mostrar_Solicitudes_Especificas.php','Especificas','25');

--
CREATE SEQUENCE pasantias.submenu_id_submenu_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	50
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.submenu ALTER COLUMN id_submenu SET DEFAULT nextval('pasantias.submenu_id_submenu_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.solicitudes_aprobadas'
--

CREATE TABLE pasantias.solicitudes_aprobadas (
id_serial bigint NOT NULL,
codigo_solicitud character varying NOT NULL,
table_column character varying NOT NULL,
valor character varying NOT NULL,
fecha_aprobacion date NOT NULL
);

--
-- Informacion de la tabla 'pasantias.solicitudes_aprobadas'
--

INSERT INTO  pasantias.solicitudes_aprobadas (id_serial,codigo_solicitud,table_column,valor,fecha_aprobacion)  VALUES ('21','1','estudiante.codigo_estudiante','98 - 30 - 1 - 3','2015-12-08');

--
CREATE SEQUENCE pasantias.solicitudes_aprobadas_id_serial_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	22
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.solicitudes_aprobadas ALTER COLUMN id_serial SET DEFAULT nextval('pasantias.solicitudes_aprobadas_id_serial_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.solicitudes_recibidas'
--

CREATE TABLE pasantias.solicitudes_recibidas (
id_serial bigint NOT NULL,
codigo_solicitud character varying NOT NULL,
table_column character varying NOT NULL,
valor character varying NOT NULL,
estatus character varying NOT NULL DEFAULT 'EN ESPERA'::character varying,
fecha_postulacion date NOT NULL DEFAULT now()
);

--
-- Informacion de la tabla 'pasantias.solicitudes_recibidas'
--

INSERT INTO  pasantias.solicitudes_recibidas (id_serial,codigo_solicitud,table_column,valor,estatus,fecha_postulacion)  VALUES ('92','1','organizacionmunicipio.codigo_sucursal','31 - 2 - asddd','LISTO','2015-12-08');

--
CREATE SEQUENCE pasantias.solicitudes_recibidas_id_serial_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	93
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.solicitudes_recibidas ALTER COLUMN id_serial SET DEFAULT nextval('pasantias.solicitudes_recibidas_id_serial_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.tipo_organizacion'
--

CREATE TABLE pasantias.tipo_organizacion (
id_tipo_organizacion bigint NOT NULL,
nombre_tipo_organizacion character varying NOT NULL,
estatus character varying NOT NULL,
descripcion character varying  NULL
);

--
-- Informacion de la tabla 'pasantias.tipo_organizacion'
--

INSERT INTO  pasantias.tipo_organizacion (id_tipo_organizacion,nombre_tipo_organizacion,estatus,descripcion)  VALUES ('13','PÚBLICO','ACTIVO','no Descripcion');
INSERT INTO  pasantias.tipo_organizacion (id_tipo_organizacion,nombre_tipo_organizacion,estatus,descripcion)  VALUES ('14','PRIVADO','ACTIVO','no aplica');
INSERT INTO  pasantias.tipo_organizacion (id_tipo_organizacion,nombre_tipo_organizacion,estatus,descripcion)  VALUES ('15','MIXTO','ACTIVO','comparte de privadas y publicas');
INSERT INTO  pasantias.tipo_organizacion (id_tipo_organizacion,nombre_tipo_organizacion,estatus,descripcion)  VALUES ('16','COOPERATIVA','ACTIVO','no descripcion');
INSERT INTO  pasantias.tipo_organizacion (id_tipo_organizacion,nombre_tipo_organizacion,estatus,descripcion)  VALUES ('29','UPS','ACTIVO','UNIDAD DE PRODUCCION SOCIALISTA');

--
CREATE SEQUENCE pasantias.tipo_organizacion_id_tipo_organizacion_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	30
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.tipo_organizacion ALTER COLUMN id_tipo_organizacion SET DEFAULT nextval('pasantias.tipo_organizacion_id_tipo_organizacion_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.submenu2'
--

CREATE TABLE pasantias.submenu2 (
id_submenu2 integer NOT NULL,
ruta_submenu2 character varying NOT NULL,
nombre_submenu2 character varying NOT NULL,
id_submenu integer NOT NULL
);

--
-- Informacion de la tabla 'pasantias.submenu2'
--

INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('5','../../Modulo_Estudiante/vista/registrar_estudiante.phtml','Estudiantes','43');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('6','../../Modulo_Tutor_Academico/vista/registrar_estudiante.phtml','Tutor Académico','43');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('7','#','Tutor Empresarial','43');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('9','../../Modulo_Organizacion/vista/InstitutoConvenio.phtml','Solicitud Organización Convenio','17');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('10','../../Modulo_Departamento/vista/Gestion_Oficina.php','Departamentos','17');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('11','../../Modulo_Departamento/vista/Gestion_Especialidad.php','Especialidad','17');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('12','../../Modulo_tipoOrganizacion/vista/tipoOrganizacion.phtml','Tipo Organizaciones','17');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('13','../../Modulo_Tipo_Especialidad/vista/Gestion_TipoEspecialidad.php','Tipo Especialidades','17');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('24','../../Modulo_Estado/vista/Estado.phtml','Estado','36');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('25','../../Modulo_Estado/vista/Municipio.phtml','Municipio','36');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('27','../../Modulo_Estudiante/vista/aprobarUsuarioEstudiante.php','Estudiante','18');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('28','../../Modulo_Tutor_Academico/vista/aprobarUsuarioEstudiante.php','Tutor Académico','18');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('29','../../Modulo_Organizacion/vista/aprobarUsuarioInstituto.phtml','Organización Convenio','18');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('30','../../Modulo_Organizacion/vista/MisOrganizacionesRegistrados.phtml','Mis Organizaciones','17');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('31','../../Modulo_Estudiante/vista/gestion_usuario_estudiante.phtml','Estudiante','44');
INSERT INTO  pasantias.submenu2 (id_submenu2,ruta_submenu2,nombre_submenu2,id_submenu)  VALUES ('32','../../Modulo_Tutor_Academico/vista/consultar_usuario_estudiante.phtml','Tutor Académico','44');

--
CREATE SEQUENCE pasantias.submenu2_id_submenu2_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	33
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.submenu2 ALTER COLUMN id_submenu2 SET DEFAULT nextval('pasantias.submenu2_id_submenu2_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.tipo_especialidad'
--

CREATE TABLE pasantias.tipo_especialidad (
id_tipo_especialidad bigint NOT NULL,
nombre_tipo_especialidad character varying NOT NULL,
estado character varying NOT NULL,
descripcion character varying  NULL
);

--
-- Informacion de la tabla 'pasantias.tipo_especialidad'
--

INSERT INTO  pasantias.tipo_especialidad (id_tipo_especialidad,nombre_tipo_especialidad,estado,descripcion)  VALUES ('1','PNF','ACTIVO','PROGRAMA NACIONAL DE FORMACION');
INSERT INTO  pasantias.tipo_especialidad (id_tipo_especialidad,nombre_tipo_especialidad,estado,descripcion)  VALUES ('2','TSU','ACTIVO','TECNICO MEDIO');
INSERT INTO  pasantias.tipo_especialidad (id_tipo_especialidad,nombre_tipo_especialidad,estado,descripcion)  VALUES ('3','TECNOLOGÍA','ACTIVO','blon');

--
CREATE SEQUENCE pasantias.tipo_especialidad_id_tipo_especialidad_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	4
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.tipo_especialidad ALTER COLUMN id_tipo_especialidad SET DEFAULT nextval('pasantias.tipo_especialidad_id_tipo_especialidad_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.tipo_solicitud'
--

CREATE TABLE pasantias.tipo_solicitud (
id_tipo_solicitud bigint NOT NULL,
nombre_tipo_solicitud character varying NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.tipo_solicitud'
--

INSERT INTO  pasantias.tipo_solicitud (id_tipo_solicitud,nombre_tipo_solicitud,estatus)  VALUES ('1','PASANTES','ACTIVO');
INSERT INTO  pasantias.tipo_solicitud (id_tipo_solicitud,nombre_tipo_solicitud,estatus)  VALUES ('2','PRACTICAS PROFESIONATES','ACTIVO');
INSERT INTO  pasantias.tipo_solicitud (id_tipo_solicitud,nombre_tipo_solicitud,estatus)  VALUES ('6','EMPLEO','ACTIVO');

--
CREATE SEQUENCE pasantias.tipo_solicitud_id_tipo_solicitud_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	7
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.tipo_solicitud ALTER COLUMN id_tipo_solicitud SET DEFAULT nextval('pasantias.tipo_solicitud_id_tipo_solicitud_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.tutor_academico'
--

CREATE TABLE pasantias.tutor_academico (
codigo_tutor_academico character varying NOT NULL DEFAULT 'nothinmg'::character varying,
id_persona bigint NOT NULL,
id_especialidad bigint NOT NULL,
id_ip bigint NOT NULL,
id_perfil integer NOT NULL,
codigo character varying NOT NULL DEFAULT 'TODAVIA NO'::character varying
);

--
-- Informacion de la tabla 'pasantias.tutor_academico'
--

INSERT INTO  pasantias.tutor_academico (codigo_tutor_academico,id_persona,id_especialidad,id_ip,id_perfil,codigo)  VALUES ('106 - 26 - 1 - 4','106','33','1','4','73001');
INSERT INTO  pasantias.tutor_academico (codigo_tutor_academico,id_persona,id_especialidad,id_ip,id_perfil,codigo)  VALUES ('116 - 30 - 1 - 4','116','30','1','4','123321');
INSERT INTO  pasantias.tutor_academico (codigo_tutor_academico,id_persona,id_especialidad,id_ip,id_perfil,codigo)  VALUES ('117 - 30 - 1 - 4','117','30','1','4','26999');


--
-- Estrutura de la tabla 'pasantias.bitacora'
--

CREATE TABLE pasantias.bitacora (
id_bitacora bigint NOT NULL,
usuario character varying NOT NULL,
id_usuario integer NOT NULL,
operacion character varying NOT NULL,
nombre_tabla character varying NOT NULL,
fecha date NOT NULL,
hora time without time zone NOT NULL
);

--
-- Informacion de la tabla 'pasantias.bitacora'
--


--
CREATE SEQUENCE pasantias.bitacora_id_bitacora_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	1
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.bitacora ALTER COLUMN id_bitacora SET DEFAULT nextval('pasantias.bitacora_id_bitacora_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.persona'
--

CREATE TABLE pasantias.persona (
id_persona bigint NOT NULL,
cedula character varying NOT NULL,
nombre character varying NOT NULL,
apellido character varying NOT NULL,
telefono character varying  NULL,
correo character varying  NULL
);

--
-- Informacion de la tabla 'pasantias.persona'
--

INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('87','8323432','LAURE','MARTINEZ','04123432432','LAURE@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('88','7234456','PEDRO','RODRIGUEZ','04123434345','PEDRO@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('89','21302408','KELLYS','ABREU');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('90','19615061','MIGNELLYS','ACOSTA');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('91','20889909','YETTI','ADAME','02457878787','YETI@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('92','16260159','WALDINA','ABREU');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('93','25927850','GIOVANNI','ACCARDO');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('94','26709073','LOINESGRY','ACEVEDO','02596546544','LOINESGRY@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('95','21301841','GREGORIO','MOISES');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('96','25785477','MARIA','PARRA');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('97','25455677','KALENI','PEREZ','02548778777','KALENI@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('98','25584549','DIOSMARCRIS','MENDOZA','04126546548','DIOSMARCRIS@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('99','25686048','DORISA','BLASCO');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('100','25177047','SAIRETH','RIVERO');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('101','25177590','ANTONY','ESPINIZA');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('102','22318127','EDIXON','ROMERO');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('103','17700474','HERNANY','GUTIERREZ');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('104','19009123','LESBIA','RAMIREZ');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('105','21303043','EDINSON','RODRIGUEZ','12132546578','EDINSON@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('106','7318087','JOSE','PERAZA');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('107','278880','MARIO','BOOMER');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('108','24633974','jesus','Lopez','02549876545','jesus@gmail.com');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('109','342343242','ALEXIS','LEON','0412332423','ALEX@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('110','435345345','OTRAAA','NINGUNA','12345678900','WDADAD@GMAIL.COM');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('111','215444655','JULIO','VIOLADOR');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('112','20123123','JESUS','LOPEZ');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('113','213213111','ana','Por','02549879879','lol@gmail.com');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido,telefono,correo)  VALUES ('114','123123123','asease','ase','12333333333','12313');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('116','254254255','BROMERN','BROMERO');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('117','6546545','PROMER','FLIGHT');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('118','25252525','EDINSON','FIGUEROA RODRIGUEZ');
INSERT INTO  pasantias.persona (id_persona,cedula,nombre,apellido)  VALUES ('119','43534534','ASD','ASDASD');

--
CREATE SEQUENCE pasantias.persona_id_persona_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	120
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.persona ALTER COLUMN id_persona SET DEFAULT nextval('pasantias.persona_id_persona_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.extra_curriculum'
--

CREATE TABLE pasantias.extra_curriculum (
id_extra_curriculum bigint NOT NULL,
descripcion character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.extra_curriculum'
--


--
CREATE SEQUENCE pasantias.extra_curriculum_id_extra_curriculum_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	1
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.extra_curriculum ALTER COLUMN id_extra_curriculum SET DEFAULT nextval('pasantias.extra_curriculum_id_extra_curriculum_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.segmentos'
--

CREATE TABLE pasantias.segmentos (
id_segmento bigint NOT NULL,
subdivision character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.segmentos'
--


--
CREATE SEQUENCE pasantias.segmentos_id_segmento_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	1
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.segmentos ALTER COLUMN id_segmento SET DEFAULT nextval('pasantias.segmentos_id_segmento_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.estudiantes_entregables_valor'
--

CREATE TABLE pasantias.estudiantes_entregables_valor (
id_estudiantes_entregables bigint NOT NULL,
valor_asignado character varying NOT NULL,
fecha_actualizacion date NOT NULL DEFAULT (now())::date
);

--
-- Informacion de la tabla 'pasantias.estudiantes_entregables_valor'
--



--
-- Estrutura de la tabla 'pasantias.datos_extra'
--

CREATE TABLE pasantias.datos_extra (
id_curriculum bigint NOT NULL,
id_segmento bigint NOT NULL,
id_extra_curriculum bigint NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.datos_extra'
--



--
-- Estrutura de la tabla 'pasantias.solicitudes_enviadas'
--

CREATE TABLE pasantias.solicitudes_enviadas (
id_serial bigint NOT NULL,
codigo_solicitud character varying NOT NULL,
table_column character varying NOT NULL,
valor character varying NOT NULL,
estatus character varying NOT NULL DEFAULT 'EN ESPERA'::character varying
);

--
-- Informacion de la tabla 'pasantias.solicitudes_enviadas'
--

INSERT INTO  pasantias.solicitudes_enviadas (id_serial,codigo_solicitud,table_column,valor,estatus)  VALUES ('140','1','estudiante.codigo_estudiante','98 - 30 - 1 - 3','MOSTRAR');

--
CREATE SEQUENCE pasantias.solicitudes_enviadas_id_serial_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	141
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.solicitudes_enviadas ALTER COLUMN id_serial SET DEFAULT nextval('pasantias.solicitudes_enviadas_id_serial_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.solicitud_requisito'
--

CREATE TABLE pasantias.solicitud_requisito (
id_requisito bigint NOT NULL,
codigo_solicitud character varying NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.solicitud_requisito'
--



--
-- Estrutura de la tabla 'pasantias.encargado_tipo_solicitud'
--

CREATE TABLE pasantias.encargado_tipo_solicitud (
id_tipo_solicitud bigint NOT NULL,
codigo_encargado character varying NOT NULL,
estatus character varying NOT NULL,
descripcion character varying NOT NULL DEFAULT 'NO DESCRIPCION'::character varying
);

--
-- Informacion de la tabla 'pasantias.encargado_tipo_solicitud'
--



--
-- Estrutura de la tabla 'pasantias.curriculum'
--

CREATE TABLE pasantias.curriculum (
id_curriculum bigint NOT NULL,
id_persona bigint NOT NULL,
fecha_actualizacion date NOT NULL,
descripcion character varying NOT NULL,
foto character varying  NULL,
profesion character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.curriculum'
--

INSERT INTO  pasantias.curriculum (id_curriculum,id_persona,fecha_actualizacion,descripcion,foto,profesion)  VALUES ('8','105','2015-12-29','PROGRAMADOR','../images/ImagenesRegistradas/105/Photo.png','INFORMATICA');

--
CREATE SEQUENCE pasantias.curriculum_id_curriculum_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	13
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.curriculum ALTER COLUMN id_curriculum SET DEFAULT nextval('pasantias.curriculum_id_curriculum_seq'::regclass);
--
-- Estrutura de la tabla 'pasantias.entregable_temporada'
--

CREATE TABLE pasantias.entregable_temporada (
codigo_temporada character varying NOT NULL,
id_entregable bigint NOT NULL,
descripcion_entregable character varying NOT NULL,
fecha_asignacion date NOT NULL,
estatus_entregable character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.entregable_temporada'
--

INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','29','NO DESCRIPCION','2015-11-03','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','31','NO DESCRIPCION','2015-11-15','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','32','NO DESCRIPCION','2015-12-04','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','33','NO DESCRIPCION','2015-12-08','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','29','NO DESCRIPCION','2015-12-25','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','30','NO DESCRIPCION','2015-12-25','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','31','NO DESCRIPCION','2015-12-25','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('2 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 108 - 22 - 6','29','NO DESCRIPCION','2015-10-30','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('2 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 108 - 22 - 6','30','NO DESCRIPCION','2015-10-30','ACTIVO');
INSERT INTO  pasantias.entregable_temporada (codigo_temporada,id_entregable,descripcion_entregable,fecha_asignacion,estatus_entregable)  VALUES ('2 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 108 - 22 - 6','31','NO DESCRIPCION','2015-10-30','ACTIVO');


--
-- Estrutura de la tabla 'pasantias.organizacionmunicipio'
--

CREATE TABLE pasantias.organizacionmunicipio (
codigo_sucursal character varying NOT NULL DEFAULT 'nothing'::character varying,
id_municipio bigint NOT NULL,
id_organizacion bigint NOT NULL,
domicilio character varying NOT NULL,
observacion character varying NOT NULL DEFAULT 'CENTRAL'::character varying
);

--
-- Informacion de la tabla 'pasantias.organizacionmunicipio'
--

INSERT INTO  pasantias.organizacionmunicipio (codigo_sucursal,id_municipio,id_organizacion,domicilio,observacion)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO','308','1','CALLE 32 FRENTE A FARMATODO','CENTRAL');
INSERT INTO  pasantias.organizacionmunicipio (codigo_sucursal,id_municipio,id_organizacion,domicilio,observacion)  VALUES ('31 - 2 - asddd','31','2','asddd','CENTRAL');


--
-- Estrutura de la tabla 'pasantias.convenio_organizacion'
--

CREATE TABLE pasantias.convenio_organizacion (
id_ip bigint NOT NULL,
id_organizacion bigint NOT NULL,
fecha_r date NOT NULL,
descripcion character varying NOT NULL DEFAULT 'EN ESPERA'::character varying
);

--
-- Informacion de la tabla 'pasantias.convenio_organizacion'
--

INSERT INTO  pasantias.convenio_organizacion (id_ip,id_organizacion,fecha_r,descripcion)  VALUES ('1','2','2015-11-24','EN ESPERA');


--
-- Estrutura de la tabla 'pasantias.estudiante'
--

CREATE TABLE pasantias.estudiante (
codigo_estudiante character varying NOT NULL DEFAULT 'notjing'::character varying,
id_persona bigint NOT NULL,
id_especialidad bigint NOT NULL,
id_ip bigint NOT NULL,
id_perfil integer NOT NULL,
expediente character varying NOT NULL,
roll character varying NOT NULL DEFAULT 'PASANTE'::character varying
);

--
-- Informacion de la tabla 'pasantias.estudiante'
--

INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('100 - 31 - 1 - 3','100','31','1','3','25177','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('101 - 31 - 1 - 3','101','31','1','3','18757','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('102 - 31 - 1 - 3','102','31','1','3','22318','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('103 - 31 - 1 - 3','103','31','1','3','17700','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('104 - 29 - 1 - 3','104','29','1','3','19009','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('105 - 26 - 1 - 3','105','33','1','3','26613','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('110 - 28 - 1 - 3','110','28','1','3','26988','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('111 - 34 - 1 - 3','111','34','1','3','19654','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('112 - 35 - 1 - 3','112','35','1','3','2466655','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('118 - 35 - 1 - 3','118','35','1','3','252525','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('119 - 27 - 1 - 3','119','27','1','3','65565','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('89 - 27 - 1 - 3','89','27','1','3','27302','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('90 - 27 - 1 - 3','90','27','1','3','27615','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('91 - 27 - 1 - 3','91','27','1','3','27889','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('92 - 28 - 1 - 3','92','28','1','3','27162','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('93 - 28 - 1 - 3','93','28','1','3','25927','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('94 - 28 - 1 - 3','94','28','1','3','26079','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('95 - 28 - 1 - 3','95','28','1','3','21301','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('96 - 30 - 1 - 3','96','30','1','3','25785','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('97 - 30 - 1 - 3','97','30','1','3','25455','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('98 - 30 - 1 - 3','98','30','1','3','25584','PASANTE');
INSERT INTO  pasantias.estudiante (codigo_estudiante,id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)  VALUES ('99 - 30 - 1 - 3','99','30','1','3','25686','PASANTE');


--
-- Estrutura de la tabla 'pasantias.configuracion_solicitud'
--

CREATE TABLE pasantias.configuracion_solicitud (
table_column character varying NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.configuracion_solicitud'
--

INSERT INTO  pasantias.configuracion_solicitud (table_column,estatus)  VALUES ('especialidad.id_especialidad','ACTIVO');
INSERT INTO  pasantias.configuracion_solicitud (table_column,estatus)  VALUES ('estudiante.codigo_estudiante','ACTIVO');
INSERT INTO  pasantias.configuracion_solicitud (table_column,estatus)  VALUES ('organizacionmunicipio.codigo_sucursal','ACTIVO');
INSERT INTO  pasantias.configuracion_solicitud (table_column,estatus)  VALUES ('persona.id_persona','ACTIVO');
INSERT INTO  pasantias.configuracion_solicitud (table_column,estatus)  VALUES ('temporadas_solicitud.codigo_temporada','ACTIVO');
INSERT INTO  pasantias.configuracion_solicitud (table_column,estatus)  VALUES ('tutor_academico.codigo_tutor_academico','ACTIVO');
INSERT INTO  pasantias.configuracion_solicitud (table_column,estatus)  VALUES ('tutor_empresarial.codigo_tutor_empresarial','ACTIVO');


--
-- Estrutura de la tabla 'pasantias.temporadas_especialidad'
--

CREATE TABLE pasantias.temporadas_especialidad (
codigo_temporada_especialidad character varying NOT NULL DEFAULT 'nothing'::character varying,
codigo_temporada character varying NOT NULL,
id_especialidad bigint NOT NULL,
estatus character varying NOT NULL
);

--
-- Informacion de la tabla 'pasantias.temporadas_especialidad'
--

INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 27','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','27','EN ESPERA');
INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 30','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','30','EN ESPERA');
INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 31','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','31','EN ESPERA');
INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 33','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','33','EN ESPERA');
INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 35','1 - 9 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','35','EN ESPERA');
INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 29','2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','29','EN ESPERA');
INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 30','2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','30','EN ESPERA');
INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 34','2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','34','EN ESPERA');
INSERT INTO  pasantias.temporadas_especialidad (codigo_temporada_especialidad,codigo_temporada,id_especialidad,estatus)  VALUES ('2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6 - 35','2 - 10 - 308 - 1 - CALLE 32 FRENTE A FARMATODO - 87 - 22 - 6','35','EN ESPERA');


--
-- Estrutura de la tabla 'pasantias.persona_organizacion_oficina'
--

CREATE TABLE pasantias.persona_organizacion_oficina (
codigo_sucursal character varying NOT NULL,
id_persona bigint NOT NULL,
id_oficina bigint NOT NULL,
id_perfil integer NOT NULL,
estado character varying  NULL DEFAULT 'PENDIENTE'::character varying,
descripcion character varying NOT NULL DEFAULT 'NO DESCRIPCION'::character varying,
observacion character varying NOT NULL DEFAULT 'NO OBSERVACION'::character varying,
fecha_solicitud date  NULL,
fecha_aceptacion date  NULL,
id_responsable_asignacion bigint  NULL
);

--
-- Informacion de la tabla 'pasantias.persona_organizacion_oficina'
--

INSERT INTO  pasantias.persona_organizacion_oficina (codigo_sucursal,id_persona,id_oficina,id_perfil,estado,descripcion,observacion,fecha_solicitud)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO','87','22','6','APROBADO','ENCARGADA DE LAS PASANTIAS','NO OBSERVACION','2015-10-27');
INSERT INTO  pasantias.persona_organizacion_oficina (codigo_sucursal,id_persona,id_oficina,id_perfil,estado,observacion,fecha_solicitud)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO','108','22','6','APROBADO','NO OBSERVACION','2015-10-30');
INSERT INTO  pasantias.persona_organizacion_oficina (codigo_sucursal,id_persona,id_oficina,id_perfil,estado,descripcion,observacion,fecha_solicitud)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO','110','22','6','APROBADO','asdsadasosd','NO OBSERVACION','2015-12-25');
INSERT INTO  pasantias.persona_organizacion_oficina (codigo_sucursal,id_persona,id_oficina,id_perfil,estado,observacion,fecha_solicitud)  VALUES ('308 - 1 - CALLE 32 FRENTE A FARMATODO','114','22','6','APROBADO','NO OBSERVACION','2015-12-03');
INSERT INTO  pasantias.persona_organizacion_oficina (codigo_sucursal,id_persona,id_oficina,id_perfil,estado,descripcion,observacion,fecha_solicitud,fecha_aceptacion)  VALUES ('31 - 2 - asddd','110','23','2','APROBADO','asdasdas','NO OBSERVACION','2015-12-25','2015-12-25');
INSERT INTO  pasantias.persona_organizacion_oficina (codigo_sucursal,id_persona,id_oficina,id_perfil,estado,descripcion,observacion,fecha_solicitud,fecha_aceptacion)  VALUES ('31 - 2 - asddd','113','23','2','APROBADO','qweee','NO OBSERVACION','2015-11-24','2015-12-08');


--
-- Estrutura de la tabla 'pasantias.tutor_empresarial'
--

CREATE TABLE pasantias.tutor_empresarial (
codigo_tutor_empresarial character varying NOT NULL DEFAULT 'nothing'::character varying,
codigo_sucursal character varying NOT NULL,
id_persona bigint NOT NULL,
id_oficina bigint NOT NULL,
id_perfil integer NOT NULL
);

--
-- Informacion de la tabla 'pasantias.tutor_empresarial'
--



--
-- Estrutura de la tabla 'pasantias.usuario'
--

CREATE TABLE pasantias.usuario (
id_usuario integer NOT NULL,
usuario character varying NOT NULL,
contrasena character varying NOT NULL,
estatus character varying NOT NULL,
pregunta character varying  NULL,
respuesta character varying  NULL,
id_persona integer NOT NULL
);

--
-- Informacion de la tabla 'pasantias.usuario'
--

INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,id_persona)  VALUES ('33','123','123','PENDIENTE','114');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,id_persona)  VALUES ('28','acevedo','456456','PENDIENTE','94');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,pregunta,respuesta,id_persona)  VALUES ('36','asdasd','545454','PENDIENTE','Nombre de tu Primeira Novi@','asdaq','91');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,pregunta,respuesta,id_persona)  VALUES ('38','asdsdsdsd','655','PENDIENTE','Nombre de tus Abuelos','asdddddddd','110');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,id_persona)  VALUES ('3','EDINSON','123456','PENDIENTE','105');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,pregunta,respuesta,id_persona)  VALUES ('35','ESTUDIANTE','123456','PENDIENTE','Nombre de tus Abuelos','NINO','118');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,id_persona)  VALUES ('2','FARMATODO','123456','PENDIENTE','88');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,id_persona)  VALUES ('30','IUTY','123456','PENDIENTE','109');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,id_persona)  VALUES ('29','jesus','456455','PENDIENTE','108');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,pregunta,respuesta,id_persona)  VALUES ('32','lolpres','lollol','PENDIENTE','Nombre de tu Primeira Novi@','No vas a  saber','113');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,pregunta,respuesta,id_persona)  VALUES ('34','marcris','123456','PENDIENTE','Nombre de tus Abuelos','maitas','98');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,pregunta,respuesta,id_persona)  VALUES ('37','popope','popope','PENDIENTE','Nombre de tus Abuelos','popope','110');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,id_persona)  VALUES ('1','UPTABY','123456','APROBADO','87');
INSERT INTO  pasantias.usuario (id_usuario,usuario,contrasena,estatus,pregunta,respuesta,id_persona)  VALUES ('31','USERzcds','123456','PENDIENTE','Nombre de tu Primeira Novi@','ouououououououo','110');

--
CREATE SEQUENCE pasantias.usuario_id_usuario_seq
			  INCREMENT 1
			  MINVALUE  1
			  MAXVALUE  9223372036854775807
			  START 	39
			  CACHE 1;
--  Una Mentazon 00:10  17 Junio Fue Modificado 
ALTER TABLE pasantias.usuario ALTER COLUMN id_usuario SET DEFAULT nextval('pasantias.usuario_id_usuario_seq'::regclass);
--
-- Respaldando Mis Indexes XD 'pasantias.estado.uk_estado' 

--
 CREATE UNIQUE INDEX uk_estadob ON pasantias.estado USING btree (nombre_estado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacionmunicipio.organizacionmunicipioindex2' 

--
 CREATE INDEX organizacionmunicipioindex2 ON pasantias.organizacionmunicipio USING btree (id_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.requisito.uk_requis' 

--
 CREATE UNIQUE INDEX uk_requisb ON pasantias.requisito USING btree (nombre_requisito) ;
--
-- Respaldando Mis Indexes XD 'pasantias.periodo_solicitud.uk_periodosdex' 

--
 CREATE UNIQUE INDEX uk_periodosdex ON pasantias.periodo_solicitud USING btree (id_lapso, fecha_inicio, fecha_fin) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud.pk_solicituddex' 

--
 CREATE UNIQUE INDEX pk_solicituddex ON pasantias.solicitud USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion.pk_idor' 

--
 CREATE UNIQUE INDEX pk_idor ON pasantias.organizacion USING btree (id_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_aprobadas.solicitudes_aprobadasdex1' 

--
 CREATE INDEX solicitudes_aprobadasdex1 ON pasantias.solicitudes_aprobadas USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_enviadas.solicitudes_enviadasdex0' 

--
 CREATE INDEX solicitudes_enviadasdex0 ON pasantias.solicitudes_enviadas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable_temporada.dex_entregables_status' 

--
 CREATE INDEX dex_entregables_status ON pasantias.entregable_temporada USING btree (estatus_entregable) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_especialidad.tipo_eunic' 

--
 CREATE UNIQUE INDEX tipo_eunicb ON pasantias.tipo_especialidad USING btree (nombre_tipo_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.convenio_organizacion.convenio_organizacionindex' 

--
 CREATE INDEX convenio_organizacionindex ON pasantias.convenio_organizacion USING btree (id_ip, id_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.usuario.uk_usuario' 

--
 CREATE UNIQUE INDEX uk_usuariouniqueb ON pasantias.usuario USING btree (usuario) ;
--
-- Respaldando Mis Indexes XD 'pasantias.departamento.pk_idd' 

--
 CREATE UNIQUE INDEX pk_idd ON pasantias.departamento USING btree (id_departamento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.lapso_academico.lapsoa' 

--
 CREATE INDEX lapsoa ON pasantias.lapso_academico USING btree (ano_i, ano_f, numero_lapso) ;
--
-- Respaldando Mis Indexes XD 'pasantias.responsables.responsablesdex1' 

--
 CREATE INDEX responsablesdex1 ON pasantias.responsables USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.expedientestudents' 

--
 CREATE UNIQUE INDEX expedientestudents ON pasantias.estudiante USING btree (id_persona, id_especialidad, id_ip, id_perfil, expediente) ;
--
-- Respaldando Mis Indexes XD 'pasantias.lapso_academico.pk_idlapdex' 

--
 CREATE UNIQUE INDEX pk_idlapdex ON pasantias.lapso_academico USING btree (id_lapso) ;
--
-- Respaldando Mis Indexes XD 'pasantias.segmentos.segmentoscurri0' 

--
 CREATE INDEX segmentoscurri0 ON pasantias.segmentos USING btree (id_segmento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.usuario.uk_usuariodex' 

--
 CREATE UNIQUE INDEX uk_usuariodex ON pasantias.usuario USING btree (usuario) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.especialidadindexbos' 

--
 CREATE INDEX especialidadindexbos ON pasantias.especialidad USING btree (nombre_especialidad, id_departamento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.periodo_solicitud.perodosolicidex' 

--
 CREATE INDEX perodosolicidex ON pasantias.periodo_solicitud USING btree (fecha_inicio, fecha_fin, id_lapso) ;
--
-- Respaldando Mis Indexes XD 'pasantias.usuario.usuariologin' 

--
 CREATE INDEX usuariologin ON pasantias.usuario USING btree (usuario, contrasena) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_organizacion_oficina.personaorganizacionindex3' 

--
 CREATE INDEX personaorganizacionindex3 ON pasantias.persona_organizacion_oficina USING btree (codigo_sucursal) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.especialidadndexna' 

--
 CREATE INDEX especialidadndexna ON pasantias.especialidad USING btree (nombre_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado_tipo_solicitud.encargado_tipo_solicituddex3' 

--
 CREATE INDEX encargado_tipo_solicituddex3 ON pasantias.encargado_tipo_solicitud USING btree (id_tipo_solicitud, codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_instituto_especialidad.pk_idpersonespecialidaddex' 

--
 CREATE UNIQUE INDEX pk_idpersonespecialidaddex ON pasantias.persona_instituto_especialidad USING btree (id_persona, id_especialidad, id_ip, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_enviadas.solicitudes_enviadasdex3' 

--
 CREATE INDEX solicitudes_enviadasdex3 ON pasantias.solicitudes_enviadas USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estado.primary_estaddex' 

--
 CREATE UNIQUE INDEX primary_estaddex ON pasantias.estado USING btree (id_estado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion.organizationindex' 

--
 CREATE INDEX organizationindex ON pasantias.organizacion USING btree (rif, id_tipo_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.responsables.pk_responsablesdex' 

--
 CREATE UNIQUE INDEX pk_responsablesdex ON pasantias.responsables USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado_tipo_solicitud.encargado_tipo_solicituddex2' 

--
 CREATE INDEX encargado_tipo_solicituddex2 ON pasantias.encargado_tipo_solicitud USING btree (codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.municipio.primari_munucupoidex' 

--
 CREATE UNIQUE INDEX primari_munucupoidex ON pasantias.municipio USING btree (id_municipio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.oficina.uk_iddepart' 

--
 CREATE UNIQUE INDEX uk_iddepartb ON pasantias.oficina USING btree (id_departamento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu.submenundex' 

--
 CREATE INDEX submenundex ON pasantias.submenu USING btree (id_submenu, ruta_submenu, nombre_submenu, id_funcion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_instituto_especialidad.persona_especialidadindex2' 

--
 CREATE INDEX persona_especialidadindex2 ON pasantias.persona_instituto_especialidad USING btree (id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.convenio_organizacion.convenio_organizacionindex3dex' 

--
 CREATE INDEX convenio_organizacionindex3dex ON pasantias.convenio_organizacion USING btree (id_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud.pk_solicitud' 

--
 CREATE UNIQUE INDEX pk_solicitud ON pasantias.solicitud USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad_instituto_principal.pk_especialidad_instituto_principaldex' 

--
 CREATE UNIQUE INDEX pk_especialidad_instituto_principaldex ON pasantias.especialidad_instituto_principal USING btree (id_ip, id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_aprobadas.pk_solicitudes_aprobadas' 

--
 CREATE UNIQUE INDEX pk_solicitudes_aprobadas ON pasantias.solicitudes_aprobadas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiantes_entregables.pk_id_estudiantes_entregables' 

--
 CREATE UNIQUE INDEX pk_id_estudiantes_entregables ON pasantias.estudiantes_entregables USING btree (id_estudiantes_entregables) ;
--
-- Respaldando Mis Indexes XD 'pasantias.oficina.uk_iddepartdex' 

--
 CREATE UNIQUE INDEX uk_iddepartdex ON pasantias.oficina USING btree (id_departamento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_enviadas.pk_solicitudes_enviadasdex' 

--
 CREATE UNIQUE INDEX pk_solicitudes_enviadasdex ON pasantias.solicitudes_enviadas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.publicacion.publicacionindex1' 

--
 CREATE INDEX publicacionindex1 ON pasantias.publicacion USING btree (id_publicacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_estudiantes.temporadas_estudiantesdex1' 

--
 CREATE INDEX temporadas_estudiantesdex1 ON pasantias.temporadas_estudiantes USING btree (codigo_estudiante) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable_temporada.pk_entregables_asignados' 

--
 CREATE UNIQUE INDEX pk_entregables_asignados ON pasantias.entregable_temporada USING btree (codigo_temporada, id_entregable) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_especialidad.tempoespecialidadtemp3' 

--
 CREATE INDEX tempoespecialidadtemp3 ON pasantias.temporadas_especialidad USING btree (codigo_temporada) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad_instituto_principal.pk_especialidad_instituto_principal' 

--
 CREATE UNIQUE INDEX pk_especialidad_instituto_principal ON pasantias.especialidad_instituto_principal USING btree (id_ip, id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu.pk_submenudex' 

--
 CREATE UNIQUE INDEX pk_submenudex ON pasantias.submenu USING btree (id_submenu) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_aprobadas.solicitudes_aprobadasdex3' 

--
 CREATE INDEX solicitudes_aprobadasdex3 ON pasantias.solicitudes_aprobadas USING btree (fecha_aprobacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.curriculum.pk_curriculumdex' 

--
 CREATE UNIQUE INDEX pk_curriculumdex ON pasantias.curriculum USING btree (id_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.convenio_organizacion.convenio_organizacionindex2dex' 

--
 CREATE INDEX convenio_organizacionindex2dex ON pasantias.convenio_organizacion USING btree (id_ip) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.pk_idedex' 

--
 CREATE UNIQUE INDEX pk_idedex ON pasantias.especialidad USING btree (id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_solicitud.pk_ids' 

--
 CREATE UNIQUE INDEX pk_ids ON pasantias.tipo_solicitud USING btree (id_tipo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.configuracion_solicitud.configuracion_solicituddex' 

--
 CREATE INDEX configuracion_solicituddex ON pasantias.configuracion_solicitud USING btree (table_column) ;
--
-- Respaldando Mis Indexes XD 'pasantias.instituto_principal.pk_idip' 

--
 CREATE UNIQUE INDEX pk_idip ON pasantias.instituto_principal USING btree (id_ip) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.temporadadex0' 

--
 CREATE INDEX temporadadex0 ON pasantias.temporadas_solicitud USING btree (id_tipo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.pk_estudiante_nobadis' 

--
 CREATE UNIQUE INDEX pk_estudiante_nobadis ON pasantias.estudiante USING btree (codigo_estudiante) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estado.uk_estadodex' 

--
 CREATE UNIQUE INDEX uk_estadodex ON pasantias.estado USING btree (nombre_estado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estado.primary_estad' 

--
 CREATE UNIQUE INDEX primary_estad ON pasantias.estado USING btree (id_estado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud_requisito.fki_soliciturestutores_responsables_estudiante4s' 

--
 CREATE INDEX fki_soliciturestutores_responsables_estudiante4s ON pasantias.solicitud_requisito USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.datos_extra.datos_extradex3dex' 

--
 CREATE INDEX datos_extradex3dex ON pasantias.datos_extra USING btree (id_extra_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion.uk_rif_organizacion' 

--
 CREATE UNIQUE INDEX uk_rif_organizacionb ON pasantias.organizacion USING btree (rif) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado_tipo_solicitud.pk_encargado_tipossdex' 

--
 CREATE UNIQUE INDEX pk_encargado_tipossdex ON pasantias.encargado_tipo_solicitud USING btree (id_tipo_solicitud, codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud_requisito.solicitud_requisitodex4' 

--
 CREATE INDEX solicitud_requisitodex4 ON pasantias.solicitud_requisito USING btree (id_requisito, codigo_solicitud, estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_organizacion.uk_nyrdex' 

--
 CREATE UNIQUE INDEX uk_nyrdex ON pasantias.tipo_organizacion USING btree (nombre_tipo_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.oficina.oficina_nomdex' 

--
 CREATE INDEX oficina_nomdex ON pasantias.oficina USING btree (nombre_oficina) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.temporadadex3' 

--
 CREATE INDEX temporadadex3 ON pasantias.temporadas_solicitud USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estado.estaddex' 

--
 CREATE INDEX estaddex ON pasantias.estado USING btree (id_estado, nombre_estado, codigo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estado.uk_estadocode' 

--
 CREATE UNIQUE INDEX uk_estadocodeb ON pasantias.estado USING btree (codigo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion_oficina.organizacion_oficinaindex' 

--
 CREATE INDEX organizacion_oficinaindex ON pasantias.organizacion_oficina USING btree (id_oficina, codigo_sucursal) ;
--
-- Respaldando Mis Indexes XD 'pasantias.curriculum.pk_curriculum' 

--
 CREATE UNIQUE INDEX pk_curriculum ON pasantias.curriculum USING btree (id_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.segmentos.pk_segmentosserialdex' 

--
 CREATE UNIQUE INDEX pk_segmentosserialdex ON pasantias.segmentos USING btree (id_segmento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.perfil.pk_perfil' 

--
 CREATE UNIQUE INDEX pk_perfil ON pasantias.perfil USING btree (id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion_oficina.pk_id_organizacionficina' 

--
 CREATE UNIQUE INDEX pk_id_organizacionficina ON pasantias.organizacion_oficina USING btree (id_oficina, codigo_sucursal) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.especialidadndexid1' 

--
 CREATE INDEX especialidadndexid1 ON pasantias.especialidad USING btree (id_tipo_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_empresarial.tuto_empresarialindex1' 

--
 CREATE INDEX tuto_empresarialindex1 ON pasantias.tutor_empresarial USING btree (codigo_tutor_empresarial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad_instituto_principal.especialidad_institutfk1' 

--
 CREATE INDEX especialidad_institutfk1 ON pasantias.especialidad_instituto_principal USING btree (id_ip) ;
--
-- Respaldando Mis Indexes XD 'pasantias.extra_curriculum.pk_extracurri' 

--
 CREATE UNIQUE INDEX pk_extracurri ON pasantias.extra_curriculum USING btree (id_extra_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado_tipo_solicitud.pk_encargado_tiposs' 

--
 CREATE UNIQUE INDEX pk_encargado_tiposs ON pasantias.encargado_tipo_solicitud USING btree (id_tipo_solicitud, codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.instituto_principal.instituto_principalpk' 

--
 CREATE INDEX instituto_principalpk ON pasantias.instituto_principal USING btree (id_ip) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu.pk_submenu' 

--
 CREATE UNIQUE INDEX pk_submenu ON pasantias.submenu USING btree (id_submenu) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.uk_temporadasolicitud' 

--
 CREATE UNIQUE INDEX uk_temporadasolicitudb ON pasantias.temporadas_solicitud USING btree (id_tipo_solicitud, id_periodo, codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_academico.uk_tutor_foreig_academicodex' 

--
 CREATE UNIQUE INDEX uk_tutor_foreig_academicodex ON pasantias.tutor_academico USING btree (id_persona, id_especialidad, id_ip, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable.unique_treintdate' 

--
 CREATE UNIQUE INDEX unique_treintdate ON pasantias.entregable USING btree (nombre_entregable) ;
--
-- Respaldando Mis Indexes XD 'pasantias.responsables.responsablesdex2' 

--
 CREATE INDEX responsablesdex2 ON pasantias.responsables USING btree (table_column) ;
--
-- Respaldando Mis Indexes XD 'pasantias.funcion.functiondex2' 

--
 CREATE INDEX functiondex2 ON pasantias.funcion USING btree (id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.curriculum_experiencia_laboral.pk_experiencialaboral' 

--
 CREATE UNIQUE INDEX pk_experiencialaboral ON pasantias.curriculum_experiencia_laboral USING btree (id_experiencia) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_academico.tutoracademicoidex1' 

--
 CREATE INDEX tutoracademicoidex1 ON pasantias.tutor_academico USING btree (codigo_tutor_academico) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.bitacoraindex0' 

--
 CREATE INDEX bitacoraindex0 ON pasantias.bitacora USING btree (id_bitacora, id_usuario, fecha) ;
--
-- Respaldando Mis Indexes XD 'pasantias.departamento.departamentodex' 

--
 CREATE INDEX departamentodex ON pasantias.departamento USING btree (id_departamento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.uk_correopdex' 

--
 CREATE UNIQUE INDEX uk_correopdex ON pasantias.persona USING btree (correo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable.pk_entregable' 

--
 CREATE UNIQUE INDEX pk_entregable ON pasantias.entregable USING btree (id_entregable) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_empresarial.uk_tuto_empresarialdex' 

--
 CREATE UNIQUE INDEX uk_tuto_empresarialdex ON pasantias.tutor_empresarial USING btree (codigo_sucursal, id_persona, id_oficina, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.requisito.requestdex' 

--
 CREATE INDEX requestdex ON pasantias.requisito USING btree (nombre_requisito) ;
--
-- Respaldando Mis Indexes XD 'pasantias.funcion.pk_funciondex' 

--
 CREATE UNIQUE INDEX pk_funciondex ON pasantias.funcion USING btree (id_funcion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_especialidad.tipo_eunicdex' 

--
 CREATE UNIQUE INDEX tipo_eunicdex ON pasantias.tipo_especialidad USING btree (nombre_tipo_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado.pk_idencargado' 

--
 CREATE UNIQUE INDEX pk_idencargado ON pasantias.encargado USING btree (codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.bitacoraindex1' 

--
 CREATE INDEX bitacoraindex1 ON pasantias.bitacora USING btree (id_bitacora) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu2.pk_submenu2dex' 

--
 CREATE UNIQUE INDEX pk_submenu2dex ON pasantias.submenu2 USING btree (id_submenu2) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.studentsco' 

--
 CREATE INDEX studentsco ON pasantias.estudiante USING btree (codigo_estudiante) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_especialidad.tipo_espedex' 

--
 CREATE INDEX tipo_espedex ON pasantias.tipo_especialidad USING btree (id_tipo_especialidad, nombre_tipo_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacionmunicipio.organizacionmunicipioindex1' 

--
 CREATE INDEX organizacionmunicipioindex1 ON pasantias.organizacionmunicipio USING btree (id_municipio, id_organizacion, domicilio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_empresarial.pk_tutor_empresarial' 

--
 CREATE UNIQUE INDEX pk_tutor_empresarial ON pasantias.tutor_empresarial USING btree (codigo_tutor_empresarial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable.dex_entregable_master_boss' 

--
 CREATE INDEX dex_entregable_master_boss ON pasantias.entregable USING btree (id_entregable, nombre_entregable) ;
--
-- Respaldando Mis Indexes XD 'pasantias.municipio.uk_idsmdex' 

--
 CREATE UNIQUE INDEX uk_idsmdex ON pasantias.municipio USING btree (id_estado, nombre_municipio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu2.submenu2ndex2' 

--
 CREATE INDEX submenu2ndex2 ON pasantias.submenu2 USING btree (id_submenu2) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.bitacoraindex2' 

--
 CREATE INDEX bitacoraindex2 ON pasantias.bitacora USING btree (id_usuario) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_solicitud.tipo_solicitud_dex' 

--
 CREATE INDEX tipo_solicitud_dex ON pasantias.tipo_solicitud USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.funcion.functiondex1' 

--
 CREATE INDEX functiondex1 ON pasantias.funcion USING btree (ruta_funcion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.publicacion.publicacionindex3' 

--
 CREATE INDEX publicacionindex3 ON pasantias.publicacion USING btree (fecha) ;
--
-- Respaldando Mis Indexes XD 'pasantias.periodo_solicitud.uk_periodos' 

--
 CREATE UNIQUE INDEX uk_periodosb ON pasantias.periodo_solicitud USING btree (id_lapso, fecha_inicio, fecha_fin) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_recibidas.pk_solicitudes_recibidasdex' 

--
 CREATE UNIQUE INDEX pk_solicitudes_recibidasdex ON pasantias.solicitudes_recibidas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud_requisito.solicitud_requisitodex2' 

--
 CREATE INDEX solicitud_requisitodex2 ON pasantias.solicitud_requisito USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable_temporada.dex_temporadas_asignados' 

--
 CREATE INDEX dex_temporadas_asignados ON pasantias.entregable_temporada USING btree (id_entregable) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_especialidad.pk_temporadaespecialidaddex' 

--
 CREATE UNIQUE INDEX pk_temporadaespecialidaddex ON pasantias.temporadas_especialidad USING btree (codigo_temporada_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.publicacion.pk_id_publicaciondex' 

--
 CREATE UNIQUE INDEX pk_id_publicaciondex ON pasantias.publicacion USING btree (id_publicacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.datos_extra.datos_extradex2dex' 

--
 CREATE INDEX datos_extradex2dex ON pasantias.datos_extra USING btree (id_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.personaindex' 

--
 CREATE INDEX personaindex ON pasantias.persona USING btree (cedula) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.uk_id' 

--
 CREATE UNIQUE INDEX uk_idb ON pasantias.especialidad USING btree (id_departamento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_especialidad.tempoespecialidaddual1' 

--
 CREATE INDEX tempoespecialidaddual1 ON pasantias.temporadas_especialidad USING btree (codigo_temporada, id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud.solicitudcodec1' 

--
 CREATE INDEX solicitudcodec1 ON pasantias.solicitud USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_enviadas.solicitudes_enviadasdex2' 

--
 CREATE INDEX solicitudes_enviadasdex2 ON pasantias.solicitudes_enviadas USING btree (table_column) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_enviadas.pk_solicitudes_enviadas' 

--
 CREATE UNIQUE INDEX pk_solicitudes_enviadas ON pasantias.solicitudes_enviadas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable.dex_entregable_date' 

--
 CREATE INDEX dex_entregable_date ON pasantias.entregable USING btree (fecha_registro) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_aprobadas.solicitudes_aprobadasdex0' 

--
 CREATE INDEX solicitudes_aprobadasdex0 ON pasantias.solicitudes_aprobadas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.uk_estudiante_temporada' 

--
 CREATE UNIQUE INDEX uk_estudiante_temporadab ON pasantias.estudiante USING btree (id_persona, id_especialidad, id_ip, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.instituto_principal.pk_idipdex' 

--
 CREATE UNIQUE INDEX pk_idipdex ON pasantias.instituto_principal USING btree (id_ip) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_instituto_especialidad.persona_especialidadindex1' 

--
 CREATE INDEX persona_especialidadindex1 ON pasantias.persona_instituto_especialidad USING btree (id_persona) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.personaindex2' 

--
 CREATE INDEX personaindex2 ON pasantias.persona USING btree (cedula, nombre, apellido) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud.solicitudtatusdex' 

--
 CREATE INDEX solicitudtatusdex ON pasantias.solicitud USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacionmunicipio.organizacionmunicipioindex3' 

--
 CREATE INDEX organizacionmunicipioindex3 ON pasantias.organizacionmunicipio USING btree (id_municipio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.periodo_solicitud.pk_perid' 

--
 CREATE UNIQUE INDEX pk_perid ON pasantias.periodo_solicitud USING btree (id_periodo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_academico.tutoracademicoidex4' 

--
 CREATE INDEX tutoracademicoidex4 ON pasantias.tutor_academico USING btree (id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.pk_bitacoradex' 

--
 CREATE UNIQUE INDEX pk_bitacoradex ON pasantias.bitacora USING btree (id_bitacora) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.uk_estudiante_temporadadex' 

--
 CREATE UNIQUE INDEX uk_estudiante_temporadadex ON pasantias.estudiante USING btree (id_persona, id_especialidad, id_ip, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu.submenundex1' 

--
 CREATE INDEX submenundex1 ON pasantias.submenu USING btree (ruta_submenu) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_solicitud.uk_tiposolicitud' 

--
 CREATE UNIQUE INDEX uk_tiposolicitudb ON pasantias.tipo_solicitud USING btree (nombre_tipo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.bitacoraindex6' 

--
 CREATE INDEX bitacoraindex6 ON pasantias.bitacora USING btree (nombre_tabla) ;
--
-- Respaldando Mis Indexes XD 'pasantias.oficina.oficinadexdex' 

--
 CREATE INDEX oficinadexdex ON pasantias.oficina USING btree (id_departamento, nombre_oficina) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_instituto_especialidad.persona_especialidadindex0' 

--
 CREATE INDEX persona_especialidadindex0 ON pasantias.persona_instituto_especialidad USING btree (id_persona, id_especialidad, id_ip) ;
--
-- Respaldando Mis Indexes XD 'pasantias.usuario.pk_usuariodex' 

--
 CREATE UNIQUE INDEX pk_usuariodex ON pasantias.usuario USING btree (id_usuario) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable.dex_entregable_masterid' 

--
 CREATE INDEX dex_entregable_masterid ON pasantias.entregable USING btree (id_entregable) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_organizacion_oficina.pk_idpersonoficina' 

--
 CREATE UNIQUE INDEX pk_idpersonoficina ON pasantias.persona_organizacion_oficina USING btree (codigo_sucursal, id_persona, id_oficina, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.municipio.miunicipiosiplex' 

--
 CREATE INDEX miunicipiosiplex ON pasantias.municipio USING btree (nombre_municipio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_academico.tutoracademicoidex2' 

--
 CREATE INDEX tutoracademicoidex2 ON pasantias.tutor_academico USING btree (id_persona, id_especialidad, id_ip, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_recibidas.solicitudes_recibidasdex0' 

--
 CREATE INDEX solicitudes_recibidasdex0 ON pasantias.solicitudes_recibidas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_organizacion.uk_nyr' 

--
 CREATE UNIQUE INDEX uk_nyrb ON pasantias.tipo_organizacion USING btree (nombre_tipo_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_especialidad.pk_idt' 

--
 CREATE UNIQUE INDEX pk_idt ON pasantias.tipo_especialidad USING btree (id_tipo_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.datos_extra.pk_datosextradex' 

--
 CREATE UNIQUE INDEX pk_datosextradex ON pasantias.datos_extra USING btree (id_curriculum, id_segmento, id_extra_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.especialidadndexid' 

--
 CREATE INDEX especialidadndexid ON pasantias.especialidad USING btree (id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu.submenundex3' 

--
 CREATE INDEX submenundex3 ON pasantias.submenu USING btree (nombre_submenu) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion_oficina.organizacion_oficinaindex1' 

--
 CREATE INDEX organizacion_oficinaindex1 ON pasantias.organizacion_oficina USING btree (codigo_sucursal) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_enviadas.solicitudes_enviadasdex1' 

--
 CREATE INDEX solicitudes_enviadasdex1 ON pasantias.solicitudes_enviadas USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_academico.tutoracademicoidex3' 

--
 CREATE INDEX tutoracademicoidex3 ON pasantias.tutor_academico USING btree (id_persona) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.students' 

--
 CREATE INDEX students ON pasantias.estudiante USING btree (expediente) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_aprobadas.pk_solicitudes_aprobadasdex' 

--
 CREATE UNIQUE INDEX pk_solicitudes_aprobadasdex ON pasantias.solicitudes_aprobadas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu2.submenu2ndex1' 

--
 CREATE INDEX submenu2ndex1 ON pasantias.submenu2 USING btree (ruta_submenu2) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable_temporada.dex_entregables_asignados' 

--
 CREATE INDEX dex_entregables_asignados ON pasantias.entregable_temporada USING btree (codigo_temporada) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estado.statedex' 

--
 CREATE INDEX statedex ON pasantias.estado USING btree (nombre_estado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_solicitud.uk_tiposolicituddex' 

--
 CREATE UNIQUE INDEX uk_tiposolicituddex ON pasantias.tipo_solicitud USING btree (nombre_tipo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.personaindex1' 

--
 CREATE INDEX personaindex1 ON pasantias.persona USING btree (id_persona) ;
--
-- Respaldando Mis Indexes XD 'pasantias.municipio.uk_idsm' 

--
 CREATE UNIQUE INDEX uk_idsmb ON pasantias.municipio USING btree (id_estado, nombre_municipio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.municipio.primari_munucupoi' 

--
 CREATE UNIQUE INDEX primari_munucupoi ON pasantias.municipio USING btree (id_municipio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_especialidad.fki_temporada_solicitud' 

--
 CREATE INDEX fki_temporada_solicitud ON pasantias.temporadas_especialidad USING btree (codigo_temporada) ;
--
-- Respaldando Mis Indexes XD 'pasantias.oficina.uk_oficinadex' 

--
 CREATE UNIQUE INDEX uk_oficinadex ON pasantias.oficina USING btree (nombre_oficina) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado_tipo_solicitud.encargado_tipo_solicituddex' 

--
 CREATE INDEX encargado_tipo_solicituddex ON pasantias.encargado_tipo_solicitud USING btree (id_tipo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.lapso_academico.pk_idlap' 

--
 CREATE UNIQUE INDEX pk_idlap ON pasantias.lapso_academico USING btree (id_lapso) ;
--
-- Respaldando Mis Indexes XD 'pasantias.datos_extra.datos_extradex5dex' 

--
 CREATE INDEX datos_extradex5dex ON pasantias.datos_extra USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_organizacion.tipo_organizaciondex' 

--
 CREATE INDEX tipo_organizaciondex ON pasantias.tipo_organizacion USING btree (nombre_tipo_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.temporadadex2' 

--
 CREATE INDEX temporadadex2 ON pasantias.temporadas_solicitud USING btree (codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.uk_especialidad' 

--
 CREATE UNIQUE INDEX uk_especialidadb ON pasantias.especialidad USING btree (nombre_especialidad, id_tipo_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.perfil.perfilnamedex' 

--
 CREATE INDEX perfilnamedex ON pasantias.perfil USING btree (nombre_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_academico.uk_tutor_foreig_academico' 

--
 CREATE UNIQUE INDEX uk_tutor_foreig_academicob ON pasantias.tutor_academico USING btree (id_persona, id_especialidad, id_ip, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_estudiantes.pk_temporadas_estudiantesdex' 

--
 CREATE UNIQUE INDEX pk_temporadas_estudiantesdex ON pasantias.temporadas_estudiantes USING btree (codigo_temporada_especialidad, codigo_estudiante) ;
--
-- Respaldando Mis Indexes XD 'pasantias.extra_curriculum.extracurri0' 

--
 CREATE INDEX extracurri0 ON pasantias.extra_curriculum USING btree (id_extra_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud_requisito.pk_solicitudrequisitodex' 

--
 CREATE UNIQUE INDEX pk_solicitudrequisitodex ON pasantias.solicitud_requisito USING btree (id_requisito, codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.funcion.pk_funcion' 

--
 CREATE UNIQUE INDEX pk_funcion ON pasantias.funcion USING btree (id_funcion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad_instituto_principal.esecialidad_institutopk' 

--
 CREATE INDEX esecialidad_institutopk ON pasantias.especialidad_instituto_principal USING btree (id_ip, id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.perfil.pk_perfildex' 

--
 CREATE UNIQUE INDEX pk_perfildex ON pasantias.perfil USING btree (id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu2.pk_submenu2' 

--
 CREATE UNIQUE INDEX pk_submenu2 ON pasantias.submenu2 USING btree (id_submenu2) ;
--
-- Respaldando Mis Indexes XD 'pasantias.segmentos.pk_segmentosserial' 

--
 CREATE UNIQUE INDEX pk_segmentosserial ON pasantias.segmentos USING btree (id_segmento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.datos_extra.pk_datosextra' 

--
 CREATE UNIQUE INDEX pk_datosextra ON pasantias.datos_extra USING btree (id_curriculum, id_segmento, id_extra_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacionmunicipio.uk_organizacionmunicipio' 

--
 CREATE UNIQUE INDEX uk_organizacionmunicipiob ON pasantias.organizacionmunicipio USING btree (id_municipio, id_organizacion, domicilio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.curriculum_formacion_academica.pk_formacion_academica' 

--
 CREATE UNIQUE INDEX pk_formacion_academica ON pasantias.curriculum_formacion_academica USING btree (id_formacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.temporadadexall' 

--
 CREATE INDEX temporadadexall ON pasantias.temporadas_solicitud USING btree (codigo_temporada, id_tipo_solicitud, id_periodo, codigo_encargado, estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.bitacoraindex5' 

--
 CREATE INDEX bitacoraindex5 ON pasantias.bitacora USING btree (fecha, hora) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado.pk_idencargadodex' 

--
 CREATE UNIQUE INDEX pk_idencargadodex ON pasantias.encargado USING btree (codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_recibidas.solicitudes_recibidasdex3' 

--
 CREATE INDEX solicitudes_recibidasdex3 ON pasantias.solicitudes_recibidas USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.expedientestudentsdex' 

--
 CREATE UNIQUE INDEX expedientestudentsdex ON pasantias.estudiante USING btree (id_persona, id_especialidad, id_ip, id_perfil, expediente) ;
--
-- Respaldando Mis Indexes XD 'pasantias.publicacion.publicacionindex2' 

--
 CREATE INDEX publicacionindex2 ON pasantias.publicacion USING btree (id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.funcion.functiondex0' 

--
 CREATE INDEX functiondex0 ON pasantias.funcion USING btree (id_funcion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.lapso_academico.lapsoacade' 

--
 CREATE INDEX lapsoacade ON pasantias.lapso_academico USING btree (id_lapso) ;
--
-- Respaldando Mis Indexes XD 'pasantias.requisito.uk_requisdex' 

--
 CREATE UNIQUE INDEX uk_requisdex ON pasantias.requisito USING btree (nombre_requisito) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_aprobadas.solicitudes_aprobadasdex2' 

--
 CREATE INDEX solicitudes_aprobadasdex2 ON pasantias.solicitudes_aprobadas USING btree (table_column) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_recibidas.solicitudes_recibidasdex1' 

--
 CREATE INDEX solicitudes_recibidasdex1 ON pasantias.solicitudes_recibidas USING btree (codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion_oficina.pk_id_organizacionficinadex' 

--
 CREATE UNIQUE INDEX pk_id_organizacionficinadex ON pasantias.organizacion_oficina USING btree (id_oficina, codigo_sucursal) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacionmunicipio.pk_organizacionmunicipiodex' 

--
 CREATE UNIQUE INDEX pk_organizacionmunicipiodex ON pasantias.organizacionmunicipio USING btree (codigo_sucursal) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_instituto_especialidad.persona_especialidadindex3' 

--
 CREATE INDEX persona_especialidadindex3 ON pasantias.persona_instituto_especialidad USING btree (id_ip) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.uk_temporadasolicituddex' 

--
 CREATE UNIQUE INDEX uk_temporadasolicituddex ON pasantias.temporadas_solicitud USING btree (id_tipo_solicitud, id_periodo, codigo_encargado) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_especialidad.tempoespecialidadespe2' 

--
 CREATE INDEX tempoespecialidadespe2 ON pasantias.temporadas_especialidad USING btree (id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.responsables.responsablesdex3' 

--
 CREATE INDEX responsablesdex3 ON pasantias.responsables USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_especialidad.pk_idtdex' 

--
 CREATE UNIQUE INDEX pk_idtdex ON pasantias.tipo_especialidad USING btree (id_tipo_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacionmunicipio.uk_organizacionmunicipiodex' 

--
 CREATE UNIQUE INDEX uk_organizacionmunicipiodex ON pasantias.organizacionmunicipio USING btree (id_municipio, id_organizacion, domicilio) ;
--
-- Respaldando Mis Indexes XD 'pasantias.usuario.usuarioindex' 

--
 CREATE INDEX usuarioindex ON pasantias.usuario USING btree (id_persona) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad_instituto_principal.especialidad_institutfk2' 

--
 CREATE INDEX especialidad_institutfk2 ON pasantias.especialidad_instituto_principal USING btree (id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.usuario.usuarioin' 

--
 CREATE INDEX usuarioin ON pasantias.usuario USING btree (id_usuario) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estado.uk_estadocodedex' 

--
 CREATE UNIQUE INDEX uk_estadocodedex ON pasantias.estado USING btree (codigo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.uk_iddex' 

--
 CREATE UNIQUE INDEX uk_iddex ON pasantias.especialidad USING btree (id_departamento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.curriculum_formacion_academica.pk_formacion_academicadex' 

--
 CREATE UNIQUE INDEX pk_formacion_academicadex ON pasantias.curriculum_formacion_academica USING btree (id_formacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_recibidas.pk_solicitudes_recibidas' 

--
 CREATE UNIQUE INDEX pk_solicitudes_recibidas ON pasantias.solicitudes_recibidas USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.convenio_organizacion.pk_organizacionprincipaldex' 

--
 CREATE UNIQUE INDEX pk_organizacionprincipaldex ON pasantias.convenio_organizacion USING btree (id_ip, id_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.lapso_academico.lapsoacademico' 

--
 CREATE INDEX lapsoacademico ON pasantias.lapso_academico USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.lapso_academico.uk_lapso' 

--
 CREATE UNIQUE INDEX uk_lapsob ON pasantias.lapso_academico USING btree (ano_f, ano_i, numero_lapso) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud_requisito.solicitud_requisitodex1' 

--
 CREATE INDEX solicitud_requisitodex1 ON pasantias.solicitud_requisito USING btree (id_requisito) ;
--
-- Respaldando Mis Indexes XD 'pasantias.requisito.pk_idr' 

--
 CREATE UNIQUE INDEX pk_idr ON pasantias.requisito USING btree (id_requisito) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_solicitud.pk_idsdex' 

--
 CREATE UNIQUE INDEX pk_idsdex ON pasantias.tipo_solicitud USING btree (id_tipo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.segmentos.segmentoscurri1' 

--
 CREATE INDEX segmentoscurri1 ON pasantias.segmentos USING btree (subdivision) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_academico.pk_tutor_academicodex' 

--
 CREATE UNIQUE INDEX pk_tutor_academicodex ON pasantias.tutor_academico USING btree (codigo_tutor_academico) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.bitacoraindex4' 

--
 CREATE INDEX bitacoraindex4 ON pasantias.bitacora USING btree (hora) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_organizacion_oficina.pk_idpersonoficinadex' 

--
 CREATE UNIQUE INDEX pk_idpersonoficinadex ON pasantias.persona_organizacion_oficina USING btree (codigo_sucursal, id_persona, id_oficina, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.requisito.pk_idrdex' 

--
 CREATE UNIQUE INDEX pk_idrdex ON pasantias.requisito USING btree (id_requisito) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_especialidad.pk_temporadaespecialidad' 

--
 CREATE UNIQUE INDEX pk_temporadaespecialidad ON pasantias.temporadas_especialidad USING btree (codigo_temporada_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion.uk_rif_organizaciondex' 

--
 CREATE UNIQUE INDEX uk_rif_organizaciondex ON pasantias.organizacion USING btree (rif) ;
--
-- Respaldando Mis Indexes XD 'pasantias.publicacion.publicacionindex0' 

--
 CREATE INDEX publicacionindex0 ON pasantias.publicacion USING btree (id_publicacion, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.extra_curriculum.extracurri1' 

--
 CREATE INDEX extracurri1 ON pasantias.extra_curriculum USING btree (descripcion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.oficina.pk_idodex' 

--
 CREATE UNIQUE INDEX pk_idodex ON pasantias.oficina USING btree (id_oficina) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.temporada' 

--
 CREATE INDEX temporada ON pasantias.temporadas_solicitud USING btree (codigo_temporada) ;
--
-- Respaldando Mis Indexes XD 'pasantias.datos_extra.datos_extradex6dex' 

--
 CREATE INDEX datos_extradex6dex ON pasantias.datos_extra USING btree (id_segmento, id_curriculum, id_extra_curriculum, estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.convenio_organizacion.pk_organizacionprincipal' 

--
 CREATE UNIQUE INDEX pk_organizacionprincipal ON pasantias.convenio_organizacion USING btree (id_ip, id_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.oficina.pk_ido' 

--
 CREATE UNIQUE INDEX pk_ido ON pasantias.oficina USING btree (id_oficina) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.pk_persona' 

--
 CREATE UNIQUE INDEX pk_persona ON pasantias.persona USING btree (id_persona) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.pk_ide' 

--
 CREATE UNIQUE INDEX pk_ide ON pasantias.especialidad USING btree (id_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.pk_temporadassolicitud' 

--
 CREATE UNIQUE INDEX pk_temporadassolicitud ON pasantias.temporadas_solicitud USING btree (codigo_temporada) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu.submenundex0' 

--
 CREATE INDEX submenundex0 ON pasantias.submenu USING btree (id_submenu) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_empresarial.uk_tuto_empresarial' 

--
 CREATE UNIQUE INDEX uk_tuto_empresarialb ON pasantias.tutor_empresarial USING btree (codigo_sucursal, id_persona, id_oficina, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.curriculum_experiencia_laboral.pk_experiencialaboraldex' 

--
 CREATE UNIQUE INDEX pk_experiencialaboraldex ON pasantias.curriculum_experiencia_laboral USING btree (id_experiencia) ;
--
-- Respaldando Mis Indexes XD 'pasantias.usuario.pk_usuario' 

--
 CREATE UNIQUE INDEX pk_usuario ON pasantias.usuario USING btree (id_usuario) ;
--
-- Respaldando Mis Indexes XD 'pasantias.responsables.pk_responsables' 

--
 CREATE UNIQUE INDEX pk_responsables ON pasantias.responsables USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.periodo_solicitud.pk_periddex' 

--
 CREATE UNIQUE INDEX pk_periddex ON pasantias.periodo_solicitud USING btree (id_periodo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.uk_persona' 

--
 CREATE UNIQUE INDEX uk_personab ON pasantias.persona USING btree (cedula) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_empresarial.tuto_empresarialindex2' 

--
 CREATE INDEX tuto_empresarialindex2 ON pasantias.tutor_empresarial USING btree (codigo_sucursal, id_persona, id_oficina, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado.uk_codigoencargadodedex' 

--
 CREATE UNIQUE INDEX uk_codigoencargadodedex ON pasantias.encargado USING btree (codigo_sucursal, id_persona, id_oficina, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion_oficina.organizacion_oficinaindex2' 

--
 CREATE INDEX organizacion_oficinaindex2 ON pasantias.organizacion_oficina USING btree (id_oficina) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.uk_personadex' 

--
 CREATE UNIQUE INDEX uk_personadex ON pasantias.persona USING btree (cedula) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.temporadadex1' 

--
 CREATE INDEX temporadadex1 ON pasantias.temporadas_solicitud USING btree (id_periodo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.perfil.perfilsesiondex' 

--
 CREATE INDEX perfilsesiondex ON pasantias.perfil USING btree (id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.datos_extra.datos_extradex1dex' 

--
 CREATE INDEX datos_extradex1dex ON pasantias.datos_extra USING btree (id_segmento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.encargado.uk_codigoencargadode' 

--
 CREATE UNIQUE INDEX uk_codigoencargadodeb ON pasantias.encargado USING btree (codigo_sucursal, id_persona, id_oficina, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_organizacion_oficina.personaorganizacionindex1' 

--
 CREATE INDEX personaorganizacionindex1 ON pasantias.persona_organizacion_oficina USING btree (id_persona) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu2.submenu2ndex3' 

--
 CREATE INDEX submenu2ndex3 ON pasantias.submenu2 USING btree (nombre_submenu2) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud_requisito.solicitud_requisitodex3' 

--
 CREATE INDEX solicitud_requisitodex3 ON pasantias.solicitud_requisito USING btree (estatus) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.studentsroll' 

--
 CREATE INDEX studentsroll ON pasantias.estudiante USING btree (roll) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.pk_bitacora' 

--
 CREATE UNIQUE INDEX pk_bitacora ON pasantias.bitacora USING btree (id_bitacora) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.studendsasignacion' 

--
 CREATE INDEX studendsasignacion ON pasantias.estudiante USING btree (id_persona, id_especialidad, id_ip, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.especialidad.uk_especialidaddex' 

--
 CREATE UNIQUE INDEX uk_especialidaddex ON pasantias.especialidad USING btree (nombre_especialidad, id_tipo_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_solicitud.tipo_solicitud_w' 

--
 CREATE INDEX tipo_solicitud_w ON pasantias.tipo_solicitud USING btree (nombre_tipo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitud_requisito.pk_solicitudrequisito' 

--
 CREATE UNIQUE INDEX pk_solicitudrequisito ON pasantias.solicitud_requisito USING btree (id_requisito, codigo_solicitud) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu2.submenu2ndex4' 

--
 CREATE INDEX submenu2ndex4 ON pasantias.submenu2 USING btree (id_submenu) ;
--
-- Respaldando Mis Indexes XD 'pasantias.responsables.responsablesdex0' 

--
 CREATE INDEX responsablesdex0 ON pasantias.responsables USING btree (id_serial) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacionmunicipio.pk_organizacionmunicipio' 

--
 CREATE UNIQUE INDEX pk_organizacionmunicipio ON pasantias.organizacionmunicipio USING btree (codigo_sucursal) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_organizacion.pk_idtodex' 

--
 CREATE UNIQUE INDEX pk_idtodex ON pasantias.tipo_organizacion USING btree (id_tipo_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_organizacion_oficina.personaorganizacionindex2' 

--
 CREATE INDEX personaorganizacionindex2 ON pasantias.persona_organizacion_oficina USING btree (id_oficina) ;
--
-- Respaldando Mis Indexes XD 'pasantias.organizacion.pk_idordex' 

--
 CREATE UNIQUE INDEX pk_idordex ON pasantias.organizacion USING btree (id_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable_temporada.dex_entregables_fecha' 

--
 CREATE INDEX dex_entregables_fecha ON pasantias.entregable_temporada USING btree (fecha_asignacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.estudiante.pk_estudiante_nobadisdex' 

--
 CREATE UNIQUE INDEX pk_estudiante_nobadisdex ON pasantias.estudiante USING btree (codigo_estudiante) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.pk_personadex' 

--
 CREATE UNIQUE INDEX pk_personadex ON pasantias.persona USING btree (id_persona) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_empresarial.tuto_empresarialindex3' 

--
 CREATE INDEX tuto_empresarialindex3 ON pasantias.tutor_empresarial USING btree (id_persona) ;
--
-- Respaldando Mis Indexes XD 'pasantias.instituto_principal.instituto_principalfk' 

--
 CREATE INDEX instituto_principalfk ON pasantias.instituto_principal USING btree (id_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_solicitud.pk_temporadassolicituddex' 

--
 CREATE UNIQUE INDEX pk_temporadassolicituddex ON pasantias.temporadas_solicitud USING btree (codigo_temporada) ;
--
-- Respaldando Mis Indexes XD 'pasantias.publicacion.pk_id_publicacion' 

--
 CREATE UNIQUE INDEX pk_id_publicacion ON pasantias.publicacion USING btree (id_publicacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.submenu.submenundex2' 

--
 CREATE INDEX submenundex2 ON pasantias.submenu USING btree (id_funcion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_academico.pk_tutor_academico' 

--
 CREATE UNIQUE INDEX pk_tutor_academico ON pasantias.tutor_academico USING btree (codigo_tutor_academico) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_organizacion_oficina.personaorganizacionindex' 

--
 CREATE INDEX personaorganizacionindex ON pasantias.persona_organizacion_oficina USING btree (id_persona, id_oficina, codigo_sucursal) ;
--
-- Respaldando Mis Indexes XD 'pasantias.extra_curriculum.pk_extracurridex' 

--
 CREATE UNIQUE INDEX pk_extracurridex ON pasantias.extra_curriculum USING btree (id_extra_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.departamento.pk_idddex' 

--
 CREATE UNIQUE INDEX pk_idddex ON pasantias.departamento USING btree (id_departamento) ;
--
-- Respaldando Mis Indexes XD 'pasantias.oficina.uk_oficina' 

--
 CREATE UNIQUE INDEX uk_oficinab ON pasantias.oficina USING btree (nombre_oficina) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tipo_organizacion.pk_idto' 

--
 CREATE UNIQUE INDEX pk_idto ON pasantias.tipo_organizacion USING btree (id_tipo_organizacion) ;
--
-- Respaldando Mis Indexes XD 'pasantias.configuracion_solicitud.pk_configuracion_solicitud' 

--
 CREATE UNIQUE INDEX pk_configuracion_solicitud ON pasantias.configuracion_solicitud USING btree (table_column) ;
--
-- Respaldando Mis Indexes XD 'pasantias.municipio.miunicipio' 

--
 CREATE INDEX miunicipio ON pasantias.municipio USING btree (id_municipio, id_estado, nombre_municipio, codigo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.solicitudes_recibidas.solicitudes_recibidasdex2' 

--
 CREATE INDEX solicitudes_recibidasdex2 ON pasantias.solicitudes_recibidas USING btree (table_column) ;
--
-- Respaldando Mis Indexes XD 'pasantias.entregable.dex_entregable_master' 

--
 CREATE INDEX dex_entregable_master ON pasantias.entregable USING btree (nombre_entregable) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona.uk_correop' 

--
 CREATE UNIQUE INDEX uk_correopb ON pasantias.persona USING btree (correo) ;
--
-- Respaldando Mis Indexes XD 'pasantias.lapso_academico.uk_lapsodex' 

--
 CREATE UNIQUE INDEX uk_lapsodex ON pasantias.lapso_academico USING btree (ano_f, ano_i, numero_lapso) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_estudiantes.temporadas_estudiantesdex0' 

--
 CREATE INDEX temporadas_estudiantesdex0 ON pasantias.temporadas_estudiantes USING btree (codigo_temporada_especialidad) ;
--
-- Respaldando Mis Indexes XD 'pasantias.datos_extra.datos_extradex4dex' 

--
 CREATE INDEX datos_extradex4dex ON pasantias.datos_extra USING btree (id_segmento, id_curriculum, id_extra_curriculum) ;
--
-- Respaldando Mis Indexes XD 'pasantias.temporadas_estudiantes.pk_temporadas_estudiantes' 

--
 CREATE UNIQUE INDEX pk_temporadas_estudiantes ON pasantias.temporadas_estudiantes USING btree (codigo_temporada_especialidad, codigo_estudiante) ;
--
-- Respaldando Mis Indexes XD 'pasantias.persona_instituto_especialidad.pk_idpersonespecialidad' 

--
 CREATE UNIQUE INDEX pk_idpersonespecialidad ON pasantias.persona_instituto_especialidad USING btree (id_persona, id_especialidad, id_ip, id_perfil) ;
--
-- Respaldando Mis Indexes XD 'pasantias.bitacora.bitacoraindex3' 

--
 CREATE INDEX bitacoraindex3 ON pasantias.bitacora USING btree (fecha) ;
--
-- Respaldando Mis Indexes XD 'pasantias.tutor_empresarial.pk_tutor_empresarialdex' 

--
 CREATE UNIQUE INDEX pk_tutor_empresarialdex ON pasantias.tutor_empresarial USING btree (codigo_tutor_empresarial) ;
--

-- Respaldando Mis Vistas 'pasantias.proximoid_institutoprincipal' 

--
CREATE VIEW pasantias.proximoid_institutoprincipal AS   SELECT (max(instituto_principal.id_ip) + 1) AS id
   FROM pasantias.instituto_principal; ;
--

-- Respaldando Mis Vistas 'pasantias.proximoid_organizacion' 

--
CREATE VIEW pasantias.proximoid_organizacion AS   SELECT (max(organizacion.id_organizacion) + 1) AS id
   FROM pasantias.organizacion; ;
--

-- Respaldando Mis Vistas 'pasantias.ultimoid_departamento' 

--
CREATE VIEW pasantias.ultimoid_departamento AS   SELECT max(departamento.id_departamento) AS id
   FROM pasantias.departamento; ;
--

-- Respaldando Mis Vistas 'pasantias.ultimoid_institutoprincipal' 

--
CREATE VIEW pasantias.ultimoid_institutoprincipal AS   SELECT max(instituto_principal.id_ip) AS id
   FROM pasantias.instituto_principal; ;
--

-- Respaldando Mis Vistas 'pasantias.ultimoid_organizacion' 

--
CREATE VIEW pasantias.ultimoid_organizacion AS   SELECT max(organizacion.id_organizacion) AS id
   FROM pasantias.organizacion; ;
--

-- Respaldando Mis Vistas 'pasantias.ultimoid_persona' 

--
CREATE VIEW pasantias.ultimoid_persona AS   SELECT max(persona.id_persona) AS id
   FROM pasantias.persona; ;
--
-- Respaldo de Restricciones 'pasantias usuario uk_usuario'
--

ALTER TABLE  pasantias.usuario  ADD CONSTRAINT   uk_usuario  UNIQUE (usuario)  ;
--
-- Respaldo de Restricciones 'pasantias organizacion uk_rif_organizacion'
--

ALTER TABLE  pasantias.organizacion  ADD CONSTRAINT   uk_rif_organizacion  UNIQUE (rif)  ;
--
-- Respaldo de Restricciones 'pasantias tipo_solicitud uk_tiposolicitud'
--

ALTER TABLE  pasantias.tipo_solicitud  ADD CONSTRAINT   uk_tiposolicitud  UNIQUE (nombre_tipo_solicitud)  ;
--
-- Respaldo de Restricciones 'pasantias tipo_organizacion uk_nyr'
--

ALTER TABLE  pasantias.tipo_organizacion  ADD CONSTRAINT   uk_nyr  UNIQUE (nombre_tipo_organizacion)  ;
--
-- Respaldo de Restricciones 'pasantias tipo_especialidad tipo_eunic'
--

ALTER TABLE  pasantias.tipo_especialidad  ADD CONSTRAINT   tipo_eunic  UNIQUE (nombre_tipo_especialidad)  ;
--
-- Respaldo de Restricciones 'pasantias requisito uk_requis'
--

ALTER TABLE  pasantias.requisito  ADD CONSTRAINT   uk_requis  UNIQUE (nombre_requisito)  ;
--
-- Respaldo de Restricciones 'pasantias oficina uk_oficina'
--

ALTER TABLE  pasantias.oficina  ADD CONSTRAINT   uk_oficina  UNIQUE (nombre_oficina)  ;
--
-- Respaldo de Restricciones 'pasantias estado uk_estado'
--

ALTER TABLE  pasantias.estado  ADD CONSTRAINT   uk_estado  UNIQUE (nombre_estado)  ;
--
-- Respaldo de Restricciones 'pasantias especialidad uk_especialidad'
--

ALTER TABLE  pasantias.especialidad  ADD CONSTRAINT   uk_especialidad  UNIQUE (nombre_especialidad, id_tipo_especialidad)  ;
--
-- Respaldo de Restricciones 'pasantias entregable unique_treintdate'
--

ALTER TABLE  pasantias.entregable  ADD CONSTRAINT   unique_treintdate  UNIQUE (nombre_entregable)  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_solicitud uk_temporadasolicitud'
--

ALTER TABLE  pasantias.temporadas_solicitud  ADD CONSTRAINT   uk_temporadasolicitud  UNIQUE (id_tipo_solicitud, id_periodo, codigo_encargado)  ;
--
-- Respaldo de Restricciones 'pasantias estudiante expedientestudents'
--

ALTER TABLE  pasantias.estudiante  ADD CONSTRAINT   expedientestudents  UNIQUE (id_persona, id_especialidad, id_ip, id_perfil, expediente)  ;
--
-- Respaldo de Restricciones 'pasantias estudiante uk_estudiante_temporada'
--

ALTER TABLE  pasantias.estudiante  ADD CONSTRAINT   uk_estudiante_temporada  UNIQUE (id_persona, id_especialidad, id_ip, id_perfil)  ;
--
-- Respaldo de Restricciones 'pasantias tutor_academico uk_tutor_foreig_academico'
--

ALTER TABLE  pasantias.tutor_academico  ADD CONSTRAINT   uk_tutor_foreig_academico  UNIQUE (id_persona, id_especialidad, id_ip, id_perfil)  ;
--
-- Respaldo de Restricciones 'pasantias organizacionmunicipio uk_organizacionmunicipio'
--

ALTER TABLE  pasantias.organizacionmunicipio  ADD CONSTRAINT   uk_organizacionmunicipio  UNIQUE (id_municipio, id_organizacion, domicilio)  ;
--
-- Respaldo de Restricciones 'pasantias periodo_solicitud uk_periodos'
--

ALTER TABLE  pasantias.periodo_solicitud  ADD CONSTRAINT   uk_periodos  UNIQUE (id_lapso, fecha_inicio, fecha_fin)  ;
--
-- Respaldo de Restricciones 'pasantias municipio uk_idsm'
--

ALTER TABLE  pasantias.municipio  ADD CONSTRAINT   uk_idsm  UNIQUE (id_estado, nombre_municipio)  ;
--
-- Respaldo de Restricciones 'pasantias oficina uk_iddepart'
--

ALTER TABLE  pasantias.oficina  ADD CONSTRAINT   uk_iddepart  UNIQUE (id_departamento)  ;
--
-- Respaldo de Restricciones 'pasantias especialidad uk_id'
--

ALTER TABLE  pasantias.especialidad  ADD CONSTRAINT   uk_id  UNIQUE (id_departamento)  ;
--
-- Respaldo de Restricciones 'pasantias persona uk_correop'
--

ALTER TABLE  pasantias.persona  ADD CONSTRAINT   uk_correop  UNIQUE (correo)  ;
--
-- Respaldo de Restricciones 'pasantias encargado uk_codigoencargadode'
--

ALTER TABLE  pasantias.encargado  ADD CONSTRAINT   uk_codigoencargadode  UNIQUE (codigo_sucursal, id_persona, id_oficina, id_perfil)  ;
--
-- Respaldo de Restricciones 'pasantias tutor_empresarial uk_tuto_empresarial'
--

ALTER TABLE  pasantias.tutor_empresarial  ADD CONSTRAINT   uk_tuto_empresarial  UNIQUE (codigo_sucursal, id_persona, id_oficina, id_perfil)  ;
--
-- Respaldo de Restricciones 'pasantias estado uk_estadocode'
--

ALTER TABLE  pasantias.estado  ADD CONSTRAINT   uk_estadocode  UNIQUE (codigo)  ;
--
-- Respaldo de Restricciones 'pasantias persona uk_persona'
--

ALTER TABLE  pasantias.persona  ADD CONSTRAINT   uk_persona  UNIQUE (cedula)  ;
--
-- Respaldo de Restricciones 'pasantias lapso_academico uk_lapso'
--

ALTER TABLE  pasantias.lapso_academico  ADD CONSTRAINT   uk_lapso  UNIQUE (ano_f, ano_i, numero_lapso)  ;
--
-- Respaldo de Restricciones 'pasantias configuracion_solicitud pk_configuracion_solicitud'
--

ALTER TABLE  pasantias.configuracion_solicitud  ADD CONSTRAINT   pk_configuracion_solicitud  PRIMARY KEY (table_column)  ;
--
-- Respaldo de Restricciones 'pasantias usuario pk_usuario'
--

ALTER TABLE  pasantias.usuario  ADD CONSTRAINT   pk_usuario  PRIMARY KEY (id_usuario)  ;
--
-- Respaldo de Restricciones 'pasantias encargado_tipo_solicitud pk_encargado_tiposs'
--

ALTER TABLE  pasantias.encargado_tipo_solicitud  ADD CONSTRAINT   pk_encargado_tiposs  PRIMARY KEY (id_tipo_solicitud, codigo_encargado)  ;
--
-- Respaldo de Restricciones 'pasantias tipo_solicitud pk_ids'
--

ALTER TABLE  pasantias.tipo_solicitud  ADD CONSTRAINT   pk_ids  PRIMARY KEY (id_tipo_solicitud)  ;
--
-- Respaldo de Restricciones 'pasantias tipo_organizacion pk_idto'
--

ALTER TABLE  pasantias.tipo_organizacion  ADD CONSTRAINT   pk_idto  PRIMARY KEY (id_tipo_organizacion)  ;
--
-- Respaldo de Restricciones 'pasantias tipo_especialidad pk_idt'
--

ALTER TABLE  pasantias.tipo_especialidad  ADD CONSTRAINT   pk_idt  PRIMARY KEY (id_tipo_especialidad)  ;
--
-- Respaldo de Restricciones 'pasantias submenu2 pk_submenu2'
--

ALTER TABLE  pasantias.submenu2  ADD CONSTRAINT   pk_submenu2  PRIMARY KEY (id_submenu2)  ;
--
-- Respaldo de Restricciones 'pasantias submenu pk_submenu'
--

ALTER TABLE  pasantias.submenu  ADD CONSTRAINT   pk_submenu  PRIMARY KEY (id_submenu)  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_aprobadas pk_solicitudes_aprobadas'
--

ALTER TABLE  pasantias.solicitudes_aprobadas  ADD CONSTRAINT   pk_solicitudes_aprobadas  PRIMARY KEY (id_serial)  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_recibidas pk_solicitudes_recibidas'
--

ALTER TABLE  pasantias.solicitudes_recibidas  ADD CONSTRAINT   pk_solicitudes_recibidas  PRIMARY KEY (id_serial)  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_enviadas pk_solicitudes_enviadas'
--

ALTER TABLE  pasantias.solicitudes_enviadas  ADD CONSTRAINT   pk_solicitudes_enviadas  PRIMARY KEY (id_serial)  ;
--
-- Respaldo de Restricciones 'pasantias responsables pk_responsables'
--

ALTER TABLE  pasantias.responsables  ADD CONSTRAINT   pk_responsables  PRIMARY KEY (id_serial)  ;
--
-- Respaldo de Restricciones 'pasantias segmentos pk_segmentosserial'
--

ALTER TABLE  pasantias.segmentos  ADD CONSTRAINT   pk_segmentosserial  PRIMARY KEY (id_segmento)  ;
--
-- Respaldo de Restricciones 'pasantias solicitud_requisito pk_solicitudrequisito'
--

ALTER TABLE  pasantias.solicitud_requisito  ADD CONSTRAINT   pk_solicitudrequisito  PRIMARY KEY (id_requisito, codigo_solicitud)  ;
--
-- Respaldo de Restricciones 'pasantias requisito pk_idr'
--

ALTER TABLE  pasantias.requisito  ADD CONSTRAINT   pk_idr  PRIMARY KEY (id_requisito)  ;
--
-- Respaldo de Restricciones 'pasantias publicacion pk_id_publicacion'
--

ALTER TABLE  pasantias.publicacion  ADD CONSTRAINT   pk_id_publicacion  PRIMARY KEY (id_publicacion)  ;
--
-- Respaldo de Restricciones 'pasantias persona_instituto_especialidad pk_idpersonespecialidad'
--

ALTER TABLE  pasantias.persona_instituto_especialidad  ADD CONSTRAINT   pk_idpersonespecialidad  PRIMARY KEY (id_persona, id_especialidad, id_ip, id_perfil)  ;
--
-- Respaldo de Restricciones 'pasantias persona pk_persona'
--

ALTER TABLE  pasantias.persona  ADD CONSTRAINT   pk_persona  PRIMARY KEY (id_persona)  ;
--
-- Respaldo de Restricciones 'pasantias periodo_solicitud pk_perid'
--

ALTER TABLE  pasantias.periodo_solicitud  ADD CONSTRAINT   pk_perid  PRIMARY KEY (id_periodo)  ;
--
-- Respaldo de Restricciones 'pasantias perfil pk_perfil'
--

ALTER TABLE  pasantias.perfil  ADD CONSTRAINT   pk_perfil  PRIMARY KEY (id_perfil)  ;
--
-- Respaldo de Restricciones 'pasantias organizacion pk_idor'
--

ALTER TABLE  pasantias.organizacion  ADD CONSTRAINT   pk_idor  PRIMARY KEY (id_organizacion)  ;
--
-- Respaldo de Restricciones 'pasantias organizacion_oficina pk_id_organizacionficina'
--

ALTER TABLE  pasantias.organizacion_oficina  ADD CONSTRAINT   pk_id_organizacionficina  PRIMARY KEY (id_oficina, codigo_sucursal)  ;
--
-- Respaldo de Restricciones 'pasantias oficina pk_ido'
--

ALTER TABLE  pasantias.oficina  ADD CONSTRAINT   pk_ido  PRIMARY KEY (id_oficina)  ;
--
-- Respaldo de Restricciones 'pasantias municipio primari_munucupoi'
--

ALTER TABLE  pasantias.municipio  ADD CONSTRAINT   primari_munucupoi  PRIMARY KEY (id_municipio)  ;
--
-- Respaldo de Restricciones 'pasantias lapso_academico pk_idlap'
--

ALTER TABLE  pasantias.lapso_academico  ADD CONSTRAINT   pk_idlap  PRIMARY KEY (id_lapso)  ;
--
-- Respaldo de Restricciones 'pasantias convenio_organizacion pk_organizacionprincipal'
--

ALTER TABLE  pasantias.convenio_organizacion  ADD CONSTRAINT   pk_organizacionprincipal  PRIMARY KEY (id_ip, id_organizacion)  ;
--
-- Respaldo de Restricciones 'pasantias especialidad_instituto_principal pk_especialidad_instituto_principal'
--

ALTER TABLE  pasantias.especialidad_instituto_principal  ADD CONSTRAINT   pk_especialidad_instituto_principal  PRIMARY KEY (id_ip, id_especialidad)  ;
--
-- Respaldo de Restricciones 'pasantias instituto_principal pk_idip'
--

ALTER TABLE  pasantias.instituto_principal  ADD CONSTRAINT   pk_idip  PRIMARY KEY (id_ip)  ;
--
-- Respaldo de Restricciones 'pasantias funcion pk_funcion'
--

ALTER TABLE  pasantias.funcion  ADD CONSTRAINT   pk_funcion  PRIMARY KEY (id_funcion)  ;
--
-- Respaldo de Restricciones 'pasantias curriculum_formacion_academica pk_formacion_academica'
--

ALTER TABLE  pasantias.curriculum_formacion_academica  ADD CONSTRAINT   pk_formacion_academica  PRIMARY KEY (id_formacion)  ;
--
-- Respaldo de Restricciones 'pasantias extra_curriculum pk_extracurri'
--

ALTER TABLE  pasantias.extra_curriculum  ADD CONSTRAINT   pk_extracurri  PRIMARY KEY (id_extra_curriculum)  ;
--
-- Respaldo de Restricciones 'pasantias curriculum_experiencia_laboral pk_experiencialaboral'
--

ALTER TABLE  pasantias.curriculum_experiencia_laboral  ADD CONSTRAINT   pk_experiencialaboral  PRIMARY KEY (id_experiencia)  ;
--
-- Respaldo de Restricciones 'pasantias estudiantes_entregables pk_id_estudiantes_entregables'
--

ALTER TABLE  pasantias.estudiantes_entregables  ADD CONSTRAINT   pk_id_estudiantes_entregables  PRIMARY KEY (id_estudiantes_entregables)  ;
--
-- Respaldo de Restricciones 'pasantias estado primary_estad'
--

ALTER TABLE  pasantias.estado  ADD CONSTRAINT   primary_estad  PRIMARY KEY (id_estado)  ;
--
-- Respaldo de Restricciones 'pasantias especialidad pk_ide'
--

ALTER TABLE  pasantias.especialidad  ADD CONSTRAINT   pk_ide  PRIMARY KEY (id_especialidad)  ;
--
-- Respaldo de Restricciones 'pasantias entregable pk_entregable'
--

ALTER TABLE  pasantias.entregable  ADD CONSTRAINT   pk_entregable  PRIMARY KEY (id_entregable)  ;
--
-- Respaldo de Restricciones 'pasantias departamento pk_idd'
--

ALTER TABLE  pasantias.departamento  ADD CONSTRAINT   pk_idd  PRIMARY KEY (id_departamento)  ;
--
-- Respaldo de Restricciones 'pasantias datos_extra pk_datosextra'
--

ALTER TABLE  pasantias.datos_extra  ADD CONSTRAINT   pk_datosextra  PRIMARY KEY (id_curriculum, id_segmento, id_extra_curriculum)  ;
--
-- Respaldo de Restricciones 'pasantias curriculum pk_curriculum'
--

ALTER TABLE  pasantias.curriculum  ADD CONSTRAINT   pk_curriculum  PRIMARY KEY (id_curriculum)  ;
--
-- Respaldo de Restricciones 'pasantias bitacora pk_bitacora'
--

ALTER TABLE  pasantias.bitacora  ADD CONSTRAINT   pk_bitacora  PRIMARY KEY (id_bitacora)  ;
--
-- Respaldo de Restricciones 'pasantias tutor_empresarial pk_tutor_empresarial'
--

ALTER TABLE  pasantias.tutor_empresarial  ADD CONSTRAINT   pk_tutor_empresarial  PRIMARY KEY (codigo_tutor_empresarial)  ;
--
-- Respaldo de Restricciones 'pasantias tutor_academico pk_tutor_academico'
--

ALTER TABLE  pasantias.tutor_academico  ADD CONSTRAINT   pk_tutor_academico  PRIMARY KEY (codigo_tutor_academico)  ;
--
-- Respaldo de Restricciones 'pasantias entregable_temporada pk_entregables_asignados'
--

ALTER TABLE  pasantias.entregable_temporada  ADD CONSTRAINT   pk_entregables_asignados  PRIMARY KEY (codigo_temporada, id_entregable)  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_estudiantes pk_temporadas_estudiantes'
--

ALTER TABLE  pasantias.temporadas_estudiantes  ADD CONSTRAINT   pk_temporadas_estudiantes  PRIMARY KEY (codigo_temporada_especialidad, codigo_estudiante)  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_especialidad pk_temporadaespecialidad'
--

ALTER TABLE  pasantias.temporadas_especialidad  ADD CONSTRAINT   pk_temporadaespecialidad  PRIMARY KEY (codigo_temporada_especialidad)  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_solicitud pk_temporadassolicitud'
--

ALTER TABLE  pasantias.temporadas_solicitud  ADD CONSTRAINT   pk_temporadassolicitud  PRIMARY KEY (codigo_temporada)  ;
--
-- Respaldo de Restricciones 'pasantias persona_organizacion_oficina pk_idpersonoficina'
--

ALTER TABLE  pasantias.persona_organizacion_oficina  ADD CONSTRAINT   pk_idpersonoficina  PRIMARY KEY (codigo_sucursal, id_persona, id_oficina, id_perfil)  ;
--
-- Respaldo de Restricciones 'pasantias organizacionmunicipio pk_organizacionmunicipio'
--

ALTER TABLE  pasantias.organizacionmunicipio  ADD CONSTRAINT   pk_organizacionmunicipio  PRIMARY KEY (codigo_sucursal)  ;
--
-- Respaldo de Restricciones 'pasantias solicitud pk_solicitud'
--

ALTER TABLE  pasantias.solicitud  ADD CONSTRAINT   pk_solicitud  PRIMARY KEY (codigo_solicitud)  ;
--
-- Respaldo de Restricciones 'pasantias estudiante pk_estudiante_nobadis'
--

ALTER TABLE  pasantias.estudiante  ADD CONSTRAINT   pk_estudiante_nobadis  PRIMARY KEY (codigo_estudiante)  ;
--
-- Respaldo de Restricciones 'pasantias encargado pk_idencargado'
--

ALTER TABLE  pasantias.encargado  ADD CONSTRAINT   pk_idencargado  PRIMARY KEY (codigo_encargado)  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_recibidas fk_solicitudes_recibidas2'
--

ALTER TABLE  pasantias.solicitudes_recibidas  ADD CONSTRAINT   fk_solicitudes_recibidas2  FOREIGN KEY (table_column) REFERENCES pasantias.configuracion_solicitud(table_column) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_enviadas fk_solicitudes_enviadas2'
--

ALTER TABLE  pasantias.solicitudes_enviadas  ADD CONSTRAINT   fk_solicitudes_enviadas2  FOREIGN KEY (table_column) REFERENCES pasantias.configuracion_solicitud(table_column) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_aprobadas fk_solicitudes_aprobad1'
--

ALTER TABLE  pasantias.solicitudes_aprobadas  ADD CONSTRAINT   fk_solicitudes_aprobad1  FOREIGN KEY (table_column) REFERENCES pasantias.configuracion_solicitud(table_column) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias responsables fk_responsablesasignaciones1'
--

ALTER TABLE  pasantias.responsables  ADD CONSTRAINT   fk_responsablesasignaciones1  FOREIGN KEY (table_column) REFERENCES pasantias.configuracion_solicitud(table_column) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias bitacora fk_bitacora'
--

ALTER TABLE  pasantias.bitacora  ADD CONSTRAINT   fk_bitacora  FOREIGN KEY (id_usuario) REFERENCES pasantias.usuario(id_usuario) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_solicitud fk_ts_tipos'
--

ALTER TABLE  pasantias.temporadas_solicitud  ADD CONSTRAINT   fk_ts_tipos  FOREIGN KEY (id_tipo_solicitud) REFERENCES pasantias.tipo_solicitud(id_tipo_solicitud) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias encargado_tipo_solicitud fk_encargadotipo_tipo'
--

ALTER TABLE  pasantias.encargado_tipo_solicitud  ADD CONSTRAINT   fk_encargadotipo_tipo  FOREIGN KEY (id_tipo_solicitud) REFERENCES pasantias.tipo_solicitud(id_tipo_solicitud) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias organizacion fk_idtor'
--

ALTER TABLE  pasantias.organizacion  ADD CONSTRAINT   fk_idtor  FOREIGN KEY (id_tipo_organizacion) REFERENCES pasantias.tipo_organizacion(id_tipo_organizacion) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias especialidad fk_idtipoe'
--

ALTER TABLE  pasantias.especialidad  ADD CONSTRAINT   fk_idtipoe  FOREIGN KEY (id_tipo_especialidad) REFERENCES pasantias.tipo_especialidad(id_tipo_especialidad) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias submenu2 fk_submenu2submenu'
--

ALTER TABLE  pasantias.submenu2  ADD CONSTRAINT   fk_submenu2submenu  FOREIGN KEY (id_submenu) REFERENCES pasantias.submenu(id_submenu) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias datos_extra fk_datosextrasegmen'
--

ALTER TABLE  pasantias.datos_extra  ADD CONSTRAINT   fk_datosextrasegmen  FOREIGN KEY (id_segmento) REFERENCES pasantias.segmentos(id_segmento) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_organizacion_oficina fk_idpodpersonaresponsable'
--

ALTER TABLE  pasantias.persona_organizacion_oficina  ADD CONSTRAINT   fk_idpodpersonaresponsable  FOREIGN KEY (id_responsable_asignacion) REFERENCES pasantias.persona(id_persona) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_instituto_especialidad fk_idpieresponsabilidad'
--

ALTER TABLE  pasantias.persona_instituto_especialidad  ADD CONSTRAINT   fk_idpieresponsabilidad  FOREIGN KEY (id_responsable_asignacion) REFERENCES pasantias.persona(id_persona) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias solicitud_requisito fk_solicitud_requisito_requisito'
--

ALTER TABLE  pasantias.solicitud_requisito  ADD CONSTRAINT   fk_solicitud_requisito_requisito  FOREIGN KEY (id_requisito) REFERENCES pasantias.requisito(id_requisito) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_organizacion_oficina fk_idpodpersona'
--

ALTER TABLE  pasantias.persona_organizacion_oficina  ADD CONSTRAINT   fk_idpodpersona  FOREIGN KEY (id_persona) REFERENCES pasantias.persona(id_persona) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias curriculum fk_curriculumnpersona'
--

ALTER TABLE  pasantias.curriculum  ADD CONSTRAINT   fk_curriculumnpersona  FOREIGN KEY (id_persona) REFERENCES pasantias.persona(id_persona) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_instituto_especialidad fk_personainstitutoidp'
--

ALTER TABLE  pasantias.persona_instituto_especialidad  ADD CONSTRAINT   fk_personainstitutoidp  FOREIGN KEY (id_persona) REFERENCES pasantias.persona(id_persona) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias usuario fk_usuario_persona_perfil2'
--

ALTER TABLE  pasantias.usuario  ADD CONSTRAINT   fk_usuario_persona_perfil2  FOREIGN KEY (id_persona) REFERENCES pasantias.persona(id_persona) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias tutor_academico fk_tutor_academico'
--

ALTER TABLE  pasantias.tutor_academico  ADD CONSTRAINT   fk_tutor_academico  FOREIGN KEY (id_persona, id_especialidad, id_ip, id_perfil) REFERENCES pasantias.persona_instituto_especialidad(id_persona, id_especialidad, id_ip, id_perfil) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias estudiante fk_personaestudiantep'
--

ALTER TABLE  pasantias.estudiante  ADD CONSTRAINT   fk_personaestudiantep  FOREIGN KEY (id_persona, id_especialidad, id_ip, id_perfil) REFERENCES pasantias.persona_instituto_especialidad(id_persona, id_especialidad, id_ip, id_perfil) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_solicitud fk_ts_periodo'
--

ALTER TABLE  pasantias.temporadas_solicitud  ADD CONSTRAINT   fk_ts_periodo  FOREIGN KEY (id_periodo) REFERENCES pasantias.periodo_solicitud(id_periodo) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_instituto_especialidad fk_personainstitutoidpr'
--

ALTER TABLE  pasantias.persona_instituto_especialidad  ADD CONSTRAINT   fk_personainstitutoidpr  FOREIGN KEY (id_perfil) REFERENCES pasantias.perfil(id_perfil) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_organizacion_oficina fk_idpodperfil'
--

ALTER TABLE  pasantias.persona_organizacion_oficina  ADD CONSTRAINT   fk_idpodperfil  FOREIGN KEY (id_perfil) REFERENCES pasantias.perfil(id_perfil) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias funcion fk_funcionperfil'
--

ALTER TABLE  pasantias.funcion  ADD CONSTRAINT   fk_funcionperfil  FOREIGN KEY (id_perfil) REFERENCES pasantias.perfil(id_perfil) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias publicacion fk_roles_de_perfiles'
--

ALTER TABLE  pasantias.publicacion  ADD CONSTRAINT   fk_roles_de_perfiles  FOREIGN KEY (id_perfil) REFERENCES pasantias.perfil(id_perfil) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias instituto_principal fk_idio'
--

ALTER TABLE  pasantias.instituto_principal  ADD CONSTRAINT   fk_idio  FOREIGN KEY (id_organizacion) REFERENCES pasantias.organizacion(id_organizacion) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias organizacionmunicipio fk_idorganizacion'
--

ALTER TABLE  pasantias.organizacionmunicipio  ADD CONSTRAINT   fk_idorganizacion  FOREIGN KEY (id_organizacion) REFERENCES pasantias.organizacion(id_organizacion) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias convenio_organizacion fk_idprincipalo'
--

ALTER TABLE  pasantias.convenio_organizacion  ADD CONSTRAINT   fk_idprincipalo  FOREIGN KEY (id_organizacion) REFERENCES pasantias.organizacion(id_organizacion) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias organizacion_oficina fk_organizacion_oficina2'
--

ALTER TABLE  pasantias.organizacion_oficina  ADD CONSTRAINT   fk_organizacion_oficina2  FOREIGN KEY (id_oficina) REFERENCES pasantias.oficina(id_oficina) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_organizacion_oficina fk_idpodoficina'
--

ALTER TABLE  pasantias.persona_organizacion_oficina  ADD CONSTRAINT   fk_idpodoficina  FOREIGN KEY (id_oficina) REFERENCES pasantias.oficina(id_oficina) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias organizacionmunicipio fk_idmu'
--

ALTER TABLE  pasantias.organizacionmunicipio  ADD CONSTRAINT   fk_idmu  FOREIGN KEY (id_municipio) REFERENCES pasantias.municipio(id_municipio) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias periodo_solicitud fk_idlaps'
--

ALTER TABLE  pasantias.periodo_solicitud  ADD CONSTRAINT   fk_idlaps  FOREIGN KEY (id_lapso) REFERENCES pasantias.lapso_academico(id_lapso) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_instituto_especialidad fk_personainstitutoidi'
--

ALTER TABLE  pasantias.persona_instituto_especialidad  ADD CONSTRAINT   fk_personainstitutoidi  FOREIGN KEY (id_ip) REFERENCES pasantias.instituto_principal(id_ip) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias especialidad_instituto_principal fk_id_instituto'
--

ALTER TABLE  pasantias.especialidad_instituto_principal  ADD CONSTRAINT   fk_id_instituto  FOREIGN KEY (id_ip) REFERENCES pasantias.instituto_principal(id_ip) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias convenio_organizacion fk_idprincipalp'
--

ALTER TABLE  pasantias.convenio_organizacion  ADD CONSTRAINT   fk_idprincipalp  FOREIGN KEY (id_ip) REFERENCES pasantias.instituto_principal(id_ip) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias submenu fk_submenufuncion'
--

ALTER TABLE  pasantias.submenu  ADD CONSTRAINT   fk_submenufuncion  FOREIGN KEY (id_funcion) REFERENCES pasantias.funcion(id_funcion) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias datos_extra fk_datosextraextra'
--

ALTER TABLE  pasantias.datos_extra  ADD CONSTRAINT   fk_datosextraextra  FOREIGN KEY (id_extra_curriculum) REFERENCES pasantias.extra_curriculum(id_extra_curriculum) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias estudiantes_entregables_valor fk_estudiantes_entregables_valor'
--

ALTER TABLE  pasantias.estudiantes_entregables_valor  ADD CONSTRAINT   fk_estudiantes_entregables_valor  FOREIGN KEY (id_estudiantes_entregables) REFERENCES pasantias.estudiantes_entregables(id_estudiantes_entregables) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias municipio fori_estado'
--

ALTER TABLE  pasantias.municipio  ADD CONSTRAINT   fori_estado  FOREIGN KEY (id_estado) REFERENCES pasantias.estado(id_estado) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_especialidad fk_temporadaespecialidad_especialidad'
--

ALTER TABLE  pasantias.temporadas_especialidad  ADD CONSTRAINT   fk_temporadaespecialidad_especialidad  FOREIGN KEY (id_especialidad) REFERENCES pasantias.especialidad(id_especialidad) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_instituto_especialidad fk_personainstitutoide'
--

ALTER TABLE  pasantias.persona_instituto_especialidad  ADD CONSTRAINT   fk_personainstitutoide  FOREIGN KEY (id_especialidad) REFERENCES pasantias.especialidad(id_especialidad) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias especialidad_instituto_principal fk_id_id_especialidad'
--

ALTER TABLE  pasantias.especialidad_instituto_principal  ADD CONSTRAINT   fk_id_id_especialidad  FOREIGN KEY (id_especialidad) REFERENCES pasantias.especialidad(id_especialidad) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias estudiantes_entregables fk_identregable'
--

ALTER TABLE  pasantias.estudiantes_entregables  ADD CONSTRAINT   fk_identregable  FOREIGN KEY (id_entregable) REFERENCES pasantias.entregable(id_entregable) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias entregable_temporada fk_id_entregable_entregables'
--

ALTER TABLE  pasantias.entregable_temporada  ADD CONSTRAINT   fk_id_entregable_entregables  FOREIGN KEY (id_entregable) REFERENCES pasantias.entregable(id_entregable) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias oficina fk_idod'
--

ALTER TABLE  pasantias.oficina  ADD CONSTRAINT   fk_idod  FOREIGN KEY (id_departamento) REFERENCES pasantias.departamento(id_departamento) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias especialidad fk_ided'
--

ALTER TABLE  pasantias.especialidad  ADD CONSTRAINT   fk_ided  FOREIGN KEY (id_departamento) REFERENCES pasantias.departamento(id_departamento) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias curriculum_experiencia_laboral fk_experiencia_laboralcurri'
--

ALTER TABLE  pasantias.curriculum_experiencia_laboral  ADD CONSTRAINT   fk_experiencia_laboralcurri  FOREIGN KEY (id_curriculum) REFERENCES pasantias.curriculum(id_curriculum) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias curriculum_formacion_academica fk_formaciona_curri'
--

ALTER TABLE  pasantias.curriculum_formacion_academica  ADD CONSTRAINT   fk_formaciona_curri  FOREIGN KEY (id_curriculum) REFERENCES pasantias.curriculum(id_curriculum) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_especialidad fk_temporada_solicitud'
--

ALTER TABLE  pasantias.temporadas_especialidad  ADD CONSTRAINT   fk_temporada_solicitud  FOREIGN KEY (codigo_temporada) REFERENCES pasantias.temporadas_solicitud(codigo_temporada) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_estudiantes fk_te_e'
--

ALTER TABLE  pasantias.temporadas_estudiantes  ADD CONSTRAINT   fk_te_e  FOREIGN KEY (codigo_temporada_especialidad) REFERENCES pasantias.temporadas_especialidad(codigo_temporada_especialidad) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias estudiantes_entregables fk_temporada_estudiante'
--

ALTER TABLE  pasantias.estudiantes_entregables  ADD CONSTRAINT   fk_temporada_estudiante  FOREIGN KEY (codigo_temporada_especialidad, codigo_estudiante) REFERENCES pasantias.temporadas_estudiantes(codigo_temporada_especialidad, codigo_estudiante) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_organizacion_oficina fk_idsubcursal'
--

ALTER TABLE  pasantias.persona_organizacion_oficina  ADD CONSTRAINT   fk_idsubcursal  FOREIGN KEY (codigo_sucursal) REFERENCES pasantias.organizacionmunicipio(codigo_sucursal) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias organizacion_oficina fk_organizacion_oficina1'
--

ALTER TABLE  pasantias.organizacion_oficina  ADD CONSTRAINT   fk_organizacion_oficina1  FOREIGN KEY (codigo_sucursal) REFERENCES pasantias.organizacionmunicipio(codigo_sucursal) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias tutor_empresarial fk_subcursal_empresarial'
--

ALTER TABLE  pasantias.tutor_empresarial  ADD CONSTRAINT   fk_subcursal_empresarial  FOREIGN KEY (codigo_sucursal, id_persona, id_oficina, id_perfil) REFERENCES pasantias.persona_organizacion_oficina(codigo_sucursal, id_persona, id_oficina, id_perfil) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias encargado fk_idperen'
--

ALTER TABLE  pasantias.encargado  ADD CONSTRAINT   fk_idperen  FOREIGN KEY (codigo_sucursal, id_persona, id_oficina, id_perfil) REFERENCES pasantias.persona_organizacion_oficina(codigo_sucursal, id_persona, id_oficina, id_perfil) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_aprobadas table_probades_solicitudes'
--

ALTER TABLE  pasantias.solicitudes_aprobadas  ADD CONSTRAINT   table_probades_solicitudes  FOREIGN KEY (codigo_solicitud) REFERENCES pasantias.solicitud(codigo_solicitud) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias responsables fk_solicitud_codigo_responsables'
--

ALTER TABLE  pasantias.responsables  ADD CONSTRAINT   fk_solicitud_codigo_responsables  FOREIGN KEY (codigo_solicitud) REFERENCES pasantias.solicitud(codigo_solicitud) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_enviadas fk_solicitudes_recibidas_dcodecd'
--

ALTER TABLE  pasantias.solicitudes_enviadas  ADD CONSTRAINT   fk_solicitudes_recibidas_dcodecd  FOREIGN KEY (codigo_solicitud) REFERENCES pasantias.solicitud(codigo_solicitud) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias solicitud_requisito fk_solicutud_codec'
--

ALTER TABLE  pasantias.solicitud_requisito  ADD CONSTRAINT   fk_solicutud_codec  FOREIGN KEY (codigo_solicitud) REFERENCES pasantias.solicitud(codigo_solicitud) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias solicitudes_recibidas fk_tablesolicitudesrecibidas'
--

ALTER TABLE  pasantias.solicitudes_recibidas  ADD CONSTRAINT   fk_tablesolicitudesrecibidas  FOREIGN KEY (codigo_solicitud) REFERENCES pasantias.solicitud(codigo_solicitud) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_estudiantes fk_te_t'
--

ALTER TABLE  pasantias.temporadas_estudiantes  ADD CONSTRAINT   fk_te_t  FOREIGN KEY (codigo_estudiante) REFERENCES pasantias.estudiante(codigo_estudiante) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias solicitud fk_temporadas_estudiantes'
--

ALTER TABLE  pasantias.solicitud  ADD CONSTRAINT   fk_temporadas_estudiantes  FOREIGN KEY (codigo_estudiante, codigo_temporada_especialidad) REFERENCES pasantias.temporadas_estudiantes(codigo_estudiante, codigo_temporada_especialidad)  ;
--
-- Respaldo de Restricciones 'pasantias encargado_tipo_solicitud fk_encargadotipo_encargado'
--

ALTER TABLE  pasantias.encargado_tipo_solicitud  ADD CONSTRAINT   fk_encargadotipo_encargado  FOREIGN KEY (codigo_encargado) REFERENCES pasantias.encargado(codigo_encargado) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias temporadas_solicitud fk_ts_encargado'
--

ALTER TABLE  pasantias.temporadas_solicitud  ADD CONSTRAINT   fk_ts_encargado  FOREIGN KEY (codigo_encargado) REFERENCES pasantias.encargado(codigo_encargado) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE  ;
--
-- Respaldo de Restricciones 'pasantias persona_organizacion_oficina ck_idspsolicitudes'
--

ALTER TABLE  pasantias.persona_organizacion_oficina  ADD CONSTRAINT   ck_idspsolicitudes  CHECK (id_persona <> id_responsable_asignacion)  ;
--
-- Respaldo de Restricciones 'pasantias periodo_solicitud validf'
--

ALTER TABLE  pasantias.periodo_solicitud  ADD CONSTRAINT   validf  CHECK (fecha_inicio < fecha_fin)  ;
--
-- Respaldo de Restricciones 'pasantias lapso_academico checkingasns'
--

ALTER TABLE  pasantias.lapso_academico  ADD CONSTRAINT   checkingasns  CHECK (ano_i <= ano_f)  ;
-- 
 CREATE OR REPLACE FUNCTION pasantias.aprobarestudianteslistos()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
    DECLARE 
    codigoestudiante  character varying; 

    BEGIN
        IF NEW.estatus ='Listo' THEN
        
            codigoestudiante = ( 
                SELECT solicitudes_enviadas.valor FROM pasantias.solicitudes_enviadas 
                INNER JOIN pasantias.solicitud 
                    ON solicitudes_enviadas.codigo_solicitud = solicitud.codigo_solicitud 
                    AND solicitudes_enviadas.table_column ='estudiante.codigo_estudiante'
                    AND solicitud.codigo_solicitud =NEW.codigo_solicitud
                    
                INNER JOIN pasantias.solicitudes_recibidas
                    ON solicitudes_recibidas.codigo_solicitud  = solicitud.codigo_solicitud
                    AND solicitudes_recibidas.valor =NEW.valor
                    AND solicitudes_recibidas.table_column ='organizacionmunicipio.codigo_sucursal'  );
                    
        IF codigoestudiante IS NULL THEN 
        
            codigoestudiante = (
            SELECT solicitudes_recibidas.valor FROM pasantias.solicitudes_recibidas
                INNER JOIN pasantias.solicitud 
                    ON solicitud.codigo_solicitud = solicitudes_recibidas.codigo_solicitud
                    AND solicitudes_recibidas.table_column ='estudiante.codigo_estudiante'
                    AND solicitud.codigo_solicitud =NEW.codigo_solicitud
                    AND solicitudes_recibidas.valor =NEW.valor
                INNER JOIN pasantias.solicitudes_enviadas 
                    ON solicitudes_enviadas.codigo_solicitud = solicitud .codigo_solicitud
                    AND solicitudes_enviadas.table_column ='organizacionmunicipio.codigo_sucursal' );
        END IF ;

            
            UPDATE pasantias.solicitudes_recibidas SET estatus='LISTO' WHERE codigo_solicitud =NEW.codigo_solicitud
            AND valor=NEW.valor;
            INSERT INTO pasantias.solicitudes_aprobadas (codigo_solicitud ,table_column, valor, fecha_aprobacion) 
            VALUES ( NEW.codigo_solicitud , 'estudiante.codigo_estudiante' , codigoestudiante, current_date);
            RETURN NEW;
            ELSE 
            RETURN NULL;
            END IF;
        

    END;
    $function$
;
-- 

-- 
 CREATE OR REPLACE FUNCTION pasantias.codigoencargado()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
DECLARE 
codigo  character varying; 

    BEGIN
    codigo = (SELECT codigo_encargado FROM pasantias.encargado WHERE codigo_sucursal = NEW.codigo_sucursal AND id_persona = NEW.id_persona AND id_oficina = NEW.id_oficina AND id_perfil=NEW.id_perfil);

    IF codigo <> (NEW.codigo_sucursal || ' - ' ||  NEW.id_persona || ' - ' || NEW.id_oficina || ' - ' || NEW.id_perfil) THEN

codigo = NEW.codigo_sucursal || ' - ' ||  NEW.id_persona || ' - ' || NEW.id_oficina || ' - ' || NEW.id_perfil;
        
        UPDATE pasantias.encargado SET codigo_encargado = codigo WHERE codigo_sucursal = NEW.codigo_sucursal AND id_persona = NEW.id_persona AND id_oficina = NEW.id_oficina AND id_perfil=NEW.id_perfil ;

        RETURN NEW;
    ELSE 
   RETURN NULL;
    END IF ;
    END;
$function$
;
-- 

-- 
 CREATE OR REPLACE FUNCTION pasantias.codigoestudiante()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
DECLARE 
codigo  character varying; 

    BEGIN
    codigo= (SELECT codigo_estudiante FROM pasantias.estudiante WHERE id_persona = NEW.id_persona AND id_especialidad = NEW.id_especialidad AND id_ip = NEW.id_ip AND id_perfil=NEW.id_perfil);
   
    IF codigo <>( NEW.id_persona || ' - ' ||  NEW.id_especialidad || ' - ' || NEW.id_ip || ' - ' || NEW.id_perfil) THEN

codigo = NEW.id_persona || ' - ' ||  NEW.id_especialidad || ' - ' || NEW.id_ip || ' - ' || NEW.id_perfil;
        
        UPDATE pasantias.estudiante SET codigo_estudiante = codigo WHERE id_persona = NEW.id_persona AND id_especialidad = NEW.id_especialidad AND id_ip = NEW.id_ip AND id_perfil=NEW.id_perfil ;

        RETURN NEW;
    ELSE 
    RETURN NULL;
    END IF;
    END;
$function$
;
-- 

-- 
 CREATE OR REPLACE FUNCTION pasantias.codigosucursales()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
DECLARE 
codigo  character varying; 

    BEGIN

    codigo = (SELECT codigo_sucursal FROM pasantias.organizacionmunicipio  WHERE id_municipio = NEW.id_municipio AND id_organizacion = NEW.id_organizacion AND domicilio = NEW.domicilio AND observacion=NEW.observacion  );

    IF codigo <> (NEW.id_municipio || ' - ' ||  NEW.id_organizacion || ' - ' || NEW.domicilio) THEN 
    
    codigo = NEW.id_municipio || ' - ' ||  NEW.id_organizacion || ' - ' || NEW.domicilio ;
        
        UPDATE pasantias.organizacionmunicipio SET codigo_sucursal = codigo WHERE id_municipio = NEW.id_municipio AND id_organizacion = NEW.id_organizacion AND domicilio = NEW.domicilio AND observacion=NEW.observacion ;

        RETURN NEW;
    
ELSE 
RETURN NULL;
END IF;

    END;
$function$
;
-- 

-- 
 CREATE OR REPLACE FUNCTION pasantias.codigotemporada()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
DECLARE 
codigo  character varying; 

    BEGIN
    codigo = ( SELECT codigo_temporada FROM pasantias.temporadas_solicitud WHERE id_tipo_solicitud = NEW.id_tipo_solicitud AND id_periodo = NEW.id_periodo AND codigo_encargado = NEW.codigo_encargado  );
    
    IF codigo <> (NEW.id_tipo_solicitud || ' - ' ||  NEW.id_periodo || ' - ' || NEW.codigo_encargado) THEN 

codigo = NEW.id_tipo_solicitud || ' - ' ||  NEW.id_periodo || ' - ' || NEW.codigo_encargado ;
        
        UPDATE pasantias.temporadas_solicitud SET codigo_temporada = codigo WHERE id_tipo_solicitud = NEW.id_tipo_solicitud AND id_periodo = NEW.id_periodo AND codigo_encargado = NEW.codigo_encargado ;

        RETURN NEW;
        ELSE 
        RETURN NULL;
        END IF;
    END;
$function$
;
-- 

-- 
 CREATE OR REPLACE FUNCTION pasantias.codigotemporadaespecialidad()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
    DECLARE 
    codigo  character varying; 

    BEGIN
    codigo = (SELECT codigo_temporada_especialidad FROM pasantias.temporadas_especialidad  WHERE codigo_temporada = NEW.codigo_temporada AND id_especialidad = NEW.id_especialidad );
    
    IF codigo <> (NEW.codigo_temporada || ' - ' ||  NEW.id_especialidad) THEN
        
        codigo = NEW.codigo_temporada || ' - ' ||  NEW.id_especialidad;
        
        UPDATE pasantias.temporadas_especialidad SET codigo_temporada_especialidad = codigo WHERE codigo_temporada = NEW.codigo_temporada AND id_especialidad = NEW.id_especialidad ;

        RETURN NEW;
     ELSE 
    RETURN NULL;
     END IF ;

    END;
$function$
;
-- 

-- 
 CREATE OR REPLACE FUNCTION pasantias.codigotutoracademico()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
DECLARE 
codigoConcat  character varying; 

    BEGIN

    codigoConcat =( SELECT codigo_tutor_academico FROM pasantias.tutor_academico WHERE id_persona = NEW.id_persona AND id_especialidad = NEW.id_especialidad AND id_ip = NEW.id_ip AND id_perfil = NEW.id_perfil);

IF codigoConcat <> (NEW.id_persona || ' - ' ||  NEW.id_especialidad || ' - ' || NEW.id_ip  || ' - ' || NEW.id_perfil) THEN

codigoConcat = NEW.id_persona || ' - ' ||  NEW.id_especialidad || ' - ' || NEW.id_ip  || ' - ' || NEW.id_perfil ;
        
        UPDATE pasantias.tutor_academico SET codigo_tutor_academico = codigoConcat WHERE id_persona = NEW.id_persona AND id_especialidad = NEW.id_especialidad AND id_ip = NEW.id_ip AND id_perfil = NEW.id_perfil ;

        RETURN NEW;
    ELSE 
    RETURN NULL;
    END IF;
    END;
$function$
;
-- 

-- 
 CREATE OR REPLACE FUNCTION pasantias.codigotutorempresarial()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
DECLARE 
codigo  character varying; 

    BEGIN
    codigo = ( SELECT codigo_tutor_empresarial FROM pasantias.tutor_empresarial  WHERE codigo_sucursal = NEW.codigo_sucursal AND id_persona = NEW.id_persona AND id_oficina = NEW.id_oficina AND id_perfil = NEW.id_perfil  );
    
    IF codigo <> (NEW.codigo_sucursal || ' - ' ||  NEW.id_persona || ' - ' || NEW.id_oficina  || ' - ' || NEW.id_perfil) THEN

codigo = NEW.codigo_sucursal || ' - ' ||  NEW.id_persona || ' - ' || NEW.id_oficina  || ' - ' || NEW.id_perfil ;
        
        UPDATE pasantias.tutor_empresarial SET codigo_tutor_empresarial = codigo WHERE codigo_sucursal = NEW.codigo_sucursal AND id_persona = NEW.id_persona AND id_oficina = NEW.id_oficina AND id_perfil = NEW.id_perfil ;

        RETURN NEW;
    ELSE 
    RETURN NULL;
    END IF;

    END;
$function$
;
-- 

-- 
 CREATE OR REPLACE FUNCTION pasantias.estatustemporada()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
    DECLARE 
    codigo  character varying; 

    BEGIN

        codigo = NEW.codigo_temporada || ' - ' ||  NEW.id_especialidad;
        
        UPDATE pasantias.temporadas_solicitud SET estatus = 'PREPARADA' WHERE codigo_temporada = NEW.codigo_temporada;

        RETURN NEW;

    END;
$function$
;
-- 

--
CREATE TRIGGER codigosucursales AFTER INSERT OR UPDATE ON pasantias.encargado FOR EACH ROW EXECUTE PROCEDURE pasantias.codigoencargado();
--

--
CREATE TRIGGER codigosucursales AFTER INSERT OR UPDATE ON pasantias.temporadas_solicitud FOR EACH ROW EXECUTE PROCEDURE pasantias.codigotemporada();
--

--
CREATE TRIGGER codigosucursales AFTER INSERT OR UPDATE ON pasantias.solicitudes_recibidas FOR EACH ROW EXECUTE PROCEDURE pasantias.aprobarestudianteslistos();
--

--
CREATE TRIGGER codigosucursales AFTER INSERT OR UPDATE ON pasantias.tutor_academico FOR EACH ROW EXECUTE PROCEDURE pasantias.codigotutoracademico();
--

--
CREATE TRIGGER codigosucursales AFTER INSERT OR UPDATE ON pasantias.organizacionmunicipio FOR EACH ROW EXECUTE PROCEDURE pasantias.codigosucursales();
--

--
CREATE TRIGGER codigosucursales AFTER INSERT OR UPDATE ON pasantias.estudiante FOR EACH ROW EXECUTE PROCEDURE pasantias.codigoestudiante();
--

--
CREATE TRIGGER codigosucursales AFTER INSERT OR UPDATE ON pasantias.temporadas_especialidad FOR EACH ROW EXECUTE PROCEDURE pasantias.codigotemporadaespecialidad();
--

--
CREATE TRIGGER actualizacion AFTER INSERT ON pasantias.temporadas_especialidad FOR EACH ROW EXECUTE PROCEDURE pasantias.estatustemporada();
--

--
CREATE TRIGGER codigostutoracademico AFTER INSERT OR UPDATE ON pasantias.tutor_empresarial FOR EACH ROW EXECUTE PROCEDURE pasantias.codigotutorempresarial();
--
