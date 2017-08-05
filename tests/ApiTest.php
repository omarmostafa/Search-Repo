<?php

/**
 * Created by PhpStorm.
 * User: omar
 * Date: 8/4/17
 * Time: 10:27 PM
 */
class ApiTest extends TestCase
{
    public function testPriceValidation()
    {
        $this->json('POST', '/search', ['price' => ['from'=>100]])
            ->seeJson([
                'success' => false,
            ]);
    }

    public function testDateValidation()
    {
        $this->json('POST', '/search', ['dates' => ['from'=>'15-11-2020']])
            ->seeJson([
                'success' => false,
            ]);
    }

    public function testDateValidationWithString()
    {
        $this->json('POST', '/search', ['dates' => ['from'=>'15-11-2020','to'=>'test']])
            ->seeJson([
                'success' => false,
            ]);
    }
    public function testPriceValidationWithNegative()
    {
        $this->json('POST', '/search', ['price' => ['from'=>-100,'to'=>105]])
            ->seeJson([
                'success' => false,
            ]);
    }
    public function testSortedByValidation()
    {
        $this->json('POST', '/search', ['sorted_by'=>'city'])
            ->seeJson([
                'success' => false,
            ]);
    }
    public function testSortDirValidation()
    {
        $this->json('POST', '/search', ['sort'=>'ASCC'])
            ->seeJson([
                'success' => false,
            ]);
    }
    public function testSuccessValidation()
    {
        $this->json('POST', '/search', ['name'=>'media','city'=>'dubai','price'=>['from'=>100,'to'=>105],
            'dates'=>['from'=>'10-10-2020','to'=>'15-10-2020'],'sort'=>'ASC','sorted_by'=>'price'])
            ->seeJson([
                'success' => true,
            ]);
    }
}
