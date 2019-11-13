<?php

namespace App\Services\Admin;

use App\Exceptions\Users\UserManageAllException;
use App\Exceptions\Users\UserManageException;
use App\Http\Requests\Users\UserAddCurrencyRequest;
use App\Http\Requests\Users\UserCreateRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserManageService
{
    /**
     * Prepare data for index view.
     *
     * @return array
     */
    public function prepareDataForIndexView(): array
    {
        return [
            'users' => User::all(),
        ];
    }

    /**
     * @param \App\Http\Requests\Users\UserCreateRequest $request
     *
     * @throws \App\Exceptions\Users\UserManageException
     */
    public function createUser(UserCreateRequest $request): void
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'is_admin' => $request->input('isAdmin'),
                'coins' => $request->input('coins'),
                'gems' => $request->input('gems'),
                'energy' => $request->input('energy'),
                'level' => $request->input('level'),
                'exp' => $request->input('exp'),
                'skill_1' => $request->input('skillOne'),
                'skill_2' => $request->input('skillTwo'),
                'skill_3' => $request->input('skillThree'),
                'skill_1_damage' => $request->input('skillOneDamage'),
                'skill_2_damage' => $request->input('skillTwoDamage'),
                'skill_3_damage' => $request->input('skillThreeDamage'),
            ]);
        } catch (\Exception $exception) {
            throw new UserManageException('Was error during creation.');
        }
    }

    public function prepareCurrenciesListFromRequest(UserAddCurrencyRequest $request): array
    {
        return [
            'coins' => 100,
        ];
    }

    /**
     * @param \App\Http\Requests\Users\UserAddCurrencyRequest $request
     *
     * @throws \App\Exceptions\Users\UserManageAllException
     */
    public function addCurrencyToAllUsers(UserAddCurrencyRequest $request)
    {
        $currencies = $this->prepareCurrenciesListFromRequest($request);

        try {
            foreach ($currencies as $currency => $value) {
                DB::update('update users set ' . $currency . ' = ' . $currency . ' + '  . $value . ' where 1 = 1');
            }
        } catch (\Exception $exception) {
            throw new UserManageAllException('Was error during update.');
        }
    }
}
