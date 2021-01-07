<?php


namespace App\Rules\Traits;


use App\Rules\InArrayKeyRule;

trait WithTranslated
{
    protected function translatedRules(array $translatedAttributes): array
    {
        $translatedRules = [];
        foreach (config('app.locales') as $locale) {
            $translatedRules[$locale] = [new InArrayKeyRule($translatedAttributes)];
        }
        return $translatedRules;
    }
}
