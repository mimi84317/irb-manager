<!doctype html>
<html>
  <head>
    <title>{{$caseType}}審查上傳檔案清單 - {{ config('app.name')}}</title>
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
            z-index: 20;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
            z-index: 20;
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
            position: absolute;
            max-width: 90%;
            max-height: 90%;
            top: 60px;
            word-break: keep-all;
        }
        .file-table thead th {
            background: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .file-input {
            min-width: 400px;
        }
        .td-describe {
            word-break: break-all
        }
        .upload-list-table {
            max-height: 55vh;
            overflow:auto
        }
        .file-list-table {
            max-height: 20vh;
            overflow:auto
        }
        .button {
            margin: 10px;
        }

        .loading {
            z-index: 20;
            position: absolute;
            top: 0;
            left:-5px;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .loading-content {
            position: absolute;
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            top: 50%;
            left:50%;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="\js\countdown.js"></script>
    <script id="setJWT">sessionStorage.setItem('token', '{{$token}}');</script>
    <section id="loading">
        <div id="loading-content" onclick="hideLoading()"></div>
      </section>
        <div class="flex-center position-ref full-height">
            <div class="top-left h4">
                {{$caseType}}審查上傳檔案清單
            </div>
            <div class="top-right links">
                上傳者 : {{$username}} ({{$user}}) |
                主持人 : {{$owner}} |
                clientid : {{$clientid}} |
                {{-- response : {{$httpcode}} | --}}
                {{-- case : {{$caseType}} ({{$case}}) | --}}
                {{-- ansid : {{$ansid}} | --}}
                {{-- size : {{$size}} --}}
                {{-- token : {{$token}} --}}
                登出計時 : <span data-countdown="{{date('Y-m-d H:i:s', $expireTime)}}"></span>
                <form style="display:inline;" id="jwt-refresh" action="{{ route('fileupload')}}" method="POST" target="_self" enctype="multipart/form-data">
                    <button type="button" class="btn btn-link btn-refresh-jwt">延長時間</button>
                </form>
                <div class="btn btn-link btn-logout">關閉網頁</div>
            </div>

            <div class="table-responsive file-table ">
                {{-- @if ($message = Session::get('success'))
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
                @endif --}}



                <form method="POST" enctype="multipart/form-data" id="ajax-file-upload" action="javascript:void(0)">
                    @csrf
                    {{-- <input name="fileAndDescriptionCount" type="hidden" value="2"> --}}
                    {{-- <input name="token" type="hidden" value="{{$token}}"> --}}
                    <input name="memid" type="hidden" value="{{$user}}">
                    {{-- <input name="ansid" type="hidden" value="{{$ansid}}"> --}}
                    {{-- <input name="owner" type="hidden" value="{{$owner}}"> --}}
                    <div class="upload-list-table">
                        <table class="table table-hover" id="filelist-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="form-control-lg"> 中文檔名 (黃底為必填)</th>
                                    <th scope="col" class="form-control-lg"> 檔案說明 (版本資訊)</th>
                                    <th scope="col" class="file-input form-control-lg"> 上傳 PDF 檔 </th>
                                    <th scope="col" class="form-control-lg"> 刪除</th>
                                    <th scope="col" class="form-control-lg"> 下載範本</th>
                                    <th scope="col" class="form-control-lg"> 範本說明 </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($filelist as $file)
                                {{-- @for ($i = 0; $i < 2; $i++) --}}
                                <tr @if ($file['required']=='Y') class="table-warning" @endif>
                                @if ($file['file_id']==NULL)
                                {{-- NO file uploaded --}}
                                    <td><div class="form-control-lg"> {{ $file['chname'] }}<input name="fieldName[]" type="hidden" value="{{ $file['chname'] }}"></div></td>
                                    <td class="td-describe"> <input type="text" maxlength="400" name="description[]" class="form-control form-control-lg" placeholder="說明" x-model="fileName" value="{{$file['description']}}"> </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group px-3" for="customFile" x-data="{ files: null }">
                                                {{-- <span class="input-group-text px-3 text-muted"><i class="fas fa-file-pdf fa-lg"></i></span> --}}
                                                <input type="file" x-ref="file" x-on:change="files = Object.values($event.target.files)" name="file[]" class="d-none">
                                                <input type="text" class="form-control form-control-lg" x-bind:value="files ? files.map(file => file.name).join(', ') : ''" placeholder="檔案名稱" readonly>
                                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()"><i class="fas fa-file-pdf fa-fw"></i> 選擇檔案</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td> {{--<div class="btn btn-outline-danger"><i class="fas fa-trash fa-2x"></i></div>--}} </td>
                                @else
                                {{-- has file uploaded --}}
                                    <td><div class="form-control-lg"> {{ $file['chname'] }}</div></td>
                                    <td class="td-describe"> <input type="text" class="form-control form-control-lg" placeholder="" value="{{$file['description']}}" readonly></td>
                                    <td>
                                        <div class="form-group" x-data="{ fileName: '' }" title="{{$file['file_name']}}">
                                            <div class="input-group px-3">
                                                <input type="text" class="form-control form-control-lg" value="{{$file['file_name']}}" readonly>
                                                <button type="button" class="browse btn btn-outline-primary px-4 btn-download"  fileID={{basename($file['file_id'])}} {{--onClick="window.open('{{route('file.download',['fileid'=>$file['file_name'], 'token'=>$token])}}')"--}}><i class="fas fa-download fa-fw"></i> 下載檔案</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td> <button type="button" class="btn btn-outline-danger" filename={{basename($file['file_id'])}}><i class="fas fa-trash fa-2x fa-fw"></i></button> </td>
                                @endif
                                @if ($file['example_path']!=NULL)
                                    <td>
                                        {{-- <div class="input-group"> --}}
                                            <button type="button" class="btn btn-outline-primary btn-download-example" title="{{$file['example_name']}}" fileID={{basename($file['example_path'])}} {{--onClick="window.open('{{route('example.download',['case'=>$case,'fileid'=>$file['example_name'], 'token'=>$token])}}')"--}}><i class="far fa-file-alt fa-2x fa-fw"></i></button>
                                        {{-- </div> --}}
                                    </td>
                                @else
                                    <td>
                                        {{-- <div class="input-group"> --}}
                                            <div class="btn btn-outline-secondary disabled" aria-disabled="true"><i class="far fa-file-alt fa-2x fa-fw"></i></div>
                                        {{-- </div> --}}
                                    </td>
                                @endif

                                <td class="td-describe"> {{$file['example_desc']}} </td>
                                </tr>
                                {{-- @endfor --}}
                                @endforeach

                                {{-- add more file --}}
                                @foreach($addMoreFile as $file)
                                <tr>
                                    <td><div class="form-control-lg"> {{ $file['field_name'] }}</div></td>
                                    <td class="td-describe"> <input type="text" class="form-control form-control-lg" placeholder="" value="{{$file['description']}}" readonly></td>
                                    <td>
                                        <div class="form-group" x-data="{ fileName: '' }" title="{{$file['file_name']}}">
                                            <div class="input-group px-3">
                                                <input type="text" class="form-control form-control-lg" value="{{$file['file_name']}}" readonly>
                                                <button type="button" class="browse btn btn-outline-primary px-4 btn-download"  fileID={{basename($file['file_id'])}} {{--onClick="window.open('{{route('file.download',['fileid'=>$file['file_name'], 'token'=>$token])}}')"--}}><i class="fas fa-download fa-fw"></i> 下載檔案</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td> <button type="button" class="btn btn-outline-danger" filename={{basename($file['file_id'])}}><i class="fas fa-trash fa-2x fa-fw"></i></button> </td>
                                    <td>
                                        <div class="btn btn-outline-secondary disabled" aria-disabled="true"><i class="far fa-file-alt fa-2x fa-fw"></i></div>
                                    </td>
                                    <td class="td-describe"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="btn btn-link btn-addmore">
                            上傳其他檔案
                            <i class="far fa-plus-square fa-fw"></i>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="btn btn-primary">上傳檔案</button>
                        (上傳檔案總大小請限制在 40 MB以內)
                        <button type="button" class="btn btn-warning btn-pdfmerge" title="將會合併此頁面所有檔案 (含其他檔案及已經合併的檔案)">合併檔案</button>
                    </div>
                </form>
                <div>

                </div>
                <div class="file-list-table">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th scope="col" class="form-control-lg"> 合併檔案與其他檔案</th>
                                <th scope="col" class="form-control-lg"> 預覽</th>
                                <th scope="col" class="form-control-lg"> 下載</th>
                                <th scope="col" class="form-control-lg"> 刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diffFilelist as $diffFile)
                            {{-- @for ($i = 0; $i < 2; $i++) --}}
                            <tr>
                            <td>
                                <div class="form-control-lg">
                                    {{ basename($diffFile) }}
                                    @if (basename($diffFile)==$owner.'_'.$ansid.'.pdf' )
                                        -&nbsp;{{$size}}
                                    @endif
                                </div>
                            </td>
                            <td>
                                <form id="file-preview" action="{{ route('file.preview.page',['filename'=>basename($diffFile)]) }}" method="POST" target="_blank" enctype="multipart/form-data">
                                    <button type="submit" class="btn btn-outline-warning btn-preview" title="{{basename($diffFile)}}" fileID={{ basename($diffFile) }} ><i class="fas fa-file-pdf fa-2x fa-fw"></i></button>
                                </form>
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-download" title="{{basename($diffFile)}}" fileID={{ basename($diffFile) }} ><i class="fas fa-download fa-2x fa-fw"></i></button></td>
                            <td> <button type="button" class="btn btn-outline-danger" filename={{ basename($diffFile) }}><i class="fas fa-trash fa-2x fa-fw"></i></button> </td>
                            </tr>
                            {{-- @endfor --}}
                            @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src='https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js'></script>
  </body>
<script type="text/javascript">
    //https://laracasts.com/discuss/channels/laravel/loading-spinner-in-blade
    function showLoading() {
    document.querySelector('#loading').classList.add('loading');
    document.querySelector('#loading-content').classList.add('loading-content');
    }

    function hideLoading() {
    document.querySelector('#loading').classList.remove('loading');
    document.querySelector('#loading-content').classList.remove('loading-content');
    }
    $(document).ready(function (e) {
        setTimeout(function () { $("#setJWT").remove(); }, 500); //延遲刪除jwt

        $('[data-countdown]').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('{{--%D days --}}%H:%M:%S'));
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer '+ sessionStorage.getItem('token')
            }
        });
        $('#ajax-file-upload').submit(function(e) {
            e.preventDefault();
            showLoading();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{ route('file.upload.post')}}",
                headers: {Authorization: 'Bearer '+ sessionStorage.getItem('token')},
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('檔案已成功上傳');
                    console.log(data);
                    setTimeout(function () { document.location.reload(true); }, 5);
                },
                error: (data) => {
                   console.log(data);
                   hideLoading();
                   if(typeof(data['responseJSON']) != "undefined" && data['responseJSON']['message'] == 'The given data was invalid.')
                   {
                        alert('上傳檔案必須為 PDF.');
                   }
                   else if(typeof(data['responseJSON']) != "undefined" && data['responseJSON']['message'] == 'Invalid argument supplied for foreach()')
                   {
                        alert('沒有選擇檔案');
                   }
                   else if(data['status'] == 401)
                   {
                        alert('請重新登入');
                   }
                   else
                   {
                        alert('ERROR: '+ data['statusText']);
                   }

                }
            });
        });

        $('.btn-outline-danger').click(function(e) {
            e.preventDefault();
            let filename = $(this).attr("filename");
            // get file basename
            {{-- const FILE_NAME_REGEX = /(.+)\/(.+)$/ ;--}}
            {{-- var filename = filename.replace(FILE_NAME_REGEX, '$2');--}}
            {{-- let token = "{{ $token }}"--}}

            var del = confirm("確定刪除 "+filename+" ?");
            if(!del)
            {
                return false;
            }

            $.ajax({
                type:'POST',
                url: "{{ route('file.delete.post')}}",
                headers: {Authorization: 'Bearer '+ sessionStorage.getItem('token')},
                dataType : 'json',
                data: { filename : filename },
                cache:false,
                success: (data) => {
                    alert(filename +' 刪除結果 資料夾: '+ data['disk']+'; DB: '+data['DB']);

                    console.log(data);
                    setTimeout(function () { document.location.reload(true); }, 5);
                },
                error: function(data){
                   console.log(data);
                   if(data['status'] == 401)
                   {
                        alert('請重新登入');
                   }
                   else
                   {
                        alert('ERROR: '+ data['responseText']);
                   }
                }
            });
        });

        $('.btn-pdfmerge').click(function(e) {
            e.preventDefault();
            showLoading();
            $.ajax({
                type:'POST',
                url: "{{ route('pdf.merge', ['clientid'=>$clientid, 'memid'=>$owner, 'ans'=>$ansid]) }}",
                cache:false,
                success: (data) => {
                    if(data!=''){
                        alert(data);
                    }

                    console.log(data);
                    setTimeout(function () { document.location.reload(true); }, 5);
                },
                error: function(data){
                   console.log(data);
                   hideLoading();
                }
            });
        });

        $('.btn-download').click(function(e) {
            e.preventDefault();
            let filename = $(this).attr("fileID");
            $.ajax({
                type:'GET',
                headers: {Authorization: 'Bearer '+ sessionStorage.getItem('token')},
                cache:false,
                success: (data) => {
                    // alert(data);
                    // console.log(data);
                    var url = "{{route('file.download',['fileid'=>''])}}"+"/"+filename+"?token="+sessionStorage.getItem('token');
                    window.open(url, "_blank");
                },
                error: function(data){
                   console.log(data);
                   if(data['status'] == 401)
                   {
                        alert('請重新登入');
                   }
                   else
                   {
                        alert('ERROR: '+ data['responseText']);
                   }
                }
            });
        });

        $('.btn-download-example').click(function(e) {
            e.preventDefault();
            let filename = $(this).attr("fileID");
            $.ajax({
                type:'GET',
                headers: {Authorization: 'Bearer '+ sessionStorage.getItem('token')},
                cache:false,
                success: (data) => {
                    // alert(data);
                    // console.log(data);
                    var url = "{{route('example.download',['case'=>$case,'fileid'=>''])}}"+"/"+filename+"?token="+sessionStorage.getItem('token');
                    window.open(url, "_blank");
                },
                error: function(data){
                   console.log(data);
                   if(data['status'] == 401)
                   {
                        alert('請重新登入');
                   }
                   else
                   {
                        alert('ERROR: '+ data['responseText']);
                   }
                }
            });
        });

        $('.btn-addmore').click(function(e) {
            let html = `<tr>
                <td><div class="form-control-lg">自行上傳<input name="fieldName[]" type="hidden" value="自行上傳"></div></td>
                    <td class="td-describe"> <input type="text" maxlength="400" name="description[]" class="form-control form-control-lg" placeholder="說明" x-model="fileName"> </td>
                    <td>
                        <div class="form-group">
                            <div class="input-group px-3" for="customFile" x-data="{ files: null }">
                                <input type="file" x-ref="file" x-on:change="files = Object.values($event.target.files)" name="file[]" class="d-none">
                                <input type="text" class="form-control form-control-lg" x-bind:value="files ? files.map(file => file.name).join(', ') : ''" placeholder="檔案名稱" readonly>
                                <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()"><i class="fas fa-file-pdf fa-fw"></i> 選擇檔案</button>
                            </div>
                        </div>
                    </td>
                    <td>  </td>
                    <td>
                        <div class="btn btn-outline-secondary disabled" aria-disabled="true"><i class="far fa-file-alt fa-2x fa-fw"></i></div>
                    </td>
                    <td class="td-describe"></td>
                    </tr>`;
            $("table#filelist-table  tr:last").after(html);
        });

        $('.btn-logout').click(function(e) {
            var msg = confirm("確定關閉上傳頁面?");
            if(!msg)
            {
                return false;
            }

            $.ajax({
                type:'POST',
                url: "{{ route('jwt.logout')}}",
                headers: {Authorization: 'Bearer '+ sessionStorage.getItem('token')},
                dataType : 'json',
                cache:false,
                success: () => {
                    sessionStorage.removeItem('token');
                    // open(location, '_self').close(); // Scripts may close only the windows that were opened by them.
                    open(location, '_self');
                },
                error: function(data){
                   console.log(data);
                   if(data['status'] == 401)
                   {
                        alert('無須再次登出');
                        open(location, '_self');
                   }
                   else
                   {
                        alert('ERROR: '+ data['responseText']);
                   }
                }
            });
        });

        $('.btn-preview').click(function(e) {
            $(this).append("<input name='token' id='jwt' type='hidden' value='"+sessionStorage.getItem('token')+"'>");
            // $("form#file-preview").submit();
            setTimeout(function () { $("#jwt").remove(); }, 500); //延遲刪除jwt
            // $("#jwt").remove();
        });

        $('.btn-refresh-jwt').click(function(e) {
            var msg = confirm("確定延長使用時間? (將會重整網頁)");
            if(!msg)
            {
                return false;
            }

            $.ajax({
                type:'POST',
                url: "{{ route('jwt.refresh')}}",
                headers: {Authorization: 'Bearer '+ sessionStorage.getItem('token')},
                dataType : 'json',
                cache:false,
                success: (data,status,xhr) => {
                    sessionStorage.setItem('token', data['access_token']);
                    $(this).append("<input name='token' id='jwt' type='hidden' value='"+sessionStorage.getItem('token')+"'>");
                    $("form#jwt-refresh").submit();
                    setTimeout(function () { $("#jwt").remove(); }, 500); //延遲刪除jwt
                },
                error: function(data){
                   console.log(data);
                   if(data['status'] == 401)
                   {
                        alert('請重新登入');
                   }
                   else
                   {
                        alert('ERROR: '+ data['responseText']);
                   }
                }
            });
        });

    });
</script>
</html>
