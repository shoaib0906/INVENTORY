<?php
namespace App;
use Eloquent;

class TrainingType extends Eloquent {

	protected $fillable = [
							'training_name'
						];
	protected $primaryKey = 'id';
	protected $table = 'training_details';
}
