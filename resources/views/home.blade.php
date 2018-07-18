@extends('layouts.app')

@section('content')

    <div class="container">

        <div id="weatherIndicators" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

@foreach ($locations as $index=>$location)

            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <weather zipcode="{{ $location->zipcode }}"></weather>
            </div>

@endforeach

          </div>

        </div>

    </div>

@endsection
