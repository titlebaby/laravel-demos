<?php

namespace App;

use App\PermissionsDemoModel\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function owns($post)
    {
        return $this->id == $post->user_id;
    }

    public function roles(){
//        dd($this->belongsToMany(Role::class));
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role){
//        dd($role);
        if(is_string($role)){

            return $this->roles->contains('name',$role);
        }
//        dd($role->intersect($this->roles));
        return !! $role->intersect($this->roles)->count();//intersect 检测两者有无相同
    }
    //查看登录用户有没有admin 角色
    public function isAdmin(){
        return $this->hasRole('admin');
    }

}
