@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="font-weight-bold">Settings</h3> <br>

            </div>
            <!-- /.card-body -->
            <form method="POST" action="{{ route('settings.update',$setting->id) }}" enctype="">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="site_name">Site Name</label>
                            <input type="text" class="form-control" value="{{ $setting->name }}" name="site_name" placeholder="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sale_tax">Sales Tax</label>
                            <input type="text" class="form-control" value="{{ $setting->config['sale_tax'] }}" name="sale_tax" placeholder="">
                        </div>
                    </div>
                    <label for="start_date">Blocked Dates</label>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" value="{{ $setting->config['start_date']  }}" name="start_date" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" value="{{ $setting->config['end_date']  }}" name="end_date" placeholder="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </div>

            </div>


        </div>



        </form>

</div>
@endsection
