## SpiderClicko

## Instalación

Después de actualizar composer, hacemos una migración para cargar la base de datos

    $ php artisan migrate
    
Una vez cargada la base de datos utilizamos el comando install del paquete con sus opciones correspondientes

    $ php artisan spiderclicko:install --user= --pass= --passphrase=
    
Agregamos el ServiceProvider a la matriz de proveedores en config / app.php

    Clicko\SpiderClicko\SpiderClickoServiceProvider::class,

Opcionalmente podemos usar la facade para un código más corto. Añade esto a tus facades:

    'ClickoLog' => Clicko\SpiderClicko\ClickoLogFacade::class,
    
## Funciones

    ClickoLog::info('');
    ClickoLog::error('');
    ClickoLog::notice('');
    ClickoLog::success('');    

