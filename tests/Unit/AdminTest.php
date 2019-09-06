<?php
/**
 * Author: Xavier Au
 * Date: 27/6/2017
 * Time: 12:49 PM
 */


namespace Anacreation\MultiAuth\Tests\Unit;

use Anacreation\MultiAuth\Model\Admin;
use Anacreation\MultiAuth\Model\AdminPermission;
use Anacreation\MultiAuth\Model\AdminRole;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use DatabaseMigrations;

    private $user1;
    private $user2;
    private $user3;
    private $permissions;
    private $roles;
    private $somePermissions;

    protected function setUp(): void {
        parent::setUp();

        // create admin user
        $this->user1 = factory(Admin::class)->create();
        $this->user2 = factory(Admin::class)->create();
        $this->user3 = factory(Admin::class)->create();


        // create permissions
        $this->permissions = factory(AdminPermission::class, 10)->create();

        // create roles
        $this->roles = factory(AdminRole::class, 3)->create();

        // first roles has all the permissions

        $ids = $this->permissions->pluck('id')->toArray();
        $this->roles->first()->permissions()->sync($ids);

        // second roles has some the permissions
        $this->somePermissions = $this->permissions->random(3);
        $this->roles[1]->permissions()->sync($this->somePermissions->pluck('id')
                                                                   ->toArray());

        // second roles has none the permissions

        // first user is role1
        $this->user1->roles()->attach($this->roles[0]->id);

        // second user is role2 and 3
        $this->user2->roles()->attach($this->roles[1]->id);

        // third user has a role with no permission
        $this->user3->roles()->attach($this->roles[2]->id);

    }

    public function test_first_user_has_all_permissions() {
        $this->permissions->each(function ($permission) {
            $this->assertTrue($this->user1->hasPermission($permission->code));
        });
    }

    public function test_second_user_has_some_permissions_only() {

        $this->somePermissions->each(function ($permission) {
            $this->assertTrue($this->user2->hasPermission($permission->code));
        });

        $this->permissions->filter(function ($permission) {
            return !$this->somePermissions->contains(function ($sp) use (
                $permission
            ) {
                return $sp->id === $permission->id;
            });
        })->each(function ($permission) {
            $this->assertFalse($this->user2->hasPermission($permission->code));
        });

    }

    public function test_third_user_has_no_permissions() {
        $this->permissions->each(function ($permission) {
            $this->assertFalse($this->user3->hasPermission($permission->code));
        });
    }

    public function test_has_role() {

        foreach ($this->roles as $index => $role) {
            if ($index == 0) {
                $this->assertTrue($this->user1->hasRole($role->code));
                $this->assertFalse($this->user2->hasRole($role->code));
                $this->assertFalse($this->user3->hasRole($role->code));
            } elseif ($index == 1) {
                $this->assertFalse($this->user1->hasRole($role->code));
                $this->assertTrue($this->user2->hasRole($role->code));
                $this->assertFalse($this->user3->hasRole($role->code));
            } else {
                $this->assertFalse($this->user1->hasRole($role->code));
                $this->assertFalse($this->user2->hasRole($role->code));
                $this->assertTrue($this->user3->hasRole($role->code));
            }
        }
    }

}

