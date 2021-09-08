<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait showData
{
    public function DBData($table, $condition, $state, $obj)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';

        $update = "";

        if($state == "select"){
            $response  = Http::asForm()->withHeaders([
                'Accept' => 'application/json'
            ])->post($bpmapi, [
                'funName' => 'callDBApi',
                'Data' => '{"DB":"BPM","TbName":"'.$table.'","condition":"'.$condition.'","statements":"'.$state.'"}',
                'conArr' => '{}',
                'column' => ''
            ]);
        }
        else if($state == "insert"){
            $response  = Http::asForm()->withHeaders([
                'Accept' => 'application/json'
            ])->post($bpmapi, [
                'funName' => 'callDBApi',
                'Data' => '{"DB":"BPM","TbName":"'.$table.'","condition":"'.$condition.'","statements":"'.$state.'"}',
                'insertObj' => $obj
            ]);
        }
        else if($state == "update"){
            $response  = Http::asForm()->withHeaders([
                'Accept' => 'application/json'
            ])->post($bpmapi, [
                'funName' => 'callDBApi',
                'Data' => '{"DB":"BPM","TbName":"'.$table.'","condition":"'.$condition.'","statements":"'.$state.'"}',
                'conArr' => '{}',
                'updateObj' => $obj
            ]);
        }
        else if($state == "delete"){
            $response  = Http::asForm()->withHeaders([
                'Accept' => 'application/json'
            ])->post($bpmapi, [
                'funName' => 'callDBApi',
                'Data' => '{"DB":"BPM","TbName":"'.$table.'","condition":"'.$condition.'","statements":"'.$state.'"}',
                'conArr' => '{}',
                'column' => ''
            ]);
        }

        return $response;
    }
}
