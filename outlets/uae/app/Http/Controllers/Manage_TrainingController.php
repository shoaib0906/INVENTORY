<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\LeaveStatusRequest;
use DB;
use Entrust;
use App\Leave;
use App\LeaveType;
use App\TrainingType;
use App\User;
use Config;
use Auth;
use Activity;
use App\Classes\Helper;

Class Manage_TrainingController extends Controller{

	protected $form = 'training-form';

	public function store(Request $request){	
	if(Entrust::can('Employee_Training')){			
			$input=$request->all();
			DB::table('training_manage')->insert([
				'user_id'=>$request->input('user_id'),
				'training_id'=>$request->input('leave_type_id'),
				'start_date'=>$request->input('from_date'),
				'end_date'=>$request->input('to_date'),
				'duration'=>$request->input('training_duration'),
				'result'=>$request->input('training_result'),
				'description'=>$request->input('training_desc')
				]);	 
			return redirect()->back()->withSuccess('New Training successfully Added for Specific Employee');		
		}
	}
	
		
}
?>