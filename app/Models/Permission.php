<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use UsesUuid;

    protected $fillable = ['permission_name', 'permission_action', 'permission_title', 'permission_group'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'roles_permissions', 'permission_id', 'role_id');
    }
}
