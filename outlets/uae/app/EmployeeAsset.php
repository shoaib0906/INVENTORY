<?php
namespace App;
use Eloquent;

class EmployeeAsset extends Eloquent {

	protected $fillable = [
							'employee_id',
							'asset_id',
							'issue_date',
							'comments',
							'return_date',
							'status'
						];
	protected $primaryKey = 'id';
	protected $table = 'employeeasset';
	
	public function user()
    {
        return $this->belongsTo('App\User','employee_id'); 
    }

    public function assetType()
    {
        return $this->belongsTo('App\Asset','asset_id'); 
    }

}
