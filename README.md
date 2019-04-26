# laravel-small-program
Laravel Core Interface Packaging of Multi-Platform Small Programs

# Installation
```php
composer require ganodermaking/laravel-small-program
```

# Configuration Publishing
```php
php artisan vendor:publish --provider="Ganodermaking\\LaravelSmallProgram\\SmallProgramServiceProvider"
```

# Usage
```php
app('small-program')->toutiao->loginCertificateVerify($code, $anonymousCode);
```
