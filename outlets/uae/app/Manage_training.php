<?php
namespace App;
use Eloquent;

class Manage_training extends Eloquent {

	protected $fillable = [
							'user_id',
							'training_id',
							'start_date',
							'end_date',
							'result',
							'duration',
							'description'							
						];
	protected $primaryKey = 'id';
	protected $table = 'training_manage';

}