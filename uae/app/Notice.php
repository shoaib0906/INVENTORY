<?php
namespace App;
use Eloquent;

class Notice extends Eloquent {

	protected $fillable = [
							'from_date',
							'to_date',
							'title',
							'content',
							'username'
						];
	protected $primaryKey = 'id';
	protected $table = 'notice';

	public function designation()
    {
        return $this->belongsToMany('App\Designation','notice_designation','notice_id','designation_id');
    }

}
