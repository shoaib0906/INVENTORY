<?php
namespace App;
use Eloquent;

class Branch extends Eloquent {

	protected $fillable = [
							'branch_name',
							'address',
							'phone',
						];
	protected $primaryKey = 'id';
	protected $table = 'branches';

	protected  function designation(){
        return $this->hasMany('App\Designation','department_id','id');
    }

}
