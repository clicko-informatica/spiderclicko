## SpiderClicko

## Instalación

Actualizar composer con el comando:

    $ composer require clicko/spiderclicko
    
Si no funciona:

    $ composer require "clicko/spiderclicko @dev"

Después de actualizar composer, hacemos una migración para cargar la base de datos

    $ php artisan migrate
    
Si ya hay una base de datos podemos llamar directamente a la migración para que haga la tabla nueva
    
    $ art migrate --path=/vendor/clicko/spiderclicko/src/migrations/

Publicamos el archivo spoderclicko en la carpeta config mediante la consulta (Seleccionando SpiderClickoServiceProvider):

    $ art vendor:publish

Agregamos el ServiceProvider a la matriz de proveedores en config / app.php

    Clicko\SpiderClicko\SpiderClickoServiceProvider::class,

Opcionalmente podemos usar la facade para un código más corto. Añade esto a tus facades:

    'ClickoLog' => Clicko\SpiderClicko\ClickoLogFacade::class,
    
Una vez cargada la base de datos utilizamos el comando install del paquete con sus opciones correspondientes

    $ php artisan spiderclicko:install --user= --pass= --passphrase=
    
    
## Funciones

    ClickoLog::info('');
    ClickoLog::error('');
    ClickoLog::notice('');
    ClickoLog::success('');    

