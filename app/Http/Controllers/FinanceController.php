<?php	namespace App\Http\Controllers;
use Auth;
use Input;
use Validator;
use URL;
use DB;
class FinanceController extends Controller {
	
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
		
		if($this->user_role=='admin')
		{
			return "Not for admin";
		}
		elseif($this->user_role=='user')
		{
			$data['user_amount_received']=DB::table('amount_received')->where('data_entered_by','=',$this->user_id)->where('user_type','=','user')->orderby('created_at','desc')->get();
			
			$data['user_role']=$this->user_role;
			$data['user_id']=$this->user_id;
			return view('finance.userAmountReceivedForm',$data);
		}


		
	}

	public function storeUserAmountReceived()
	{
			// data to be stored in database
			$amount_received_data['remark']=$_POST['remark'];
			$amount_received_data['amount']=$_POST['amount_received'];
			$amount_received_data['amount_received_on']=$_POST['amount_received_on_date'];
			$amount_received_data['data_entered_by']=$this->user_id;
			$amount_received_data['user_type']=$this->user_role;
			$amount_received_data['created_at']=\Carbon\Carbon::now()->toDateTimeString();
 	

 		// store details in files table
			$insertGetId=DB::table('amount_received')->insertGetId($amount_received_data);

			
			return redirect('userAmountReceived');
	}

	public function deleteAmountReceived($transaction_id=null,$return_to)
	{
	
	// this code line below will enable to get deelete request from user and
	// user can delete only amount that he has entered aleready

		// $is_deleted=DB::table('amount_received')->where('id','=',$transaction_id)->where('data_entered_by','=',$this->user_id)->delete();


	// this code line below will enable Admin to delete the amount
	

		$is_deleted=DB::table('amount_received')->where('id','=',$transaction_id)->delete();



		if($is_deleted==1)
		{
			$message=array();
			$message['type']="success";
			$message['heading']="Success";
			$message['body']='Amount deleted sucessfully';
		 	\Session::flash('flash_message',$message);
		}
		else
		{
			$message=array();
		 	$message['type']="error";
		 	$message['heading']="Failed";
			$message['body']='Amount can not be deleted.Report it to Admin';
		 	\Session::flash('flash_message',$message);
		}


		return redirect(base64_decode($return_to));
	}


// UCUpload functionality

		public function UCUploadForm()
	{
	

	//if user is admin he can upload to online server but normal user can't
		
		if($this->user_role=='admin')
		{
			return "Not for admin";
		}
		elseif($this->user_role=='user')
		{
			$data['UC_uploaded']=DB::table('uc_uploads')->where('data_entered_by','=',$this->user_id)->where('user_type','=','user')->orderby('created_at','desc')->get();
			
			$data['user_role']=$this->user_role;
			$data['user_id']=$this->user_id;
			return view('finance.UCForm',$data);
		}


		
	}
	public function storeUC()
	{

		print_r($_POST);

		// data to be stored in database
	
			$uc_data['amount']=$_POST['amount_received'];
			$uc_data['submit_date']=$_POST['amount_submitted_on_date'];
			$uc_data['from_date']=$_POST['from_date'];
			$uc_data['to_date']=$_POST['to_date'];
			$uc_data['data_entered_by']=$this->user_id;
			$uc_data['user_type']=$this->user_role;
			$uc_data['created_at']=\Carbon\Carbon::now()->toDateTimeString();
 	

 		// store details in files table
			$insertGetId=DB::table('uc_uploads')->insertGetId($uc_data);

			if($insertGetId>0)
			{
				$message=array();
				$message['type']="success";
				$message['heading']="Success";
				$message['body']='UC saved sucessfully';
			 	\Session::flash('flash_message',$message);
			}
			else
			{
				$message=array();
			 	$message['type']="error";
			 	$message['heading']="Failed";
				$message['body']='UC can not be saved.Report it to Admin';
			 	\Session::flash('flash_message',$message);
			}


			
			return redirect('UCUpload');
	}


	public function ucDelete($uc_id=null,$return_to)
	{
		
	//---- This code give access to delete file only to users who uploaded it 

		// $is_deleted=DB::table('uc_uploads')->where('id','=',$uc_id)->where('uploaded_by','=',$this->user_id)->delete();


	//---- This code below gives acces to admin only to delete any file

		$is_deleted=DB::table('uc_uploads')->where('id','=',$uc_id)->delete();

		if($is_deleted==1)
		{
			$message=array();
			$message['type']="success";
			$message['heading']="Success";
			$message['body']='UC deleted sucessfully';
		 	\Session::flash('flash_message',$message);
		}
		else
		{
			$message=array();
		 	$message['type']="error";
		 	$message['heading']="Failed";
			$message['body']='UC can not be deleted.Report it to Admin';
		 	\Session::flash('flash_message',$message);
		}


		return redirect(base64_decode($return_to));
	}





