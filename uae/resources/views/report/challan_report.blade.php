@extends('layouts.default')



	@section('content')

		<div class="row">

			<div class="">

				<div class="panel panel-default col-sm-3"  style="background-color:;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><strong>  Challan Wise Report's </strong></center>
					</div>
					<br/>
					<form method="GET" action="{{url('post_challan_report')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}
    				  	<div class="col-md-12">
                          
						  
						 

						<div class="form-group">

						    {!! Form::label('alias_id','Challan #',['class' => 'col-sm-4 input-sm control-label'])!!}

						    <div class="col-sm-8">

							
							<select class="form-control input-xlarge input-sm select2me" name="challan_no" autofocus>
								@foreach($challan_no as $challan_no)
								<option value="{{$challan_no->challan_no}}">{{$challan_no->challan_no}}</option>
								@endforeach
							
							</select>

							</div>

						  </div>
						
						  
						  
						  {!! Form::submit(isset($buttonText) ? $buttonText : 'Show',['class' => 'pull-right btn btn-sm input-sm btn-success']) !!}
						  
					</div>
    				  	
					{!! Form::close() !!}					
				</div>

			</div>
			<div class="container" >
			@if(empty($product_out))			
                    <center>  <strong>No data Found</strong> </center> 
			@endif
			@if(!empty($product_out))
			 <div class=" row "  style="min-height:900px;">
                      <div class="panel panel-default  col-md-8	" id="table-scroll"  style="background-color:#D3D3D3;color:black;margin-left:2%!important;min-height: 500px!important;">
	                      <div class="panel-heading" style="background-color:gray;color:black;">
							<center><h3><strong> Product Out Report  </strong></h3></center>
							<center><strong>Challan No. Wise  </strong></center>
							<center><strong>Total Value : {{number_format($value,2)}} </strong></center>
						</div>
						<br/>
					@include('common.datatable',['col_heads' => $col_heads])
                        
                      </div><!--end .col -->
                    </div><!--end .row -->
			@endif
			
			
			</div>

		</div>
	@stop