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
                            <p>選擇需要上傳的檔案 (每個上傳檔案大小請限制在 20 MB以內, 且最多上傳 20 個檔案)</p>
                        </div>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <th>檔名</th>
                                    <th>上傳檔案說明(版本資訊)</th>
                                    <th>上傳PDF檔</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div>
                            <button type="button" class="btn btn-outline-primary btn-upload">上傳檔案</button>
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

        //儲存
        $('.btn-save').on('click',function(e){
            var field = $(this).val();

            var proj_name = $('#proj_name').text();
            var txtAppName = $('#txtAppName').text();
            var txtAppNo = $('#txtAppNo').text();

            var avoid = $('#avoid').val();
            //var uploadFile = $('#uploadFile').text();
            var refreeRemark = $('#refreeRemark').val();
            var staffRemark = $('#staffRemark').val();

            if(field == "btn-avoid"){
                projectRemarkUpdate = { 'proj_name' : proj_name,
                                        'txtAppName' : txtAppName,
                                        'txtAppNo' : txtAppNo,
                                        'avoid' : avoid};
            }
            /*else if(field == "uploadFile"){

            }*/
            else if(field == "btn-refreeRemark"){
                projectRemarkUpdate = { 'proj_name' : proj_name,
                                        'txtAppName' : txtAppName,
                                        'txtAppNo' : txtAppNo,
                                        'refreeRemark' : refreeRemark};
            }
            else if(field == "btn-staffRemark"){
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
                data: {projectRemarkUpdate:projectRemarkUpdate, type:type, condition:condition, token:token},
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


    </script>
</html>
