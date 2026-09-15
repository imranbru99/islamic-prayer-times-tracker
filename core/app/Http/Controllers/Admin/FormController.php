<?php

namespace App\Http\Controllers\admin;

use App\Events\NewForm;
use App\Http\Requests\FormStoreRequest;
use App\Jobs\SyncMedia;
use App\Mail\ReviewForm;
use App\Models\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $forms = Form::all();

        return view('form.index', compact('forms'));
    }

    /**
     * @param \App\Http\Requests\FormStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormStoreRequest $request)
    {
        $form = Form::create($request->validated());

        Mail::to($form->author->email)->send(new ReviewForm($form));

        SyncMedia::dispatch($form);

        event(new NewForm($form));

        $request->session()->flash('form.title', $form->title);

        return redirect()->route('form.index');
    }
}
