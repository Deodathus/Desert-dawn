<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminDataService;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * @var \App\Services\Admin\AdminDataService $adminService
     */
    private $adminService;

    /**
     * AdminController constructor.
     * @param \App\Services\Admin\AdminDataService $adminDataService
     */
    public function __construct(AdminDataService $adminDataService)
    {
        $this->adminService = $adminDataService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.index', $this->adminService->prepareDataForIndexPage());
    }
}
