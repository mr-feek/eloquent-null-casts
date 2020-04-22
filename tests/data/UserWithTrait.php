<?php declare(strict_types=1);

namespace MrFeek\EloquentNullCasts\Tests\data;

use Illuminate\Database\Eloquent\Model;
use MrFeek\EloquentNullCasts\CastsNullAttributes;

final class UserWithTrait extends Model
{

    protected $table = 'users';
    public $timestamps = false;

    protected $casts = [
        'deleted' => 'boolean',
    ];

    protected $attributes = [
        'deleted' => null,
    ];
}
