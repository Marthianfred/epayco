El Proyecto esta Separado en dos Folder

ambos servicios estan en Lumen
ambos servicios usan Laravel\Doctrine ORM

svrSoap Encargado del Servicio Soap
configuracion Incial para Soap

svrRest Encargado del Servicio Rest

composer install para obtener las dependencias.. construi el proyecto en php 7.2

php artisan serve el puesto para el soap dejarlo en 8080 y el rest 80

dentro de svrSoap Folder

configuracion de la db
crear db para proyecto... por lo general se llama homestad

luego en consola.. conrrer las entidades...
php artisan doctrine:schema:create

con esto ya tenemos la db con sus respectivas tablas creadas relaciones etc etc

luego corres los proxies

php artisan doctrine:generate:proxies

con esto ya podemos testear el proyecto.