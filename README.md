# laravel-small-program
laravel多平台小程序核心接口封装

# 调用
```php
composer require ganodermaking/laravel-small-program

php artisan vendor:publish --provider="Ganodermaking\\LaravelSmallProgram\\SmallProgramServiceProvider"

app('small-program')->toutiao->loginCertificateVerify($code, $anonymousCode);
```
