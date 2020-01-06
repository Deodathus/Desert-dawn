<?php

namespace App\Http\Controllers\Admin\Boss;

use App\Exceptions\Bosses\BossManageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bosses\BossCreateRequest;
use App\Services\Admin\Boss\BossManageService;
use Illuminate\View\View;

class AdminBossManageController extends Controller
{
    /**
     * @var \App\Services\Admin\Boss\BossManageService $bossManageService
     */
    private $bossManageService;

    /**
     * AdminBossManageController constructor.
     * @param \App\Services\Admin\Boss\BossManageService $bossManageService
     */
    public function __construct(BossManageService $bossManageService)
    {
        $this->bossManageService = $bossManageService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.bosses.index', $this->bossManageService->prepareDataForIndexView());
    }

    /**
     * @param \App\Http\Requests\Bosses\BossCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BossCreateRequest $request)
    {
        try {
            $this->bossManageService->createBoss($request);
        } catch (BossManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'Boss ' . $request->input('name') . ' was added',
        ]);
    }
}
