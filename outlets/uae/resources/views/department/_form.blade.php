<div class="col-md-6">
			  <div class="form-group">
			    {!! Form::label('department_name',trans('messages.Department Name'),[])!!}
				{!! Form::input('text','department_name',isset($department->department_name) ? $department->department_name : '',['class'=>'form-control','placeholder'=>'Enter Property Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('street',trans('messages.street'),[])!!}
				{!! Form::input('text','street',isset($department->street) ? $department->street : '',['class'=>'form-control','placeholder'=>'Enter Street'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('street',trans('messages.city'),[])!!}
				{!! Form::input('text','city',isset($department->city) ? $department->city : '',['class'=>'form-control','placeholder'=>'Enter city'])!!}
			  </div>
</div>
<div class="col-md-6">
			  <div class="form-group">
			    {!! Form::label('state',trans('messages.state'),[])!!}
				{!! Form::input('text','state',isset($department->state) ? $department->state : '',['class'=>'form-control','placeholder'=>'Enter state'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('ZIP',trans('messages.ZIP'),[])!!}
				{!! Form::input('text','ZIP',isset($department->ZIP) ? $department->ZIP : '',['class'=>'form-control','placeholder'=>'Enter ZIP'])!!}
			  </div>

			  <div class="form-group">
			    {!! Form::label('department_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('department_description',isset($department->department_description) ? $department->department_description : '',['size' => '10x1', 'class' => 'form-control', 'placeholder' => 'Enter Description'])!!}
			  </div>
			  <br/>
			    {{ App\Classes\Helper::getCustomFields('department-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add_property'),['class' => 'btn btn-primary']) !!}
			  	<br/>
</div>