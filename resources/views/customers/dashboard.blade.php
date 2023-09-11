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
            <h3 class="font-weight-bold">Customer Dashboard</h3> <br>

           </div>
        <!-- /.card-body -->


      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@endsection
