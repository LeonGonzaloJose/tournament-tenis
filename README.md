# Tournament tenis

Api restfull de torneo de tenis.
Este pequeño proyecto permite crear, editar e eliminar jugadores/as, dichos jugadores tienen como datos: "nombre","edad","genero" y "nivel", con el parametro de genero se define en que tipo de torneo ingresaria si "masculino o femenino". Por su lado el campo nivel define las 4 estadisticas de un jugador: "fuerza", "velocidad", "reflejos" y "energia". El parametro de energia es la encargada de definir un promedio para contemplar la suerte del ganardor, mientras el parameto de fuerza y velocidad solo son contemplados en los torneos masculino y el de reflejos para el femenino.

## Iniciar proyecto

Una ves copiado el archivo .env.example a un archivo .env, es necesario ejecutar:

```bash
  composer install
```


Procedemos a crear las tablas:
```bash
  php artinsa migrate
```

Si no se quiere crear jugadores de uno en uno se puede ejecutar el comando:
```bash
  php artisan db:seed --class=PlayerSeeder
```
NOTA: se crearan 10 jugadores de cada genero.


Siguientes pasos.. Docker.