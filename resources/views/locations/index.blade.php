@extends('layouts.card')

@section('title')

	My Dashboard

@endsection

@section('stuff')

	<div class="pb-3 pt-1 ml-2">
		<a href="/locations/create">Save a New Location to Your Account</a>
	</div>

	<div class="d-flex flex-wrap justify-content-start">

	@foreach ($locations as $location)

		<div class="card m-2 text-center">
		  <div class="card-body">
		    <h5 class="card-title">{{ $location->zipcode }}</h5>
		    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
		    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
		    <a class="btn btn-sm btn-outline-primary" href="/locations/{{ $location->id }}/edit" class="card-link">Edit</a>
		    <form style="display: inline-block;" method="post" action="/locations/{{ $location->id }}">
		    	@csrf
		    	@method('DELETE')
		    	<button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
		    </form>
		  </div>
		</div>

	@endforeach

	</div>

@endsection