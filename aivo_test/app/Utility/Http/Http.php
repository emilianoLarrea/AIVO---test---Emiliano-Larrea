<?php
namespace App\Utility\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Log;
class Http{
    
    public static function http_connection($method, $url, $parameters = [], $headers = []){
        $http = new Client(['timeout' => 10]);
        $url = rtrim($url, '/');
        $method = strtoupper($method);
        $query = null;
        $formParams = null;
        $body = null;

        switch ($method) {
            case 'POST':
                if (is_array($parameters) || is_object($parameters)) {
                    $formParams = $parameters;
                }
                else {
                    $body = $parameters;
                }
                break;

            default:
                $query = $parameters;
                break;
        }
        try {
            $options = [
                'query' => $query,
                'form_params' => $formParams,
                'body' => $body,
                'headers' => $headers
            ];
            
            $response = $http->request($method, $url, $options);
        }
        catch (GuzzleException $e) {
            Log::error('error: ' . $e->getMessage());
            $response = $e->getResponse();
            $headers = $response->getHeaders();
            $body = json_decode((string) $response->getBody(), true);
            $status = $response->getStatusCode();
        }
        $headers = $response->getHeaders();
        $body = json_decode((string) $response->getBody(), true);
        $status = $response->getStatusCode();

        return [
            'body' => $body,
            'headers' => $headers,
            'status' => $status,
            'url' => $url,
        ];
    }
}
