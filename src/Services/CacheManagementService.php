<?php
/**
 * Author: Xavier Au
 * Date: 6/1/2018
 * Time: 1:32 PM
 */

namespace Anacreation\MultiAuth\Services;


use Anacreation\MultiAuth\Model\Admin;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CacheManagementService
{
    public function forgetAllAdminPermissions() {
        $allAdmin = Admin::all();
        $this->forgetAdminPermissions($allAdmin);
    }

    public function forgetAdminPermissions($admins) {
        if ($admins instanceof Collection) {
            $admins->each(function ($admin) {
                $this->forgetAdminPermissions($admin);
            });
        } elseif ($admins instanceof Admin) {
            $admin = $admins;
            $key = $this->getAdminPermissionKey($admin);
            Cache::forget($key);
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