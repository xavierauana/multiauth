<?php
/**
 * Author: Xavier Au
 * Date: 24/5/2017
 * Time: 1:34 PM
 */

namespace Anacreation\MultiAuth\Model;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at', 'remember_token'];

    protected $table = 'administrators';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles(): Relation {
        return $this->belongsToMany(AdminRole::class);
    }

    public function getPermissionsAttribute(): Collection {
        return $this->roles()->with("Permissions")->get()->map(function ($role) {
            return $role->permissions;
        })->flatten()->unique(function ($permission) {
            return $permission->id;
        })->values();
    }

    public function hasRole($roleCode): bool {

        $roleCode = is_array($roleCode) ? $roleCode : [$roleCode];

        $allRoleCodes = $this->roles->pluck('code')->toArray();

        return count(array_intersect($allRoleCodes, $roleCode));
    }

    public function hasPermission($permissionCode): bool {
        $permissionCode = is_array($permissionCode) ? $permissionCode : [$permissionCode];
        $thePermission = $this->roles()->with('permissions')->get()->map(function ($role) {
            return $role->permissions;
        })->flatten()->first(function ($permission) use ($permissionCode) {
            return in_array($permission->code, $permissionCode);
        });

        return !!$thePermission;
    }
}
