@extends('layout.master')

@section('content')
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4 text-center">Corona Virus</h1>
      <p class="lead text-center">Pantau Coronavirus Global & Indonesia</p>
    </div>
    <div class="container mt-4">
      <div class="row">  
        <!-- Total Positif -->
        <div class="col-md-4 col-12 mb-3">
          <div class="bg-danger box text-white">
            <div class="row">
              <div class="col-md-6 col-6">
                <h5>Positif</h5>
                <h2 id="data-kasus">00000</h2>
                <h5>Orang</h5>
              </div>
              <div class="col-md-4 col-6">
                <img src="{{ asset('image/img/sad.svg') }}" style="width:100px;">
              </div>  
            </div>
          </div>
        </div>
        <!-- Total Sembuh -->
        <div class="col-md-4 col-12 mb-3">
          <div class="bg-success box text-white">
            <div class="row">
              <div class="col-md-6 col-6">
                <h5>Sembuh</h5>
                <h2 id="data-sembuh">00000</h2>
                <h5>Orang</h5>
              </div>
              <div class="col-md-4 col-6">
                <img src="{{ asset('image/img/happy.svg') }}" style="width:100px;">
              </div>  
            </div>
          </div>
        </div>

        <!-- Total Meninggal -->
        <div class="col-md-4 col-12 mb-3">
          <div class="bg-info box text-white">
            <div class="row">
              <div class="col-md-6 col-6">
                <h5>Meninggal</h5>
                <h2 id="data-mati">00000</h2>
                <h5>Orang</h5>
              </div>
              <div class="col-md-4 col-6">
                <img src="{{ asset('image/img/cry.svg') }}" style="width:100px;">
              </div>  
            </div>
          </div>
        </div>

        <!-- Indonesia -->
        <div class="col-md-12 col-12">
          <div class="bg-primary box text-white">
            <div class="row">
              <div class="col-md-3 col-12">
                <h2>INDONESIA</h2>
                <h5 id="data-id">Positif : 0000 <br> Sembuh : 0000 <br> Meninggal : 0000</h5>
              </div>
              <div class="col-md-4 col-12">
                <img src="{{ asset('image/img/indonesia.svg') }}" style="width:150px;">
              </div>  
            </div>
          </div>
        </div>

        <!-- Data Berdasarkan Provinsi -->
        <div class="col-md-12 mt-5">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Data Kasus Coronavirus di Indonesia Berdasarkan Provinsi</h5>
            </div>
            <div class="card-body table-responsive" style="height: 600px;">
              <table class="table table-bordered">
                <thead class="text-center">
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col" colspan="3">PROVINSI</th>
                    <th scope="col">POSITIF</th>
                    <th scope="col">SEMBUH</th>
                    <th scope="col">MENINGGAL</th>
                  </tr>
                </thead>
                <tbody>
                  @php 
                    $no = 0;
                  @endphp
                  @foreach ($data as $d)
                  @php
                    $no++;
                  @endphp
                  <tr>
                    <th scope="row" class="text-center">{{ $no }}</th>
                    <td colspan="3">{{ $d['attributes']['Provinsi'] }}</td>
                    <td class="text-center">{{ number_format($d['attributes']['Kasus_Posi'], 0, ",", ",") }}</td>
                    <td class="text-center">{{ number_format($d['attributes']['Kasus_Semb'], 0, ",", ",") }}</td>
                    <td class="text-center">{{ number_format($d['attributes']['Kasus_Meni'], 0, ",", ",") }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ScrollTop -->
  <div>
    <a href="javascript:;" class="scrolltotop"><span class="fa fa-chevron-up"></span></a>
  </div>
  <!-- /ScrollTop -->

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


    <script>
      $(document).ready(() => {

        dataSemuaNegara();
        dataNegara();

        //refresh otomatis
        setInterval(() => {
          dataSemuaNegara();
          dataNegara();
        }, 3000);

        function dataSemuaNegara(){
          $.ajax({
              url : 'https://coronavirus-19-api.herokuapp.com/all',
              success : function(data){
                try{
                  let json = data;
                  let positif = numeral(data.cases).format('0,0');
                  let sembuh = numeral(data.recovered).format('0,0');
                  let meninggal = numeral(data.deaths).format('0,0');

                  $('#data-kasus').html(positif);
                  $('#data-mati').html(meninggal);
                  $('#data-sembuh').html(sembuh);
                  //alert(sembuh);
                }catch{
                  alert('Error');
                }
              }
          });
        }

        function dataNegara(){
          $.ajax({
              url : 'https://coronavirus-19-api.herokuapp.com/countries',
              success : function(data){
                try{
                    let json = data;
                    let html = [];

                    if(json.length > 0){
                      let i;
                      for(i = 0; i < json.length; i++){
                        let dataNegara = json[i];
                        let namaNegara = dataNegara.country;

                        if( namaNegara === 'Indonesia' ){
                          let kasus = numeral(dataNegara.cases).format('0,0');
                          let sembuh = numeral(dataNegara.recovered).format('0,0');
                          let mati = numeral(dataNegara.deaths).format('0,0');

                          $('#data-id').html(`
                            Positif : ${kasus} orang <br>
                            Sembuh : ${sembuh} orang <br>
                            Meninggal : ${mati} orang
                          `)

                        }
                      }
                    }
                }catch{
                  alert('Error');
                }
              }
          });
        }
        $(window).scroll(function () {
            var totalHeight = $(window).scrollTop();
            if (totalHeight > 300) {
                $(".scrolltotop").fadeIn();
            } else {
                $(".scrolltotop").fadeOut();
            }
        });
    
    //proses scroll
        $('a.scrolltotop').on('click', function (event) {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#home").offset().top
              }, 300);
        });

      });
    </script>

  </body>
</html>
@endsection