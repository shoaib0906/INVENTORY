<?php
namespace App;
use Eloquent;

class TimeMaster extends Eloquent {

	protected $fillable = [
							'financial_year',
							'ot_emp_hour',
							'non_ot_emp_hour',
							'commit_ot_hou',
							'week_holiday',
							'staf_cal_days',
							'non_staf_cal_days', 
							'normal_ot_rate',
							'holiday_ot_rate',
							'special_ot_rate'
						];
	protected $primaryKey = 'id';
	protected $table = 'time_master';
	    
}
