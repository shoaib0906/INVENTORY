<?php
namespace App\Http\Controllers;
use DB;
use Entrust;
use Config;
use Illuminate\Http\Request;
use Validator;
use App\Classes\Helper;

Class SMSController extends Controller{

	public function index($type = 'designation'){

		if(!Entrust::can('manage_sms'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if($type == 'designation')
        $receivers = DB::table('designations')
            ->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT( department_name) AS full_designation,designations.id AS designation_id'))
            ->lists('full_designation','designation_id');
       	else
        $receivers = DB::table('users')
        	->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $type_detail = ($type == 'designation') ? 'Property' : 'Individual Staff' ;
dd($type_detail);
		$data = [
			'type' => $type,
			'receivers' => $receivers,
			'type_detail' => $type_detail
			];
		return view('sms.index',$data);
	}

	public function sendEmployeeSMS(Request $request, $id){
		$user = \App\User::find($id);
		dd($user);
		$validation = Validator::make($request->all(),[
				'sms' => 'required'
				]);

		if($validation->fails()){
			return redirect()->back()->withInput()->withErrors($validation->messages());
		}
		dd($user);
      	$response = Helper::sendSMS($user->Profile->contact_number,$request->input('sms'));

      	if($response == 1)
      		return redirect()->back()->withSuccess('SMS Sent successfully. ');
      	else
      		return redirect()->back()->withErrors($response);
	}

	public function store()
	{
	//dd('asfjhu');
		$response = Helper::sendSMS("214-727-3799","Test SMS from Tenants Rent");

      	if($response == 1)
      		return redirect()->back()->withSuccess('SMS Sent successfully. ');
      	else
      		return redirect()->back()->withErrors($response);
	}
}
?>