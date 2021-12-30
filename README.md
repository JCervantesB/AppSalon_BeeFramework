![AppSalon](https://github.com/JCervantesB/AppSalon_BeeFramework/blob/main/assets/images/preview.jpg)

# Proyecto AppSalon MVC

AppSalon permite administrar las citas de Salones de belleza y/o Barberias
- Registro de nuevos usuarios (Clientes) con verificación via email.
- Actualización de datos del cliente.
- Catalogo de servicios
- Creación de citas.
- Cuenta con un panel de administración que permite buscar citas por fecha, crear nuevos servicios, actualizarlos y/o eliminarlos.


# Este proyecto utiliza la estructura de Bee-Framework
Configuraciones requeridas:

### app/config/bee_config.php
- Cambiar REMOTE_ADDR por la URL real de tu host
- Cambiar ____EL BASEPATH EN PRODUCCIÓN___ por el de tu host, si se encuentra en la raiz donde apunta el dominio, colocarlo como: '/'
- El apartado // Set para conexión en producción no se utiliza en este proyecto ya que usa ActiveRecord.

### app/core/settings.php 
- define('PORT', '80'); // Modificar solo si no corre en el puerto 80.
- define('SITE_NAME'   , 'AppSalon');    // Nombre del sitio
- define('SITE_VERSION', '1.0.0');          // Versión del sitio

### app/includes/database.php
- Configuración para la conexión a la base de datos requerida en ActiveRecord

### /app/classes/Email.php
- Configuración de PHPMailer

### Changelog
v1.0.2
- Se cambio la clase ActiveRecord por Model en /app/classes/
- Todos los modelos extienden ahora de Model y no de ActiveRecord
- Se renombraron todos los Controladores, en Bee Framework es necesario utilizar "camelCase" en su nombres.
- Se realizo una corrección a buscador.js que al mandarle una fecha vacia mandaba un error 404
https://github.com/JCervantesB/AppSalon_BeeFramework/commit/5dedc5283ca26d7e85076f7b0d62d5daa63055a3

### Instalación de Composer
- Ejecutar desde la terminal en /app
~~~
cd ./app
composer install
~~~


# Bee-Framework
https://github.com/JCervantesB/bee_framework

Mini framework desarrollado por el equipo de Joystick SA de CV en México.
Puedes hacer uso de el para tus proyectos personales o comerciales, es ligero y fácil de implementar para proyectos tanto pequeños como aquellos que requieren escalabilidad y visión a futuro.
