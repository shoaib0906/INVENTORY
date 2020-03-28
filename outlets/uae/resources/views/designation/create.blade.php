@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Designation') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/designation">{!! trans('messages.List All Designation') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::open(['route' => 'designation.store','role' => 'form', 'class'=>'designation-form']) !!}
						@include('designation._form')
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Designations are post at various department that can be allotted to an employee.
				For example, account department can have designation of Sr Account Manager, Account Manager etc.
				etc. You can create designation here; every designation should have a unique name in a department. Once you create designation, you can move to create employee.</div>
			</div>
		</div>

	@stop