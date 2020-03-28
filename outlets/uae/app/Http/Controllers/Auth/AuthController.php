<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Role;
use App\Designation;
use App\Location;//by Dev@4489
use App\Department;//by Dev@4489
use App\Http\Requests\RegisterRequest;
use Entrust;
use App\Profile;
use App\Classes\Helper;
use Auth;
use App\Branch;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','getRegister','postRegister','testapi']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function testapi()
    {
        
        // $url = "http://api.hivisasa.com/articles/nakuru/crime";
         $json = file_get_contents('http://api.hivisasa.com/articles/nakuru/crime');
            $obj = json_decode($json);
            //dd($obj) ;
            return view('test.create',compact('obj'));

    }
    public function getRegister()
    {
        if(!Entrust::can('create_employee'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

		$alias_list = Department::lists('department_name','id')->all();
        if(Auth::user()->emp_type ==3 ||Auth::user()->emp_type ==2 )
        {
            $branches = Branch::where('id','=',Auth::user()->branch_id)->lists('branch_name','id')->all();
        }else{
        $branches = Branch::lists('branch_name','id')->all();
		}
        return view('employee.create',compact('branches','designations','roles','locations','alias_list'));
    }

    public function postRegister(RegisterRequest $request, User $user){
        
        if(!Entrust::can('create_employee'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));
        //$request['branch_id']=
        $user->fill($request->all());
        //dd($user);
        $user->password = bcrypt($request->input('password'));
		$user->designation_id = $request->input('alias_id');//by Dev@4489
		//$user->payment_mode = $request->input('payment_mode');//by Dev@4489
		//$user->iban_number = $request->input('iban_number');//by Dev@4489
        $user->property_id=$request->input('alias_id');//by Dev@4489
		$user->emp_type = $request->input('role');//3 for user 2 for administrator
		$user->alias_id = $request->input('alias_id');//by Dev@4489
        $user->save();
        $profile = new Profile;
        $profile->user()->associate($user);
        $profile->employee_code = 100;
        $profile->save();
        $user->attachRole(3);
        return redirect()->back()->withSuccess('Employee created successfully. ');
    }
    
    protected $username = 'username';
    protected $redirectPath = '/dashboard';
    protected $loginPath = '/login';
}
