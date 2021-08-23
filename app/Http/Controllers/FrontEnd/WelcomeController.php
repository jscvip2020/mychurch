<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
//        https://picsum.photos/v2/list?page=2&limit=100
        $url = file_get_contents('https://picsum.photos/v2/list?limit=10');
        $imagens = json_decode($url);

        $url2 = file_get_contents('https://picsum.photos/v2/list?limit=4');
        $news = json_decode($url2);
//dd($imagens);
        return view('frontend.welcome',['imagens'=>$imagens, 'news'=>$news]);
    }
}
