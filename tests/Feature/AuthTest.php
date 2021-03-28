<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             AuthTest.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/24 下午2:34
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */


namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

//    public function testRegister()
//    {
//        $response = $this->post('/wx/auth/register', [
//            'code' => '12312',
//            'mobile' => '13333333333',
//            'password' => '123qwe',
//            'repeatPassword' => '123qwe',
//            'username' => '13333'
//        ]);
//        $content = $response->getOriginalContent();
//        $this->assertEquals(0, $content['errno']);
//    }

    public function testLogin()
    {
        $response = $this->post('wx/auth/login', [
            'username' => 'zhou',
            'password' => '123qwe',
        ]);
        $this->assertEquals(0, $response->getOriginalContent()['errno']);
        $token = $response->getOriginalContent()['data']['token'] ?? '';
        $this->get('wx/auth/logout', ['Authorization' => "Bearer {$token}"]);
        $response = $this->get('wx/auth/info', ['Authorization' => "Bearer {$token}"]);
        $no = $response->getOriginalContent()['errno'];
        $this->assertEquals(501, $no);
    }

    public function testReset()
    {
        $response = $this->post('wx/auth/reset', [
            'code' => '123',
            'mobile' => '18516562180',
            'password' => '123qwe',
        ]);
        $content = $response->getOriginalContent();
        $this->assertEquals(0, $content['errno']);

    }

    public function testProfile()
    {
        $response = $this->post('wx/auth/profile', [
            'gender' => '1',
            'nickname' => 'heiheihei'
        ], $this->getJwtToken());
        $content = $response->getOriginalContent();
        $this->assertEquals(0, $content['errno']);
    }

}
