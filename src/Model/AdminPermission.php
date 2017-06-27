<?php
/**
 * Author: Xavier Au
 * Date: 24/5/2017
 * Time: 1:34 PM
 */

namespace Anacreation\MultiAuth\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class AdminPermission extends Model
{
    protected $table = 'admin_permissions';

    public function roles(): Relation {
        return $this->belongsToMany(AdminRole::class);
    }
}
