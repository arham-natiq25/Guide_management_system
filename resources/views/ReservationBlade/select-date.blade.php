<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Guide Management System</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/bs-stepper/css/bs-stepper.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css?v=3.2.0') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

</head>
<body>
@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')
<div class="content-wrapper">


    <section class="content">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-body">
                          <h4 class="mb-2">Select Date for trip</h4>
                          <form action="{{ route('reservations.reserve',$trip->id) }}" method="get">
                            @csrf
                            <div class="form-group">
                                <label>Date:</label>
                                <div class="input-group">
                                    <div id="datepicker"></div>
                                    <input type="hidden" id="selectedDateInput" name="date">
                                     <input type="hidden" name="trip_id" value="{{$trip->id}}">
                                </div>

                                <button class="btn btn-primary mt-3">Next</button>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>

    </section>

</div>
  <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min') }}.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
    {{-- toastr js  --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- jquery cdn  --}}
        <!-- jquery -->
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
        {{-- sweet alert  --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
         @if($errors->any())
            @foreach ($errors->all() as $error)
             toastr.error("{{ $error }}")
            @endforeach
        @endif
   </script>
<script>
    $(function() {
      var startDate = new Date("{{ $startDate }}"); // Start date from the controller
      var endDate = new Date("{{ $endDate }}");     // End date from the controller
      var allowedDays = @json($trip->days); // Get the days array from your PHP variable

      $("#datepicker").datepicker({
        dateFormat: 'mm/dd/yy',
        numberOfMonths: [2, 2],
        beforeShowDay: function(date) {
          // Convert the date to a format matching your controller (MM/dd/yyyy)
          var formattedDate = $.datepicker.formatDate('mm/dd/yy', date);

          // Get the day of the week (0 = Sunday, 1 = Monday, etc.)
          var dayOfWeek = date.getDay();

          // Convert the numeric day of the week to lowercase text (e.g., "sunday")
          var dayText = dayOfWeekToText(dayOfWeek);

          // Check if the date is within the range
          var isInRange = date >= startDate && date <= endDate;

          // Check if the day is in the allowed days array
          var isAllowedDay = allowedDays.includes(dayText);
         // disable all dates outside of range
          if (isInRange  && isAllowedDay) {
              return [false, '', 'not inrange'];
            }
         // Enable only the allowed days within the range
          if (isAllowedDay) {
            return [true, '', formattedDate];
          }

          // Disable all other dates
          return [false, '', 'Date is not available'];
        },
        onSelect: function(date) {
          // Set the selected date in the hidden input field
          $("#selectedDateInput").val(date);
        }
      });

      // Function to convert day of week index to lowercase text (e.g., "sunday")
      function dayOfWeekToText(dayIndex) {
        var daysOfWeek = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
        return daysOfWeek[dayIndex].toLowerCase();
      }
    });
</script>



</body>
</html>
