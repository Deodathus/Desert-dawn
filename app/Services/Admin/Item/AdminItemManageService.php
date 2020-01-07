<?php

namespace App\Services\Admin\Item;

use App\Exceptions\Items\ItemManageException;
use App\Http\Requests\Items\ItemCreateRequest;
use App\Models\Item\Item;
use Illuminate\Support\Facades\DB;

class AdminItemManageService
{
    /**
     * @return array
     */
    public function prepareDataForIndexPage(): array
    {
        return [
            'items' => Item::with('itemAttribute')->paginate(10),
        ];
    }

    /**
     * @param \App\Http\Requests\Items\ItemCreateRequest $request
     *
     * @throws \App\Exceptions\Items\ItemManageException
     */
    public function createItem(ItemCreateRequest $request): void
    {
        try {
            DB::transaction(function () use ($request) {
                $item = Item::create([
                    'item_rarity_id' => $request->input('item_rarity_id'),
                    'name' => $request->input('name'),
                    'required_level' => $request->input('required_level'),
                    'type' => $request->input('type')
                ]);

                $item->itemAttribute()->create([
                    'strength' => $request->input('strength'),
                    'stamina' => $request->input('stamina'),
                    'agility' => $request->input('agility'),
                    'intellect' => $request->input('intellect'),
                    'luck' => $request->input('luck'),
                    'wisdom' => $request->input('wisdom'),
                ]);
            });
        } catch (\Exception $exception) {
            throw new ItemManageException('Was problem during creation');
        }
    }
}
