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
                <form method="POST" action="{{ route('rivers.update',$river->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="First_Name">River Name</label>
                                <input type="text" class="form-control" value="{{ $river->river_name }}" name="river_name">
                            </div>
                        </div>
                        <div id="new">
                        <div class="row">
                            <div class="form-group col-md-4">
                                @php
                                $value = json_decode($river->agency_id);
                                $length = count($value);
                                @endphp
                                <div class="row">
                                    <div class="col-12">

                                        @foreach ($value as $v)

                                        <label>Agency</label>
                                        <select class="form-control select2" name="agency_id[]">
                                            @foreach ($agency as $data)
                                            <option>Select Agency</option>
                                            <option {{ $v ==$data->id  ? 'selected' : ''}} value="{{ $data->id }}">{{ $data->title }}</option>
                                            @endforeach
                                            </select>
                                        @endforeach

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
                                <input type="text" name="display_order" value="{{ $river->display_order }}" class="p-2" id="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check col-md-12">
                                <input {{ $river->status==1 ? '' : 'checked' }} type="checkbox" name="status" value="1" class="form-check-input">
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
                              <option {{ in_array($item->id,$value) ? 'selected' : ''}}} value="{{ $item->id }}">{{ $item->title }}</option>
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
