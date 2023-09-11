@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
          <div class="card-body">
            <h3 class="font-weight-bold">Agency Listing</h3> <br>
            <a href="{{ route('agencies.create') }}">
                <button class="btn btn-success">Add New Agency</button>
            </a>


                    {{-- <div class="card-tools">
                      <ul class="pagination pagination-sm float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                      </ul>
                    </div> --}}

                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0 mt-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="width: 40%">Title</th>
                          <th style="width: 40%">Order</th>
                          <th style="width: 20%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($agency as $value )
                       <tr>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->display_order }}</td>
                        <td>
                            <a href="{{ route('agencies.edit',$value->id) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>

                            <a href="{{ route('agencies.destroy',$value->id) }}" class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
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
