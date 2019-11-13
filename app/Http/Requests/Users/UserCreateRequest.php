<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:users|string|max:225',
            'password' => 'required|string|min:8',
            'coins' => 'integer',
            'gems' => 'integer',
            'energy' => 'integer',
            'level' => 'integer',
            'is_admin' => 'boolean',
            'exp' => 'integer',
            'skill_1' => 'integer',
            'skill_2' => 'integer',
            'skill_3' => 'integer',
            'skill_1_damage' => 'integer',
            'skill_2_damage' => 'integer',
            'skill_3_damage' => 'integer',
        ];
    }
}
