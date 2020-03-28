
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Edit Asset') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($asset,['method' => 'PATCH','route' => ['asset.update',$asset->id] ,'class' => 'asset-type-form']) !!}
			@include('asset._form', ['buttonText' => 'Update'])
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>
