<?php	namespace App\Http\Controllers;
use Auth;
use Input;
use Validator;
use URL;
use DB;
// use Helpers;	
class FileUploadController extends Controller {

	public static function mysql_to_php_date_and_time($mysql_date=null)
	{
		$date_and_time=new \stdClass();
	    $date_time=explode(" ", $mysql_date);

		$date_and_time->date=$date_time[0];
		$date_and_time->time=$date_time[1];
		
		return $date_and_time;

	}

	public static function extract_date($string_date)
	{
		
		$string_date=explode('-',$string_date);
		
		$date=new \stdClass();

		$date->year=$string_date[0];
		$date->month=$string_date[1];
		$date->day=$string_date[2];
		
		return $date;


	}

	public static function get_months_between_dates($date1,$date2)
	{
		
		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);

		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);

		$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

		return $diff;

	}


	
	public function __construct()
	{
		/* check for the user if the user is not admin he can't upload blank report normal user can only upload files after editing them */

		$user = Auth::user();
		// print_r($user);
        $this->user_role=$this->role =$user->roles->first()->name;
        $this->user_id=$user->id;
        $this->user_name=$user->name;
        $this->user_email=$user->email;

        // public function index_to_key($array,$array_of_keys)
        // {
        // 	echo "converting";
        // }

       
	}



	public function index()
	{
	

	//if user is admin he can upload to online server but normal user can't
		
		if($this->user_role=='admin')
		{
			$data['files']=DB::table('files')->where('upload_user_type','=','admin')->orderby('created_at','desc')->get();
			
			$data['user_role']=$this->user_role;
			$data['user_id']=$this->user_id;
			return view('files.adminUpload',$data);
		}
		elseif($this->user_role=='user')
		{
			$data['files']=DB::table('files')->where('uploaded_by','=',$this->user_id)->where('upload_user_type','=','user')->orderby('created_at','desc')->get();
			
			$data['user_role']=$this->user_role;
			$data['user_id']=$this->user_id;
			$data['user_name']=$this->user_name;
			$data['user_email']=$this->user_email;

			$data['unique_file_abbreviations']=$unique_files_abbreviations=DB::table('files')->select('id','abbreviation','name','deadline')->where('upload_user_type','=','admin')->groupby('abbreviation')->distinct('abbreviation')->get();

			return view('files.userUpload',$data);
		}


		
	}

	// store file uploaded by admin

	public function adminFileStore()
	{
	$data=array();
	$is_sucessfully_stoerd_in_db=false;
	

	$file=Input::file('file');
	$adminFileUploadPath=public_path('uploads');

	$allowedExts = array($file->guessClientExtension());
			
	$extension = $file->guessClientExtension();

	if(!is_writable($adminFileUploadPath))
	{
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t upload File; no write Access at '.$adminFileUploadPath
		);
		
		// print json_encode($response);
		return;
	}
	if(!is_writable($adminFileUploadPath)){
				$response = Array(
					"status" => 'error',
					"message" => 'Can`t upload File; no write Access at '.$imagePath
				);
				print json_encode($response);
				return;
			}
			
	if ( in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			$response = array(
			"status" => 'error',
			"message" => 'ERROR Return Code: '. $_FILES["file"]["error"],
			);			
		}
		else
		{
					
			//$filename = $image->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$filename =$file->getClientOriginalName().'_-_'.date('d_m_Y_h_i_s_A').'-'.$this->user_id.'.'.$extension;

			$file->move($adminFileUploadPath,$filename);

			// data to be stored in database
			$file_data['description']=$_POST['description'];
			$file_data['name']=$filename;
			$file_data['abbreviation']=$_POST['abbreviation'];

			if(isset($_POST['deadline']))
			{
				$timestamp = strtotime($_POST['deadline']);
				$file_data['deadline']=date("Y-m-d H:i:s", $timestamp);	
			}
			$file_data['uploaded_by']=$this->user_id;
			$file_data['upload_user_type']=$this->user_role;
			$file_data['created_at']=\Carbon\Carbon::now()->toDateTimeString();
 	

 			$is_already_inserted=DB::table('files')->where('abbreviation','=',$_POST['abbreviation'])->where('upload_user_type','=',$this->user_role)->where('uploaded_by','=',$this->user_id)->first();

 			if(empty($is_already_inserted))
 			{
			// store details in files table
			$insertGetId=DB::table('files')->insertGetId($file_data);
			}
			else
			{
			DB::table('files')->where('id','=',$is_already_inserted->id)->update($file_data);	
			$insertGetId=$is_already_inserted->id;
			}
			if($insertGetId!=-1)
			{
				$is_sucessfully_stoerd_in_db=true;
			}
		  	
		  	// remove the varibale from memory
		  	unset($file_data);

		  	// list($width, $height) = getimagesize( $imagePath.'/'.$filename );

							  
		}
		

		if($is_sucessfully_stoerd_in_db==true)
		{

		// if file data sucessfully store in database

		// create a flash message
			$message=array();
			$message['type']="success";
			$message['heading']="Success";
			$message['body']="File ".$file->getClientOriginalName()." stored sucessfully";
		 	\Session::flash('flash_message',$message);

		  return redirect('fileUpload');
		}
	}
	else
	{
			$message=array();
		 	$message['type']="error";
		 	$message['heading']="Failed";
			$message['body']="File $filename can not be stored";
		 	\Session::flash('flash_message',$message);
		 	 return redirect('fileUpload');
	}
			

}


	public function useradminFileUpload($userType)
	{
		// print_r($user);
		return "File upload section only for admin";	
	}

	public function viewSummary($user_id)
	{


		// get First records and extract year and month
		$uploaded_files_first=DB::table('users')->where("id",'=',$user_id)->first();
		$data=array();
		if(!empty($uploaded_files_first))
		{
		$first_upload_date= $uploaded_files_first->created_at;
		

		$first_date_time=FileUploadController::mysql_to_php_date_and_time($first_upload_date);
		
		$first_date=FileUploadController::extract_date((string)$first_date_time->date);
	

		// get last record and extract year and month


		$uploaded_files_last=DB::table('files')->where("uploaded_by",'=',$user_id)->orderby('created_at','desc')->first();
		$uploaded_amount_received_last=DB::table('amount_received')->where("data_entered_by",'=',$user_id)->orderby('created_at','desc')->first();
		

		

		// print_r($uploaded_files_last);
		// print_r($uploaded_amount_received_last);
		
		if(empty($uploaded_files_last->created_at) && empty($uploaded_amount_received_last->created_at))
		{
			$last_upload_date=null;
		}
		elseif(!empty($uploaded_files_last->created_at) && empty($uploaded_amount_received_last->created_at))
		{
			$last_upload_date=$uploaded_files_last->created_at;
		}
		elseif(empty($uploaded_files_last->created_at) && !empty($uploaded_amount_received_last->created_at))
		{
			$last_upload_date=$uploaded_amount_received_last->created_at;
		}
		elseif(strtotime($uploaded_files_last->created_at)>strtotime($uploaded_amount_received_last->created_at))
		{
			$last_upload_date=$uploaded_files_last->created_at;
		}
		else
		{
			$last_upload_date=$uploaded_amount_received_last->created_at;
		}


		

		if(isset($last_upload_date))
		{
		// // print_r($uploaded_files_last);
		// $last_upload_date= $uploaded_files_last->created_at;
		

		$last_date_time=FileUploadController::mysql_to_php_date_and_time($last_upload_date);
		
		$last_date=FileUploadController::extract_date((string)$last_date_time->date);
		
		$data['first_date']=$first_date;
		$data['last_date']=$last_date;
		$data['user_id']=$user_id;
		$data['number_of_months_between_dates']=FileUploadController::get_months_between_dates($first_date_time->date,$last_date_time->date);

		// print_r($first_date); print_r($last_date);

		// echo "<br>---------------------<br>";

		$first_month=(int)$first_date->month;
		$first_year=(int)$first_date->year;

		$last_month=(int)$last_date->month;
		$last_year=(int)$last_date->year;

		// echo $data['number_of_months_between_dates'];


		// user file upload summary code here
		$data['user_summary']=array();
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;
		$starting_date=$first_year.'-'.($first_month-0).'-01';
		for($month_counter=-1;$month_counter<$data['number_of_months_between_dates'];$month_counter++)
		{
			$time = strtotime($starting_date);
			$current_date = date("Y-m-d", strtotime("+".($month_counter+1)." month", $time));
			$current_month_name = date("F Y", strtotime("+".($month_counter+1)." month", $time));
	
			$data['user_summary'][$month_counter][]=$current_date;
			$data['user_summary'][$month_counter]['month']=$current_month_name;

			// get file upload info

			$time = strtotime($starting_date);
			$next_date = date("Y-m-d", strtotime("+".($month_counter+2)." month", $time));
			// echo $next_date;
			$current_date_end=strtotime("-1 days", strtotime($next_date));
    		$current_date_end= date("Y-m-d", $current_date_end);

			// echo "<div style='background:gray;'>";
			// echo $current_date;
			// echo "-";

			// echo $current_date_end;
			// echo "</div>";
			// echo $next_date;
			$files_uploaded=DB::table('files')->whereBetween('created_at',array($current_date,$current_date_end))->where('upload_user_type','=','user')->where('uploaded_by','=',$user_id)->get();
			$data['user_summary'][$month_counter]['files_uploaded']=$files_uploaded;


		}


		// user budget summary code here
		$data['user_budget_summary']=array();
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;
		$starting_date=$first_year.'-'.($first_month-0).'-01';
		for($month_counter=-1;$month_counter<$data['number_of_months_between_dates'];$month_counter++)
		{
			$time = strtotime($starting_date);
			$current_date = date("Y-m-d", strtotime("+".($month_counter+1)." month", $time));
			$current_month_name = date("F Y", strtotime("+".($month_counter+1)." month", $time));
	
			$data['user_budget_summary'][$month_counter][]=$current_date;
			$data['user_budget_summary'][$month_counter]['month']=$current_month_name;

			// get file upload info

			$time = strtotime($starting_date);
			$next_date = date("Y-m-d", strtotime("+".($month_counter+2)." month", $time));
			// echo $next_date;
			$current_date_end=strtotime("-1 days", strtotime($next_date));
    		$current_date_end= date("Y-m-d", $current_date_end);

			$files_uploaded=DB::table('amount_received')->whereBetween('amount_received_on',array($current_date,$current_date_end))->where('user_type','=','user')->where('data_entered_by','=',$user_id)->get();
			$data['user_budget_summary'][$month_counter]['budget']=$files_uploaded;


		}

		} 
	}

	$data['user_uc']=DB::table('uc_uploads')->where('user_type','=','user')->where('data_entered_by','=',$user_id)->get();
	$data['user_audit_report']=DB::table('audit_reports')->where('upload_user_type','=','user')->where('uploaded_by','=',$user_id)->get();


			$data['user_role']=$this->user_role;
			$data['user_id']=$this->user_id;
			$data['user_name']=$this->user_name;
			$data['user_email']=$this->user_email;
		
		// print_r($data['user_budget_summary']);

		return view('files.viewSummary',$data);

	}


	public function getSummaryJson($month,$year,$user_id)
	{
	// 	$temp_array=array();
	// 	$values['data']=array();
	// 	for($i=1;$i<=35;$i++)
	// 	{
	// 		$temp_array[]=$i;
	// 	}
	// 	$values['data'][]=$temp_array;
	// return response()->json($values);

			$temp_array=array();
		$values=array();
		for($i=1;$i<=35;$i++)
		{
			$values[0][]=$i;
		}
		$values=$values;
	return response()->json($values);
	}
	
	public function delete($file_id=null,$return_to)
	{
		

	//---- This code give access to delete file only to users who uploaded it 

		// $is_deleted=DB::table('files')->where('id','=',$file_id)->where('uploaded_by','=',$this->user_id)->delete();


	//---- This code below gives acces to admin only to delete any file

		$is_deleted=DB::table('files')->where('id','=',$file_id)->delete();

		if($is_deleted==1)
		{
			$message=array();
			$message['type']="success";
			$message['heading']="Success";
			$message['body']='File deleted sucessfully';
		 	\Session::flash('flash_message',$message);
		}
		else
		{
			$message=array();
		 	$message['type']="error";
		 	$message['heading']="Failed";
			$message['body']='File can not be deleted';
		 	\Session::flash('flash_message',$message);
		}


		return redirect(base64_decode($return_to));
	}


