@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
        <div class="card-body">
          <h3 class="font-weight-bold">River Listing</h3> <br>
          <a href="{{ route('rivers.create') }}">
              <button class="btn btn-success">Add New River</button>
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
                        <th> Name</th>
                        <th>Display Order</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($rivers as $river )
                    <tr>
                      <td>{{ $river->river_name }}</td>
                      <td>{{ $river->display_order }}</td>
                      <td>
                     @if ($river->status==1)
                         <button class="btn btn-success" type="button"> Active </button>
                         @else
                         <button class="btn btn-danger btn-sm" type="button">Inactive</button>

                      @endif
                      </td>
                      <td>
                        <a href="{{ route('rivers.edit',$river->id) }}" class="btn btn-sm btn-info "><i class="fas fa-pencil-alt "></i></a>

                        <a  href="{{ route('rivers.destroy',$river->id) }}" class="btn btn-sm btn-info delete-item" ><i class="fas fa-trash-alt"></i></a>

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
