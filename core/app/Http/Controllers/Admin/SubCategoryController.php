<?php

namespace App\Http\Controllers\Admin;


use App\Models\SubCategory;
use App\Models\Category;
use Sohibd\Laravelslug\Generate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class SubCategoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subCategories = SubCategory::all();
        $pageTitle = 'Create Categories';
        return view('admin.subCategory.index', compact('subCategories', 'pageTitle'));
    }

    public function create(Request $request)
    {
        $pageTitle = 'Create Sub Category';
        $categories = Category::all();
        return view('admin.subCategory.create', compact('categories','pageTitle'));
    }


    public function store(Request $request)
    {
        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->slug = Generate::Slug($subCategory->name);
        $subCategory->description = $request->description;
        $subCategory->status = $request->status ? 1 : 0 ;
        $subCategory->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $subCategory->name . '.jpg';
            $location = 'assets/images/subCategory/' . $filename;
            $subCategory->image = $filename;

            $path = './assets/images/subCategory/';
            $link = $path . $subCategory->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);
        }

        $subCategory->save();
        $notify[] = ['success', 'Your Sub Category Has Been Added successfully.'];
        return redirect()->route('admin.post.subCategory.index')->withNotify($notify);
    }


    public function edit(Request $request, $id)
    {
        // return ('okay');
        $subCategory = SubCategory::find($id);
        $pageTitle = 'Edit Single Sub Category';
        $categories = Category::all();
        return view('admin.subCategory.edit', compact('subCategory', 'categories', 'pageTitle'));
    }


    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->name = $request->name;
        $subCategory->slug = Generate::Slug($subCategory->name);
        $subCategory->description = $request->description;
        $subCategory->status = $request->status ? 1 : 0 ;
        $subCategory->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $subCategory->name . '.jpg';
            $location = 'assets/images/category/' . $filename;
            $subCategory->image = $filename;

            $path = './assets/images/category/';
            $link = $path . $subCategory->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);
        }

        $subCategory->save();

        $notify[] = ['success', 'Your subCategory Has Been Updated successfully.'];
        return redirect()->route('admin.post.subCategory.index')->withNotify($notify);
    }
}
