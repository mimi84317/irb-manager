# IRB 檔案上傳功能 
## 目錄

* [說明](#說明)
* [安裝](#安裝)
    * [Windows 開發環境建置](#Windows-開發環境建置)
    * [CentOS 環境建置](#centos-環境建置)
* [設定](#設定)
    * [設定 .env](#設定-.env)
    * [設定 Apache vhosts](#設定-Apache-vhosts)
* [其他設定](#其他設定)
* [使用](#使用)
    * [啟動伺服器](#啟動伺服器)
    * [API](#api)
* [參考資料](#參考資料)
* [備註](#備註)

## 說明
為解決 Agentflow 檔案上傳功能無法自訂上傳清單，及提供 PDF 檔案合併功能而開發的擴充功能。  
使用 JWT 驗證應用系統 (如 Agentflow) 到開啟上傳頁面的權限

### TODO LIST
- [x] JWT 驗證  
- [x] PDF 合併
- [x] 檔案上傳
- [ ] 檔案上傳至指定 filepool
- [ ] PostTooLarge Exception 50MB?
- [ ] filepool 外移
- [ ] 刪除、下載按鈕
- [ ] 檔案下載
- [ ] 檔案清單管理 

## 安裝
由於開發區伺服器沒有對外網路，建立全新專案時建議於本機 (PC) 安裝 composer ，創建專案後上傳 gitlab ，再從開發區 git clone，建立全新專案詳細方法請見[參考資料](#參考資料)。若沒有要另外安裝套件可直接 clone 此專案無須安裝 composer。

### Windows 開發環境建置
由於上述原因，建議在 PC 安裝 composer  

**目前 PC 環境**
* Windows 10
* XAMPP 7.3.26 (PHP 7.3.26)
* Composer 2.0.9
* laravel 7

#### 安裝 XAMPP
推薦使用 XAMPP (含 Apache、PHP、MySQL) 至官網下載 7.3 最新版，  
建議安裝於 C: 避免需要系統管理員權限才能開啟 Apache。  
也可使用 WAMP

##### 設定 PDO
開啟 XAMPP 點擊 Apache config 按鈕，選取 PHP (php.ini) 開啟 php 設定，
找到 PDO 關鍵字並取消註解需要的資料庫連線方式。若有其他擴充需要開啟也可於此一並設定。  
php.ini：  

```ini
extension=pdo_mysql  
;extension=pdo_oci  
;extension=pdo_odbc  
;extension=pdo_pgsql  
extension=pdo_sqlite
```
 
#### 安裝 Composer
**安裝前請先安裝 PHP**  
...

#### Clone 專案
推薦使用 VS Code  
...

### CentOS 環境建置
以下為編寫說明時的開發環境，請注意版本相容性問題。  

**目前開發區環境**
* CentOS 8
* PHP 7.2.24 (CentOS8 yum 上最新版本)
* laravel 7 (PHP 7.2 可支援最高版本)

**建議安裝位置**
* /home/vhost/irb
    * /fileupload：laravel 專案
    * /config：專案設定檔 (如：.env、.env.backup)

#### 安裝 Apache
```console
# yum install httpd
```

#### 安裝 PHP
待補

#### 安裝 MariaDB
(可能請 DBA 處理?)  
管理 client 及登入紀錄  

#### 安裝 phpMyAdmin
(可能請 DBA 處理?)  
方便管理及查看 log  

#### Clone 專案至資料夾
1. 建立資料夾
```console
# mkdir /home/vhost/irb
```
2. 從資服處 gitlab clone 專案
```console
# cd /home/vhost/irb
# git clone https://glab01.ascc.sinica.edu.tw/ryan4559/irb-fileupload.git
```
*若因防火牆阻擋而 timeout 可暫時關閉防火牆或聯絡系統科*  
*關閉防火牆：*
```console
# systemctl stop nftables
```
*重新開啟防火牆：*
```console
# systemctl start nftables
```

3. 重新命名資料夾為 `fileupload`
```console
# mv irb-fileupload fileupload 
```
#### 更改資料夾權限
更改擁有者為 apache
> storage 和 bootstrap/cache 目錄中的目錄必須讓你的伺服器有寫入權限，否則 Laravel 就無法執行
 ```console
 # cd /home/vhost/irb
 # chown -R apache:apache fileupload
 ```

## 設定

### 設定 .env
在 git 資料夾上層建立設定檔目錄  

```console
# mkdir /home/vhost/irb/config
```

將 `.env.example` 移動至 `config` 下，並改名 `.env`

```console
# mv .env.example ../config/.env
```

~~修改讀取 env 程式碼，將 `bootstrap/app.php` 新增以下程式碼~~  
檢查 `bootstrap/app.php` 讀取 env 程式碼是否設定正確

```php
$app->useEnvironmentPath(dirname(__DIR__) . '/../config/');
```

根據需要修改 [.env](/.env.example) 各項參數  
* **APP_KEY**：  
若 APP_KEY 為空值，可執行以下指令產出  
```console
# php artisan key:generate
```
**另外請注意 APP_KEY 值會影響雜湊與加密，因此相同資料庫的專案 APP_KEY 需設定為一樣**

* **JWT_SECRET**：  
若 JWT_SECRET 為空值，可執行以下指令產出，  
若憑證為空值，則被視為不合法身分  
```console
# php artisan jwt:secret
```
### 設定 Apache vhosts
範例將資料夾至於 `home/vhost/irb`，於 `/etc/httpd/conf.d/` 新增 `httpd-vhost.conf` 檔案，內容如下：
```apache
<VirtualHost *:80>
    DocumentRoot /home/vhosts/irb/fileupload/public
    ServerName localhost:8000

    <Directory /home/vhosts/irb/fileupload>
        DirectoryIndex index.php
        AllowOverride All
        Require all granted
        Order allow,deny
        Allow from all
    </Directory>

</VirtualHost>
```
重啟 Apache 服務
```console
# systemctl restart httpd
```

## 其他設定 
**預設已在 git 專案中設定好，不須額外設定**
### 時區設定
修改專案目錄下 `config/app.php` 之設定  
將 `UTC` 改為 `Asia/Taipei` ，將時區改為台北
```php
    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Taipei',
```

### Provider 設定
增加 JWT Provider，`config/app.php` 增加  
> Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
```php
    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        ...

        /*
         * Package Service Providers...
         */
        Tymon\JWTAuth\Providers\LaravelServiceProvider::class,

        ...
```

## 使用
### 啟動伺服器
cd 至 `home/vhost/irb/fileupload`  
```console
# php artisan serve
```

### API
| API | Method | 功能 | Header | Body (form-data) | 回傳 | 備註 |
|---|---|---|---|---|---|---|
| /api/auth/login | POST | 取得 JWT | No Auth | <ul><li>username (ex: testSSO)</li><li>clientid</li><li>client_secret</li></ul>| JSON | 可能有 GET 方式但未測試 |
| /api/auth/logout | POST | 撤銷 JWT | Authorization: Bearer Token<br/> Accept: application/json | <ul></ul>| JSON | 未使用 |
| /api/auth/logout | POST | 撤銷 JWT (無法自訂 Header 時使用) | N/A | <ul><li>token</li></ul>| JSON | 未使用，可能有 GET 方式但未測試 |
| **/auth/fileupload** <br/>注意沒有/api | POST | 開啟檔案上傳頁面 | Authorization: Bearer Token<br/> Accept: application/json | <ul></ul>| HTML(view) |  |
| **/auth/fileupload** <br/>注意沒有/api | POST | 開啟檔案上傳頁面 (無法自訂 Header 時使用) | N/A | <ul><li>token</li></ul>| HTML(view) | Agentflow 目前用這種 |
| **/auth/fileupload** <br/>注意沒有/api | GET | 開啟檔案上傳頁面 (無法 POST 時使用，如：直接在瀏覽器網址開啟) | N/A | 網址接 /?token=[JWT_TOKEN] | HTML(view) | 不建議將 token 放在網址讓使用者看到 |
| /api/auth/refresh | POST | 未使用 | Authorization: Bearer Token (JWT)<br/> Accept: application/json |  | JSON | 未使用 |

#### 呼叫 API 範例
使用 Postman 呼叫 API

* Method : POST
* URL : http://10.109.233.21/api/auth/login (IRB檔案功能開發機)
* Authorization : No Auth
* Body : 選擇 form-data
    * username : testsso
    * clientid : test
    * client_secret : 123456
---
* 回傳
    * status : 200 OK
    * Body : 
```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMC4xMDkuMjMzLjIxXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNjE1OTQ5MTM0LCJleHAiOjE2MTU5NTA5MzQsIm5iZiI6MTYxNTk0OTEzNCwianRpIjoiSmpNbnRhamRVdFo0MjhCOSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsImNsaWVudGlkIjoidGVzdCJ9.bVcAMYmH8TMEPKc1iHdp-tbQwRy8B5EwYMFDXRTxWaM",
    "token_type": "bearer",
    "expires_in": 1800,
    "username": "testsso",
    "dbret": true
} 
```
### BPM API
說明文件：[BPMAPI.md](/BPMAPI.md)

## 參考資料
* [JSON Web Tokens - jwt.io](https://jwt.io/)
* [Home - jwt-auth (laravel JWT 套件)](https://jwt-auth.readthedocs.io/en/develop/)
* [Win 環境建置for網頁組 - HackMD](https://hackmd.io/@Fc8E38JgQMSVXEdA0xXtxA/SJo2l1ECP)
* [Laravel專案初始化 - HackMD](https://hackmd.io/@Fc8E38JgQMSVXEdA0xXtxA/ByfIXTyWP#%E9%96%8B%E7%99%BC%E5%8D%80%E5%BB%BA%E7%AB%8B%E5%B0%88%E6%A1%88) 
* [Laravel 與 JWT 搭配運用 - HackMD](https://hackmd.io/@8irD0FCGSQqckvMnLpAmzw/SkqRnxqIM?type=view)
* [在Laravel 6 REST API中應用JSON Web Token (JWT) | by Yu-Cheng Hong | Medium](https://rommelhong.medium.com/%E5%9C%A8laravel-6-rest-api%E4%B8%AD%E6%87%89%E7%94%A8json-web-token-jwt-e067e7fc7b1f)


## 備註
* 開發區目前關閉 nftables `systemctl disable nftables`  
* 取消 CSRF Token 驗證 [VerifyCsrfToken.php](/app/Http/Middleware/VerifyCsrfToken.php) 
    * 參考資料：[TokenMismatchException when post to a laravel application externally](https://stackoverflow.com/questions/46504220/tokenmismatchexception-when-post-to-a-laravel-application-externally)
```php
protected $except = [
        // disable all token
        '/*',
    ];
```
