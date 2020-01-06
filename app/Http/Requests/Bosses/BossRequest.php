<?php

namespace App\Http\Requests\Bosses;

use Illuminate\Foundation\Http\FormRequest;

abstract class BossRequest extends FormRequest
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
            'hp' => 'integer|min:1|required',
            'armor' => 'integer|required',
            'reward_gold' => 'integer|required',
            'reward_gems' => 'integer|required',
            'reward_exp' => 'integer|required',
            'reward_item_rarity' => 'exists:item_rarities,id',
        ];
    }
}
