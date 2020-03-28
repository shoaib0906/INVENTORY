select '7' as month,total.total_weight AS RCVD,sg_hg.sg_hg_weight AS SG_HG_WEIGHT,sg_hg.sg_hg_weight*100/total.total_weight  SG_HG_PER,
bb.bb_weight AS bb_weight,bb.bb_weight*100/total.total_weight AS bb_per,
sp.sp_weight AS sp_weight,sp.sp_weight*100/total.total_weight AS sp_per,
mg.mg_weight AS mg_weight,mg.mg_weight*100/total.total_weight AS mg_per,
wg.wg_weight AS wg_weight,wg.wg_weight*100/total.total_weight AS wg_per,
wb.wb_weight AS wb_weight,wb.wb_weight*100/total.total_weight AS wb_per,
eco.eco_weight AS eco_weight,eco.eco_weight*100/total.total_weight AS eco_per,
bill_final.total_bill_amt as bill_amt,bill_final.total_bill_amt/total.total_weight as per_kg
from (
(select 'SG- HG-',(coalesce(sg.sg_weight,0)+coalesce(hg.hg_weight,0)) as sg_hg_weight from ( (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sg_weight FROM `product_out` where MONTH(date)=$month and YEAR(date)=$year and `category_out`='F' and `title` like 'SG-%' AND product_out.branch_id=$branch_id )sg, (SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as hg_weight FROM `product_out` where MONTH(date)=$month and YEAR(date)=$year and `category_out`='F' and `title` like 'HG-%' AND product_out.branch_id=$branch_id )hg))sg_hg,

(SELECT 'BB-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as bb_weight FROM `product_out` where  MONTH(date)=$month and YEAR(date)=$year and `category_out`='F' and `title` like  'BB-%' AND product_out.branch_id=$branch_id )bb,

(SELECT 'SP-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as sp_weight FROM `product_out` where  MONTH(date)=$month and YEAR(date)=$year and `category_out`='F' and `title` like  'SP-%' AND product_out.branch_id=$branch_id )sp, 

(SELECT 'MG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as mg_weight FROM `product_out` where  MONTH(date)=$month and YEAR(date)=$year and `category_out`='F' and `title` like  'MG-%' AND product_out.branch_id=$branch_id )mg,   

(SELECT 'WG',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wg_weight FROM `product_out` where  MONTH(date)=$month and YEAR(date)=$year and `category_out`='F' and `title` like  'WG-%' AND product_out.branch_id=$branch_id )wg,   

(SELECT 'WB',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as wb_weight FROM `product_out` where  MONTH(date)=$month and YEAR(date)=$year and `category_out`='F' and `title` like  'WB-%' AND product_out.branch_id=$branch_id )wb,   

(SELECT 'SP',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as eco_weight FROM `product_out` where  MONTH(date)=$month and YEAR(date)=$year and `category_out`='F' and `title` like  'ECO+%' AND product_out.branch_id=$branch_id )eco,  

(SELECT 'SG- + HG-',sum(case when (`unit` = 'kg') then (`quantity`) else (`quantity`*.455) end) as total_weight FROM `product_out` where  `category_out`='F' AND product_out.branch_id=$branch_id and MONTH(date)=$month and YEAR(date)=$year )total,
    
(SELECT  sum( bill.total_bill_amt ) total_bill_amt
FROM (

SELECT 'SG- + HG-', product_out.is_bill bill_no, (
bill_tran.net_amt
)total_bill_amt
FROM `product_out` , `bill_tran`
WHERE product_out.is_bill = bill_tran.bill_no

AND `category_out` = 'F'
AND MONTH( date ) = $month
AND product_out.branch_id=$branch_id
and YEAR(date)=$year
GROUP BY product_out.is_bill
)bill)bill_final
)