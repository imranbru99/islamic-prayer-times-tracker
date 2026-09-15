<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Sitemap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SitemapController
 */
class SitemapControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $sitemaps = Sitemap::factory()->count(3)->create();

        $response = $this->get(route('sitemap.index'));

        $response->assertOk();
        $response->assertViewIs('siteMap.index');
        $response->assertViewHas('posts');
        $response->assertViewHas('tags');
        $response->assertViewHas('categories');
        $response->assertViewHas('subCategories');
    }
}
