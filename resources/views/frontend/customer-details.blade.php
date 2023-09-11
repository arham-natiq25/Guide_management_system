@extends('frontend.master')

@section('content')
<form action="{{ route('gms.save') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12 mt-4">
            <div class="form-group">
                <label for="title">Trip:</label>
                <span class="">{{ $trip->trip_name }}</span>
                <input type="hidden" value="{{ $trip->id }}" name="trip_id">
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <span class="">{{ date('m/d/Y', strtotime(request('date'))) }}</span>
                <input type="hidden" value="{{ date('m/d/Y', strtotime(request('date'))) }}" name="date">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Number of People</label>
            <select class="form-control select2" name="total_persons">
                <option>Select</option>
                @for ($i = 1; $i < 30; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" value="{{ old('email') }}"
                name="email">
        </div>
        <div class="form-group col-md-6">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" value="{{ old('fname') }}"
                name="fname">
        </div>
        <div class="form-group col-md-6">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" value="{{ old('lname') }}"
                name="lname">
        </div>
        <div class="form-group col-md-6">
            <label for="phone">Mobile Number</label>
            <input type="text" class="form-control" value="{{ old('phone') }}"
                name="phone">
        </div>
        <div class="form-group col-md-6">
            <label for="location">Meeting Location</label>
            <select class="form-control select2" name="location_id">
                <option>Select Location</option>
                @foreach ($locations as $l)
                    <option value="{{ $l->id }}">{{ $l->location_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <button type="button" class="btn btn-info">Payment</button>
        </div>

    </div>
    <button class="btn btn-success">Submit</button>
</form>
@endsection
