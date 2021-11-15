<?php

namespace App\Helpers;

use Illuminate\Foundation\Http\FormRequest;

final class ValidationHelper
{
    public static function getNestedRules(FormRequest $request, string $prefix = ''): array
    {
        $rules = call_user_func([$request, 'rules']);
        $nested_rules = [];

        foreach($rules as $key => $rule_item)
        {
            $nested_rules[$prefix ? ($prefix . '.' . $key) : $key] = $rule_item;
        }

        return $nested_rules;
    }
}