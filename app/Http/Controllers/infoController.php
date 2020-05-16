<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class infoController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.kawalcorona.com/indonesia/provinsi/');

        $data = $response->json();
        // $jumlah = count($data);

        // $nomor = 1;

        // for ($i= 0; $i < $jumlah; $i++){
        //     $hasil = $data[$i]['attributes'];
        // }

        // echo "<tr>";
        // echo "<td> {{ $nomor++ }}</td>";
        // echo "<td> {{ '".$hasil['Provinsi']."' }}</td>";
        // echo "<td> {{ '".$hasil['Kasus_Posi']."' }}</td>";
        // echo "<td> {{ '".$hasil['Kasus_Semb']."' }}</td>";
        // echo "<td> {{ '".$hasil['Kasus_Meni']."' }}</td>";
        // echo "<tr>";
        
        return view('index', compact('data'));
    
    }

    public function peta_nasional()
    {
        return view('peta');
    }

}
