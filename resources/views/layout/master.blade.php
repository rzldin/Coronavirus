<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
      .box{
        padding: 30px 40px;
        border-radius : 5px;
      }
      .footer {
        height: 85px;
      }

      
    </style>
    <title>Pantau Covid-19</title>
  </head>

  <body>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <div class="container">
      <img src="{{ asset('image/covid.png') }}" width="70" height="70" alt="InfoCorona">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <!-- <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li> -->
          <li class="nav-item" style="margin-left: 25px;font-size:20px;">
            <a class="nav-link" href="{{ route('index') }}"><i class="fa fa-home"></i> BERANDA</a>
          </li>
          <li class="nav-item" style="margin-left: 15px;font-size:20px;">
            <a class="nav-link" href="{{ route('peta.nasional') }}"><i class="fa fa-map"></i> PEMETAAN NASIONAL</a>
          </li>
          <li class="nav-item" style="margin-left: 15px;font-size:20px;">
            <a class="nav-link" href="javascript:;"><i class="fa fa-phone"></i> HOTLINE</a>
          </li>
        </ul>
        <span class="navbar-text">
        <a href="https://github.com/rzldin" style="text-decoration:none;padding-left:7px;">
          <img src="{{ asset('image/img/github.svg') }}" width="30" height="30" alt="InfoCorona">
        </a>
        <a href="https://www.facebook.com/nomadenci99" style="text-decoration:none;padding-left:5px;">  
          <img src="{{ asset('image/img/fb.svg') }}" width="34" height="34" alt="InfoCorona">
        </a>
        </span>
      </div>
    </div>
  </nav>

<!-- Content -->
    @yield('content')
<!-- /page content -->

