<?php

namespace App\Http\Requests\Api;

use App\Models\Category;
use App\Models\Product;
use App\Rules\Traits\WithTranslated;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    use WithTranslated;

    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return array_merge([
            'category_id' => 'required',
            'slug' => 'min:5|max:40',
            'type' => [Rule::in(array_keys(Category::TYPES))],
            'code' => 'min:5|max:20',
            'price' => 'integer',
            'old_price' => 'integer',
            'unit' => '',
            'amount' => 'min:1',
            'is_new' => 'boolean',
            'is_available' => 'boolean',
            'is_enabled' => 'boolean',

            // TODO: Seo for product
//            'seo' => ['array', new InArrayKeyRule(array_merge($seoObj->fillable, ['trans']))],
//            'seo.trans.*' => ['required', 'array', new InArrayKeyRule($locales)],
        ], $this->translatedRules((new Product())->translatedAttributes));
    }
}
