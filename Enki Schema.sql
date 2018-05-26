CREATE TABLE biblioteca.trabajador (
  correoElectronico varchar(256) NOT NULL UNIQUE,
  contrasena varchar(256) DEFAULT NULL,
  rut varchar(256) NOT NULL,
  nombre varchar(256) DEFAULT NULL,
  apellidoPaterno varchar(256) DEFAULT NULL,
  apellidoMaterno varchar(256) DEFAULT NULL,
  direccion varchar(256) DEFAULT NULL,
  telefono varchar(256) DEFAULT NULL,
  contactoEmergenciaNombre varchar(256) DEFAULT NULL,
  contactoEmergenciaTelefono varchar(256) DEFAULT NULL,
  tipo varchar(256) DEFAULT NULL,
  PRIMARY KEY(rut)
);

CREATE TABLE biblioteca.copia (
  codigo int NOT NULL AUTO_INCREMENT,
  isbnlibro varchar(256) DEFAULT NULL,
  numerocopia varchar(256) DEFAULT NULL,
  estado varchar(256) DEFAULT NULL,
  ubicacion varchar(200) NOT NULL,
  PRIMARY KEY(codigo)
);

CREATE TABLE biblioteca.estante (
  codigo int NOT NULL AUTO_INCREMENT,
  intervaloInf int(11) DEFAULT NULL,
  intervaloSup int(11) DEFAULT NULL,
  numero int NOT NULL,
  cantidadniveles int NOT NULL,
  PRIMARY KEY(codigo)
); 


CREATE TABLE biblioteca.lector (
  rut varchar(256) NOT NULL,
  nombre varchar(256) DEFAULT NULL,
  apellidoPaterno varchar(256) DEFAULT NULL,
  apellidoMaterno varchar(256) DEFAULT NULL,
  direccion varchar(256) DEFAULT NULL,
  telefono varchar(256) DEFAULT NULL,
  correoElectronico varchar(256) DEFAULT NULL,
  observacion varchar(256) DEFAULT NULL,
  estado varchar(256) DEFAULT NULL,
  PRIMARY KEY(rut)
);


CREATE TABLE biblioteca.libro (
  isbn varchar(256) NOT NULL,
  titulo varchar(256) DEFAULT NULL,
  anio int(11) DEFAULT NULL,
  edicion varchar(256) DEFAULT NULL,
  ncopias varchar(1000) NOT NULL,
  autor varchar(256) DEFAULT NULL,
  dewey varchar(200) NOT NULL,
  PRIMARY KEY(isbn)
);



CREATE TABLE biblioteca.nivel (
  codigo int(11) NOT NULL,
  codigoEstante int(11) NOT NULL,
  FOREIGN KEY(codigoEstante) REFERENCES estante(codigo) ON DELETE CASCADE,
  PRIMARY KEY(codigo,codigoEstante)
);


CREATE TABLE biblioteca.prestamo(
  codigo int NOT NULL AUTO_INCREMENT,
  refLector varchar(256) DEFAULT NULL,
  refTrabajador varchar(256) DEFAULT NULL,
  fechaPrestamo varchar(256) DEFAULT NULL,
  fechaDevolucion varchar(256) DEFAULT NULL,
  FOREIGN KEY(refLector) REFERENCES lector(rut) ON DELETE CASCADE,
  FOREIGN KEY(refTrabajador) REFERENCES trabajador(rut) ON DELETE CASCADE,
  PRIMARY KEY(codigo)
);


CREATE TABLE biblioteca.prestamocopia (
  codigoPrestamo int DEFAULT NULL,
  codigoCopia int DEFAULT NULL,
  FOREIGN KEY(codigoPrestamo) REFERENCES prestamo(codigo) ON DELETE CASCADE,
  FOREIGN KEY(codigoCopia) REFERENCES copia(codigo) ON DELETE CASCADE
);






