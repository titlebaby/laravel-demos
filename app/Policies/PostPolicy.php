<?php

namespace App\Policies;

use App\Http\Controllers\PermissionsDemo\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //定义权限规则
    public function update(User $user, Post $post)
    {
        return $user->owns($post);
    }
}
