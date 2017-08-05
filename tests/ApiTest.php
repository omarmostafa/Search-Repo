<?php

/**
 * Created by PhpStorm.
 * User: omar
 * Date: 8/4/17
 * Time: 10:27 PM
 */
class ApiTest extends TestCase
{
    /**
     * test if entered from price only
     */
    public function testPriceValidation()
    {
        $this->json('POST', '/search', ['price' => ['from'=>100]])
            ->seeJson([
                'success' => false,
            ]);
    }

    /**
     * test if entered to price only
     */
    public function testDateValidation()
    {
        $this->json('POST', '/search', ['dates' => ['from'=>'15-11-2020']])
            ->seeJson([
                'success' => false,
            ]);
    }

    /**
     * test if entered a non format date
     */
    public function testDateValidationWithString()
    {
        $this->json('POST', '/search', ['dates' => ['from'=>'15-11-2020','to'=>'test']])
            ->seeJson([
                'success' => false,
            ]);
    }

    /**
     * test price with negative value
     */
    public function testPriceValidationWithNegative()
    {
        $this->json('POST', '/search', ['price' => ['from'=>-100,'to'=>105]])
            ->seeJson([
                'success' => false,
            ]);
    }

    /**
     * enter another value in sorted by
     */
    public function testSortedByValidation()
    {
        $this->json('POST', '/search', ['sorted_by'=>'city'])
            ->seeJson([
                'success' => false,
            ]);
    }

    /**
     * enter a wrong value in sort dir
     */
    public function testSortDirValidation()
    {
        $this->json('POST', '/search', ['sort'=>'ASCC'])
            ->seeJson([
                'success' => false,
            ]);
    }

    /**
     * enter valid fields
     */
    public function testSuccessValidation()
    {
        $this->json('POST', '/search', ['name'=>'media','city'=>'dubai','price'=>['from'=>100,'to'=>105],
            'dates'=>['from'=>'10-10-2020','to'=>'15-10-2020'],'sort'=>'ASC','sorted_by'=>'price'])
            ->seeJson([
                'success' => true,
            ]);
    }
}
