Hello from the locations/index.blade.php file!

@foreach ($locations as $location)

	<p>{{ $location->zipcode }}</p>

@endforeach