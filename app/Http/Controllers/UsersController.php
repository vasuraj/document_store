<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Criteria\User\UsersWithRoles;
use App\Repositories\UserRepository as User;
use App\Repositories\RoleRepository as Role;
use Laracasts\Flash\Flash;
use Auth;
use DB;

class UsersController extends Controller {

	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @param User $user
	 * @param Role $role
	 */
	public function __construct(User $user, Role $role)
	{
		
		$this->user = $user;
		$this->role = $role;

		$user = Auth::user();
		// print_r($user);
        $this->user_role=$user->roles->first()->name;
        $this->user_id=$user->id;
        $this->user_name=$user->name;
        $this->user_email=$user->email;

	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;

		$users = $this->user->pushCriteria(new UsersWithRoles())->paginate(10);
		return view('users.index', compact('users'))->with($data);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;
		
		
		$roles = $this->role->all();
		return view('users.create', compact('roles'))->with($data);
	}

	/**
	 * @param CreateUserRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(CreateUserRequest $request)
	{

		
		$user = $this->user->create($request->all());

		if($request->get('role'))
		{
			$user->roles()->sync($request->get('role'));
		}
		else
		{
			$user->roles()->sync([]);
		}

		Flash::success('User successfully created');

		return redirect('/users');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;

		$user = $this->user->find($id);
		$roles = $this->role->all();
		$userRoles = $user->roles();
		return view('users.edit', compact('user', 'roles', 'userRoles'))->with($data);
	}

	/**
	 * @param $id
	 * @param UpdateUserRequest $request
	 */
	public function update(UpdateUserRequest $request, $id)
	{
		$user = $this->user->find($id);
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		if($request->get('password'))
		{
			$user->password = $request->get('password');
		}
		$user->save();

		if($request->get('role'))
		{
			$user->roles()->sync($request->get('role'));
		}
		else
		{
			$user->roles()->sync([]);
		}

		Flash::success('User successfully updated');

		return redirect('/users');
	}

	/**
	 * @param $id
	 */
	public function destroy($id)
	{
		$this->user->delete($id);

		Flash::success('User successfully deleted');

		return redirect('/users');
	}

	public function profile($id)
	{

		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;
		
		$data['user_basic_info']=DB::table('users')->where('id','=',$id)->first();
		$data['user_extra_info']=DB::table('user_extra_info')->where('id','=',$id)->first();
		return view('users/profile',$data);

	}

	public function editProfile($id)
	{
		

		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;
		
		
		$roles = $this->role->all();

		$user = $this->user->find($id);
		$roles = $this->role->all();
		$userRoles = $user->roles();
		$data['user_extra_info']=DB::table('user_extra_info')->where('id','=',$user->id)->first();
		return view('users.editProfile', compact('user','roles','roles', 'userRoles'))->with($data);
	}

	public function updateProfile()
	{
		// print_r($_POST);

		$user = $this->user->find($this->user_id);
		$user->name = $_POST['name'];
		$user->email = $_POST['email'];
		if($_POST['password'])
		{
			$user->password = $_POST['password'];
		}
		$user->save();

		$user_extra_info=array();

		$user_extra_info['id']=$user->id;
		$user_extra_info['orgname']=$_POST['orgname'];
		$user_extra_info['orgemail']=$_POST['orgemail'];
		$user_extra_info['address']=$_POST['address'];
		$user_extra_info['mobile']=$_POST['mobile'];
		$user_extra_info['whatsapp_number']=$_POST['whatsapp_number'];
		$user_extra_info['skype_id']=$_POST['skype_id'];
		$user_extra_info['landline_number']=$_POST['landline_number'];
		$user_extra_info['password']=$_POST['password'];

		$is_user_already_exist=DB::table('user_extra_info')->where('id','=',$user->id)->first();
		
		if(empty($is_user_already_exist))
		{
		DB::table('user_extra_info')->insertGetId($user_extra_info);
		}
		else
		{
		DB::table('user_extra_info')->where('id','=',$user->id)->update($user_extra_info);
		}


		print_r($_POST);
		Flash::success('User successfully updated');
		return redirect('/user/profile/'.$user->id);
		
	}

}