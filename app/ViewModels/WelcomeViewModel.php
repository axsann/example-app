<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;

class WelcomeViewModel
{

    /**
     * @var Collection<int, string> $list
     */


    /**
     * Create a new component instance.
     *
     * @param Collection<int, string> $list
     */
    public function __construct(
        public int $tweetId,
        public Collection $list
    ) {
    }
}
