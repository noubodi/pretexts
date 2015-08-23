<?php

class HomeController extends BaseController {


	public function index()
	{
		return View::make('home');
	}


	public function workshops()
	{
		$workshops = Workshop::all();
		return View::make('map.index', compact('workshops'));
	}
	
	public function languages()
	{	
	$languages = Language::all();
	$current_lang = 'name_'.Lang::getLocale();
	$countries = DB::table('countries')->select( 'id' ,  $current_lang . ' as name')->get();

	return View::make('home', ['countries' => $countries, 'languages' => $languages]);
	}

}
