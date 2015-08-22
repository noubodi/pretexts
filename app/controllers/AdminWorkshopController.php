<?php

class AdminWorkshopController extends BaseController {


	public function getIndex()
	{
		$workshops = Workshop::all();
		return View::make('admin.workshop.index', compact('workshops'));
	}


	public function getCreate()
	{
		return View::make('admin.workshop.create');
	}


	public function getEdit(Workshop $workshop)
	{
		return View::make('admin.workshop.edit', compact('workshop'));
	}


	public function getDelete()
	{
		return 'hol';
	}


}