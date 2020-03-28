@extends('layouts.default')



	@section('content')
	
		<div class="row " ng-app>

			<div class="">

				<div class="panel panel-default col-sm-3"  style="background-color:;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><strong>  Product Out </strong></center>
					</div>
					<br/>
					<form method="POST" action="{{url('post_product_out')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}
    				  	<div class="col-md-12">
                          
						  
						 <div class="form-group">

						    {!! Form::label('challan_no',trans('messages.challan_no'),['class' => 'col-sm-3 input-sm control-label'])!!}
       
						    <div class="col-sm-9">
						    	@if(!empty($challan_no))
						    	<input type="number" name="challan_no" class="form-control" value="{{$challan_no}}" autofocus>
						    	@else
								<input type="text" name="challan_no" class="form-control" value="" autofocus placeholder="Enter Challan No.">
								@endif
							</div>

						  </div>

						<div class="form-group">

						    {!! Form::label('alias_id',trans('messages.alias_id'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9">

							
							<select class="form-control input-xlarge input-sm select2me" name="category_out" id="caterory_out">
							@if(!empty($category_out))
								@if($category_out == 'R')
								<option value="R" selected="true">Raw Material's</option>
								<option value="F">Finishing Goods</option>
								<option value="P">Paste</option>
								@elseif($category_out == 'F')
								<option value="R" >Raw Material's</option>
								<option value="F" selected="true">Finishing Goods</option>
								<option value="P">Paste</option>
								@elseif($category_out == 'P')
								<option value="R" >Raw Material's</option>
								<option value="F">Finishing Goods</option>
								<option value="P" selected="true">Paste</option>
								@endif
							@else
							<option value="-1">Select Category</option>
								<option value="R">Raw Material's</option>
								<option value="F">Finishing Goods</option>
								<option value="P">Paste</option>
							@endif
							</select>

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('last_name',trans('messages.Product_code'),['class' => 'col-sm-3 input-sm control-label'])!!}
						     <div class="col-sm-9" >
						     	<select class="form-control input-xlarge input-sm select2me" name="product_code" 
						     	id="category_product_code_out">
						     	<option value="-1">Select Product Code</option>
								@if(!empty($category_pro_code))
								@foreach($category_pro_code as $category_pro_code)
								<option value="{{$category_pro_code->code}}">{{$category_pro_code->code}}</option>
								@endforeach
								@endif
						     	</select>
							</div>
						    

						  </div>
						  <div class="form-group" id="sales_price_div">

						    {!! Form::label('price','Price',['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								{!! Form::input('text','price','',['class'=>'form-control input-sm','placeholder'=>'Enter Price'])!!}

							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('quantity',trans('messages.quantity'),['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								{!! Form::input('text','quantity','',['class'=>'form-control input-sm','placeholder'=>'Enter Product Code'])!!}

							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('date',trans('messages.date'),['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								
							@if(!empty($out_date))
						   	<input type="text" name="date" class="form-control inputs datepicker-input input-sm" value="{{$out_date}}" >
						   	@else

								{!! Form::input('text','date','',['class'=>'form-control inputs datepicker-input input-sm','placeholder'=>'Enter Date'])!!}
							@endif
							</div>

						  </div>
						  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.add_product'),['class' => 'pull-right btn btn-sm input-sm btn-success']) !!}
						  
					</div>
    				  	
                        
                        
						  

					{!! Form::close() !!}
					
				</div>

			</div>
			<div class="container" >
			@if(!empty($product))
			 <div class=" row "  >
                      <div class="panel panel-default  col-md-8	" id="table-scroll"  style="background-color:#D3D3D3;color:black;margin-left:2%!important;">
	                      <div class="panel-heading" style="background-color:gray;color:black;">
							<center><strong> Product List  </strong></center>
						</div>
                       <br/>
					@include('common.datatable',['col_heads' => $col_heads])
						
                      </div>

                    </div><!--end .row -->
			@endif
			</div>

		</div>


	@stop