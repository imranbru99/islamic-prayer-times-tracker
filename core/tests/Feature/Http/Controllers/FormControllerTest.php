<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewForm;
use App\Jobs\SyncMedia;
use App\Mail\ReviewForm;
use App\Models\Form;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FormController
 */
class FormControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $forms = Form::factory()->count(3)->create();

        $response = $this->get(route('form.index'));

        $response->assertOk();
        $response->assertViewIs('form.index');
        $response->assertViewHas('forms');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FormController::class,
            'store',
            \App\Http\Requests\FormStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $content = $this->faker->paragraphs(3, true);
        $author = User::factory()->create();

        Mail::fake();
        Queue::fake();
        Event::fake();

        $response = $this->post(route('form.store'), [
            'title' => $title,
            'content' => $content,
            'author_id' => $author->id,
        ]);

        $forms = Form::query()
            ->where('title', $title)
            ->where('content', $content)
            ->where('author_id', $author->id)
            ->get();
        $this->assertCount(1, $forms);
        $form = $forms->first();

        $response->assertRedirect(route('form.index'));
        $response->assertSessionHas('form.title', $form->title);

        Mail::assertSent(ReviewForm::class, function ($mail) use ($form) {
            return $mail->hasTo($form->author->email) && $mail->form->is($form);
        });
        Queue::assertPushed(SyncMedia::class, function ($job) use ($form) {
            return $job->form->is($form);
        });
        Event::assertDispatched(NewForm::class, function ($event) use ($form) {
            return $event->form->is($form);
        });
    }
}
