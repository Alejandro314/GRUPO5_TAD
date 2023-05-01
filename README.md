# GRUPO5_TAD


## Para usar el proyecto

### Raiz del proyecto: ../GRUPO5_TAD/CarUPO/
 
* Ejecutar en la raiz del proyecto: composer install
* Copiar .env.example con el nombre .env
* Ejecutar en la raiz del proyecto: php artisan key:generate
* Crear la base de datos "CREATE DATABASE carupo;"
* Indicar el nombre de la base de datos en el .env
* Ejecutar en la raiz del proyecto: php artisan migrate:fresh --seed
* Instalar las dependencias de bootstrap: npm install bootstrap --save-dev
* Instalar las dependencias de sass: npm install sass --save-dev
* Para arrancar ejecutamos el comando: php artisan serve
* Ademas el comando: npm run dev


## CONFIGURACIÓN CORREO

* MAIL_MAILER=smtp
* MAIL_HOST=sandbox.smtp.mailtrap.io
* MAIL_PORT=2525
* MAIL_USERNAME=ebe09365c68a38
* MAIL_PASSWORD=3cf05ccadeec49
* MAIL_ENCRYPTION=tls


## USUARIOS

### Usuario administrador

* Usuario: admin@hotmail.com
* Contraseña: admin

### Usuarios de pruebas

* Usuario: lidia@carupo.es
* Contraseña: 1234

* Usuario: alberto@carupo.es
* Contraseña: 1234

* Usuario: alejandro@carupo.es
* Contraseña: 1234

### Otros usuarios

* Usuario: Son usuarios creados aleatoriamente.
* Contraseña: password
