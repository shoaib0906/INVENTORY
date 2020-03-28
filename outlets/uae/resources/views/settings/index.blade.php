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
						<center><strong> Create Product for <br/>
             			{!! \App\Classes\Helper::getBranchName() !!}
             			 </strong></center>
					</div>

					<form method="POST" action="{{url('post_settings')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}

    				  	<div class="col-md-12"> 
    				  	
						  
						  
                       
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

						    {!! Form::label('email','Unit',['class' => 'col-sm-3 input-sm control-label'])!!}

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
							<h4><center><strong> Product List for 
              @if(Auth::user()->branch_id==1)Dhaka Branch 
              @else 
            @endif </strong></center></h4>
						</div>
                        <table class="table table-hover">
                          <thead>
                            
                          </thead>
                          <tbody>
                          	<tr style="font-weight: 14px; font-style: bold;">
                              <td  width="50px">SL No.</td>
                              <td  width="250px">Product Title</td>
                              <td  width="100px"> Code</td>
                              <td  width="150px">UNIT PRICE</td>
                              <td  width="150px"></td>
                              <td  width="150px">Stock</td>
                              <td  width="250px"></td>
                            </tr>
                          <?php $sl_no=0; ?>
                          
                          @foreach($product as $product)
                            <tr>
                              <td width="50px">{{$product->order}}</td>
                              <td width="250px">{{$product->title}}</td>
                              <td  width="100px">{{$product->code}}</td>
                              <td  width="150px">৳ {{number_format($product->selling_price,2)  }}</td>
                              <td  width="150px"> </td>
								<td  width="150px"> {{($product->stock)}}  {{$product->unit}}</td>
                              <td  width="250px"> 
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