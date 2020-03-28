@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.New Employee Asset') !!}</strong> 
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/employeeasset">{!! trans('messages.List All Employee Assets') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::open(['route' => 'employeeasset.store','role' => 'form', 'class'=>'employeeasset-form']) !!}
						@include('employeeasset._form')
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>You can store record of all the Employee Assets.</div>
			</div>
		</div>

	@stop