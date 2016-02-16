# Milnwee CMS

## A Fullstack CMS for Laravel 5.1

__Milnwee is still a WIP! Check the public todos below__

> A what now?

Milnwee is designed to be downloaded and used as the base of your project. You would clone a copy of Milnwee, run `artisan` commands to set things up, and then build your app on top of it.

> So what are it's main benefits? Why should I use it?

__Developer friendly, totally customisable__ - Milnwee isn't a huge monolith that you have to somehow force your business rules onto; it's the glue for your app's components. You define the models, the relationships, the logic. Milnwee ties everything together and makes the whole process smoother. By v1.0, I wan't the CRUD interface to be simple and intuitive enough that any non-technical client could use it with ease.

### Current Test Case Of Functionality

- Clone and setup the repo (artisan commands, yada yada)
- Make a new model. Go for something cute, like "Puppies", "Gnomes", or "Elder Gods".
- Define the `fillable` array on the model, so Milnwee knows what fields we're talking about. Make sure it has at least an `id` and a `name` field.
- Build a table for the model. I guess you can do this however you want, but you've already cloned the repo, so you may as well make a migration? Whatevs.
- Build a controller for the model. Use and extend the `MilnweeCoreController` like such;
````
    namespace Example\Http\Controllers;

    use Illuminate\Http\Request;
    use Example\Http\Requests;
    use MilnweeCore\Controllers\MilnweeCoreController as MilneweeCoreController;

    class PuppiesController extends MilneweeCoreController {

    }
````
- Define a resource route for your controller. Stick something like the following in your routes file;
````
Route::resource('admin/puppies', 'puppies');
````
- And that should be it! Go to your new route, and you should get an index page. You should be able to add, edit and delete records for your new model, and it should be magically autoloading all the fields and everything for you on your add and edit forms.
- Current component test - use and add the `MilnweeCore\Traits\RouteableTrait` to a model - you should magically get the field to define a route for the record, which is automatically saved into a single polymorphic many-to-many table.

### Current TODO (In no particular order)

- Make the formhelper not gross
- Automate the building of the routes for the controllers (had an idea for this but it's pretty gross, come up with something better)
- Image trait, so we have a couple of different Milnwee components to test and play with
- Some way for the admin interface to rub on tabs (and make these easy to define)

### Longterm TODO ideas

- No reason everything can't be out in a composer package and brought in. Do that. No need for people to clone
a repo of it and build of top of it like lunatics.
- User system. Obviously has to be an admin system in place.
