<?php
namespace App\Utility\Auth;
use Illuminate\Http\Response;
use App\Utility\Http\Http;
use Log;
class Auth{
    
    public static function isValidToken($accessToken = null){
        $headers = [
            'Authorization' => 'Bearer '.$accessToken,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = Http::http_connection("GET", "https://api.spotify.com/v1/me", [], $headers);
        if($response['status'] != 200){
            return 0;
        } 
        return 1;
    }
    public static function refreshToken(){
        
        $refresh_token = env('refresh_token');
        $client_id = env('client_id');
        $client_secret = env('client_secret');
        
        $parameters = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
        ];
        $headers = [
            'Authorization' => 'Basic '.base64_encode($client_id . ':' . $client_secret),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = Http::http_connection("POST", "https://accounts.spotify.com/api/token", $parameters, $headers);
        
        if (isset($response['body']["access_token"])){
            config(['auth_token' => $response['body']["access_token"]]);
            return $response['body']["access_token"];
        }else{
            Log::error('error: ' . $response['body']['error_description']);
            header("HTTP/1.1 ".$response['status'] . " " .$response['body']['error']);
            exit;
        }
    }
    
    public static function getToken(){
        $token = '';
        if(config('auth_token') == null){
            $token = env('auth_token');
        }else{
            $token = config('auth_token');
        }
        if(strlen($token) == 0 OR Auth::isValidToken($token) == 0){
            $token = Auth::refreshToken();
        }
        return $token;
    }
}
