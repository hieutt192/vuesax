<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Role and Permisssion

Libraray

- jwt_auth use tymon/jwtAuth.
- debugbar.
- laravel: 9.*.
- php: 8.1*.



## Setup

### coppy file .env 
``` bash
cp .env.example .env
```

### Dev server running on [http://127.0.0.1:8000].
``` bash
php artisan serve
```

### build composer larvel in file composer.json 
``` bash
composer update
```

### create jwt secret
``` bash
php artisan jwt:secret
```

### generate debugbar
``` bash
composer require barryvdh/laravel-debugbar --dev
```



### library

- **[JWT](https://jwt-auth.readthedocs.io/en/develop/)**
- **[DeBugBar](https://github.com/barryvdh/laravel-debugbar)**



## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

