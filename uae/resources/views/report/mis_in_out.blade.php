@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default col-sm-8" >
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><h2><strong>Product IN & Out Report '{{date('Y')}}  </strong></h2></center>
<center><h4><strong>Raw Materials and Paste</strong></h4></center>
					</div>
					<br/>
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>
		</div>

	@stop