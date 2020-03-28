<?php
namespace App\Http\Controllers;
use App\User;
use App\Dependent;
use Config;
use Entrust;
use Activity;
use File;
use App\Classes\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\DependentRequest;

Class DependentController extends Controller{

	public function store(DependentRequest $request, Dependent $dependent){

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$id = $request->input('user_id');
        $employee = User::find($id);

        if(!$employee)
            return redirect('/employee')->withErrors(config('constants.INVALID_LINK'));

		$filename = uniqid();
		$data = $request->all();
        if($request->input('expiry_date') == '')
            $data['expiry_date'] = null;

     	if ($request->hasFile('file')) {
	 		$extension = $request->file('file')->getClientOriginalExtension();
	 		$file = $request->file('file')->move('uploads/dependent/', $id."-".$filename.".".$extension);
	 		$data['document'] = $id."-".$filename.".".$extension;
		 }
		$dependent->fill($data);
		$dpid = $request->input('dep_id');
		if($dpid) {
			unset($data['_method']);
			unset($data['_token']);
			unset($data['dep_id']);
			//$dependent->id=$dpid;
			$dependent->where('id', $dpid)
			  ->update($data);
	    } else {
			//$dependent->save();
        	$employee->dependent()->save($dependent);
		}
		if($dpid) return redirect('/employee/'.$id."#dependent")->withSuccess(config('constants.UPDATED'));
        return redirect('/employee/'.$id."#dependent")->withSuccess(config('constants.ADDED'));
	}
	public function edit(Dependent $dependent){
		$id = $dependent->user_id;
        $employee = User::find($id);
		return view('dependent.edit',compact('dependent','employee'));
	}
	public function add(Dependent $dependent,$eid){
        $employee = User::find($eid);
		return view('dependent.edit',compact('dependent','employee'));
	}

	public function destroy(Dependent $dependent){
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		if(!Entrust::hasRole('admin'))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));
		
		$id = $dependent->User->id;
		File::delete('uploads/dependent/'.$dependent->document);
		$activity = 'Dependent deleted';
		Activity::log($activity);
		$dependent->delete();

		return redirect('/employee/'.$id."#dependent")->withSuccess(config('constants.DELETED'));
	}
}
?>