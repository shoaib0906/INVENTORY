@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-10">
				<div class="panel panel-default col-sm-12"  style="background-color:#95a5a6;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><h4><strong> Create Department  </strong></h4></center>
					</div>
					<br/>
					
					{!! Form::open(['route' => 'department.store','role' => 'form', 'class'=>'department-form']) !!}
						@include('department._form')
					{!! Form::close() !!}

				</div>
			</div>
			<div class="col-sm-2">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4></div>
			</div>
		</div>

	@stop