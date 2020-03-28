<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\DesignationRequest;
use Entrust;
use App\Classes\Helper;
use App\Designation;
use App\Department;
use App\User;
use Auth;
use Activity;
use Config;

Class DesignationController extends Controller{

	protected $form = 'designation-form';

	public function index(Designation $designation){

		if(!Entrust::can('manage_designation'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);

		if(Entrust::hasRole('admin'))
			$designations = $designation->get();
		else
			$designations = $designation->whereIn('id',$child_designations)->get();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Designation'),
        		trans('messages.Department Name'),
        		trans('messages.Top Designation'));

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

		foreach ($designations as $designation){
			$department = $designation->Department;
			$cols = array(
					'<div class="btn-group btn-group-xs">'.
					'<a href="/designation/'.$designation->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
					delete_form(['designation.destroy',$designation->id]).
					'</div>',
					$designation->designation,
					$department->department_name,
					($designation->top_designation_id) ? $designation->Parent->designation.' ('.$designation->Parent->Department->department_name.')' : ''
					);	
			$id = $designation->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
		}

        Helper::writeResult($col_data);

        $user = User::first();

        $data = ['col_heads' => $col_heads];

		return view('designation.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_designation'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$departments = Department::lists('department_name','id')->all();

		$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
		array_push($child_designations, Auth::user()->designation_id);

		if(Entrust::hasRole('admin'))
			$top_designations = Designation::lists('designation','id')->all();
		else
			$top_designations = Designation::whereIn('id',$child_designations)->lists('designation','id')->all();

		return view('designation.create',compact('departments','top_designations'));
	}

	public function edit(Designation $designation){

		if(!Entrust::can('edit_designation'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$departments = Department::lists('department_name','id')->all();

		$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
		array_push($child_designations, Auth::user()->designation_id);

		if(Entrust::hasRole('admin'))
			$top_designations = array_diff(Designation::where('id','!=',$designation->id)->lists('designation','id')->all(), Helper::childDesignation($designation->id));
		else
			$top_designations = array_diff(Designation::where('id','!=',$designation->id)->whereIn('id',$child_designations)->lists('designation','id')->all(), Helper::childDesignation($designation->id));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$designation->id);
		$data = [
					'designation' => $designation,
					'departments' => $departments,
					'top_designations' => $top_designations,
					'custom_field_values' => $custom_field_values
				];

		return view('designation.edit',$data);
	}

	public function store(DesignationRequest $request, Designation $designation){	

		if(!Entrust::can('create_designation'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$designation->fill($data)->save();

		Helper::storeCustomField($this->form,$designation->id, $data);

		$activity = 'New designation "'.$request->input('designation').'" added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(DesignationRequest $request, Designation $designation){
		if(!Entrust::can('edit_designation'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $data = $request->all();
		$top_designations = array_diff(Designation::where('id','!=',$designation->id)->lists('designation','id')->all(), Helper::childDesignation($designation->id));

		if(!array_key_exists($data['top_designation_id'], $top_designations) && $data['top_designation_id'] != '')
			return redirect()->back()->withErrors('Top designation cannot be a child designation.');

		if($data['top_designation_id'] == '')
			$data['top_designation_id'] = null;

		$designation->fill($data)->save();

		Helper::updateCustomField($this->form,$designation->id, $data);

		$activity = 'Designation "'.$request->input('designation').'" updated';
		Activity::log($activity);
		return redirect('/designation')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Designation $designation){
		if(!Entrust::can('delete_designation'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $designation->id);
		
		$activity = 'Designation "'.$designation->designation.'" deleted';
		Activity::log($activity);
		
        $designation->delete();
        return redirect('/designation')->withSuccess(config('constants.DELETED'));
	}
}
?>