<?php namespace App\Http\Controllers;

use App\Repositories\Criteria\Role\RolesWithPermissions;
use App\Repositories\RoleRepository as Role;
use App\Repositories\PermissionRepository as Permission;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Auth;

class RolesController extends Controller {

	private $role;
	private $permission;

	public function __construct(Role $role, Permission $permission)
	{
		$this->role = $role;
		$this->permission = $permission;

		
		$user = Auth::user();
		// print_r($user);
        $this->user_role=$user->roles->first()->name;
        $this->user_id=$user->id;
        $this->user_name=$user->name;
        $this->user_email=$user->email;
	}

	public function index()
	{

		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;
		$roles = $this->role->pushCriteria(new RolesWithPermissions())->paginate(10);
		return view('roles.index', compact('roles'))->with($data);
	}

	public function create()
	{
		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;
		$permissions = $this->permission->all();
		return view('roles.create', compact('permissions'))->with($data);
	}

	public function store(Request $request)
	{

		$this->validate($request, array('name' => 'required', 'display_name' => 'required', 'level' => 'required|unique:roles'));


		$role = $this->role->create($request->all());

		$role->savePermissions($request->get('perms'));

		Flash::success('Role successfully created');

		return redirect('/roles');
	}

	public function edit($id)
	{
		$role = $this->role->find($id);
		if($role->id == 1)
		{
			abort(403);
		}
		$permissions = $this->permission->all();
		$rolePerms = $role->perms();

		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email; 
		
		return view('roles.edit', compact('role', 'permissions', 'rolePerms'))->with($data);
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, array('name' => 'required', 'display_name' => 'required', 'level' => 'required'));

		$role = $this->role->find($id);
		$role->update($request->all());

		$role->savePermissions($request->get('perms'));

		Flash::success('Role successfully updated');

		return redirect('/roles');
	}

	public function destroy($id)
	{
		if($id == 1)
		{
			abort(403);
		}

		$this->role->delete($id);

		Flash::success('Role successfully deleted');

		return redirect('/roles');
	}

}