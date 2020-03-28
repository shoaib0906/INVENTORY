
			  <div class="form-group">
			    {!! Form::label('department_id',trans('messages.Department'),[])!!}
				{!! Form::select('department_id', [''=>''] + $departments,isset($designation->department_id) ? $designation->department_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Department'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('top_designation_id',trans('messages.Top Designation'),[])!!}
				{!! Form::select('top_designation_id', [''=>''] + $top_designations,isset($designation->top_designation_id) ? $designation->top_designation_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Top Designation'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('designation',trans('messages.Designation'),[])!!}
				{!! Form::input('text','designation',isset($designation->designation) ? $designation->designation : '',['class'=>'form-control','placeholder'=>'Enter Designation'])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('designation-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
