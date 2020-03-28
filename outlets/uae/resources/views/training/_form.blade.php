
			  <div class="form-group">
			    {!! Form::label('user_id',trans('messages.Staff'),['class' => 'control-label'])!!}
			    {!! Form::select('user_id', [null=>'Please select'] + $users, isset($leave->user_id) ? $leave->user_id : Auth::user()->id,['class'=>'form-control input-xlarge select2me','placeholder'=>'Select User'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('leave_type_id',trans('messages.Training Name'),['class' => 'control-label'])!!}
			    {!! Form::select('leave_type_id', [''=>''] + $leave_types, isset($leave->leave_type_id) ? $leave->leave_type_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Training Name'])!!}
			  	
			  </div>
			  <div class="form-group">
			    {!! Form::label('from_date',trans('messages.From Date'),[])!!}
				{!! Form::input('text','from_date',isset($leave->from_date) ? $leave->from_date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter From Date','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('to_date',trans('messages.To Date'),[])!!}
				{!! Form::input('text','to_date',isset($leave->to_date) ? $leave->to_date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter To Date','readonly' => 'true'])!!}
			  </div>
			   <div class="form-group">
			    {!! Form::label('hours',trans('messages.Training Duration'),[])!!}
				{!! Form::input('number','training_duration',isset($task->hours) ? $task->hours : '',['class'=>'form-control','placeholder'=>'Enter No of Hours'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('hours',trans('messages.Training Result'),[])!!}
				{!! Form::input('text','training_result',isset($task->hours) ? $task->hours : '',['class'=>'form-control','placeholder'=>'Enter Result of Training'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('leave_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('training_desc',isset($leave->leave_description) ? $leave->leave_description : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}
			  </div>
			 
			  	{{ App\Classes\Helper::getCustomFields('leave-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
