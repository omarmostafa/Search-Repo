<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 8/4/17
 * Time: 7:10 PM
 */

namespace App\Helpers;


class Sort
{

    /**
     * Merge sort O(nlog(n))
     * @param array $array
     * @param string $sorted_by
     * @param string $sort
     * @return array|mixed
     */
   public function sort(array $array, string $sorted_by , string $sort) : array
    {
        if(count($array) == 1 )
        {
            return $array;
        }

        $mid = ceil(count($array) / 2);
        $left = array_slice($array, 0, $mid);
        $right = array_slice($array, $mid);
        $left = $this->sort($left,$sorted_by,$sort); // r
        $right = $this->sort($right,$sorted_by,$sort);
        return $this->merge($left, $right,$sorted_by,$sort);
    }

    /**
     * merge array and sort it
     * @param array $left
     * @param array $right
     * @param string $sorted_by
     * @param string $sort
     * @return array|mixed
     */
   public function merge(array $left, array $right, string $sorted_by,string $sort) : array
    {
        $final_result = array();

        if($sort=='ASC')
        {
           $temporary_result= $this->sortASC($left,$right,$final_result,$sorted_by);
            $final_result=$temporary_result['res'];
            $left=$temporary_result['left'];
            $right=$temporary_result['right'];
        }
        elseif ($sort='DESC')
        {
            $temporary_result= $this->sortDESC($left,$right,$final_result,$sorted_by);
            $final_result=$temporary_result['res'];
            $left=$temporary_result['left'];
            $right=$temporary_result['right'];
        }

        while (count($left) > 0)
        {
            $final_result[] = $left[0];
            $left = array_slice($left, 1);
        }

        while (count($right) > 0)
        {
            $final_result[] = $right[0];
            $right = array_slice($right, 1);
        }

        return $final_result;
    }

    /**
     * sorting ASC
     * @param array $left
     * @param array $right
     * @param array $res
     * @param string $sorted_by
     * @return array
     */
    public function sortASC(array $left,array $right,array $res, string $sorted_by) :array
    {

        while (count($left) > 0 && count($right) > 0)
        {
            if($left[0][$sorted_by] > $right[0][$sorted_by])
            {
                $res[] = $right[0];
                $right = array_slice($right , 1);
            }
            else
            {
                $res[] = $left[0];
                $left = array_slice($left, 1);
            }
        }
        return ['left'=>$left,'right'=>$right,'res'=>$res];
    }

    /**
     * sort DESC
     * @param array $left
     * @param array $right
     * @param array $res
     * @param string $sorted_by
     * @return array
     */
    public function sortDESC(array $left,array $right,array $res,string $sorted_by) : array
    {
        while (count($left) > 0 && count($right) > 0)
        {
            if($left[0][$sorted_by] < $right[0][$sorted_by])
            {
                $res[] = $right[0];
                $right = array_slice($right , 1);
            }
            else
            {
                $res[] = $left[0];
                $left = array_slice($left, 1);
            }
        }

        return ['left'=>$left,'right'=>$right,'res'=>$res];

    }
}