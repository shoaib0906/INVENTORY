@extends('layouts.default')



	@section('content')

		

		<style>

			ul.tree, ul.tree ul {

			 list-style-type: none;

			 background: url('/assets/images/vline.png') repeat-y;

			 margin: 0;

			 padding: 0;

			}

                        
			ul.tree ul {

			 margin-left: 10px;

			}

			.col-sm-3 .box-info{
				background-color:#2C3E50;color:white!important;
                                
			}
			.text-box h3{
				color: white!important;
			}

			ul.tree li {

			 margin: 0;

			 padding: 0 12px;

			 line-height: 20px;

			 background: url('/assets/images/node.png') no-repeat;

			 color: #3F3E48;

			 font-weight: bold;

			}



			ul.tree li.last {

			 background: #fff url('/assets/images/lastnode.png') no-repeat;

			}

			ul.tree li:last-child {

			 background: #fff url('/assets/images/lastnode.png') no-repeat;

			}
                        .box-info:hover,.text-box h3{
                         -webkit-transition-duration: .1s; /* Safari */
    transition-duration: .1s;
                         -webkit-box-shadow: 10px 10px 5px 0px #2C3E50);
-moz-box-shadow: 10px 10px 5px 0px #2C3E50;
box-shadow: 10px 10px 5px 0px #2C3E50;
                        }
                         
		</style>

		@if(Entrust::hasRole('manager') || Entrust::hasRole('admin')|| Entrust::hasRole('user'))

		<div class="row animated fadeInUpBig" >

			
			<div class="col-sm-3 col-xs-6">
				<div class="box-info" style="">
					<div class="icon-box">
						<span class="fa-stack">
						
						  <i class="fa fa-tags fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
 {!! ($dept_count) !!}
                        
                        <p>Product Available</a></p>
                        						
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">

				<div class="box-info" >

					<div class="icon-box">

						<span class="fa-stack">

						  

						  <i class="fa fa-tags fa-stack-1x fa-inverse"></i>

						</span>

					</div>

					<div class="text-box">

						{!! $user_count !!}

						<p>Stock Available</p>

					</div>

					<div class="clear"></div>

				</div>

			</div>

			<div class="col-sm-3 col-xs-6">

				<div class="box-info" >

					<div class="icon-box">

						<span class="fa-stack">

						  
						

						  <i class="fa fa-truck  fa-stack-1x fa-inverse"></i>

						</span>

					</div>

					<div class="text-box">

						{!! $present_count !!}

						<p>No. of Bill</p>

					</div>

					<div class="clear"></div>

				</div>

			</div>

			
            <div class="col-sm-3 col-xs-6">
				<div class="box-info" style="">
					<div class="icon-box">
						<span class="fa-stack">
						  
						  

						  <i class="fa fa-clipboard  fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						 {!! ($no_challan) !!}
                        
                        <p>No. of Challen</a></p>
                        						
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="box-info" style="">
					<div class="icon-box">
						<span class="fa-stack">
						

						  <i class="fa fa-money  fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						 {!! number_format($expire_count,2) !!}
                        
                        <p>Billed Amount</a></p>
                        						
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="box-info" style="">
					<div class="icon-box">
						<span class="fa-stack">

						  <i class="fa fa-money  fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						{!! number_format($discount,2) !!}
                        
                        <p>Total Discount Amount</a></p>
                        						
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="box-info" style="">
					<div class="icon-box">
						<span class="fa-stack">
						

						  <i class="fa fa-money  fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						 {!! number_format($less_amt,2) !!}
                        
                        <p>Total Less Amount</a></p>
                        						
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="box-info" style="">
					<div class="icon-box">
						<span class="fa-stack">
						 

						  <i class="fa fa-money  fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						{!! number_format($total_amt,2) !!}
                        
                        <p>Total Amount</a></p>
                        						
					</div>
					<div class="clear"></div>
				</div>
			</div>
			

		</div>
<div class="row animated fadeInDownBig" >

			

			<div class="col-sm-12">

				<div class="box-info" >

					<h2><strong>{!! trans('messages.Quick') !!}</strong> {!! trans('messages.Message') !!}</h2>

					<div class="additional-btn">

						  <a class="additional-icon" id="dropdownMenu5" data-toggle="dropdown">

							<i class="fa fa-cog"></i>

						  </a>

						  <ul class="dropdown-menu pull-right flip animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu5">

							<li role="presentation"><a role="menuitem" tabindex="-1" href="/message/compose">{!! trans('messages.Compose') !!}</a></li>

							<li role="presentation"><a role="menuitem" tabindex="-1" href="/message">{!! trans('messages.Go to Inbox') !!}</a></li>

							<li role="presentation"><a role="menuitem" tabindex="-1" href="/message/sent">{!! trans('messages.Go to Sent Folder') !!}</a></li>

						  </ul>

						  <a class="additional-icon" href="#" data-toggle="collapse" data-target="#quick-post"><i class="fa fa-chevron-down"></i></a>

					</div>

					

					<div id="quick-post" class="collapse in">

						{!! Form::open(['route' => 'message.store','role' => 'form', 'class'=>'compose-form']) !!}

							<div class="form-group">

								{!! Form::select('to_user_id', [null=>'Please select'] + $compose_users, '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Staff'])!!}

							</div>

							<div class="form-group">

								{!! Form::input('text','subject','',['class'=>'form-control input-lg','placeholder'=>'Message subject'])!!}

							</div>

							<div class="form-group">

								{!! Form::textarea('content','',['class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}

							</div>

							<div class="row">

								<div class="col-md-6">

									<button type="submit" class="btn btn-sm btn-success">{!! trans('messages.Send') !!}</button>

								</div>

							</div>

						{!! Form::close() !!}

					</div>

				</div>

			</div>

			

		</div>

		@endif











		
		

	@stop