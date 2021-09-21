# Core System Core System for OpenJournalTeam 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/openjournalteam/core.svg?style=flat-square)](https://packagist.org/packages/openjournalteam/core)
[![Total Downloads](https://img.shields.io/packagist/dt/openjournalteam/core.svg?style=flat-square)](https://packagist.org/packages/openjournalteam/core)
![GitHub Actions](https://github.com/openjournalteam/core/actions/workflows/main.yml/badge.svg)

## Installation

You can install the package via composer:

```bash
composer require openjournalteam/core
```

## Usage

Run the following to use the latest stable version
```php
php artisan core:install
```
Edit config/auth.php and change the following lines:
```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\User::class,
    ],
],
```
To 
```php
'providers' => [
  'users' => [
            'driver' => 'eloquent',
            'model' => OpenJournalTeam\Core\Models\User::class,
        ],
],
```

Edit AuthServiceProvider.php and add the following lines on the boot method:
```php
    Gate::before(function ($user, $ability) {
            return $user->hasRole(Auth::ROLE_SUPER_ADMIN) ? true : null;
    });
```
and import the following namespaces:
```php
use Illuminate\Support\Facades\Gate;
use OpenJournalTeam\Core\Auth;
```


Edit .env and change the following lines:
```php
DB_CONNECTION=mysql
```

To
```php
DB_CONNECTION=sqlite
```

And remove the following lines:
```php
DB_DATABASE=laravel
```

Edit composer.json and change the following lines:
```json
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    }
```

To
```json
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/",
            "Plugins\\": "plugins/"
        }
    }
```

Tip: don't forget to run composer dump-autoload afterwards

Serve Laravel
```php
php artisan serve
```

Access the admin panel
```php
http://localhost:8000/panel
```


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email rahmanramsi19@gmail.com instead of using the issue tracker.

## Credits

-   [Rahman Ramsi](https://github.com/rhmrms)
-   [All Contributors](../../contributors)
