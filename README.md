# CRUD de artículos con PHP y MySQL

Aplicación web desarrollada como proyecto de aprendizaje de 2.º de DAW. Permite gestionar artículos mediante las operaciones básicas de un CRUD.

## Tecnologías utilizadas

* PHP
* MySQL / MariaDB
* PDO para la conexión con la base de datos
* Composer para gestionar dependencias
* Tailwind CSS

## Funcionalidades

* Crear artículos.
* Consultar los artículos registrados.
* Editar artículos existentes.
* Eliminar artículos.
* Validar los datos introducidos en los formularios.

## Estructura del proyecto

* `public/`: páginas de la aplicación.
* `scripts/`: scripts auxiliares.
* `sql/`: archivos SQL para la base de datos.
* `src/`: clases y lógica de la aplicación.
* `.env.example`: ejemplo de configuración.
* `composer.json`: dependencias del proyecto.

## Instalación

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/tmainara/crud1-php-mysql.git
   ```

2. Entrar en la carpeta del proyecto:

   ```bash
   cd crud1-php-mysql
   ```

3. Instalar las dependencias:

   ```bash
   composer install
   ```

4. Crear las tablas de la base de datos utilizando el archivo SQL de la carpeta `sql/`.

5. Crear el archivo `.env` a partir de `.env.example` y configurar los datos de conexión a la base de datos.

6. Configurar el servidor web para utilizar la carpeta `public/`.

## Estado del proyecto

Proyecto realizado con fines educativos para practicar PHP, bases de datos y operaciones CRUD.
