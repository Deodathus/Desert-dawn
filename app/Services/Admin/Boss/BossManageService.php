<?php

namespace App\Services\Admin\Boss;

use App\Models\Boss\Boss;

class BossManageService
{
    /**
     * @return array
     */
    public function prepareDataForIndexView(): array
    {
        return [
            'bosses' => Boss::all(),
        ];
    }
}
