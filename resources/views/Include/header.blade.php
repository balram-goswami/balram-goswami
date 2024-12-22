<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 3 by Creative Tim
  </title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <script>
    // JavaScript to automatically set breadcrumb name based on the URL
    document.addEventListener("DOMContentLoaded", function() {
      // Get the current URL path
      let path = window.location.pathname;
      // Extract the last part of the path (the page name)
      let pageName = path.substring(path.lastIndexOf("/") + 1);
      
      // Capitalize the first letter (optional, to make it look nicer)
      pageName = pageName.charAt(0).toUpperCase() + pageName.slice(1);

      // Update breadcrumb with the page name (if the path isn't empty)
      if (pageName) {
        document.getElementById("breadcrumb-page-name").innerText = pageName;
      } else {
        document.getElementById("breadcrumb-page-name").innerText = "Home"; // Default text if no path is found
      }
    });
  </script>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
        target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Crypque Event</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="{{ route('admin.dashboard') }}">
            <i class="material-symbols-rounded opacity-5">Home</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('allstudents')}}">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">All Users </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('admin.eventcreate')}}">
            <i class="material-symbols-rounded opacity-5">Event</i>
            <span class="nav-link-text ms-1">Event Creater</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('admin.viewEventType')}}">
            <i class="material-symbols-rounded opacity-5">Event</i>
            <span class="nav-link-text ms-1">Event Types</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('allstudents')}}">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Event Publish Request</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('payment_his.index')}}">
            <i class="material-symbols-rounded opacity-5">Event</i>
            <span class="nav-link-text ms-1">Payment History</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('admin.upload_event_video')}}">
            <i class="material-symbols-rounded opacity-5">upload</i>
            <span class="nav-link-text ms-1">Upload Event Videos</span>
          </a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
              @csrf
          </form>
          
          <a class="nav-link text-dark" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="material-symbols-rounded opacity-5">Logout</i>
              <span class="nav-link-text ms-1">LogOut</span>
          </a>
      </li>
      
       
       
      </ul>
    </div>
    
  </aside>
  