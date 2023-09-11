@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="font-weight-bold">Add River</h3> <br>
                    <a href="{{ route('rivers.index') }}" class="btn btn-default">Back to List</a>

                </div>
                <!-- /.card-body -->
                <form method="POST" action="{{ route('rivers.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="First_Name">River Name</label>
                                <input type="text" class="form-control" name="river_name">
                            </div>
                        </div>
                        <div id="new">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Agency</label>
                                <div class="row">
                                    <div class="col-12">
                                        <select class="form-control select2" name="agency_id[]">
                                            <option>Select Agency</option>
                                            @foreach ($agency as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <button class="btn btn-primary" type="button" id="add">
                                 Add new agency
                                </button>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">

                                <label for="">Display order</label> <br>
                                <input type="text" name="display_order" class="p-2" id="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check col-md-12">
                                <input type="checkbox" name="status" value="1" class="form-check-input">
                                <label class="form-check-label" >Inactive</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit</button>

                </form>

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
 @endsection
 @push('scripts')
 <script>
    $('#add').click(function(){
        $('#new').append(
            `
            <div class="row">
                <div class="form-group col-md-4" id='del'>
                    <label>Agency</label>
                    <div class="row">
                        <div class="col-10">
                          <select class="form-control select2" name="agency_id[]">
                              <option>Select Agency</option>
                              @foreach ($agency as $item)
                              <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach

                           </select>
                        </div>
                        <div class="col-2">
                              <button class="btn btn-danger decrease" type="button">-</button>
                        </div>

                    </div>

                </div>
            </div>
            `
        );
    });
    $(document).on('click','.decrease',function(){
         $(this).parents('#del').remove();
    });
</script>

 @endpush
