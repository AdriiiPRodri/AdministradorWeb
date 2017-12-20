CREATE DATABASE gestionabdera;

USE gestionabdera;

CREATE TABLE Privilegios (
	Nombre_privilegio CHAR(25) NOT NULL,
	Descripcion CHAR(255),
	CONSTRAINT Privilegios_pk PRIMARY KEY (Nombre_privilegio)
	);
	
CREATE TABLE Departamento (
	Nombre_departamento CHAR(75) NOT NULL,
	Descripcion CHAR(255),
	Ubicacion CHAR(100),
	CONSTRAINT Departamento_pk PRIMARY KEY (Nombre_departamento)
	);
	
CREATE TABLE Dependencias (
	Nombre_dependencia CHAR(75) NOT NULL,
	Descripcion CHAR(255),
	Ubicacion CHAR(100),
	CONSTRAINT Dependencias_pk PRIMARY KEY (Nombre_dependencia)
	);
	
CREATE TABLE Materiales (
	ID_material CHAR(9) NOT NULL,
	Nombre CHAR(75) NOT NULL,
	Estado SET('NO CORREGIDO','PENDIENTE','CORREGIDO') DEFAULT 'NO CORREGIDO',
	Unidades_totales INTEGER,
	Tipo CHAR(25),
	Dependencia CHAR(75) NOT NULL,
	CONSTRAINT Materiales_pk PRIMARY KEY (ID_material)
	);
	
CREATE TABLE Contiene (
	Dependencia CHAR(75) NOT NULL,
	ID_material CHAR(9) NOT NULL,
	Unidades INTEGER NOT NULL,
	CONSTRAINT Contiene_pk PRIMARY KEY (Dependencia,ID_material),
	CONSTRAINT Contiene_fk1 FOREIGN KEY (Dependencia) REFERENCES Dependencias(Nombre_dependencia),
	CONSTRAINT Contiene_fk2 FOREIGN KEY (ID_material) REFERENCES Materiales(ID_material)
	);
	
CREATE TABLE Usuarios (
	ID_usuario CHAR(9) NOT NULL,
	Nombre_completo CHAR(100) NOT NULL,
	Contrasena CHAR(50) NOT NULL,
	Privilegios CHAR(25) NOT NULL,
	Departamento CHAR(75),
	Otros CHAR(255),
	CONSTRAINT Usuarios_pk PRIMARY KEY (ID_usuario),
	CONSTRAINT Usuarios_fk1 FOREIGN KEY (Privilegios) REFERENCES Privilegios(Nombre_privilegio),
	CONSTRAINT Usuarios_fk2 FOREIGN KEY (Departamento) REFERENCES Departamento(Nombre_departamento)
	);
	
CREATE TABLE Entradas_sistema (
	N_entrada CHAR(9) NOT NULL,
	Usuario CHAR(9) NOT NULL,
	F_entrada DATETIME NOT NULL,
	F_salida DATETIME,
	CONSTRAINT Entradas_sistema_pk PRIMARY KEY (N_entrada),
	CONSTRAINT Entradas_sistema_fk1 FOREIGN KEY (Usuario) REFERENCES Usuarios(ID_usuario)
	);
	
CREATE TABLE Incidencias (
	N_incidencia CHAR(9) NOT NULL,
	Descripcion CHAR(255),
	Departamento CHAR(75),
	Dependencia CHAR(75) NOT NULL,
	Fecha DATE,
	Hora TIME,
	Estado CHAR(25) DEFAULT 'NO CORREGIDO',
	Tipo CHAR(25),
	Usuario CHAR(9) NOT NULL,
	CONSTRAINT Incidencias_pk PRIMARY KEY (N_incidencia),
	CONSTRAINT Incidencias_fk1 FOREIGN KEY (Departamento) REFERENCES Departamento(Nombre_departamento),
	CONSTRAINT Incidencias_fk2 FOREIGN KEY (Dependencia) REFERENCES Dependencias(Nombre_dependencia),
	CONSTRAINT Incidencias_fk3 FOREIGN KEY (Usuario) REFERENCES Usuarios(ID_usuario)
	);
	
	/*
	CREATE TABLE Historico_usuarios (
	ID_usuario CHAR(9) NOT NULL,
	Nombre_completo CHAR(100) NOT NULL,
	Contrasena CHAR(50) NOT NULL,
	Privilegios CHAR(25) NOT NULL,
	Departamento CHAR(75),
	Otros CHAR(255),
	CONSTRAINT H_Usuarios_pk PRIMARY KEY (ID_usuario),
	CONSTRAINT H_Usuarios_fk1 FOREIGN KEY (Privilegios) REFERENCES Privilegios(Nombre_privilegio),
	CONSTRAINT H_Usuarios_fk2 FOREIGN KEY (Departamento) REFERENCES Departamento(Nombre_departamento)
	);
	*/