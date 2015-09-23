# Groundplay
WANZ Theme lml

## Theme Folder

Todos estos archivos pertenecen a la ruta /wp-content/themes/groundplay excepto por "custom-functions.php".



## Custom Functions

Pertenece a la ruta /wp-content/mu-plugins/custom-functions.php. Este archivo decide funciones de la instalación de WP sobre cualquier tema.



## Plugins

- Advanced Custom Fields Pro
- Category Order and Taxonomy Terms Order
- Configurable Tag Cloud
- Contact Form 7
- Custom Post Type UI
- Disqus Comment System
- Search Everything
- Social Count Plus
- Theme Test Drive



## Cambios en ACF o CPT

En ACF > Si los cambios que haces a un campo son muchos o experimentales, ó si el campo es nuevo exporta completo el campo. Si son pocos, solo hazlo a la par de la versión de servidor.
En CPT > Hazlo a la par de la versión de servidor.



## Instalación en local

- 0 Ten MAMP o WAMP instalado en tu compu
- 1 Descarga los archivos del ftp al /htdocs/wanz
- 2 Pídele a Freddie(a menos de que tú seas Freddie) un export de la Base de Datos actual.
- 3 del archivo .sql que te mande Freddie, abrelo en tu editor de texto de preferencia y remplaza todos los urls "http://www.wearenotzombies.com/" por "localhost:8888/wanz/"
- 4 Cambia dbname: localhost // user: root // pass: (none)
