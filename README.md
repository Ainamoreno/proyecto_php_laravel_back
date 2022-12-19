### Proyecto PHP y Laravel

#### Tecnologías utilizadas:
- Laravel
- PHP

#### Base de datos
Consta de cinco tablas (usuarios, chats, juegos, mensajes y la intermedia entre usuarios y chats).

![image](https://user-images.githubusercontent.com/110055279/208129639-31df1452-38d9-452b-aab2-9a7e55f8a1bc.png)

#### Instrucciones para usar la API

- Clonar el repositorio y lanzar el comando `composer install`
- Para levantar el servidor tenemos que lanzar el comando `php artisan serve`

#### Endpoints en Postman

Link: https://api.postman.com/collections/24265919-75a9810b-b78d-49e8-997b-0fe3216d89b7?access_key=PMAT-01GMDSN4HTCNK0SFB5EXQ6AMDJ

#### Funcionalidades

- Registro de un usuario
- Inicio de sesión de un usuario ya registrado
- Acceso a los datos de un usuario
- Cierre de sesión
- Modificar datos del usuario

- Crear chats de un videojuego: añadiendo el nombre del chat y el id del videojuego por parámetro de la ruta.
- Mostrar chats del usuario que lo solicite sobre un videojuego: añadiendo el id del videojuego por parámetro en la ruta.
- Entrar en una party: añadiendo en el body el id del juego y el nombre del chat.
- Salir de una party: añadiendo en el body el id del juego y nombre del chat.

- Enviar mensaje a la party: añadiendo en el body el id de la party y el mensaje.
- Modificar un mensaje: añadiendo al body el nuevo mensaje y por parámetro de la ruta el id de la party en la que nos encontremos.
- Mostrar todos los mensajes: añadiendo por parámetro de la ruta el id de la party.
- Eliminar un mensaje: añadiendo por parámetro el id del mensaje.
