<?php

class AdminController extends BaseController {


	public function index()
	{
		return View::make('admin.home');
	}

	public function login()
	{
		return View::make('admin.login');
	}

	public function postLogin()
	{

		$param = Input::all();

		try
		{
		    // Login credentials
		    $credentials = array(
		        'email'    => $param['email'],
		        'password' => $param['password'],
		    );

		    // Authenticate the user
		    $user = Sentry::authenticate($credentials, false);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    echo 'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    echo 'User is not activated.';
		}

		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    echo 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    echo 'User is banned.';
		}

		return Redirect::to('admin');
	}


	public function logout()
	{
		if(Sentry::check()){
			Sentry::logout();
		}
		return Redirect::to('admin');
	}

}
