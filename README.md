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
Edit config/auth.php and add the following lines:
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

Serve Laravel by
```php
php artisan serve
```

Access the admin panel by
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
