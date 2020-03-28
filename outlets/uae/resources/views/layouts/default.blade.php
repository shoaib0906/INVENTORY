@include('layouts.head')





	<!-- BODY -->

	<body class="tooltips k-rtl">

	

	<!-- BEGIN PAGE -->

	<div class="container">

		<!-- Your logo goes here -->

		<div class=" header sidebar rows" style="background-color:;">

			<div class="" style="margin-left:0px;margin-top:-10px!important;font-family: "Times New Roman";">

				<h3><a href="{!! URL::to('/') !!}" style="color: white!important;padding-left:20px;">
				
				<strong>{!! \App\Classes\Helper::getBranchName() !!} IMS</strong>				</a>
				</h3>

				

			</div>

		</div><!-- End div .header .sidebar .rows -->



		@include('layouts.sidebar')

		

		<!-- BEGIN CONTENT -->

        <div class="right content-page">



			@include('layouts.header')	

			

			<!-- ============================================================== -->

			<!-- START YOUR CONTENT HERE -->

			<!-- ============================================================== -->

            <div class="body content rows scroll-y" style="background-color:white;">

				
            <div style="min-height:450px;">
				@yield('content')
			</div>	
			

				@include('layouts.footer')	

            </div>

			<!-- ============================================================== -->

			<!-- END YOUR CONTENT HERE -->

			<!-- ============================================================== -->

			

			

        </div>

		<!-- END CONTENT -->

		

	</div><!-- End div .container -->

	<!-- END PAGE -->



	<div class="modal fade" id="myTodoModal" role="basic" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

			</div>

		</div>

	</div>

	

	@include('layouts.foot')	



		

	

	

	