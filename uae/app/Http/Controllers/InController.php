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

Class InController extends Controller{

	protected $form = 'leave-form';

	public function index(Request $request){				
			$input=$request->all();
			dd($input);		

	}
	public function manage_training(Request $request){
				if(Entrust::can('Add_Training_Name')){
				$training_title = $request->input('training_title');	
				DB::table('training_details')->insert(['training_name'=>$training_title]);
				return redirect()->back()->withSuccess('New Training successfully Added.');		
			}
	}
	public function caterory_in($caterory_in)
	{
		//if(Entrust::can('Add_Training_Name')){
		$product = DB::table('Product_master')
				->select('code')
				->where('category','=',$caterory_in)
				->where('status','=',1)
				->orderBy('order','asc')
				->get();
		//dd($product);
		return view('product_in.category_product')->with('product',$product);
	}
	/*public function post_product_in(ProductinRequest $request,Product_IN $product_in)
	{
		//dd($request->all());
		$lott_no_in=$request->input('lott_no');
		$category_in=$request->input('category_in');
		$product_code=$request->input('product_code');
		$quantity=$request->input('quantity');
		$date=$request->input('date');
		DB::table('Product_master')
					->where('category','=',$category_in)
					->where('code','=',$product_code)
					->where('status','=',1)
					->increment('stock',$quantity);
		Session::set('lott_no',$lott_no_in);
		Session::set('category_in',$category_in);
		//dd($category_in);
		$product_in=$product_in->fill($request->all());
		$product_in->date=$date;
		$product_in->save();
		return redirect()->back()->withSuccess('Product successfully IN.');
	}*/
        public function post_product_in(ProductinRequest $request,Product_IN $product_in)
	{
		//dd($request->all());
		$lott_no_in=$request->input('lott_no');
		$category_in=$request->input('category_in');
		$product_code=$request->input('product_code');
		$quantity=$request->input('quantity');
		$date=$request->input('date');
		$cost_price = $request->input('cost_price');
		Session::set('lott_no',$lott_no_in);
		Session::set('category_in',$category_in);
		Session::set('in_date',$date);	
		DB::table('Product_master')
					->where('category','=',$category_in)
					->where('code','=',$product_code)
					->where('status','=',1)
					->increment('stock',$quantity);
		if($category_in == 'R'){	
					$selling_price = DB::table('Product_master')->select('selling_price')
								->where('category','=',$category_in)
								->where('code','=',$product_code)
								->where('status','=',1)->get();
					if ($selling_price[0]->selling_price == 0){
						$unit_price = $cost_price/$quantity;
						
					}
					else
					{
						$unit_price = $cost_price/$quantity;
						$unit_price = $selling_price[0]->selling_price+$unit_price;
						$unit_price = $unit_price/2; 
					}
					
					DB::table('Product_master')
								->where('category','=',$category_in)
								->where('code','=',$product_code)
								->where('status','=',1)->update(['selling_price'=>$unit_price]);
		}		
		
		//dd($category_in);
		$product_in=$product_in->fill($request->all());
		$product_in->date=$date;
		$product_in->save();
		return redirect()->back()->withSuccess('Product successfully IN.');
	}
	public function delete_product_in($id)
	{
		$delete_product = DB::table('product_in')->where('id','=',$id)->get();
		$product_code = $delete_product[0]->product_code;
		$category_in = $delete_product[0]->category_in;
		$quantity = $delete_product[0]->quantity;
		DB::table('Product_master')->where('code','=',$product_code)
					->where('category','=',$category_in)
					->decrement('stock',$quantity);
		
		DB::table('product_in')->where('id','=',$id)->update(['status'=>0]);
		return redirect()->back()->withSuccess('Product Deleted from lot. & stock decrease from Stock.');
	}
	/*public function raw_m_in()
	{
		$category_in = Session::get('category_in');
		$lot_no_in = Session::get('lott_no');
		//dd($lot_no_in);
		if(!empty($category_in)){
				$category_pro_code = DB::table('Product_master')
					->select('code')
					->where('category','=',$category_in)
					->where('status','=',1)
					->orderBy('order','asc')
					->get();
					$product=DB::table('product_in')
					->select('product_in.date','Product_master.unit','product_in.id AS id','Product_master.title','Product_master.selling_price','Product_master.id AS id1','product_in.lott_no','product_in.date',
						'product_in.category_in','product_in.product_code','product_in.quantity')
					->join('Product_master','Product_master.code','=','product_in.product_code')
					->where('product_in.lott_no','=',$lot_no_in)
					->where('product_in.status','=',1)
					->orderBy('product_in.id','DESC')
					->get();
//============================================================================================
 $col_data=array();

        $col_heads = array(                
                
               'Lott No',
'Entry Date',
'Category',
'Code',
'Title',
'Quantity',
'Action'
);

       $token = csrf_token();

         foreach($product as $product){                          
              $col_data[] = array(
                   
                  $product->lott_no,
date('d-m-Y',strtotime($product->date)),
                  $product->category_in,                    
                    $product->product_code,
                   $product->title,
                   $product->quantity ,
'<a onclick="return confirm_click();" href="delete_product_in/'.$product->id.'"  class="delete_product_in "> <i class="fa fa-trash"></i></a>'
                     //<button id="{{$product->id}}" type="button"  ><i class="fa fa-trash-o"></i></button>"employee/'.$employee->id.'/edit"
                    );    
            }

Helper::writeResult($col_data);                        
//============================================================================================				

			return view('product_in.raw_m_in',compact('col_heads'),['category_in'=>$category_in,'lot_no_in'=>$lot_no_in])
					->with('category_pro_code',$category_pro_code)
					->with('product',$product);
		}
		else
		{
			$category_in=null;
			$lot_no_in=null;
			$category_pro_code=null;
			return view('product_in.raw_m_in',['category_in'=>$category_in,'lot_no_in'=>$lot_no_in])->with('category_pro_code',$category_pro_code);
		}
	}*/
        public function raw_m_in()
	{
		$category_in = Session::get('category_in');
		$lot_no_in = Session::get('lott_no');
		$in_date = Session::get('in_date');
		//dd($lot_no_in);
		if(!empty($category_in)){
				$category_pro_code = DB::table('Product_master')
					->select('code')
					->where('category','=',$category_in)
					->where('status','=',1)
					->orderBy('order','asc')
					->get();
					$product=DB::table('product_in')
					->select('product_in.date','product_in.cost_price','Product_master.unit','product_in.id AS id','Product_master.title','Product_master.selling_price','Product_master.id AS id1','product_in.lott_no','product_in.date',
						'product_in.category_in','product_in.product_code','product_in.quantity')
					->join('Product_master','Product_master.code','=','product_in.product_code')
					->where('product_in.lott_no','=',$lot_no_in)
					->where('product_in.status','=',1)
					->orderBy('product_in.id','DESC')
					->get();
//============================================================================================
		if($category_in =='r')
		{
			 		$col_data=array();
			        $col_heads = array(                                
			               'Lott No',
							'Entry Date',
							'Category',
							'Code',
							'Title',
							'Quantity',
							'Cost Price',
							'Action'
							);

					$token = csrf_token();

					foreach($product as $product){                          
					$col_data[] = array(

					$product->lott_no,
					date('d-m-Y',strtotime($product->date)),
					$product->category_in,                    
					$product->product_code,
					$product->title,
					$product->quantity ,
					$product->cost_price,
					'<a onclick="return confirm_click();" href="delete_product_in/'.$product->id.'"  class="delete_product_in "> <i class="fa fa-trash"></i></a>'
					//<button id="{{$product->id}}" type="button"  ><i class="fa fa-trash-o"></i></button>"employee/'.$employee->id.'/edit"
					);    
					}

					Helper::writeResult($col_data);      
		}
		else
		{
			$col_data=array();
			        $col_heads = array(                                
			               'Lott No',
							'Entry Date',
							'Category',
							'Code',
							'Title',
							'Quantity',
							'Cost Price',
							'Action'
							);

					$token = csrf_token();

					foreach($product as $product){                          
					$col_data[] = array(

					$product->lott_no,
					date('d-m-Y',strtotime($product->date)),
					$product->category_in,                    
					$product->product_code,
					$product->title,
					$product->quantity ,
					$product->cost_price,
					'<a onclick="return confirm_click();" href="delete_product_in/'.$product->id.'"  class="delete_product_in "> <i class="fa fa-trash"></i></a>'
					//<button id="{{$product->id}}" type="button"  ><i class="fa fa-trash-o"></i></button>"employee/'.$employee->id.'/edit"
					);    
					}

					Helper::writeResult($col_data); 
		}                 
//============================================================================================				

			return view('product_in.raw_m_in',compact('col_heads'),['category_in'=>$category_in,'lot_no_in'=>$lot_no_in,'in_date'=>$in_date])
					->with('category_pro_code',$category_pro_code)
					->with('product',$product);
		}
		else
		{
			$category_in=null;
			$lot_no_in=null;
			$category_pro_code=null;
			return view('product_in.raw_m_in',['category_in'=>$category_in,'lot_no_in'=>$lot_no_in])->with('category_pro_code',$category_pro_code);
		}
	}
	public function f_goods_in()
	{
		return view('product_in.f_goods_in');
	}
	public function paste_in()
	{
		return view('product_in.paste_in');
	}
	public function store(Request $request){
				if(Entrust::can('Add_Training_Name')){
				$training_title = $request->input('training_title');
				if(isset($training_title) && !empty($training_title)){	
					DB::table('training_details')->insert(['training_name'=>$training_title]);
					return redirect()->back()->withSuccess('New Training successfully Added.');		
				}
				else
				{
					return redirect()->back()->withErrors('Training Name is empty.');		
				}
				
			}
	}
	public function show(Leave $leave){

		$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
		$child_users = User::whereIn('designation_id',$child_designations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('view_leave') || (!Entrust::can('manage_everyone_leave') && Entrust::can('manage_subordinate_leave') && !in_array($leave->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		$employee = $leave->User;
		$designation = $employee->Designation;
    	$department = $designation->Department;

    	$other_leaves = Leave::where('id','!=',$leave->id)
    		->where('user_id','=',$leave->user_id)
    		->get();

        $data = [
        	'leave' => $leave,
        	'employee' => $employee,
        	'designation' => $designation,
        	'department' => $department,
        	'other_leaves' => $other_leaves
        	];

		return view('leave.show',$data);
	}

	public function add_new(){
		if(Entrust::can('Employee_Training')){
		if(!Entrust::can('create_leave'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $query = DB::table('users');

        if(!Entrust::hasRole('admin'))
        	$query->where('users.id','=',Auth::user()->id);

        $users= $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');
        //$leave_types = LeaveType::lists('leave_name','id')->all();
        $leave_types = TrainingType::lists('training_name','id')->all();
        //dd($leave_types);
		return view('training.create',compact('users','leave_types'));
	}
	}
	public function add_training(){
			if(Entrust::can('Add_Training_Name')){					
        $query = DB::table('users');       
        	$query->where('users.id','=',Auth::user()->id);
        $users= $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');
        //$leave_types = LeaveType::lists('leave_name','id')->all();
        $leave_types = db::table('training_details')->select('training_name','id')->get();
        //dd($leave_types);
		return view('training.training_create',compact('users','leave_types'));
	}
	}
	public function report(Leave $leave){
		if(Entrust::can('Training_Report')){
			
		$leaves = $leave->where('user_id','=',Auth::user()->id)->get();
        
        $col_data=array();
        $col_heads = array(        		
        		trans('messages.Staff Name'),
        		trans('messages.Training Name'),
        		trans('messages.From Date'),
        		trans('messages.To Date'),
        		trans('messages.Training Duration'),
        		trans('messages.Training Result')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($leaves as $leave){
        	$employee = $leave->User;
        	$name = $employee->first_name." ".$employee->last_name;
        	$leave_type = $leave->LeaveType;
        	$leave_type_name = $leave_type->leave_name;
        	$designation = $employee->Designation;
        	$department = $designation->Department;

			$cols = array(
					'<div class="btn-group btn-group-xs">'.
					'<a href="/leave/'.$leave->id.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-share"></i></a> '.
					'<a href="/leave/'.$leave->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
					delete_form(['leave.destroy',$leave->id]).'</div>',
					$name." (".$designation->designation." in ".$department->department_name." )",
					$leave_type_name,
					Helper::showDate($leave->from_date),
					Helper::showDate($leave->to_date),
					ucfirst($leave->leave_status)
					);	
			$id = $leave->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

		return view('training.report_show',compact('col_heads'));
       } 	
	}

	public function manage(Request $request){	
		if(!Entrust::can('Employee_Training'))
			$input=$request->all();
			dd($input);
		return redirect()->back()->withSuccess('Training Added for the specific Employee');		
	}

	public function update(LeaveRequest $request, Leave $leave){

		$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
		$child_users = User::whereIn('designation_id',$child_designations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('edit_leave') || (!Entrust::can('manage_everyone_leave') && Entrust::can('manage_subordinate_leave') && !in_array($leave->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		if($leave->leave_status != 'pending' && $leave->user_id == Auth::user()->id)
			return redirect('leave')->withErrors('This leave cannot be edited. It is either approved or rejected. ');
		
		$user_id = $request->input('user_id');
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');

		$leaves = Leave::where('id','!=',$leave->id)
			->where('user_id','=',$user_id)
			->where(function ($query) use($from_date,$to_date) { $query->where(function ($query) use($from_date,$to_date)  {
				$query->where('from_date','>=',$from_date)
				->where('from_date','<=',$to_date);
			})->orWhere(function ($query) use($from_date,$to_date)  {
				$query->where('to_date','>=',$from_date)
					->where('to_date','<=',$to_date);
			});})->count();

		if($leaves)
			return redirect()->back()->withErrors('Leave already requested for some of this duration.');
		
		$data = $request->all();
		$leave->fill($data);
		$leave->save();
		Helper::updateCustomField($this->form,$leave->id, $data);

		$activity = 'Updated a leave request';
		Activity::log($activity);
		return redirect('/leave')->withSuccess(config('constants.UPDATED'));
	}

	public function updateStatus(LeaveStatusRequest $request){

		$id = $request->input('id');
		$leave = Leave::find($id);

		if(!$leave)
			return redirect('/leave')->withErrors(config('constants.INVALID_LINK'));

		if(!Entrust::can('edit_leave_status') || $leave->user_id == Auth::user()->id)
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$leave->leave_status = $request->input('leave_status');
		$leave->leave_comment = $request->input('leave_comment');
		$leave->save();

		return redirect()->back()->withSuccess('Leave status updated successfully. ');
	}
	public function edit($id){
		if(Entrust::can('Add_Training_Name')){
			
		}
	}
	public function destroy(Leave $leave){
		if(Entrust::can('Add_Training_Name'))
					
        $leave->delete();
		$activity = 'Deleted a Training';
		Activity::log($activity);
        return redirect()->back()->withSuccess(config('constants.DELETED'));
	}
		
}
?>