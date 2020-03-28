<?php
namespace App;
use Eloquent;

class Alias extends Eloquent {

	protected $fillable = [
							'alias_name'
						];
	protected $primaryKey = 'id';
	protected $table = 'alias';

    public function alias()
    {
        return $this->hasMany('App\Alias'); 
    }
}
