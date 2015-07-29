<?php

namespace Example\MilnweeCore\Providers;

use Illuminate\Support\ServiceProvider;

class AdminAutoCrud extends ServiceProvider
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
        foreach($objects as $name => $object){
            echo $name;
            echo "<br>";
        }
        die;
        
        foreach (glob(base_path() . '/app/Http/Controllers/**.php') as $filename) {
            include $filename;
            
            $class_name = $this->alias = substr($filename, strrpos($filename, '\\') + 1);
            $class_name = str_replace('.php', '', $class_name);
            
            echo($class_name);
            echo "<br>";
            
            // $full_class_name = '\Example\Http\Controllers\\' . $class_name;
            // $Class = new $full_class_name;
        }
        die;
        
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
