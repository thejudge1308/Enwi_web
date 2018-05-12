
 CREATE TABLE biblioteca.lector(
  rut VARCHAR(256),
  nombre VARCHAR(256),
  apellidoPaterno VARCHAR(256),
  apellidoMaterno VARCHAR(256),
  direccion VARCHAR(256),
  telefono VARCHAR(256),
  correoElectronico VARCHAR(256),
  observacion VARCHAR(256),
  estado VARCHAR(256),
  PRIMARY KEY(rut)
);

CREATE TABLE biblioteca.trabajador(
  correoElectronico VARCHAR(256),
  contasena VARCHAR(256),
  rut VARCHAR(256),
  nombre VARCHAR(256),
  apellidoPaterno VARCHAR(256),
  apellidoMaterno VARCHAR(256),
  direccion VARCHAR(256),
  telefono VARCHAR(256),
  contactoEmergenciaNombre VARCHAR(256),
  contactoEmergenciaTelefono VARCHAR(256),
  tipo VARCHAR(256),
  PRIMARY KEY(correoElectronico)
);

CREATE TABLE biblioteca.estante(
  codigo INTEGER,
  intervaloInf INTEGER,
  intervaloSup INTEGER,
  PRIMARY KEY(codigo)
);

CREATE TABLE biblioteca.nivel(
  codigo INTEGER,
  codigoEstante INTEGER,
  FOREIGN KEY(codigoEstante) REFERENCES estante(codigo) ON DELETE CASCADE,
  PRIMARY KEY(codigo)
);

CREATE TABLE biblioteca.libro(
  ISBN VARCHAR(256),
  titulo VARCHAR(256),
  ano INTEGER,
  edicion VARCHAR(256),
  autor VARCHAR(256),
  PRIMARY KEY(ISBN)
);

CREATE TABLE biblioteca.copia(
  codigo VARCHAR(256),
  ISBNLibro VARCHAR(256),
  numeroCopia VARCHAR(256),
  estado VARCHAR(256),
  FOREIGN KEY(ISBNLibro) REFERENCES libro(ISBN) ON DELETE CASCADE,
  PRIMARY KEY(codigo)
);

CREATE TABLE biblioteca.prestamo(
  codigo INTEGER AUTO_INCREMENT,
  refLector VARCHAR(256),
  refTrabajador VARCHAR(256),
  fechaPrestamo VARCHAR(256),
  fechaDevolucion VARCHAR(256),
  FOREIGN KEY(refLector) REFERENCES lector(rut) ON DELETE CASCADE,
  FOREIGN KEY(refTrabajador) REFERENCES trabajador(correoElectronico) ON DELETE CASCADE,
  PRIMARY KEY(codigo)
);

CREATE TABLE biblioteca.prestamoCopia(
  codigoPrestamo INTEGER,
  codigoCopia VARCHAR(256),
  FOREIGN KEY(codigoPrestamo) REFERENCES prestamo(codigo) ON DELETE CASCADE,
  FOREIGN KEY(codigoCopia) REFERENCES copia(codigo) ON DELETE CASCADE
);