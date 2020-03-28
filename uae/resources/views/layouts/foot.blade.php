	<!--
	================================================
	JAVASCRIPT
	================================================
	-->
	<!-- Basic Javascripts (Jquery and bootstrap) -->
	{!! HTML::script('assets/third/fullcalendar/moment.min.js') !!}
	{!! HTML::script('assets/js/jquery-1.11.3.min.js') !!}
	{!! HTML::script('assets/js/bootstrap.min.js') !!} 
	{!! HTML::script('assets/js/jquery.validate.min.js') !!}
	{!! HTML::script('assets/js/textAvatar.js') !!}
	{!! HTML::script('assets/third/pnotify/pnotify.custom.min.js') !!}

	@include('notification')
	
	{!! HTML::script('assets/js/bootbox.js') !!}
	<!-- VENDOR -->

	<!-- Slimscroll js -->
	{!! HTML::script('assets/third/slimscroll/jquery.slimscroll.min.js') !!}

    @if(in_array('calendar',$assets))
	<!-- Full Calendar js -->
	{!! HTML::script('assets/third/fullcalendar/fullcalendar.min.js') !!}
	@endif

	<!-- select2 js -->
	{!! HTML::script('assets/third/select2/js/select2.min.js') !!}

	<!-- datatable js -->
	{!! HTML::script('assets/third/datatable/datatables.min.js') !!}
	
	<!-- Morris js -->
	{!! HTML::script('assets/third/raphael/raphael-min.js') !!}
	{!! HTML::script('assets/third/morris/morris.js') !!}
	
	<!-- Nifty modals js -->
	{!! HTML::script('assets/third/nifty-modal/js/classie.js') !!}
	{!! HTML::script('assets/third/nifty-modal/js/modalEffects.js') !!}
	
	<!-- Sortable js -->
	{!! HTML::script('assets/third/sortable/sortable.min.js') !!}
	
	<!-- Bootstrao selectpicker js -->
	{!! HTML::script('assets/third/select/bootstrap-select.min.js') !!}
	
	<!-- Summernote js -->
	{!! HTML::script('assets/third/summernote/summernote.js') !!}
	
	<!-- Magnific popup js -->
	{!! HTML::script('assets/third/magnific-popup/jquery.magnific-popup.min.js') !!}
	
	<!-- Bootstrap file input js -->
	{!! HTML::script('assets/third/input/bootstrap.file-input.js') !!}
	
	<!-- Bootstrao datepicker js -->
	{!! HTML::script('assets/third/datepicker/js/bootstrap-datepicker.js') !!}

	
	<!-- Icheck js -->
	{!! HTML::script('assets/third/icheck/icheck.min.js') !!}
	
    @if(in_array('mutidatepicker',$assets))
	{!! HTML::script('assets/third/multidatepicker/bootstrap-datepicker.js') !!}
    @endif

    @if(in_array('datetimepicker',$assets))
	{!! HTML::script('assets/third/datetimepicker/bootstrap-datetimepicker.js') !!}
    @endif

	<!-- Form wizard js -->
	{!! HTML::script('assets/third/wizard/jquery.snippet.js') !!}
	{!! HTML::script('assets/third/wizard/jquery.easyWizard.js') !!}
	{!! HTML::script('assets/third/wizard/scripts.js') !!}

	<!-- Form validation js -->
	{!! HTML::script('assets/js/validation-form.js') !!}
	<!-- {!! HTML::script('assets/third/validator/bootstrapValidator.min.js') !!} -->
	<!-- {!! HTML::script('assets/third/validator/example.js') !!} -->

	{!! HTML::script('assets/js/wmlab.js') !!}
	
    <script>
    
    @if(in_array('datetimepicker',$assets))
    $('.timepicker').datetimepicker({
		autoclose: 1,
		startView: 1});
    @endif 
    
    $("#reset-date-of-leaving").click(function(){
	    $('#date_of_leaving').val("");
	})
    $("#reset-date-of-joining").click(function(){
	    $('#date_of_joining').val("");
	})
    
	$(document).ready(function() { 
		$('.textAvatar').nameBadge();
		$("[data-toggle=popover]").popover({container: 'body'});
    	@if(in_array('calendar',$assets))
			$('#calendar').fullCalendar({
				header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
				events: {!! json_encode($events) !!},
				eventRender: function(event, element) {
			      	$(element).tooltip({title: event.title});             
			    }
			});
		@endif
		
		$('.showhide-textarea').hide();

		$(document).on('change', '#field_type', function(){
		 	var field = $('#field_type').val();
			if(field == 'select' || field == 'radio' || field == 'checkbox')
				$('.showhide-textarea').show();
			else
				$('.showhide-textarea').hide();
		});

		@if(in_array('mail_config',$assets))
			$('.mail_config').hide();
			@if(config('mail.driver') == 'mail')
			$('#mail_configuration').show();
			@elseif(config('mail.driver') == 'sendmail')
			$('#sendmail_configuration').show();
			@elseif(config('mail.driver') == 'log')
			$('#log_configuration').show();
			@elseif(config('mail.driver') == 'smtp')
			$('#smtp_configuration').show();
			@elseif(config('mail.driver') == 'mandrill')
			$('#mandrill_configuration').show();
			@elseif(config('mail.driver') == 'mailgun')
			$('#mailgun_configuration').show();
			@endif
			$(document).on('change', '#mail_driver', function(){
				$('.mail_config').hide();
			 	var field = $('#mail_driver').val();
				if(field == 'smtp')
					$('#smtp_configuration').show();
				else if(field == 'mandrill')
					$('#mandrill_configuration').show();
				else if(field == 'mailgun')
					$('#mailgun_configuration').show();
				else if(field == 'mail')
					$('#mail_configuration').show();
				else if(field == 'sendmail')
					$('#sendmail_configuration').show();
				else if(field == 'log')
					$('#log_configuration').show();
			});
		@endif

        $('.mdatepicker-input').datepicker();

		@if(in_array('graph',$assets))
		if ($('#morris-home').length > 0){
		//MORRIS
		Morris.Area({
		  element: 'morris-home',
		  data: [ {!! $graph_data !!}
		  ],
		  xkey: 'y',
		  ykeys: ['a'],
		  labels: ['Present Staff'],
		  resize: true,
		  lineColors: ['#5CB85C', '#2891CD']
		});
		}
		@endif
		
		// Javascript to enable link to tab
		var hash = document.location.hash;
		var prefix = "tab_";
		if (hash) {
		    $('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown', function (e) {
		    window.location.hash = e.target.hash.replace("#", "#" + prefix);
		});

		Validate.init(); 

		$('.datatable').DataTable({
	        dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'li><'col-sm-7'p>>",
	        buttons: [
	            {
	                extend: 'print',
	                text: '<i class="fa fa-print"></i>',
	                title:"{!! $page_title !!}",
	                exportOptions: {
	                    columns: ':visible'
	                }
	            },
	            {
	                extend: 'excel',
	                text: '<i class="fa fa-file-excel-o"></i>',
	                exportOptions: {
	                    columns: ':visible'
	                }
	            },
	            {
	                extend: 'pdf',
	                text: '<i class="fa fa-file-pdf-o"></i>',
	                title:"{!! $page_title !!}",
	                exportOptions: {
	                    columns: ':visible'
	                }
	            },
	            {
	                extend: 'copy',
	                text: '<i class="fa fa-files-o"></i>',
	                exportOptions: {
	                    columns: ':visible'
	                }
	            },
	            {
	                extend: 'colvis',
	                text: '<i class="fa fa-columns"></i>'
	            }
	        ],
    		"ajax": "{{ url('data.txt') }}",
    		"ordering": true,
    		"autoWidth": true,
    		"columnDefs": [
			    { "orderable": false, "targets": 0 }
			]
	    });
	});
	
	
	$(document).ready(function() {
    	$('#holiday_two').on('change', function() {
   			alert("asdasdjkh"); 
		});
	});
	</script>
<script type="text/javascript">

  $('.edit_product').click(function(){
  	
      var id=$(this).attr('id');
      var category = $(this).attr("data-category");
      var unit = $(this).attr("data-unit");
      var title = $(this).attr("data-title");
      var code = $(this).attr("data-code");
      var price = $(this).attr("data-price");
      var order = $(this).attr("data-order");
      
    $("#product_modal #category").val( category );
    $("#product_modal #unit").val( unit );
    $("#product_modal #selling_price").val( price );
    $("#product_modal #title").val( title );
    $("#product_modal #code").val( code );
    $("#product_modal #order").val( order );
    $("#product_modal #id").val( id );
      //alert(id);
     // window.location.href='product_edit/'.concat(id);
  });
  $('.delete_product').click(function(){
      var id=$(this).attr('id');
     //alert(id);
      var r = confirm("Are you sure to delete!");
    if (r == true) {
        window.location.href='product_delete/'.concat(id);
    } else {
        null;
    }
      
  });
 $(document).ready(function(){
    	var field = $('#caterory_in').val();
			if(field == 'R')
				$('#cost_price_div').show();
			else
				$('#cost_price_div').hide();
    });
    $(document).on('change', '#caterory_in', function(){
		 	var field = $('#caterory_in').val();
			if(field == 'R')
				$('#cost_price_div').show();
			else
				$('#cost_price_div').hide();
		});
    $(document).ready(function(){
    	var field = $('#caterory_out').val();
			if(field == 'R'||field == 'P')
				$('#sales_price_div').hide();
			else
				$('#sales_price_div').show();
    });
    $(document).on('change', '#caterory_out', function(){
		 	var field = $('#caterory_out').val();
			if(field == 'R'||field == 'P')
				$('#sales_price_div').hide();
			else
				$('#sales_price_div').show();
		});
  $('.edit_customer').click(function(){
  	
      var id=$(this).attr('id');
      var name = $(this).attr("data-name");
      var address = $(this).attr("data-address");
      
    $("#cutomer_modal #name").val( name );
    $("#cutomer_modal #address").val( address );
    $("#cutomer_modal #id").val( id );
      //alert(id);
     // window.location.href='product_edit/'.concat(id);
  });
</script>
<script type="text/javascript">
    /* $( "#category").change(function() {
            $category = $(this).find(":selected").val();
            //alert($category);
           window.location.href='active_category/'.concat($category);            
        });*/
      $('.delete_product_in').click(function(){
      var id=$(this).attr('id');
     //alert(id);
var r = confirm("Are you sure to delete!");
    if (r == true) {
        window.location.href='delete_product_in/'.concat(id);
    } else {
        null;
    }
      
      
  });

	$('.delete_product_out').click(function(){
      var id=$(this).attr('id');
     //alert(id);
      var r = confirm("Are you sure to delete!");
    if (r == true) {
       window.location.href='delete_product_out/'.concat(id);
    } else {
        null;
    }
      
  });  
	$('.view_bill_report').click(function(){
      var id=$(this).attr('id');
     //alert(id);
      
      window.location.href='view_bill_report/'.concat(id);
  });  
    
</script>
<script type="text/javascript">
     $( "#caterory_in").change(function() {
            $caterory_in = $(this).find(":selected").val();
           
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});                    
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#category_product_code').empty();

            $.ajax({
                url: 'caterory_in/'.concat($caterory_in),
                type: 'get',
                contentType: 'application/json',
                data: {_token: CSRF_TOKEN},
                //dataType: 'JSON',
                success: function (data) {

                    //$('#category_product_code').append("<option value="+data+">"+data+"</option>");
                    $('#category_product_code').html(data);

                }
            });

            
        });
     $( "#caterory_out").change(function() {
            $category_out = $(this).find(":selected").val();
           //alert($category_out);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});                    
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#category_product_code_out').empty();

            $.ajax({
                url: 'category_out/'.concat($category_out),
                type: 'get',
                contentType: 'application/json',
                data: {_token: CSRF_TOKEN},
                //dataType: 'JSON',
                success: function (data) {

                    //$('#category_product_code').append("<option value="+data+">"+data+"</option>");
                    $('#category_product_code_out').html(data);

                }
            });

            
        });
     
</script>
<script type="text/javascript">

  function TodoCtrl($scope) {
    var total_amount = $('#total_amount').val();
     //$('#net_amout').val(total_amount);
     $scope.less=null;
     $scope.one=null;
     $scope.total = total_amount;
    $scope.total = function(){
      if($scope.less==null){
        return total_amount-(total_amount * $scope.two/100);
      }
      else if($scope.less==null && $scope.two==null)
      {
      	$('#net_amout').val(total_amount);	
      }
      else{
        return total_amount-(total_amount * $scope.two/100)-$scope.less; 

      }      
    };

      
}
$(document).ready(function(){
  $('ul li a').click(function(){
    $('li a').removeClass("active");
    $(this).addClass("active");
});
});
</script>
<script type="text/javascript">
function confirm_click()
{
return confirm("Are you sure to delete?");
}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular.min.js"></script>

	</body>
</html>
