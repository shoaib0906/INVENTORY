
			  <div class="form-group">
			    {!! Form::label('alias_name',trans('messages.Alias Name'),[])!!}
				{!! Form::input('text','alias_name',isset($alias->alias_name) ? $alias->alias_name : '',['class'=>'form-control','placeholder'=>'Enter Alias Name'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
			  	
