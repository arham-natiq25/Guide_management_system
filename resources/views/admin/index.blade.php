@extends('admin.layouts.master')

@section('content')
@if(session('toastr'))
<script>
    toastr.{{ session('toastr')['type'] }}('{{ session('toastr')['message'] }}');
</script>
@endif
<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
          <div class="card-body">
            <h3 class="font-weight-bold">Admin Dashboard</h3> <br>
            <button class="btn btn-lg btn-info">Pending Payments</button>
            <button class="btn btn-lg btn-info">Today's unsigned waviers</button>


           </div>
        <!-- /.card-body -->


      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@endsection


