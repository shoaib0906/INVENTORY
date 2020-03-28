@if(isset($dependent->id))
<h2>{!! trans('messages.Edit Dependent') !!}</h2>
<div align="right"><a href="{!! URL::to('/dependent/add/'.$employee->id) !!}" class='btn btn-xs btn-default dependent_edit'> <i class='fa fa-edit'></i> {!! trans('messages.Add New') !!}</a></div>
@else
<h2>{!! trans('messages.Add New Dependent') !!}</h2>
@endif
{!! Form::open(['files'=>true, 'method' => isset($dependent->id)?'PATCH':'POST','route' => 'dependent.store','role' => 'form', 'class'=>'dependent-form']) !!}
    @include('dependent._form', ['buttonText' => 'Update'])
{!! Form::close() !!}