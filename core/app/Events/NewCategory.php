<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewCategory
{
    use SerializesModels;

    public $category;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($category)
    {
        $this->category = $category;
    }
}
