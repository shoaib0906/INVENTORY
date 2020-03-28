	@if(!empty($product))
	@foreach($product as $product)
	<option value="{{$product->code}}">{{$product->code}}</option>
	@endforeach
	@endif
