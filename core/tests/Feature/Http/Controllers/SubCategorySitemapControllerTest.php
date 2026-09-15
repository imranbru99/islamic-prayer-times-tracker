<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\SubCategorySitemap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SubCategorySitemapController
 */
class SubCategorySitemapControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $subCategorySitemaps = SubCategorySitemap::factory()->count(3)->create();

        $response = $this->get(route('sub-category-sitemap.index'));

        $response->assertOk();
        $response->assertViewIs('siteMap.subCategory');
        $response->assertViewHas('posts');
        $response->assertViewHas('tags');
        $response->assertViewHas('categories');
        $response->assertViewHas('subCategories');
    }
}
