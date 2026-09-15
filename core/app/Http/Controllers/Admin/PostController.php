<?php

namespace App\Http\Controllers\Admin;


use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\PostTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Sohibd\Laravelslug\Generate;
use App\Http\Controllers\Controller;
use Image;

class PostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::latest()->get();
        $pageTitle = ' All post';
        return view('admin.post.index', compact('posts', 'pageTitle'));
    }

    public function pending(Request $request)
    {
        $posts = Post::where('status', '0')->latest()->get();
        $pageTitle = ' All post';
        return view('admin.post.index', compact('posts', 'pageTitle'));
    }

    public function create (Request $request)
    {
        $pageTitle = 'Create a New Post';
        $categories = SubCategory::all();
        return view('admin.post.create', compact('pageTitle', 'categories'));
    }

    public function store(Request $request)
    {

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Generate::Slug($post->title);
        $post->meta = $request->meta;
        $post->content = $request->content;
        $post->status = '0' ;
        $post->sub_category_id = $request->sub_category_id;
        $post->author_id = '1';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $post->slug . '.jpg';
            $currentMonth = date('m');
            $currentYear = date('Y');
            $location = 'assets/images/post/' . date("Y") . '/' . date("m") . '/'. $filename;
            $post->image = $filename;
            $path = './assets/images/post/' . date("Y") . '/' . date("m") . '/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $link = $path . $post->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->encode('webp', 100)->resize(1200, 750)->save($location);
        }

        $path = './assets/images/post/' . date("Y") . '/' . date("m") . '/';
        $post->path= $path ;
        $post->save();

        $request = request();
        foreach ($request->tags as $tag) {
           
                $newTag       = new Tag();
                $newTag->name = $tag;
                $newTag->slug = Generate::Slug($tag);
                $newTag->save();

                $tag = new PostTags;
                $tag->post_id =  $post->id;
                $tag->tag_id =  $newTag->id;
                $tag->save();
        }
        $notify[] = ['success', 'Your Post Added successfully.'];
        return redirect()->route('admin.post.index')->withNotify($notify);
    }

    public function edit (Request $request, $id)
    {
        $post = Post::find($id);
        $pageTitle = 'Edit Post';
        $categories = SubCategory::all();
        return view('admin.post.edit', compact('pageTitle', 'post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        

        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = Generate::Slug($post->title);
        $post->meta = $request->meta;
        $post->content = $request->content;
        $post->status = '0' ;
        $post->sub_category_id = $request->sub_category_id;
        $post->author_id = '1';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $post->slug . '.jpg';
            $currentMonth = date('m');
            $currentYear = date('Y');
            $location = 'assets/images/post/' . date("Y") . '/' . date("m") . '/'. $filename;
            $post->image = $filename;
            $path = './assets/images/post/' . date("Y") . '/' . date("m") . '/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $link = $path . $post->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->encode('webp', 100)->resize(1200, 750)->save($location);
        }

        $path = './assets/images/post/' . date("Y") . '/' . date("m") . '/';
        $post->path= $path ;
        $post->save();

        $request = request();
        foreach ($request->tags as $tag) {
        $newTag       = new Tag();
        $newTag->name = $tag;
        $newTag->slug = Generate::Slug($tag);
        $newTag->save();

        $tag = new PostTags;
        $tag->post_id =  $post->id;
        $tag->tag_id =  $newTag->id;
        $tag->save();
        }


        $notify[] = ['success', 'Your Post Updated successfully.'];
        return redirect()->route('admin.post.index')->withNotify($notify);
    }
    
    public function status($id)
    {
        $post = Post::find($id);
        if ($post->status == 0)
            $post->update([
                'status' => 1,
            ]);
        else
            $post->update([
                'status' => 0,
            ]);
        $notify[] = ['success', 'Your Post Status Updated successfully.'];    
        return back()->withNotify($notify);
    }
}
