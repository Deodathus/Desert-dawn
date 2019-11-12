<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Services\Admin\AdminUserManageService;
use Illuminate\View\View;

class AdminUserManageController extends Controller
{
    /**
     * @var \App\Services\Admin\AdminUserManageService $adminUserManageService
     */
    private $adminUserManageService;

    /**
     * AdminUserManageController constructor.
     * @param \App\Services\Admin\AdminUserManageService $adminUserManageService
     */
    public function __construct(AdminUserManageService $adminUserManageService)
    {
        $this->adminUserManageService = $adminUserManageService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.users.index', $this->adminUserManageService->prepareDataForIndexView());
    }

    public function store(UserCreateRequest $request)
    {
        dd($request->all());
    }

}
