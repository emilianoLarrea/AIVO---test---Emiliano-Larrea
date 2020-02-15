<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Utility\Auth\Auth;
use App\Utility\Data\Data;


class MusicController extends Controller
{
    public function getArtist(Request $request){
        require_once('../app/Services/Music/MusicService.php');
        $data = Data::validateQuery($request);
        $token_response = Auth::getToken();
        $content = \MusicService::getArtist($data, $token_response);
        return (new Response($content, 200))->header('Content-Type', 'application/json');;
    }

    public function getAlbums(Request $request)
    {
        require_once('../app/Services/Music/MusicService.php');
        $data = Data::validateQuery($request);
        $token_response = Auth::getToken();
        $artist = \MusicService::getArtist($data, $token_response);
        $content = \MusicService::getAlbums($artist, $token_response);
        return (new Response($content, 200))->header('Content-Type', 'application/json');
    }
   
}