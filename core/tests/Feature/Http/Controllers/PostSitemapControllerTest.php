<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PostSitemap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PostSitemapController
 */
class PostSitemapControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $postSitemaps = PostSitemap::factory()->count(3)->create();

        $response = $this->get(route('post-sitemap.index'));

        $response->assertOk();
        $response->assertViewIs('siteMap.post');
        $response->assertViewHas('posts');
        $response->assertViewHas('tags');
        $response->assertViewHas('categories');
        $response->assertViewHas('subCategories');
    }
}
