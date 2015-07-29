<?php

namespace Example\MilnweeCore\Providers;

use Illuminate\Support\ServiceProvider;

class MilnweeCoreViewComposerProviders extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        view()->composer(
            'milnwee_core.admin.elements.admin_menu', 'Example\Http\MilnweeCore\ViewComposers\AdminMenuViewComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
