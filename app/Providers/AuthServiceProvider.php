<?php

namespace App\Providers;

use App\PermissionsDemoModel\Permission;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Http\Controllers\PermissionsDemo\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->name,function(User $user) use ($permission){
                return $user->hasRole($permission->roles);//biao ming
            });

        }

    }

    public function getPermissions()
    {
        return Permission::with('roles')->get();

    }

//最简单的第一权限 进一步升华成定义 一个PostPolicy
    /*  public function boot()
      {
          $this->registerPolicies();
          Gate::define('show-post',function ($user,$post){
    //            return $user->id == $post->user_id;
              //优化
              return $user->owns($post);
          });

          //
      }*/
}
