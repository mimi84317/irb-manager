<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>

        <title>案件之相關文件與備註</title>
        <style>
            .titleText {
                color: #000093;
                text-align: left;
                font-weight: bold;
                font-size: 30px;
            }
        </style>
    </head>
    <body>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <div class="container">
            <div class="col-form-label">
                <p class="titleText">案件之相關文件與備註</p>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">案件資料</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>計畫名稱</th>
                                    <td id="proj_name">{{ app('request')->input('proj_name') }}</td>
                                </tr>
                                <tr>
                                    <th>計畫主持人</th>
                                    <td id="txtAppName">{{ app('request')->input('txtAppName') }}</td>
                                </tr>
                                <tr>
                                    <th>計劃流水編號</th>
                                    <td id="txtAppNo">{{ app('request')->input('txtAppNo') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">須迴避機構</div>
                    <div class="card-body">
                        <div>
                            @if (count($remark) > 0)
                                <textarea class="form-control case-desc-value" rows="15" id="avoid">{{ $remark[0]['avoid'] }}</textarea>
                            @elseif (count($remark) == 0)
                                <textarea class="form-control case-desc-value" rows="15" id="avoid"></textarea>
                            @endif
                        </div>
                        <br>
                        <div>
                            <button type="button" class="btn btn-outline-primary btn-save" value="btn-avoid">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">檔案上傳</div>
                    <div class="card-body">
                        <div>
                            <p>選擇需要上傳的檔案 (每個上傳檔案大小請限制在 20 MB以內)</p>
                        </div>
                        <div class="border">
                            <form method="POST" enctype="multipart/form-data" id="ajax-data-update" action="javascript:void(0)">
                                <input name="txtAppNo" type="hidden" value="{{ app('request')->input('txtAppNo') }}">
                                <div>
                                    <table class="table table-hover remarkFileTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="d-none">id</th>
                                                <th scope="col">檔名</th>
                                                <th scope="col">上傳檔案說明(版本資訊)</th>
                                                <th scope="col"></th>
                                                <th scope="col">已上傳檔案</th>
                                                <th scope="col" class="col-1">刪除</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($remarkFilelist as $remarkFile)
                                                <tr>
                                                    <td class="row-id" style="display:none">{{ $remarkFile['Id'] }}</td>
                                                    <td class="row-name"><input type="text" class="form-control name-value" value="{{ $remarkFile['field_name'] }}"></td>
                                                    <td class="row-desc"><textarea class="form-control desc-value" rows="3">{{ $remarkFile['description'] }}</textarea></td>
                                                    <td class="row-uploadFile">
                                                        <input class="form-control uploadFile" type="file" name="files[]">
                                                    </td>
                                                    <td class="row-downloadFile">
                                                        <div class="file-name">{{ $remarkFile['file_name'] }}</div>
                                                        @if ($remarkFile['file_name'] != "")
                                                            <div><button type="button" class="btn btn-outline-primary btn-download"><i class="fas fa-download">下載</i></button></div>
                                                        @endif
                                                    </td>
                                                    <td><button type="button" class="btn btn-outline-secondary btn-delete"><i class="fas fa-trash-alt"></i></button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-outline-success btn-addlist">新增其他檔案</button>
                                </div>
                                <br>
                                <div>
                                    <button type="sumbit" class="btn btn-outline-primary btn-upload">更新上傳檔案</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">提醒主審之說明事項與備註</div>
                    <div class="card-body">
                        <div>
                            @if (count($remark) > 0)
                                <textarea class="form-control case-desc-value" rows="15" id="refreeRemark">{{ $remark[0]['refreeRemark'] }}</textarea>
                            @elseif (count($remark) == 0)
                                <textarea class="form-control case-desc-value" rows="15" id="refreeRemark"></textarea>
                            @endif
                        </div>
                        <br>
                        <div>
                            <button type="button" class="btn btn-outline-primary btn-save" value="btn-refreeRemark">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">行政人員備註</div>
                    <div class="card-body">
                        <div>
                            @if (count($remark) > 0)
                                <textarea class="form-control case-desc-value" rows="15" id="staffRemark">{{ $remark[0]['staffRemark'] }}</textarea>
                            @elseif (count($remark) == 0)
                                <textarea class="form-control case-desc-value" rows="15" id="staffRemark"></textarea>
                            @endif
                        </div>
                        <br>
                        <div>
                            <button type="button" class="btn btn-outline-primary btn-save" value="btn-staffRemark">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div>
                <button type="button" class="btn btn-outline-primary btn-back">返回上一頁</button>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var username = "{{ app('request')->input('username') }}";
        var clientid = "{{ app('request')->input('clientid') }}";
        var client_secret = "{{ app('request')->input('client_secret') }}";
        var user = "{{ app('request')->input('user') }}";

        var deleteID = [];

        function openPostWindow(url, name, token, username, clientid, client_secret, user, condition)
        {
            var tempForm = document.createElement("form");
            tempForm.id = "tempForm1";
            tempForm.method = "post";
            tempForm.action = url;
            tempForm.target = name;

            var hideInput1 = document.createElement("input");
            hideInput1.type = "hidden";
            hideInput1.name = "token";
            hideInput1.value = token;

            var hideInput2 = document.createElement("input");
            hideInput2.type = "hidden";
            hideInput2.name = "username";
            hideInput2.value = username;

            var hideInput3 = document.createElement("input");
            hideInput3.type = "hidden";
            hideInput3.name = "clientid";
            hideInput3.value = clientid;

            var hideInput4 = document.createElement("input");
            hideInput4.type = "hidden";
            hideInput4.name = "client_secret";
            hideInput4.value = client_secret;

            var hideInput5 = document.createElement("input");
            hideInput5.type = "hidden";
            hideInput5.name = "user";
            hideInput5.value = user;

            var hideInput6 = document.createElement("input");
            hideInput6.type = "hidden";
            hideInput6.name = "condition";
            hideInput6.value = condition;

            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            tempForm.appendChild(hideInput4);
            tempForm.appendChild(hideInput5);
            tempForm.appendChild(hideInput6);

            if(document.all){
                tempForm.attachEvent("onsubmit",function(){});        //IE
            }else{
                var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
            }
            document.body.appendChild(tempForm);
            if(document.all){
                tempForm.fireEvent("onsubmit");
            }else{
                tempForm.dispatchEvent(new Event("submit"));
            }
            //console.log(tempForm);
            tempForm.submit();

            document.body.removeChild(tempForm);
        }

        //儲存 須迴避機構+提醒主審之說明事項與備註+行政人員備註
        $('.btn-save').on('click',function(e){
            var field = $(this).val();

            var proj_name = $('#proj_name').text();
            var txtAppName = $('#txtAppName').text();
            var txtAppNo = $('#txtAppNo').text();
            var table = "irbProjectRemark";

            var avoid = $('#avoid').val();
            //var uploadFile = $('#uploadFile').text();
            var refreeRemark = $('#refreeRemark').val();
            var staffRemark = $('#staffRemark').val();

            if(field == "btn-avoid"){ //須迴避機構
                projectRemarkUpdate = { 'proj_name' : proj_name,
                                        'txtAppName' : txtAppName,
                                        'txtAppNo' : txtAppNo,
                                        'avoid' : avoid};
            }
            else if(field == "btn-refreeRemark"){ //提醒主審之說明事項與備註
                projectRemarkUpdate = { 'proj_name' : proj_name,
                                        'txtAppName' : txtAppName,
                                        'txtAppNo' : txtAppNo,
                                        'refreeRemark' : refreeRemark};
            }
            else if(field == "btn-staffRemark"){ //行政人員備註
                projectRemarkUpdate = { 'proj_name' : proj_name,
                                        'txtAppName' : txtAppName,
                                        'txtAppNo' : txtAppNo,
                                        'staffRemark' : staffRemark};
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            token = "{{ app('request')->input('token') }}";

            @if (count($remark) > 0)
                var type = "update";
                var condition = "where txtAppName='{{ $remark[0]['txtAppName'] }}'";
            @elseif (count($remark) == 0)
                var type = "insert";
                var condition = "";
            @endif

            $.ajax({
                method:'post',
                url:"{{ route('projectRemark.update') }}",
                data: {update:projectRemarkUpdate, type:type, table:table, condition:condition, token:token},
                success:function(data){
                    console.log(data);
                    if(data != 0){
                        alert("更新失敗，請洽系統管理員");
                    }
                    else{
                        alert("更新成功");
                        setTimeout(function () { document.location.reload(true); }, 5);
                    }
                }
            });

        });

        //檔案上傳-新增清單
        $('.btn-addlist').on('click', function(){
            var newrow = '';
            newrow += '<tr>';
            newrow += '<td class="row-id" style="display:none"></td>';
            newrow += '<td class="row-name"><input type="text" class="form-control name-value" value=""></td>';
            newrow += '<td class="row-desc"><textarea class="form-control desc-value" rows="3"></textarea></td>';
            newrow += '<td class="row-uploadFile"><input class="form-control uploadFile" type="file" name="files[]"></td>';
            newrow += '<td class="row-downloadFile"></td>';
            newrow += '<td><button type="button" class="btn btn-outline-secondary btn-delete"><i class="fas fa-trash-alt"></i></button></td>';
            newrow += '</td>';
            newrow += "</tr>";
            $('.remarkFileTable').append(newrow);
        });

        //檔案上傳-刪除
        $('.remarkFileTable').on('click', '.btn-delete', function(){
            var row = $(this).parents('tr:first');
            var id = row.children('.row-id').text();
            console.log(id);
            if(id != ""){
                deleteID.push(id);
            }
            console.log(deleteID);
            row.remove();
        });

        //檔案上傳-更新上傳檔案
        $('#ajax-data-update').submit(function(e) {
            event.preventDefault();
            var remarkFileTableLength = $('.remarkFileTable tr').length;
            var txtAppNo = "{{ app('request')->input('txtAppNo') }}";
            var table = "irbProjectRemarkFile";
            var remarkFileUpdate = {};

            var fileName = $("input[name='files[]']").map(function(){return $(this).val();}).get();
            var fileCount = 0;
            for(var i = 0; i < fileName.length; i++){
                if(fileName[i] != ""){
                    var cut = fileName[i].split("\\");//windows
                    if(cut.length == 1)
                        cut = fileName[i].split("/");//linux
                    fileName[i] = cut[cut.length-1];
                    fileCount++;
                }
            }
            var formData = new FormData(this);

            var token = "{{ app('request')->input('token') }}";

            //var path = "{{ env('CHECK_DIR_ROOT') }}" + "\\test\\projectRemark\\" + txtAppNo;
            var path = "{{ env('CHECK_DIR_ROOT') }}" + "/test/projectRemark/" + txtAppNo;
            var url = "{{ route('projectRemark.upload.post') }}";
            //console.log(path);

            for(var i = 1; i < remarkFileTableLength; i++){
                remarkFileUpdate[i-1] = {};
                var name = $('.remarkFileTable tr:eq('+i+')').children('.row-name').children('.name-value').val();
                if(name == ""){
                    alert("文件名稱不可空白!!!");
                    return 0;
                }
                else{
                    remarkFileUpdate[i-1]['Id'] = $('.remarkFileTable tr:eq('+i+')').children('.row-id').text();
                    remarkFileUpdate[i-1]['txtAppNo'] = txtAppNo;
                    remarkFileUpdate[i-1]['field_name'] = $('.remarkFileTable tr:eq('+i+')').children('.row-name').children('.name-value').val();
                    remarkFileUpdate[i-1]['description'] = $('.remarkFileTable tr:eq('+i+')').children('.row-desc').children('.desc-value').val();
                    remarkFileUpdate[i-1]['file_name'] = fileName[i-1];
                    remarkFileUpdate[i-1]['path'] = path;
                    remarkFileUpdate[i-1]['update_time'] = "";

                    if(remarkFileUpdate[i-1]['Id'] == "" && remarkFileUpdate[i-1]['file_name'] == ""){
                        alert('請上傳檔案');
                        return false;
                    }
                }
            }

            //formData.append('txtAppNo', txtAppNo);
            //console.log(formData);

            if(fileCount > 0){
                $.ajax({
                    type:'POST',
                    url: url,
                    headers: {Authorization: 'Bearer '+ token},
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data);
                    },
                    error: (data) => {
                        console.log(data);
                        if(typeof(data['responseJSON']) != "undefined" && data['responseJSON']['message'] == 'Invalid argument supplied for foreach()'){
                            alert('沒有選擇檔案');
                        }
                        else if(data['status'] == 401){
                            alert('請重新登入');
                        }
                        else{
                            alert('ERROR: '+ data['statusText']);
                        }

                    }
                });
            }

            //return false;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method:'post',
                url:"{{ route('projectRemark.update') }}",
                data: {update:remarkFileUpdate, deleteID:deleteID, table:table, token:token},
                success:function(data){
                    console.log(data);
                    if(data != 0){
                        alert("更新失敗，請洽系統管理員");
                    }
                    else{
                        alert("更新成功");
                        setTimeout(function () { document.location.reload(true); }, 5);
                    }
                },
                error:function(data){
                    console.log(data);
                }
            });
        });

        //檔案上傳-下載檔案
        $('.remarkFileTable').on('click', '.btn-download', function() {
            var row = $(this).parents('tr:first');
            var file = row.children('td.row-downloadFile').children('.file-name').text();

            condition = "";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/projectRemark/" + username;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    var url = "{{route('file.download',['case'=>'projectRemark','passID'=>app('request')->input('txtAppNo'),'fileid'=>''])}}"+"/"+file+"?token="+data["access_token"];
                    window.open(url, "_blank");
                }
            });

        });

         //返回上一頁
         $('.btn-back').on('click',function(e){
            var previousPage = "{{ app('request')->input('previousPage') }}";
            var txtAppNo = "{{ app('request')->input('txtAppNo') }}";
            var condition = "where txtAppNo='" + txtAppNo+"'";
            var loginURL = "";
            var route = "";
            console.log(condition);

            if(previousPage == "manageFlowContent"){//審核案件內容
                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlowContent/" + username;
                route = "{{ route('manageFlowContent.post') }}";
            }
            else if(previousPage == "projectContent"){//計畫內容
                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/projectContent/" + username;
                route = "{{ route('projectContent.post') }}";
            }

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow(route, "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });
        });


    </script>
</html>
