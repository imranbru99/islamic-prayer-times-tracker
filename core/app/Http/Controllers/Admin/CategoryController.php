<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewCategory;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Image;
use Sohibd\Laravelslug\Generate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return ('okay');
        $categories = Category::all();
        $pageTitle = 'All Categories';
        return view('admin.category.index', compact('categories', 'pageTitle'));
    }

    public function create(Request $request)
    {
        // return ('okay');
        $categories = Category::all();
        $pageTitle = 'Create Categories';
        return view('admin.category.create', compact('categories', 'pageTitle'));
    }


    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Generate::Slug($category->name);
        $category->description = $request->description;
        $category->status = $request->status ? 1 : 0 ;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $category->name . '.jpg';
            $location = 'assets/images/category/' . $filename;
            $category->image = $filename;

            $path = './assets/images/category/';
            $link = $path . $category->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);
        }

        $category->save();
        $notify[] = ['success', 'Your Category Has Been Added successfully.'];
        return redirect()->route('admin.post.category.index')->withNotify($notify);
    }


    public function edit(Request $request, $id)
    {
        // return ('okay');
        $category = Category::find($id);
        $pageTitle = 'Edit Single Category';
        return view('admin.category.edit', compact('category', 'pageTitle'));
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Generate::Slug($category->name);
        $category->description = $request->description;
        $category->status = $request->status ? 1 : 0 ;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $category->name . '.jpg';
            $location = 'assets/images/category/' . $filename;
            $category->image = $filename;

            $path = './assets/images/category/';
            $link = $path . $category->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);
        }

        $category->save();
        $notify[] = ['success', 'Your Category Has Been Updated successfully.'];
        return redirect()->route('admin.post.category.index')->withNotify($notify);
    }

}
