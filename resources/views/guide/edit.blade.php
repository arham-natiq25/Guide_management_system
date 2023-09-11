@extends('admin.layouts.master')

@section('content')
@php
    $states = array(
	'AL'=>'ALABAMA',
	'AK'=>'ALASKA',
	'AS'=>'AMERICAN SAMOA',
	'AZ'=>'ARIZONA',
	'AR'=>'ARKANSAS',
	'CA'=>'CALIFORNIA',
	'CO'=>'COLORADO',
	'CT'=>'CONNECTICUT',
	'DE'=>'DELAWARE',
	'DC'=>'DISTRICT OF COLUMBIA',
	'FM'=>'FEDERATED STATES OF MICRONESIA',
	'FL'=>'FLORIDA',
	'GA'=>'GEORGIA',
	'GU'=>'GUAM GU',
	'HI'=>'HAWAII',
	'ID'=>'IDAHO',
	'IL'=>'ILLINOIS',
	'IN'=>'INDIANA',
	'IA'=>'IOWA',
	'KS'=>'KANSAS',
	'KY'=>'KENTUCKY',
	'LA'=>'LOUISIANA',
	'ME'=>'MAINE',
	'MH'=>'MARSHALL ISLANDS',
	'MD'=>'MARYLAND',
	'MA'=>'MASSACHUSETTS',
	'MI'=>'MICHIGAN',
	'MN'=>'MINNESOTA',
	'MS'=>'MISSISSIPPI',
	'MO'=>'MISSOURI',
	'MT'=>'MONTANA',
	'NE'=>'NEBRASKA',
	'NV'=>'NEVADA',
	'NH'=>'NEW HAMPSHIRE',
	'NJ'=>'NEW JERSEY',
	'NM'=>'NEW MEXICO',
	'NY'=>'NEW YORK',
	'NC'=>'NORTH CAROLINA',
	'ND'=>'NORTH DAKOTA',
	'MP'=>'NORTHERN MARIANA ISLANDS',
	'OH'=>'OHIO',
	'OK'=>'OKLAHOMA',
	'OR'=>'OREGON',
	'PW'=>'PALAU',
	'PA'=>'PENNSYLVANIA',
	'PR'=>'PUERTO RICO',
	'RI'=>'RHODE ISLAND',
	'SC'=>'SOUTH CAROLINA',
	'SD'=>'SOUTH DAKOTA',
	'TN'=>'TENNESSEE',
	'TX'=>'TEXAS',
	'UT'=>'UTAH',
	'VT'=>'VERMONT',
	'VI'=>'VIRGIN ISLANDS',
	'VA'=>'VIRGINIA',
	'WA'=>'WASHINGTON',
	'WV'=>'WEST VIRGINIA',
	'WI'=>'WISCONSIN',
	'WY'=>'WYOMING',
	'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
	'AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)',
	'AP'=>'ARMED FORCES PACIFIC'
);
@endphp
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card mt-3">
          <div class="card-body">
            <h3 class="font-weight-bold">Edit Guide</h3> <br>
           </div>
        <!-- /.card-body -->
        <form method="POST" action="{{ route('guides.update',$guide->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="card-body">
              <div class="row">
              <div class="form-group col-md-4">
                <label for="First_Name">First Name</label>
                <input type="text" class="form-control" id="First_Name" name="fname" value="{{ $guide->fname }}">
              </div>
              <div class="form-group col-md-4">
                <label for="Last_Name">Last Name</label>
                <input type="text" class="form-control" id="Last_name" name="lname" value="{{ $guide->lname }}">
              </div>
              </div>
              <div class="row">
              <div class="form-group col-md-4">
                <label for="address1">Address Line 1</label>
                <input type="text" class="form-control" id="address_1" name="address1" value="{{ $guide->address1 }}">
              </div>
              <div class="form-group col-md-4">
                <label for="address2">Address Line 2</label>
                <input type="text" class="form-control" id="address_2" name="address2"value="{{ $guide->address2 }}">
              </div>
              </div>
             <div class="row">
              <div class="form-group col-md-2">
                <label for="city">City</label>
                <input type="text" class="form-control"  name="city" value="{{ $guide->city }}">
              </div>
              <div class="form-group col-md-3">
                  <label>State</label>
                  <select class="form-control select2" name="state">
                      <option disabled >Select state</option>
                      @foreach ($states as $state)
                      <option {{ $state == $guide->state ? 'selected' : '' }} value="{{ $state }}">{{ $state }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="zip">Zip</label>
                  <input type="text" class="form-control" value="{{ $guide->zip }}"  name="zip" placeholder="example 8779">
                </div>
                </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                        <label for="mobile">Mobile Phone</label>
                        <input type="text" class="form-control" value="{{ $guide->mobile }}"  name="mobile" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{ $guide->user->email }}" name="email" placeholder="Joen@example.com">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" value="{{ $guide->user->password }}"  name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                        <label for="license">Guide license</label>
                        <input type="text" class="form-control"value="{{ $guide->guide_license }}"  name="guide_license" >
                        </div>
                        <div class="form-group col-md-12">
                        <a href="" class="btn btn-info">Guide Pay</a>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="color">Color</label> <br>
                            <input type="color" value="{{ $guide->color }}" name="color" style="border:none">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" rows="3" name="notes" >{{ $guide->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="form-group">
                        <label for="preview">Preview</label> <br>
                        <img src="{{asset($guide->image)}}" alt="" width="200px">
                    </div>
                </div>
                    <br>
                 <div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image"><br>
                        </div>
                    </div>
                    <p>Dimension is 640 X 480 (MAX:4mb) <br> JPG format is recomemded</p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2">
                    <label for="display">Display Order</label>
                    <input type="text" value="{{ $guide->display_order }}" class="form-control"  name="display_order" >
                    </div>
                    <div class="form-check col-md-12">
                        <input type="checkbox" {{ $guide->emailcheck == 1 ? 'checked' : '' }} name="emailcheck" value="1" class="form-check-input">
                        <label class="form-check-label" >Email Guide login details</label>
                    </div>
                    <div class="form-check col-md-12">
                        <input type="checkbox" {{ $guide->status == 1 ? 'checked' : '' }} name="status" value="1" class="form-check-input">
                        <label class="form-check-label" >Active</label>
                    </div>
                </div>

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>

         </form>
      </div>
      </div>

      <!-- /.card -->

    </section>
    <!-- /.content -->
</div
@endsection
