<?php
/**
 * Author: Xavier Au
 * Date: 27/6/2017
 * Time: 12:49 PM
 */


namespace Anacreation\MultiAuth\Tests\Unit;

use Anacreation\MultiAuth\Model\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function get_profile_page() {

        $admin = factory(Admin::class)->create();

        $this->actingAs($admin, 'admin');

        $uri = "/admin/profile";

        $response = $this->get($uri);

        $response->assertSuccessful()
                 ->assertSee($admin->name);

    }

    /**
     * @test
     */
    public function update_profile() {

        $this->withoutExceptionHandling();

        $admin = factory(Admin::class)->create();

        $this->actingAs($admin, 'admin');

        $uri = "/admin/profile";

        $data = [
            'name'     => 'new name',
            'email'    => $admin->email,
            'password' => null
        ];

        $response = $this->put($uri, $data);

        $response->assertRedirect('/admin')
                 ->assertSessionHas('status');

        $this->assertDatabaseHas('administrators', [
            'id'    => $admin->id,
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

    }

}

