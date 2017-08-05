<?php

namespace App\Http\Controllers;

use App\Helpers\HotelManager;
use App\Helpers\Search;
use App\Helpers\SearchValidator;
use App\Helpers\Sort;
use Illuminate\Http\Request;

class SearchController extends ApiController
{
    protected $searchValidator,$hotelManager;

    public function __construct(SearchValidator $v,HotelManager $m)
    {
        $this->searchValidator=$v;
        $this->hotelManager=$m;
    }
    /**
     * take request and call guzzle to consume api and filter items
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchValidation=$this->searchValidator->validate($request);
        if($searchValidation->fails())
        {
            $errors =$searchValidation->messages()->toArray();
            return $this->respondNotAcceptable(['msg'=>'Errors in inputs','errors'=>$errors]);
        }
        $sort = ($request->input('sort')) ? $request->input('sort') : 'ASC';
        $sorted_by = ($request->input('sorted_by')) ? $request->input('sorted_by') : 'price';
        $items=$this->hotelManager->search($request->all())->sort($sorted_by,$sort);
        return $this->respondAccepted(['msg'=>"Hotels Returned Successfully","hotels"=>$items]);
    }
}
