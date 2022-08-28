<?php

namespace App\Policies;

use App\Models\AdminModel\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminModel\UserModel  $userModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserModel $user , UserModel $userModel)
    {
        return $user->id === $userModel->id;
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function update(UserModel $user , UserModel $userModel)
    {
        return $user->id === $userModel->id;
    }

}
