@extends('layouts.default')



	@section('content')

		<div class="row">

			<div class="">

				<div class="panel panel-default col-sm-3"  style="background-color:;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><strong>  Common Report's for <br>
						{!! \App\Classes\Helper::getBranchName() !!}</strong></center>
					</div>
					<br/>
					<form method="POST" action="{{url('post_common_report')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}
    				  	<div class="col-md-12">
                          
						  
						 

						
						  <div class="form-group">

						    {!! Form::label('report_type',trans('messages.report_type'),['class' => 'col-sm-3 input-sm control-label'])!!}

						    <div class="col-sm-9">

							
							<select class="form-control input-xlarge input-sm select2me" name="report_type">\
							
						  	<option value="I">Product IN</option>
						  	<option value="O">Product Out</option>
						  </select>

							</div>

						  </div>
						  
						  <div class="form-group">

						    {!! Form::label('date_from',trans('messages.date_from'),['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								{!! Form::input('text','date_from','',['class'=>'form-control datepicker-input input-sm','placeholder'=>'From Date'])!!}

							</div>

						  </div>
						 <div class="form-group">

						    {!! Form::label('date_to',trans('messages.date_to'),['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								{!! Form::input('text','date_to','',['class'=>'form-control datepicker-input input-sm','placeholder'=>'To Date'])!!}

							</div>

						  </div>
						  
						  
						  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.show'),['class' => 'pull-right btn btn-sm input-sm btn-success']) !!}
						  
					</div>
    				  	
					{!! Form::close() !!}					
				</div>

			</div>
			<div class="container" >
			@if(empty($product_out) && empty($product_in))			
                    <center>  <strong>No data Found</strong> </center> 
			@endif
			@if(!empty($product_out))
			 <div class=" row "  style="min-height:900px;">
                      <div class="panel panel-default  col-md-8	" id="table-scroll"  style="background-color:#D3D3D3;color:black;margin-left:2%!important;min-height: 500px!important;">
	                      <div class="panel-heading" style="background-color:gray;color:black;">
							<center><h3><strong> Product Out Report  </strong></h3></center>
							<center><strong>From Date : </strong>{{$from_date}} <strong> To :</strong>  {{$to_date}}</strong></center>
						</div>
						<br/>
					@include('common.datatable',['col_heads' => $col_heads])
                        
                      </div><!--end .col -->
                    </div><!--end .row -->
			@endif
			
			@if(!empty($product_in))
			 <div class=" row "  >
                      <div class="panel panel-default  col-md-8	" id="table-scroll"  style="background-color:#D3D3D3;color:black;margin-left:2%!important;min-height: 500px!important;">
	                      <div class="panel-heading" style="background-color:gray;color:black;">
							<center><h4><strong> Product In Report  </strong></h4></center>
							<center><strong>From Date : </strong>{{$from_date}} <strong> To :</strong>  {{$to_date}}</strong></center>
						</div>
                        <br/>
					@include('common.datatable',['col_heads' => $col_heads])
                      </div><!--end .col -->
                    </div><!--end .row -->

			@endif
			</div>

		</div>
	@stop