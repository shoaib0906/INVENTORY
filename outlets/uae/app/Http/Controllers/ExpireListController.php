<?php
//by Dev@4489
namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;
use DB;
use Auth;
use Entrust;
use App\User;
use App\Document;
use App\Dependent;
use App\Classes\Helper;

class ExpireListController extends Controller
{

   public function index(){        
		//Expire Documents before 30days
		/*$exdate = date('Y-m-d');
		$docexpire_list = Document::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")
			->join('users','users.id','=','documents.user_id')
			->join('profile','profile.user_id','=','documents.user_id')
			->select(DB::raw('CONCAT(first_name, " ", last_name) AS name,employee_code,document_title,expiry_date'))
			->get();
		//$empdepend_expire_count = Dependent::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")->count();	
			
		$col_data=array();
        $col_heads = array(
                trans('messages.Employee Code'),
                trans('messages.Name'),
                trans('messages.Document'),
                trans('messages.Expiry Date'));
				
		foreach ($docexpire_list as $doc){
            $col_data[] = array(
                    $doc->employee_code ? $doc->employee_code : '' ,
                    $doc->name,
                    $doc->document_title,
                    Helper::showDate($doc->expiry_date)
                    );
        }

        Helper::writeResult($col_data);
		
		$col_data2=array();
        $col_heads2 = array(
                trans('messages.Employee Code'),
                trans('messages.Employee'),
				trans('messages.Relative Name'),
				trans('messages.Relationship'),
				trans('messages.Expiry Date'));
		$empdepend_list = Dependent::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")
			->join('users','users.id','=','dependents.user_id')
			->join('profile','profile.user_id','=','dependents.user_id')
			->select(DB::raw('CONCAT(first_name, " ", last_name) AS name,employee_code,dependents.name as vrname,relation,expiry_date'))
			->get();		
		foreach ($empdepend_list as $edep){
            $col_data2[] = array(
                    $edep->employee_code ? $edep->employee_code : '' ,
                    $edep->name,
                    $edep->vrname,
					$edep->relation,
					Helper::showDate($doc->expiry_date)
                    );
        }

        Helper::writeResult($col_data2);*/
		
		$exdate = date('Y-m-d');
		$docexpire_list = Document::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")
			->join('users','users.id','=','documents.user_id')
			->join('profile','profile.user_id','=','documents.user_id')
			->select(DB::raw('CONCAT(first_name, " ", last_name) AS name,employee_code,document_title,expiry_date,documents.user_id'))
			->get();
		//$empdepend_expire_count = Dependent::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")->count();	
			
		$col_data=array();
        $col_heads = array(
				trans('messages.Option'),
                trans('messages.Employee Code'),
                trans('messages.Employee'),
                trans('messages.Type'),
				trans('messages.Name'),
                trans('messages.Expiry Date'));
				
		foreach ($docexpire_list as $doc){
            $col_data[] = array(
					'<div class="btn-group btn-group-xs">'.
                    '<a href="employee/'.$doc->user_id.'#document" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-eye"></i></a> '.'</div>',
                    $doc->employee_code ? $doc->employee_code : '' ,
                    $doc->name,
					'Document',
                    $doc->document_title,
                    Helper::showDate($doc->expiry_date)
                    );
        }
		$empdepend_list = Dependent::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")
			->join('users','users.id','=','dependents.user_id')
			->join('profile','profile.user_id','=','dependents.user_id')
			->select(DB::raw('CONCAT(first_name, " ", last_name) AS name,employee_code,dependents.name as vrname,relation,expiry_date,dependents.user_id'))
			->get();		
		foreach ($empdepend_list as $edep){
            $col_data[] = array(
					'<div class="btn-group btn-group-xs">'.
                    '<a href="employee/'.$edep->user_id.'#dependent" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-eye"></i></a> '.'</div>',
                    $edep->employee_code ? $edep->employee_code : '' ,
                    $edep->name,
					'Dependent',
                    $edep->vrname.'('.$edep->relation.')',
					Helper::showDate($edep->expiry_date)
                    );
        }
		Helper::writeResult($col_data);		

        return view('expirelist',compact(
            'docexpire_count','col_heads'
            ));
   }
}