<?php
namespace App;
use Eloquent;

class Product_master extends Eloquent {

	protected $fillable = [
							'category', 'title', 'code', 'selling_price', 'unit', 'stock', 'status', 'order'
						];
	protected $primaryKey = 'id';
	protected $table = 'Product_master';

    
}
