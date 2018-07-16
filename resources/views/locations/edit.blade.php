@extends('layouts.card')

@section('title')
	Edit a Location
@endsection

@section('stuff')

	<form method="post" action="/locations/{{ $location->id }}">

		<div class="form-group">
			@csrf
			@method('PUT')
			<label for="zip">Zipcode</label>
			<input class="form-control" type="text" id="zip" name="zip" value="{{ $location->zipcode }}">
		</div>

		<button class="btn btn-primary" type="submit">Update</button>

	</form>

@endsection