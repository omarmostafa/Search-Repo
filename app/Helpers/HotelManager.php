<?php
namespace App\Helpers;
use GuzzleHttp\Client;

class HotelManager
{
    protected $search,$sort,$client,$url,$result;
    public function __construct(Client $c,Search $s , Sort $sort)
    {
        $this->search=$s;
        $this->sort=$sort;
        $this->client=$c;
        $this->url="https://api.myjson.com/bins/tl0bp";
    }

    /**
     * use Search class to filter hotels
     * @param array $input
     * @return $this
     */
    public function search(array $input)
    {
        $hotels=$this->getHotels();
        $this->result=$this->search->filter($hotels['hotels'],$input);
        return $this;
    }

    /**
     * use Sort Class to sort hotels
     * @param $sorted_by
     * @param $sort
     * @return array|mixed
     */
    public function sort($sorted_by,$sort)
    {
        $result=$this->sort->sort($this->result,$sorted_by,$sort);
        return $result;
    }
    /**
     * use Guzzle to make request and get Results
     * @return mixed
     */
    public function getHotels()
    {
        $response = $this->client->get($this->url);
        return $response->json();
    }
}
