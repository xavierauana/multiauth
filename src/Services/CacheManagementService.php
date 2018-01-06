<?php
/**
 * Author: Xavier Au
 * Date: 6/1/2018
 * Time: 1:32 PM
 */

namespace Anacreation\MultiAuth\Services;


use Anacreation\MultiAuth\Model\Admin;
use Anacreation\MultiAuth\Model\AdminRole;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CacheManagementService
{
    public function forgetAllAdminPermissions() {
        $allAdmin = Admin::all();
        $this->forgetAdminPermissions($allAdmin);
    }

    public function forgetAdminPermissions($data) {
        if ($data instanceof Collection) {
            $data->each(function ($item) {
                $this->forgetAdminPermissions($item);
            });
        } elseif ($data instanceof Admin) {
            $admin = $data;
            $key = $this->getAdminPermissionKey($admin);
            Cache::forget($key);
        } elseif ($data instanceof AdminRole) {
            $role = $data;
            $role->users->each(function (Admin $admin) {
                $this->forgetAdminPermissions($admin);
            });
        }
    }

    /**
     * @param \Anacreation\MultiAuth\Model\Admin $admin
     * @return string
     */
    public function getAdminPermissionKey(Admin $admin): string {
        return "admin_{$admin->id}_permissions";
    }


}