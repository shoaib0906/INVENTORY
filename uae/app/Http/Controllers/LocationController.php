<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;
use Entrust;
use App\Classes\Helper;
use App\Location;
use Activity;
use Config;
use DB;

Class LocationController extends Controller{

	protected $form = 'location-form';

	public function index(Location $location){

		if(!Entrust::can('manage_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $locations = $location->get();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Location Name'),
        		trans('messages.Description')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($locations as $location){

			$linkToEdit = "";
			$cols = array(
				'<div class="btn-group btn-group-xs">'.
				'<a href="/location/'.$location->id.'/edit" class="btn btn-xs btn-default" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
				delete_form(['location.destroy',$location->id]).
				'</div>',
				$location->location_name,
				$location->location_description
				);
			$id = $location->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads];

		return view('location.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		return view('location.create');
	}

	public function edit(Location $location){

		if(!Entrust::can('edit_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$location->id);
		return view('location.edit',compact('location','custom_field_values'));
	}

	public function store(LocationRequest $request, Location $location){	

		if(!Entrust::can('create_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$location->fill($data)->save();

		Helper::storeCustomField($this->form,$location->id, $data);

		$activity = 'New location "'.$request->input('location_name').'" added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(LocationRequest $request, Location $location){

		if(!Entrust::can('edit_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$location->fill($data)->save();

		Helper::updateCustomField($this->form,$location->id, $data);

		$activity = 'Location "'.$request->input('location_name').'" updated';
		Activity::log($activity);
		
		return redirect('/location')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Location $location){
		if(!Entrust::can('delete_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		$emploc = DB::select( DB::raw("SELECT location_id FROM users WHERE location_id = ".(int)$location->id));
		if($emploc) return redirect('/location')->withErrors("Location assigned to employee.");
		Helper::deleteCustomField($this->form, $location->id);
        
        $location->delete();

		$activity = 'Deleted a Location';
		Activity::log($activity);

        return redirect('/location')->withSuccess(config('constants.DELETED'));
	}
}
?>