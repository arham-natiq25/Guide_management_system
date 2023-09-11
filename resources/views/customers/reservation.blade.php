@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
          <div class="card-body">
            <h3 class="font-weight-bold">Customer Reservation List</h3> <br>


                  <!-- /.card-header -->
                  <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active " href="#total" data-toggle="tab">Todays Reservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="#upcoming" data-toggle="tab">Upcoming Reservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="#archieved" data-toggle="tab">Archieved Reservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="#cancelled" data-toggle="tab">Cancelled Reservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="#new" data-toggle="tab">New Reservation Reservation</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body table-responsive p-0 mt-4">
                      <div class="tab-content">
                        <div class="active tab-pane" id="total">
                          <!-- Post -->
                          <table class="table ">
                            <thead>
                              <tr>
                                <th>Customer Name</th>
                                <th>Reserved on</th>
                                <th>Trip Date</th>
                                <th>Guide(s)</th>
                                <th>Trip</th>
                                <th># of Guests</th>
                                <th>Wavier</th>
                                <th>From</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($reservations as $reservation)
                              @if ($reservation->date == now()->format('m/d/Y'))
                              <tr>
                                  <td>{{ $reservation->fname }} {{ $reservation->lname }}</td>
                                  <td>{{ date('m/d/Y H:i:s', strtotime($reservation->created_at)) }}</td>
                                  <td>{{ $reservation->date }}</td>
                                  <td><button style="background-color: {{ $reservation->guide->color }}" class="btn btn-sm text-white">{{ $reservation->guide->fname}}  {{ $reservation->guide->lname}}</button></td>
                                  <td>{{ $reservation->trip->trip_name }}</td>
                                  <td>{{ $reservation->total_persons }}</td>
                                  <td>0/2 <button class="btn btn-warning btn-sm" type="button">Waiver</button></td>
                                  <td><button class=" btn-sm btn-primary" type="button">{{ $reservation->created_by }}</button></td>
                                  {{-- <td><button class="btn-sm btn-primary py-0" type="submit"><small>Add Fishing Report</small></button> <br>
                                        <a href="{{ route('reservations.edit',$reservation->id) }}"><i class="fas fa-pencil-alt text-info "></i></a>
                                        <a  href="{{ route('reservations.delete',$reservation->id) }}" class="delete-item" ><i class="fas fa-trash-alt text-danger"></i></a>
                                </td> --}}
                              </tr>
                              @endif
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="upcoming">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Customer Name</th>
                                    <th>Reserved on</th>
                                    <th>Trip Date</th>
                                    <th>Guide(s)</th>
                                    <th>Trip</th>
                                    <th># of Guests</th>
                                    <th>Wavier</th>
                                    <th>From</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($reservations as $reservation)
                                  @if ($reservation->date > now()->format('m/d/Y'))
                                  <tr>
                                      <td>{{ $reservation->fname }} {{ $reservation->lname }}</td>
                                      <td>{{ date('m/d/Y H:i:s', strtotime($reservation->created_at)) }}</td>
                                      <td>{{ $reservation->date }}</td>
                                      <td><button style="background-color: {{ $reservation->guide->color }}" class="btn btn-sm text-white">{{ $reservation->guide->fname}}  {{ $reservation->guide->lname}}</button></td>
                                      <td>{{ $reservation->trip->trip_name }}</td>
                                      <td>{{ $reservation->total_persons }}</td>
                                      <td>0/2 <button class="btn btn-warning btn-sm" type="button">Waiver</button></td>
                                      <td><button class=" btn-sm btn-primary" type="button">{{ $reservation->created_by }}</button></td>
                                  </tr>
                                  @endif
                                  @endforeach
                                </tbody>
                              </table>
                            <!-- The timeline -->
                        </div>

                        <div class="tab-pane" id="archieved">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Customer Name</th>
                                    <th>Reserved on</th>
                                    <th>Trip Date</th>
                                    <th>Guide(s)</th>
                                    <th>Trip</th>
                                    <th># of Guests</th>
                                    <th>Wavier</th>
                                    <th>From</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($reservations as $reservation)
                                  @if ($reservation->date < now()->format('m/d/Y'))
                                  <tr>
                                      <td>{{ $reservation->fname }} {{ $reservation->lname }}</td>
                                      <td>{{ date('m/d/Y H:i:s', strtotime($reservation->created_at)) }}</td>
                                      <td>{{ $reservation->date }}</td>
                                      <td><button style="background-color: {{ $reservation->guide->color }}" class="btn btn-sm text-white">{{ $reservation->guide->fname}}  {{ $reservation->guide->lname}}</button></td>
                                      <td>{{ $reservation->trip->trip_name }}</td>
                                      <td>{{ $reservation->total_persons }}</td>
                                      <td>0/2 <button class="btn btn-warning btn-sm" type="button">Waiver</button></td>
                                      <td><button class=" btn-sm btn-primary" type="button">{{ $reservation->created_by }}</button></td>

                                  </tr>
                                  @endif
                                  @endforeach
                                </tbody>
                              </table>

                        </div>
                        <div class="tab-pane" id="cancelled">

                        </div>
                        <div class="tab-pane" id="new">

                        </div>
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                    </div><!-- /.card-body -->
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
