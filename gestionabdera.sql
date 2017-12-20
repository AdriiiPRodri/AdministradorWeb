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
	Nombre_departamento CHAR(75),
	CONSTRAINT Dependencias_pk PRIMARY KEY (Nombre_dependencia),
	CONSTRAINT Dependencias_fk1 FOREIGN KEY (Nombre_departamento) REFERENCES Departamento(Nombre_departamento) ON DELETE CASCADE
	);
	
CREATE TABLE Materiales (
	ID_material CHAR(9) NOT NULL,
	Descripcion CHAR(75) NOT NULL,
	Unidades_totales INTEGER,
	Tipo CHAR(10) DEFAULT 'TIC',
	CONSTRAINT Materiales_pk PRIMARY KEY (ID_material)
	);
	
CREATE TABLE Contiene (
	Nombre_dependencia CHAR(75) NOT NULL,
	ID_material CHAR(9) NOT NULL,
	Unidades INTEGER NOT NULL,
	CONSTRAINT Contiene_pk PRIMARY KEY (ID_material),
	CONSTRAINT Contiene_fk1 FOREIGN KEY (Nombre_dependencia) REFERENCES Dependencias(Nombre_dependencia) ON DELETE CASCADE,
	CONSTRAINT Contiene_fk2 FOREIGN KEY (ID_material) REFERENCES Materiales(ID_material) ON DELETE CASCADE
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
	N_entrada INTEGER NOT NULL,
	Usuario CHAR(9) NOT NULL,
	F_entrada DATETIME NOT NULL,
	F_salida DATETIME,
	CONSTRAINT Entradas_sistema_pk PRIMARY KEY (N_entrada)
	);
	
CREATE TABLE Incidencias (
	N_incidencia INTEGER NOT NULL,
	Descripcion CHAR(255),
	Dependencia CHAR(75) NOT NULL,
	Fecha_hora DATETIME,
	Estado SET ('PENDIENTE', 'CORREGIDO', 'NO CORREGIDO') DEFAULT 'NO CORREGIDO',
	Tipo SET ('TIC', 'Mobiliario', 'Otros') DEFAULT 'TIC',
	Usuario CHAR(9) NOT NULL,
	Fecha_correccion DATETIME,
	Comentario CHAR(255),
	CONSTRAINT Incidencias_pk PRIMARY KEY (N_incidencia),
	CONSTRAINT Incidencias_fk1 FOREIGN KEY (Dependencia) REFERENCES Dependencias(Nombre_dependencia) ON DELETE CASCADE,
	CONSTRAINT Incidencias_fk2 FOREIGN KEY (Usuario) REFERENCES Usuarios(ID_usuario) ON DELETE CASCADE
	);
	
	
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
	