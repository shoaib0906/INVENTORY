@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.All') !!}</strong> {!! trans('messages.Training') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>

					</div>
					</h2>									
					
						<div class="form-group">
							 
						</div>
							<div class="row">

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Training') !!}</h2>
												{!! Form::open(['route' => 'training.store','role' => 'form', 'class'=>'training-form']) !!}
																		@include('training._form_add_training')
												{!! Form::close() !!}

										</div>

									</div>

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Training') !!}</h2>

												<div class="table-responsive">

													<table class="table table-hover table-striped">

														<thead>

															<tr>

																<th>{!! trans('messages.Training Name') !!}</th>

																<th>{!! trans('messages.Option') !!}</th>

															</tr>

														</thead>

														<tbody>

															@foreach($leave_types as $leave)

																<tr>

																	<td>{!! $leave->training_name !!}</td>

																	<td>

																		<a href="{!! URL::to('/training_type/'.$leave->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>

																		{!! delete_form(['training.destroy',$leave->id]) !!}

																	</td>

																</tr>

															@endforeach

														</tbody>

													</table>

												</div>

										</div>

									</div>

								</div>

					
				</div>
			</div>
			
		</div>
<div class="modal fade" id="myModal" role="basic" aria-hidden="true">

			<div class="modal-dialog">

				<div class="modal-content">

				</div>

			</div>

		</div>

@stop
