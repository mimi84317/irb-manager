<!doctype html>
<html>
  <head>
    <title>新案審查上傳檔案清單 - {{ config('app.name')}}</title>
    <!-- Styles -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .container {
            padding: 4rem 5rem;
            background-color: #fff;
            border-radius: 1rem;
            width: 100%;
            max-width: 45rem;
        }
        h1 {
            color: #fff;
            font-size: 2.8rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
            background: -webkit-linear-gradient(#fff, #999);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }
        h4 {
            color: lighten(#5c3d86,30%);
            font-size: 1.5rem;
            font-weight: 400;
            text-align: center;
            margin: 0 0 3.5rem 0;
        }
        .btn.btn-primary {
            background-color: $purple;
            border-color: $purple;
            outline: none;
            &:hover {
                background-color: darken($purple, 10%);
                border-color: darken($purple, 10%);
            }
            &:active, &:focus {
                background-color: lighten($purple, 5%);
                border-color: lighten($purple, 5%);
            }
        }
        .file-table {
            max-width: 90%;
            word-break: keep-all
        }
        .file-input {
            min-width: 400px;
        }
        .td-describe {
            word-break: break-all
        }

    </style>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  </head>
  <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @auth
                上傳者：{{$username}} |
                clientid：{{$clientid}}
                @endauth
            </div>
            <div class="top-left">
                新案審查上傳檔案清單
            </div>
            {{-- <div class="container">
                <div class="form-group" x-data="{ fileName: '' }">

                  <div class="input-group shadow">
                    <div class="input-group">
                    <span class="input-group-text">新案計畫書</span>
                    <span class="input-group-text px-3 text-muted"><i class="fas fa-file-pdf fa-lg"></i></span>
                    <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="img[]" class="d-none">
                    <input type="text" class="form-control form-control-lg" placeholder="檔案說明" x-model="fileName">
                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()"><i class="fas fa-file"></i> 選擇檔案</button>
                    </div>
                    </div>
                </div>
            </div>

            <script src='https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js'></script> --}}
            <div class="table-responsive file-table">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <input name="fileAndDescriptionCount" type="hidden" value="2"> --}}
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th scope="col"> 中文檔名</th>
                                <th scope="col"> 檔案說明</th>
                                <th scope="col" class="file-input"> 上傳 PDF 檔 </th>
                                <th scope="col"> 刪除</th>
                                <th scope="col"> 下載範本</th>
                                <th scope="col"> 範本說明 </th>

                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($users as $user) --}}
                            @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <td> 新案計畫書 </td>
                                <td class="td-describe"> 說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明 </td>
                                <td>
                                    <div class="form-group" x-data="{ fileName: '' }">
                                        <div class="input-group">
                                            <span class="input-group-text px-3 text-muted"><i class="fas fa-file-pdf fa-lg"></i></span>
                                            <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="file[]" class="d-none">
                                            <input type="text" name="description[]" class="form-control form-control-lg" placeholder="檔案名稱" x-model="fileName">
                                            <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()"><i class="fas fa-file"></i> 選擇檔案</button>
                                        </div>
                                    </div>
                                </td>
                                <td> <div class="btn btn-outline-danger"><i class="fas fa-trash fa-2x"></i></div> </td>
                                <td> <div class="btn btn-outline-primary"><i class="far fa-file-alt fa-2x"></i></div></td>
                                <td class="td-describe"> 說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明說明 </td>
                            </tr>
                            <tr class="table-warning">
                                <td> 必填 </td>
                                <td> 2 </td>
                                <td> 3 </td>
                                <td> 4 </td>
                                <td> 5 </td>
                                <td> 6 </td>
                            </tr>
                            @endfor
                            {{-- @endforeach --}}
                    </tbody>
                    </table>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">上傳檔案(還沒好，不要按)</button>
                    </div>

            </form>
            <div class="col-md-6">
                <a class="btn btn-warning">合併檔案</a>
            </div>
            </div>
        </div>
        <script src='https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js'></script>
  </body>
</html>
