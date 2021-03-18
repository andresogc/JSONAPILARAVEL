<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## JSONAPILARAVEL 

Aplicación realizada en Laravel para consumir api de https://jsonplaceholder.typicode.com/. Esta aplicacion muestras a todos los usuarios existentes y los "TODOS" de cada usuario. Se pueden hacer las operaciones básicas de un crud ( get, post, put,delete).


## Logica

Se crearon dos Modelos:
-Modelo User: Desde aqui se implementaron los metodos para consumir la Api y obtener todos los users, utilizando el facade Http para hacer la solictud a los endpoint de /users.

-Modelo Todo: Desde aqui se implementaron los metodos para consumir la Api y obtener, guardar , actualizar y elimiar  "TODOS" segun la accion requerida. Se  utiló tambien el facade Http para hacer la solictud a los endpoint de /todos.


Se crearon dos controllers:
-TodoController: Gestiona las peticiones enviadas por la vista o front en lo referente a "TODOS", estas peticiones las revisa y si es necesario  se comunica con el modelo ya sea para obtener , guardar, actualizar o eliminar datos. Y devuelve la información a la vista según el resultado.
-UserController: Gestiona las peticiones enviadas por la vista o front en lo referente a users, estas peticiones las revisa y si es necesario  se comunica con el modelo ya sea para obtener , guardar, actualizar o eliminar datos. Y devuelve la información a la vista según el resultado. 

Se crearon dos vista principales:
- Vista inicio(welcome): Muestra todos los usuarios con sus datos. Cada usuario tiene un boton "ver Todos". Al hacer clic en el boton direcciona a otra vista en la que se muestra todas las "TODOS" del usuario.

-Vista de "TODOS"(show): Muestra todas las "TODOS" de un usuario en especifico. Desde esta vista se puede agregar, eliminar y editar cada "TODO".


Para hacer las peticiones desde la vista se crearon las rutas correspondientes según el caso para get, post, put, delete. Segun el caso se dirige la peticon al controlador especifico y su metodo.  Algunas peticiones se realizan mediante ajax para no recargar la página ni direccionar a otra vista.











