<?php
namespace App\Http\Controllers;
use DB;
use App\Http\Requests\AssetRequest;
use App\Asset;
use App\Classes\Helper;
use Config;

Class AssetController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(Asset $asset){
		return view('asset.edit',compact('asset'));
	}

	public function store(AssetRequest $request, Asset $asset){	

		$asset->create($request->all());

		return redirect('/configuration#asset')->withSuccess(config('constants.ADDED'));				
	}

	public function update(AssetRequest $request, Asset $asset){

		$asset->fill($request->all())->save();

		return redirect('/configuration#asset')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Asset $asset){
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		$empasset = DB::select( DB::raw("SELECT status FROM  employeeasset WHERE asset_id = ".(int)$asset->id));
		if($empasset) return redirect('/configuration#asset')->withErrors("Asset assigned to employee.");
        $asset->delete();
        return redirect('/configuration#asset')->withSuccess(config('constants.DELETED'));
	}
}
?>