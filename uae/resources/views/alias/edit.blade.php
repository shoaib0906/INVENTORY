
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Edit Alias') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($alias,['method' => 'PATCH','route' => ['alias.update',$alias->id] ,'class' => 'alias-form']) !!}
			@include('alias._form', ['buttonText' => 'Update'])
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>
