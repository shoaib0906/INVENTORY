<?php
namespace App\Http\Controllers;
use DB;
use App\Http\Requests\AliasRequest;
use App\Alias;
use App\Classes\Helper;
use Config;

Class AliasController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(Alias $alias){
		return view('alias.edit',compact('alias'));
	}

	public function store(AliasRequest $request, Alias $alias){	

		$alias->create($request->all());

		return redirect('/configuration#alias')->withSuccess(config('constants.ADDED'));				
	}

	public function update(AliasRequest $request, Alias $alias){

		$alias->fill($request->all())->save();

		return redirect('/configuration#alias')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Alias $alias){
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		$empalias = DB::select( DB::raw("SELECT alias_id FROM users WHERE alias_id = ".(int)$alias->id));
		if($empalias) return redirect('/configuration#alias')->withErrors("Alias assigned to employee.");

        $alias->delete();
        return redirect('/configuration#alias')->withSuccess(config('constants.DELETED'));
	}
}
?>