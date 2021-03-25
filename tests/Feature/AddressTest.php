<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
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

    public function testAddressList()
    {

        $response1 = $this->get('wx/address/list', $this->getJwtToken());
//        dd($response1->getOriginalContent());
    }

    public function testAddressDetail()
    {

        $response1 = $this->post('wx/address/detail', ['id' => 1], $this->getJwtToken());
//        dd($response1->getOriginalContent());
    }
    public function testAddressDelete()
    {

        $response1 = $this->post('wx/address/delete', ['id' => 1], $this->getJwtToken());
//        dd($response1->getOriginalContent());
    }
}
