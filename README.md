# Allow eloquent to cast null values of attributes

[![Packagist](https://img.shields.io/packagist/v/mr-feek/eloquent-null-casts.svg)](https://packagist.org/packages/mr-feek/eloquent-null-casts)
[![Packagist](https://img.shields.io/packagist/dt/mr-feek/eloquent-null-casts.svg)](https://packagist.org/packages/mr-feek/eloquent-null-casts)
![dev-master Tests](https://img.shields.io/github/workflow/status/mr-feek/eloquent-null-casts/Run%20Tests?label=dev-master%20tests)

By default, Laravel does not allow casting null values of attributes listed in the `casts` array. This isn't always desirable,
as sometimes you want to ensure an attribute is always a boolean. This package provides a simple trait to override this behavior on a 
per Model basis. It isn't always feasible to run a migration to no longer allow null in the database.
## Installation

You can install the package via composer:

```bash
composer require mr-feek/eloquent-null-casts
```

## Usage
In PHP we cannot override a trait's property in the class where the trait is used, so we have two implementation choices.

First option is to use the `CastsNullAttributes` trait and define the casts in the constructor.

``` php
<?php declare(strict_types=1);

namespace MrFeek\EloquentNullCasts\Tests\data;

use Illuminate\Database\Eloquent\Model;
use MrFeek\EloquentNullCasts\CastsNullAttributes;

final class User extends Model
{
    use CastsNullAttributes;
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->casts = [
            'deleted' => 'boolean',
        ];
    }
}
```

The other option is to use inheritance to implement the `CastsNullAtrributes` trait, and continue defining the casts
inline as you would typically with Eloquent.

``` php
<?php declare(strict_types=1);

namespace MrFeek\EloquentNullCasts\Tests\data;

use Illuminate\Database\Eloquent\Model;
use MrFeek\EloquentNullCasts\CastsNullAttributesModel;

final class User extends CastsNullAttributesModel
{
    protected $casts = [
        'deleted' => 'boolean',
    ];
}
```

In both of these cases, if the actual value of `deleted` is null, it will actually be cast to a boolean (false) to satisfy later typehints.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email fpm5022@gmail.com instead of using the issue tracker.

## Credits

- [Fiachra McDermott](https://github.com/mr-feek)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
