@extends('layouts.default')



	@section('content')



		<div class="modal fade" id="myModal" role="basic" aria-hidden="true">

			<div class="modal-dialog">

				<div class="modal-content">

				</div>

			</div>

		</div>

			

		<div class="row">

			<div class="col-sm-12">

				<div class="box-info">

					<div class="tabs-left row">	

						<ul class="nav nav-tabs col-md-2" style="padding-right:0;">

						  <li class="active"><a href="#general" data-toggle="tab"><span class="fa fa-cog"></span> {!! trans('messages.General') !!}</a></li>

						  <li><a href="#permission" data-toggle="tab"><span class="fa fa-key"></span> {!! trans('messages.Permission') !!}</a></li>

						  <li><a href="#mail" data-toggle="tab"><span class="fa fa-envelope"></span> {!! trans('messages.Mail') !!}</a></li>

						  <li><a href="#sms" data-toggle="tab"><span class="fa fa-mobile"></span> {!! trans('messages.SMS') !!}</a></li>

						 
				        </ul>

				        <div id="myTabContent" class="tab-content col-md-9">

						  <div class="tab-pane animated active fadeInRight" id="general">

						    <div class="user-profile-content-wm">

								<h2><strong>{!! trans('messages.General') !!}</strong> {!! trans('messages.Configuration') !!}</h2>

								{!! Form::open(['route' => 'configuration.store','role' => 'form', 'class'=>'config-form ']) !!}

									@include('configuration._form')

								{!! Form::close() !!}

							</div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="mail">

						    <div class="user-profile-content">

								<h2><strong>{!! trans('messages.Mail') !!}</strong> {!! trans('messages.Configuration') !!}</h2>

								{!! Form::open(['route' => 'configuration.mailStore','role' => 'form', 'class'=>'mail-form ']) !!}

									@include('configuration._mail')

								{!! Form::close() !!}

						    </div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="sms">

						    <div class="user-profile-content">

								<h2><strong>{!! trans('messages.SMS') !!}</strong> {!! trans('messages.Configuration') !!} (Default Twilio SMS Integrated)</h2>

								{!! Form::open(['route' => 'configuration.smsStore','role' => 'form', 'class'=>'sms-form ']) !!}

									@include('configuration._sms')

								{!! Form::close() !!}

						    </div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="job">

						    <div class="user-profile-content">

								<h2><strong>{!! trans('messages.Job') !!}</strong> {!! trans('messages.Configuration') !!}</h2>

								{!! Form::open(['route' => 'configuration.jobStore','role' => 'form', 'class'=>'job-configuration-form ']) !!}

									@include('configuration._job')

								{!! Form::close() !!}

						    </div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="permission">

						    <div class="user-profile-content">

								

								<div class="col-sm-4">

									<div class="box-info">

										<h2><strong>Create New Role</strong> </h2>

										{!! Form::open(['route' => 'role.store','role' => 'form', 'class'=>'role-form']) !!}

											@include('role._form')

										{!! Form::close() !!}

									</div>

								</div>

								<div class="col-sm-8">

									<div class="box-info">

										<h2><strong>List All Role</strong> </h2>

										<div class="table-responsive">

											<table class="table table-hover table-striped">

												<thead>

													<tr>

														<th>{!! trans('messages.Name') !!}</th>

														<th>{!! trans('messages.Display Name') !!}</th>

														<th>{!! trans('messages.Option') !!}</th>

													</tr>

												</thead>

												<tbody>

													@foreach($roles as $role)

														<tr>

															<td>{!! $role->name !!}</td>

															<td>{!! $role->display_name !!}</td>

															<td>

																<a href="{!! URL::to('/role/'.$role->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>

																{!! delete_form(['role.destroy',$role->id]) !!}

															</td>

														</tr>

													@endforeach

												</tbody>

											</table>

										</div>

									</div>

								</div>

								<div class="clear"></div>



								<h2><strong>{!! trans('messages.Manage') !!}</strong> {!! trans('messages.Permission') !!}</h2>

								{!! Form::open(['route' => 'configuration.save_permission','role' => 'form', 'class'=>'permission-form ']) !!}

								  <p class="alert alert-info"><strong>Subordinates are the different designations under any designation.</strong></p>

								  <table class="table table-hover table-striped">

								  	<thead>

								  		<tr>

								  			<th>Permission</th>

								  			@foreach($roles as $role)

								  			<th>{!! ucwords($role->name) !!}</th>

								  			@endforeach

								  		</tr>

								  		</tr>

								  	</thead>

								  	<tbody>

								  		@foreach($permissions as $permission)

								  			@if($permission->category != $category)

								  			<tr style="background-color:#3498DB;color:#ffffff;"><td colspan="{!! count($roles)+1 !!} "><strong>{!! \App\Classes\Helper::toWord($permission->category) !!} Module</strong></td></tr>

								  			<?php $category = $permission->category; ?>

								  			@endif

								  			<tr>

								  				<td>{!! ucwords($permission->display_name) !!}</td>

									  			@foreach($roles as $role)

									  			<th><input type="checkbox" name="permission[{!!$role->id!!}][{!!$permission->id!!}]" value = '1' {!! (in_array($role->id.'-'.$permission->id,$permission_role)) ? 'checked' : '' !!}></th>

									  			@endforeach

								  			</tr>

								  		@endforeach

								  	</tbody>

								  </table>

								  <br /><br />

								  {!! Form::submit(isset($buttonText) ? $buttonText : 'Save Permission',['class' => 'btn btn-primary pull-right']) !!}

								{!! Form::close() !!}

								<div class="clear"></div>

						    </div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="time">

						    <div class="user-profile-content">

								<h2><strong>{!! trans('messages.Office') !!}</strong> {!! trans('messages.Timing') !!}</h2>

								{!! Form::open(['route' => 'configuration.time','role' => 'form', 'class'=>'time-form ']) !!}

									@include('configuration.time')

								{!! Form::close() !!}

						    </div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="award">

						    <div class="user-profile-content">

								<div class="row">

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Award Type') !!}</h2>

											{!! Form::open(['route' => 'award_type.store','role' => 'form', 'class'=>'award-type-form ']) !!}

												@include('award_type._form')

											{!! Form::close() !!}

										</div>

									</div>

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Award Types') !!}</h2>

												<div class="table-responsive">

													<table class="table table-hover table-striped">

														<thead>

															<tr>

																<th>{!! trans('messages.Award Name') !!}</th>

																<th>{!! trans('messages.Option') !!}</th>

															</tr>

														</thead>

														<tbody>

														
														</tbody>

													</table>

												</div>

										</div>

									</div>

								</div>

						    </div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="leave">

						    <div class="user-profile-content">

								<div class="row">

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Leave Type') !!}</h2>

											{!! Form::open(['route' => 'leave_type.store','role' => 'form', 'class'=>'leave-type-form ']) !!}

												@include('leave_type._form')

											{!! Form::close() !!}

										</div>

									</div>

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Leave Types') !!}</h2>

												<div class="table-responsive">

													<table class="table table-hover table-striped">

														<thead>

															<tr>

																<th>{!! trans('messages.leave Name') !!}</th>

																<th>{!! trans('messages.Option') !!}</th>

															</tr>

														</thead>

														<tbody>

														
														</tbody>

													</table>

												</div>

										</div>

									</div>

								</div>

						    </div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="document">

						    <div class="user-profile-content">

								<div class="row">

									<div class="col-sm-6">

										<div class="box-info">

										

										</div>

									</div>

									<div class="col-sm-6">

										

									</div>

								</div>

						    </div>

						  </div>
                          
                          <div class="tab-pane animated fadeInRight" id="asset">
						    <div class="user-profile-content">
								<div class="row">
									
									<div class="col-sm-6">
										<div class="box-info">
											
										</div>
									</div>
								</div>
						    </div>
						  </div>

						  <div class="tab-pane animated fadeInRight" id="salary">

						    <div class="user-profile-content">

								<div class="row">

									<div class="col-sm-6">

										<div class="box-info">

											

										</div>

									</div>

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Salary Types') !!}</h2>

												<div class="table-responsive">

													<table class="table table-hover table-striped">

														<thead>

															<tr>

																<th>{!! trans('messages.Salary Head') !!}</th>

																<th>{!! trans('messages.Type') !!}</th>

																<th>{!! trans('messages.Option') !!}</th>

															</tr>

														</thead>

														<tbody>

														

														</tbody>

													</table>

												</div>

										</div>

									</div>

								</div>

						    </div>

						  </div>

						  <div class="tab-pane animated fadeInRight" id="expense">

						    <div class="user-profile-content">

								<div class="row">

									<div class="col-sm-6">

										<div class="box-info">

											
										</div>

									</div>

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Expense Heads') !!}</h2>

												<div class="table-responsive">

													<table class="table table-hover table-striped">

														<thead>

															<tr>

																<th>{!! trans('messages.Expense Head') !!}</th>

																<th>{!! trans('messages.Option') !!}</th>

															</tr>

														</thead>

														<tbody>

														
														</tbody>

													</table>

												</div>

										</div>

									</div>

								</div>

						    </div>

						  </div>
                          <div class="tab-pane animated fadeInRight" id="alias">

						    <div class="user-profile-content">

								<div class="row">

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Alias') !!}</h2>

											{!! Form::open(['route' => 'alias.store','role' => 'form', 'class'=>'alias-form ']) !!}

												@include('alias._form')

											{!! Form::close() !!}

										</div>

									</div>

									<div class="col-sm-6">

										<div class="box-info">

											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Alias') !!}</h2>

												<div class="table-responsive">

													<table class="table table-hover table-striped">

														<thead>

															<tr>

																<th>{!! trans('messages.Alias Name') !!}</th>

																<th>{!! trans('messages.Option') !!}</th>

															</tr>

														</thead>

														<tbody>

															@foreach($alias_list as $aliasv)

																<tr>

																	<td>{!! $aliasv->alias_name !!}</td>

																	<td>

																		<a href="{!! URL::to('/alias/'.$aliasv->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>

																		{!! delete_form(['alias.destroy',$aliasv->id]) !!}

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

					</div>

				</div>

			</div>

		</div>

				

	@stop