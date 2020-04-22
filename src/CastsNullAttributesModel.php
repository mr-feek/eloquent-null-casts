<?php declare(strict_types=1);

namespace MrFeek\EloquentNullCasts;

use Illuminate\Database\Eloquent\Model;

abstract class CastsNullAttributesModel extends Model
{
    use CastsNullAttributes;
}
