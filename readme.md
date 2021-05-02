## blumilksoftware/stubs
Laravel stubs refactored and consistent with the Blumilk codestyle.

## Installation
```
composer require blumilksoftware/stubs --dev
```

## Usage
There are two ways to use Blumilk stubs. Default one creates a symbolic link in your application's main directory pointing to vendor directory `./vendor/blumilksoftware/stubs`.
```
php artisan blumilk:stubs
```

Second one trigger copying of all stubs from vendor into your application's main directory:
```
php artisan blumilk:stubs --copy
```
