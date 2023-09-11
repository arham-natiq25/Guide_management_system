@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
          <div class="card-body">
            <h3 class="font-weight-bold">Coupon Listing</h3> <br>
            <a href="{{ route('coupons.create') }}">
                <button class="btn btn-success">Add New Coupon</button>
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
                          <th>Coupon Name</th>
                          <th>Code</th>
                          <th>Discount</th>
                          <th>Start Date</th>
                          <th>Expiry Date</th>
                          <th>Status</th>
                          <th>Used</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($coupons as $coupon )
                       <tr>
                        <td>{{ $coupon->title }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->discount }}{{ $coupon->discount_type }}</td>
                        <td>{{ $coupon->start_date }}</td>
                        <td>{{ $coupon->expiry_date }}</td>
                        <td>{{ $coupon->status==1 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $coupon->used==null ? 0 : $coupon->used }}</td>
                        <td>
                            <a href="" class="btn-sm btn-info"><i class="far fa-eye"></i></a>
                            <a href="{{ route('coupons.edit',$coupon->id) }}" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{ route('coupons.destroy',$coupon->id) }}" class="btn-sm btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
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
