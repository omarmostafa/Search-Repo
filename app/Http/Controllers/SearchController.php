<?php

namespace App\Http\Controllers;

use App\Helpers\Guzzle;
use App\Helpers\Search;
use App\Helpers\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends ApiController
{

    /**
     * search validation
     * @var array
     */
    protected $searchRules=[
        'price.from'=>"required_with:price|numeric||min:0", // when price is exist user must enter from price and must be number and positive
        "price.to"=>"required_with:price|numeric||min:0",  // when price is exist user must enter to price  must be number and positive
        'dates.from'=>"required_with:dates|date",  // when date is exist user must enter from date and must be date
        "dates.to"=>"required_with:dates|date", // when date is exist user must enter to date and must be date
        "sorted_by"=>"required_with:sort|in:name,price" ,// must be entered with sort method and equal price or name
        "sort"=>"required_with:sorted_by|in:ASC,DESC" // must be entered with sort method and equal price or name
    ];

    /**
     * take request and call guzzle to consume api and filter items
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchValidation = Validator::make($request->all(), $this->searchRules); //consume search validation in request
        if($searchValidation->fails()) // check if request is fail
        {
            $errors =$searchValidation->messages()->toArray();
            return $this->respondNotAcceptable(['msg'=>'Errors in inputs','errors'=>$errors]);
        }
        $items=Guzzle::getContent("https://api.myjson.com/bins/tl0bp"); // consume api by guzzle library
        $search=new Search();
        $items=$search->Search($items['hotels'],$request->all());
        if($request->has('sorted_by') && $request->has('sort')) {
            $sort=new Sort();
            $items = $sort->sort($items, $request->input('sorted_by'), $request->input('sort'));
        }
        return $this->respondAccepted(['msg'=>"Hotels Returned Successfully","hotels"=>$items]);
    }
}
