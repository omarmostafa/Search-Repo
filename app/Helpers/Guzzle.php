<?php
namespace App\Helpers;
use GuzzleHttp\Client;

class Guzzle
{

    /**
     * use Guzzle to make request and get content
     * @param $url
     * @return mixed
     */
    public static function getContent(string $url)
    {
        $client= new Client();
        $response = $client->get($url);
        return $response->json();
    }
}
