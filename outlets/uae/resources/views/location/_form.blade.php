
			  <div class="form-group">
			    {!! Form::label('location_name',trans('messages.Location Name'),[])!!}
				{!! Form::input('text','location_name',isset($location->location_name) ? $location->location_name : '',['class'=>'form-control','placeholder'=>'Enter Location Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('location_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('location_description',isset($location->location_description) ? $location->location_description : '',['size' => '30x3', 'class' => 'form-control summernote-small', 'placeholder' => 'Enter Description'])!!}
			  </div>
			    {{ App\Classes\Helper::getCustomFields('location-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
