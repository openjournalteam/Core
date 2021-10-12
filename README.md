# Core System Core System for OpenJournalTeam

## Installation

You can install the package via composer:

```bash
composer require openjournalteam/core
```

## Usage

Run the following to install:

```php
php artisan core:install
php artisan notifications:table
```

Migrate

- Set database connection in env file before migrating

```php
php artisan migrate
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
            return $user->hasRole(Role::SUPER_ADMIN) ? true : null;
    });
```

and import the following namespaces:

```php
use Illuminate\Support\Facades\Gate;
use OpenJournalTeam\Core\Models\Role;
```

Seed Menu,Roles, and Super Admin user

```php
php artisan db:seed --class=MenuSeeder
php artisan db:seed --class=RolesAndPermissionSeeder
php artisan db:seed --class=SuperAdminSeeder
```

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

- [Rahman Ramsi](https://github.com/rhmrms)
- [All Contributors](../../contributors)
