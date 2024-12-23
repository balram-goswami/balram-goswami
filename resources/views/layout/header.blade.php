<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title>
    Crypque Event User Dashboard
  </title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
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
      <a class="navbar-brand px-4 py-3 m-0" href=" {{ route('dashboard')}} ">
        <img src="{{asset('assets/img/logo-ct-dark.png')}}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Crypque Event</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="{{ route('dashboard') }}">
            <i class="material-symbols-rounded opacity-5">Home</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('my_event')}}">
            <i class="material-symbols-rounded opacity-5">Event</i>
            <span class="nav-link-text ms-1">My Event</span>
          </a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('user.logout') }}" id="logout-form" style="display: none;">
            @csrf 
          </form>
          <a class="nav-link text-dark" href="{{ route('user.logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="material-symbols-rounded opacity-5">logout</i>
            <span class="nav-link-text ms-1">Log Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>