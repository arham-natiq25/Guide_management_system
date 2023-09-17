@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card mt-3">
                <div class="card-body">Edit Templet</h3> <br>
                    <a href="{{ route('email.index') }}" class="btn btn-default">Back to List</a>

                </div>
                <!-- /.card-body -->
                <form method="POST" action="{{route('email.update',$emails->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="title">Display Title</label>
                                <input type="text" class="form-control" value="{{$emails->display_title }}" name="title">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" value="{{$emails->subject }}" name="subject">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Fixed Body</label>
                                    <textarea class="form-control" rows="6" name="notes" >{{ $emails->notes }}</textarea>
                                </div>
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
