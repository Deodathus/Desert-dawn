<?php

namespace App\Http\Requests\Bosses;

use Illuminate\Foundation\Http\FormRequest;

class BossCreateRequest extends FormRequest
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
            'name' => 'string|min:3|max:255|required|unique:bosses',
            'hp' => 'integer|min:1|required',
            'armor' => 'integer|required',
            'reward_gold' => 'integer|required',
            'reward_gems' => 'integer|required',
            'reward_exp' => 'integer|required',
            'reward_item_rarity' => 'integer|exists:item_rarities,id',
        ];
    }
}
