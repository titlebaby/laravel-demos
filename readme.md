#### 好记性不如烂笔头 温故而知 念念不忘 必有回响
##Laravel 实现用户权限管理 实例 PermissionsDemo
本实例循序渐进 使用5张表 分别是 users roles role_user  permission_role permissions
生成的表以及关系的SQL在 database/migrations文件夹下面
```
    php artisan make:migration create_posts_table --create=posts
    
    php artisan migrate
    #注意如报错 如下  
    SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
    查询得知
    1.升级MySql版本到5.5.3以上。
    
    2.手动配置迁移命令migrate生成的默认字符串长度，在AppServiceProvider中调用Schema::defaultStringLength方法来实现配置：
    use Illuminate\Support\Facades\Schema;
    public function boot()
    {
    Schema::defaultStringLength(191);
    }
     
    #进入代码编辑
    php artisan tinker
    #指定目录生成Post测试数据
    factory('App\Http\Controllers\PermissionsDemo\Post')->create();
    App\User::first()
    #生成一个user
    factory('App\User')->create();
    #指定目录生成Controller
    php artisan make:controller PermissionsDemo/PostsController
    #生成POST权限判断 中间
    php artisan make:policy PostPolicy
    
    php artisan make:model PermissionsDemoModel/Permission
    php artisan make:model PermissionsDemoModel/Role
    #创建表（1.生成sql文件 2.迁移 执行） 注意 =等号 两边不能有空格
    php artisan make:migration create_roles_table --create=roles
    php artisan migrate
       
    # 建立测试数据 表之间关系模型 两张表 与roles为多对多的关系 
    php artisan tinker
    namespace App\PermissionsDemoModel;
    $role =new Role;
    $role->name ='admin';
    $role->label ='admin';
    $role->save();
    $permissions = new Permission;
    $permissions->name='eidt_form';
    $permissions->label='edit_from';
    $permissions->save();
    $role->getPermission($permissions);
    #roles与users 
    $user = App\User::first();
    $role = App\PermissionsDemoModel\Role::first()
    $user->roles()-save($role)
 
```
最好所有的权限验证 放在路由中间件中  MustBeAnAdmin
```$xslt
<?php

namespace App\Http\Middleware;

use Closure;

class MustBeAnAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Auth::user() 是不是登陸進來
        if($request->user() && $request->user()->isAdmin()){
            return $next($request);
        }
        return redirect('/');

    }
}

```