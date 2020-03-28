@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Employee Asset') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/employeeasset">{!! trans('messages.List All Employee Assets') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($employeeasset,['method' => 'PATCH','route' => ['employeeasset.update',$employeeasset->id] ,'class' => 'employeeasset-form']) !!}
						@include('employeeasset._form', ['buttonText' => 'Update'] )
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Here you can edit the Employee Asset.</div>
			</div>
		</div>

	@stop