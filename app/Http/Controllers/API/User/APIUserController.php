<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\APIUserRequest;
use App\Models\User\User;
use App\Services\API\User\APIUserService;

class APIUserController extends Controller
{
    /**
     * @var \App\Services\API\User\APIUserService $apiUserService
     */
    protected $apiUserService;

    /**
     * APIUserController constructor.
     *
     * @param \App\Services\API\User\APIUserService $apiUserService
     */
    public function __construct(APIUserService $apiUserService)
    {
        $this->apiUserService = $apiUserService;
    }

    /**
     * Get user by id.
     *
     * @param \App\Http\Requests\API\User\APIUserRequest $APIUserRequest
     *
     * @return \App\Models\User\User
     */
    public function getUser(APIUserRequest $APIUserRequest): User
    {
        return $this->apiUserService->getUser($APIUserRequest->input('id'));
    }
}
