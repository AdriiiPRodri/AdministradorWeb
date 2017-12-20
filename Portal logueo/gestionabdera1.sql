USE gestionabdera;

INSERT INTO Dependencias (Nombre_dependencia,Descripcion,Ubicacion) VALUES ("Aula 6","Aula 6 Edificio1","Edificio1");
INSERT INTO Materiales (ID_material,Nombre,Unidades_totales,Tipo,Dependencia) VALUES ("PC01-A6","Ordenador 1 Aula 6",1,"Ordenador","Aula 6");
INSERT INTO Materiales (ID_material,Nombre,Estado,Unidades_totales,Tipo,Dependencia) VALUES ("PC15-A6","Ordenador 15 Aula 6","CORREGIDO",1,"Ordenador","Aula 6"),("PC14-A6","Ordenador 15 Aula 6","PENDIENTE",1,"Ordenador","Aula 6");
INSERT INTO Privilegios (Nombre_privilegio,Descripcion) VALUES ("Administrador","Administra"),("Normal","Usuario comun");
INSERT INTO Departamento (Nombre_departamento,Descripcion,Ubicacion) VALUES ("Informatica","D.Informatica","Edificio1"),("Lengua","D.Lengua","Edificio1"),("Biologia","D.Biologia","Edificio1"),("Matematicas","D.Matematicas","Edificio1"),("Etica","D.Etica","Edificio2");
INSERT INTO Usuarios (ID_usuario,Nombre_completo,Contrasena,Privilegios,Departamento,Otros) VALUES ("admin","Administrador","admin","Administrador","Informatica","Mayores privilegios"),("tarifa","J.A.Tarifa","tarifa","Normal","Matematicas","Privilegios Normales");
INSERT INTO Contiene (Dependencia,ID_material,Unidades) VALUES ("Aula 6","PC01-A6",1), ("Aula 6","PC15-A6",1),("Aula 6","PC14-A6",1);
INSERT INTO Incidencias (N_incidencia,Descripcion,Departamento,Dependencia,Fecha,Hora,Estado,Tipo,Usuario) VALUES ("A0001","Ordenador 1 del aula 6 no enciende","Matematicas","Aula 6","2015-05-22","00:00:00","NO CORREGIDO","Ordenador","tarifa")