@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Designation') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/designation/create">{!! trans('messages.Add New Designation') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/designation">{!! trans('messages.List All Designation') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($designation,['method' => 'PATCH','route' => ['designation.update',$designation] ,'class' => 'designation-form']) !!}
						@include('designation._form', ['buttonText' => 'Update Designation'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Here you can edit the designation name & its description. Keep in mind that designation name cannot be same as designation in another department.
				Change in designation name will be reflected everywhere.</div>
			</div>
		</div>

	@stop