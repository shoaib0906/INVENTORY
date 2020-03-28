<div class="col-sm-6">

    <div class="form-group">

        {!! Form::label('name',trans('messages.Name'))!!}

        {!! Form::input('text','name',isset($dependent->name) ? $dependent->name :'',['class'=>'form-control','placeholder'=>'Enter Name'])!!}

    </div>
    <div class="form-group">

        {!! Form::label('relation',trans('messages.Relationship'),[])!!}

        {!! Form::select('relation', [null=>'Please Select','Spouse'=>'Spouse','Children'=>'Children','Mother'=>'Mother','Father'=>'Father'] ,isset($dependent->relation) ? $dependent->relation :'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Relation'])!!}

    </div>
    <div class="form-group">

        {!! Form::label('visa',trans('messages.Visa Provided by'),[])!!}

        {!! Form::select('visa', [null=>'Please Select','Company'=>'Company','Personal'=>'Personal'] ,isset($dependent->visa) ? $dependent->visa :'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select'])!!}

    </div>
    

</div>
<div class="col-sm-6">	
    <div class="form-group">

        {!! Form::label('issue_date',trans('messages.Issue Date'))!!}

        {!! Form::input('text','issue_date',isset($dependent->issue_date) ? $dependent->issue_date :'',['class'=>'form-control','placeholder'=>'Enter Issue Date','readonly' => 'true'])!!}

    </div>

    <div class="form-group">

        {!! Form::label('depexpiry_date',trans('messages.Expiry Date'))!!}

        {!! Form::input('text','expiry_date',isset($dependent->expiry_date) ? $dependent->expiry_date :'',['class'=>'form-control','id'=>'depexpiry_date','placeholder'=>'Enter Expiry Date','readonly' => 'true'])!!}

    </div>
    <div class="form-group">

        <input type="file" name="file" id="file" class="btn btn-default" title="Select Attachment" />

    </div>
    {!! Form::hidden('user_id',isset($employee->id)?$employee->id:0)!!}
    {!! Form::hidden('dep_id',isset($dependent->id) ? $dependent->id :'0')!!}
    
    {!! Form::submit((isset($dependent->id) || Input::old('dep_id')) ? trans('messages.Update') : trans('messages.Add'),['class' => 'btn btn-primary']) !!}    

</div>