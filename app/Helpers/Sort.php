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
     * take array and divide it into left and right
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

        $mid = count($array) / 2;
        $left = array_slice($array, 0, $mid);
        $right = array_slice($array, $mid);
        $left = $this->sort($left,$sorted_by,$sort);
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
        $res = array();

        if($sort=='ASC')
        {
           $result= $this->sortASC($left,$right,$res,$sorted_by);
            $res=$result['res'];
            $left=$result['left'];
            $right=$result['right'];
        }
        elseif ($sort='DESC')
        {
            $result= $this->sortDESC($left,$right,$res,$sorted_by);
            $res=$result['res'];
            $left=$result['left'];
            $right=$result['right'];
        }

        while (count($left) > 0)
        {
            $res[] = $left[0];
            $left = array_slice($left, 1);
        }

        while (count($right) > 0)
        {
            $res[] = $right[0];
            $right = array_slice($right, 1);
        }

        return $res;
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