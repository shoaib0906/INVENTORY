<style type="text/css">
	.navbar  a
	{
	    color: #2ecc71!important;
	}
</style>
			<!-- BEGIN CONTENT HEADER -->
            <div class="header content rows-content-header" >
			<button class="button-menu-mobile show-sidebar">
					<i class="fa fa-bars"></i>
				</button>
				
				
				<!-- BEGIN NAVBAR CONTENT-->				
				<div class="navbar navbar-default" >
					<div class="container" style="padding-right:0px;">
						
						
						<!-- Navbar collapse -->	
						<div class="navbar-collapse collapse" style="background-color:#1C2535;color:white;">
						
							
							<!-- Right navbar -->
							<ul class="nav navbar-nav pull-right top-navbar" >

							@if(Entrust::hasRole('admin') || Entrust::can('manage_custom_field') || Entrust::can('manage_sms_template') || Entrust::can('manage_template'))
								<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> {!! trans('messages.Setting') !!} <i class="fa fa-chevron-down i-xs"></i></a>
									<ul class="dropdown-menu animated half flipInX">
									@if(Entrust::hasRole('admin'))
											<li><a href="{!! URL::to('/configuration') !!}">{!! trans('messages.Configuration') !!}</a></li>
									@endif
									@if(Entrust::can('manage_custom_field'))
										<li><a href="{!! URL::to('/custom_field') !!}">{!! trans('messages.Custom Fields') !!}</a></li>
									@endif
									@if(Entrust::can('manage_template'))
									<li><a href="{!! URL::to('/template') !!}">{!! trans('messages.Email Template') !!}</a></li>
									@endif
									@if(Entrust::can('manage_sms_template'))
									<li><a href="{!! URL::to('/sms_template') !!}">{!! trans('messages.SMS Template') !!}</a></li>
									@endif
									</ul>
								</li>
								@endif
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i>
										{!! ($header_inbox_count) ? '<span class="label label-danger absolute">'.$header_inbox_count.'</span>' : '' !!}
									</a>
									<ul class="dropdown-menu dropdown-message animated half flipInX">
										@if(!$header_inbox_count)
										<li class="dropdown-header notif-header">
											No unread message
										</li>
										@endif
										<li class="dropdown-header notif-header">New Messages</li>
										@foreach($header_inbox as $inbox)
										<li class="unread">
											<a href="{!! URL::to('/message/view/'.$inbox->id.'/'.$token) !!}">
												{!! \App\Classes\Helper::getAvatar($inbox->user_id) !!}
												<div style="margin-left:75px;">
													<strong>{!! $inbox->name !!}</strong><br />
													<p><i>{!! \App\Classes\Helper::showDateTime($inbox->time) !!}</i><br />
													{!! $inbox->subject !!}</p>
												</div>
											</a>
										</li>
										@endforeach

										@if($header_inbox_count > count($header_inbox))
										<li class="dropdown-footer">
											<a href="/message">
												<i class="fa fa-share"></i> See all messages
											</a>
										</li>
										@endif
									</ul>
								</li>

								

								<li class="dropdown"><a href="#">{!! App\Classes\Helper::showDateTime(date('d M Y,h:i a')) !!}</a></li>
								
								<!-- Dropdown User session -->
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <strong>{!! Auth::user()->first_name !!},
										 {!! \App\Classes\Helper::getBranchName() !!}
										 </strong> <i class="fa fa-chevron-down i-xs"></i></a>
									<ul class="dropdown-menu animated half flipInX">
										<li><a href="{!! URL::to('/change_password') !!}">Change Password</a></li>
										<li><a href="{!! URL::to('/logout') !!}">Logout</a></li>
									</ul>
								</li>
								<!-- End Dropdown User session -->
							</ul>
						</div><!-- End div .navbar-collapse -->
					</div><!-- End div .container -->
				</div>
				<!-- END NAVBAR CONTENT-->
            </div>
			<!-- END CONTENT HEADER -->
				