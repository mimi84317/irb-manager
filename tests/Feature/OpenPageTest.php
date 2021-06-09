<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OpenPageTest extends TestCase
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
     * JWT 無效.
     *
     * @return void
     */
    public function testExpired()
    {
        $response = $this->call('POST','/auth/fileupload');

        $response ->assertRedirect('/expired'); //跳轉
    }

    /**
     * 新案登入上傳頁.
     *
     * @return void
     */
    public function testNewCaseUploadPage()
    {
        $ret = $this->post('/api/auth/login/newcase/ans654321/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;
        // dump($token);
        $response = $this->call('POST', '/auth/fileupload', ['token' => $token]);
        $response -> assertSee('新案')
            ->assertOk();
    }

    /**
     * 期中登入上傳頁.
     *
     * @return void
     */
    public function testMidtermUploadPage()
    {
        $ret = $this->post('/api/auth/login/midterm/ans654322/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;
        // dump($token);
        $response = $this->call('POST', '/auth/fileupload', ['token' => $token]);
        $response -> assertSee('期中')
            ->assertOk();
    }

    /**
     * 結案登入上傳頁.
     *
     * @return void
     */
    public function testClosedCaseUploadPage()
    {
        $ret = $this->post('/api/auth/login/closedcase/ans654323/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;
        // dump($token);
        $response = $this->call('POST', '/auth/fileupload', ['token' => $token]);
        $response -> assertSee('結案')
            ->assertOk();
    }

    /**
     * 修正登入上傳頁.
     *
     * @return void
     */
    public function testFixUploadPage()
    {
        $ret = $this->post('/api/auth/login/fix/ans654324/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;
        // dump($token);
        $response = $this->call('POST', '/auth/fileupload', ['token' => $token]);
        $response -> assertSee('修正')
            ->assertOk();
    }

    /**
     * 異常登入上傳頁.
     *
     * @return void
     */
    public function testAbnormalUploadPage()
    {
        $ret = $this->post('/api/auth/login/abnormal/ans654325/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;
        // dump($token);
        $response = $this->call('POST', '/auth/fileupload', ['token' => $token]);
        $response -> assertSee('異常')
            ->assertOk();
    }

}
