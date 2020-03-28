<?php
namespace App;
use Eloquent;

class LeaveMaster extends Eloquent {

	protected $fillable = [
							'leave_name',
							'entitled_for_annual',
							 'completed_days',
							 'chk_is_accr_to_service', 
							 'chk_bal_accr', 
							 'chk_min_annual_leav',
							 'min_annual_leav',
							 'chk_ex_hou_allow', 
							 'chk_auto_anual_leav_sal',
							 'adv_annul_leav',
							 'l_complete_1_year', 
							 'l_incomplete_1_year', 
							 'leav_sal_incl',
							 'leav_encash',
							 'chk_sick_leav',
							 'sick_ful_pay_days',
							 'sick_haf_pay_days',
							 'haj_leav', 
							 'haj_how_time', 
							 'mater_leav_bef_one_year', 
							 'mater_pay_bef_one_year', 
							 'mater_leav_after_one_year', 
							 'mater_pay_aft_one', 
							 'chk_mater_and_annaul',
							 'mater_and_annaul_not_exce', 
							 'acci_full_pay', 
							 'acci_half_pay', 
							 'person_max_leave',
							 'person_conti_leave',
							 'updated_at',
							 'created_at'
						];
	protected $primaryKey = 'id';
	protected $table = 'leave_master';
	    
}
