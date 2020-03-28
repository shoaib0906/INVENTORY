<?php
namespace App;
use Eloquent;

class Product_out extends Eloquent {

	protected $fillable = [
							'challan_no' ,
							'branch_id',
				            'category_out',
				            'product_code', 
				            'quantity',
				            'selling_price',
				            'status',
				            'date',
				            'title',
				            'unit'
						];
	protected $primaryKey = 'id';
	protected $table = 'product_out';

    
}
