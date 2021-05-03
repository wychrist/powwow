<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use App\Traits\Groupable;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    use Uuid,
    Groupable,
    CompanyTrait;

    const TYPE_INT = 'int',
        TYPE_FLOAT = 'float',
        TYPE_TEXT = 'text';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'int_value',
        'float_value',
        'text_value',
        'metadata_type',
        'metadata_id'
    ];


    public function getValueAttribute()
    {
        switch ($this->value_type) {
            case self::TYPE_INT:
                return $this->int_value;
                break;
            case self::TYPE_FLOAT:
                return $this->float_value;
                break;
            default:
                return $this->text_value;
        }
    }

    public function setValueAttribute($name, $value): self
    {
        $this->setMetadata($name, $value);
        return $this;
    }
}
