<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewForm
{
    use SerializesModels;

    public $form;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($form)
    {
        $this->form = $form;
    }
}
