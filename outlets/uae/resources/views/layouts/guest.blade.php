<!DOCTYPE html>
<html>
	<head>
	<title>{!! config('config.application_title') ? : config('constants.ITEM_NAME') !!}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="{!! URL::to('assets/img/Rent_Home-512.png') !!}">
	<!-- BOOTSTRAP -->
	{!! HTML::style('assets/css/bootstrap.min.css') !!}
	
	{!! HTML::style('assets/third/select2/css/select2.css') !!}
	{!! HTML::style('assets/css/style.css') !!}
	{!! HTML::style('assets/css/style-responsive.css') !!}
	{!! HTML::style('assets/css/animate.css') !!}
	{!! HTML::style('assets/third/pnotify/pnotify.custom.min.css') !!}
	{!! HTML::style('assets/third/font-awesome/css/font-awesome.min.css') !!}
	{!! HTML::style('assets/third/icheck/skins/flat/blue.css') !!}
	{!! HTML::style('assets/css/custom.css') !!}
    <style type="text/css">
		#dashbord_back{
				background:  url('assets/img/078992480_prevstill.jpeg') no-repeat;
				background-attachment: fixed;
    background-position: center top; 
			}
			.footer {
		  position: absolute;
		  right: 0;
		  bottom: 0;
		  left: 0;
		  color:white;
		  padding: 1rem;
		  text-align: center;
		}
	</style>
	<!-- BODY -->
	<body class="tooltips full-content" id="dashbord_back">
	
	<!-- BEGIN PAGE -->
	<div class="container">
	
		@yield('content')

		<div class="footer">
				<p class="pull-right">{!! config('config.credit') !!}</p>
				</div>
	</div><!-- End div .container -->
	<!-- END PAGE -->

	<!--
	================================================
	JAVASCRIPT
	================================================
	-->
	<!-- Basic Javascripts (Jquery and bootstrap) -->
	{!! HTML::script('assets/js/jquery-1.11.3.min.js') !!}
	{!! HTML::script('assets/js/bootstrap.min.js') !!} 
	{!! HTML::script('assets/js/jquery.validate.min.js') !!}
	{!! HTML::script('assets/third/pnotify/pnotify.custom.min.js') !!}

	@include('notification')
	
	<!-- VENDOR -->

	<!-- Slimscroll js -->
	{!! HTML::script('assets/third/slimscroll/jquery.slimscroll.min.js') !!}

	<!-- Bootstrao selectpicker js -->
	{!! HTML::script('assets/third/select/bootstrap-select.min.js') !!}
	
	<!-- Summernote js -->
	{!! HTML::script('assets/third/summernote/summernote.js') !!}
	
	<!-- Bootstrap file input js -->
	{!! HTML::script('assets/third/input/bootstrap.file-input.js') !!}
	
	<!-- Bootstrao datepicker js -->
	{!! HTML::script('assets/third/datepicker/js/bootstrap-datepicker.js') !!}

	
	<!-- Icheck js -->
	{!! HTML::script('assets/third/icheck/icheck.min.js') !!}
	
	<!-- Form validation js -->
	{!! HTML::script('assets/js/validation-form.js') !!}
	{!! HTML::script('assets/js/wmlab.js') !!}
	
    <script>
	$(document).ready(function() { 
		Validate.init(); 
	});
	</script>

	</body>
</html>