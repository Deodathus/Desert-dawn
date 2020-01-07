<?php

namespace App\Http\Controllers\Admin\Item;

use App\Exceptions\Items\ItemManageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\ItemCreateRequest;
use App\Services\Admin\Item\AdminItemManageService;
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
    public function store(ItemCreateRequest $request)
    {
        try {
            $this->itemManageService->createItem($request);
        } catch (ItemManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'Item ' . $request->input('name') . 'was added'
        ]);
    }
}
