<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EmailUniqueCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 他のコントローラーのメソッドを使う準備
        $this->userController = app()->make('App\Http\Controllers\UserController');
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
        // 別の人が登録しているアドレスの場合、trueを返す
        $emails = $this->userController->getRegistedEmail();
        $otherEmails = [];
        foreach ($emails as $email) {
            if ($email !== Auth::user()->email) {
                $otherEmails[] = $email;
            }
        }
        return (!in_array($value, $otherEmails));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ご入力いただいたメールアドレスは既に登録されています';
    }
}
