<?php namespace App\Http\Controllers;

use Auth;
class DashboardController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
		$this->middleware('auth', ['only' => 'logged']);

		$user = Auth::user();
				
        $this->user_role=$this->role =$user->roles->first()->name;
        $this->user_id=$user->id;

	}

	public function index()
	{

		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		return view('dashboard.index',$data);
	}

}
