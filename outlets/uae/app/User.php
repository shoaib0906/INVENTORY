<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','email', 'password','username','designation_id','property_id','rent_amount','telephone'
    ,'cell_no','status','branch_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];



    public function profile()
    {
        return $this->hasOne('App\Profile'); 
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role','role_user');
    }

    public function designation()
    {
        return $this->belongsTo('App\Designation'); 
    }

    public function bankAccount()
    {
        return $this->hasMany('App\BankAccount'); 
    }

    public function document()
    {
        return $this->hasMany('App\Document'); 
    }
	//by Dev@4489
	public function alias()
    {
        return $this->belongsTo('App\Alias'); 
    }
	public function employeeAsset()
    {
        return $this->hasMany('App\EmployeeAsset','employee_id'); 
    }
	public function dependent()
    {
        return $this->hasMany('App\Dependent'); 
    }
	////

    public function todo()
    {
        return $this->hasMany('App\Todo'); 
    }

    public function task()
    {
        return $this->belongsToMany('App\Task','assigned_tasks','task_id','user_id');
    }

    public function leave()
    {
        return $this->hasMany('App\Leave','user_id'); 
    }

    public function award()
    {
        return $this->belongsToMany('App\Award','assigned_award','award_id','user_id');
    }

    public function message()
    {
        return $this->hasMany('App\Message'); 
    }

    public function clock()
    {
        return $this->hasMany('App\Clock'); 
    }

    public function ticket()
    {
        return $this->hasMany('App\Ticket'); 
    }


    public function payrollSlip()
    {
        return $this->hasMany('App\PayrollSlip'); 
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
}
