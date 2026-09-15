<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TagSitemap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TagSitemapController
 */
class TagSitemapControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $tagSitemaps = TagSitemap::factory()->count(3)->create();

        $response = $this->get(route('tag-sitemap.index'));

        $response->assertOk();
        $response->assertViewIs('siteMap.post');
        $response->assertViewHas('posts');
        $response->assertViewHas('tags');
        $response->assertViewHas('categories');
        $response->assertViewHas('subCategories');
    }
}
