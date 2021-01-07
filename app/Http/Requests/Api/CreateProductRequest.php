<?php

namespace App\Http\Requests\Api;

use App\Models\Category;
use App\Models\Product;
use App\Models\SeoSetting;
use App\Rules\InArrayKeyRule;
use App\Rules\Traits\WithTranslated;
use App\Rules\TranslationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
{
    use WithTranslated;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return array_merge([
            'category_id' => 'required|integer',
            'slug' => 'required|min:5|max:60',
            'type' => ['required', Rule::in(array_keys(Category::TYPES))],
            'code' => 'required|min:5|max:20',
            'price' => 'required|integer',
            'old_price' => 'nullable|integer',
            'unit' => '',
            'amount' => 'nullable|integer|min:1',
            'is_new' => 'nullable|boolean',
            'is_available' => 'nullable|boolean',
            'is_enabled' => 'nullable|boolean',

            // TODO: Seo for product
//            'seo' => ['array', new InArrayKeyRule(array_merge($seoObj->fillable, ['trans']))],
//            'seo.trans.*' => ['required', 'array', new InArrayKeyRule($locales)],
        ], $this->translatedRules((new Product())->translatedAttributes));
    }
}
