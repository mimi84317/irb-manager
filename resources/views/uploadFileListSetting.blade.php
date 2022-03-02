<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>

        <title>修改上傳清單</title>
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

        <script src="\js\countdown.js"></script>

        <form method="POST" enctype="multipart/form-data" id="ajax-data-update" action="javascript:void(0)">
            <div class="container">
                <p class="titleText">{{ $showCase }}修改上傳清單與設定送審須知</p>
                <div class="card col-16">
                    <div class="card-header">上傳清單</div>
                    <div class="card-body">
                        <div>
                            <table class="table table-hover filelistTable">
                                <thead>
                                    <tr>
                                        <th scope="col">順序</th>
                                        <th scope="col" class="col-2">文件名稱</th>
                                        <th scope="col" class="col-3">文件說明</th>
                                        <th scope="col">是否必要</th>
                                        <th scope="col" class="col-2">上傳範本檔</th>
                                        <th scope="col" class="col-2">己上傳範本檔</th>
                                        <th scope="col" class="col-1">刪除</th>
                                        <th scope="col" class="col-1">調整順序</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($caseList as $case)
                                        <tr>
                                            <th class="row-sort">{{ $case['sort'] }}</th>
                                            <td class="row-name"><input type="text" class="form-control name-value" value="{{ $case['chname'] }}"></td>
                                            <td class="row-desc"><textarea class="form-control desc-value" rows="3">{{ $case['example_desc'] }}</textarea></td>
                                            <td class="row-require">
                                                @if ($case['required'] == "Y")
                                                    <input class="form-check-input require-checked" type="checkbox" checked>
                                                @elseif ($case['required'] == "N")
                                                    <input class="form-check-input require-checked" type="checkbox">
                                                @endif
                                            </td>
                                            <td class="row-uploadFile">
                                                <input class="form-control uploadFile" type="file" name="files[]">
                                            </td>
                                            <td class="row-downloadFile">
                                                <div class="file-name">{{ $case['example_name'] }}</div>
                                                @if ($case['example_name'] != "")
                                                    <div><button type="button" class="btn btn-outline-primary btn-download"><i class="fas fa-download">下載</i></button></div>
                                                @endif
                                            </td>
                                            <td><button type="button" class="btn btn-outline-secondary btn-delete"><i class="fas fa-trash-alt"></i></button></td>
                                            <td class="row-move">
                                                @if (!($loop->first))
                                                    <button type="button" class="btn btn-outline-info btn-moveUp"><i class="fas fa-arrow-up"></i></button>
                                                @endif
                                                @if (!($loop->last))
                                                    <button type="button" class="btn btn-outline-info btn-moveDown"><i class="fas fa-arrow-down"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-success btn-addlist">新增清單</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card col-16">
                    <div class="card-header">送審須知</div>
                    <div class="card-body">
                        <table class="table table-hover contentTable">
                            <tbody>
                                <tr>
                                    <th scope="col" class="col-1">標題</th>
                                    <th class="case-title"><input type="text" class="form-control case-title-value" value="{{ $caseContent[0]['review_subj'] }}"></th>
                                </tr>
                                <tr>
                                    <th scope="col" class="col-1">說明</th>
                                    <th class="case-desc"><textarea class="form-control case-desc-value" rows="15">{{ $caseContent[0]['review_desc'] }}</textarea></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div>
                    <button type="sumbit" class="btn btn-outline-primary btn-update">更新</button>
                    <button type="button" class="btn btn-outline-primary btn-back">返回上一頁</button>
                </div>
            </div>
        </form>

    </body>
    <script type="text/javascript">
        var username = "{{ app('request')->input('username') }}";
        var clientid = "{{ app('request')->input('clientid') }}";
        var client_secret = "{{ app('request')->input('client_secret') }}";
        var user = "{{ app('request')->input('user') }}";

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

        //下載檔案
        $('.filelistTable').on('click', '.btn-download', function() {
            var row = $(this).parents('tr:first');
            var file = row.children('td.row-downloadFile').children('.file-name').text();

            condition = "";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/uploadFilelist/" + username;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    var url = "{{route('example.download',['case'=>$caseType,'fileid'=>''])}}"+"/"+file+"?token="+data["access_token"];
                    window.open(url, "_blank");
                }
            });

        });

        //調整順序-上
        $('.filelistTable').on('click', '.btn-moveUp', function() {
            var row = $(this).parents('tr:first');
            var order = row.children('th.row-sort').text();
            var prevorder = row.prev().children('th.row-sort').text();

            if(prevorder == "1"){
                row.prev().children('th.row-move').append('<button type="button" class="btn btn-outline-info btn-moveUp"><i class="fas fa-arrow-up"></i></button>');
                row.children('th.row-move').children('.btn-moveUp').remove();
            }

            row.children('th.row-sort').text(prevorder);
            row.prev().children('th.row-sort').text(order);
            row.insertBefore(row.prev());
        });

        //調整順序-下
        $('.filelistTable').on('click', '.btn-moveDown', function(){
            var row = $(this).parents('tr:first');
            var order = row.children('th.row-sort').text();
            var nextorder = row.next().children('th.row-sort').text();

            var lastorder = $('.filelistTable tr:last').children('th.row-sort').text();
            if(nextorder == lastorder){
                row.next().children('th.row-move').append('<button type="button" class="btn btn-outline-info btn-moveDown"><i class="fas fa-arrow-down"></i></button>');
                row.children('th.row-move').children('.btn-moveDown').remove();
            }

            row.children('th.row-sort').text(nextorder);
            row.next().children('th.row-sort').text(order);
            row.insertAfter(row.next());
        });

        //刪除
        $('.filelistTable').on('click', '.btn-delete', function(){
            var row = $(this).parents('tr:first');
            var deleteorder = row.children('th.row-sort').text();

            row.remove();
            $('.filelistTable tr:last').children('th.row-move').children('.btn-moveDown').remove();
            var filelistTableLength = $('.filelistTable tr').length - 1;
            for(var i = 0; i < filelistTableLength; i++){
                $(".row-sort:eq("+i+")").text(i+1);
            }
        });

        //新增清單
        $('.btn-addlist').on('click', function(){
            var lastorder = $('.filelistTable tr:last').children('th.row-sort').text();
            $('.filelistTable tr:last').children('th.row-move').append('<button type="button" class="btn btn-outline-info btn-moveDown"><i class="fas fa-arrow-down"></i></button>');

            var newlastorder;
            if(lastorder == ""){
                newlastorder = 1;
            }
            else{
                newlastorder = parseInt(lastorder) + 1;
            }
            var newrow = '';
            newrow += '<tr>';
            newrow += '<th class="row-sort">' + newlastorder + '</th>';
            newrow += '<td class="row-name"><input type="text" class="form-control name-value" value=""></td>';
            newrow += '<td class="row-desc"><textarea class="form-control desc-value" rows="3"></textarea></td>';
            newrow += '<td class="row-require"><input class="form-check-input require-checked" type="checkbox"></td>';
            newrow += '<td class="row-uploadFile"><input class="form-control uploadFile" type="file" name="files[]"></td>';
            newrow += '<td class="row-downloadFile"></td>';
            newrow += '<td><button type="button" class="btn btn-outline-secondary btn-delete"><i class="fas fa-trash-alt"></i></button></td>';
            newrow += '<td class="row-move">';
            newrow += '<button type="button" class="btn btn-outline-info btn-moveUp"><i class="fas fa-arrow-up"></i></button>';
            //newrow += '<button type="button" class="btn btn-outline-info btn-moveDown"><i class="fas fa-arrow-down"></i></button>';
            newrow += '</td>';
            newrow += "</tr>";
            $('.filelistTable').append(newrow);
        });

        //更新
        /*$('.btn-update').on('click',function(e){
            var filelistTableLength = $('.filelistTable tr').length;
            var contentTableLength = $('.contentTable tr').length;
            var caseType = "{{ $caseType }}";
            var filelistUpdate = {};
            var contentUpdate = {};

            for(var i = 1; i < filelistTableLength; i++){
                filelistUpdate[i-1] = {};
                var name = $('.filelistTable tr:eq('+i+')').children('.row-name').children('.name-value').val();
                if(name == ""){
                    alert("文件名稱不可空白!!!");
                    break;
                }
                else{
                    filelistUpdate[i-1]['sort'] = $('.filelistTable tr:eq('+i+')').children('.row-sort').text();
                    filelistUpdate[i-1]['chname'] = $('.filelistTable tr:eq('+i+')').children('.row-name').children('.name-value').val();
                    filelistUpdate[i-1]['example_desc'] = $('.filelistTable tr:eq('+i+')').children('.row-desc').children('.desc-value').val();

                    if($('.filelistTable tr:eq('+i+')').children('.row-require').children('.require-checked').is(":checked"))
                        filelistUpdate[i-1]['required'] = "Y";
                    else
                        filelistUpdate[i-1]['required'] = "N";

                    //filelistUpdate[i-1]['file'] = $('.filelistTable tr:eq('+i+')').children('th.row-downloadFile').text();
                }

            }

            contentUpdate = {'review_subj': $('.contentTable tr:eq(0)').children('.case-title').children('.case-title-value').val(),
                             'review_desc':$('.contentTable tr:eq(1)').children('.case-desc').children(".case-desc-value").val(),
                             'modified_date':''};

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            token = "{{ app('request')->input('token') }}";
            $.ajax({
                method:'post',
                url:"{{ route('fileuploadlist.update') }}",
                data: {caseType:caseType, filelistUpdate:filelistUpdate, contentUpdate:contentUpdate, token:token},
                success:function(data){
                    console.log(data);
                    if(data != 0){
                        alert("更新失敗，請洽系統管理員");
                    }
                    else{
                        alert("更新成功");
                        condition = "";
                        loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/uploadFilelist/" + username;
                        $.ajax({
                            method:'post',
                            url:loginURL,
                            data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                            success:function(data){
                                openPostWindow("{{ route('fileuploadlist.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                            }
                        });
                    }
                }
            });
        });*/
        $('#ajax-data-update').submit(function(e) {
            event.preventDefault();
            var filelistTableLength = $('.filelistTable tr').length;
            var contentTableLength = $('.contentTable tr').length;
            var caseType = "{{ $caseType }}";
            var filelistUpdate = {};
            var contentUpdate = {};

            var fileName = $("input[name='files[]']").map(function(){return $(this).val();}).get();
            //console.log(fileName);
            var uploadFileLength = 0;
            for(var i = 0; i < fileName.length; i++){
                if(fileName[i] != ""){
                    var cut = fileName[i].split("\\");//windows
                    if(cut.length == 1)
                        cut = fileName[i].split("/");//linux
                    fileName[i] = cut[cut.length-1];
                    uploadFileLength++;//上傳檔案數
                }

            }
            var formData = new FormData(this);

            var token = "{{ app('request')->input('token') }}";

            var caseType = "{{ $caseType }}";
            //var path = "{{ env('CHECK_DIR_ROOT') }}" + "\\test\\example\\" + caseType;
            var path = "{{ env('CHECK_DIR_ROOT') }}" + "/test/example/" + caseType;
            var url;
            if(caseType == "newcase"){
                url = "{{ route('fileuploadlist.upload.post', ['caseType' => 'newcase']) }}";
            }
            else if(caseType == "midcase"){
                url = "{{ route('fileuploadlist.upload.post', ['caseType' => 'midcase']) }}";
            }
            else if(caseType == "closedcase"){
                url = "{{ route('fileuploadlist.upload.post', ['caseType' => 'closedcase']) }}";
            }
            else if(caseType == "fixcase"){
                url = "{{ route('fileuploadlist.upload.post', ['caseType' => 'fixcase']) }}";
            }
            else if(caseType == "abnormalcase"){
                url = "{{ route('fileuploadlist.upload.post', ['caseType' => 'abnormalcase']) }}";
            }

            var caseList = "{{ json_encode($caseList) }}";

            for(var i = 1; i < filelistTableLength; i++){
                filelistUpdate[i-1] = {};
                var name = $('.filelistTable tr:eq('+i+')').children('.row-name').children('.name-value').val();
                if(name == ""){
                    alert("文件名稱不可空白!!!");
                    break;
                }
                else{
                    filelistUpdate[i-1]['sort'] = $('.filelistTable tr:eq('+i+')').children('.row-sort').text();
                    filelistUpdate[i-1]['chname'] = $('.filelistTable tr:eq('+i+')').children('.row-name').children('.name-value').val();
                    filelistUpdate[i-1]['example_desc'] = $('.filelistTable tr:eq('+i+')').children('.row-desc').children('.desc-value').val();

                    if(fileName[i-1] != ""){
                        filelistUpdate[i-1]['example_path'] = path;
                        filelistUpdate[i-1]['example_name'] = fileName[i-1];
                    }
                    else{
                        filelistUpdate[i-1]['example_path'] = caseList[i]['example_path'];
                        filelistUpdate[i-1]['example_name'] = caseList[i]['example_name'];
                    }

                    if($('.filelistTable tr:eq('+i+')').children('.row-require').children('.require-checked').is(":checked"))
                        filelistUpdate[i-1]['required'] = "Y";
                    else
                        filelistUpdate[i-1]['required'] = "N";
                }

            }

            contentUpdate = {'review_subj': $('.contentTable tr:eq(0)').children('.case-title').children('.case-title-value').val(),
                             'review_desc':$('.contentTable tr:eq(1)').children('.case-desc').children(".case-desc-value").val(),
                             'modified_date':''};

            if(uploadFileLength > 0){
                $.ajax({
                    type:'POST',
                    url: url,
                    headers: {Authorization: 'Bearer '+ token},
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    /*success: (data) => {

                    },*/
                    error: (data) => {
                        console.log(data);
                        /*if(typeof(data['responseJSON']) != "undefined" && data['responseJSON']['message'] == 'Invalid argument supplied for foreach()'){
                            alert('沒有選擇檔案');
                        }*/
                        if(data['status'] == 401){
                            alert('請重新登入');
                        }
                        else{
                            alert('ERROR: '+ data['statusText']);
                        }

                    }
                });
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method:'post',
                url:"{{ route('fileuploadlist.update') }}",
                data: {caseType:caseType, filelistUpdate:filelistUpdate, contentUpdate:contentUpdate, token:token},
                success:function(data){
                    console.log(data);
                    if(data != 0){
                        alert("更新失敗，請洽系統管理員");
                    }
                    else{
                        alert("更新成功");
                        condition = "";
                        loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/uploadFilelist/" + username;
                        $.ajax({
                            method:'post',
                            url:loginURL,
                            data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                            success:function(data){
                                openPostWindow("{{ route('fileuploadlist.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                            }
                        });
                    }
                }
            });
        });

        //返回上一頁
        $('.btn-back').on('click',function(e){
            condition = "";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/uploadFilelist/" + username;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('fileuploadlist.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });
        });
    </script>

</html>
