<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserAddCurrencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coins' => 'integer',
            'gems' => 'integer',
            'energy' => 'integer',
            'skill_1' => 'integer',
            'skill_2' => 'integer',
            'skill_3' => 'integer',
        ];
    }
}
