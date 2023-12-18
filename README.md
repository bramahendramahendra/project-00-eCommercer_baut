<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## DEPLOY

# project-00-eCommercer_baut

Project eCommerce Baut 

- laravel
- vue
- alpine js
= tailwind css
- backend
- frontend admin
- frontend web

## install charts in vue vite pada admin-panel

1. untuk menambah charts pada vue referensi : https://vue-chartjs.org/guide/#installation
2. untuk insatall jalankan
```bash
npm i vue-chartjs chart.js
```
3. buat file untuk config chart seperti pada file : backend\src\components\core\Charts\Doughnut.vue


## install laravel-debugbar

untuk mengecek sebelum di publish
1. untuk link github https://github.com/barryvdh/laravel-debugbar
2. cara install jalankan
```bash
composer require barryvdh/laravel-debugbar --dev
```

## install laravel API debugger

untuk mengecek sebelum di publish
1. untuk link https://laravel.com/docs/10.x/telescope#local-only-installation
2. cara install jalankan
```bash
composer require laravel/telescope --dev
 
php artisan telescope:install
 
php artisan migrate
```
3. Tambahkan code pada file App\Providers\AppServiceProvider
```bash
/**
 * Register any application services.
 */
public function register(): void
{
    if ($this->app->environment('local')) {
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(TelescopeServiceProvider::class);
    }
}
```
4. Tambahkan code pada file composer.json
```bash
"extra": {
    "laravel": {
        "dont-discover": [
            "laravel/telescope"
        ]
    }
},
```

## jika terjadi error pada storage upload gambar

1. jalankan 
```bash
php artisan route:clear
rmdir public\storage
php artisan storage:link
``` 
pada kode diatas bertujuan untuk menghapus storage public dan menginstallnya lagi
 