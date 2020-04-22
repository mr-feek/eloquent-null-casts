<?php declare(strict_types=1);

namespace MrFeek\EloquentNullCasts\Tests\data;

use Illuminate\Database\Eloquent\Model;
use MrFeek\EloquentNullCasts\CastsNullAttributes;
use MrFeek\EloquentNullCasts\CastsNullAttributesModel;

final class UserWithInheritance extends CastsNullAttributesModel
{
    protected $table = 'users';
    public $timestamps = false;
    protected $casts = [
        'deleted' => 'boolean',
    ];
}
