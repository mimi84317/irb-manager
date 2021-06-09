<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JWTLoginTest extends TestCase
{
    use RefreshDatabase;
    public function setUp() :void
    {
        // 一定要先呼叫，建立 Laravel Service Container 以便測試
        parent::setUp();

        // 每次都要初始化資料庫
        $ret = $this->post('/api/register', [
            'name' => 'test',
            'clientid' => 'test',
            'client_secret' => '123456'
            ]);
        $ret->assertJson(['success' => true]);
    }
    /**
     * 取得JWT (new case).
     *
     * @return void
     */
    public function testLoginNewCase()
    {
        $response = $this->call('POST', '/api/auth/login/newcase/ans654321/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $response->assertStatus(200)
        ->assertJson(['dbret'=>true]);
    }

    /**
     * 取得JWT (midterm).
     *
     * @return void
     */
    public function testLoginMidterm()
    {
        $response = $this->call('POST', '/api/auth/login/midterm/ans654322/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $response->assertStatus(200)
        ->assertJson(['dbret'=>true]);
    }

    /**
     * 取得JWT (closed case).
     *
     * @return void
     */
    public function testLoginClosedCase()
    {
        $response = $this->call('POST', '/api/auth/login/closedcase/ans654323/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $response->assertStatus(200)
        ->assertJson(['dbret'=>true]);
    }

    /**
     * 取得JWT (fix).
     *
     * @return void
     */
    public function testLoginFix()
    {
        $response = $this->call('POST', '/api/auth/login/fix/ans654324/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $response->assertStatus(200)
        ->assertJson(['dbret'=>true]);
    }

    /**
     * 取得JWT (abnormal).
     *
     * @return void
     */
    public function testLoginAbnormal()
    {
        $response = $this->call('POST', '/api/auth/login/abnormal/ans654325/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $response->assertStatus(200)
        ->assertJson(['dbret'=>true]);
    }

    /**
     * 撤銷 JWT.
     *
     * @return void
     */
    public function testLogoutJwt()
    {

        $ret = $this->post('/api/auth/login/abnormal/ans654325/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->call('POST', '/api/auth/logout');

        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Successfully logged out'
            ]);
    }

    /**
     * 更新 JWT.
     *
     * @return void
     */
    public function testRefreshJwt()
    {

        $ret = $this->post('/api/auth/login/abnormal/ans654325/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->call('POST', '/api/auth/refresh');

        $response->assertStatus(200)
        ->assertJson(['dbret'=>true]);
    }
}
