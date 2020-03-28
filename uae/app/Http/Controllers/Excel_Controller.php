<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EmployeeRequest;

use App\Http\Requests\EmployeeProfileRequest;

use App\Classes\Helper;

use App\User;

use App\Template;

use Entrust;

use Auth;

use Config;

use App\Department;

use App\Product_master;
use App\Alias;//by Dev@4489
use App\Location;//by Dev@4489
use App\EmployeeAsset;//by Dev@4489

use App\DocumentType;

use Image;

use Activity;

use File;

use Mail;

use DB;



class Excel_Controller extends Controller

{

  protected $form = 'employee-form';
  
  public function mis_bill_report(Product_master $product_master){
      
      
        $product_outs = DB::select(DB::raw(" select '1.January 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =1
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '2.February 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =2
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '3.March 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =3
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '4.April 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =4
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '5.May 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =5
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '6.June 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =6
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '7.July 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =7
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '8.August 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =8
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '9.September 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =9
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '10.October 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =10
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '11.November 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =11
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
  union all
  select '12.December 2019' as month,sum(final.total_amt)total_amt,sum(final.total_weight)total_weight from(
  select sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight,is_bill,
  (select sum(net_amt) from bill_tran WHERE bill_tran.bill_no=is_bill) total_amt
  FROM `product_out` 
  WHERE `is_bill` <>0
  AND `category_out` = 'F'
  AND MONTH( date ) =12
  and YEAR(date)=2019
  AND (`title` like  'ECO+%' 
  or `title` like  'SG-%'
  or `title` like  'HG-%'
  or `title` like  'BB-%'
  or `title` like  'SP-%'
  or `title` like  'MG-%'
  or `title` like  'WG-%'
  or `title` like  'WB-%')
  GROUP by is_bill
  )final
              "));
      //dd($product_outs);

     /* $product_out =DB::table('product_out')->select('challan_no','quantity','is_bill','unit','date',
                DB::raw( 'CASE WHEN (unit = "kg") THEN (quantity) ELSE (quantity*.455) END as weight') )
                    //->where('title','like','SG-%')'quantity*.455 as weight'
                    ->where('category_out','F')
                    ->where('is_bill','!=',0)
                    ->get();*/

       

       // dd($mis_data);
        $col_data=array();

        $col_heads = array(                
                'Month',              
'Total Sales(kg)',
               'Bill_Amount(Tk)',
               'Per/Kg');

        $token = csrf_token();

        foreach ($product_outs as $product_outs){

             if($product_outs->total_amt > 0)
                  {
              $col_data[] = array(
                  $product_outs->month,                 

                   
 number_format($product_outs->total_weight,2),
                    number_format($product_outs->total_amt,0),
                    number_format($product_outs->total_amt/$product_outs->total_weight,0),
                    );    
                  }
               else{
                   $col_data[] = array(
                  $product_outs->month,                 

                   
 number_format($product_outs->total_weight,2),
                    number_format($product_outs->total_amt,0),
                    0,
                    );    
               }
               
            }



        Helper::writeResult($col_data);



        return view('report.mis_bill_report',compact('col_heads'));

  }
  public function mis_report(){
      
     
        $product_outs = DB::select(DB::raw("select '1.January' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=1
and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where MONTH(date)=1 and YEAR(date)=2019 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2019 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2019 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where 
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and YEAR(date)=2019 and MONTH(date)=1)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) =1
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)

union all

select '2.February' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=2 and `category_out`='F' and YEAR(date)=2019 and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=2 and `category_out`='F' and YEAR(date)=2019 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where MONTH(date)=2 and YEAR(date)=2019 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2019 and  `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and YEAR(date)=2019 and MONTH(date)=2)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) =2
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
      union all
     select '3 . March' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=3 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=3 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where   MONTH(date)=3 and `category_out`='F' and YEAR(date)=2019 and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where MONTH(date)=3 and `category_out`='F' and YEAR(date)=2019 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2019 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where MONTH(date)=3 and `category_out`='F' and YEAR(date)=2019 and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2019 and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2019 and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and YEAR(date)=2019 and MONTH(date)=3 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) = 3
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
    union all
    select '4 . April' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=4 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2019 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=4 and `category_out`='F' and YEAR(date)=2019 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=4 and `category_out`='F' and YEAR(date)=2019 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where 
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and YEAR(date)=2019 and MONTH(date)=4 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 4
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '5 . May' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=5 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=5 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2019 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2019 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2019 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where 
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and MONTH(date)=5 and YEAR(date)=2019 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 5
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '6 . June' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=6 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=6 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2019 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2019 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2019 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where 
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and MONTH(date)=6 and YEAR(date)=2019)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 6
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '7 .July' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=7 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=7 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2019 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2019 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2019 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and MONTH(date)=7 and YEAR(date)=2019)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 7
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '8 . August' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=8 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=8 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2019 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2019 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2019 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where 
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and MONTH(date)=8 and YEAR(date)=2019)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 8
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '9.September' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=9 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=9 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2019 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2019 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2019 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and MONTH(date)=9 and YEAR(date)=2019)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 9
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '10.October' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=10 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=10 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'BB-%' and YEAR(date)=2019 )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'SP-%' and YEAR(date)=2019 )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'MG-%' and YEAR(date)=2019 )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'WG-%' and YEAR(date)=2019 )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'WB-%' and YEAR(date)=2019 )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'ECO+%' and YEAR(date)=2019 )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where 
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and MONTH(date)=10 and YEAR(date)=2019)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 10
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '11.November' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=11 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=11 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=11 and YEAR(date)=2019 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2019 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2019 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2019 and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2019 and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2019 and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where 
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and MONTH(date)=11 and YEAR(date)=2019)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 11
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '12.December' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=12 and YEAR(date)=2019 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=12 and YEAR(date)=2019 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=12 and `category_out`='F' and `title` like  'BB-%' and YEAR(date)=2019 )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2019 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2019 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2019 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2019 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where 
(`title` like  'WG-%' or `title` like  'ECO+%' or `title` like  'WB-%' or `title` like  'MG-%' or `title` like  'SP-%' or `title` like  'SG-%' or `title` like  'HG-%' or `title` like  'BB-%') and
`category_out`='F' and YEAR(date)=2019 and MONTH(date)=12 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 12
and YEAR(date)=2019
GROUP BY product_out.is_bill
)bill)bill_final
)
              "));
      //dd($product_outs);

     /* $product_out =DB::table('product_out')->select('challan_no','quantity','is_bill','unit','date',
                DB::raw( 'CASE WHEN (unit = "kg") THEN (quantity) ELSE (quantity*.455) END as weight') )
                    //->where('title','like','SG-%')'quantity*.455 as weight'
                    ->where('category_out','F')
                    ->where('is_bill','!=',0)
                    ->get();*/

       

       // dd($mis_data);
        $col_data=array();

        $col_heads = array(                
                'Month',
                
               'SG+HG(Kg)',
               '%',
               'Book Black(Kg)',
               '%',
               'Sp.Clr(Kg)',
               '%',
               'MG(Kg)',
               '%',
               'Web P.Clr.(Kg)',
               '%',
               'Web Black(Kg)',
               '%',
               'Eco(Kg)',
               '%','Total Weight');

        $token = csrf_token();

        foreach ($product_outs as $product_outs){

             
                  
              $col_data[] = array(
                  $product_outs->month,                 

                    number_format($product_outs->SG_HG_WEIGHT,2),
                    number_format($product_outs->SG_HG_PER,2),
                    number_format($product_outs->bb_weight,2),
                    number_format($product_outs->bb_per,2),
                    number_format($product_outs->sp_weight,2),
                    number_format($product_outs->sp_per,2),
                    number_format($product_outs->mg_weight,2),
                    number_format($product_outs->mg_per,2),
                    number_format($product_outs->wg_weight,2),
                    number_format($product_outs->wg_per,2),
                    number_format($product_outs->wb_weight,2),
                    number_format($product_outs->wb_per,2),
                    number_format($product_outs->eco_weight,2),
                    number_format($product_outs->eco_per,2),
 number_format($product_outs->RCVD,2),
                    );    

            }



        Helper::writeResult($col_data);



        return view('report.mis_sales_report',compact('col_heads'));

  }
  public function mis_report_2018(){
      
     
        $product_outs = DB::select(DB::raw("select '1.January' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=1
and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where MONTH(date)=1 and YEAR(date)=2018 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2018 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2018 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2018 and MONTH(date)=1)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) =1
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)

union all

select '2.February' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=2 and `category_out`='F' and YEAR(date)=2018 and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=2 and `category_out`='F' and YEAR(date)=2018 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where MONTH(date)=2 and YEAR(date)=2018 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2018 and  `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2018 and MONTH(date)=2)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) =2
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
      union all
     select '3 . March' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=3 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=3 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where   MONTH(date)=3 and `category_out`='F' and YEAR(date)=2018 and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where MONTH(date)=3 and `category_out`='F' and YEAR(date)=2018 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2018 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where MONTH(date)=3 and `category_out`='F' and YEAR(date)=2018 and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2018 and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2018 and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2018 and MONTH(date)=3 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) = 3
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
    union all
    select '4 . April' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=4 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2018 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=4 and `category_out`='F' and YEAR(date)=2018 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=4 and `category_out`='F' and YEAR(date)=2018 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2018 and MONTH(date)=4 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 4
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '5 . May' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=5 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=5 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2018 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2018 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2018 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=5 and YEAR(date)=2018 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 5
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '6 . June' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=6 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=6 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2018 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2018 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2018 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=6 and YEAR(date)=2018)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 6
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '7 .July' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=7 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=7 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2018 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2018 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2018 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=7 and YEAR(date)=2018)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 7
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '8 . August' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=8 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=8 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2018 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2018 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2018 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=8 and YEAR(date)=2018)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 8
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '9.September' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=9 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=9 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2018 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2018 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2018 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=9 and YEAR(date)=2018)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 9
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '10.October' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=10 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=10 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'BB-%' and YEAR(date)=2018 )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'SP-%' and YEAR(date)=2018 )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'MG-%' and YEAR(date)=2018 )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'WG-%' and YEAR(date)=2018 )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'WB-%' and YEAR(date)=2018 )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'ECO+%' and YEAR(date)=2018 )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=10 and YEAR(date)=2018)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 10
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '11.November' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=11 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=11 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=11 and YEAR(date)=2018 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2018 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2018 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2018 and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2018 and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2018 and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=11 and YEAR(date)=2018)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 11
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '12.December' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=12 and YEAR(date)=2018 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=12 and YEAR(date)=2018 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=12 and `category_out`='F' and `title` like  'BB-%' and YEAR(date)=2018 )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2018 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2018 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2018 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2018 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2018 and MONTH(date)=12 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 12
and YEAR(date)=2018
GROUP BY product_out.is_bill
)bill)bill_final
)
              "));
      //dd($product_outs);

     /* $product_out =DB::table('product_out')->select('challan_no','quantity','is_bill','unit','date',
                DB::raw( 'CASE WHEN (unit = "kg") THEN (quantity) ELSE (quantity*.455) END as weight') )
                    //->where('title','like','SG-%')'quantity*.455 as weight'
                    ->where('category_out','F')
                    ->where('is_bill','!=',0)
                    ->get();*/

       

       // dd($mis_data);
        $col_data=array();

        $col_heads = array(                
                'Month',
                
               'SG+HG(Kg)',
               '%',
               'Book Black(Kg)',
               '%',
               'Sp.Clr(Kg)',
               '%',
               'MG(Kg)',
               '%',
               'Web P.Clr.(Kg)',
               '%',
               'Web Black(Kg)',
               '%',
               'Eco(Kg)',
               '%','Total Weight');

        $token = csrf_token();

        foreach ($product_outs as $product_outs){

             
                  
              $col_data[] = array(
                  $product_outs->month,                 

                    number_format($product_outs->SG_HG_WEIGHT,2),
                    number_format($product_outs->SG_HG_PER,2),
                    number_format($product_outs->bb_weight,2),
                    number_format($product_outs->bb_per,2),
                    number_format($product_outs->sp_weight,2),
                    number_format($product_outs->sp_per,2),
                    number_format($product_outs->mg_weight,2),
                    number_format($product_outs->mg_per,2),
                    number_format($product_outs->wg_weight,2),
                    number_format($product_outs->wg_per,2),
                    number_format($product_outs->wb_weight,2),
                    number_format($product_outs->wb_per,2),
                    number_format($product_outs->eco_weight,2),
                    number_format($product_outs->eco_per,2),
 number_format($product_outs->RCVD,2),
                    );    

            }



        Helper::writeResult($col_data);



        return view('report.mis_sales_report_2018',compact('col_heads'));

  }
  public function mis_report_2017(){
      
     
        $product_outs = DB::select(DB::raw("select '1.January' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=1
and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where MONTH(date)=1 and YEAR(date)=2017 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2017 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2017 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=1 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2017 and MONTH(date)=1)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) =1
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)

