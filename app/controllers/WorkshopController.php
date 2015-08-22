<?php

class WorkshopController extends BaseController {


	public function index()
	{
		$workshops = Workshop::all();
		return View::make('dashboard.workshop.index', compact('workshops'));
	}


	public function create()
	{
		return View::make('dashboard.workshop.create');
	}


	public function postCreate()
	{
		$param = Input::all();

		$workshop = new Workshop;
		$workshop->title = $param['title'];
		$workshop->content = $param['content'];
		$workshop->latitude = $param['latitude'];
		$workshop->longitude = $param['longitude'];
		$workshop->save();

		return Redirect::action('WorkshopController@index');
	}

	public function edit(Workshop $workshop)
	{
		return View::make('dashboard.workshop.edit', compact('workshop'));
	}

	public function postEdit()
	{
		$param = Input::all();

		$workshop = Workshop::findOrFail($param['id']);

		$workshop->title = $param['title'];
		$workshop->content = $param['content'];
		$workshop->latitude = $param['latitude'];
		$workshop->longitude = $param['longitude'];
		$workshop->save();

		return Redirect::action('WorkshopController@index');

	}

	public function delete()
	{
		return '';
	}


}
