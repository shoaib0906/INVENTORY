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
        height: 485px;
    }
    
    table.table-hover th, table.table-hover td {
        
    }
</style>
		<div class="row">

			<div class="">

				<div class="panel panel-default col-sm-3"  style="background-color:;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><strong> Create Product  </strong></center>
					</div>

					<form method="POST" action="{{url('post_settings')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}

    				  	<div class="col-md-12"> 
    				  	<div class="form-group">

						    {!! Form::label('alias_id',trans('messages.Alias'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9">
							<select class="form-control input-xlarge input-sm select2me" name="category" id="category">
							@if(!empty($category))
								@if($category == 'R')
								<option value="R" selected="true">Raw Material's</option>
								<option value="F">Finishing Goods</option>
								<option value="P">Paste</option>
								@elseif($category == 'F')
								<option value="R" >Raw Material's</option>
								<option value="F" selected="true">Finishing Goods</option>
								<option value="P">Paste</option>
								@elseif($category == 'P')
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

						    {!! Form::label('email',trans('messages.unit'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9 ">

								<select class="form-control input-sm select2me" name="unit">
								<option value="pound">Pound</option>
								<option value="kg">Kg</option>
								<option value="pc">Pcs</option>
								<option value="litre">Litre</option>
								<option value="Lb.">Lb.</option>
								
							</select>
								

							</div>
							<br/>
						  </div>
                       
                        	<div class="form-group">

						    {!! Form::label('last_name',trans('messages.Product_code'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9">

								{!! Form::input('text','code','',['class'=>'form-control input-sm','placeholder'=>'Enter Product Code'])!!}

							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('first_name',trans('messages.Product_title'),['class' => 'input-sm col-sm-3 control-label'])!!}

						    <div class="col-sm-9">

								{!! Form::input('text','title','',['class'=>'form-control input-sm','placeholder'=>'Enter Product Title'])!!}

							</div>

						  </div>
						   
                       
                          
						  
						 <div class="form-group">

						    {!! Form::label('selling_price',trans('messages.selling_price'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9">

								{!! Form::input('text','selling_price','',['class'=>'form-control input-sm','placeholder'=>'Enter Price Amount of Sell'])!!}

							</div>

						  </div>

						 <div class="form-group">

						    {!! Form::label('order',trans('messages.order'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9">

								{!! Form::input('text','order','',['class'=>'form-control input-sm','placeholder'=>'Enter Order'])!!}

							</div>

						  </div>

						  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.add_product'),['class' => 'pull-right btn btn-sm input-sm btn-success']) !!}
						  
					</div><hr>
						  

					{!! Form::close() !!}
					
				</div>

			</div>
			<div id="product_gridbind">
			@if(!empty($product))
			 <div class="row " >
                      <div class="panel panel-default col-md-8"  style="background-color:#D3D3D3;color:black;margin-left:10px;">
	                      <div class="panel-heading" style="background-color:gray;color:black;">
							<center><strong> Product List  </strong></center>
						</div>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="text-left" width="50px">SL No.</th>
                              <th class="text-left" width="250px">Product Title</th>
                              <th style="" class="text-center" width="200px">Product Code</th>
                              <th style="" class="text-left" width="150px">UNIT PRICE</th>
                              <th style="" class="text-left" width="150px"></th>
                              <th style="" class="text-left" width="150px">Stock</th>
                              <th style="" class="text-right" width="250px"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $sl_no=0; ?>
                          
                          @foreach($product as $product)
                            <tr>
                              <td width="50px">{{$product->order}}</td>
                              <td width="250px">{{$product->title}}</td>
                              <td class="text-center" width="200px">{{$product->code}}</td>
                              <td class="text-left" width="150px">৳ {{number_format($product->selling_price,2)  }}</td>
                              <td class="text-left" width="150px"> </td>
								<td class="text-left" width="150px"> {{($product->stock)}}  {{$product->unit}}</td>
                              <td class="text-right" width="250px"> 
                              @if($emp_type==0 ||$emp_type==2)
                              <button type="button" id="{{$product->id}}" class=" edit_product" data-toggle="modal" data-target="#myModal"
                              data-category="{{$product->category}}" 
                              data-unit="{{$product->unit}}" 
                              data-title="{{$product->title}}" 
                              data-code="{{$product->code}}" 
                              data-price="{{$product->selling_price}}" 
                              data-order="{{$product->order}}" 
                              ><i class="fa fa-pencil"></i></button>
                              <button type="button" id="{{$product->id}}" class="delete_product " data-toggle="tooltip" data-placement="top" data-original-title="Delete row" ><i class="fa fa-trash-o"></i></button>
                    		  @endif
                    

                              </td>
                            </tr>
                           @endforeach 
                          

                            
                          </tbody>
                        </table>
                      </div><!--end .col -->
                    </div><!--end .row -->
			@endif
			</div>

		</div>
{!! Form::open(['url' => 'update_product','class'=>'form-horizontal' ,'method' => 'post']) !!}

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
     {!! csrf_field() !!}
      <div class="modal-content">
        <div class="modal-header" style="background-color:#34495e;color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Product Update</h4>
        </div>
        <div class="modal-body">
        <div class="col-md-8" id="product_modal"><hr>
        					<div class="form-group">

						    {!! Form::label('last_name',trans('messages.category'),['class' => 'col-sm-5 input-sm control-label'])!!}

						    <div class="col-sm-7">
								<select class="form-control" name="category"  id ="category">
									<option value="R">Raw Material's</option>
									<option value="F">Finishing Goods</option>
								<option value="P">Paste</option>
								</select>
							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('last_name',trans('messages.unit'),['class' => 'col-sm-5 input-sm control-label'])!!}
							<div class="col-sm-7">
						    <select class="form-control" name="unit" id="unit">
								<option value="Lb.">Lb.</option>
								<option value="kg">Kg</option>
								<option value="pcs">Pcs</option>
								<option value="litre">Litre</option>
							</select>
							</div>
						  </div>
                        	<div class="form-group">

						    {!! Form::label('last_name',trans('messages.Product_code'),['class' => 'col-sm-5 input-sm control-label'])!!}

						    <div class="col-sm-7">
								<input type="text" name="code"  id ="code" class="form-control input-sm">
							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('first_name',trans('messages.Product_title'),['class' => 'input-sm col-sm-5 control-label'])!!}

						    <div class="col-sm-7">

								<input type="text" name="title"  id ="title" class="form-control input-sm">

							</div>

						  </div>
						   
                       
                        	<div class="form-group">

						    {!! Form::label('selling_price',trans('messages.selling_price'),['class' => 'col-sm-5 input-sm control-label'])!!}

						    <div class="col-sm-7">
						    <input type="text" name="selling_price"  id ="selling_price" class="form-control input-sm">

							</div>

						  </div>
						 
						   <div class="form-group">

						    {!! Form::label('order',trans('messages.order'),['class' => 'col-sm-5 input-sm control-label'])!!}

						    <div class="col-sm-7">

								<input type="text" name="order" id="order" class="form-control input-sm">

							</div>
							<input type="hidden" name="id" id="id">
						  </div>
                        </div>
        
            </div>

        <div class="modal-footer"><br/>
        <button type="submit" class="btn btn-success ">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
{!! Form::close() !!}
	@stop