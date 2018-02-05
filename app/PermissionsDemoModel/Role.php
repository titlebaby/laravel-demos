<?php

namespace App\PermissionsDemoModel;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function getPermission(Permission $permission){
       return $this->permissions()->save($permission);

    }
    public function test(){
        echo "12";
}
}
