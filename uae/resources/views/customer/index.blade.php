@extends('layouts.default')



	@section('content')
<style type="text/css">
	tbody tr td{
		padding: 1px!important;margin: 0px!important;
		padding-left: 10px!important;
	}
	/*tbody {
            height: 220px!important;
            overflow-y: auto;
        }
         thead, tbody { display: block; }
        table tbody{
        	width:700px!important;
        }*/

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
    table.table-hover tr {
        width: 100%;
        display: table;
        text-align: left;
    }
    table.table-hover th, table.table-hover td {
        
    }
</style>
		<div class="row">

			<div class="">

				<div class="panel panel-default col-sm-3"  style="background-color:;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><strong>  Customer Information </strong></center>
					</div>
					<br/>
					<form method="POST" action="{{url('post_customer')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}
    				  	<div class="col-md-12">

						  
						  <div class="form-group">

						    {!! Form::label('quantity','Customer Name',['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">

								{!! Form::input('text','name','',['class'=>'form-control input-sm','placeholder'=>'Customer Full Name'])!!}

							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('date','address',['class' => 'col-sm-3 input-sm control-label'])!!}

						   	<div class="col-sm-9">
								{!! Form::input('text','address','',['class'=>'form-control input-sm','placeholder'=>'Enter address'])!!}
							</div>

						  </div>
						  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.add_customer'),['class' => 'pull-right btn btn-sm input-sm btn-success']) !!}
						  
					</div>
    				  	
                        
                        
						  

					{!! Form::close() !!}
					
				</div>

			</div>
			<div class="container" id="product_gridbind">
			@if(!empty($customer_info))
			 <div class=" row " id="table-wrapper" >
                      <div class="panel panel-default  col-md-8	" id="table-scroll"  style="background-color:#D3D3D3;color:black;margin-left:2%!important;">
	                      <div class="panel-heading" style="background-color:gray;color:black;">
							<center><strong> Customer List  </strong></center>
						</div>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="text-left" width="30px">Sl No.</th>
                              <th class="text-left" width="300px">Customer Name</th>
                              <th class="text-left" width="300px">Address</th>
                             <th width="100px"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $sl_no=0; ?>
                          
                          @foreach($customer_info as $customer_info)
                            <tr>
                              <td class="text-center" width="30px"> 
                             	{{$sl_no=$sl_no+1}}
                             </td>
                              <td class="text-left" width="300px">{{$customer_info->name}}</td>
                              <td class="text-left" width="300px"> 
                             	{{$customer_info->address}}
                             </td>
                            
                             <td width="100px">
                            <button type="button" id="{{$customer_info->id}}" class="edit_customer" data-toggle="modal" data-target="#myModal"
                              data-name="{{$customer_info->name}}" 
                              data-address="{{$customer_info->address}}"
                              ><i class="fa fa-pencil"></i></button>
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
    {!! Form::open(['url' => 'update_customer','class'=>'form-horizontal' ,'method' => 'post']) !!}
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
        <div class="col-md-8" id="cutomer_modal"><hr>
                <div class="form-group">
                Name
                <div class="col-sm-7">
                 <input type="text" name="name" id="name" class="form-control">
              </div>

              </div>
            <div class="form-group">
                Name
                <div class="col-sm-7">
                 <input type="text" name="address" id="address" class="form-control">
                  <input type="hidden" name="id" id="id">
              </div>

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