# Aivo Test - Emiliano Larrea

Este es un proyecto propuesto por AIVO a modo de Test, en el proceso de selección para el puesto Backend Developer. 

## Consignas:

- Utilizando la api de spotify crear un endpoint al que ingresando el nombre de la banda se obtenga un array de toda la discografia, cada disco debe tener este formato:
    [{
        "name": "Album Name",
        "released": "10-10-2010",
         "tracks": 10,
         "cover": {
             "height": 640,
             "width": 640,
             "url": "https://i.scdn.co/image/6c951f3f334e05ffa"
         }
     },
      ...
    ]
- El el endpoint debe ser el siguiente: http://localhost/api/v1/albums?q=<band-name>
- Se puede usar un microframework (preferentemente Slim 3) 
- Se pueden usar libs (como guzzle) 
- No se puede usar ningun SDK de spotify.

El proyecto esta estructurado por dominios (DDD) e implementado de una forma "agnóstica" al framework. De esta manera el código es independiente al mismo, así es posible adaptar haciendo la menor cantidad de cambios posibles a otro framework o microframework.
El proyecto esta dividido en dos secciones, una contiene una api desarrollada con el microframework Lumen 6 y otra, una api desarrollada en el framework cakephp 3. 


## [aivo_test_lumen]: Puesta a Punto y Ejecución: 

- renombrar archivo "/aivo_test_lumen/.env.example" como "aivo_test_lumen/.env"
- cd aivo_test_lumen
- composer install
- sudo php -S localhost:80 -t public
- Documentación sobre la api disponible en: http://localhost
- Se encuentra disponible el archivo: [Ejemplos de uso para Postman](AIVO_TEST_LUMEN.postman_collection.json)


## [aivo_test_cakephp]: Puesta a Punto y Ejecución: 

- cd aivo_test_cakephp
- composer install
- bin/cake server -p 8080
- Documentación sobre la api disponible en: http://localhost:8080
- Se encuentra disponible el archivo: [Ejemplos de uso para Postman](AIVO_TEST_CAKEPHP.postman_collection.json)


## Entorno de Desarrollo:

El proyecto se desarrollo con [Visual Studio Code](https://code.visualstudio.com/download), en SO MacOS Catalina.
