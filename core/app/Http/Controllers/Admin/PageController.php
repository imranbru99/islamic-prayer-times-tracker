<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Sohibd\Laravelslug\Generate;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::latest()->get();
        $pageTitle = ' All pages';
        return view('admin.page.index', compact('pages', 'pageTitle'));
    }

    public function create (Request $request)
    {
        $pageTitle = 'Create a New page';
        return view('admin.page.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $page = new Page();
        $page->name = $request->title;
        $page->slug = Generate::Slug($page->name);
        $page->meta = $request->meta;
        $page->description = $request->description;
        $page->status = '0' ;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $page->slug . '.webp';
            $currentMonth = date('m');
            $currentYear = date('Y');
            $location = 'assets/images/page/' . date("Y") . '/' . date("m") . '/'. $filename;
            $page->image = $filename;
            $path = './assets/images/page/' . date("Y") . '/' . date("m") . '/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $link = $path . $page->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->encode('webp', 100)->resize(1200, 750)->save($location);
        }

        $path = './assets/images/page/' . date("Y") . '/' . date("m") . '/';
        $page->path= $path ;
        $page->save();

        $notify[] = ['success', 'Your page Added successfully.'];
        return redirect()->route('admin.page.index')->withNotify($notify);
    }

    public function edit (Request $request, $id)
    {
        $page = Page::find($id);
        $pageTitle = 'Edit page';
        return view('admin.page.edit', compact('pageTitle', 'page'));
    }

    public function update(Request $request, $id)
    {
        

        $page = Page::find($id);
        $page->name = $request->title;
        $page->slug = Generate::Slug($page->name);
        $page->meta = $request->meta;
        $page->description = $request->description;
        $page->status = '0' ;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $page->slug . '.webp';
            $currentMonth = date('m');
            $currentYear = date('Y');
            $location = 'assets/images/page/' . date("Y") . '/' . date("m") . '/'. $filename;
            $page->image = $filename;
            $path = './assets/images/page/' . date("Y") . '/' . date("m") . '/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $link = $path . $page->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->encode('webp', 100)->resize(1200, 750)->save($location);
        }

        $path = './assets/images/page/' . date("Y") . '/' . date("m") . '/';
        $page->path= $path ;
        $page->save();

        $notify[] = ['success', 'Your page Updated successfully.'];
        return redirect()->route('admin.page.index')->withNotify($notify);
    }
    
    public function status($id)
    {
        $page = Page::find($id);
        if ($page->status == 0)
            $page->update([
                'status' => 1,
            ]);
        else
            $page->update([
                'status' => 0,
            ]);
        $notify[] = ['success', 'Your page Status Updated successfully.'];    
        return back()->withNotify($notify);
    }
}
