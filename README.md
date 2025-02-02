# TFG-DAW-Wellness-App

Este proyecto es mi trabajo de fin de grado del CFGS de Desarrollo de Aplicaciones Web, durante el año 2021. Se trata de una página web que intenta imitar "Wallapop" en la compra venta de productos de segunda mano. El proyecto se ha realizado con el framework Laravel y PHP.

**Nota sobre el proyecto**: Este proyecto fue desarrollado al principio de mi formación, y soy consciente de que hay muchas cosas que podrían mejorarse. Por ejemplo:
- **Uso de Eloquent ORM**: Actualmente, las consultas a la base de datos se realizan directamente en los controladores. Una mejora sería utilizar Eloquent, el ORM de Laravel, para una mejora de las consultas y una mayor seguridad.
- **Mejoras en la seguridad**: Las consultas podrían optimizarse para evitar vulnerabilidades como inyecciones SQL y seguir buenas prácticas de seguridad.
- **Separación de responsabilidades**: El código podría estructurarse mejor utilizando servicios para separar la lógica de negocio de los controladores.

### Requisitos técnicos del proyecto:

- PHP versión 8.0.0
- Composer instalado (gestor de dependencias de PHP).
- Base de datos MySQL.
<br/>

### Pasos para ejecutar el proyecto.
**1. Actualizar archivo de configuración de PHP.**

Editamos el archivo de configuración **php.ini** (ubicado en el directorio donde hemos instalado PHP) y descomentamos las siguientes líneas:
- ;extension=fileinfo
- ;extension=pdo_mysql

Además, durante la instalación de composer, también se nos pedirá descomentar:
- ;extension_dir = "ext"
- ;extension=curl
- ;extension=mbstring
- ;extension=openssl
<br/>

**2. Clonar el proyecto.**
```
git clone https://github.com/LluisPecos/TFG-DAW-Wellness
```
<br/>

**3. Acceder desde la línea de comandos a la ruta del proyecto y ejecutar.**
```
composer install
```
Esto instalará todas las dependencias definidas en composer.json.
<br/><br/>

**4. Cambiar el nombre del archivo .env.example a .env, editar su contenido y configurar la conexión a la base de datos en las siguientes líneas.**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wellness
DB_USERNAME=root
DB_PASSWORD=root
```
<br/>

**5. Generar clave de cifrado en el .env (variable APP_KEY).**
```
php artisan key:generate
```
<br/>

**6. Ejecutar migraciones (creación de tablas) y rellenar-las:**
```
php artisan migrate
php artisan db:seed
```
O lo mismo en un solo paso:
```
php artisan migrate:fresh --seed
```
<br/>

**7. Ejecutar el proyecto en local.**

Por defecto usa puerto 8000.
```
php artisan serve
```

## README autogenerado por el Framework:

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
