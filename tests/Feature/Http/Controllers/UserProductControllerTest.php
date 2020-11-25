<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\UserProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserProductController
 */
class UserProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $userProducts = UserProduct::factory()->count(3)->create();

        $response = $this->get(route('user-product.index'));

        $response->assertOk();
        $response->assertViewIs('userProduct.index');
        $response->assertViewHas('userProducts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user-product.create'));

        $response->assertOk();
        $response->assertViewIs('userProduct.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserProductController::class,
            'store',
            \App\Http\Requests\UserProductStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('user-product.store'));

        $response->assertRedirect(route('userProduct.index'));
        $response->assertSessionHas('userProduct.id', $userProduct->id);

        $this->assertDatabaseHas(userProducts, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $userProduct = UserProduct::factory()->create();

        $response = $this->get(route('user-product.show', $userProduct));

        $response->assertOk();
        $response->assertViewIs('userProduct.show');
        $response->assertViewHas('userProduct');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $userProduct = UserProduct::factory()->create();

        $response = $this->get(route('user-product.edit', $userProduct));

        $response->assertOk();
        $response->assertViewIs('userProduct.edit');
        $response->assertViewHas('userProduct');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserProductController::class,
            'update',
            \App\Http\Requests\UserProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $userProduct = UserProduct::factory()->create();

        $response = $this->put(route('user-product.update', $userProduct));

        $userProduct->refresh();

        $response->assertRedirect(route('userProduct.index'));
        $response->assertSessionHas('userProduct.id', $userProduct->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $userProduct = UserProduct::factory()->create();

        $response = $this->delete(route('user-product.destroy', $userProduct));

        $response->assertRedirect(route('userProduct.index'));

        $this->assertDeleted($userProduct);
    }
}
