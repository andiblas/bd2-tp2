/*CREATE DATABASE tp2;*/

drop table if exists persona;

create table persona (
	nombre varchar(30),
    apellido varchar(30),
    usuario varchar(30),
    clave varchar(200)
)

/*
create table IF NOT EXISTS persona (
	id SERIAL primary key,
	nombre varchar(30),
    apellido varchar(30),
    usuario varchar(30),
    clave varchar(200)
);

create table IF NOT EXISTS pelis_que_vio (
	peliculaID int,
    usuarioID int
);
ALTER TABLE pelis_que_vio add FOREIGN KEY (usuarioID) REFERENCES persona(id);

INSERT INTO persona (nombre, apellido, usuario, clave) values ('A', 'a', 'a', '123');
INSERT INTO persona (nombre, apellido, usuario, clave) values ('B', 'b', 'b', '123');
INSERT INTO persona (nombre, apellido, usuario, clave) values ('C', 'c', 'c', '123');
INSERT INTO persona (nombre, apellido, usuario, clave) values ('D', 'd', 'd', '123');
INSERT INTO persona (nombre, apellido, usuario, clave) values ('E', 'e', 'e', '123');
INSERT INTO persona (nombre, apellido, usuario, clave) values ('F', 'f', 'f', '123');
INSERT INTO persona (nombre, apellido, usuario, clave) values ('G', 'g', 'g', '123');
INSERT INTO persona (nombre, apellido, usuario, clave) values ('H', 'h', 'h', '123');
INSERT INTO persona (nombre, apellido, usuario, clave) values ('I', 'i', 'i', '123');

INSERT INTO pelis_que_vio values (1, 1);
INSERT INTO pelis_que_vio values (1, 2);
INSERT INTO pelis_que_vio values (1, 3);
INSERT INTO pelis_que_vio values (2, 4);
INSERT INTO pelis_que_vio values (2, 5);
INSERT INTO pelis_que_vio values (3, 5);
INSERT INTO pelis_que_vio values (3, 6);
INSERT INTO pelis_que_vio values (4, 6);
INSERT INTO pelis_que_vio values (4, 1);
INSERT INTO pelis_que_vio values (1, 6);


CREATE OR REPLACE VIEW paresUsuariosVieron as 
	SELECT DISTINCT p.usuarioID as id1, u.usuarioID as id2 
	from pelis_que_vio p, pelis_que_vio u
		WHERE p.peliculaID = u.peliculaID 
			and p.usuarioID < u.usuarioID
		ORDER BY p.usuarioID;
		
CREATE OR REPLACE VIEW usuariosNoVieronPelis as 
	SELECT id from persona 
		where NOT id in(SELECT DISTINCT usuarioID from pelis_que_vio);

CREATE OR REPLACE VIEW paresUsuariosNoVieronPelis as
	SELECT u.id as id1, p.id as id2 from usuariosNoVieronPelis p, usuariosNoVieronPelis u
	where u.id < p.id;

select * from paresUsuariosNoVieronPelis union select * from paresUsuariosVieron order by id1;
*/