// file upload deadline function

	public function fileUploadDeadline()
	{
		$data['user_role']=$this->user_role;
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$data['user_email']=$this->user_email;
		$data['unique_file_abbreviations']=$unique_files_abbreviations=DB::table('files')->select('id','abbreviation','name','deadline')->where('upload_user_type','=','admin')->groupby('abbreviation')->distinct('abbreviation')->get();
		return view('files.deadline',$data);
	}

	public function getDeadline($abbreviation,$deadline)
	{
		// echo $abbreviation;

		// echo base64_decode($deadline);
		$data['deadline']=$deadline;
		// get all unique users from the table
			$unique_users=DB::table('role_user')->select('user_id')->where('role_id','=',3)->get();
			$i=0;
			foreach($unique_users as $unique_user)
			{
				
				$data['users_uploads'][$i]=$unique_user;

				$selected_user=DB::table('users')->select('email','name','id')->where('id','=',$unique_user->user_id)->first();
				$data['users_uploads'][$i]->user_details=$selected_user;
			
					$files_uploaded=DB::table('files')->where('upload_user_type','=','user')->where('abbreviation','=',$abbreviation)->where('uploaded_by','=',$unique_user->user_id)->get();
					
					$data['users_uploads'][$i]->file_uploaded=(array) $files_uploaded;

				$i++;
				

			}

			// foreach($data['users_upload'] as $uploaded)
			// {
			// 	print_r($uploaded);
			// 	echo "<br>--------------<br>";
			// }

			return view('files.getDeadline',$data);

	}






}


?>