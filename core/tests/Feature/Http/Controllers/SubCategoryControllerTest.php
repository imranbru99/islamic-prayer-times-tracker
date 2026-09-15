<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewSubCategory;
use App\Models\SubCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SubCategoryController
 */
class SubCategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $subCategories = SubCategory::factory()->count(3)->create();

        $response = $this->get(route('sub-category.index'));

        $response->assertOk();
        $response->assertViewIs('subCategory.index');
        $response->assertViewHas('subCategories');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubCategoryController::class,
            'store',
            \App\Http\Requests\SubCategoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $description = $this->faker->text;

        Event::fake();

        $response = $this->post(route('sub-category.store'), [
            'name' => $name,
            'description' => $description,
        ]);

        $subCategories = SubCategory::query()
            ->where('name', $name)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $subCategories);
        $subCategory = $subCategories->first();

        $response->assertRedirect(route('subCategory.index'));
        $response->assertSessionHas('subCategory.name', $subCategory->name);

        Event::assertDispatched(NewSubCategory::class, function ($event) use ($subCategory) {
            return $event->subCategory->is($subCategory);
        });
    }
}
