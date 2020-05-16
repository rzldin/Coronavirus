@extends('layout.master')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4 text-center">Pemetaan Nasional</h1>
      <p class="lead text-center">Pantau Coronavirus Global & Indonesia</p>
    </div>


</div>


<div class="container">
    <div class="row mt-5">
      <div class="footer text-center">
        &copy; Copyright <b> <?= date('Y')?> Pantau Coronavirus.</b> Made With <i class="fa fa-heart-o" style="font-size:16px"></i>
      </div>
    </div>
  </div>

  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
    $(document).ready(() => {
        
    });
    </script>

    </body>
</html>

@endsection

