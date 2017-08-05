<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SearchValidator
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
        "sorted_by"=>"in:name,price" ,// must be entered with sort method and equal price or name
        "sort"=>"in:ASC,DESC" // must be entered with sort method and equal price or name
    ];

    /**
     * make validation on request
     * @param Request $request
     * @return mixed
     */
    public function validate(Request $request)
    {
        $searchValidation = Validator::make($request->all(), $this->searchRules); //consume search validation in request
        return $searchValidation;
    }
}
