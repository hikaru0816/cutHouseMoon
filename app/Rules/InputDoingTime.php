<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InputDoingTime implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 入力した数値が0.5で割り切れるかのチェック
        $calc = ($value * 10) % 5;
        return ($calc === 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '施術時間は0.5刻みで入力してください';
    }
}
