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
        height: 430px;
    }
    
    table.table-hover th, table.table-hover td {
        
    }
</style>
		<div class="row" ng-app>

			<div class="">

				<div class="panel panel-default col-sm-3"  style="background-color:;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><strong>  Bill Report </strong></center>
					</div>
					<br/>
					<form method="POST" action="{{url('post_bill_report')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}
    				    <div class="form-group">

						    {!! Form::label('date','Bill No.',['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">
                                
								<select class="form-control input-xlarge input-sm select2me" name="bill_no" autofocus>
								<option value="">Select One</option>
								@foreach($bill_no as $bill_no)
								<option value="{{$bill_no->bill_no}}">{{$bill_no->bill_no}}</option>
								@endforeach
							
							    </select>

							</div>

						  </div>

    				  	
						  <div class="form-group">

						    {!! Form::label('date','From Date',['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								{!! Form::input('text','from_date','',['class'=>'form-control datepicker-input input-sm','placeholder'=>'From date'])!!}

							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('date','To Date',['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								{!! Form::input('text','to_date','',['class'=>'form-control datepicker-input input-sm','placeholder'=>'To date'])!!}

							</div>

						  </div>
						  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.show'),['class' => 'pull-right btn btn-sm input-sm btn-success']) !!}
						  
					</div>
    				  	
                        
                        
						  

					{!! Form::close() !!}
					
				

			</div>
			<div class="container" >
			@if(!empty($bill))
			 <div class=" row "  >
                      <div class="panel panel-default  col-md-8	" id="table-scroll"  style="background-color:#D3D3D3;color:black;margin-left:2%!important;">
	                      <div class="panel-heading" style="background-color:gray;color:white;">
							<center><strong> Bill List  </strong></center>
									<center><p>From Date : {{$from_date}} To {{$to_date}}</p></center>
						</div>
                        <table class="table table-hover">
                        		 <thead>
			                            <tr>
			                            <th class="text-left" width="50px">Bill NO</th>
			                             <th style="" class="text-left" width="110px">Ref. No</th>
			                              
			                              <th style="" class="text-left" width="100px">Bill Date</th>
			                              <th style="" class="text-left" width="80px">Total Amount</th>
			                              
			                              <th style="" class="text-left" width="100px">Discount(%)</th>
			                              <th style="" class="text-left" width="100px">Less Amount</th>
			                              <th style="" class="text-left" width="100px">Paid Amount</th>
			                              <th style="" class="text-right" width="10px"></th>
			                            </tr>
			                          </thead>
			                          <tbody>
			                          
			                          <?php $total_amount=0; ?>
			                          @foreach($bill as $bill)
			                            <tr>
			                            <td width="50px">
			                              {{($bill->bill_no)  }}
			                              </td>
			                            	<td class="text-left" width="110px"> {{($bill->ref_no)}}</td>
			                              

			                              <td class="text-left" width="100px"> {{($bill->bill_date)  }}</td>
			                              <td class="text-left" width="80px"> {{($bill->total_amt)  }}</td>
			                              
			                              <td class="text-left" width="120px">{{($bill->dis_percent*$bill->total_amt)/100 }}</td>

											<td class="text-left" width="100px"> {{($bill->less_amt)  }}</td>
											<td style="" class="text-left" width="100px">
											{{($bill->net_amt)  }}
											</td>

			                              <td class="text-right" width="10px"> 
			                              
			                    <button type="button" id="{{$bill->bill_no}}" class="view_bill_report " data-toggle="tooltip" data-placement="top" data-original-title="View row" ><i class="fa fa-eye"></i></button>

			                              </td>
			                            </tr>
			                           @endforeach 
			                            
			                          </tbody>
                          			
                          
                        </table>
						
                      </div>

                    </div><!--end .row -->
			@else

			<center><b>No Data Found</b></center>
			@endif

			</div>

		</div>


	@stop