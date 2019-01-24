<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Events extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Event::count();
        $string = 'Events';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-fire',
            'title'  => "{$count} {$string}",
            'text'   => 'You have '."{$count}".' '."{$string}",
            'button' => [
                'text' => 'Browse all Events',
                'link' => route('voyager.events.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('Post'));
    }
}
