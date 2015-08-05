<?php

namespace Example\MilnweeCore\Providers;

use Illuminate\Support\ServiceProvider;

class AdminAutoCrudProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        $path = base_path() . '/app/Http/Controllers';
        $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
        $admin_menu_items = array();
        
        // load each of our controllers, to register their own routes
        foreach($objects as $name => $object){
            if (substr($name, -4) == '.php') {
                $class_name = $this->alias = substr($name, strrpos($name, '/') + 1);
                $class_name = str_replace('.php', '', $class_name);
                $full_class_name = '\Example\Http\\' . $class_name;
                $Class = new $full_class_name;
                if (method_exists($Class, 'admin__initialise_automatic_admin')) {
                    $Class->admin__initialise_automatic_admin();
                }
            }
        }
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
