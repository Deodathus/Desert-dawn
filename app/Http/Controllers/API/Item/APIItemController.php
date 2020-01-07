<?php

namespace App\Http\Controllers\API\Item;

use App\Http\Controllers\Controller;
use App\Services\API\Item\APIItemService;
use Illuminate\Support\Collection;

class APIItemController extends Controller
{
    /**
     * @var \App\Services\API\Item\APIItemService $apiItemService
     */
    protected $apiItemService;

    /**
     * APIItemController constructor.
     *
     * @param \App\Services\API\Item\APIItemService $apiItemService
     */
    public function __construct(APIItemService $apiItemService)
    {
        $this->apiItemService = $apiItemService;
    }

    /**
     * Get all item's rarities.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getItemRarities(): Collection
    {
        return $this->apiItemService->getItemRarities();
    }

    /**
     * Get all item's types.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getItemTypes(): Collection
    {
        return $this->apiItemService->getItemTypes();
    }
}
