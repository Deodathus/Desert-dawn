<?php

namespace App\Http\Controllers\Admin\Item;

use App\Exceptions\Items\ItemManageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\ItemCreateRequest;
use App\Http\Requests\Items\ItemEditRequest;
use App\Models\Item\Item;
use App\Services\Admin\Item\AdminItemManageService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AdminItemManageController extends Controller
{
    /**
     * @var \App\Services\Admin\Item\AdminItemManageService $itemManageService
     */
    protected $itemManageService;

    /**
     * AdminItemManageController constructor.
     *
     * @param \App\Services\Admin\Item\AdminItemManageService $itemManageService
     */
    public function __construct(AdminItemManageService $itemManageService)
    {
        $this->itemManageService = $itemManageService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.items.index', $this->itemManageService->prepareDataForIndexPage());
    }

    /**
     * @param \App\Http\Requests\Items\ItemCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ItemCreateRequest $request): JsonResponse
    {
        try {
            $this->itemManageService->createItem($request);
        } catch (ItemManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'Item ' . $request->input('name') . 'was added.'
        ]);
    }

    /**
     * @param \App\Models\Item\Item $item
     *
     * @return \Illuminate\View\View
     */
    public function edit(Item $item): View
    {
        return view('admin.items.edit', $this->itemManageService->prepareDataForEditPage($item));
    }

    /**
     * @param \App\Http\Requests\Items\ItemEditRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ItemEditRequest $request): JsonResponse
    {
        try {
            $this->itemManageService->updateItem($request);
        } catch (ItemManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'Item was updated.'
        ]);
    }

    /**
     * @param \App\Models\Item\Item $item
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Item $item): JsonResponse
    {
        try {
            $this->itemManageService->deleteItem($item);
        } catch (ItemManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'Item was deleted'
        ]);
    }
}
