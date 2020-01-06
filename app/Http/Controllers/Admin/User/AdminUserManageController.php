<?php

namespace App\Http\Controllers\Admin\User;

use App\Exceptions\Users\UserManageAllException;
use App\Exceptions\Users\UserManageException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserAddCurrencyRequest;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserEditRequest;
use App\Models\User\User;
use App\Services\Admin\User\AdminUserManageService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AdminUserManageController extends Controller
{
    /**
     * @var \App\Services\Admin\User\AdminUserManageService $adminUserManageService
     */
    private $adminUserManageService;

    /**
     * AdminUserManageController constructor.
     *
     * @param \App\Services\Admin\User\AdminUserManageService $adminUserManageService
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
     * @param \App\Http\Requests\Users\UserCreateRequest $request
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
            'success' => 'User: ' . $request->input('name') . ' was added.'
        ]);
    }

    /**
     * @param \App\Models\User\User $user
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', $this->adminUserManageService->prepareDataForEditView($user));
    }

    /**
     * @param \App\Http\Requests\Users\UserEditRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserEditRequest $request): JsonResponse
    {
        try {
            $this->adminUserManageService->updateUser($request);
        } catch (UserManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'User was updated.'
        ]);
    }

    /**
     * @param \App\Models\User\User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $this->adminUserManageService->deleteUser($user);
        } catch (UserManageException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'User was deleted.'
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function manageAllIndex(): View
    {
        return view('admin.users.manageAll');
    }

    /**
     * @param \App\Http\Requests\Users\UserAddCurrencyRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCurrenciesToAllUsers(UserAddCurrencyRequest $request): JsonResponse
    {
        try {
            $this->adminUserManageService->addCurrencyToAllUsers($request->all());
        } catch (UserManageAllException $exception) {
            return response()->json([
                $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => 'All users was updated.'
        ]);
    }
}
