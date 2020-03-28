<form enctype="multipart/form-data" accept-charset="UTF-8"  action="{{ url('/configuration/time') }}" method='post' files='true'>								
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<div class="col-sm-6">			
		<div class="form-group">
			{!! Form::label('Select_Year',trans('messages.Select')." Year",[])!!}
				<select class="form-control input-xlarge select2me" name="financial_year">
					<option value="1990"> 1990</option>
					<option value="1990">1991</option>
				</select>
		</div>
		<div class="form-group">
			<label>No. of Working Hours</label>
			    <div class="pull-right box-info">
			        <input class="" type="text" name="ot_emp_hour" /><label> (O.T. Employees)</label>        
			        <input class="" type="text" name="non_ot_emp_hour" /><label> (Non O.T. Employees)</label>
			    </div>
		</div>
		<div class="form-group">
			    <label>Committed OT Hrs</label>
				<input type="text" class="form-control input-xlarge" name="commit_ot_hou" />
		</div>
			  
</div>

<div class="col-sm-6">
		<div class="box-info">
			<div class="form-group">
				    <!--{!! Form::label('finance_ymonth',trans('messages.Financial Year Starting'),[])!!}
					{!! Form::select('finance_ymonth', [null=>'Select Month',1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'],config('config.finance_ymonth'),['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Month'])!!}-->
				
				     {!! Form::label('Week Holiday')!!}
				     <select class="form-control input-xlarge" onchange="showDiv(this)" name="holiday">
				     <option value="1">one</option>
				     <option value="2">Two</option>
				     </select>
				    <br />
				     <div class="box-info">

					    <select name="holiday_one">
							<option>Friday</option>
							<option>Saterday</option>
							<option>Sunday</option>
						</select>
						<div id="if_holiday_two" style="display:none;" >
						    <select name="holiday_two" >
								<option>Friday</option>
								<option>Saterday</option>
								<option>Sunday</option>
							</select>
						</div>
					</div>



				
			</div>
			<div class="form-group">

			    <label>Calculated In Term of</label>

			    <div class="box-info">
			    <div class="checkbox">
				       <select name="staf_cal_days">
					<option>30 days</option>
					<option>31 days</option>
					</select> <label> Staff</label>        
				</div>
				<div class="checkbox">
				        <select name="non_staf_cal_days">
					<option>30 days</option>
					<option>30 days</option>
					</select><label> Non-Staff</label>
				</div>
			    </div>

			</div>
        </div>		

		<div class="box-info">
				  <div class="form-group">
				     <label>Normal O.T. Rate</label>
					<input type="text" class="form-control input-xlarge" name="normal_ot_rate" />
					</div>
					<div class="form-group">
					<label>Holiday O.T. Rate</label>
					<input type="text" class="form-control input-xlarge" name="holiday_ot_rate" />
					</div>
					<div class="form-group">
					 <label>Special O.T. Rate</label>
					<input type="text" class=" form-control input-xlarge" name="special_ot_rate" />
				  </div>
		</div>
			  	

			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}

</div>

<script type="text/javascript">
function showDiv(elem){
   if(elem.value == 2)
      document.getElementById('if_holiday_two').style.display = "inline";	
	else	
	document.getElementById('if_holiday_two').style.display = "none";	
	}	
</script>