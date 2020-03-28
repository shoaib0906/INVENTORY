<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\ProductoutRequest;
use DB;
use Entrust;
use App\Leave;
use App\Product_OUT;
use App\Manage_training;
use App\TrainingType;
use App\User;
use Config;
use Auth;
use Session;
use Activity;
use App\Classes\Helper;

Class common_Report_Controller extends Controller{

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
	public function caterory_out($caterory_out)
	{
		//if(Entrust::can('Add_Training_Name')){
		$product = DB::table('Product_master')
				->select('code')
				->where('category','=',$caterory_out)
				->where('status','=',1)
				->orderBy('order','asc')
				->get();
		//dd($product);
		return view('product_out.category_product')->with('product',$product);
	}
	public function post_product_out(ProductoutRequest $request,Product_OUT $product_in)
	{
		//dd($request->all());
		$challan_no=$request->input('challan_no');
		$category_out=$request->input('category_out');
		$product_code=$request->input('product_code');
		$quantity=$request->input('quantity');


		$available = DB::table('Product_master')
					->where('category','=',$category_out)
					->where('code','=',$product_code)
					->where('status','=',1)
					->where('stock','>=',$quantity)
					->count();
		if($available>0){			
				DB::table('Product_master')
							->where('category','=',$category_out)
							->where('code','=',$product_code)
							->where('status','=',1)
							->decrement('stock',$quantity);
				Session::set('challan_no',$challan_no);
				Session::set('category_out',$category_out);
				//dd($category_in);
				$product_in=$product_in->fill($request->all());
				//dd();
				//$product_in->date=$request->input('date');
				$product_in->save();
				return redirect()->back()->withSuccess('Product successfully Out.');
			}
		else
		{

			$available=DB::table('Product_master')->select('stock')
					->where('category','=',$category_out)
					->where('code','=',$product_code)
					->where('status','=',1)
					->get();
			$available = $available[0]->stock;
			return redirect()->back()->withErrors('Stock is Unavailable for this Product.Available quantity - '.$available );
		}
	}
	public function delete_product_out($id)
	{
		$delete_product = DB::table('product_out')->where('id','=',$id)->get();
		$product_code = $delete_product[0]->product_code;
		$category_out = $delete_product[0]->category_out;
		$quantity = $delete_product[0]->quantity;
		DB::table('Product_master')->where('code','=',$product_code)
					->where('category','=',$category_out)
					->increment('stock',$quantity);
		
		DB::table('product_out')->where('id','=',$id)->update(['status'=>0]);
		//dd($id);
		return redirect()->back()->withSuccess('Product Deleted from Bill Register & stock Increase to Stock.');
	}
	public function common_report()
	{
		
			return view('report.common_report');
	}
	public function post_common_report(Request $request)
	{
		//dd($request->all());
		$from_date = $request->input('date_from');
		$to_date = $request->input('date_to');
		$category_type = 'F';
		$report_type = $request->input('report_type');
		if($report_type =='I')
		{
			$product = DB::table('product_in')
					->select('product_in.id AS id','Product_master.title','Product_master.id AS id1','product_in.lott_no',
						'product_in.category_in','Product_master.unit','product_in.date','product_in.product_code','product_in.quantity')
					->join('Product_master','Product_master.code','=','product_in.product_code')					
					->where('product_in.status','=',1)
					->where('product_in.branch_id','=',Auth::user()->branch_id)
					->where('product_in.category_in','=',$category_type)
					->where('product_in.date','>=',$from_date)
					->where('product_in.date','<=',$to_date)
					->get();
			//dd($product);
					   $col_data=array();

        $col_heads = array(

                'Lott No',
                'Code',
                'Title',
                'Date',
                'Quantity');

        $token = csrf_token();

        foreach($product as $product_in){
              $col_data[] = array(
              		
                 	$product_in->lott_no,
					$product_in->product_code,       
                    $product_in->title,
                    date('d-m-Y',strtotime($product_in->date)),
                    $product_in->quantity.' '.$product_in->unit,

                    );    

            }



        Helper::writeResult($col_data);

			                        
			return view('report.common_report',compact('col_heads'),['from_date'=>$from_date,'to_date'=>$to_date])->with('product_in',$product);				
		}
		else
		{

			$product = DB::table('product_out')
					->select('product_out.id AS id','Product_master.title','product_out.selling_price','Product_master.id AS id1','product_out.challan_no',
						'product_out.category_out','product_out.date','product_out.unit','product_out.product_code','product_out.quantity')
					->join('Product_master','Product_master.code','=','product_out.product_code')
					->where('product_out.status','=',1)
					->where('product_in.branch_id','=',Auth::user()->branch_id)
					->where('product_out.category_out','=',$category_type)
					->where('product_out.date','>=',$from_date)
					->where('product_out.date','<=',$to_date)
					->get();
			//dd($product);
			  $col_data=array();

        $col_heads = array(

                'Challan No',
                'Title',
                'Code',
                'Date',
                'Selling Price',
                'Quantity',
                'Sub Total');

        $token = csrf_token();

        foreach($product as $product_out){
        	//$product_out->date = date('d-m-Y',$product_out->date);
              $col_data[] = array(
              		
                 	$product_out->challan_no,
					          
                    $product_out->title,
                    $product_out->product_code,
                    date('d-m-Y',strtotime($product_out->date)),
                    $product_out->selling_price,
                    $product_out->quantity .' '.$product_out->unit,
                    $product_out->quantity*$product_out->selling_price
                    );    

            }



        Helper::writeResult($col_data);

			 
			return view('report.common_report',compact('col_heads'),['from_date'=>$from_date,'to_date'=>$to_date])->with('product_out',$product);
		}

	}
        public function challan_report()
	{
			$challan_no = DB::table('product_out')->select('challan_no','id')
			->where('product_out.branch_id','=',Auth::user()->branch_id)
			->groupBy('challan_no')->get();
			return view('report.challan_report')->with('challan_no',$challan_no);
	}
	
	public function post_challan_report(Request $request)
	{
	
		$challan_no = $request->input('challan_no');
		//dd($challan_no);
		

			$product = DB::table('product_out')
					->select('product_out.id AS id','Product_master.title','product_out.selling_price','Product_master.id AS id1','product_out.challan_no','product_out.unit',
						'product_out.category_out','product_out.product_code','product_out.quantity')
					->join('Product_master','Product_master.code','=','product_out.product_code')
					->where('product_out.status','=',1)
					->where('product_out.branch_id','=', Auth::user()->branch_id)

					->where('product_out.challan_no','=',$challan_no)
					->get();
			//dd($product);
			$value = DB::table('product_out')
			        ->select(DB::raw("SUM(product_out.selling_price*product_out.quantity) as count"))
					->where('product_out.status','=',1)
					->where('product_out.challan_no','=',$challan_no)
					->where('product_out.branch_id','=', Auth::user()->branch_id)
					->get();
				$value = $value[0]->count;
			  $col_data=array();

        $col_heads = array(

                'Category',
                'Challan No',
                'Title',
                
                'Selling Price',
                'Quantity',
                'Sub Total',
                'Action');

        $token = csrf_token();

        foreach($product as $product_out){
              $col_data[] = array(
              		$product_out->category_out,

                 	$product_out->challan_no,
					          
                    $product_out->title,
                  
                    $product_out->selling_price.'/'.$product_out->unit,
                    $product_out->quantity.' '.$product_out->unit,
                    number_format($product_out->quantity*$product_out->selling_price,2),                 
											'<a onclick="return confirm_click();" href="delete_product_out/'.$product_out->id.'"  class="delete_product_out"> <i class="fa fa-trash"></i></a>'
                    );    

            }



        Helper::writeResult($col_data);

			 $challan_no = DB::table('product_out')->select('challan_no','id')->groupBy('challan_no')->get();
			
			return view('report.challan_report',compact('col_heads'))->with('product_out',$product)->with('challan_no',$challan_no)->with('value',$value);
		

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