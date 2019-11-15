<?php

namespace App\Services\Admin\Boss;

use App\Exceptions\Bosses\BossManageException;
use App\Http\Requests\Bosses\BossCreateRequest;
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

    /**
     * @param \App\Http\Requests\Bosses\BossCreateRequest $request
     *
     * @throws \App\Exceptions\Bosses\BossManageException
     */
    public function createBoss(BossCreateRequest $request)
    {
        try {
            Boss::create($request->all());
        } catch (\Exception $exception) {
            throw new BossManageException('Was problem during creation');
        }
    }
}
