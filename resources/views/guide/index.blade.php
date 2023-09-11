@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
          <div class="card-body">
            <h3 class="font-weight-bold">Guide Listing</h3> <br>
            <a href="{{ route('guides.create') }}">
                <button class="btn btn-success">Add Guide</button>
            </a>
            <button class="btn  btn-info">Send SMS to Guides</button>



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
                  <div class="card-body table-responsive p-0">
                    <table class="table">
                      <thead>
                        <tr class="text-center">
                          <th style="width:3%">Color</th>
                          <th>Display</th>
                          <th>Guide Name</th>
                          <th>Phone #</th>
                          <th>Rating</th>
                          <th>Booked Trips(Total Trips /Completed)</th>
                          <th>Calender</th>
                          <th style="max-width: 40%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                                @php
                                $x=0;
                                $y=0;
                                @endphp
                          @foreach ($guides as $guide )
                        <tr class="text-center">
                            <td> <div class="box">
                                <button class="btn btn-sm  p-3" style="background-color:{{ $guide->color }}" type="button"></button>
                             </div></td>
                             <td>{{ $guide->display_order }}</td>
                             <td>{{ $guide->fname." ".$guide->lname }}<br> <small>{{ $guide->user->email }}</small> </td>
                             <td>{{ $guide->mobile }}</td>
                             <td><i class="far fa-star"></i>
                                 <i class="far fa-star"></i>
                                 <i class="far fa-star"></i>
                                 <i class="far fa-star"></i>
                                 <i class="far fa-star"></i>
                             </td>
                             @foreach ($reservations as $reservation)
                                 @if ($guide->id == $reservation->guide_id)
                                     @php
                                         $x++;
                                     @endphp
                                 @endif
                             @endforeach
                             <td>{{ $x }}/0</td>
                             {{-- here zero is static --}}
                                @php
                                $y=0;
                                $x=0;
                                @endphp
                             <td><a href="" class="btn btn-sm btn-info"><i class="fas fa-calendar-week "></i></a></td>
                             <td><a href=""  class="btn btn-sm btn-info" ><i class="fas fa-keyboard"></i></a>

                                 <a href="{{ route('guides.edit',$guide->id) }}" class="btn btn-sm btn-info "><i class="fas fa-pencil-alt "></i></a>

                                <a class="btn btn-sm btn-info delete-item" href="{{ route('guides.destroy',$guide->id) }}" ><i class="fas fa-trash-alt"></i></a>

                                 {{-- <a href="{{ route("guides.destroy",$guide->id) }}" ><i class="fas fa-trash-alt text-info "></i></a> --}}
                                 <a href="" ><button class="btn-sm btn btn-info">Book</button></a>
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
