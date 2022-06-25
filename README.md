-----------------------------------------------------------------------
            - - - Pasos para ejecutar el proyecto  - - - 
-----------------------------------------------------------------------
1.- Clonar y acceder al proyecto

. git clone https://github.com/MarceloLopezG/myblog.git
 <br/>
. cd myblog


Una vez adentro del proyecto, renombrar el archivo .env.example
a  .env

2.- Instalar los paquetes
. composer update
. php artisan passport:install
. php artisan vendor:publish --tag=passport-config
. php artisan key:generate
. php artisan config:cache
. php artisan serve


Nota: No olvide crear su base de datos y nombrarlo como myblogdb
