<?php
namespace App;
use Eloquent;

class Dependent extends Eloquent {

	protected $fillable = [
							'user_id',
							'name',
							'relation',
							'visa',
							'issue_date',
							'expiry_date',
							'document'
						];
	protected $primaryKey = 'id';
	protected $table = 'dependents';

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }
}
