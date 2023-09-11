@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="font-weight-bold">Edit Location</h3> <br>
                    <a href="{{ route('locations.index') }}" class="btn btn-default">Back to List</a>

                </div>
                <!-- /.card-body -->
                <form method="POST" action="{{ route('locations.update',$location->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="location">Location Name</label>
                                <input type="text" class="form-control" value="{{ $location->location_name }}" name="location_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="url">Map URL</label>
                                <input type="url" class="form-control" value="{{ $location->url }}" name="url">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-2">

                                <label for="">Display order</label> <br>
                                <input type="text" name="display_order" class="p-2" id="" value="{{ $location->display_order }}">

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
