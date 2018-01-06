<?php
/**
 * Author: Xavier Au
 * Date: 6/1/2018
 * Time: 1:28 PM
 */

namespace Anacreation\MultiAuth\Observers;


use Anacreation\MultiAuth\Model\AdminPermission;
use Anacreation\MultiAuth\Services\CacheManagementService;

class AdminPermissionObserver
{
    /**
     * @var \Anacreation\MultiAuth\Services\CacheManagementService
     */
    private $cacheService;

    /**
     * \Anacreation\MultiAuth\Model\AdminPermissionObserver constructor.
     * @param \Anacreation\MultiAuth\Services\CacheManagementService $cacheService
     */
    public function __construct(CacheManagementService $cacheService) {
        $this->cacheService = $cacheService;
    }

    /**
     * Listen to the User created event.
     *
     * @param \Anacreation\MultiAuth\Model\AdminPermission $permission
     * @return void
     */
    public function created(AdminPermission $permission) {
        $this->forgetCache($permission);
    }

    /**
     * Listen to the User deleted event.
     *
     * @param \Anacreation\MultiAuth\Model\AdminPermission $permission
     * @return void
     */
    public function deleted(AdminPermission $permission) {
        $this->forgetCache($permission);
    }

    /**
     * Listen to the User updated event.
     *
     * @param \Anacreation\MultiAuth\Model\AdminPermission $permission
     * @return void
     */
    public function updated(AdminPermission $permission) {
        $this->forgetCache($permission);
    }

    public function forgetCache(AdminPermission $permission){
        $roles = $permission->roles()->with('users')->get();
        foreach ($roles as $role){
            $this->cacheService->forgetAdminPermissions($role->users);
        }
    }
}