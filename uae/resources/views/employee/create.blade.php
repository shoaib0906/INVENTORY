@extends('layouts.default')



	@section('content')

		<div class="row">

			<div class="col-sm-12">

				<div class="panel panel-default col-sm-12"  style="background-color:#95a5a6;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><h4><strong> Create Employee  </strong></h4></center>
					</div>
					<br/>

			        



					<form method="POST" action="{{url('auth/register')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}

    				  	<div class="col-md-6"> 
    				  	<div class="form-group">

						    {!! Form::label('alias_id',trans('messages.Alias'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('alias_id', [null=>'Please Select'] + $alias_list,isset($employee->alias_id) ? $employee->alias_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Alias'])!!}

							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('first_name',trans('messages.First Name'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','first_name','',['class'=>'form-control','placeholder'=>'Enter First Name'])!!}

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('last_name',trans('messages.Last Name'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','last_name','',['class'=>'form-control','placeholder'=>'Enter Last Name'])!!}

							</div>

						  </div>

						  
                          
                          	
                        
						  <div class="form-group">

						    {!! Form::label('username',trans('messages.Username'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','username','',['class'=>'form-control','placeholder'=>'Enter Username'])!!}

								<div class="help-box">It should be unique to every user.</div>

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('email',trans('messages.Email'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','email','',['class'=>'form-control','placeholder'=>'Enter Email'])!!}

								<div class="help-box">It should be unique to every user.</div>

							</div>
							<br/>
						  </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">

						    {!! Form::label('rent_amount',trans('messages.rent_amount'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','rent_amount','',['class'=>'form-control','placeholder'=>'Enter Rent Amount'])!!}

							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('telephone',trans('messages.telephone'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','telephone','',['class'=>'form-control','placeholder'=>'Enter Telephone No'])!!}
								

							</div>

						  </div>
						  <div class="form-group">

						    {!! Form::label('cell_no',trans('messages.cell_no'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','cell_no','',['class'=>'form-control','placeholder'=>'Enter Cell No'])!!}
								
								<div class="help-box" style="color:#c0392b;"><strong>SMS will be Send to this Number.</strong></div>
							</div>

						  </div>
                          
						  <div class="form-group">

						    {!! Form::label('password',trans('messages.Password'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('password','password','',['class'=>'form-control','placeholder'=>'Enter Password'])!!}

								<div class="help-box">Minimum 4 characters.</div>

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('password_confirmation',trans('messages.Confirm Password'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('password','password_confirmation','',['class'=>'form-control','placeholder'=>'Enter Confirm Password'])!!}

							</div>

						  </div>
					</div><hr/>
						  <div class="col-sm-offset-6 col-sm-10">

						  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
						  	 
						  </div>

					{!! Form::close() !!}
					<br/>
				</div>

			</div>


		</div>



	@stop