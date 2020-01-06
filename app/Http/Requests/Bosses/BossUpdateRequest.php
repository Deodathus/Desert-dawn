<?php

namespace App\Http\Requests\Bosses;

class BossUpdateRequest extends BossRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() +
            [
                'name' => 'string|min:3|max:255|required',
            ];
    }
}
