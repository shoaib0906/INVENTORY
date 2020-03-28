<?php
namespace App;
use Eloquent;

class Location extends Eloquent {

	protected $fillable = [
							'location_name',
							'location_description'
						];
	protected $primaryKey = 'id';
	protected $table = 'locations';

}
