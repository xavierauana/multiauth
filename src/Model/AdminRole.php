<?php
/**
 * Author: Xavier Au
 * Date: 24/5/2017
 * Time: 1:34 PM
 */

namespace Anacreation\MultiAuth\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    public function users(): Relation {
        return $this->belongsToMany(Admin::class);
    }

    public function permissions(): Relation {
        return $this->belongsToMany(AdminPermission::class);
    }
}
