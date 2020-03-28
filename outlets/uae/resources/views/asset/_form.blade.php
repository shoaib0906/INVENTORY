
			  <div class="form-group">
			    {!! Form::label('asset_code',trans('messages.Asset Code'),[])!!}
				{!! Form::input('text','asset_code',isset($asset->asset_code) ? $asset->asset_code : '',['class'=>'form-control','placeholder'=>'Enter Asset Code'])!!}
			  </div>
              <div class="form-group">
			    {!! Form::label('asset_name',trans('messages.Asset Name'),[])!!}
				{!! Form::input('text','asset_name',isset($asset->asset_name) ? $asset->asset_name : '',['class'=>'form-control','placeholder'=>'Enter Asset Name'])!!}
			  </div>
              
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
			  	
