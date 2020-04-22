<?php declare(strict_types=1);

namespace MrFeek\EloquentNullCasts\Tests\data;

use Illuminate\Database\Eloquent\Model;
use MrFeek\EloquentNullCasts\CastsNullAttributes;
use MrFeek\EloquentNullCasts\CastsNullAttributesModel;

final class FailingUser extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $casts = [
        'deleted' => 'boolean',
    ];
    protected $defaults = [
        'deleted' => false,
    ];
}
