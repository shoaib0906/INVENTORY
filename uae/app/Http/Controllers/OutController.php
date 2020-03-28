<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\ProductoutRequest;
use DB;
use Entrust;
use App\Leave;
use App\Product_out;
use App\Manage_training;
use App\TrainingType;
use App\User;
use Config;
use Auth;
use Session;
use Activity;
use App\Classes\Helper;

Class OutController extends Controller{

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
	public function post_invoice(Request $request)
	{
		
$this->validate($request, [
        'order_no' => 'required|numeric',
        'customer_id' =>'required',
        'total_amount' =>'required',
'discount' =>'required'
    ]);
		$bill_no = DB::table('bill_tran')->max('bill_no');
		
		if($bill_no == null){
			$bill_no=1;
		}
		else{
			$bill_no=$bill_no+1;
		}
		
		$ref_no = $request->input('ref_no');//dd($bill_no);
		$is_exist = DB::table('bill_tran')->where('ref_no','=',$ref_no)->count();
		if($is_exist == 0){
		$ref_no = $request->input('ref_no');
		$customer_id = $request->input('customer_id');
		$order_no = $request->input('order_no');
		$total_amount = $request->input('total_amount');
		$discount =$request->input('discount');
		$less = $request->input('less');
		$net_amout = $request->input('total_amount') - ($request->input('total_amount') *$request->input('discount') / 100)-$request->input('less') ;
//dd($total_amount .'--'.$discount.'--'.$net_amout);
		DB::table('bill_tran')->insert(['bill_no'=>$bill_no,
										'ref_no'=>$ref_no,
                                                                                'order_no'=>$order_no,
										'net_amt'=>$net_amout,
										'total_amt'=>$total_amount,
										'dis_percent'=>$discount,
										'less_amt'=>$less,
										'bill_date'=>date('y-m-d'),
										'customer_id'=>$customer_id
										]);

		DB::table('bill_register')->where('ref_no','=',$ref_no)->where('bill_no','=',null)->update(['bill_no'=>$bill_no]);

		$challan_nos = DB::table('bill_register')->select('challan_no')->where('ref_no','=',$ref_no)->get();
		//dd($challan_no);
		foreach ($challan_nos as $challan_no ) {
			DB::table('product_out')->where('status','=',1)->where('challan_no','=',$challan_no->challan_no)
						->where('is_bill','=',0)
						->update(['is_bill'=>$bill_no]);	
		}
		
		return redirect('view_bill_report/'.$bill_no);
		}
		else
			return redirect('/bill');
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
	public function bill()
	{
		/*$bill_no = DB::table('bill_register')->where('status','=',0)->max('bill_no');
		
		if($bill_no == null){
			$bill_no=1;
		}
		else{
			$bill_no=$bill_no+1;
		}*/
		$rand=rand(0,999);
		$ref_no=uniqid($rand,TRUE);

		return view('bill.index',['ref_no'=>$ref_no]);
	}
	public function post_bill(Request $request)
	{
		
		$this->validate($request, [
        'challan_no' => 'required|numeric',
        'ref_no' =>'required'
    ]);
		$ref_no = $request->input('ref_no');
		$challan_no = $request->input('challan_no');
		$customer_info = DB::table('customer_info')->get();
		$challan_exist = DB::table('product_out')->where('challan_no','=',$challan_no)
						->where('is_bill','=',0)->count();
		$already_in_bill = DB::table('bill_register')
						->where('challan_no','=',$challan_no)
							->where('bill_no','=',null)
							->where('ref_no','=',$ref_no)
							->where('status','=',1)->count();
		//dd($already_in_bill .'-'. $challan_exist);
		if($challan_exist > 0)
		{
			if($already_in_bill > 0)
			{
			$product=DB::table('product_out')
					->select('bill_register.ref_no','product_out.id AS id','Product_master.title','product_out.selling_price','Product_master.id AS id1','product_out.challan_no','Product_master.unit',
						'product_out.category_out','product_out.product_code','product_out.quantity')
					/*->select('product_out.product_code',DB::raw('sum(product_out.selling_price*product_out.quantity) AS selling_price')
						,DB::raw('sum(product_out.quantity) AS quantity'),'bill_register.ref_no','product_out.id AS id','Product_master.title','Product_master.id AS id1','product_out.challan_no','Product_master.unit',
						'product_out.category_out')*/
					->join('Product_master','Product_master.code','=','product_out.product_code')
					->join('bill_register','bill_register.challan_no','=','product_out.challan_no')
					->where('bill_register.ref_no','=',$ref_no)
					->where('bill_register.status','=',1)
					->where('product_out.status','=',1)
					->where('bill_register.bill_no','=',null)

					//->groupBy('product_out.product_code')
					->orderBy('bill_register.challan_no','desc')
					->get();	
				//dd($product);						
				return view('bill.index',['ref_no'=>$ref_no,'product'=>$product,'customer_info'=>$customer_info])->withErrors(config('constants.ADDED'));

			}
			else{
				DB::table('bill_register')->insert(['ref_no'=>$ref_no,'challan_no'=>$challan_no]);
		$product=DB::table('product_out')
					->select('bill_register.ref_no','product_out.id AS id','Product_master.title','product_out.selling_price','Product_master.id AS id1','product_out.challan_no',
						'product_out.category_out','Product_master.unit','product_out.product_code','product_out.quantity')
					->join('Product_master','Product_master.code','=','product_out.product_code')
					->join('bill_register','bill_register.challan_no','=','product_out.challan_no')
					->where('bill_register.ref_no','=',$ref_no)
					->where('product_out.status','=',1)
					->where('bill_register.bill_no','=',null)

					->orderBy('bill_register.challan_no','desc')
					->get();
		return view('bill.index',['ref_no'=>$ref_no,'customer_info'=>$customer_info])->withSuccess('Challan added to Bill')->with('product',$product);	

			}
		}
		else
		{
			//DB::table('bill_register')->insert(['ref_no'=>$ref_no,'challan_no'=>$challan_no]);
		$product=DB::table('product_out')
					->select('bill_register.ref_no','Product_master.unit','product_out.id AS id','Product_master.title','product_out.selling_price','Product_master.id AS id1','product_out.challan_no',
						'product_out.category_out','product_out.product_code','product_out.quantity')
					->join('Product_master','Product_master.code','=','product_out.product_code')
					->join('bill_register','bill_register.challan_no','=','product_out.challan_no')
					->where('bill_register.ref_no','=',$ref_no)
					->where('product_out.status','=',1)
					->where('bill_register.bill_no','=',null)
					->orderBy('bill_register.challan_no','desc')
					->get();
		return view('bill.index',['ref_no'=>$ref_no])->withSuccess('Challan added to Bill')->with('product',$product);	
		}
		
	}
	/*public function post_product_out(ProductoutRequest $request,Product_OUT $product_in)
	{
		//dd($request->all());
		$challan_no=$request->input('challan_no');
		$category_out=$request->input('category_out');
		$product_code=$request->input('product_code');
		$quantity=$request->input('quantity');
		$price =$request->input('price');

		$is_billed = DB::table('product_out')->where('challan_no','=',$challan_no)->where('is_bill','!=',0)->count();
		if($is_billed > 0){  //challan no billed raise exception
			return redirect()->back()->withErrors('This Challan No is Billed.Please enter another Challan No.');
		}
		if($category_out == 'R'){
			$available=1;
		}
		else{
		$available = 1;
			}
		if($available>0){			
				
				$product_detail = DB::table('Product_master')->select('title','selling_price','unit')
							->where('category','=',$category_out)
							->where('code','=',$product_code)
							->where('status','=',1)->get();
							//dd($product_detail);
				$selling_price = $product_detail[0]->selling_price;	
				$product_title = $product_detail[0]->title;
				$unit = $product_detail[0]->unit;
				if (($price==null && $selling_price == 0)){
					return redirect()->back()->withErrors('Selling Price is Zero.');
				}
				
				if($price !=null)
				{
					$price = $price;
				}	
				else
				{
					$price = $selling_price;
				}
				DB::table('Product_master')
							->where('category','=',$category_out)
							->where('code','=',$product_code)
							->where('status','=',1)
							->decrement('stock',$quantity);
				Session::set('challan_no',$challan_no);
				Session::set('category_out',$category_out);			
				
				$selling_price = $price;	
				$product_in->title = $product_title;
				$product_in->selling_price=$selling_price;
				$product_in->unit = $unit;
				$product_in=$product_in->fill($request->all());
						
				$product_in->save();
				return redirect()->back()->withSuccess('Product successfully Out.');
			}
		
		{

			$available=DB::table('Product_master')->select('stock')
					->where('category','=',$category_out)
					->where('code','=',$product_code)
					->where('status','=',1)
					->get();
			
			return redirect()->back()->withErrors('Stock is Unavailable for this Product.Available quantity - '.$available[0]->stock );
		}
	}*/
        public function post_product_out(ProductoutRequest $request,Product_OUT $product_in)
	{
		//dd($request->all());
		$challan_no=$request->input('challan_no');
		$category_out=$request->input('category_out');
		$product_code=$request->input('product_code');
		$quantity=$request->input('quantity');
		$price =$request->input('price');
		$date =$request->input('date');
		Session::set('challan_no',$challan_no);
				Session::set('category_out',$category_out);			
				Session::set('out_date',$date);
		$is_billed = DB::table('product_out')->where('challan_no','=',$challan_no)->where('is_bill','!=',0)->count();
		if($is_billed > 0){  //challan no billed raise exception
			return redirect()->back()->withErrors('This Challan No is Billed.Please enter another Challan No.');
		}
		if($category_out == 'R'){
			$available=1;
		}
		else{
		$available = 1;/*DB::table('Product_master')
					->where('category','=',$category_out)
					->where('code','=',$product_code)
					->where('status','=',1)
					->where('stock','>=',$quantity)
					->count();*/
			}
		if($available>0){			
				
				$product_detail = DB::table('Product_master')->select('title','selling_price','unit')
							->where('category','=',$category_out)
							->where('code','=',$product_code)
							->where('status','=',1)->get();
							//dd($product_detail);
				$selling_price = $product_detail[0]->selling_price;	
				$product_title = $product_detail[0]->title;
				$unit = $product_detail[0]->unit;
				if (($price==null && $selling_price == 0 && ($category_out == 'F'||$category_out == 'R'))){
					return redirect()->back()->withErrors('Selling Price is Zero.');
				}
				
				if($price !=null)
				{
					$price = $price;
				}	
				else
				{
					$price = $selling_price;
				}
				DB::table('Product_master')
							->where('category','=',$category_out)
							->where('code','=',$product_code)
							->where('status','=',1)
							->decrement('stock',$quantity);
				
				$selling_price = $price;	
				$product_in->title = $product_title;
				$product_in->selling_price=$selling_price;
				$product_in->unit = $unit;
				$product_in=$product_in->fill($request->all());
						
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
			//$available = $available[0]->stock;
			return redirect()->back()->withErrors('Stock is Unavailable for this Product.Available quantity - '.$available[0]->stock );
		}
	}
	public function delete_product_out($id)
	{
		$is_billed=DB::table('product_out')->where('id','=',$id)->where('is_bill','=',0)->count();
		if($is_billed == 1){
		$delete_product = DB::table('product_out')->where('id','=',$id)->get();
		$product_code = $delete_product[0]->product_code;
		$category_out = $delete_product[0]->category_out;
		$quantity = $delete_product[0]->quantity;
		DB::table('Product_master')->where('code','=',$product_code)
					->where('category','=',$category_out)
					->increment('stock',$quantity);
		
		DB::table('product_out')->where('id','=',$id)->delete();
		//dd($id);
		return redirect()->back()->withSuccess('Product Deleted from Bill Register & stock Increase to Stock.');
		}
		else
		return redirect()->back()->withErrors('This Product has been Billed already!!');	

	}
	/*public function raw_m_out()
	{
		$category_out = Session::get('category_out');
		$challan_no = Session::get('challan_no');
		//dd($lot_no_in);
		if(!empty($category_out)){
				$category_pro_code = DB::table('Product_master')
					->select('code')
					->where('category','=',$category_out)
					->where('status','=',1)
					->orderBy('order','asc')
					->get();
				$product=DB::table('product_out')
					->select('product_out.id AS id','Product_master.unit','Product_master.title','product_out.selling_price','Product_master.id AS id1','product_out.challan_no','product_out.date',
						'product_out.category_out','product_out.product_code','product_out.quantity')
					->join('Product_master','Product_master.code','=','product_out.product_code')
					->where('product_out.challan_no','=',$challan_no)
					->where('product_out.status','=',1)
					//->groupBy('product_out.product_code')
                                        ->orderBy('product_out.id','desc')
					->get();
				//dd($product);
                          $col_data=array();

        $col_heads = array(
'No.',
                'Type',

                'E. Date',

                'Product Title',
        			'Selling Price',//by Dev@4489
        				'Quantity',//by Dev@4489				
                        'Sub Total',
                        'Action'
        				);

        $token = csrf_token();

       foreach($product as $product){

           		
              $col_data[] = array(

                   
$product->challan_no,
                   $product->category_out,
			                            $product->date,
			                             
			                              
			                              $product->title,
			                              
			                              $product->selling_price,

											$product->quantity.''.$product->unit,
											$product->quantity*$product->selling_price,
											'<a onclick="return confirm_click();" href="delete_product_out/'.$product->id.'"  class="delete_product_out "> <i class="fa fa-trash"></i></a>'
                    );    

            }



        Helper::writeResult($col_data);

			return view('product_out.raw_m_out',compact('col_heads'),['category_out'=>$category_out,'challan_no'=>$challan_no])
					->with('category_pro_code',$category_pro_code)
					->with('product',$product);
		}
		else
		{
			$category_out=null;
			$challan_no=null;
			$category_pro_code=null;
			return view('product_out.raw_m_out',['category_out'=>$category_out,'challan_no'=>$challan_no])->with('category_pro_code',$category_pro_code);

		}
	}*/
	public function raw_m_out()
	{
		$category_out = Session::get('category_out');
		$challan_no = Session::get('challan_no');
		$out_date = Session::get('out_date');
		//dd($lot_no_in);
		if(!empty($category_out)){
				$category_pro_code = DB::table('Product_master')
					->select('code')
					->where('category','=',$category_out)
					->where('status','=',1)
					->orderBy('order','asc')
					->get();
				$product=DB::table('product_out')
					->select('product_out.id AS id','Product_master.unit','Product_master.title','product_out.selling_price','Product_master.id AS id1','product_out.challan_no','product_out.date',
						'product_out.category_out','product_out.product_code','product_out.quantity')
					->join('Product_master','Product_master.code','=','product_out.product_code')
					->where('product_out.challan_no','=',$challan_no)
					->where('product_out.status','=',1)
					//->groupBy('product_out.product_code')
                                        ->orderBy('product_out.id','desc')->take(10)
					->get();
				//dd($product);
                          $col_data=array();

        $col_heads = array(
'Challan #',
                'Type',

                'E. Date',

                'Product Title',
        			'Selling Price',//by Dev@4489
        				'Quantity',//by Dev@4489				
                        'Sub Total',
                        'Action'
        				);

        $token = csrf_token();

       foreach($product as $product){

           		
              $col_data[] = array(

                   
$product->challan_no,
                   $product->category_out,
			                            $product->date,
			                             
			                              
			                              $product->title,
			                              
			                              number_format($product->selling_price,2),

											$product->quantity.''.$product->unit,
											number_format($product->quantity*$product->selling_price,2),
											'<a onclick="return confirm_click();" href="delete_product_out/'.$product->id.'"  class="delete_product_out "> <i class="fa fa-trash"></i></a>'
                    );    

            }



        Helper::writeResult($col_data);
        //dd($challan_no);
		return view('product_out.raw_m_out',compact('col_heads'),['category_out'=>$category_out,'challan_no'=>$challan_no,'out_date'=>$out_date])
					->with('category_pro_code',$category_pro_code)
					->with('product',$product);
		}
		else
		{
			$category_out=null;
			$challan_no=null;
			$category_pro_code=null;
			return view('product_out.raw_m_out',['category_out'=>$category_out,'challan_no'=>$challan_no])->with('category_pro_code',$category_pro_code);

		}
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