// Audit report form



// Audit Report functionality here

	public function AuditReportForm()
	{
		
		if($this->user_role=='admin')
		{
			return "Not for admin";
		}
		elseif($this->user_role=='user')
		{
			$data['files']=DB::table('audit_reports')->where('uploaded_by','=',$this->user_id)->where('upload_user_type','=','user')->orderby('created_at','desc')->get();
			$data['user_role']=$this->user_role;
			$data['user_id']=$this->user_id;
			return view('finance.AuditReportUpload',$data);
		}


		
	}
	

		// store file uploaded by admin

public function storeAuditReport()
	{

		// print_r($_POST);
	$data=array();
	$is_sucessfully_stoerd_in_db=false;
	

	$file=Input::file('file');
	$FileUploadPath=public_path('uploads');

	$allowedExts = array($file->guessClientExtension());
			
	$extension = $file->guessClientExtension();

	if(!is_writable($FileUploadPath))
	{
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t upload File; no write Access at '.$FileUploadPath
		);
		
		// print json_encode($response);
		return;
	}
	if(!is_writable($FileUploadPath)){
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

			$file->move($FileUploadPath,$filename);

			// data to be stored in database
			$file_data['description']=$_POST['description'];
			$file_data['name']=$filename;
			$file_data['from_date']=$_POST['from_date'];
			$file_data['to_date']=$_POST['to_date'];

			$file_data['uploaded_by']=$this->user_id;
			$file_data['upload_user_type']=$this->user_role;
			$file_data['created_at']=\Carbon\Carbon::now()->toDateTimeString();
 	

 		
			$insertGetId=DB::table('audit_reports')->insertGetId($file_data);
			
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
			$message['body']="Audit Report ".$file->getClientOriginalName()." saved sucessfully";
		 	\Session::flash('flash_message',$message);

		  return redirect('AuditReportUpload');
		}
	}
	else
	{
			$message=array();
		 	$message['type']="error";
		 	$message['heading']="Failed";
			$message['body']="Audit Report ".$file->getClientOriginalName()." can not be saved.Report it to Admin";
		 	\Session::flash('flash_message',$message);
		 	 return redirect('AuditReportUpload');
	}
			

}




	public function auditReportDelete($id=null,$return_to)
	{
		
	//---- This code give access to delete file only to users who uploaded it 

		// $is_deleted=DB::table('audit_reports')->where('id','=',$id)->where('uploaded_by','=',$this->user_id)->delete();


	//---- This code below gives acces to admin only to delete any file

		$is_deleted=DB::table('audit_reports')->where('id','=',$id)->delete();

		if($is_deleted==1)
		{
			$message=array();
			$message['type']="success";
			$message['heading']="Success";
			$message['body']='Audit Report deleted sucessfully';
		 	\Session::flash('flash_message',$message);
		}
		else
		{
			$message=array();
		 	$message['type']="error";
		 	$message['heading']="Failed";
			$message['body']='Audit Report can not be deleted. Report it to Admin';
		 	\Session::flash('flash_message',$message);
		}


		return redirect(base64_decode($return_to));
	}






	
}


?>