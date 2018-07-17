@extends('layouts.card')

@section('title')
	Show a Location
@endsection

@section('stuff')

	<div class="pb-3">
		<div><strong>Zipcode:</strong> {{ $location->zipcode }}</div>
		<div><strong>Created at:</strong> {{ $location->created_at }}</div>
		<div><strong>Last updated at:</strong> {{ $location->updated_at }}</div>
	</div>

	<a href="/locations">Return to My Locations</a>

@endsection