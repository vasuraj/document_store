<?php	namespace App\Http\Controllers;
use Auth;
use Input;
use Validator;
use URL;
use DB;
use Response;

class FileDownloadController extends Controller {
	
	public function __construct()
	{
		/* check for the user if the user is not admin he can't upload blank report normal user can only upload files after editing them */

		$user = Auth::user();
				
        $this->user_role=$this->role =$user->roles->first()->name;
        $this->user_id=$user->id;

	}
	
	public function index()
	{
	

	//if user is admin he can upload to online server but normal user can't
		
		if($this->user_role=='admin' || $this->user_role=='Guest')
		{
			// $data['files']=DB::table('files')->orderby('created_at','desc')->get();
			
			// return view('files.adminUpload',$data);
		}
		elseif($this->user_role=='user')
		{
			$data['files']=DB::table('files')->where('upload_user_type','=','admin')->orderby('created_at','desc')->get();
			$data['user_role']=$this->user_role;
			$data['user_id']=$this->user_id;
			return view('files.userDownload',$data);
		}


		
	}



	public function download($fileName)
	{


		if($this->user_role=='admin' || $this->user_role=='user' || $this->user_role=='Guest')
		{
			
			 // public path is must use public_path() method for a file path
			 // do not use URL::to() method for anything 

			 $path=public_path("/uploads/").$fileName;
		
         	 return Response::download($path);
		}

	}

	public function show($month=null, $year=null)
	{
		if($month==null || $year==null)
		{
			echo "set month and year";
		}
		else
		{
		$data=array();
		$data['days_in_the_month']=cal_days_in_month(CAL_GREGORIAN,$month,$year );
		// echo $year.'-01-'.sprintf("%02d",$month);
		$data['year']=$year;
		$data['month']=$month;
		
		$data['start_date']=\Carbon\Carbon::create($year,$month,01,0);
		// echo '-------'.$data['start_date'].'--------';
		
		// echo "<br>";
		$data['end_date']=date('Y-d-m',strtotime($year.'-'.$data['days_in_the_month'].'-'.sprintf("%02d",$month)));

		$data['users_upload']=array();
		//if user is admin he/she can see all the files uploaded by differnt users		
		
		if($this->user_role=='admin'  || $this->user_role=='Guest')
		{

			// get all unique users from the table
			$unique_users=DB::table('role_user')->select('user_id')->where('role_id','=',3)->get();
			$i=0;
			foreach($unique_users as $unique_user)
			{
				
				$data['users_upload'][$i]=$unique_user;

				$selected_user=DB::table('users')->select('email','name','id')->where('id','=',$unique_user->user_id)->first();
				$data['users_upload'][$i]->user_details=$selected_user;
				if($month!=null && $year!=null)
				{
					
					$day=01;
					$starting_date=$year.'-'.$month.'-'.$day;
					$end_date=$year.'-'.($month+1).'-'.$day;
					$files_uploaded=DB::table('files')->whereBetween('created_at',array($starting_date,$end_date))->where('upload_user_type','=','user')->where('uploaded_by','=',$unique_user->user_id)->get();
					$amount_received=DB::table('amount_received')->whereBetween('amount_received_on',array($starting_date,$end_date))->where('user_type','=','user')->where('data_entered_by','=',$unique_user->user_id)->get();

					$data['users_upload'][$i]->file_uploaded=(array) $files_uploaded;

					
					$data['users_upload'][$i]->amount_received=$amount_received;

					

				}

				$i++;
				

			}

		 
		} // admin part ends here and user part will start in else condition
		elseif($this->user_role=='user')
		{
			// get all unique users from the table
			$unique_users=DB::table('role_user')->select('user_id')->where('user_id','=',$this->user_id)->where('role_id','=',3)->get();
			$i=0;
			foreach($unique_users as $unique_user)
			{
				
				$data['users_upload'][$i]=$unique_user;

				$selected_user=DB::table('users')->select('email','name','id')->where('id','=',$unique_user->user_id)->first();
				$data['users_upload'][$i]->user_details=$selected_user;
				if($month!=null && $year!=null)
				{
					
					$day=01;
					$starting_date=$year.'-'.$month.'-'.$day;
					$end_date=$year.'-'.($month+1).'-'.$day;
					$files_uploaded=DB::table('files')->whereBetween('created_at',array($starting_date,$end_date))->where('upload_user_type','=','user')->where('uploaded_by','=',$unique_user->user_id)->get();
					$amount_received=DB::table('amount_received')->whereBetween('amount_received_on',array($starting_date,$end_date))->where('user_type','=','user')->where('data_entered_by','=',$unique_user->user_id)->get();

					$data['users_upload'][$i]->file_uploaded=(array) $files_uploaded;

					
					$data['users_upload'][$i]->amount_received=$amount_received;

					

				}

				$i++;
				

			}

		}
			$data['user_role']=$this->user_role;
			$data['user_id']=$this->user_id;
	return view('files.show',$data);
	}
   } // else condition ends here	
}


?>