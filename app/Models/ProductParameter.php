<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductParameter extends Model
{
    # !Constants
    const TYPE_TEXT = 'text';
    const TYPE_COLOR = 'color';

    const TYPES = [
        self::TYPE_TEXT => [
            'trans' => 'model.product_param.type.text',
            'is_hidden' => false
        ],
        self::TYPE_COLOR => [
            'trans' => 'model.product_param.type.color',
            'is_hidden' => true
        ],
    ];

    # !Parameters
    protected $fillable = ['type', 'key', 'value',];
    protected $hidden = ['data',];
    public $timestamps = false;

    # !Methods
    public function getValueAttribute()
    {
//        if ($this->type == self::TYPE_EXAMPLE) {
//            return $this->getExample();
//        }

        return $this->attributes['value'];
    }

    public function setValueAttribute($value)
    {
//        if ($this->type == self::TYPE_EXAMPLE) {
//            return $this->setExample($value);
//        }

        return $this->attributes['value'] = $value;
    }

}
