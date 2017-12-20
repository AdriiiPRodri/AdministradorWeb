USE gestionabdera;

INSERT INTO Departamento (Nombre_departamento,Descripcion,Ubicacion) VALUES ("Informatica","D.Informatica","Edificio1"),("Lengua","D.Lengua","Edificio1"),("Biologia","D.Biologia","Edificio1"),("Matematicas","D.Matematicas","Edificio1"),("Etica","D.Etica","Edificio2");
INSERT INTO Dependencias (Nombre_dependencia,Descripcion,Ubicacion,Nombre_departamento) VALUES ("Aula 6","Aula 6 Edificio1","Edificio1","Informatica"),("Aula 7","Aula 7 Edificio1","Edificio1","Lengua");
INSERT INTO Materiales (ID_material,Descripcion,Unidades_totales,Tipo) VALUES ("PC01-A6","Ordenador 1 Aula 6",1,"TIC"),("PC15-A6","Ordenador 15 Aula 6",1,"TIC");
INSERT INTO Privilegios (Nombre_privilegio,Descripcion) VALUES ("Administrador","Administra"),("Normal","Usuario comun");
INSERT INTO Usuarios (ID_usuario,Nombre_completo,Contrasena,Privilegios,Departamento,Otros) VALUES ("admin","Administrador","admin","Administrador","Informatica","Mayores privilegios"),("tarifa","J.A.Tarifa","tarifa","Normal","Matematicas","Privilegios Normales");
INSERT INTO Contiene (Nombre_dependencia,ID_material,Unidades) VALUES ("Aula 6","PC01-A6",1), ("Aula 7","PC15-A6",1);
INSERT INTO Incidencias (N_incidencia,Descripcion,Dependencia,Fecha_hora,Estado,Tipo,Usuario,Comentario) VALUES ("00001","Ordenador 1 del aula 6 no enciende","Aula 6","2015-05-22 00:00:00","NO CORREGIDO","TIC","tarifa","Comentario"),("00002","Ordenador 2 del aula 6 no enciende","Aula 6","2015-05-23 00:00:00","PENDIENTE","TIC","tarifa","Comentario");