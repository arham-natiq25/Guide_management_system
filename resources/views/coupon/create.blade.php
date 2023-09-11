@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="font-weight-bold">Add Coupon</h3> <br>
                    <a href="{{ route('coupons.index') }}" class="btn btn-default">Back to List</a>

                </div>
                <!-- /.card-body -->
                <form method="POST" action="{{ route('coupons.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" value="{{ old('title') }}" name="title">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" value="{{ old('code') }}" name="code">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="code">Discount Type </label>
                                <input {{ old('discount_type')== '%' ? 'checked' : '' }} type="radio" name="discount_type" value="%" id=""> %
                                <input {{ old('discount_type')== '$' ? 'checked' : '' }} type="radio" name="discount_type" value="$" id=""> $
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="discount">Discount</label>
                                <input type="text" class="form-control" value="{{ old('discount') }}" name="discount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="start_date">Start Date</label>
                                <input type="text" class="form-control" value="{{ old('start_date') }}" name="start_date" placeholder="d/m/y">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="expiry_date">Expiry Date</label>
                                <input type="text" class="form-control" value="{{ old('expiry_date') }}" name="expiry_date" placeholder="d/m/y">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="">Status</label>
                                 <input {{ old('status')== '1' ? 'checked' : '' }} type="radio" name="status" value="1" id=""> Active
                                 <input {{ old('status')== '0' ? 'checked' : '' }} type="radio" name="status" value="0" id=""> Inactive
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary mt-4">Submit</button>

                </form>

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
 @endsection
