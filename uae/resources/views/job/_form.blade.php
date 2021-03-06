
			  <div class="form-group">
			    {!! Form::label('job_title',trans('messages.Job Title'),[])!!}
				{!! Form::input('text','job_title',isset($job->job_title) ? $job->job_title : '',['class'=>'form-control','placeholder'=>'Enter Job Title'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('designation_id',trans('messages.Designation'),[])!!}
				{!! Form::select('designation_id', [''=>''] + $designations,isset($job->designation_id) ? $job->designation_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Designation'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('numbers',trans('messages.Number of Posts'),[])!!}
				{!! Form::input('number','numbers',isset($job->numbers) ? $job->numbers : '',['class'=>'form-control','placeholder'=>'Enter Number of Posts'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('job_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('job_description',isset($job->job_description) ? $job->job_description : '',['size' => '30x3', 'class' => 'form-control summernote-small', 'placeholder' => 'Enter Description'])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('job-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
