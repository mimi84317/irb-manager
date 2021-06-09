<?php

namespace Tests\Feature;

use App\Traits\CheckDir;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileTest extends TestCase
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
        // dump($ret->getContent());
        $ret->assertJson(['success' => true]);
    }
    use CheckDir;
    /**
     * 上傳檔案
     *
     * @return void
     */
    public function testUploadFile()
    {
        // get JWT
        $ret = $this->post('/api/auth/login/newcase/ansTest/MEMC_5555555', ['username' => 'laravelTest', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5555550']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;

        // Storage::fake('fakeFilepool');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->call('POST', route('file.upload.post'),[
            'file' => $file = [UploadedFile::fake()->create('faketest.pdf', ' ')],
            'description' => ['desc'],
            'fieldName' => ['自行上傳']
        ]);
        Storage::disk('filepool')->assertExists($this->checkDir('test','MEMC_5555555','ansTest').'/faketest.pdf');
    }

    /**
     * 下載檔案
     *
     * @return void
     */
    public function testDownloadFile()
    {
        // get JWT
        $ret = $this->post('/api/auth/login/newcase/ansTest/MEMC_5555555', ['username' => 'laravelTest', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5555550']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;

        $filename = 'faketest.pdf'; // 上一個測試上傳的檔案

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->get(route('file.download',['fileid'=>$filename]));

        $response->assertOk();
        $this->assertEquals($response->headers->get('content-disposition'), 'attachment; filename=' . $filename . '');
    }

    /**
     * 下載範例檔案
     * (案件上傳檔案頁面)
     * @return void
     */
    public function testDownloadExampleFileFromFilelistPage()
    {
        // get JWT
        $ret = $this->post('/api/auth/login/newcase/ansTest/MEMC_5555555', ['username' => 'laravelTest', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5555550']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;

        $filename = '1-1.pdf'; // 範例檔案 (中文檔名的'content-disposition'會有問題)

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->get(route('example.download',['case'=>'newcase','fileid'=>$filename]));
        // dump($response->headers);
        $response->assertOk();
        $this->assertEquals($response->headers->get('content-disposition'), 'attachment; filename=' . urlencode($filename) . '');
    }

    /**
     * 刪除檔案 (fake產生的PDF無法讀取也不能合併，先刪除)
     *
     * @return void
     */
    public function testDeleteFile()
    {
        // get JWT
        $ret = $this->post('/api/auth/login/newcase/ansTest/MEMC_5555555', ['username' => 'laravelTest', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5555550']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;

        $filename = 'faketest.pdf';

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->call('POST', route('file.delete.post'), [
            'filename' => $filename
        ]);

        $response->assertJson([ "disk"=> "Delete Success",
        "DB"=> "Delete Success"]);
    }

    /**
     * 合併檔案
     * 要先放至少一個正常的PDF檔案在filepool\test\MEMC_5\MEMC_555\MEMC_5555555\ansTest
     * @return void
     */
    public function testMergeFile()
    {
        $ret = $this->post('/api/auth/login/newcase/ansTest/MEMC_5555555', ['username' => 'laravelTest', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5555550']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->post(route('pdf.merge', [
            'clientid'=>'test',
            'memid'=>'MEMC_5555555',
            'ans' => 'ansTest'
            ]));

        Storage::disk('filepool')->assertExists($this->checkDir('test','MEMC_5555555','ansTest').'/MEMC_5555555_ansTest.pdf');
        // $response->assertDontSee('expired');
    }

    /**
     * 預覽檔案
     *
     * @return void
     */
    public function testPreviewFile()
    {
        $ret = $this->post('/api/auth/login/newcase/ansTest/MEMC_5555555', ['username' => 'laravelTest', 'clientid' => 'test',
        'client_secret' => '123456', 'user' => 'MEMC_5555550']);

        $content = json_decode($ret->getContent());
        $token = $content->access_token;

        $filename = 'MEMC_5555555_ansTest.pdf'; // 上一個測試合併的檔案

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->post(route('file.preview.page',['filename'=>$filename]));

        $response->assertOk();
        $this->assertEquals($response->headers->get('content-type'), 'application/pdf');

        // 刪除 merge 檔案
        $filename = 'MEMC_5555555_ansTest.pdf';

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->call('POST', route('file.delete.post'), [
            'filename' => $filename
        ]);

        $response->assertJson([ "disk"=> "Delete Success",
        "DB"=> "Delete Success"]);
    }

    /**
     * 上傳範例檔案
     *
     * @return void
     */
    public function testUploadExampleFile()
    {
        // get JWT
        // $ret = $this->post('/api/auth/login/newcase/ansTest/MEMC_5555555', ['username' => 'laravelTest', 'clientid' => 'test',
        // 'client_secret' => '123456', 'user' => 'MEMC_5555550']);

        // $content = json_decode($ret->getContent());
        // $token = $content->access_token;

        // Storage::fake('fakeFilepool');

        $response = $this->call('POST', '/api/example/upload', [
            'file' => $file = UploadedFile::fake()->create('faketestexample.pdf'),
            'clientid' => 'test',
            'caseType' => 'testcase'
        ]);
        $response->assertJson(['fileID'=>'test/example/testcase/faketestexample.pdf']);
        Storage::disk('filepool')->assertExists('test/example/testcase/faketestexample.pdf');
    }

    /**
     * 下載範例檔案
     * (給後台用的API)
     * @return void
     */
    public function testDownloadExampleFile()
    {
        $filename = 'faketestexample.pdf';
        $response = $this->call('GET', '/api/example/download', [
            'file' => $filename,
            'clientid' => 'test',
            'caseType' => 'testcase'
        ]);
        $response->assertOk();
        $this->assertEquals($response->headers->get('content-disposition'), 'attachment; filename=' . urlencode($filename) . '');
    }

    /**
     * 刪除範例檔案
     *
     * @return void
     */
    public function testDeleteExampleFile()
    {
        $filename = 'faketestexample.pdf';
        $response = $this->call('POST', '/api/example/delete', [
            'file' => $filename,
            'clientid' => 'test',
            'caseType' => 'testcase'
        ]);

        $response->assertJson(['Success'=>true]);
    }

}
