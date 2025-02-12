<?php
	session_start();
	if (!isset($_SESSION['username'])) header("location:../../main_login/form_login.php");
    if (isset($_GET['unit'])){ $unit = $_GET['unit']; } 
	require_once("../../configuration/koneksi.php");
	ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RSPI-LTE 3 | Dashboard 2</title>
  <link rel="icon" href="../../assets/img/mLITE.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../../assets/plugins/fullcalendar/main.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  ff
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../../assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="main_admin_app.php?unit=beranda" class="nav-link">Home</a>
      </li>
     <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="" class="dropdown-item" data-toggle="modal" data-target="#modallogout">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="main_admin_app.php?unit=beranda" class="brand-link">
      <img src="../../assets/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RSPI-LTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin IT</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ambulance"></i>
              <p>
                Kunjungan Pasien
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="main_admin_app.php?unit=grafik_poli&action=datagrid" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>Chart</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="main_admin_app.php?unit=lansia&action=datagrid" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Kategori Lansia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="main_admin_app.php?unit=dewasa&action=datagrid" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Kategori Dewasa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="main_admin_app.php?unit=remaja&action=datagrid" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Kategori Remaja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="main_admin_app.php?unit=anak&action=datagrid" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Kategori Anak</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Pi-Care
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="main_admin_app.php?unit=daftar&action=datagrid" class="nav-link">
                    <i class="nav-icon fas fa-envelope-open"></i>
                    <p>PENDAFTARAN</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="main_admin_app.php?unit=batal&action=datagrid" class="nav-link">
                    <i class="nav-icon fas fa-envelope-open"></i>
                    <p>PEMBATALAN</p>
                  </a>
                </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
  <?php
      require_once ("content.php");
    ?>
  </div>

  <!--Modal logout -->
<div id="modallogout" class="modal fade" role="dialog">
  <div class="modal-dialog" align="center">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="logout.php">
          <strong>Anda yakin ingin Logout Dari Aplikasi ?&nbsp;&nbsp;</strong>
            <input type="submit" name="logout" class="btn btn-danger" style="width: 60px" value="Ya">
            <button type="button" class="btn btn-warning" data-dismiss="modal" style="width: 60px">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal logout -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024-2025 <a href="https://adminlte.io">RSPI-LTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.4.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../assets/plugins/jszip/jszip.min.js"></script>
<script src="../../assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/dist/js/adminlte.js"></script>
<!-- jQuery UI -->
<script src="../../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../../assets/plugins/fullcalendar/main.js"></script>
  <!-- Page specific script -->
  <script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {
        // create an Event Object (https://fullcalendar.io/docs/event-object)
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its original position after the drag
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

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      events    : [],  // Initialize with empty array, we will populate this later
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }

        // Save events to localStorage after drop
        saveEvents();
      }
    });

    // Load events from localStorage
    function loadEvents() {
      var savedEvents = localStorage.getItem('calendar-events');
      if (savedEvents) {
        savedEvents = JSON.parse(savedEvents);
        savedEvents.forEach(function(event) {
          calendar.addEvent(event);
        });
      }
    }

    // Save events to localStorage
    function saveEvents() {
      var events = calendar.getEvents();
      var eventData = events.map(function(event) {
        return {
          title: event.title,
          start: event.start.toISOString(),
          end: event.end ? event.end.toISOString() : null,
          backgroundColor: event.backgroundColor,
          borderColor: event.borderColor,
          textColor: event.textColor,
        };
      });

      localStorage.setItem('calendar-events', JSON.stringify(eventData));
    }

    // Initialize the calendar
    calendar.render();

    // Load events when the page is loaded
    loadEvents();

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })

    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Add event to FullCalendar
      calendar.addEvent({
        title: val,
        start: new Date(),
        backgroundColor: currColor,
        borderColor: currColor,
        textColor: '#fff',
      });

      // Save events to localStorage
      saveEvents();

      // Remove event from text input
      $('#new-event').val('')
    })
  })
</script>

<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "lengthChange": true,
        //"pageLength": 5, // Menampilkan 5 data per halaman
        "paging":true,
        "pagingType":"numbers",
        "scrollCollapse": true,
        "ordering":true,
        "info":true,
        "language":{
          "decimal":       "",
          "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "sInfoPostFix":  "",
          "sSearch":       "",
          "searchPlaceholder": "Cari Sekolah..",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Pertama",
            "sPrevious": "Sebelumnya",
            "sNext":     "Selanjutnya",
            "sLast":     "Terakhir"
          }
        }
      });
    });
  </script>

  <!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function() {
      $('#example-picare').DataTable({
        "lengthChange": true,
        "pageLength": 5, // Menampilkan 5 data per halaman
        "paging":true,
        "pagingType":"numbers",
        "scrollCollapse": true,
        "ordering":true,
        "info":true,
        "language":{
          "decimal":       "",
          "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "sInfoPostFix":  "",
          "sSearch":       "",
          "searchPlaceholder": "Cari Sekolah..",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Pertama",
            "sPrevious": "Sebelumnya",
            "sNext":     "Selanjutnya",
            "sLast":     "Terakhir"
          }
        }
      });
    });
  </script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../../assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../assets/plugins/raphael/raphael.min.js"></script>
<script src="../../assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../assets/plugins/chart.js/chart2.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../assets/dist/js/pages/dashboard2.js"></script>
</body>
</html>
