<?php

namespace App\Services\Admin\Boss;

use App\Exceptions\Bosses\BossManageException;
use App\Http\Requests\Bosses\BossCreateRequest;
use App\Http\Requests\Bosses\BossUpdateRequest;
use App\Models\Boss\Boss;

class BossManageService
{
    /**
     * @return array
     */
    public function prepareDataForIndexView(): array
    {
        return [
            'bosses' => Boss::paginate(5),
        ];
    }

    /**
     * @param \App\Models\Boss\Boss $boss
     *
     * @return array
     */
    public function prepareDataForEditView(Boss $boss): array
    {
        return [
            'boss' => $boss
        ];
    }

    /**
     * @param \App\Http\Requests\Bosses\BossCreateRequest $request
     *
     * @throws \App\Exceptions\Bosses\BossManageException
     */
    public function createBoss(BossCreateRequest $request): void
    {
        try {
            Boss::create($request->all());
        } catch (\Exception $exception) {
            throw new BossManageException('Was problem during creation');
        }
    }

    /**
     * @param \App\Http\Requests\Bosses\BossUpdateRequest $request
     *
     * @throws \App\Exceptions\Bosses\BossManageException
     */
    public function updateBoss(BossUpdateRequest $request): void
    {
        try {
            $boss = Boss::find($request->input('id'));

            $boss->update([
                'name' => $request->input('name'),
                'hp' => $request->input('hp'),
                'armor' => $request->input('armor'),
                'reward_gold' => $request->input('reward_gold'),
                'reward_gems' => $request->input('reward_gems'),
                'reward_exp' => $request->input('reward_exp'),
                'reward_item_rarity' => $request->input('reward_item_rarity'),
            ]);
        } catch (\Exception $exception) {
            throw new BossManageException('Was problem during updating');
        }
    }

    /**
     * @param \App\Models\Boss\Boss $boss
     *
     * @throws \App\Exceptions\Bosses\BossManageException
     */
    public function deleteBoss(Boss $boss): void
    {
        try {
            $boss->delete();
        } catch (\Exception $exception) {
            throw new BossManageException('Was problem during deletion');
        }
    }
}
