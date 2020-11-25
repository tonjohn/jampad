<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\UserHome;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserHomeController
 */
class UserHomeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $userHomes = UserHome::factory()->count(3)->create();

        $response = $this->get(route('user-home.index'));

        $response->assertOk();
        $response->assertViewIs('userHome.index');
        $response->assertViewHas('userHomes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user-home.create'));

        $response->assertOk();
        $response->assertViewIs('userHome.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserHomeController::class,
            'store',
            \App\Http\Requests\UserHomeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $nickname = $this->faker->word;

        $response = $this->post(route('user-home.store'), [
            'nickname' => $nickname,
        ]);

        $userHomes = UserHome::query()
            ->where('nickname', $nickname)
            ->get();
        $this->assertCount(1, $userHomes);
        $userHome = $userHomes->first();

        $response->assertRedirect(route('userHome.index'));
        $response->assertSessionHas('userHome.id', $userHome->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $userHome = UserHome::factory()->create();

        $response = $this->get(route('user-home.show', $userHome));

        $response->assertOk();
        $response->assertViewIs('userHome.show');
        $response->assertViewHas('userHome');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $userHome = UserHome::factory()->create();

        $response = $this->get(route('user-home.edit', $userHome));

        $response->assertOk();
        $response->assertViewIs('userHome.edit');
        $response->assertViewHas('userHome');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserHomeController::class,
            'update',
            \App\Http\Requests\UserHomeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $userHome = UserHome::factory()->create();
        $nickname = $this->faker->word;

        $response = $this->put(route('user-home.update', $userHome), [
            'nickname' => $nickname,
        ]);

        $userHome->refresh();

        $response->assertRedirect(route('userHome.index'));
        $response->assertSessionHas('userHome.id', $userHome->id);

        $this->assertEquals($nickname, $userHome->nickname);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $userHome = UserHome::factory()->create();

        $response = $this->delete(route('user-home.destroy', $userHome));

        $response->assertRedirect(route('userHome.index'));

        $this->assertDeleted($userHome);
    }
}
