<?php namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller {

	public function __construct()
	{

		if(Auth::user()!=null)
		{
		$user = Auth::user();
		$this->user_role=$this->role =$user->roles->first()->name;
        $this->user_id=$user->id;
    	}

	}

	public function index()
	{
		if(Auth::user()!=null)
		{
		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		return view('home',$data);
		}
		else
		{
		return view('home');
		}
	}

}