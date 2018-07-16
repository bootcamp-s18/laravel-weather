@extends('layouts.card')

@section('title')
	New Location
@endsection

@section('stuff')

	<form method="post" action="/locations">

		<div class="form-group">
			@csrf
			<label for="zip">Zipcode</label>
			<input class="form-control" type="text" id="zip" name="zip">
		</div>

		<button class="btn btn-primary" type="submit">Save to My Account</button>

	</form>

@endsection