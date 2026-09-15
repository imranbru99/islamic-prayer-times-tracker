<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CategorySitemap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CategorySitemapController
 */
class CategorySitemapControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $categorySitemaps = CategorySitemap::factory()->count(3)->create();

        $response = $this->get(route('category-sitemap.index'));

        $response->assertOk();
        $response->assertViewIs('siteMap.category');
        $response->assertViewHas('posts');
        $response->assertViewHas('tags');
        $response->assertViewHas('categories');
        $response->assertViewHas('');
    }
}
