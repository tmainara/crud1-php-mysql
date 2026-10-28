-- tablas para el proyecto
create table articulos(
    id int unsigned auto_increment primary key,
    nombre varchar(40) unique,
    descripcion text
)