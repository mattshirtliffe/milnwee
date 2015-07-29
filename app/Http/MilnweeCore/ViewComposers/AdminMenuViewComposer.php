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
        echo "<pre>";
        print_r(get_declared_classes());
        $classes_with_possible_menu = array();
        
        foreach (get_declared_classes() as $class_name) {
            
        }
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
