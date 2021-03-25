<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function getJwtToken()
    {
        $response = $this->post('wx/auth/login',[
            'username' => 'user123',
            'password'=> 'user123',
        ]);
        $this->assertEquals(0,$response->getOriginalContent()['errno']);
        $token = $response->getOriginalContent()['data']['token'] ?? '';
        return ['Authorization'=> "Bearer {$token}"];
    }
}
