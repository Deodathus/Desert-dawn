<?php

namespace App\Services\Admin\User;

use App\Exceptions\Users\UserManageAllException;
use App\Exceptions\Users\UserManageException;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserEditRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserManageService
{
    /**
     * @return array
     */
    public function prepareDataForIndexView(): array
    {
        return [
            'users' => User::paginate(5),
        ];
    }

    /**
     * @param \App\Models\User\User $user
     *
     * @return array
     */
    public function prepareDataForEditView(User $user): array
    {
        return [
            'user' => $user
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

    /**
     * @param \App\Http\Requests\Users\UserEditRequest $request
     *
     * @throws \App\Exceptions\Users\UserManageException
     */
    public function updateUser(UserEditRequest $request): void
    {
        $user = User::find($request->input('id'));
        $password = $request->input('password');

        try {
            $user->update([
                'name' => $request->input('name'),
                'is_admin' => $request->input('is_admin'),
                'coins' => $request->input('coins'),
                'gems' => $request->input('gems'),
                'energy' => $request->input('energy'),
                'level' => $request->input('level'),
                'exp' => $request->input('exp'),
                'skill_1' => $request->input('skill_1'),
                'skill_2' => $request->input('skill_2'),
                'skill_3' => $request->input('skill_3'),
                'skill_1_damage' => $request->input('skill_1_damage'),
                'skill_2_damage' => $request->input('skill_2_damage'),
                'skill_3_damage' => $request->input('skill_3_damage'),
            ]);

            if (!empty($password)) {
                $user->update([
                    'password' => Hash::make($password)
                ]);
            }
        } catch (\Exception $exception) {
            throw new UserManageException('Was error during updating.');
        }
    }

    /**
     * @param \App\Models\User\User $user
     *
     * @throws \App\Exceptions\Users\UserManageException
     */
    public function deleteUser(User $user): void
    {
        try {
            $user->delete();
        } catch (\Exception $exception) {
            throw new UserManageException('Was error during deliting.');
        }
    }

    /**
     * @param array $currencies
     *
     * @throws \App\Exceptions\Users\UserManageAllException
     */
    public function addCurrencyToAllUsers(array $currencies): void
    {
        try {
            foreach ($currencies as $currency => $value) {
                if ($value > 0) {
                    DB::update('update users set ' . $currency . ' = ' . $currency . ' + '  . $value . ' where 1 = 1');
                }
            }
        } catch (\Exception $exception) {
            throw new UserManageAllException('Was error during update.');
        }
    }
}
