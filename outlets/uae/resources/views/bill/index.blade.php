@extends('layouts.default')



	@section('content')
	
<style type="text/css">
	tbody tr td{
		padding: 1px!important;margin: 0px!important;
		padding-left: 10px!important;
	}
	 table.table-hover {
        display: table;
        width: 100%;
    }
    table.table-hover thead, table.table-hover tbody {
        float: left;
        width: 100%;
    }
    table.table-hover tbody {
        overflow: auto;
        height: 250px;
    }
    
    table.table-hover th, table.table-hover td {
        
    }
</style>
		<div class="row" ng-app>

			<div class="">

				<div class="panel panel-default col-sm-4"  style="background-color:;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><strong>  Bill Register for 
				              {!! \App\Classes\Helper::getBranchName() !!}
				        </strong></center>
					</div>
					<br/>
					<form method="post" action="{{url('post_bill')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}
    				  	<div class="col-md-12">
                          
						  
						 <div class="form-group">

						    {!! Form::label('bill_no',trans('messages.ref_no'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9">
						    	@if(!empty($ref_no))
						    	<input type="text" name="bill_no" class="form-control" value="{{$ref_no}}" disabled="disabled">
						    	<input type="hidden" name="ref_no" value="{{$ref_no}}">
						    	@else
								{!! Form::input('text','bill_no','',['class'=>'form-control','placeholder'=>'Bill No'])!!}
								@endif
							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('challan_no',trans('messages.challan_no'),['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

									<input type="text" name="challan_no" class="form-control input-sm" placeholder="Enter Challan No" autofocus>

							</div>

						  </div>
						  
						  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.add_challan'),['class' => 'pull-right btn btn-sm input-sm btn-success']) !!}
						  
					</div>
    				  	
                        
                        
						  

					{!! Form::close() !!}
					
				</div>

			</div>
			<div class="container" >
			@if(!empty($product))
			 <div class=" row "  >
                      <div class="panel panel-default  col-md-8	" id="table-scroll"  style="background-color:#D3D3D3;color:black;">
	                      <div class="panel-heading" style="background-color:black;color:white;">
							<center><strong> Product List  </strong></center>
						</div>
                        <table class="table table-hover">
                        		 <thead>
			                            <tr>
			                             <th class="text-left" width="50px">Challan</th>
			                              <th class="text-left" width="150px">Product Type</th>
			                              <th style="" class="text-left" width="200px">Title</th>
			                              <th style="" class="text-left" width="80px">Product Code</th>
			                              
			                              <th style="" class="text-left" width="100px">Price</th>
			                              <th style="" class="text-left" width="100px">Qty</th>
			                              <th style="" class="text-left" width="100px">Sub Total</th>
			                              
			                            </tr>
			                          </thead>
			                          <tbody>
			                          
			                          <?php $total_amount=0; ?>
			                          @foreach($product as $product)
			                            <tr>
			                            <td width="60px">{{$product->challan_no}}</td>
			                              <td width="150px">
			                              @if($product->category_out=='R')
			                              Raw Material's
			                              @elseif($product->category_out=='F')
			                              Finishing Goods
			                              @else
			                              Paste
			                              @endif
			                              </td>

			                              <td class="text-left" width="200px">{{$product->title}}</td>
			                              <td class="text-left" width="80px"> {{($product->product_code)  }}</td>
			                              <td class="text-left" width="110px"> ৳ {{number_format($product->selling_price,2)}}</td>

											<td class="text-left" width="100px"> {{($product->quantity)}} {{($product->unit)}}</td>
											<td style="" class="text-left" width="100px">
											৳ {{number_format($product->quantity*$product->selling_price,2)}}
											<?php $total_amount=$total_amount+$product->quantity*$product->selling_price; ?>
											</td>

			                              
			                            </tr>
			                           @endforeach 
			                            
			                          </tbody>
                          			
                          
                        </table>
						<div class="panel  col-sm-12" style="background-color:#D3D3C9;padding-bottom:20px;">
							<div class="panel-heading" >
							<br/>
						<form method="post" action="{{url('post_invoice')}}">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="ref_no" value="{{$ref_no}}">
								<div class="row">
									<div class="col-md-7">
										<div class="col-md-3">
												<label>Order No </label>
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control input-sm" name="order_no"  required><br/>
												</div>
											<div class="col-md-3">
												<label>Select Customer</label>
											</div>
											<div class="col-md-9">
												<select name="customer_id" class="form-control col-md-6 select2me" required>
												<option value="">Select Customer Name</option>
													@foreach($customer_info as $customer_info)
													<option value="{{$customer_info->id}}">{{$customer_info->name}}</option>
													@endforeach
												</select>

											</div>
										
											
											
										
										
									</div>
									<div class="col-md-5" ng-controller="TodoCtrl">
										<div class="row">
											<div class="col-md-6">
												<label>Total Amount</label>
											</div>
											<div class="col-md-6">
												<input type="text" disabled="disabled" class="form-control input-sm"   name="total_amount" 
												id="total_amount"  id="total_amount" value=<?php echo ($total_amount); ?>  required>
												<input type="hidden"  name="total_amount" 
												id="total_amount"  id="total_amount" value=<?php echo ($total_amount); ?>  >
											</div>
											
										</div><br/>
										<div class="row">
											<div class="col-md-6">
												<label>Total Discount(%)</label>
											</div>
											<div class="col-md-6">
												<input type="text" ng-model="two" class="form-control input-sm" name="discount" id="discount" required>
											</div>
											
										</div><br/>
										<div class="row">
											<div class="col-md-6">
												<label>Total Less</label>
											</div>
											<div class="col-md-6">
												<input type="text" ng-model="less" class="form-control input-sm" name="less" id="less"  required>
											</div>
											
										</div><br/>
										<div class="row">
											<div class="col-md-6">
												<label>Net Amount</label>
											</div>
											<div class="col-md-6">
												<input type="text" class="form-control input-sm" value="@{{total()}}"  name="net_amout" disabled="disabled" required>
												<input type="hidden" class="form-control input-sm" value="@{{total()}}"  name="net_amout"  required>
												
											</div>

										</div><br/>
										
										<div class="row">
											<div class="col-md-6">
												
											</div>

											<div class="col-md-6">
												<button type="submit" class="btn btn-success" value="">Generate Invoice</button>
											</div>
											
											
										</div>
									</div>
								</div>
							</form>
							</div>
						</div>
                      </div>

                    </div><!--end .row -->
			@endif
			</div>

		</div>


	@stop