<?php declare(strict_types=1);

namespace MrFeek\EloquentNullCasts\Tests\data;

use Illuminate\Database\Eloquent\Model;
use MrFeek\EloquentNullCasts\CastsNullAttributes;

final class UserWithTrait extends Model
{
    use CastsNullAttributes;

    protected $table = 'users';
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->casts = [
            'deleted' => 'boolean',
        ];
    }
}
