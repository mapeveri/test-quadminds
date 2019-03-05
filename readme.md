# test-quadminds

Test de código para quadminds. Documentación utilizada: https://quadminds.github.io/quadminds-notes-test/

## Requerimientos

1. Revisar: https://laravel.com/docs/5.8#server-requirements
2. MySql
3. Composer
4. Npm

## Configuración

1. Renombrar el archivo .env.example y configurarlo.
2. Ejecutar **composer install** para instalar las dependencias del backend.
2. Ejecutar **npm install** para instalar las dependencias del frontend.
3. Ejecutar **npm run dev** para compilar los assets.
4. Crear las base de datos (desarrollo y testing) en mysql.
5. Ejecutar **php artisan migrate** para correr las migraciones.
6. Levantar el servidor de pruebas con **php artisan serve** e ir a localhost:8000 en el browser.

## Aplicación

La aplicación se encuentra en localhost:8000 y la api en localhost:8000/api/notes

## Test

Para ejecutar los tests del backend, ejecutar el siguiente comando:

    composer tests

Para ejecutar los tests del frontend, ejecutar el siguiente comando:

    npm run tests
