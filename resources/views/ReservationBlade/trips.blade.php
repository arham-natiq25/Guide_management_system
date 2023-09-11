@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
          <div class="card-body">
            <h5>Please Select a Trip Below </h5>
            <div class="row">

                <div class="card-body table-responsive p-0 mt-4">
                    <table class="table">
                      <tbody>
                          @foreach ($trips as $trip )
                      <tr>
                        <td> <a href="{{ route('reservations.select-date', ['id' => $trip->id]) }}" class="fw-4 text-primary" style="cursor: pointer">{{ $trip->trip_name }}</a></td>
                    </tr>

                    @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
           </div>
        <!-- /.card-body -->


      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@endsection
