<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

abstract class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:20',
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
