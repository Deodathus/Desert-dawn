<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\UserManageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Services\Admin\AdminUserManageService;
use Illuminate\Http\JsonResponse;
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

    /**
     * @param \App\Http\Requests\UserCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        try {
            $this->adminUserManageService->createUser($request);
        } catch (UserManageException $exception) {
            return response()->json(
                $exception->getMessage()
            );
        }

        return response()->json([
            'success' => 'User:' . $request->input('name') . ' was added'
        ]);
    }

}
