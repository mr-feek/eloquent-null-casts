<?php declare(strict_types=1);

namespace MrFeek\EloquentNullCasts;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Support\Collection as BaseCollection;

trait CastsNullAttributes
{
    use HasAttributes {
        HasAttributes::castAttribute as parentCastAttribute;
    }

    protected function castAttribute($key, $value)
    {
        $castType = $this->getCastType($key);

        if (is_null($value)) {
            switch ($castType) {
                case 'int':
                case 'integer':
                    return 0;
                case 'real':
                case 'float':
                case 'double':
                    return 0.0;
                case 'decimal':
                    return $this->asDecimal(null, explode(':', $this->getCasts()[$key], 2)[1]);
                case 'string':
                    return '';
                case 'bool':
                case 'boolean':
                    return false;
                case 'array':
                    return [];
                case 'collection':
                    return new BaseCollection();
                case 'object':
                case 'date':
                case 'datetime':
                case 'custom_datetime':
                case 'timestamp':
                default:
                    // we can't safely cast these types, so let the parent handle them if it can
                    break;
            }
        }

        return $this->parentCastAttribute($key, $value);
    }
}
