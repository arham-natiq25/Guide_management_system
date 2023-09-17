@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
        <div class="card-body">
          <h3 class="font-weight-bold">Email / Text templet </h3> <br>
          <a href="{{ route('email.create') }}">
              <button class="btn btn-success">Create Templet</button>
          </a>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0 mt-4">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 40%">Display title</th>
                        <th style="width: 40%">Subject</th>
                        <th style="width: 20%">Action</th>
                      </tr>
                      @foreach ($templets as $templet)
                      <tr>
                          <td>{{$templet->display_title}}</td>
                            <td>{{ $templet->subject }}</td>
                            <td>
                                    <a href="{{ route('email.edit',$templet->id) }}" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('email.destroy',$templet->id) }}" class="btn-sm btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              <!-- /.card -->


              <!-- /.card -->

      </div>
      <!-- /.card-body -->

    </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@endsection
