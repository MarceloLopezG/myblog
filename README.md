-----------------------------------------------------------------------
            - - - Pasos para ejecutar el proyecto  - - - 
-----------------------------------------------------------------------
1.- Clonar y acceder al proyecto

. git clone https://github.com/MarceloLopezG/myblog.git
 <br/>
. cd myblog
<br/>

Una vez adentro del proyecto, renombrar el archivo .env.example a  <br/>  <span><b> .env<b/><span/>
<br/>
<br/>

2.- Instalar los paquetes
<br/>
. composer update
<br/>
. php artisan passport:install
<br/>
. php artisan vendor:publish --tag=passport-config
<br/>
. php artisan key:generate
<br/>
. php artisan config:cache
<br/>
. php artisan serve
<br/>
<br/>
Nota: No olvide crear su base de datos y nombrarlo como myblogdb
