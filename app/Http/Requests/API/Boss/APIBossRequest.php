<?php

namespace App\Http\Requests\API\Boss;

use Illuminate\Foundation\Http\FormRequest;

class APIBossRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|exists:bosses,id',
        ];
    }
}
