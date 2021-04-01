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
JWT 套件提供，未使用

### 更新
```php
public function refresh()
```
JWT 套件提供，未使用

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

## FileUploadController
測試上傳檔案用

## PDFMergerController
```php
function pdfMerge($dir, $memid, $ans)
```
**合併pdf**
* $dir : 欲合併之檔案目錄
* $memid : 申請人 memid
* $ans : 申請人表單編號

## RegisterController
內部新增 client 使用，  
**！！！尚未設定存取限制！！！**

### 例外錯誤
```php
public function invalid()
```
回傳 exception.blade.php，用於發生錯誤時，例如：JWT expired。

### 註冊 client
```php
public function register(Request $request)
```
#### 輸入
輸入以下參數註冊客戶端到資料庫
| 參數名稱 | 說明 | 備註 |
|---|---|---|
| name | 客戶端名稱 | 必填 |
| clientid | 客戶端 ID | 必填 |
| client_secret | 客戶端密碼 | 必填，資料庫中會經過加密，非明碼 |

#### 回傳
* 註冊成功
```json
{
    "errorFlag": "0"
}
```

* 註冊失敗
```json
{
    "errorFlag": "1"
}
```
