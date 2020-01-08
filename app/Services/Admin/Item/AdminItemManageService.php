<?php

namespace App\Services\Admin\Item;

use App\Exceptions\Items\ItemManageException;
use App\Http\Requests\Items\ItemCreateRequest;
use App\Http\Requests\Items\ItemEditRequest;
use App\Http\Requests\Items\ItemRequest;
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
     * @param \App\Models\Item\Item $item
     *
     * @return array
     */
    public function prepareDataForEditPage(Item $item): array
    {
        return [
            'item' => $item
        ];
    }

    /**
     * @param \App\Http\Requests\Items\ItemRequest $request
     *
     * @return array
     */
    private function prepareItemAttributeDataFromRequest(ItemRequest $request): array
    {
        return [
            'strength' => $request->input('strength'),
            'stamina' => $request->input('stamina'),
            'agility' => $request->input('agility'),
            'intellect' => $request->input('intellect'),
            'luck' => $request->input('luck'),
            'wisdom' => $request->input('wisdom'),
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
            DB::transaction(function () use ($request): void {
                $item = Item::create([
                    'name' => $request->input('name'),
                    'item_rarity_id' => $request->input('item_rarity_id'),
                    'type' => $request->input('type'),
                    'required_level' => $request->input('required_level'),
                ]);

                $item->itemAttribute()->create($this->prepareItemAttributeDataFromRequest($request));
            });
        } catch (\Exception $exception) {
            throw new ItemManageException('Was problem during creation');
        }
    }

    /**
     * @param \App\Http\Requests\Items\ItemEditRequest $request
     *
     * @throws \App\Exceptions\Items\ItemManageException
     */
    public function updateItem(ItemEditRequest $request): void
    {
        $item = Item::find($request->input('id'));

        try {
            DB::transaction(function () use ($request, $item): void {
                $item->update([
                    'name' => $request->input('name'),
                    'item_rarity_id' => $request->input('item_rarity_id'),
                    'type' => $request->input('type'),
                    'required_level' => $request->input('required_level'),
                ]);

                $item->itemAttribute()->update($this->prepareItemAttributeDataFromRequest($request));
            });
        } catch (\Exception $exception) {
            throw new ItemManageException('Was problem during updating');
        }
    }

    /**
     * @param \App\Models\Item\Item $item
     *
     * @throws \App\Exceptions\Items\ItemManageException
     */
    public function deleteItem(Item $item): void
    {
        try {
            DB::transaction(function () use ($item): void {
                $item->itemAttribute()->delete();
                $item->users()->detach();
                $item->quest()->delete();
                $item->mission()->delete();
                $item->delete();
            });
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            throw new ItemManageException('Was problem during deleting');
        }
    }
}
