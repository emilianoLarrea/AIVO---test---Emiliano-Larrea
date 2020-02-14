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
        if(is_array($token_response)){
            //echo json_encode($token_response);die;
            return (new Response($token_response['body']['error'], $token_response['status']));
        }else{
            $content = \MusicService::getArtist($data, $token_response);
            return (new Response($content, 200));
        }
    }
   
}

//aivo_test/app/Services/Music/services.php