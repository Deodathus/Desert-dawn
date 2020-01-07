<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

abstract class ItemRequest extends FormRequest
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
            'name' => 'string|min:3|required',
            'required_level' => 'integer|required',
            'item_rarity_id' => 'exists:item_rarities,id',
            'type' => 'exists:item_types,id',
            'strength' => 'integer|required',
            'stamina' => 'integer|required',
            'agility' => 'integer|required',
            'intellect' => 'integer|required',
            'luck' => 'integer|required',
            'wisdom' => 'integer|required',
        ];
    }
}
