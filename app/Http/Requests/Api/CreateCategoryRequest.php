<?php

namespace App\Http\Requests\Api;

use App\Models\Category;
use App\Rules\Traits\WithTranslated;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{
    use WithTranslated;

    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge([
            'parent_id' => 'nullable|integer',
            'slug' => 'required|min:5|max:60',
            'type' => ['required', Rule::in(array_keys(Category::TYPES))],
            'position' => 'nullable|integer',
            'is_enabled' => 'nullable|boolean',
        ], $this->translatedRules((new Category())->translatedAttributes));
    }
}
