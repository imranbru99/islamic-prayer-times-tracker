<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class SitemapController extends Controller
{

    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('updated_at', 'desc')->get();
        $tag = Tag::orderBy('updated_at', 'desc')->get();
        $category = Category::orderBy('updated_at', 'desc')->get();
        $subCategory = SubCategory::orderBy('updated_at', 'desc')->get();
        $user = User::orderBy('updated_at', 'desc')->get();
        $page = Page::orderBy('updated_at', 'desc')->get();
        return response()->view(activeTemplate(). 'sitemap.xml', [
            'posts' => $post,
            'tags' => $tag,
            'categories' => $category,
            'subCategories' => $subCategory,
            'users' => $user,
            'pages' => $page,
        ])->header('Content-Type', 'text/xml');
    }
}
