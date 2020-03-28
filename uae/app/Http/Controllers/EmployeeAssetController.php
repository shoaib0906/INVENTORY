<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeAssetRequest;
use DB;
use Entrust;
use App\Classes\Helper;
use App\EmployeeAsset;
use App\Asset;
use Auth;
use Activity;
use Config;

Class EmployeeAssetController extends Controller{

	protected $form = 'employeeasset-form';

	public function index(EmployeeAsset $employeeasset){

		if(!Entrust::can('manage_employeeasset'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $employeeassets = EmployeeAsset::all();

        $col_data=array();
        $col_heads = array(				
        		trans('messages.Option'),
				trans('messages.Employee Code'),
				trans('messages.Employee'),
				trans('messages.Asset Code'),
				trans('messages.Asset Name'),
        		trans('messages.Issue Date'),
				trans('messages.Return Date'),
				trans('messages.Status'),
        		trans('messages.Comment'));

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($employeeassets as $employeeasset){
			$employee = $employeeasset->User;
        	$name = $employee->first_name." ".$employee->last_name;
        	$asset_type = $employeeasset->AssetType;
			$status = ($employeeasset->status) ? '<span class="label label-success">Returned</span>' : '<span class="label label-danger">With Employee</span>';			
			$emp = DB::select( DB::raw("SELECT employee_code FROM profile WHERE user_id = ".(int)$employeeasset->employee_id));
			$cols = array('<div class="btn-group btn-group-xs">'.
					'<a href="/employeeasset/'.$employeeasset->id.'/edit" class="btn btn-default btn-xs md-trigger"> <i class="fa fa-edit"></i></a> '.
					delete_form(['employeeasset.destroy',$employeeasset->id]).
					'</div>',
					($emp?$emp[0]->employee_code:''),
					$name,
					$asset_type->asset_code,
					$asset_type->asset_name,
					Helper::showDate($employeeasset->issue_date),
					(substr($employeeasset->return_date,0,4)=="0000"?'':Helper::showDate($employeeasset->return_date)),
					$status,
					$employeeasset->comments);		
			$id = $employeeasset->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);		
		
		$data = ['col_heads' => $col_heads];
		return view('employeeasset.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_employeeasset'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		//by Dev@4489		
		$asset_types = Asset::lists('asset_name','id')->all();
		
		$query = DB::table('users');

        if(!Entrust::hasRole('admin'))
        	$query->where('users.id','=',Auth::user()->id);

        $users= $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');
		////
        $data = ['users' => $users,'asset_types' => $asset_types];
		return view('employeeasset.create',$data);
	}

	public function edit(EmployeeAsset $employeeasset){

		if(!Entrust::can('edit_employeeasset'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
			
		$asset_types = Asset::lists('asset_name','id')->all();		
		$query = DB::table('users');
        if(!Entrust::hasRole('admin'))
        	$query->where('users.id','=',Auth::user()->id);
        $users= $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');
		if(substr($employeeasset->return_date,0,4)=="0000")	$employeeasset->return_date='';
		
		return view('employeeasset.edit',compact('employeeasset','users','asset_types'));
	}

	public function store(EmployeeAssetRequest $request,EmployeeAsset $employeeasset){	

		if(!Entrust::can('create_employeeasset'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$data = $request->all();
		$er='';		
		$pam1 = $data['employee_id'];
		$pam2 = $data['asset_id'];
		$pam3 = $data['issue_date'];
		if($data['issue_date'] && strtotime($data['issue_date'])>strtotime(date("Y-m-d"))) 
			$er ="Issue Date should be past";
		else {	
			$emasset_exists = DB::select( DB::raw("SELECT issue_date,return_date FROM employeeasset WHERE asset_id = $pam2 AND 
				(
					(status=1 and (issue_date<= '$pam3' AND return_date> '$pam3')) OR status=0
				)"));
			if($emasset_exists) {
				$empasset = $emasset_exists[0];
				$adt = Helper::showDate($empasset->issue_date);
				if(substr($empasset->return_date,0,4)<>"0000")	$adt .= ' to '.Helper::showDate($empasset->return_date);
				$er ="Asset already assigned on ".$adt;
			}
		}	
		if($er) {
			$asset_types = Asset::lists('asset_name','id')->all();		
			$query = DB::table('users');
			if(!Entrust::hasRole('admin'))
				$query->where('users.id','=',Auth::user()->id);
			$users= $query->join('designations','designations.id','=','users.designation_id')
				->join('departments','departments.id','=','designations.department_id')
				->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
				->lists('full_name','user_id');
			$employeeasset = new EmployeeAsset;	
			$employeeasset->employee_id=$data['employee_id'];
			$employeeasset->asset_id=$data['asset_id'];
			$employeeasset->issue_date=$data['issue_date'];
			$employeeasset->comments=$data['comments'];
			return view('employeeasset.create',compact('employeeasset','users','asset_types','er'));
		}
		
		$employeeasset = new EmployeeAsset;
		$employeeasset->employee_id = $request->input('employee_id');
		$employeeasset->asset_id = $request->input('asset_id');
		$employeeasset->issue_date = $request->input('issue_date');
		$employeeasset->comments = $request->input('comments');
		$employeeasset->save();

		$activity = 'Added new Employee Asset';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(EmployeeAssetRequest $request,EmployeeAsset $employeeasset){

		if(!Entrust::can('edit_employeeasset'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
	    $data = $request->all();
		$er='';
		if(($data['issue_date'] && strtotime($data['issue_date'])>strtotime(date("Y-m-d"))) || ($data['return_date'] && strtotime($data['return_date'])>strtotime(date("Y-m-d")))) 
			$er ="Dates should be past";
		else if($data['issue_date'] && $data['return_date'] && strtotime($data['return_date'])<strtotime($data['issue_date'])) 
			$er ="Dates invalid please check";
		else if($data['issue_date'] && $data['return_date']){
			$pam1 = $employeeasset->id; 
			$pam2 = $data['employee_id'];
			$pam3 = $data['asset_id'];
			$pam4 = $data['issue_date'];
			$pam5 = $data['return_date'];
			 $emasset_exists = DB::select( DB::raw("SELECT issue_date,return_date FROM employeeasset WHERE id <> $pam1 AND asset_id = $pam3 AND 
				(
					(status=1 AND ((issue_date<= '$pam4' AND return_date> '$pam4') OR (issue_date< '$pam5' AND return_date>= '$pam5') OR (issue_date>= '$pam4' AND issue_date<= '$pam5') OR (return_date>= '$pam4' AND return_date<= '$pam5') ) ) 
					OR 
					(status=0 AND (issue_date>= '$pam4' AND issue_date<= '$pam5'))
				)"));
			if($emasset_exists) {
				$empasset = $emasset_exists[0];
				$adt = Helper::showDate($empasset->issue_date);
				if(substr($empasset->return_date,0,4)<>"0000")	$adt .= ' to '.Helper::showDate($empasset->return_date);
				$er ="Asset already assigned on ".$adt;
			}
		} else if($data['issue_date']){
			$pam1 = $employeeasset->id;
			$pam2 = $data['employee_id'];
			$pam3 = $data['asset_id'];
			$pam4 = $data['issue_date'];
			$psql = "SELECT issue_date,return_date FROM employeeasset WHERE id <> $pam1 AND asset_id = $pam3 AND 
				(
					(status=1 AND (issue_date<= '$pam4' AND return_date> '$pam4') ) 
					OR 
					status=0
				)";
			 $emasset_exists = DB::select( DB::raw($psql));
			 //print_r($emasset_exists);exit;
			if($emasset_exists) {
				$empasset = $emasset_exists[0];
				$adt = Helper::showDate($empasset->issue_date);
				if(substr($empasset->return_date,0,4)<>"0000")	$adt .= ' to '.Helper::showDate($empasset->return_date);
				$er ="Asset already assigned on ".$adt;
			}	
		} 
		if($er) {
			$asset_types = Asset::lists('asset_name','id')->all();		
			$query = DB::table('users');
			if(!Entrust::hasRole('admin'))
				$query->where('users.id','=',Auth::user()->id);
			$users= $query->join('designations','designations.id','=','users.designation_id')
				->join('departments','departments.id','=','designations.department_id')
				->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
				->lists('full_name','user_id');
			$employeeasset->employee_id=$data['employee_id'];
			$employeeasset->asset_id=$data['asset_id'];
			$employeeasset->issue_date=$data['issue_date'];
			$employeeasset->return_date=$data['return_date'];
			$employeeasset->comments=$data['comments'];
			return view('employeeasset.edit',compact('employeeasset','users','asset_types','er'));
		}
				
		if($data['issue_date'] && $data['return_date'] && strtotime($data['return_date'])>=strtotime($data['issue_date'])) $data['status']=1; else $data['status']=0;
		$employeeasset->fill($data);
		$employeeasset->save();

		$activity = 'Updated a Employee Asset';
		Activity::log($activity);
		return redirect('/employeeasset')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(EmployeeAsset $employeeasset){
		if(!Entrust::can('delete_employeeasset'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $employeeasset->id);
        $employeeasset->delete();
        return redirect('/employeeasset')->withSuccess(config('constants.DELETED'));
	}
}
?>