<?php

namespace App\Http\Requests\API\Item;

use Illuminate\Foundation\Http\FormRequest;

class APIItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|exists:items,id',
        ];
    }
}
