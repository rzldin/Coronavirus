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

        <div class="container mt-4">
          <div class="row">

            <div class="col-sm-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5>Daftar Rumah Sakit Rujukan</h5>
                </div>
                <div class="card-body table-responsive" style="height: 600px;">
                  <table class="table table-bordered">
                    <thead class="text-center">
                      <tr>
                        <th scope="col" colspan="3">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Wilayah</th>
                        <th scope="col">Telepon</th>
                      </tr>
                    </thead>
                    <tbody id="daftar-rumahsakit">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
        </div>

        <!-- Map Persebaran -->
        <div class="col-sm-12 mt-5">
          <div id="mapid" style="height: 550px;"></div>
        </div>
        <!-- ./Map Persebaran -->
        
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
        dataRumahSakit();
        dataNasional();
        dataNegara();

        //refresh otomatis
        setInterval(() => {
          dataSemuaNegara();
          //dataNasional();
          dataNegara();
        }, 3000);

        //Get Data Global
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

        // Get Data Nasional
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
        };


        //Get Data Rumah Sakit
        function dataRumahSakit(){
          $.getJSON('https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/RS_Rujukan_Update_May_2020/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json', function(data){
            let json = data.features;
            $.each(json, function (i, data){
              $('#daftar-rumahsakit').append(`
                      <tr>
                        <td class="text-center" colspan="3">${data.attributes.nama}</td>
                        <td class="text-center">${data.attributes.alamat}</td>
                        <td class="text-center">${data.attributes.wilayah}</td>
                        <td class="text-center"><a href="tel:${data.attributes.telepon}"><h4 class="badge badge-info">${data.attributes.telepon}</h4></a></td>
                      </tr>`);
            });
          });
        };

          //Map Pemetaan Nasional
          var mymap = L.map('mapid').setView([-1.628531, 117.996313], 5);

          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
              '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
              'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
          }).addTo(mymap);

        //Get Pemetaan Nasional
        function dataNasional(){
          $.getJSON('https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/COVID19_Indonesia_per_Provinsi/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json', function(data){
            let json = data.features;
            $.each(json, function (i, data){
              L.marker([`${data.geometry.y}`, `${data.geometry.x}`]).addTo(mymap)
              .bindPopup(`<b>Provinsi :</b> ${data.attributes.Provinsi}<br>
                          <b>Positif :</b> ${data.attributes.Kasus_Posi}<br>
                          <b>Sembuh :</b> ${data.attributes.Kasus_Semb}<br>
                          <b>Meninggal : </b> ${data.attributes.Kasus_Meni}`).openPopup();
            });
          });
        };
        

        // ScrollTop
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
        //End ScrollTop

      });
    </script>

  </body>
</html>
@endsection