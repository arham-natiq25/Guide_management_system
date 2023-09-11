@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="font-weight-bold">Add Trips</h3> <br>
                    <a href="{{ route('trips.index') }}"  class="btn btn-default">Back to List</a>

                </div>
                <!-- /.card-body -->
                <form method="POST" action="{{ route('trips.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="trip_name">Trip Name</label>
                                <input type="text" class="form-control" value="{{ old('trip_name') }}" name="trip_name" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="length">Length</label>
                                <input {{ old('length')=='morning' ? 'checked' : '' }} type="radio" name="length" value="morning" class="" id=""> Morning
                                <input type="radio" {{ old('length')=='afternoon' ? 'checked' : '' }} name="length" value="afternoon" class="" id=""> After
                                Noon
                                <input {{ old('length')=='fullday' ? 'checked' : '' }} type="radio" name="length" value="fullday" class="" id=""> Full day
                                <input {{ old('length')=='evening' ? 'checked' : '' }} type="radio" name="length" value="evening" class="" id=""> Evening
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="lunch">This trip has Lunch?</label>
                                <input type="radio" {{ old('lunch')== '1' ? 'checked' : '' }} name="lunch" value="1" class="" id=""> YES
                                <input type="radio" {{ old('lunch')=='0' ? 'checked' : '' }} name="lunch" value="0" class="" id=""> NO
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label>Start time</label>
                                <div class="row">

                                    <div class="col-2">
                                        <select class="form-control select2" name="start_time[]">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control select2" name="start_time[]">
                                            @for ($i = 0; $i < 60; $i++)
                                                <option {{ $i < 10 ? '0' . $i : $i }} value="{{ $i < 10 ? '0'. $i : $i }}">
                                                    {{ $i < 10 ? '0' . $i : $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control select2" name="start_time[]">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                    </div>

                                </div>

                                </select>
                            </div>
                            <div class="col-12">
                                <label>End time</label>
                                <div class="row">

                                    <div class="col-2">
                                        <select class="form-control select2" name="end_time[]">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control select2" name="end_time[]">
                                            @for ($i = 0; $i < 60; $i++)
                                                <option {{ $i < 10 ? '0' . $i : $i }} value="{{ $i < 10 ? '0' . $i : $i }}">
                                                    {{ $i < 10 ? '0' . $i : $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control select2" name="end_time[]">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                    </div>
                                </div>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="days">Days</label>
                            <div class="form-check">
                                <input {{ old('day[0]')=='sunday' ? 'checked' : '' }} class="form-check-input" name="days[]" value="sunday" type="checkbox">
                                <label class="form-check-label">Sunday</label> <br>
                                <input {{ old('day')=='monday' ? 'checked' : '' }}  class="form-check-input" name="days[]" value="monday" type="checkbox">
                                <label class="form-check-label">Monday</label><br>
                                <input  {{ old('day')=='tuesday' ? 'checked' : '' }} class="form-check-input" name="days[]" value="tuesday" type="checkbox">
                                <label class="form-check-label">Tuesday</label> <br>
                                <input {{ old('day')=='wednesday' ? 'checked' : '' }}  class="form-check-input" name="days[]" value="wednesday" type="checkbox">
                                <label class="form-check-label">Wednesday</label> <br>
                                <input {{ old('day')=='thursday' ? 'checked' : '' }}  class="form-check-input" name="days[]" value="thursday" type="checkbox">
                                <label class="form-check-label">Thursday</label> <br>
                                <input {{ old('day')=='friday' ? 'checked' : '' }}  class="form-check-input" name="days[]" value="friday" type="checkbox">
                                <label class="form-check-label">Friday</label> <br>
                                <input  {{ old('day')=='saturday' ? 'checked' : '' }} class="form-check-input" name="days[]" value="saturday" type="checkbox">
                                <label class="form-check-label">Saturday</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="period">Period</label>
                            <input {{ old('period')=='month' ? 'checked' : '' }} type="radio" name="period" value="month" class="" id=""> Month
                            <input {{ old('period')=='year_round' ? 'checked' : '' }} type="radio" name="period" value="year_round" class="" id=""> Year
                            Round
                            <input {{ old('period')=='start_end_days' ? 'checked' : '' }} type="radio" name="period" value="start_end_days" class="" id="">
                            Start / End days
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 1  person : $ </label> <br>
                                <input type="text" value="{{ old('price_1_person') }}" name="price_1_person" id="" class="py-2">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 2 person : $ </label> <br>
                                <input type="text" value="{{ old('price_2_person') }}" name="price_2_person" id="" class="py-2">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 3 person : $ </label> <br>
                                <input type="text" value="{{ old('price_3_person') }}" name="price_3_person" id="" class="py-2">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 4 person : $ </label> <br>
                                <input type="text" value="{{ old('price_4_person') }}" name="price_4_person" id="" class="py-2">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 5  person : $ </label> <br>
                                <input type="text" value="{{ old('price_5_person') }}" name="price_5_person" id="" class="py-2">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 6 person : $ </label> <br>
                                <input type="text" value="{{ old('price_6_person') }}" name="price_6_person" id="" class="py-2">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 7 person : $ </label> <br>
                                <input type="text" value="{{ old('price_7_person') }}" name="price_7_person" id="" class="py-2">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 8  person : $ </label> <br>
                                <input type="text" value="{{ old('price_8_person') }}" name="price_8_person" id="" class="py-2">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="">Price / 9  person : $ </label> <br>
                                <input type="text" value="{{ old('price_9_person') }}" name="price_9_person" id="" class="py-2">
                            </div>
                            <br>
                            <div class="col-md-4 mt-2">
                                <label for="display_order">Display order*</label> <br>
                                <input type="text" value="{{ old('display_order') }}" name="display_order" class="py-2">
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="">
                                    <label>Status</label> <br>
                                    <input {{ old('status')=='1' ? 'checked' : '' }} type="checkbox" name="status" value="1" class=""> Active
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label >Backend Only</label> <br>
                                    <input {{ old('backend_only')== '1' ? 'checked' : '' }} type="checkbox" name="backend_only" value="1" class="">
                                    <label class="form-check-label" >Yes</label>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label >This trip has sales tax</label> <br>
                                    <input type="radio" {{ old('tax')=='1' ? 'checked' : '' }} name="tax" value="1" class="" id=""> YES
                                    <input type="radio" {{ old('tax')=='0' ? 'checked' : '' }} name="tax" value="0" class="" id=""> NO
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image"><br>
                                </div>
                            </div>
                            <p>Dimension is 640 X 480 (MAX:4mb) <br> JPG format is recomemded</p>
                            </div>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>

                </div>


            </div>



            </form>

    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>
@endsection
