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

          <a class="carousel-control-prev" href="#weatherIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#weatherIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

    </div>

@endsection
