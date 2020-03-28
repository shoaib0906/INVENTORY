<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use Entrust;
use App\Classes\Helper;
use App\Department;
use Activity;
use Config;
use DB;

Class DepartmentController extends Controller{

	protected $form = 'department-form';

	public function index(Department $department){

		if(!Entrust::can('create_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $departments = $department->where('status',1)->get();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Department Name'),
        		trans('messages.street'),
        		trans('messages.city'),
        		trans('messages.state'),
        		trans('messages.ZIP')
        		
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($departments as $department){
        	$des = $department->Designation;

        	$designation_name = "<ol>";
        	foreach($des as $designation)
        		$designation_name .= "<li>$designation->designation</li>";
        	$designation_name .= "</ol>";

			$linkToEdit = "";
			$cols = array(
				'<div class="btn-group btn-group-xs">'.
				'<a href="department/'.$department->id.'/edit" class="btn btn-xs btn-default" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
				delete_form(['department.destroy',$department->id]).
				'</div>',
				$department->department_name,
				$department->street,
				$department->city,
				$department->state,
				$department->ZIP
				);
			$id = $department->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads];

		return view('department.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		return view('department.create');
	}

	public function edit(Department $department){

		if(!Entrust::can('edit_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$department->id);
		return view('department.edit',compact('department','custom_field_values'));
	}

	public function store(DepartmentRequest $request, Department $department){	

		if(!Entrust::can('create_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$department->fill($data)->save();

		Helper::storeCustomField($this->form,$department->id, $data);

		$activity = 'New department "'.$request->input('department_name').'" added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(DepartmentRequest $request, Department $department){

		if(!Entrust::can('edit_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$department->fill($data)->save();

		Helper::updateCustomField($this->form,$department->id, $data);

		$activity = 'Department "'.$request->input('department_name').'" updated';
		Activity::log($activity);
		
		return redirect('/department')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Department $department){
		if(!Entrust::can('delete_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		//Helper::deleteCustomField($this->form, $department->id);
        
        //$department->delete();
        DB::table('departments')->where('id', $department->id)->update(['status'=>0]);
		$activity = 'Deleted a Property';
		Activity::log($activity);

        return redirect('/department')->withSuccess(config('constants.DELETED'));
	}
}
?>