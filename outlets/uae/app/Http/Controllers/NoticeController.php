<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\NoticeRequest;
use Entrust;
use Config;
use App\Notice;
use App\Classes\Helper;
use Auth;
use Activity;

Class NoticeController extends Controller{

	protected $form = 'notice-form';

	public function index(Notice $notice){

		if(!Entrust::can('manage_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(Entrust::can('manage_all_notice'))
			$notices = $notice->get();
		else
			$notices = $notice->where('username','=',Auth::user()->username)->get();
        $token = csrf_token();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Title'),
        		trans('messages.Notice For'),
        		trans('messages.From Date'),
        		trans('messages.To Date')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($notices as $notice){

        	$designation_name = "<ol class='nl'>";
        	foreach($notice->Designation as $designation){
        		$department = $designation->Department;
			    $designation_name .= "<li>$designation->designation ($department->department_name)</li>";
			}
        	$designation_name .= "</ol>";

			$cols = array(
				'<a href="notice/'.$notice->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
				delete_form(['notice.destroy',$notice->id]),
				$notice->title,
				$designation_name,
				Helper::showDate($notice->from_date),
				Helper::showDate($notice->to_date)
				);	
			$id = $notice->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
			
        }

        Helper::writeResult($col_data);

		return view('notice.index',compact('col_heads'));
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
        $query = DB::table('designations');

        if(Entrust::can('manage_all_notice')){}
        elseif(Entrust::can('manage_subordinate_notice'))
        	$query->whereIn('designations.id',$child_designations);

        $designations = $query->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(designation, " (", department_name, ")") AS full_designation,designations.id AS designation_id'))
            ->lists('full_designation','designation_id');

		return view('notice.create',compact('designations'));
	}

	public function edit(Notice $notice){

		if(!Entrust::can('edit_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!Entrust::can('manage_all_notice') && $notice->username != Auth::user()->username)
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$selected_designation = array();

		foreach($notice->Designation as $designation){
			$selected_designation[] = $designation->id;
		}

        $designations = DB::table('designations')
            ->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(designation, " (", department_name, ")") AS full_designation,designations.id AS designation_id'))
            ->lists('full_designation','designation_id');

		$custom_field_values = Helper::getCustomFieldValues($this->form,$notice->id);
		return view('notice.edit',compact('designations','notice','selected_designation','custom_field_values'));
	}

	public function store(NoticeRequest $request, Notice $notice){

		if(!Entrust::can('create_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$data = $request->all();
	    $notice->fill($data);
		$notice->username = Auth::user()->username;
		$notice->save();
	    $notice->designation()->sync($request->input('designation_id'));
		Helper::storeCustomField($this->form,$notice->id, $data);
		$activity = 'Publish a notice';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.SAVED'));		
	}

	public function update(NoticeRequest $request, Notice $notice){

		if(!Entrust::can('edit_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!Entrust::can('manage_all_notice') && $notice->username != Auth::user()->username)
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$data = $request->all();
		$notice->fill($data);
		$notice->save();
	    $notice->designation()->sync($request->input('designation_id'));
		Helper::updateCustomField($this->form,$notice->id, $data);
		$activity = 'Edit a notice';
		Activity::log($activity);
		return redirect('/notice')->withSuccess(config('constants.SAVED'));
	}

	public function destroy(Notice $notice){
		if(!Entrust::can('delete_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!Entrust::can('manage_all_notice') && $notice->username != Auth::user()->username)
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $notice->id);
        $notice->delete();
		$activity = 'Deleted a Notice';
		Activity::log($activity);

        return redirect('/notice')->withSuccess(config('constants.DELETED'));
	}
}
?>