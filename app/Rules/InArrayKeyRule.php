<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InArrayKeyRule implements Rule
{
    protected $keys;

    public function __construct(array $keys)
    {
        $this->keys = $keys;
    }

    public function passes($attribute, $value)
    {
        $valueKeys = array_keys($value);
        foreach ($this->keys as $key) {
            if(!in_array($key, $valueKeys)) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        $keys = implode(', ', $this->keys);
        return "One or more keys in the array does not match the rule [$keys]";
    }
}
