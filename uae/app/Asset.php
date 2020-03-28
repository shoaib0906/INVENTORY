<?php
namespace App;
use Eloquent;

class Asset extends Eloquent {

	protected $fillable = [
							'asset_code',
							'asset_name'
						];
	protected $primaryKey = 'id';
	protected $table = 'assets';

    /*public function document()
    {
        return $this->hasMany('App\Document'); 
    }*/
}
