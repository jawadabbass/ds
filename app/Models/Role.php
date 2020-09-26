<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

class Role extends Model
{
    use UsesUuid;
    use FormAccessible;

    protected $fillable = ['role_title', 'role_group'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'users_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'roles_permissions', 'role_id', 'permission_id');
    }

}
