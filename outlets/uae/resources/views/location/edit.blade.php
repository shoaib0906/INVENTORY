@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Location') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/location/create">{!! trans('messages.Add New Location') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/location">{!! trans('messages.List All Location') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($location,['method' => 'PATCH','route' => ['location.update',$location] ,'class' => 'location-form']) !!}
						@include('location._form', ['buttonText' => 'Update Location'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Here you can edit the location name. Keep in mind that location name cannot be same as another location name.
				Change in location name will be reflected everywhere.</div>
			</div>
		</div>

	@stop