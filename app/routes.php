<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//

Route::model('workshop', 'Workshop');


// Route::get('login', 'SentryController@index');



// Pages
Route::get('/', 'HomeController@index');
// ESTO SE PASA AL CONTROLLER
// Route::get('/', function()
// {	
// 	$languages = Language::all();
// 	$current_lang = 'name_'.Lang::getLocale();
// 	$countries = DB::table('countries')->select( 'id' ,  $current_lang . ' as name')->get();
// 
// 	return View::make('home', ['countries' => $countries, 'languages' => $languages]);
// });
// LANGUAGES
Route::get('/lang/{language}', function($language)
{
	// Function that change language
	Session::set('locale', $language);
	return Redirect::back();
})->where('language', '[A-za-z]+');

// ABOUT
Route::get('what-is-pretexts', function() {
	return View::make('pages.what-is-pretexts');
});

Route::get('how-we-work', function() {
	return View::make('pages.how-we-work');
});

Route::get('who-we-are', function() {
	return View::make('pages.who-we-are');
});

Route::get('history', function() {
	return View::make('pages.history');
});

//MAP

Route::get('map', 'HomeController@workshops');

// WORKSHOPS
Route::get('workshops/upcoming', function() {
	$workshops = Workshop::all();
	return View::make('workshops.upcoming', compact('workshops'));
});

Route::get('workshops/past', function() {
	$workshops = Workshop::all();
	return View::make('workshops.past', compact('workshops'));
});


// BLOG
Route::get('blog/news', function() {
	return View::make('blog.news');
});

Route::get('blog/testimonials', function() {
	return View::make('blog.testimonials');
});

Route::get('blog/stories', function() {
	return View::make('blog.stories');
});

// COLLABORATORS
Route::get('collaborators', function() {
	return View::make('collaborators.index');
});

Route::get('collaborators/coordinators', function() {
	return View::make('collaborators.coordinators');
});

Route::get('collaborators/capacity-builders', function() {
	return View::make('collaborators.capacity-builders');
});

Route::get('collaborators/facilitators', function() {
	return View::make('collaborators.facilitators');
});

Route::get('collaborators/interships', function() {
	return View::make('collaborators.interships');
});

Route::get('collaborators/partners', function() {
	return View::make('collaborators.partners');
});

// PARTICIPATE
Route::get('participate', function() {
	return View::make('pages.participate');
});


Route::get('login', array('as' => 'login', 'uses' => 'SentryController@index'));
Route::get('logout', 'SentryController@logout');

Route::group(array('before' => 'auth'), function()
{

	Route::get('dashboard', function() {
		return View::make('dashboard');
	});

	Route::get('dashboard/workshops', 'WorkshopController@index');
	Route::get('dashboard/workshop/create', 'WorkshopController@create');
	Route::get('dashboard/workshop/edit/{workshop}', 'WorkshopController@edit');
	Route::get('dashboard/workshop/delete/{workshop}', 'WorkshopController@delete');

	Route::post('dashboard/workshop/create', 'WorkshopController@postCreate');
	Route::post('dashboard/workshop/edit', 'WorkshopController@postEdit');

	Route::get('dashboard/news', 'NewsController@index');
	Route::get('dashboard/news/create', 'NewsController@create');
	Route::get('dashboard/news/edit/{news}', 'NewsController@edit');
	Route::get('dashboard/news/delete/{news}', 'NewsController@delete');

	Route::post('dashboard/news/create', 'NewsController@postCreate');
	Route::post('dashboard/news/edit', 'NewsController@postEdit');

});

Route::post('login', 'SentryController@postLogin');


// Admin Section

Route::get('admin/creategroup', function()
{
	try
	{
	    // Create the group
	    $group = Sentry::createGroup(array(
	        'name'        => 'Tejedor',
	        'permissions' => array(
	            'workshop.create' => 0,
	            'workshop.delete' => 0,
	            'workshop.view' => 0,
	            'workshop.update' => 0,
	        ),
	    ));
	}
	catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
	{
	    echo 'Name field is required';
	}
	catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
	{
	    echo 'Group already exists';
	}
});


Route::get('admin/updategroup', function()
{
	try
	{
	    // Find the group using the group id
	    $group = Sentry::findGroupById(3);

	    // Update the group details
	    $group->name = 'Tejedor';
	    $group->permissions = array(
	        'workshop.create' => 1,
            'workshop.delete' => 1,
            'workshop.view' => 1,
            'workshop.update' => 1,
	    );

	    // Update the group
	    if ($group->save())
	    {
	        // Group information was updated
	    }
	    else
	    {
	        // Group information was not updated
	    }
	}
	catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
	{
	    echo 'Name field is required';
	}
	catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
	{
	    echo 'Group already exists.';
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
	    echo 'Group was not found.';
	}
});


Route::get('admin/register', function(){
	try
	{
	    // Create the user
	    $user = Sentry::createUser(array(
	        'email'       => 'tejedor@mail.com',
	        'password'    => 'test',
	        'activated'   => true,
	    ));

	    $group = Sentry::findGroupByName('Tejedor');
	    // Assign the group to the user
	    if ($user->addGroup($group))
	    {
	        // Group assigned successfully
	    	return 'added';
	    }
	    else
	    {
	        // Group was not assigned

	    }
	}
	catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
	{
	    echo 'Login field is required.';
	}
	catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
	{
	    echo 'Password field is required.';
	}
	catch (Cartalyst\Sentry\Users\UserExistsException $e)
	{
	    echo 'User with this login already exists.';
	}
});

Route::get('admin/login', 'AdminController@login');
Route::get('admin/logout', 'AdminController@logout');
Route::post('admin/login', 'AdminController@postLogin');

Route::group(array('before' => 'admin'), function()
{

	Route::get('admin', 'AdminController@index');
	Route::get('admin/workshops', 'AdminWorkshopController@getIndex');
	Route::get('admin/workshops/create', 'AdminWorkshopController@getCreate');
	Route::get('admin/workshops/{id}/edit', 'AdminWorkshopController@getEdit');
	Route::get('admin/workshops/{id}/delete', 'AdminWorkshopController@getDelete');

});
