<?php

namespace App\Http\Controllers\Admin\Boss;

use App\Exceptions\Bosses\BossManageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bosses\BossCreateRequest;
use App\Http\Requests\Bosses\BossUpdateRequest;
use App\Models\Boss\Boss;
use App\Services\Admin\Boss\BossManageService;
use Illuminate\Http\JsonResponse;
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
    public function store(BossCreateRequest $request): JsonResponse
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

    /**
     * @param \App\Models\Boss\Boss $boss
     *
     * @return \Illuminate\View\View
     */
    public function edit(Boss $boss): View
    {
        return view('admin.bosses.edit', $this->bossManageService->prepareDataForEditView($boss));
    }

    /**
     * @param \App\Http\Requests\Bosses\BossUpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BossUpdateRequest $request): JsonResponse
    {
        try {
            $this->bossManageService->updateBoss($request);
        } catch (BossManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'Boss was updated.'
        ]);
    }

    /**
     * @param \App\Models\Boss\Boss $boss
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Boss $boss): JsonResponse
    {
        try {
            $this->bossManageService->deleteBoss($boss);
        } catch (BossManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'Boss was deleted'
        ]);
    }
}
