<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    public function testBrandList()
    {

        $response = $this->get('wx/brand/list');
        $content = $response->getOriginalContent();
        $this->assertEquals(0, $content['errno']);
//        dd($response1->getOriginalContent());
    }

    public function testBrandDetail()
    {

        $response = $this->get('wx/brand/detail?id=1001007');
        $content = $response->getOriginalContent();
        $this->assertEquals(0, $content['errno']);
//        dd($response1->getOriginalContent());
    }
}
