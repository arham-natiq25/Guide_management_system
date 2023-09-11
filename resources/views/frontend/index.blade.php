@extends('frontend.master')

@section('content')
<div class="row">
    <div class="col-12 my-4">
        <h4>Trip List</h4>
    </div>
    @foreach ($trips as $trip )
    <div class="col-md-6 col-lg-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset($trip->image) }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title"><strong> {{ $trip->trip_name }}</strong>
                </h5>
              <p class="card-text mt-1">Price Per person : / ${{ $trip->price_1_person }} </p>
              <a href="{{ route('gms.selectDate',['id' => $trip->id]) }}" class="btn btn-primary">Select Trip</a>
            </div>
          </div>
    </div>
    @endforeach
    </div>
    <!-- /.row -->

@endsection
