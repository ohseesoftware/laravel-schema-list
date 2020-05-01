# List schema details from your database connection

[![Current Release](https://img.shields.io/github/release/ohseesoftware/laravel-schema-list.svg?style=flat-square)](https://github.com/ohseesoftware/laravel-schema-list/releases)
![Build Status Badge](https://github.com/ohseesoftware/laravel-schema-list/workflows/Build/badge.svg)
[![Downloads](https://img.shields.io/packagist/dt/ohseesoftware/laravel-schema-list.svg?style=flat-square)](https://packagist.org/packages/ohseesoftware/laravel-schema-list)
[![MIT License](https://img.shields.io/github/license/ohseesoftware/laravel-schema-list.svg?style=flat-square)](https://github.com/ohseesoftware/laravel-schema-list/blob/master/LICENSE)

Use the command line to easily list out your database's tables and columns for a given table.

## Installation

You can install the package via composer:

```bash
composer require ohseesoftware/laravel-schema-list
```

## Usage

List tables from your default connection:

```
php artisan schema:tables
```

List columns for a given table:

```
php artisan schema:columns {table}
```

### Testing

No tests right now :)

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email owen@ohseemedia.com instead of using the issue tracker.

## Credits

-   [Owen Conti](https://github.com/ohseesoftware)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
