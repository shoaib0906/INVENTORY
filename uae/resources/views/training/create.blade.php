@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Request') !!}</strong> {!! trans('messages.Training') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  
					</div>
					</h2>
					
					{!! Form::open(['route' => 'manage_training.store','role' => 'form', 'class'=>'leave-form']) !!}
						@include('training._form')
					{!! Form::close() !!}

				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					
				</div>
			</div>
		</div>

	@stop