# Controller說明

## AuthController

進入此 controller 的 function 會先經過 middleware 檢查 JWT 是否有效，若無效則會返回 login 路由 (目前設定在 ```routes/web.php```)  
```php
Route::get('expired', 'RegisterController@invalid')->name('login');
```

### 登入
```php
public function login()
```
JWT 套件提供，取得 JWT 並回傳 JSON
```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYxNjU2ODY5NiwiZXhwIjoxNjE2NTc1ODk2LCJuYmYiOjE2MTY1Njg2OTYsImp0aSI6IlBpamtCQVpQd0JlVVRtRVgiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEiLCJjbGllbnRpZCI6InRlc3QiLCJ1c2VybmFtZSI6InRlc3Rzc28xMjMifQ.NnlJ2jggP-eniFjYk0kGzwQc5VSJs5pJV80NZ_pbIRQ",
    "token_type": "bearer",
    "expires_in": 7200,
    "username": "testsso123",
    "dbret": true
}
```

### 存取
```php
public function me()
```
回傳上傳檔案頁面 view

### 登出
```php
public function logout()
```
JWT 套件提供

### 更新
```php
public function refresh()
```
JWT 套件提供

## CheckDirController
```php
function checkDir($memid, $ans)
```
**檢查是否有關連資料夾，沒有則新建**
* $memid : 申請人 memid
* $ans : 申請人表單編號
```php
function moveFile()
```
**將上傳檔案移至關聯資料夾**

## Controller
Laravel 內建 Controller

## ExampleFileManagController
管理範例檔案，存取限制未設定

### 上傳範例檔案
```php
public function upload(Request $request)
```
上傳檔案至 `filepool/{clientid}/example/{caseType}`  
**注意資料夾權限設定，如出現權限問題可設定擁有者為 apache**  
POST 參數：  
| 名稱 | 說明 |
| - | - |
| clientid | client ID |
| caseType | 案件類型 |
HTML 檔案標籤名稱：file
```html
<input type="file" name="file[]">
```

### 刪除範例檔案
```php
public function delete()
```
刪除 `filepool/{clientid}/example/{caseType}/{file}`  
POST 參數：  
| 名稱 | 說明 |
| - | - |
| clientid | client ID |
| caseType | 案件類型 |
| file | 欲刪除的檔案名稱 |  

### 下載範例檔案
```php
public function download()
```
傳入網址下載檔案  
例如：`http://localhost:8000/api/example/download?clientid=test&caseType=testcase&file=範例.pdf`  
GET 參數：  
| 名稱 | 說明 |
| - | - |
| clientid | client ID |
| caseType | 案件類型 |
| file | 檔案名稱 |  

## FileUploadController
管理使用者檔案用，使用 jwt 中介層檢查
### 上傳檔案
```php
public function fileUploadPost(Request $request)
```
限制副檔名為 pdf ，及限制大小。
以 form 格式接收，可一次接收多列檔案資料，
須注意總檔案大小不可超過 php.ini 的設定大小。  
**Form 欄位：**
| 名稱| 說明 |
|-|-|
| description | 檔案說明 |
| fieldName | 檔案中文名稱 |
| file | Form 的檔案 |

### 刪除檔案
```php
public function fileDelete(Request $request)
```
傳入 token 及 filename 刪除檔案  
(檔案路徑於 token 中取出 clientid、owner、ansid 重新組合)

### 刪除資料夾
```php
public function deleteDirectory()
```
傳入 token 刪除整個 ans 資料夾

### 下載檔案
```php
public function fileDownloadPage($path)
```
傳入 token 及 filename  
(檔案路徑於 token 中取出 clientid、owner、ansid 重新組合)  
啟動瀏覽器下載檔案功能

### 下載範例檔案
```php
public function fileDownloadExample($case, $filename)
```
傳入 token、案件類型及 filename  
(檔案路徑於 token 中取出 clientid 重新組合)  
啟動瀏覽器下載檔案功能

### 預覽檔案
```php
public function filePreviewPage($path)
```
傳入 token 及 filename  
(檔案路徑於 token 中取出 clientid、owner、ansid 重新組合)  
回傳開啟瀏覽器內建 PDF reader

## PDFMergerController
```php
function pdfMerge($dir, $memid, $ans)
```
**合併pdf**
* $dir : 欲合併之檔案目錄
* $memid : 申請人 memid
* $ans : 申請人表單編號

## RegisterController
新增 client 使用，  
中介層 IP 白名單於 .env 中設定
```
WHITELIST = 127.0.0.1;10.109.193.14
```

### 註冊 client
```php
public function register(Request $request)
```
#### 輸入
輸入以下參數註冊客戶端到資料庫
| 參數名稱 | 說明 | 備註 |
|---|---|---|
| name | 客戶端名稱 | 必填，不可含有特殊符號 |
| clientid | 客戶端 ID | 必填，不可含有特殊符號 |
| client_secret | 客戶端密碼 | 必填，資料庫中會經過加密，非明碼 |

#### 回傳
* 註冊成功
```json
{
    "success": true
}
```

* 註冊失敗
```json
{
    "success": false
}
```

* 不符規定
```json
{
    "errorFlag": "404"
}
```

## ViewController
回傳各種 view

### 例外錯誤
```php
public function invalid()
```
回傳 exception.blade.php，用於發生錯誤時，例如：JWT expired。

## FileuploadlistController
設定案件上傳清單相關controller
### 顯示案件上傳清單

```php
public function showFileuploadlist(Request $request)
```
呼叫BPM API將回傳值傳至uploadFilelist.blade.php
### 顯示案件上傳清單-設定
```php
public function showFileuploadlistSetting($caseType, Request $request)
```
呼叫BPM API將回傳值傳至uploadFileListSetting.blade.php

**$caseType : 案件類型**
| 參數| 名稱 |
|-|-|
| newcase | 新案審查 |
| midcase | 期中審查 |
| closedcase | 結案審查 |
| fixcase | 修正審查 |
| abnormalcase | 異常審查(院內) |
### 更新案件上傳清單-設定
```php
public function updateFileuploadlistSetting(Request $request)
```
### 下載已上傳之範例檔
```php
public function fileDownloadExample($case, $filename)
```
  $filename : 檔案名稱
### 上傳範例檔
```php
public function fileUploadPost($caseType, Request $request)
```

## CommitteeController
設定委員會議程相關controller
### 設定委員會議程-主頁顯示
```php
public function showCommittee(Request $request)
```
### 設定委員會議程-主頁查詢
```php
public function searchCommittee(Request $request)
```
### 設定委員會議程-會議紀錄、會議內容顯示
```php
public function showCommitteeContent(Request $request)
```
### 設定委員會議程-更新會議紀錄、會議內容顯示
```php
public function updateCommittee(Request $request)
```
### 設定委員會議程-討論案件清單
```php
public function showCommitteeList(Request $request)
```
### 設定委員會議程-刪除會議
```php
public function deleteCommittee(Request $request)
```

## manageFlowController
瀏覽全部審查案相關controller
### showmanageFlow
```php
public function showmanageProtocol(Request $request)
```

## manageProtocolController
管理全部計畫與追蹤審查預定日相關controller
### showmanageProtocol
```php
public function showmanageFlow(Request $request)
```
