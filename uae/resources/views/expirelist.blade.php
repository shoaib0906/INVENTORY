@extends('layouts.default')



	@section('content')

		<div class="row">

			<div class="col-sm-12">

				<div class="box-info">
					<h2><strong>{!! trans('messages.Expire List') !!}</strong> </h2><br />
					@include('common.datatable',['col_heads' => $col_heads])<br />
				</div>

			</div>

		</div>



	@stop