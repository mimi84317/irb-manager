<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>

        <title>設定案件上傳清單</title>
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
                <p class="titleText">設定案件上傳清單</p>
            </div>
            <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">案件類型</th>
                            <th scope="col">建立/修改日期</th>
                            <th scope="col">清單列表描述</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>新案審查</th>
                            <td>{{ $modifiedDateList[0]['modified_date'] }}</td>
                            <td>
                                @foreach($newFilelist as $newFile)
                                    {{ $newFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="newcase">編輯</button></td>
                        </tr>
                        <tr>
                            <th>期中審查</th>
                            <td>{{ $modifiedDateList[1]['modified_date'] }}</td>
                            <td>
                                @foreach($midFilelist as $midFile)
                                    {{ $midFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="midcase">編輯</button></td>
                        </tr>
                        <tr>
                            <th>結案審查</th>
                            <td>{{ $modifiedDateList[2]['modified_date'] }}</td>
                            <td>
                                @foreach($closedFilelist as $closedFile)
                                    {{ $closedFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="closedcase">編輯</button></td>
                        </tr>
                        <tr>
                            <th>修正審查</th>
                            <td>{{ $modifiedDateList[3]['modified_date'] }}</td>
                            <td>
                                @foreach($fixFilelist as $fixFile)
                                    {{ $fixFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="fixcase">編輯</button></td>
                        </tr>
                        <tr>
                            <th>異常審查(院內)</th>
                            <td>{{ $modifiedDateList[4]['modified_date'] }}</td>
                            <td>
                                @foreach($abnormalFilelist as $abnormalFile)
                                    {{ $abnormalFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="abnormalcase">編輯</button></td>
                        </tr>
                    </tbody>
                </table>
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

        //編輯
        $('.btn-setting').on('click',function(e){
            condition = "order by sort";
            caseType = e.target.id;
            //loginURL = "http://127.0.0.1:8000/api/auth/login/uploadFileListSetting"+caseType+"/" + username;
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/uploadFileListSetting_" + caseType + "/" + username;
            //console.log(loginURL);
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    if(caseType == "newcase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'newcase']) }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                    }
                    else if(caseType == "midcase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'midcase']) }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                    }
                    else if(caseType == "closedcase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'closedcase']) }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                    }
                    else if(caseType == "fixcase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'fixcase']) }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                    }
                    else if(caseType == "abnormalcase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'abnormalcase']) }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                    }
                }
            });
        });
    </script>
</html>
