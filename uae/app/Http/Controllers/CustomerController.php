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
		$customer_info=DB::table('customer_info')->orderBy('name')->get();
	//	dd($customer_info);
		return view('customer.index')->with('customer_info',$customer_info);
	}
	public function post_customer(Request $request)
	{
		$this->validate($request, [
        'name' => 'required',
        'address' => 'required',
    	]);
		$name = $request->input('name');
		$address = $request->input('address');
		DB::table('customer_info')->insert(['name'=>$name,
											'address'=>$address]);
		return redirect()->back()->withSuccess('Customer added successfully.');
	}
	public function delete_product_in($id)
	{
		$delete_product = DB::table('product_in')->where('id','=',$id)->get();
		$product_code = $delete_product[0]->product_code;
		$category_in = $delete_product[0]->category_in;
		$quantity = $delete_product[0]->quantity;
		DB::table('product_master')->where('code','=',$product_code)
					->where('category','=',$category_in)
					->decrement('stock',$quantity);
		
		DB::table('product_in')->where('id','=',$id)->update(['status'=>0]);
		return redirect()->back()->withSuccess('Product Deleted from lot. & stock decrease from Stock.');
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