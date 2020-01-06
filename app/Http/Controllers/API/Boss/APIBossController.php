<?php

namespace App\Http\Controllers\API\Boss;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Boss\APIBossRequest;
use App\Models\Boss\Boss;
use App\Services\API\Boss\APIBossService;

class APIBossController extends Controller
{
    /**
     * @var \App\Services\API\Boss\APIBossService $apiBossService
     */
    protected $apiBossService;

    /**
     * APIBossController constructor.
     *
     * @param \App\Services\API\Boss\APIBossService $apiBossService
     */
    public function __construct(APIBossService $apiBossService)
    {
        $this->apiBossService = $apiBossService;
    }

    /**
     * Get boss by id.
     *
     * @param \App\Http\Requests\API\Boss\APIBossRequest $APIBossRequest
     *
     * @return \App\Models\Boss\Boss
     */
    public function getBoss(APIBossRequest $APIBossRequest): Boss
    {
        return $this->apiBossService->getBoss($APIBossRequest->input('id'));
    }
}
