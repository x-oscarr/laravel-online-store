<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class ProductParameter extends Model
{
    use HasFactory;

    # !Constants
    public const TYPE_TEXT  = 'text';
    public const TYPE_COLOR = 'color';

    public const TYPES = [
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

    # !Relations
    public function products(): Relation
    {
        return $this->belongsToMany(Product::class);
    }

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
