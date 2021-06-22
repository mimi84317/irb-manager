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
                            <td>新案審查</td>
                            <td>{{ $modifiedDateList[0]['modified_date'] }}</td>
                            <td>
                                @foreach($newFilelist as $newFile)
                                    {{ $newFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="newCase">編輯</button></td>
                        </tr>
                        <tr>
                            <td>期中審查</td>
                            <td>{{ $modifiedDateList[1]['modified_date'] }}</td>
                            <td>
                                @foreach($midFilelist as $midFile)
                                    {{ $midFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="midCase">編輯</button></td>
                        </tr>
                        <tr>
                            <td>結案審查</td>
                            <td>{{ $modifiedDateList[2]['modified_date'] }}</td>
                            <td>
                                @foreach($closedFilelist as $closedFile)
                                    {{ $closedFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="closedCase">編輯</button></td>
                        </tr>
                        <tr>
                            <td>修正審查</td>
                            <td>{{ $modifiedDateList[3]['modified_date'] }}</td>
                            <td>
                                @foreach($fixFilelist as $fixFile)
                                    {{ $fixFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="fixCase">編輯</button></td>
                        </tr>
                        <tr>
                            <td>異常審查(院內)</td>
                            <td>{{ $modifiedDateList[4]['modified_date'] }}</td>
                            <td>
                                @foreach($abnormalFilelist as $abnormalFile)
                                    {{ $abnormalFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><button type="button" class="btn btn-outline-primary btn-setting" id="abnormalCase">編輯</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function openPostWindow(url, name, token, username, clientid, client_secret, user)
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

            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            tempForm.appendChild(hideInput4);
            tempForm.appendChild(hideInput5);

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

        $('.btn-setting').on('click',function(e){
            username = "{{ app('request')->input('username') }}";
            clientid = "{{ app('request')->input('clientid') }}";
            client_secret = "{{ app('request')->input('client_secret') }}";
            user = "{{ app('request')->input('user') }}";
            caseType = e.target.id;
            loginURL = "http://127.0.0.1:8000/api/auth/login/uploadFileListSetting"+caseType+"/" + username;
            console.log(loginURL);
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    if(caseType == "newCase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'newcase']) }}", "", data["access_token"], username, clientid, client_secret, user);
                    }
                    else if(caseType == "midCase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'midcase']) }}", "", data["access_token"], username, clientid, client_secret, user);
                    }
                    else if(caseType == "closedCase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'closedcase']) }}", "", data["access_token"], username, clientid, client_secret, user);
                    }
                    else if(caseType == "fixCase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'fixcase']) }}", "", data["access_token"], username, clientid, client_secret, user);
                    }
                    else if(caseType == "abnormalCase"){
                        openPostWindow("{{ route('fileuploadlist.setting.post', ['caseType' => 'abnormalcase']) }}", "", data["access_token"], username, clientid, client_secret, user);
                    }
                }
            });
        });
    </script>
</html>
