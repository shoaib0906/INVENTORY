@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Location') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/location">{!! trans('messages.List All Location') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::open(['route' => 'location.store','role' => 'form', 'class'=>'location-form']) !!}
						@include('location._form')
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Locations are divison of a large organization into parths with specific responsibility.
				For example, an organization can have separate account location, human resource location
				etc. You can create location here; every location should have a unique name.</div>
			</div>
		</div>

	@stop