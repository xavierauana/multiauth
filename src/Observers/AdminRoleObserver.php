<?php
/**
 * Author: Xavier Au
 * Date: 6/1/2018
 * Time: 1:28 PM
 */

namespace Anacreation\MultiAuth\Observers;


use Anacreation\MultiAuth\Model\AdminRole;
use Anacreation\MultiAuth\Services\CacheManagementService;

class AdminRoleObserver
{
    /**
     * @var \Anacreation\MultiAuth\Services\CacheManagementService
     */
    private $cacheService;

    /**
     * AdminRoleObserver constructor.
     * @param \Anacreation\MultiAuth\Services\CacheManagementService $cacheService
     */
    public function __construct(CacheManagementService $cacheService) {
        $this->cacheService = $cacheService;
    }

    /**
     * Listen to the User created event.
     *
     * @param \Anacreation\MultiAuth\Model\AdminRole $role
     * @return void
     */
    public function created(AdminRole $role) {
        $this->forgetCache($role);
    }

    /**
     * Listen to the User deleted event.
     *
     * @param \Anacreation\MultiAuth\Model\AdminRole $role
     * @return void
     */
    public function deleted(AdminRole $role) {
        $this->forgetCache($role);
    }

    /**
     * Listen to the User updated event.
     *
     * @param \Anacreation\MultiAuth\Model\AdminRole $role
     * @return void
     */
    public function updated(AdminRole $role) {
        $this->forgetCache($role);
    }

    private function forgetCache(AdminRole $role) {
        $this->cacheService->forgetAdminPermissions($role->users);
    }
}