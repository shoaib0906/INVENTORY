@extends('layouts.default')



	@section('content')

		<div class="row ">

			<div class="">

				<div class="panel panel-default col-sm-4"  style="background-color:;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><strong>  Product IN for 
             {!! \App\Classes\Helper::getBranchName() !!}</strong></center>
					</div>
					<br/>
					<form method="POST" action="{{url('post_product_in')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}
    				  	<div class="col-md-12">
                          
						  
						 <div class="form-group">

						    {!! Form::label('lott_no',trans('messages.lott_no'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9">
						    	@if(isset($lot_no_in))
						    	<input type="text" name="lott_no" class="inputs form-control" value="{{$lot_no_in}}" autofocus>
						    	@else
								<input type="text" name="lott_no" class=" inputs form-control" value="" autofocus placeholder="Enter Lot No.">
								@endif
							</div>

						  </div>
						
						

						  <div class="form-group">

						    {!! Form::label('last_name',trans('messages.Product_code'),['class' => 'col-sm-3 input-sm control-label'])!!}
						     <div class="col-sm-9" >
						     	<select class="form-control inputs input-xlarge input-sm select2me" name="product_code" 
						     	id="category_product_code">
						     	<option value="-1">Select Product Code</option>
								@if(!empty($category_pro_code))
								@foreach($category_pro_code as $category_pro_code)
								<option value="{{$category_pro_code->code}}">{{$category_pro_code->code}} , {{$category_pro_code->title}}</option>
								@endforeach
								@endif
						     	</select>
							</div>
						    

						  </div>
						  <div class="form-group">

						    {!! Form::label('quantity',trans('messages.quantity'),['class' => 'col-sm-3 inputs input-sm control-label'])!!}

						   	<div class="col-sm-9">

								{!! Form::input('text','quantity','',['class'=>'form-control inputs input-sm','placeholder'=>'Enter Quantity'])!!}

							</div>

						  </div>
						  <div class="form-group" id="cost_price_div"  style="display:none;">

						    {!! Form::label('cost_price','Cost Price',['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								
								<input type="text" name="cost_price" class="inputs form-control" id="cost_price" placeholder="Enter Cost Price" ><br/>
								
								
							</div>
							 {!! Form::label('cost_price','Include Vat',['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">
								<input type="checkbox" name="incl_vat" class="check-box" id="cost_price" checked="checked" disabled="true">
							</div>
						  </div>
						    <div class="form-group">

						    {!! Form::label('date',trans('messages.date'),['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">
						   	@if(!empty($in_date))
						   	<input type="text" name="date" class="form-control inputs datepicker-input input-sm" value="{{$in_date}}" >
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
			<div class="container" id="product_gridbind">
			@if(!empty($product))
			 <div class=" row " id="table-wrapper" >
                      <div class="panel panel-default  col-md-8	" id="table-scroll"  style="background-color:#D3D3D3;color:black;">
	                      <div class="panel-heading" style="background-color:black;color:white;">
							<center><strong> Product List  </strong></center>
						</div>
                        <table class="table table-hover">
                          
                          <br/>
                          @include('common.datatable',['col_heads' => $col_heads])
                          

                            
                          </tbody>
                        </table>
                      </div><!--end .col -->
                    </div><!--end .row -->
			@endif
			</div>

		</div>
	@stop