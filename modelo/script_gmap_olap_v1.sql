CREATE TABLE Dim_Actividad (
  idDim_Actividad INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  codigo VARCHAR(10)  NULL  ,
  nombre VARCHAR(100)  NULL    ,
PRIMARY KEY(idDim_Actividad));



CREATE TABLE Dim_Contratista (
  idDim_Contratista INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(50)  NULL  ,
  nombreve VARCHAR(50)  NULL    ,
PRIMARY KEY(idDim_Contratista));



CREATE TABLE Dim_Empleado (
  idDim_Empleado INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  nombres VARCHAR(100)  NULL  ,
  edad INTEGER UNSIGNED  NULL  ,
  sexo BIT  NULL  ,
  nrodoc VARCHAR(11)  NULL  ,
  fechanac DATE  NULL  ,
  idtipoempleado INTEGER UNSIGNED  NULL    ,
PRIMARY KEY(idDim_Empleado));



CREATE TABLE Dim_Lugar (
  idDim_Lugar INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  pais VARCHAR(50)  NULL  ,
  departamento VARCHAR(50)  NULL  ,
  distrito VARCHAR(50)  NULL    ,
PRIMARY KEY(idDim_Lugar));



CREATE TABLE Dim_Tiempo (
  idDim_Tiempo INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  fecha DATE  NOT NULL  ,
  anio INTEGER UNSIGNED  NULL  ,
  mes INTEGER UNSIGNED  NULL  ,
  dia INTEGER UNSIGNED  NULL    ,
PRIMARY KEY(idDim_Tiempo));



CREATE TABLE Fact_Trabajos (
  idFact_Trabajos INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  Dim_Empleado_idDim_Empleado INTEGER UNSIGNED  NOT NULL  ,
  Dim_Lugar_idDim_Lugar INTEGER UNSIGNED  NOT NULL  ,
  Dim_Actividad_idDim_Actividad INTEGER UNSIGNED  NOT NULL  ,
  Dim_Contratista_idDim_Contratista INTEGER UNSIGNED  NOT NULL  ,
  Dim_Tiempo_idDim_Tiempo INTEGER UNSIGNED  NOT NULL  ,
  nrotrabajosok INTEGER UNSIGNED  NULL  ,
  nrotrabajosfail INTEGER UNSIGNED  NULL    ,
PRIMARY KEY(idFact_Trabajos, Dim_Empleado_idDim_Empleado, Dim_Lugar_idDim_Lugar, Dim_Actividad_idDim_Actividad, Dim_Contratista_idDim_Contratista, Dim_Tiempo_idDim_Tiempo)  ,
INDEX Fact_Trabajos_FKIndex1(Dim_Empleado_idDim_Empleado)  ,
INDEX Fact_Trabajos_FKIndex2(Dim_Lugar_idDim_Lugar)  ,
INDEX Fact_Trabajos_FKIndex3(Dim_Actividad_idDim_Actividad)  ,
INDEX Fact_Trabajos_FKIndex4(Dim_Contratista_idDim_Contratista)  ,
INDEX Fact_Trabajos_FKIndex5(Dim_Tiempo_idDim_Tiempo));




