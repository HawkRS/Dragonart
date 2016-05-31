Desarrolladores
===============

 * Lazcano Origel Mauricio Gerardo
 * Lopez Fonseca Lidia Paola



Descripción del proyecto
========================

"Dragon Art" tiene como propósito ser un espacio para que artistas, apasionados o aficionados al dibujo puedan compartir sus creaciones con todas las personas que visiten este sitio. "Dragon Art" tiene la estructura MVC utilizando html, css, php, mysql, ajax, javascript, jquery y bootstrap (recompilado). Se tendrán tres formas de utilizarlo:


Usuarios no registrados
-----------------------
Aquellos usuarios que no deseen registrarse, únicamente podrán visualizar las imágenes, comentarios y perfiles de los usuarios registrados.


Usuarios registrados
--------------------
El registro se realizará mediante la conexión a facebook o llenando un formulariocon la información básica (nombre de usuario, alias, contraseña, correo electrónico).

El usuario podrá realizar las siguientes acciones:
* Agregar y eliminar las imágenes que suba, además de modificar en cualquier momento el titulo, descripción y tags de estas.
*Agregar imágenes de otros usuarios a su sección de favoritos.
* Seguir a cuentos usuarios registrados desee.
* Comentar las imágenes que se encuentran en la plataforma. Al igual que sus imágenes podrán recibir comentarios.
* Contará con una sección de notificaciones, en la cual aparecerán los nuevos seguidores, lás imágenes que han subido los usuarios que sigue y los favoritos que ha recibido.
* Un espacio para editar su perfil (biografía, avatar, alias y cambio de contraseña).


Usuarios administradores
-------------------------
Serán los encargados de administrar el buen funcionamiento de "Dragon Art", estos solo podrán ser dados de alta por otros 
administradores. Podrán realizar las mismas acciones que un usuario registrado, además de:
* Dar de alta a otros usuario, sean administradores o no
* Bloquear usuarios en caso de un comportamiento inadecuado
* Modificar los campos que no están disponibles para un usuario sin privilegios
* Realizar multiples consultas a la base de datos, al igual que realizar multiples operaciones como modificar y eliminar.


Funciones adicionales
----------------------
* Cada imagen podrá ser favoriteada, mostrando al usuario propietario el promedio de dichas calificaciones.
* El sistema de búsqueda cuenta con prioridades, mismo que primeramente mostrará las imágenes donde su título coincida con la palabra que se haya ingresado, después podrá seleccionar alguno de los filtros disponibles para cambiar el tipo de búsqueda.
* En la página de inicio, se mostrarán las 10 imágenes con mejor calificación.
* Se tiene disponbible un sistema de recuperación de contraseña, el cuál solicita el correo con el que se registró el usuario y posteriormente se manda un correo con el vínculo para proceder con el cambio de contraseña. Una vez realizado esté proceso, se pedirá al usuario que inicie sesión, al mismo tiempo que se le estará mandando un correo de confirmación de cambio de contraseña.
* Por último, se cuenta con un sección de contacto en el cual los usuarios registrados y no registrados podrán ponerse en contacto con "Digital Dragon"



Demo
=====

http://dragonart.silverdragon.xyz/



Requerimientos
===============

 * Servidor web
 * Servidor de correos (en este caso específico, se utilizó gmail)
 * PHP 5 con los siguientes módulos: iMagick (instalar), phpMailer (incluido)
 * API para conexión con facebook (incluido)
 * mySQL 5



Instalación
===========

Para poder ejecutar "Dragon Art" de manera local será necesario realizar los siguientes pasos:

1. Copiar todo el repositorio a la carpeta del servidor web
2. Verificar la correcta conexión con la base de datos y el servidor de correos



Licencias
===========

"Dragon Art" está licenciado bajo software libre, por lo que cualquier persona podrá mejorar el diseño y desempeño que este tenga al término de su desarrollo ya que el código estará disponible para su modificación y/o adaptación. 


Sobre el contenido
------------------

Los dibujos que sean publicados en está plataforma tendrán derechos de autor. Se suguiere que todas las imágenes que sean publicadas cuenten con una marca de agua del autor, ya que se recuerda a los usuarios que cualquier visitante tendrá acceso a las imágenes que se encuentre cargadas en la plataforma "Dragon Art".
