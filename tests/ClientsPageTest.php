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

class ClientsPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function get_clients_page() {

        $admin = factory(Admin::class)->create();

        $this->actingAs($admin, 'admin');

        $uri = "/admin/clients";

        $response = $this->get($uri);

        $response->assertSuccessful()
                 ->assertSee('passport-personal-access-tokens');

    }

}