union all

select '2.February' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=2 and `category_out`='F' and YEAR(date)=2017 and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=2 and `category_out`='F' and YEAR(date)=2017 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where MONTH(date)=2 and YEAR(date)=2017 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2017 and  `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=2 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2017 and MONTH(date)=2)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) =2
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
      union all
     select '3 . March' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=3 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=3 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where   MONTH(date)=3 and `category_out`='F' and YEAR(date)=2017 and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where MONTH(date)=3 and `category_out`='F' and YEAR(date)=2017 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2017 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where MONTH(date)=3 and `category_out`='F' and YEAR(date)=2017 and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2017 and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=3 and `category_out`='F' and YEAR(date)=2017 and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2017 and MONTH(date)=3 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no
AND `category_out` = 'F'
AND MONTH( date ) = 3
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
    union all
    select '4 . April' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=4 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2017 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=4 and `category_out`='F' and YEAR(date)=2017 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=4 and `category_out`='F' and YEAR(date)=2017 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=4 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2017 and MONTH(date)=4 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 4
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '5 . May' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=5 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=5 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2017 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2017 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2017 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=5 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=5 and YEAR(date)=2017 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 5
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '6 . June' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=6 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=6 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2017 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2017 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2017 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=6 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=6 and YEAR(date)=2017)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 6
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '7 .July' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=7 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=7 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2017 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2017 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2017 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=7 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=7 and YEAR(date)=2017)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 7
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '8 . August' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=8 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=8 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2017 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2017 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2017 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=8 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=8 and YEAR(date)=2017)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 8
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '9.September' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=9 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=9 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2017 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2017 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2017 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=9 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=9 and YEAR(date)=2017)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 9
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '10.October' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=10 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=10 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'BB-%' and YEAR(date)=2017 )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'SP-%' and YEAR(date)=2017 )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'MG-%' and YEAR(date)=2017 )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'WG-%' and YEAR(date)=2017 )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'WB-%' and YEAR(date)=2017 )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=10 and `category_out`='F' and `title` like  'ECO+%' and YEAR(date)=2017 )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=10 and YEAR(date)=2017)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 10
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '11.November' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=11 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=11 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=11 and YEAR(date)=2017 and `category_out`='F' and `title` like  'BB-%'  )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2017 and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2017 and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2017 and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2017 and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=11 and `category_out`='F' and YEAR(date)=2017 and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and MONTH(date)=11 and YEAR(date)=2017)total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 11
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
union all
select '12.December' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=12 and YEAR(date)=2017 and `category_out`='F' and `title` like 'SG-%' )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=12 and YEAR(date)=2017 and `category_out`='F' and `title` like 'HG-%' )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=12 and `category_out`='F' and `title` like  'BB-%' and YEAR(date)=2017 )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2017 and `category_out`='F' and `title` like  'SP-%'  )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2017 and `category_out`='F' and `title` like  'MG-%'  )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WG-%'  )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2017 and `category_out`='F' and `title` like  'WB-%'  )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=12 and YEAR(date)=2017 and `category_out`='F' and `title` like  'ECO+%'  )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' and YEAR(date)=2017 and MONTH(date)=12 )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = 12
and YEAR(date)=2017
GROUP BY product_out.is_bill
)bill)bill_final
)
              "));
      //dd($product_outs);

     /* $product_out =DB::table('product_out')->select('challan_no','quantity','is_bill','unit','date',
                DB::raw( 'CASE WHEN (unit = "kg") THEN (quantity) ELSE (quantity*.455) END as weight') )
                    //->where('title','like','SG-%')'quantity*.455 as weight'
                    ->where('category_out','F')
                    ->where('is_bill','!=',0)
                    ->get();*/

       

       // dd($mis_data);
        $col_data=array();

        $col_heads = array(                
                'Month',
                
               'SG+HG(Kg)',
               '%',
               'Book Black(Kg)',
               '%',
               'Sp.Clr(Kg)',
               '%',
               'MG(Kg)',
               '%',
               'Web P.Clr.(Kg)',
               '%',
               'Web Black(Kg)',
               '%',
               'Eco(Kg)',
               '%','Total Weight');

        $token = csrf_token();

        foreach ($product_outs as $product_outs){

             
                  
              $col_data[] = array(
                  $product_outs->month,                 

                    number_format($product_outs->SG_HG_WEIGHT,2),
                    number_format($product_outs->SG_HG_PER,2),
                    number_format($product_outs->bb_weight,2),
                    number_format($product_outs->bb_per,2),
                    number_format($product_outs->sp_weight,2),
                    number_format($product_outs->sp_per,2),
                    number_format($product_outs->mg_weight,2),
                    number_format($product_outs->mg_per,2),
                    number_format($product_outs->wg_weight,2),
                    number_format($product_outs->wg_per,2),
                    number_format($product_outs->wb_weight,2),
                    number_format($product_outs->wb_per,2),
                    number_format($product_outs->eco_weight,2),
                    number_format($product_outs->eco_per,2),
 number_format($product_outs->RCVD,2),
                    );    

            }



        Helper::writeResult($col_data);



        return view('report.mis_sales_report_2017',compact('col_heads'));

  }
  public function mis_in_out()
  {
     $product_outs = DB::select(DB::raw("
         select '1.January' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.product_code=b.code and a.`category_in`='P' and a.product_code=b.code  and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 1)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.product_code=b.code and a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 1)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 1)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 1)paste_out
union all
select '2.February' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.product_code=b.code and a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 2)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.product_code=b.code and a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 2)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 2)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 2)paste_out
union all

select '3.March' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.product_code=b.code and a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 3)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.product_code=b.code and a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 3)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 3)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 3)paste_out
union all
select '4.April' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and   a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 4)paste_in,
(SELECT sum(a.quantity) raw_in_weight FROM product_in a ,Product_master b where  a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and
date_format(a.date,'%y')= date_format(curdate(),'%y')  and date_format(a.date,'%m')= 4)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 4)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 4)paste_out
union all
select '5.May' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 5)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 5)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 5)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 5)paste_out
union all
select '6.June' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 6)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 6)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 6)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 6)paste_out
union all
select '7.July' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 7)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 7)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 7)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 7)paste_out
union all
select '8.August' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 8)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 8)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 8)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 8)paste_out
union all
select '9.Septembar' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 9)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 9)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 9)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 9)paste_out
union all
select '10.October' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 10)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 10)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 10)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 10)paste_out
union all
select '11.November' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 11)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 11)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 11)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 11)paste_out
union all
select '12.December' R_month,raw_in.raw_in_weight,raw_out.raw_out_weight,paste_in.paste_in_weight
,paste_out.paste_out_weight from 
(SELECT sum(quantity) paste_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='P' and a.product_code=b.code and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 12)paste_in,
(SELECT sum(quantity) raw_in_weight FROM product_in a ,Product_master b 
where a.product_code=b.code and a.status=1  and  a.`category_in`='R' and b.`unit`='kg' and date_format(a.date,'%y')= date_format(curdate(),'%y') and date_format(a.date,'%m')= 12)raw_in,
(SELECT sum(quantity) raw_out_weight FROM product_out a  
where `category_out`='R' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 12)raw_out,
(SELECT sum(quantity) paste_out_weight FROM product_out  
where `category_out`='P' and `unit`='kg' and date_format(date,'%y')= date_format(curdate(),'%y') and date_format(date,'%m')= 12)paste_out

     "));
 $col_heads = array(

                
                'Reporting Month',
                'Raw In',

               'Raw Out',
               'Paste In',
               'Paste Out'
               );

        $token = csrf_token();

        foreach ($product_outs as $product_outs){

             
                
              $col_data[] = array(
                  $product_outs->R_month,
                  number_format($product_outs->raw_in_weight,2).'kg',                    
                    number_format($product_outs->raw_out_weight,2).'kg',
                    number_format($product_outs->paste_in_weight,2).'kg',                  
                    number_format($product_outs->paste_out_weight,2).'kg'
                    
                    );    

            }



        Helper::writeResult($col_data);



        return view('report.mis_in_out',compact('col_heads'));
  }
  public function excel_report(Product_master $product_master){
      $employees = $product_master->where('status',1)
              ->orderBy('order','desc')->get();
        $col_data=array();

        $col_heads = array(

                
                'Order',
                'Category ID',

               'Product Name',
               'Product Code',
               'Selling Price',
               'Stock Available');

        $token = csrf_token();

        foreach ($employees as $employee){

             
                    if($employee->category=='F')
                      $category ='Finishing Goods';
                    else if($employee->category=='R')
                      $category ='Raw Materials';
                    else
                      $category ='Paste'; 
              $col_data[] = array(
                  $employee->order,
                  $category,                    

                    $employee->title,

                    $employee->code,

                    

                    $employee->selling_price,
                    
                    
					          
                    $employee->stock
                    
                    
                    );    

            }



        Helper::writeResult($col_data);



        return view('report.excel_report',compact('col_heads'));

  }
  public function bill_report()
  {
     $from_date=date('y-m-d');
    $to_date=date('y-m-d');
    $bill_no=DB::table('bill_tran')->select('bill_no')->distinct()->get();
    //dd($bill_no);
    $bill=DB::table('bill_tran')->where('bill_date','=',date('y-m-d'))->get();
    return view('report.bill_report',compact('from_date','to_date'))->with('bill',$bill)->with('bill_no',$bill_no);
  }
  public function post_bill_report(Request $request)
  {
    //dd($request->all());
    $bill_no=DB::table('bill_tran')->select('bill_no')->distinct()->get();
    $bill_number=$request->input('bill_no');
    $from_date=$request->input('from_date');
    $to_date=$request->input('to_date');
    if(!empty($bill_number))
    {
        $bill=DB::table('bill_tran')->where('bill_no','=',$bill_number)->get();
    }
    else
    {
    $bill=DB::table('bill_tran')->where('bill_date','>=',$from_date)->where('bill_date','<=',$to_date)->get();
    }
    return view('report.bill_report',compact('from_date','to_date'))->with('bill',$bill)->with('bill_no',$bill_no);
  }
   public function view_bill_report($id)
  {
    //DB::table('bill_register')->where('bill_no','=',$id)->where('bill_no','=',null)->update(['bill_no'=>$bill_no]);

    $challan_nos = DB::table('bill_register')->select('challan_no')->where('bill_no','=',$id)->get();
    //dd($challan_no);
    /*foreach ($challan_nos as $challan_no ) {
      DB::table('product_out')->where('status','=',1)->where('challan_no','=',$challan_no->challan_no)
            ->where('is_bill','=',0)
            ->update(['is_bill'=>$id]);  
    }*/
    
    $bill_product = DB::table('product_out')
         
            ->select('product_out.product_code','product_out.selling_price',DB::raw('sum(product_out.selling_price*product_out.quantity) AS selling_price1')
            ,DB::raw('sum(product_out.quantity) AS quantity'),'bill_register.ref_no','product_out.id AS id','Product_master.title','Product_master.id AS id1','product_out.challan_no','Product_master.unit',
            'product_out.category_out')
          ->join('Product_master','Product_master.code','=','product_out.product_code')
          ->join('bill_register','bill_register.challan_no','=','product_out.challan_no')
          ->where('bill_register.bill_no','=',$id)
          ->where('bill_register.status','=',1)
          ->where('product_out.status','=',1)      
          ->groupBy('product_out.product_code')   
          ->orderBy('Product_master.order','asc')
          ->get();        

    //dd($bill_product);
    $bill_details = DB::table('bill_tran')->select('bill_tran.id','bill_tran.order_no','bill_tran.id','bill_tran.id'
                  ,'bill_tran.bill_no','bill_tran.ref_no','bill_tran.net_amt','bill_tran.total_amt','bill_tran.dis_percent',
                  'bill_tran.less_amt','bill_tran.bill_date',
                  'customer_info.name','customer_info.address')
                  ->where('bill_tran.bill_no','=',$id)
                  ->join('customer_info','customer_info.id','=','bill_tran.customer_id')
                  ->first();
    $bill_detail = $bill_details;
//dd($challan_nos);
    $html = view('bill.invoice',compact('bill_detail',$bill_detail))
    ->with('product',$bill_product)
    ->with('bill_details',$bill_details)
    ->with('challan_no',$challan_nos)->render();
$data['bill_detail']=$bill_detail;
$data['product']=$bill_product;
$data['bill_details']=$bill_details;
$data['challan_no']=$challan_nos;
$data['bill_detail']=$bill_detail;



ini_set('memory_limit','750M');
 $pdf = \App::make('dompdf.wrapper');
 
 
 $html = view('bill.invoice',  $data)->render();
    //dd($html);
    $html = preg_replace('/>\s+</', '><', $html);
    //return PDF::loadHtml($html);
    
     $pdf->loadHTML($html);
    return $pdf->stream();



  }
}