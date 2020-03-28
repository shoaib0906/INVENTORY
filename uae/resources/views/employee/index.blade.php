@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default col-sm-12" >
					<div class="panel-heading" style="background-color:#34495e;color:white;">
						<center><h4><strong> List of Employee  </strong></h4></center>
					</div>
					<br/>
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>
		</div>

	@stop