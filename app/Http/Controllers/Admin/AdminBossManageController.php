<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\Boss\BossManageService;
use Illuminate\View\View;

class AdminBossManageController
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

    public function index(): View
    {
        return view('admin.bosses.index', $this->bossManageService->prepareDataForIndexView());
    }
}
