<?php
namespace App\Helpers;

class Search
{
    /**
     * take items and filters to search in items and return filtered items
     * @param array $items
     * @param array $filters
     * @return array
     */
    public function filter(array $items,array $filters) : array 
    {
        foreach ($items as $key => $item)
        {
            $status=true;

            if(isset($filters['name']) && !$this->stringSearch($filters['name'],$item['name'])) // check if hotel name is in filters and name matches hotel name
            {
                $status = false;
            }
            if(isset($filters['city']) && !$this->stringSearch($filters['city'],$item['city'])) // check if city is in filters and city matches city in loop
            {
                $status = false;
            }
            if(isset($filters['dates']) && !$this->findByDateRange($filters['dates'],$item['availability'])) // check if date range is in filters and date range available
            {
                $status = false;
            }
            if(isset($filters['price']) && !$this->findByPrice($filters['price'],$item['price'])) // check if price is in filters and price in price range
            {
                $status = false;
            }
            if($status==false)
            {
                unset($items[$key]);
            }
        }
        return $items;
    }

    /**
     * complexity O(m*n)
     * check matching of token and name
     * @param string $token
     * @param string $name
     * @return bool
     */
    public function stringSearch(string $token,string $name) : bool
    {
        $likely=0;
        $token=str_replace('hotel', '', strtolower($token)); //skip hotels from token
        $name=str_replace('hotel','',strtolower($name));//skip hotels from token
        foreach (str_split($token) as $char) //loop through string
        {
            if (strpos($name, $char) !== false) { // check char in string or not
                $likely++; // increase likely by 1 if char exists in string
            }
        }
        if($likely > strlen($token)*80/100) // if string likely token by 80 % the string is matching token
        {
            return true;
        }
        return false;
    }

    /**
     * check if date range is in hotel availability
     * @param array $date_range
     * @param array $dates
     * @return bool
     */
    public function findByDateRange(array $date_range,array $dates) : bool 
    {
        $status=false;
        foreach ($dates as $date) // loop through available times
        {
            if(strtotime($date['from'])<=strtotime($date_range['from']) && strtotime($date['to'])>=strtotime($date_range['to'])) // if search date range is in any date available
            {
                $status= true;
            }
        }
        return $status;
    }

    /**
     * search by price range
     * @param array $price_range
     * @param float $price
     * @return bool
     */
    public function findByPrice(array $price_range,float $price) : bool 
    {
        if($price_range['from']<=$price && $price_range['to']>=$price) // check if price is in input price range or not
        {
            return true;
        }
        return false;
    }
}
