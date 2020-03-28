		<!-- BEGIN SIDEBAR -->
<style type="text/css">
	#sidebar-menu  a
	{
	    color: white!important;
	}
</style>
		<div class="left side-menu">

			

			

            <div class="body rows scroll-y" style="background-color:#95A5A6;">

				

				<!-- Scrolling sidebar -->

                <div class="sidebar-inner slimscroller" >

					

				@if(config('constants.MODE') == 0)

					

				@endif

					<!-- Sidebar menu -->				

					<div id="sidebar-menu">

						<ul>

							<li><a  href="{!! URL::to('/') !!}"><i class="fa fa-home icon"></i> {!! trans('messages.Dashboard') !!}</a></li>
                            @if(Entrust::can('create_department'))


                           <!-- @if(Entrust::can('manage_message'))

							<li><a href="{!! URL::to('/message') !!}"><i class="fa fa-envelope icon"></i> {!! trans('messages.Message') !!}</a></li>

							@endif

							

							@if(Entrust::can('manage_sms'))

							<li><a href="{!! URL::to('/sms') !!}"><i class="fa fa-commenting icon"></i> {!! trans('messages.SMS') !!}</a></li>

							@endif-->
							<li><a href=""><i class="fa fa-sitemap icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Department') !!}</a>

								<ul>

									@if(Entrust::can('create_department'))

									<li><a href="{!! URL::to('/department/create') !!}"><i class="fa fa-plus"></i> {!! trans('messages.Add New') !!} </a></li>

									@endif

									<li><a href="{!! URL::to('/department') !!}"><i class="fa fa-list"></i> {!! trans('messages.List Property') !!} </a></li>

								</ul>

							</li>

							@endif
                           	
							@if(Entrust::can('manage_employee'))

							<li><a href=""><i class="fa fa-users icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.employee') !!}</a>

								<ul>

									@if(Entrust::can('create_employee'))

									<li><a href="{!! URL::to('/employee/create') !!}"><i class="fa fa-plus"></i> {!! trans('messages.Add New') !!} </a></li>

									@endif

									<li><a href="{!! URL::to('/employee') !!}"><i class="fa fa-list"></i> {!! trans('messages.List Employee') !!}</a></li>

								</ul>

							</li>

							@endif
							@if(Entrust::can('manage_task'))

							<li><a href=""><i class="fa fa-tasks icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Task') !!}</a>

								<ul>

									@if(Entrust::can('create_task'))

									<li><a href="{!! URL::to('/task/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>

									@endif

									<li><a href="{!! URL::to('/task') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Task') !!}</a></li>

								</ul>

							</li>

							@endif
@if(Entrust::can('customer'))
							<li><a href="{!! URL::to('/customer') !!}">
<i class="fa fa-user  icon"></i>Customer </a></li>

							@endif

							@if(Entrust::can('product_in'))

							<li><a href="{!! URL::to('/raw_m_in') !!}"><i class="fa fa-hand-o-right  icon"></i><i class="fa fa-arrow-circle-right i-right"></i>Product IN </a></li>

							@endif

							@if(Entrust::can('product_out'))
							<li><a href="{!! URL::to('/raw_m_out') !!}"><i class="fa fa-truck  icon"></i><i class="fa fa-arrow-circle-left i-right"></i>
							 Product Out </a></li>
<li><a href="{!! URL::to('/challan_report') !!}"><i class="fa fa-clipboard   icon"></i>
									 Challan Wise Product</a></li>
							 @endif

							 @if(Entrust::can('bill'))
							 <li><a href="{!! URL::to('/bill') !!}"><i class="fa fa-truck  icon"></i>
							 Bill  </a></li>
							 @endif
							 
							 
							
							@if(Entrust::can('add_product_setup'))
							<li><a href="{!! URL::to('/settings') !!}"><i class="fa fa-cogs  icon"></i> Product Settings</a></li>
							@endif
                            @if(Entrust::can('report'))
									<li><a href="{!! URL::to('/common_report') !!}"><i class="fa fa-bar-chart  icon"></i>
                                                                         
									 Common Report</a></li>
									 <li><a href="{!! URL::to('/excel_report') !!}"><i class="fa fa-bar-chart icon"></i>
									 Excel Report</a></li>
									 
                                    <li><a href=""><i class="fa fa-bar-chart icon"></i><i class="fa fa-angle-double-down i-right"></i>MIS Report</a>

        								<ul>
        
        									<li><a href="{!! URL::to('/mis_report') !!}"><i class="fa fa-angle-right"></i> MIS Report 2019 </a></li>
        									<li><a href="{!! URL::to('/mis_report_2018') !!}"><i class="fa fa-angle-right"></i> MIS Report 2018 </a></li>
        
        									<li><a href="{!! URL::to('/mis_report_2017') !!}"><i class="fa fa-angle-right"></i> MIS Report 2017</a></li>
        
        								</ul>
        
        							</li>
									 <li><a href="{!! URL::to('/bill_report') !!}"><i class="fa fa-bar-chart  icon"></i>
									 Bill Report</a>
</li>



<li><a href="{!! URL::to('/mis_bill_report') !!}"><i class="fa fa-bar-chart  icon"></i><i class="fa fa-clipboard i-right"></i>
									 Sales Bill Report</a></li>
<li><a href="{!! URL::to('/mis_in_out') !!}"><i class="fa fa-bar-chart icon"></i><i class="fa fa-clipboard i-right"></i>
									 Raw/Paste Report</a></li>
								@endif
							@if(Entrust::can('backup'))
							<li><a href=""><i class="fa fa-database icon"></i><i class="fa fa-angle-double-down i-right"></i> Back Up</a>
								<ul>
									<li><a href="<?php echo URL(); ?>/public/export_db.php" target="_blank"><i class="fa fa-database icon"></i> Data Backup</a></li>
								</ul>
							</li>
							@endif
							
						</ul>

						<div class="clear"></div>

					</div><!-- End div #sidebar-menu -->

				</div><!-- End div .sidebar-inner .slimscroller -->

            </div><!-- End div .body .rows .scroll-y -->

			

			<!-- Sidebar footer -->
  <div class="footer rows animated fadeInUpBig">

				<div class="logo-brand header sidebar rows">

					<div class="logo">

						<h1 ><a style="color:#6C7A89" href="{!! URL::to('/') !!}">
						 Toka INK Bangladesh Ltd.</a> </h1>

						<button class="sidebar-toggle">toggle</button>

					</div>

				</div>

            </div><!-- End div .footer .rows -->
         

        </div>
<script type="text/javascript">
$(document).ready(function(){
  $('ul li a').click(function(){
    $('li a').removeClass("active");
    $(this).addClass("active");
});
});
</script>
		<!-- END SIDEBAR -->