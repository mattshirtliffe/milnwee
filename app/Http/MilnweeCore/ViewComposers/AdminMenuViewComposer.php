<?php

namespace Example\Http\MilnweeCore\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;

class AdminMenuViewComposer
{
    public $menu_items = array();
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $classes = $this->app->data_thing;
        
        print_r($classes);
        die;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('test_data', 'count123');
    }
}
