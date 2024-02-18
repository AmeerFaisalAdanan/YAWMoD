<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function getWebStat(){
        $url = "https://blueprint.iogse.gov.my";

        $response = Http::get($url);

        $collections = [
            'status' => $response->status(),
        ];

        dd($collections);

    }
}
