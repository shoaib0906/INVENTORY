<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\ProductinRequest;
use DB;
use Entrust;
use App\Leave;
use App\Product_IN;
use App\Manage_training;
use App\TrainingType;
use App\User;
use Config;
use Auth;
use Session;
use Activity;
use App\Classes\Helper;

Class CustomerController extends Controller{

	protected $form = 'leave-form';

	public function index()
	{
		$customer_info=DB::table('customer_info')
						->where('branch_id','=',Auth::user()->branch_id)
						->get();
		return view('customer.index')->with('customer_info',$customer_info);
	}
	public function post_customer(Request $request)
	{
		$branch_id = Auth::user()->branch_id;
		$this->validate($request, [
        'name' => 'required',
        'address' => 'required'
    	]);
		$name = $request->input('name');
		$address = $request->input('address');
		DB::table('customer_info')->insert(['name'=>$name,
											'address'=>$address,
											'branch_id'=>$branch_id]);
		return redirect()->back()->withSuccess('Customer added successfully.');
	}
	
	public function update_customer(Request $request)
	{
		$this->validate($request,['name'=>'required','address'=>'required']);
		//dd($request->all());
		$name = $request->input('name');
		$address = $request->input('address');
		$id = $request->input('id');
		
		DB::table('customer_info')->where('id','=',$id)->update(['name'=>$name,
											'address'=>$address]);
		return redirect()->back()->withSuccess('Customer information update successfully.');
	}
	
		
}
?>