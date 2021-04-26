<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait showData
{
    public function showDBData($table)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        
        $response  = Http::asForm()->withHeaders([
            'Accept' => 'application/json'
        ])->post($bpmapi, [
            'funName' => 'callDBApi',
            'Data' => '{"DB":"BPM","TbName":"'.$table.'","condition":"  ","statements":"select"}',
            'conArr' => '{}',
            'column' => ''
        ]);

        //$newcaseHttpcode = $newcaseResponse->status();
        
        return $response;
    }
}
