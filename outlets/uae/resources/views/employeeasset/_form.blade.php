			  @if(isset($er))
              <div class="ui-pnotify " aria-live="assertive" style="width: 300px; opacity: 1; display: block; overflow: visible; right: 25px; top: 55px;">
                <div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" role="alert" style="min-height: 16px; overflow: hidden;">
                    <div class="ui-pnotify-closer" style="cursor: pointer;">
                        <span class="glyphicon glyphicon-remove" title="Close" onclick="$('.ui-pnotify').remove();"></span>
                    </div>
                    <div class="ui-pnotify-sticker" style="cursor: pointer; visibility: hidden;">
                        <span class="glyphicon glyphicon-play" title="Stick"></span>
                    </div>
                    <div class="ui-pnotify-icon"><span class="glyphicon glyphicon-warning-sign"></span></div>
                    <h4 class="ui-pnotify-title">Error</h4>
                    <div class="ui-pnotify-text">{{ $er }}</div>
                    <div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div>
                </div>
            </div>	
              @endif
              <div class="form-group">
                {!! Form::label('employee_id',trans('messages.Employee'),['class' => 'col-sm-2 control-label'])!!}                
                {!! Form::select('employee_id', [null=>'Please Select'] + $users,isset($employeeasset->employee_id) ? $employeeasset->employee_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Employee'])!!}
              </div>	
              <div class="form-group">
                {!! Form::label('asset_id',trans('messages.Asset'),['class' => 'col-sm-2 control-label'])!!}                
                {!! Form::select('asset_id', [null=>'Please Select'] + $asset_types,isset($employeeasset->asset_id) ? $employeeasset->asset_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Asset'])!!}
              </div>	
			  <div class="form-group">              	
			    {!! Form::label('issue_date',trans('messages.Issue Date'),[])!!}                
                {!! Form::input('text','issue_date',isset($employeeasset->issue_date) ? $employeeasset->issue_date : '',['class'=>'form-control','placeholder'=>'Enter Issue Date','readonly' => 'true'])!!}
			  </div>
              @if(isset($employeeasset->id))
              <div class="form-group">              	
			    {!! Form::label('return_date',trans('messages.Return Date'),[])!!}                
                {!! Form::input('text','return_date',isset($employeeasset->return_date) ? $employeeasset->return_date : '',['class'=>'form-control','placeholder'=>'Enter Return Date','readonly' => 'true'])!!}
			  </div>
              @endif
			  <div class="form-group">
			    {!! Form::label('comments',trans('messages.Comment'),[])!!}
			    {!! Form::textarea('comments',isset($employeeasset->comments) ? $employeeasset->comments : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Comments'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
