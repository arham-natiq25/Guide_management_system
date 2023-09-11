<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calendar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fullcalendar/main.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.layouts.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 @include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
              <div class="card">

                <div id="external-events">
                </div>

                <!-- /.card-body -->
              </div>
              <!-- /.card -->


          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/fullcalendar/main.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------
    var reservations = @json($formattedReservations); // Convert PHP array to JavaScript array
    console.log(reservations);
    // var calendar = new Calendar(calendarEl, {
    //   headerToolbar: {
    //     left  : 'prev,next today',
    //     center: 'title',
    //     right : ''
    //   },
    //   themeSystem: 'bootstrap',
    //   //Random default events
    //   events: [
    //     {
    //       title: reservations.guide_name,
    //       start: new Date(reservations.date),
    //       backgroundColor: '#f56954', //red
    //       borderColor    : '#f56954', //red
    //       allDay         : true
    //     },
    //     {
    //       title          : 'Long Event',
    //       start          : new Date(y, m, d - 5),
    //       end            : new Date(y, m, d - 2),
    //       backgroundColor: '#f39c12', //yellow
    //       borderColor    : '#f39c12' //yellow
    //     },
    //     {
    //     //   title          : 'Meeting',
    //     //   start          : new Date(y, m, d, 10, 30),
    //     //   allDay         : false,
    //     //   backgroundColor: '#0073b7', //Blue
    //     //   borderColor    : '#0073b7' //Blue
    //     },
    //     {
    //     //   title          : 'Lunch',
    //     //   start          : new Date(y, m, d, 12, 0),
    //     //   end            : new Date(y, m, d, 14, 0),
    //     //   allDay         : false,
    //     //   backgroundColor: '#00c0ef', //Info (aqua)
    //     //   borderColor    : '#00c0ef' //Info (aqua)
    //     },
    //     {
    //     //   title          : 'Birthday Party',
    //     //   start          : new Date(y, m, d + 1, 19, 0),
    //     //   end            : new Date(y, m, d + 1, 22, 30),
    //     //   allDay         : false,
    //     //   backgroundColor: '#00a65a', //Success (green)
    //     //   borderColor    : '#00a65a' //Success (green)
    //     },
    //     {
    //     //   title          : 'Click for Google',
    //     //   start          : new Date(y, m, 28),
    //     //   end            : new Date(y, m, 29),
    //     //   url            : 'https://www.google.com/',
    //     //   backgroundColor: '#3c8dbc', //Primary (light-blue)
    //     //   borderColor    : '#3c8dbc' //Primary (light-blue)
    //     }
    //   ],
    //   editable  : true,
    //   droppable : true, // this allows things to be dropped onto the calendar !!!
    //   drop      : function(info) {
    //     // is the "remove after drop" checkbox checked?
    //     if (checkbox.checked) {
    //       // if so, remove the element from the "Draggable Events" list
    //       info.draggedEl.parentNode.removeChild(info.draggedEl);
    //     }
    //   }
    // });
    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left  : 'prev,next today',
            center: 'title',
            right : ''
        },
        themeSystem: 'bootstrap',
        events: reservations.map(function(reservation) {
            var parts = reservation.date.split('/');
            var year = parseInt(parts[2], 10);
            var month = parseInt(parts[0], 10) - 1; // JavaScript months are zero-based
            var day = parseInt(parts[1], 10);

            var startDate = new Date(year, month, day);

            return {
                title: reservation.guide_name,
                start: startDate,
                end: startDate,
                backgroundColor: reservation.color, //red
                allDay: true,

            };
        }),
        editable  : true,
        droppable : true,
        drop      : function(info) {
            if (checkbox.checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        }
    });


    calendar.render();
    // $('#calendar').fullCalendar()


  })
</script>
</body>
</html>
