<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EmployeeRequest;

use App\Http\Requests\EmployeeProfileRequest;

use App\Classes\Helper;

use App\User;

use App\Template;

use Entrust;

use Auth;

use Config;

use App\Department;

use App\Salary;
use App\Role;
use App\Alias;//by Dev@4489
use App\Location;//by Dev@4489
use App\EmployeeAsset;//by Dev@4489

use App\DocumentType;

use Image;

use Activity;

use File;

use Mail;

use DB;



class EmployeeController extends Controller

{

  protected $form = 'employee-form';



  public function index(User $employee,Department $department){


        if(!Entrust::can('manage_employee'))

            return redirect('/dashboard')->withErrors(config('constants.NA'));



        if(Entrust::can('manage_all_employee'))

          $employees = $employee->where('emp_type',3)->where('status',1)->get();

        elseif(Entrust::can('manage_subordinate')){

          $childs = Helper::childDesignation(Auth::user()->designation_id,1);

          $employees = $employee->with('roles')->whereIn('designation_id',$childs)->get();

        } else

            return redirect('/dashboard')->withErrors(config('constants.NA'));



        $col_data=array();

        $col_heads = array(

                trans('messages.Option'),

                trans('messages.First Name'),

                trans('messages.Last Name'),


                trans('messages.Email'),
        				trans('messages.Alias'),//by Dev@4489
        				trans('messages.rent_amount'),//by Dev@4489				
                        trans('messages.telephone'),
        				trans('messages.cell_no'));

        $token = csrf_token();

        foreach ($employees as $employee){

            foreach($employee->roles as $role)

              $role_name = $role->display_name;

              $designation = $employee->Designation;
          		$alias_data = $employee->Alias;
        			$tenants_name=DB::table('departments')->select('department_name')->where('id',$employee->property_id)->get();
  	          //dd($tenants_name);
              $col_data[] = array(

                    '<div class="btn-group btn-group-xs">'.

                    //'<a href="employee/'.$employee->id.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-share"></i></a> '.

                    //'<a href="employee/welcomeEmail/'.$employee->id.'/'.$token.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="Send Welcome Email"> <i class="fa fa-envelope"></i></a>'.

                    '<a href="employee/'.$employee->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.

                    delete_form(['employee.destroy',$employee->id]).

                    '</div>',
                    

                    $employee->first_name,

                    $employee->last_name,

                    

                    $employee->email,
                    
                    $tenants_name[0]->department_name,
					          
                    '$'.number_format($employee->rent_amount,2),
                    
                    $employee->telephone,
					          
                    $employee->cell_no
                    );    

            }



        Helper::writeResult($col_data);



        return view('employee.index',compact('col_heads'));

  }



