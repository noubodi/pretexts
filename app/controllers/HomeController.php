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


}
