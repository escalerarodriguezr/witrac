# Witrac - Backend Test - Solución

La prueba se ha resuelto aplicando arquitectura hexagonal y DDD.

Los requisitos que se han realizado han sido:
- Refactor haciendo uso de arquitectura hexagonal y DDD
- Implementación de Test unitarios
- Tests de aceptación
- Añadir base de datos para almacenar el estado de la aplicación
- Añadir "obstáculos" al mapa en el momento de su creación
- Modelar el comportamiento de los obstáculos, no debe ser posible avanzar si hay un obstáculo y esta situación se debe de comunicar.

# Descripción de la aplicación.

Con el primer endpoint creamos un nuevo mapa, dotándolo de nombre y tamaño.
Se le ha añadido un parámetro opcional para generar obstáculos random numberOfRandomBlocks=2.

```text
GET http://localhost:8080/create-canvas?
 name=first_canvas&
 width=5&height=5
 &numberOfRandomBlocks=2
```
La respuesta sería del tipo:

```text
{
    "status": "created",
    "canvas": {
        "name": "rafa",
        "width": 5,
        "height": 5,
        "spaceship": {
            "x": 0,
            "y": 0
        },
        "blocks": [
            {
                "x": 4,
                "y": 5
            },
            {
                "x": 4,
                "y": 4
            }
        ]
    }
}
```
Por ejemplo, hacemos un mapa llamado "first_canvas" de "5x5":

```text
|0,0|0,1|0,2|0,3|0,4|
|1,0|1,1|1,2|1,3|1,4|
|2,0|2,1|2,2|2,3|2,4|
|3,0|3,1|3,2|3,3|3,4|
|4,0|4,1|4,2|4,3|4,4|
```
Se entiende que la posición inicial de la nave, siempre es "0,0":
```text
| X |0,1|0,2|0,3|0,4|
|1,0|1,1|1,2|1,3|1,4|
|2,0|2,1|2,2|2,3|2,4|
|3,0|3,1|3,2|3,3|3,4|
|4,0|4,1|4,2|4,3|4,4|
```
Haciendo uso del endpoint para mover la nave, se puede ir desplazando la nave sobre un mapa específico, con la
peculiaridad que si la nave llega a uno de los límites, ésta ha de aparecer por el margen contrario:

```text
|0,0|0,1|0,2|0,3|0,4|
|1,0|1,1|1,2|1,3| X |
|2,0|2,1|2,2|2,3|2,4|
|3,0|3,1|3,2|3,3|3,4|
|4,0|4,1|4,2|4,3|4,4|
```
Si nos encontramos en la posición "1,4" y nos movemos 1 posición a la derecha, apareceríamos en la "1,0"

En caso de colisionar contra un obstáculo no es posible avanzar y se responde un error con un 409 Conflict del tipo

```text
{
    "errors": [
        "Movement not allowed due to collision with block in x = 1 and y = 4"
    ]
}
```

## Installation using Makefile

````shell
$ make build 'to build the docker environment'
$ make run 'to spin up containers'
$ make composer-install 'to install composer dependencies'
$ make migrate-database 'to runs the migrations'
$ make migrate-database-tests 'to runs the database-tests migrations'
$ make all-tests 'to run the test suite'
$ make ssh-be 'to access the PHP container bash'
$ make stop 'to stop and start containers'
````

## Installation without using Makefile
````shell
$ docker network create witrac-network
$ U_ID=$UID docker-compose up -d --build
$ U_ID=$UID docker exec --user $UID -it witrac-be composer install --no-scripts --no-interaction --optimize-autoloader 
$ U_ID=$UID docker exec --user $UID -it witrac-be bin/console doctrine:migrations:migrate -n
$ U_ID=$UID docker exec --user $UID -it witrac-be bin/console doctrine:migrations:migrate --env=test -n
$ U_ID=$UID docker exec --user $UID -it witrac-be bin/phpunit
$ U_ID=$UID docker exec -it --user $UID witrac-be bash
$ U_ID=$UID docker-compose stop
````

## API Endpoints
````text
Create new canvas:
GET http://localhost:8080/create-canvas?name=first_canvas&width=5&height=5&numberOfRandomBlocks=2

Movements:
GET http://localhost:8080/move/first_canvas/top
GET http://localhost:8080/move/first_canvas/right
GET http://localhost:8080/move/first_canvas/bottom
GET http://localhost:8080/move/first_canvas/left
````