  public function show(User $employee){



      if(!Entrust::can('view_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



      $document_types = DocumentType::lists('document_type_name','id')->all();

      $earning_salary_types = SalaryType::where('salary_type','=','earning')->get();

      $deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();

      $salary = Salary::where('user_id','=',$employee->id)

          ->lists('amount','salary_type_id')->all();

      

      $profile = $employee->Profile;	  

      $custom_field_values = Helper::getCustomFieldValues($this->form,$employee->id);

      return view('employee.show',compact('custom_field_values','employee','salary','profile','document_types','earning_salary_types','deduction_salary_types','employeeassets'));

  }



  public function edit(User $employee){

      $child_designations = Helper::childDesignation(Auth::user()->designation_id,1);



      if(!Entrust::can('edit_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !in_array($employee->designation_id, $child_designations) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



      if(!Helper::getMode())

          return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



      foreach($employee->roles as $role)

        $role_id = $role->id;



      $query = \App\Designation::whereNotNull('designations.id');



      if(!Entrust::can('manage_all_employee'))

        $query->whereIn('designations.id',$child_designations);



      $designations = $query->join('departments','departments.id','=','designations.department_id')

        ->select(DB::raw('CONCAT(designation, " (", department_name, ")") AS full_designation,designations.id AS designation_id'))

        ->lists('full_designation','designation_id')->all();
		
	  //by Dev@4489
	 
	  $alias_list = Department::lists('department_name','id')->all();	
	  ////	



      $roles = \App\Role::lists('display_name','id')->all();

      return view('employee.edit',compact('employee','designations','roles','role_id','alias_list'));

  }



  public function profileUpdate(EmployeeProfileRequest $request, $id){



        $employee = User::find($id);



        if(!$employee)

            return redirect('employee')->withErrors(config('constants.INVALID_LINK'));



        if(!Entrust::can('profile_update_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

            return redirect('/dashboard')->withErrors(config('constants.NA'));



        if(!Helper::getMode())

            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



        Activity::log('Profile updated');

        $profile = $employee->Profile ?: new Profile;

        $photo = $profile->photo;

        $data = $request->all();

        $profile->fill($data);

        if($request->input('date_of_birth') == '')

            $profile->date_of_birth = null;

        if($request->input('date_of_joining') == '')

            $profile->date_of_joining = null;

        if($request->input('date_of_leaving') == '')

            $profile->date_of_leaving = null;



        if ($request->hasFile('photo') && $request->input('remove_photo') != 1) {

            $filename = $request->file('photo')->getClientOriginalName();

            $extension = $request->file('photo')->getClientOriginalExtension();

            $filename = uniqid();

            $file = $request->file('photo')->move('uploads/user/', $filename.".".$extension);

            $img = Image::make('uploads/user/'.$filename.".".$extension);

            $img->resize(200, null, function ($constraint) {

                $constraint->aspectRatio();

            });

            $img->save('uploads/user/'.$filename.".".$extension);

            $profile->photo = $filename.".".$extension;

        } elseif($request->input('remove_photo') == 1){

            File::delete('uploads/user/'.$profile->photo);

            $profile->photo = null;

        }

        else

        $profile->photo = $photo;



        Helper::updateCustomField($this->form,$employee->id, $data);



        $employee->profile()->save($profile);



        return redirect('/employee/'.$id.'/#basic')->withSuccess(config('constants.SAVED'));

  }



  public function update(EmployeeRequest $request, User $employee){

      if(!Entrust::can('edit_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



        if(!Helper::getMode())

            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



        $employee->first_name = $request->input('first_name');

        $employee->last_name = $request->input('last_name');

        $employee->email = $request->input('email');

        $employee->designation_id = $request->input('designation_id');
		
		
    		$employee->alias_id = $request->input('alias_id');

        $employee->property_id=$request->input('alias_id');//by Dev@4489

        //$employee->emp_type = 3;//3 for user 2 for administrator
    
        

        if(Entrust::hasRole('admin')){

          $roles[] = $request->input('role');

          $employee->roles()->sync($roles);

        }

        $employee->save();



        return redirect('/employee')->withSuccess(config('constants.SAVED'));

  }



  public function changePassword(){

      return view('auth.change_password');

  }



  

  public function doChangePassword(Request $request)

  {

    if(!Helper::getMode())

        return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



    $this->validate($request, [

            'old_password' => 'required|valid_password',

            'new_password' => 'required|confirmed|different:old_password|min:4',

            'new_password_confirmation' => 'required|different:old_password|same:new_password'

        ]);

        $credentials = $request->only(

                'new_password', 'new_password_confirmation'

        );



        $user = Auth::user();

        

        $user->password = bcrypt($credentials['new_password']);

        $user->save();

        return redirect('change_password')->withSuccess('Password has been changed.');    

  }



  public function doChangeEmployeePassword(Request $request, $id)

  {

    $employee = User::find($id);

        

    if(!Helper::getMode())

        return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



    if(!Entrust::can('reset_employee_password') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



    $this->validate($request, [

            'new_password' => 'required|confirmed|min:4',

            'new_password_confirmation' => 'required|same:new_password'

        ]);

        $credentials = $request->only(

                'new_password', 'new_password_confirmation'

        );



        $employee->password = bcrypt($credentials['new_password']);

        $employee->save();

        return redirect()->back()->withSuccess('Password has been changed.');    

  }



  public function destroy(User $employee){

    

        if(!Entrust::can('delete_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));


        if($employee->id == Auth::user()->id)

            return redirect('/employee')->withErrors('You cannot delete yourself. ');

		

        
        DB::table('users')->where('id', $employee->id)->update(['status'=>0]);
        
        $activity = 'Deleted a Tenants';
        Activity::log($activity);

        return redirect('/employee')->withSuccess(config('constants.DELETED'));

  }

}