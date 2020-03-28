<?php

namespace App\Http\Controllers;

use DB;

use File;

use Config;

use Entrust;

use App\Classes\Helper;

use Illuminate\Http\Request;

use App\Http\Requests\ConfigurationTimeRequest;



use App\LeaveType;

use App\LeaveMaster;

use App\TimeMaster;

use App\SalaryType;

use App\DocumentType;
use App\Asset;//by Dev@4489
use App\Alias;//by Dev@4489
use App\ExpenseHead;

use App\Role;

use Validator;



Class ConfigController extends Controller{

	public function time_details(Request $request ){
		$input=$request->all();
		//dd($input);
		$financial_year= 	$request->input('financial_year');
		$ot_emp_hour=		$request->input('ot_emp_hour');
		$non_ot_emp_hour=	$request->input('non_ot_emp_hour');	
		$commit_ot_hou=		$request->input('commit_ot_hou');
		$week_holiday=		$request->input('week_holiday');
		$staf_cal_days=		$request->input('staf_cal_days');
		$non_staf_cal_days=	$request->input('non_staf_cal_days'); 
		$normal_ot_rate=	$request->input('normal_ot_rate');
		$holiday_ot_rate=	$request->input('holiday_ot_rate');
		$special_ot_rate=	$request->input('special_ot_rate');
		$holiday=			$request->input('holiday');
		//dd($holiday);
		if($holiday == 1)
		{
			$weekend=$request->input('holiday_one');
			//dd($weekend);
		}
		if($holiday == 2)
		{
			$weekend1=$request->input('holiday_one');
			$weekend2=$request->input('holiday_two');
			$weekend=$weekend1.','.$weekend2;
			//dd($weekend);
		}
		$is_null = 0;
			$is_null=TimeMaster::where('financial_year',$financial_year)->count();	

			if($is_null == 0)
			{
				TimeMaster::create([
							'financial_year'=>$financial_year,
							'ot_emp_hour'=>$ot_emp_hour,
							'non_ot_emp_hour'=>$non_ot_emp_hour,
							'commit_ot_hou'=>$commit_ot_hou,
							'week_holiday'=>$weekend,
							'staf_cal_days'=>$staf_cal_days,
							'non_staf_cal_days'=>$non_staf_cal_days, 
							'normal_ot_rate'=>$normal_ot_rate,
							'holiday_ot_rate'=>$holiday_ot_rate,
							'special_ot_rate'=>$special_ot_rate
							]);
			}
			elseif ($is_null == 1) {
				TimeMaster::where('financial_year',$financial_year)->update([
							'financial_year'=>$financial_year,
							'ot_emp_hour'=>$ot_emp_hour,
							'non_ot_emp_hour'=>$non_ot_emp_hour,
							'commit_ot_hou'=>$commit_ot_hou,
							'week_holiday'=>$weekend,
							'staf_cal_days'=>$staf_cal_days,
							'non_staf_cal_days'=>$non_staf_cal_days, 
							'normal_ot_rate'=>$normal_ot_rate,
							'holiday_ot_rate'=>$holiday_ot_rate,
							'special_ot_rate'=>$special_ot_rate
							]);
				}
			return redirect()->back()->withSuccess('Data have successfully saved !!');	
	}
	public function leave_details(Request $request ){
		$input=$request->all();
			
		////******** Annual Leave  ********/////
		$entitled_for_annual =  	$request->input('entitled_for_annual');
		$completed_days=			$request->input('completed_days');
		$chk_is_accr_to_service=	$request->input('chk_is_accr_to_service');
		$chk_bal_accr=				$request->input('chk_bal_accr');
		$chk_min_annual_leav=		$request->input('chk_min_annual_leav');
		$min_annual_leav=			$request->input('min_annual_leav');
		$chk_ex_hou_allow=			$request->input('chk_ex_hou_allow');
		$chk_auto_anual_leav_sal=	$request->input('chk_auto_anual_leav_sal');
		$adv_annul_leav=			$request->input('adv_annul_leav');
		$l_complete_1_year=			$request->input('l_complete_1_year');
		$l_incomplete_1_year=		$request->input('l_incomplete_1_year');		
			$is_null = 0;
			$is_null=LeaveMaster::where('leave_name',"Annual Leave")->count();			
			if($is_null == 0)
			{
					
					LeaveMaster::create([
					'leave_name'=>"Annual Leave",
					'entitled_for_annual' => $entitled_for_annual[0],
					'completed_days'=>$completed_days,
					'chk_is_accr_to_service'=>$chk_is_accr_to_service[0],
					'chk_bal_accr'=>$chk_bal_accr[0],
					'chk_min_annual_leav'=>$chk_min_annual_leav[0],
					'min_annual_leav'=>$min_annual_leav,
					'chk_ex_hou_allow'=>$chk_ex_hou_allow[0],
					'chk_auto_anual_leav_sal'=>$chk_auto_anual_leav_sal[0],
					'adv_annul_leav'=>$adv_annul_leav,
					'l_complete_1_year'=>$l_complete_1_year,
					'l_incomplete_1_year'=>$l_incomplete_1_year
					]);	
			}
			elseif ($is_null == 1) {
					LeaveMaster::where('leave_name',"Annual Leave")->update([
					'leave_name'=>"Annual Leave",
					'entitled_for_annual' => $entitled_for_annual[0],
					'completed_days'=>$completed_days,
					'chk_is_accr_to_service'=>$chk_is_accr_to_service[0],
					'chk_bal_accr'=>$chk_bal_accr[0],
					'chk_min_annual_leav'=>$chk_min_annual_leav[0],
					'min_annual_leav'=>$min_annual_leav,
					'chk_ex_hou_allow'=>$chk_ex_hou_allow[0],
					'chk_auto_anual_leav_sal'=>$chk_auto_anual_leav_sal[0],
					'adv_annul_leav'=>$adv_annul_leav,
					'l_complete_1_year'=>$l_complete_1_year,
					'l_incomplete_1_year'=>$l_incomplete_1_year
					]);
			}		
		///******* Leave Salary Include *****//
		$leav_sal_incl=$request->input('leav_sal_incl');
			$is_null = 0;
			$is_null=LeaveMaster::where('leave_name',"Leave Salary Include")->count();
			if($is_null == 0)
			{
					
					LeaveMaster::create([
					'leave_name'=>"Leave Salary Include",
					'leav_sal_incl'=>$leav_sal_incl
					]);	
			}
			elseif ($is_null == 1) {
					LeaveMaster::where('leave_name',"Leave Salary Include")->update([
					'leave_name'=>"Leave Salary Include",
					'leav_sal_incl'=>$leav_sal_incl
					]);
			}
		///******* Leave Encashment *****//
		$leav_encash=$request->input('leav_encash');
			$is_null = 0;
			$is_null=LeaveMaster::where('leave_name',"Leave Encashment")->count();
			if($is_null == 0)
			{
					
					LeaveMaster::create([
					'leave_name'=>"Leave Encashment",
					'leav_encash'=>$leav_encash
					]);	
			}
			elseif ($is_null == 1) {
					LeaveMaster::where('leave_name',"Leave Encashment")->update([
					'leave_name'=>"Leave Encashment",
					'leav_encash'=>$leav_encash
					]);
			}
		///*******    Sick  Leave  *****//
		$chk_sick_leav=$request->input('chk_sick_leav');
		$sick_ful_pay_days=$request->input('sick_ful_pay_days');
		$sick_haf_pay_days=$request->input('sick_haf_pay_days');
			$is_null = 0;
			$is_null=LeaveMaster::where('leave_name',"Sick Leave")->count();
			if($is_null == 0)
			{
					
					LeaveMaster::create([
					'leave_name'=>"Sick Leave",
					'chk_sick_leav'=>$chk_sick_leav[0],
					'sick_ful_pay_days'=>$sick_ful_pay_days,
					'sick_haf_pay_days'=>$sick_haf_pay_days
					]);	
			}
			elseif ($is_null == 1) {
					LeaveMaster::where('leave_name',"Sick Leave")->update([
					'leave_name'=>"Sick Leave",
					'chk_sick_leav'=>$chk_sick_leav[0],
					'sick_ful_pay_days'=>$sick_ful_pay_days,
					'sick_haf_pay_days'=>$sick_haf_pay_days
					]);
			}
		///*******  Hajj  Leave  *****//
		$haj_leav=$request->input('haj_leav');
		$haj_how_time=$request->input('haj_how_time');
			$is_null = 0;
			$is_null=LeaveMaster::where('leave_name',"Hajj Leave")->count();
			if($is_null == 0)
			{
					
					LeaveMaster::create([
					'leave_name'=>"Hajj Leave",
					'haj_leav'=>$haj_leav,
					'haj_how_time'=>$haj_how_time
					]);	
			}
			elseif ($is_null == 1) {
					LeaveMaster::where('leave_name',"Hajj Leave")->update([
					'leave_name'=>"Hajj Leave",
					'haj_leav'=>$haj_leav,
					'haj_how_time'=>$haj_how_time
					]);
			}
		///*******   Maternity Leave  *****//
		$mater_leav_bef_one_year=$request->input('mater_leav_bef_one_year');
		$mater_pay_bef_one_year=$request->input('mater_pay_bef_one_year');
		$mater_leav_after_one_year=$request->input('mater_leav_after_one_year');
		$mater_pay_aft_one=$request->input('mater_pay_aft_one');
		$chk_mater_and_annaul=$request->input('chk_mater_and_annaul');
		$mater_and_annaul_not_exce=$request->input('mater_and_annaul_not_exce');
			$is_null = 0;
			$is_null=LeaveMaster::where('leave_name',"Maternity Leave")->count();
			if($is_null == 0)
			{
					
					LeaveMaster::create([
					'leave_name'=>"Maternity Leave",
					'mater_leav_bef_one_year'=>$mater_leav_bef_one_year,
					'mater_pay_bef_one_year'=>$mater_pay_bef_one_year,
					'mater_leav_after_one_year'=>$mater_leav_after_one_year,
					'mater_pay_aft_one'=>$mater_pay_aft_one,
					'chk_mater_and_annaul'=>$chk_mater_and_annaul[0],
					'mater_and_annaul_not_exce'=>$mater_and_annaul_not_exce
					]);	
			}
			elseif ($is_null == 1) {
					LeaveMaster::where('leave_name',"Maternity Leave")->update([
					'leave_name'=>"Maternity Leave",
					'mater_leav_bef_one_year'=>$mater_leav_bef_one_year,
					'mater_pay_bef_one_year'=>$mater_pay_bef_one_year,
					'mater_leav_after_one_year'=>$mater_leav_after_one_year,
					'mater_pay_aft_one'=>$mater_pay_aft_one,
					'chk_mater_and_annaul'=>$chk_mater_and_annaul[0],
					'mater_and_annaul_not_exce'=>$mater_and_annaul_not_exce
					]);
			}
		///*******   Accidental Leave  *****//
		$acci_full_pay=$request->input('acci_full_pay');
		$acci_half_pay=$request->input('acci_half_pay');
			$is_null = 0;
			$is_null=LeaveMaster::where('leave_name',"Accidental Leave")->count();
			if($is_null == 0)
			{
					
					LeaveMaster::create([
					'leave_name'=>"Accidental Leave",
					'acci_full_pay'=>$acci_full_pay,
					'acci_half_pay'=>$acci_half_pay
					]);	
			}
			elseif ($is_null == 1) {
					LeaveMaster::where('leave_name',"Accidental Leave")->update([
					'leave_name'=>"Hajj Leave",
					'acci_full_pay'=>$acci_full_pay,
					'acci_half_pay'=>$acci_half_pay
					]);
			}
		///******* Personal   Leave *****//
		$person_max_leave=$request->input('person_max_leave');
		$person_conti_leave=$request->input('person_conti_leave');
		$is_null = 0;
			$is_null=LeaveMaster::where('leave_name',"Accidental Leave")->count();
			if($is_null == 0)
			{
					
					LeaveMaster::create([
					'leave_name'=>"Accidental Leave",
					'person_max_leave'=>$person_max_leave,
					'person_conti_leave'=>$person_conti_leave
					]);	
			}
			elseif ($is_null == 1) {
					LeaveMaster::where('leave_name',"Accidental Leave")->update([
					'leave_name'=>"Accidental Leave",
					'person_max_leave'=>$person_max_leave,
					'person_conti_leave'=>$person_conti_leave
					]);
			}
		return redirect()->back()->withSuccess('Data have successfully saved !!');

	}
	public function index(){

        

       
		$alias_list = Alias::all();//by Dev@4489
       
		$config = Helper::getConfiguration();
		$mail_config = Helper::getMail();

		$sms_config = Helper::getSMS();

		$services = Helper::getServices();

        $assets = ['datetimepicker','mail_config'];



        $roles = DB::table('roles')->get();

        $permissions = DB::table('permissions')->orderBy('category')->get();

        

        $permission_role = DB::table('permission_role')

        	->select(DB::raw('CONCAT(role_id,"-",permission_id) AS detail,id'))

        	->lists('detail','id');

        $data = [

        	

        	
			'alias_list' => $alias_list,//by Dev@4489

        	
        	'config' => $config,

        	'mail_config' => $mail_config,

        	'sms_config' => $sms_config,

        	'services' => $services,

        	'roles' => $roles,

        	'permissions' => $permissions,

        	'permission_role' => $permission_role,

        	'assets' => $assets,

        	'category' => null

        	];



		return view('configuration.index',$data);

	}



	public function mailStore(Request $request){

		if(!Helper::getMode())

			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		

		$validation = Validator::make($request->all(),[

				'from_address' => 'required|email',

				'from_name' => 'required'

				]);



		if($validation->fails()){

			return redirect()->back()->withInput()->withErrors($validation->messages());

		}

		

		$mail_config = Helper::getMail();

		$services = Helper::getServices();



		$config_type = $request->input('config_type');



		$mail_config['driver'] = $request->input('driver');

		$mail_config['from']['address'] = $request->input('from_address');

		$mail_config['from']['name'] = $request->input('from_name');



		if($request->input('driver') == 'smtp'){	

			$mail_config['host'] = $request->input('host');

			$mail_config['port'] = $request->input('port');

			$mail_config['username'] = $request->input('username');

			$mail_config['password'] = $request->input('password');

		}

		elseif($request->input('driver') == 'mandrill'){

			$services['mandrill']['secret'] = $request->input('mandrill_secret');

			$filename = base_path().'/config/services.php';

			File::put($filename,var_export($services, true));

			File::prepend($filename,'<?php return ');

			File::append($filename, ';');

		}

		elseif($request->input('driver') == 'mailgun'){

			$services['mailgun']['secret'] = $request->input('mailgun_secret');

			$services['mailgun']['domain'] = $request->input('mailgun_domain');

			$filename = base_path().'/config/services.php';

			File::put($filename,var_export($services, true));

			File::prepend($filename,'<?php return ');

			File::append($filename, ';');

		}

		$mail_config['encryption'] = 'tls';

		$mail_config['sendmail'] = '/usr/sbin/sendmail -bs';

		$mail_config['pretend'] = false;



		$filename = base_path().'/config/mail.php';

		File::put($filename,var_export($mail_config, true));

		File::prepend($filename,'<?php return ');

		File::append($filename, ';');



		return redirect('/configuration#'.$config_type)->withSuccess(config('constants.SAVED'));			



	}



	public function smsStore(Request $request){

		if(!Helper::getMode())

			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		

		$sms_config = Helper::getSMS();



		$config_type = $request->input('config_type');



		$sms_config['sid'] = $request->input('sid');

		$sms_config['token'] = $request->input('token');

		$sms_config['from'] = $request->input('from');



		$filename = base_path().'/config/twilio.php';

		File::put($filename,var_export($sms_config, true));

		File::prepend($filename,'<?php return ');

		File::append($filename, ';');



		return redirect('/configuration#'.$config_type)->withSuccess(config('constants.SAVED'));			



	}



	public function jobStore(Request $request){

		if(!Helper::getMode())

			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		

		$config = Helper::getConfiguration();

		$config['job_application_staff'] = $request->input('job_application_staff');

		$config['application_format'] = $request->input('application_format');



		$filename = base_path().'/config/config.php';

		File::put($filename,var_export($config, true));

		File::prepend($filename,'<?php return ');

		File::append($filename, ';');



		return redirect('/configuration#'.$request->input('config_type'))->withSuccess(config('constants.SAVED'));			

	}



	public function savePermission(Request $request){



		if(!Helper::getMode())

			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		

		$input = $request->all();

		$permissions = array_get($input, 'permission');



		if(!Entrust::hasRole('admin'))

			return redirect('/dashboard')->withErrors(config('constants.NA'));



		DB::table('permission_role')->truncate();



		if($permissions != '')

		foreach($permissions as $r_key => $permission){

			foreach($permission as $p_key => $per){

				$values[] = $p_key;

			}

			$role = Role::find($r_key);

			if(count($values))

			$role->attachPermissions($values);

			unset($values);

		}



		return redirect('/configuration#permission')->withSuccess(config('constants.UPDATED'));

	}



	public function officeTime(ConfigurationTimeRequest $request){



		if(!Helper::getMode())

			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



		$in_time = strtotime(date('Y-m-d')." ".$request->input('in_time'));

		$out_time = strtotime(date('Y-m-d')." ".$request->input('out_time'));

		$config = Helper::getConfiguration();

		$config['in_time'] = date('H:i',$in_time);

		$config['out_time'] = date('H:i',$out_time);



		$filename = base_path().'/config/config.php';

		File::put($filename,var_export($config, true));

		File::prepend($filename,'<?php return ');

		File::append($filename, ';');



		return redirect('/configuration#'.$request->input('config_type'))->withSuccess(config('constants.SAVED'));			

	}



	public function store(Request $request){

		if(!Helper::getMode())

			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		

		$config = Helper::getConfiguration();



		$config_type = $request->input('config_type');

		$input = $request->all();

		foreach($input as $key => $value){

			if($key != '_token' && $key != 'config_type')

			$config[$key] = $value;

		}



		$filename = base_path().'/config/config.php';

		File::put($filename,var_export($config, true));

		File::prepend($filename,'<?php return ');

		File::append($filename, ';');



		return redirect('/configuration#'.$config_type)->withSuccess(config('constants.SAVED'));			

	}

}

?>