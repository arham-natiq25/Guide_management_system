@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
          <div class="card-body">
            <h3 class="font-weight-bold">Trip Listing</h3> <br>
            <a href="{{ route('trips.create') }}">
                <button class="btn btn-success">Add New Trip</button>
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
                        <tr class="text-center">
                          <th>Trip Name</th>
                          <th>Time</th>
                          <th>Reservation</th>
                          <th>Order</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $x=0;
                        @endphp
                          @foreach ($trips as $trip )
                      <tr  class="text-center">
                        <td>{{ $trip->trip_name }}</td>
                        <td>{{ $trip->start_time}} to {{ $trip->end_time }}</td>
                        {{-- <td>{{ empty(!$trip->reservations) ? $trip->reservations : '0' }}</td> --}}
                        @foreach ($reservations as $reservation )
                            @if ($trip->id == $reservation->trip_id)
                                @php
                                    $x++;
                                @endphp
                            @endif
                        @endforeach
                        <td>{{ $x }}</td>
                        @php
                            $x=0;
                        @endphp
                        <td>{{ $trip->display_order }}</td>
                        <td >
                            <a href="{{ route('trips.edit',$trip->id) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>

                            <a href="{{ route('trips.destroy',$trip->id) }}" class="btn btn-info delete-item"><i class="fas fa-trash-alt"></i></a>
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
