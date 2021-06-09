<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class InvalidJwtTest extends TestCase
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
     * [無jwt]新案登入上傳頁.
     *
     * @return void
     */
    public function testInvalidNewCaseUploadPage()
    {
        // $ret = $this->post('/api/auth/login/newcase/ans654321/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        // 'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        // $content = json_decode($ret->getContent());
        // $token = $content->access_token;
        $response = $this->call('POST', '/auth/fileupload');
        $response -> assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]期中登入上傳頁.
     *
     * @return void
     */
    public function testInvalidMidtermUploadPage()
    {
        // $ret = $this->post('/api/auth/login/midterm/ans654322/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        // 'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        // $content = json_decode($ret->getContent());
        // $token = $content->access_token;
        $response = $this->call('POST', '/auth/fileupload');
        $response -> assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]結案登入上傳頁.
     *
     * @return void
     */
    public function testInvalidClosedCaseUploadPage()
    {
        // $ret = $this->post('/api/auth/login/closedcase/ans654323/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        // 'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        // $content = json_decode($ret->getContent());
        // $token = $content->access_token;
        $response = $this->call('POST', '/auth/fileupload');
        $response -> assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]修正登入上傳頁.
     *
     * @return void
     */
    public function testInvalidFixUploadPage()
    {
        // $ret = $this->post('/api/auth/login/fix/ans654324/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        // 'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        // $content = json_decode($ret->getContent());
        // $token = $content->access_token;
        $response = $this->call('POST', '/auth/fileupload');
        $response -> assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]異常登入上傳頁.
     *
     * @return void
     */
    public function testInvalidAbnormalUploadPage()
    {
        // $ret = $this->post('/api/auth/login/abnormal/ans654325/MEMC_5000000', ['username' => 'testsso', 'clientid' => 'test',
        // 'client_secret' => '123456', 'user' => 'MEMC_5000000']);

        // $content = json_decode($ret->getContent());
        // $token = $content->access_token;
        $response = $this->call('POST', '/auth/fileupload');
        $response -> assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]上傳檔案
     *
     * @return void
     */
    public function testInvalidUploadFile()
    {
        $response = $this->call('POST', route('file.upload.post'),[
            'file' => $file = [UploadedFile::fake()->create('faketest.pdf', ' ')],
            'description' => ['desc'],
            'fieldName' => ['自行上傳']
        ]);
        $response->assertRedirect('/expired'); //跳轉
    }
    /**
     * [無jwt]下載檔案
     *
     * @return void
     */
    public function testInvalidDownloadFile()
    {
        $filename = 'faketest.pdf'; // 上一個測試上傳的檔案

        $response = $this->get(route('file.download',['fileid'=>$filename]));

        $response->assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]刪除檔案
     *
     * @return void
     */
    public function testInvalidDeleteFile()
    {

        $filename = 'faketest.pdf';

        $response = $this->call('POST', route('file.delete.post'), [
            'filename' => $filename
        ]);

        $response->assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]合併檔案
     *
     * @return void
     */
    public function testInvalidMergeFile()
    {
        $response = $this->post(route('pdf.merge', [
            'clientid'=>'test',
            'memid'=>'MEMC_5555555',
            'ans' => 'ansTest'
            ]));
        $response->assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]預覽檔案
     *
     * @return void
     */
    public function testInvalidPreviewFile()
    {
        $filename = 'MEMC_5555555_ansTest.pdf'; // 上一個測試合併的檔案

        $response = $this->post(route('file.preview.page',['filename'=>$filename]));

        $response->assertRedirect('/expired'); //跳轉
    }
    /**
     * [無jwt]撤銷 JWT.
     *
     * @return void
     */
    public function testInvalidLogoutJwt()
    {
        $response = $this->call('POST', '/api/auth/logout');

        $response->assertRedirect('/expired'); //跳轉
    }

    /**
     * [無jwt]更新 JWT.
     *
     * @return void
     */
    public function testInvalidRefreshJwt()
    {
        $response = $this->call('POST', '/api/auth/refresh');

        $response->assertRedirect('/expired'); //跳轉
    }

}
