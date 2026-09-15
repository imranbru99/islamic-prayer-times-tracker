<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewSubCategory
{
    use SerializesModels;

    public $subCategory;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($subCategory)
    {
        $this->subCategory = $subCategory;
    }
}
