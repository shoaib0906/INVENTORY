@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="panel panel-default col-sm-12"  style="background-color:#95a5a6;padding-bottom:20px;">
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><h4><strong> Edit Department  </strong></h4></center>
					</div>
					<br/>
					
					</h2>
					
					{!! Form::model($department,['method' => 'PATCH','route' => ['department.update',$department] ,'class' => 'department-form']) !!}
						@include('department._form', ['buttonText' => 'Update Property'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Here you can edit the Property name & its description. Keep in mind that Property name cannot be same as another Property name.
				Change in Property name will be reflected everywhere.</div>
			</div>
		</div>

	@stop