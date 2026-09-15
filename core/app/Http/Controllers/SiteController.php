<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Page;
use App\Models\User;
use App\Models\Subscriber;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Auth;

class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function index(){
        $activeTemplate = activeTemplate();
        $data['page_title'] = 'Home';
        $data['posts'] = Post::latest()->with('author')->withCount('comments')->take(6)->get();
        $data['popular'] = Post::orderByDesc('view')->with('author')->take(4)->get();
        $data['categories'] = Category::withCount('subCategories')->take(8)->get();
        $data['pages'] = Page::latest()->take(4)->get();
        return view($activeTemplate . 'home', $data);
    }

    public function contact()
    {
        $activeTemplate = activeTemplate();
       
        $data['page_title'] = 'Contact';
        return view($activeTemplate . 'contact', $data);
    }
 

    public function contactSubmit(Request $request)
    {
        $ticket = new SupportTicket();
        $message = new SupportMessage();

        $imgs = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'attachments' => [
                'sometimes',
                'max:4096',
                function ($attribute, $value, $fail) use ($imgs, $allowedExts) {
                    foreach ($imgs as $img) {
                        $ext = strtolower($img->getClientOriginalExtension());
                        if (($img->getSize() / 1000000) > 2) {
                            return $fail("Images MAX  2MB ALLOW!");
                        }
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg, pdf images are allowed");
                        }
                    }
                    if (count($imgs) > 5) {
                        return $fail("Maximum 5 images can be uploaded");
                    }
                },
            ],
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);


        $random = getNumber();

        $ticket->user_id = auth()->id();
        $ticket->name = $request->name;
        $ticket->email = $request->email;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $path = imagePath()['ticket']['path'];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $image) {
                try {
                    SupportAttachment::create([
                        'support_message_id' => $message->id,
                        'image' => uploadImage($image, $path),
                    ]);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Could not upload your ' . $image];
                    return back()->withNotify($notify)->withInput();
                }

            }
        }
        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

 
 
    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function posts()
    {
        $posts = Post::latest()
                        ->with('author')
                        ->withCount('comments')
                        ->paginate(9);
        $pageTitle = 'Articles';
        $categories = Category::with('subCategories')->get();
        return view(activeTemplate(). 'posts', compact('posts', 'pageTitle', 'categories'));
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $posts = Post::query()
            ->with('author')
            ->withCount('comments')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('title', 'like', '%' . $q . '%')
                        ->orWhere('meta', 'like', '%' . $q . '%')
                        ->orWhere('content', 'like', '%' . $q . '%');
                });
            })
            ->latest()
            ->paginate(9)
            ->appends(['q' => $q]);
        $pageTitle = $q !== '' ? 'Search: ' . $q : 'Search';
        return view(activeTemplate() . 'search', compact('posts', 'pageTitle', 'q'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:191',
        ]);

        Subscriber::firstOrCreate(['email' => $request->email]);
        $notify[] = ['success', 'You are subscribed for weekly reminders.'];
        return back()->withNotify($notify);
    }

    public function category(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categoryId =  $category->id;
        $posts = Post::with('subCategory.category')
                ->whereHas('subCategory.category', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                })
                ->withCount('comments')
                ->with('author')
                ->paginate(10);   
        $pageTitle = $category->name;
        return view(activeTemplate(). 'category', compact('posts', 'pageTitle', 'category'));
    }

    public function author(Request $request, $username)
    {
        $authors = User::where('username', $username)->firstOrFail();
        $authorId =  $authors->id;
        $posts = Post::where('author_id', $authorId)
                ->withCount('comments')
                ->with('author')
                ->paginate(10);   
        $pageTitle = $authors->fullname;
        return view(activeTemplate(). 'author', compact('posts', 'authors', 'pageTitle'));
    }

    public function subCategory(Request $request, $slug)
    {
        $subCategories = SubCategory::where('slug', $slug)->firstOrFail();
        $posts = $subCategories->posts()->with('author')->withCount('comments')->paginate(9);
        $pageTitle = $subCategories->name;
        return view(activeTemplate(). 'subCategory', compact('subCategories', 'posts', 'pageTitle'));
    }

    public function postView(Request $request, $slug)
    {
        $categories = Category::with('subCategories')->get();
        $post = Post::where('slug', $slug)->with(['author', 'tags', 'subCategory.category'])->firstOrFail();
        $post->increment('view');
        $pageTitle = $post->title;
        $latest = Post::latest()->where('id', '!=', $post->id)->take(5)->get();
        $tags = $post->tags;
        $comments = $post->comments()->with('user')->latest()->get();
        return view(activeTemplate(). 'postView', compact('post', 'pageTitle', 'categories', 'comments', 'latest', 'tags'));
    }

    public function comment(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:2000',
        ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->status = 1;
        $comment->save();

        $notify[] = ['success', 'Your reflection was posted.'];
        return back()->withNotify($notify);
    }

    public function tag(Request $request, $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->with('author')->withCount('comments')->paginate(9);
        $pageTitle = $tag->name;
        return view(activeTemplate(). 'tag', compact('tag', 'posts', 'pageTitle'));
    }


    public function pages()
    {
        $pages = Page::latest()
                        ->paginate();
        $pageTitle = 'All pages';
        return view(activeTemplate(). 'pages', compact('pages', 'pageTitle'));
    }

    public function pageView(Request $request, $slug)
    {
        $categories = SubCategory::with('posts')->get();
        $page = Page::where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $latest = Post::latest()->get()->take(5);
        // dd($tags);
        return view(activeTemplate(). 'pageView', compact('page', 'pageTitle', 'categories', 'latest'));
    }

}
