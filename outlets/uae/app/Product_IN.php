<?php
namespace App;
use Eloquent;

class Product_IN extends Eloquent {

	protected $fillable = [
							'branch_id',
							'lott_no' ,
				            'category_in',
				            'product_code', 
				            'quantity',
				            'cost_price',
				            'status',
				            'date',
				            'unit'
						];
	protected $primaryKey = 'id';
	protected $table = 'product_in';

    
}
