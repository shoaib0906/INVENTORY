<?php



namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

use DB;

use Auth;

use Entrust;
use App\User;

use App\Department;

use App\Designation;

use App\Holiday;

use App\Todo;
use App\Document;//by Dev@4489
use App\Dependent;//by Dev@4489
use App\Classes\Helper;



class DashboardController extends Controller

{



   public function index(){



        $user_count = DB::table('Product_master')->where('status','=',1)->where('stock','>=',1)->count();
        //$dept_count=0;
        $dept_count = DB::table('Product_master')->where('status','=',1)->count();

        

        $employee = User::find(Auth::user()->id);
        //dd($employee->status);
        //if ($employee->status == 0 )
             //return redirect('/login')->withErrors('You are not Authorized anymore.');


        $users = User::join('designations','designations.id','=','users.designation_id')

            ->join('departments','departments.id','=','designations.department_id')

            ->select(DB::raw('CONCAT(first_name," ",last_name," "," (",department_name,")") AS name,username'))

            ->lists('name','username');

        

        $query = DB::table('activity_log')

            ->join('users','users.id','=','activity_log.user_id')

            ->select(DB::raw('CONCAT(first_name, " ", last_name) AS employee_name,activity_log.created_at AS created_at,text,user_id'));





        $child_designation = Helper::childDesignation(Auth::user()->designation_id,1);

        $child_staff_count = User::whereIn('designation_id',$child_designation)->count();



        $child_users = User::whereIn('designation_id',$child_designation)->lists('id')->all();

        array_push($child_users,Auth::user()->id);



        if(!Entrust::hasRole('admin'))

            $query->whereIn('user_id',$child_users);



        $activities = $query->latest()->limit(100)->get();



        $compose_users = DB::table('users')

            ->where('users.id','!=',Auth::user()->id)

            ->join('designations','designations.id','=','users.designation_id')

            ->join('departments','departments.id','=','designations.department_id')

            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (",  department_name, " )") AS full_name,users.id AS user_id'))

            ->lists('full_name','user_id');




		//by Dev@4489
		//Expire Documents before 30days
		$exdate = date('Y-m-d');
		//$docexpire_count = Document::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")->count();
		//$empdepend_expire_count = Dependent::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")->count();
		//$expire_count=$docexpire_count+$empdepend_expire_count;
		////


        $assets = ['graph','calendar'];

        $present_count =  DB::table('bill_tran')->count();
        $expire_count  = DB::table('bill_tran')->sum('net_amt');
        $discount = DB::table('bill_tran')->sum(DB::raw('total_amt*dis_percent/100'));
        $less_amt = DB::table('bill_tran')->sum('less_amt');
        $total_amt = $discount+$less_amt+$expire_count ;
        $no_challan =   DB::table('product_out')
                 ->select('challan_no', DB::raw('count(status) as total'))
                 ->groupBy('challan_no')
                 ->count();

        //$no_challan=$no_challan[0]->total;
        //dd($no_challan);
        return view('dashboard',compact(

            'user_count','dept_count','present_count',

            'employee','compose_users','expire_count',

           'users','discount','less_amt','total_amt','no_challan'

            ));

   }

}