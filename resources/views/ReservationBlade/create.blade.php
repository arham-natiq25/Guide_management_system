@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="font-weight-light">Add new Reservation</h3> <br>
                    <form method="POST" action="{{ route('reservations.save') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
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
                                <div class="row">
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
                                        <label>Reffered By :</label>
                                        <select class="form-control select2" name="referred">
                                            <option disabled>None</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Guide</label>
                                        <select class="form-control select2" name="guide_id">
                                            <option>Select Guide</option>
                                            @foreach ($guides as $guide)
                                                @php
                                                    $isAvailable = true;

                                                    foreach ($reservations as $reservation) {
                                                        if ($reservation->guide_id === $guide->id &&
                                                            $reservation->date === request('date') ) {

                                                            if ($trip->length === 'fullday') {
                                                                $isAvailable = false;
                                                            } elseif ($trip->length === 'morning' && ($reservation->trip->length === 'morning' || $reservation->trip->length === 'fullday')) {
                                                                $isAvailable = false;
                                                            } elseif ($trip->length === 'evening' && ($reservation->trip->length === 'evening' || $reservation->trip->length === 'fullday')) {
                                                                $isAvailable = false;
                                                            }
                                                        }
                                                    }
                                                @endphp

                                                @if ($isAvailable)
                                                    <option value="{{ $guide->id }}">{{ $guide->fname }} {{ $guide->lname }}</option>
                                                @endif
                                            @endforeach
                                        </select>






                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Book me Host</label>
                                        <select class="form-control select2" name="host">
                                            <option disabled>Select </option>
                                        </select>
                                    </div>
                                    <div class="offset-md-7 col-md-5 mt-2 mb-4">
                                        <div class="">
                                            <input {{ old('int_customer') == '1' ? 'checked' : '' }} type="checkbox"
                                                name="int_customer" value="1" class="">
                                            <label for="">
                                                I am an international customer
                                            </label>
                                        </div>
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
                                        <label for="email">Email <span class="text-info">Generate email</span></label>
                                        <input type="email" class="form-control" value="{{ old('email') }}"
                                            name="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">Mobile Number</label>
                                        <input type="text" class="form-control" value="{{ old('phone') }}"
                                            name="phone">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Notes</label>
                                            <textarea class="form-control" rows="3" name='notes'></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Column 2 --}}
                            <div class="col-md-6">
                                <div class="col-12">
                                    <div class="">
                                        <input {{ old('automated_payment') == '1' ? 'checked' : '' }} type="checkbox"
                                            name="automated_payment" value="1" class="">
                                        This reservation doesnot use the automated payment system
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <input {{ old('return_customer') == '1' ? 'checked' : '' }} type="checkbox"
                                            name="return_customer" value="1" class="">
                                        Returning customer
                                    </div>
                                </div>
                                <button class="btn btn-primary m-2" type="button">Customer Note</button>
                                <div class="col-12">
                                    <div class="">
                                        <input {{ old('private_water') == '1' ? 'checked' : '' }} type="checkbox"
                                            name="private_water" value="1" class="">
                                        This trip is on private water
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <div class="col-12" style="border: 1px solid grey">
                                    <div class="form-group p-2">
                                        <input {{ old('request_guide') == '1' ? 'checked' : '' }} type="checkbox"
                                            name="request_guide" value="1" class="">
                                        THIS IS REQUESTED GUIDE TRIP
                                    </div>
                                </div>
                                <button class="btn btn-primary m-2" type="button">Add Shuttle</button>
                                <br><br><br><br>
                                <div class="col-12">
                                    <div class="mt-5">
                                        <input {{ old('complete_address') == '1' ? 'checked' : '' }} type="checkbox"
                                            name="complete_address" value="1" class="">
                                        Capture complete address
                                    </div>
                                </div>
                                <div class="col-12 mt-2" style="border: 1px solid grey">
                                    <div class="form-group p-2">
                                        <input {{ old('repeat_request') == '1' ? 'checked' : '' }} type="checkbox"
                                            name="repeat_request" value="1" class="">
                                        This is Repeat Request
                                    </div>
                                </div>
                            </div>
                            {{-- column 3  --}}

                            <div class="col-md-6 ">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="calculated_price">Calculated Price $</label>
                                        <input type="text" class="form-control" id="calculate" placeholder="0.00"
                                            value="{{ old('calculated_price') }}" name="calculated_price">
                                    </div>
                                    <div class="offset-md-5 col-md-3 mt-3">
                                        <div class="">
                                            <input {{ old('special_rate') == '1' ? 'checked' : '' }} type="checkbox"
                                                name="special_rate" value="1" class="">
                                            <label for="">Special Rate</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rod_price">Rod Price $ </label>
                                    <input type="text" class="form-control" id="rod" placeholder="0.00"
                                        value="{{ old('rod_price') }}" name="rod_price">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="special_fee">Special Price $ </label>
                                    <input type="text" class="form-control" id="special" placeholder="0.00"
                                        value="{{ old('special_fee') }}" name="special_fee">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tax">Tax $ </label>
                                    <input type="text" readonly class="form-control" placeholder="0.00"
                                        id="tax" value="{{ old('tax') }}" name="tax">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="total_fee">Total fee $ </label>
                                        <input type="text" readonly class="form-control" placeholder="0.00"
                                            id="total_fee" value="{{ old('total_fee') }}" name="total_fee">
                                    </div>
                                    <div class="col-md-2 mt-4 offset-md-5">
                                        <button class="btn btn-primary py-2" id="result"
                                            type="button">Calculate</button>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="button">Take Payment</button>

                            </div>

                            {{-- column 4  --}}
                            <div class="col-md-12 mt-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="col-12">
                                            <div class="">
                                                <input {{ old('email_to_guest') == '1' ? 'checked' : '' }} type="checkbox"
                                                    name="email_to_guest" value="1" class="">
                                                Donot Send Email to Guest
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="">
                                                <input {{ old('email_to_guide') == '1' ? 'checked' : '' }} type="checkbox"
                                                    name="email_to_guide" value="1" class="">
                                                Donot Send Email to Guide
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-12">
                                            <div class="">
                                                <input {{ old('customer_details_text') == '1' ? 'checked' : '' }}
                                                    type="checkbox" name="customer_details_text" value="1"
                                                    class="">
                                                Send Customer Details by text
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="">
                                                <input {{ old('guide_details_text') == '1' ? 'checked' : '' }}
                                                    type="checkbox" name="guide_details_text" value="1"
                                                    class="">
                                                Send Guide Details by text
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-12">
                                            <div class="">
                                                <input {{ old('custom_customer_text') == '1' ? 'checked' : '' }}
                                                    type="checkbox" name="custom_customer_text" value="1"
                                                    class="">
                                                Send a custom text to Customer
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="">
                                                <input {{ old('custom_guide_text') == '1' ? 'checked' : '' }}
                                                    type="checkbox" name="custom_guide_text" value="1"
                                                    class="">
                                                Send a custom text to guide
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- column 5  --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="time">Meeting Time</label>
                                            <input type="time" class="form-control" value="{{ old('meeting_time') }}"
                                                name="meeting_time">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="location">Meeting Location</label>
                                        <select class="form-control select2" name="location_id">
                                            <option>Select Location</option>
                                            @foreach ($location as $l)
                                                <option value="{{ $l->id }}">{{ $l->location_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="buttons">
                            <button class="btn btn-primary" type="submit">Add</button>
                            <button class="btn btn-primary" type="button">Multi Day Trip</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#result').click(function() {
                var calculate = parseFloat($("#calculate").val());
                var value1 = calculate ? calculate : 0;
                var rod = parseFloat($("#rod").val());
                var value2 = rod ? rod : 0;
                var special = parseFloat($("#special").val());
                var value3 = special ? special : 0;
                var value4 = value1 + value2 + value3;
                var value5 = (value4 * 5) / 100;
                var value6 = value4 + value5;
                $('#tax').val(value5)
                $('#total_fee').val(value6)

            })

        });
    </script>
@endpush
