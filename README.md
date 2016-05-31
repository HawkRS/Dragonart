Desarrolladores
===============

 * Lazcano Origel Mauricio Gerardo
 * Lopez Fonseca Lidia Paola



Descripci�n del proyecto
========================

"Dragon Art" tiene como prop�sito ser un espacio para que artistas, apasionados o aficionados al dibujo puedan compartir sus creaciones con todas las personas que visiten este sitio. "Dragon Art" tiene la estructura MVC utilizando html, css, php, mysql, ajax, javascript, jquery y bootstrap (recompilado). Se tendr�n tres formas de utilizarlo:


Usuarios no registrados
-----------------------
Aquellos usuarios que no deseen registrarse, �nicamente podr�n visualizar las im�genes, comentarios y perfiles de los usuarios registrados.


Usuarios registrados
--------------------
El registro se realizar� mediante la conexi�n a facebook o llenando un formulariocon la informaci�n b�sica (nombre de usuario, alias, contrase�a, correo electr�nico).

El usuario podr� realizar las siguientes acciones:
* Agregar y eliminar las im�genes que suba, adem�s de modificar en cualquier momento el titulo, descripci�n y tags de estas.
*Agregar im�genes de otros usuarios a su secci�n de favoritos.
* Seguir a cuentos usuarios registrados desee.
* Comentar las im�genes que se encuentran en la plataforma. Al igual que sus im�genes podr�n recibir comentarios.
* Contar� con una secci�n de notificaciones, en la cual aparecer�n los nuevos seguidores, l�s im�genes que han subido los usuarios que sigue y los favoritos que ha recibido.
* Un espacio para editar su perfil (biograf�a, avatar, alias y cambio de contrase�a).


Usuarios administradores
-------------------------
Ser�n los encargados de administrar el buen funcionamiento de "Dragon Art", estos solo podr�n ser dados de alta por otros 
administradores. Podr�n realizar las mismas acciones que un usuario registrado, adem�s de:
* Dar de alta a otros usuario, sean administradores o no
* Bloquear usuarios en caso de un comportamiento inadecuado
* Modificar los campos que no est�n disponibles para un usuario sin privilegios
* Realizar multiples consultas a la base de datos, al igual que realizar multiples operaciones como modificar y eliminar.


Funciones adicionales
----------------------
* Cada imagen podr� ser favoriteada, mostrando al usuario propietario el promedio de dichas calificaciones.
* El sistema de b�squeda cuenta con prioridades, mismo que primeramente mostrar� las im�genes donde su t�tulo coincida con la palabra que se haya ingresado, despu�s podr� seleccionar alguno de los filtros disponibles para cambiar el tipo de b�squeda.
* En la p�gina de inicio, se mostrar�n las 10 im�genes con mejor calificaci�n.
* Se tiene disponbible un sistema de recuperaci�n de contrase�a, el cu�l solicita el correo con el que se registr� el usuario y posteriormente se manda un correo con el v�nculo para proceder con el cambio de contrase�a. Una vez realizado est� proceso, se pedir� al usuario que inicie sesi�n, al mismo tiempo que se le estar� mandando un correo de confirmaci�n de cambio de contrase�a.
* Por �ltimo, se cuenta con un secci�n de contacto en el cual los usuarios registrados y no registrados podr�n ponerse en contacto con "Digital Dragon"



Demo
=====

http://dragonart.silverdragon.xyz/



Requerimientos
===============

 * Servidor web
 * Servidor de correos (en este caso espec�fico, se utiliz� gmail)
 * PHP 5 con los siguientes m�dulos: iMagick (instalar), phpMailer (incluido)
 * API para conexi�n con facebook (incluido)
 * mySQL 5



Instalaci�n
===========

Para poder ejecutar "Dragon Art" de manera local ser� necesario realizar los siguientes pasos:

1. Copiar todo el repositorio a la carpeta del servidor web
2. Verificar la correcta conexi�n con la base de datos y el servidor de correos



Licencias
===========

"Dragon Art" est� licenciado bajo software libre, por lo que cualquier persona podr� mejorar el dise�o y desempe�o que este tenga al t�rmino de su desarrollo ya que el c�digo estar� disponible para su modificaci�n y/o adaptaci�n. 


Sobre el contenido
------------------

Los dibujos que sean publicados en est� plataforma tendr�n derechos de autor. Se suguiere que todas las im�genes que sean publicadas cuenten con una marca de agua del autor, ya que se recuerda a los usuarios que cualquier visitante tendr� acceso a las im�genes que se encuentre cargadas en la plataforma "Dragon Art".
