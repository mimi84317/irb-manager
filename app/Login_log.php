<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login_log extends Model
{
    // 資料表名稱
    protected $table = 'login_logs';

    // 主鍵名稱
    protected $primaryKey = 'id';

    // 可以大量指定異動的欄位
    protected $fillable = [
        'clientid',
        'user',
        'event_type_id',
    ];

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // 資料表欄位輸出格式轉換
    // protected $casts = [
    //     'login_at' => 'datetime:Y-m-d H:i:s',
    // ];
}
