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
        
        return view('index', compact('data'));
    
    }

    public function peta_nasional()
    {
        $nasional = Http::get('https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/COVID19_Indonesia_per_Provinsi/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json');

        $nasional = $nasional->json();

        return redirect()->route('index')->with(compact('nasional'));
    }

}
