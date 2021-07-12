<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>

        <!--datepicker需要-->
        <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">
        <!---->

        <title>新增倫理委員會議</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!--datepicker需要-->
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <!--<script type='text/javascript' src='//code.jquery.com/jquery-1.8.3.js'></script>-->
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
        <!---->

        <div class="container">
            <div class="col-form-label">
                <p class="titleText">新增倫理委員會議</p>
            </div>
            <div class="col-12">
                <div>
                    <div>
                        <p class="text-danger font-weight-bold">*</p>為必填欄位
                    </div>

                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th><p class="text-danger font-weight-bold">*</p>委員會</th>
                                <td>
                                    <select class="form-select" aria-label="Default select example" id="selectCommittee">
                                        <option value="none" selected>請選擇</option>
                                        <option value="biomedical">醫學研究倫理委員會</option>
                                        <option value="humanities">人文社會科學研究倫理委員會</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><p class="text-danger font-weight-bold">*</p>會議名稱</th>
                                <td>
                                    <input type="text" class="form-control" value="" id="committeeName">
                                </td>
                            </tr>
                            <tr>
                                <th><p class="text-danger font-weight-bold">*</p>會議日期</th>
                                <td>
                                    <input type="text" class="input-sm form-control" name="from" id="committeeDate">
                                </td>
                            </tr>
                            <tr>
                                <th>會議地點</th>
                                <td>
                                    <input type="text" class="input-sm form-control" name="from" id="committeePlace">
                                </td>
                            </tr>
                            <tr>
                                <th>會議說明</th>
                                <td>
                                    <textarea class="form-control desc-value" rows="10" id="committeeContent"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-primary btn-update">新增</button>
                    <button type="button" class="btn btn-outline-primary btn-back">返回上一頁</button>
                </div>
            </div>
        </div>
    </body>
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

        $(function(){
            $('#committeeDate').datepicker({
                autoclose: true
            });
        });

        $('.btn-update').on('click',function(e){
            var selectCommittee = $('#selectCommittee').val();
            var committeeName = $('#committeeName').val();
            var committeeDate = $('#committeeDate').val();
            var committeePlace = $('#committeePlace').val();
            var committeeContent = $('#committeeContent').val();

            if(selectCommittee == "none"){
                selectCommittee = "";
            }
            else if(selectCommittee == "biomedical"){
                selectCommittee = "醫學研究倫理委員會";
            }
            else if(selectCommittee == "humanities"){
                selectCommittee = "人文社會科學研究倫理委員會";
            }

            var dateFormat = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;
            if(committeeDate.match(dateFormat)){
                alert("日期格式不正確");
            }
            else{
                if(selectCommittee == "" || committeeName == "" || committeeDate == ""){
                    alert("資料填寫不完整");
                }
                else{
                    committeeUpdate = {'committeeName': committeeName,
                                     'committeeDate': committeeDate,
                                     'selectCommittee': selectCommittee,
                                     'committeePlace' : committeePlace,
                                     'committeeContent' : committeeContent,
                                     'modified_date':''};

                    console.log(committeeUpdate);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    token = "{{ app('request')->input('token') }}";
                    $.ajax({
                        method:'post',
                        url:"{{ route('committee.update') }}",
                        data: {committeeUpdate:committeeUpdate, token:token},
                        success:function(data){
                            console.log(data);
                            if(data != 0){
                                alert("更新失敗，請洽系統管理員");
                            }
                            else{
                                alert("更新成功");
                                username = "{{ app('request')->input('username') }}";
                                clientid = "{{ app('request')->input('clientid') }}";
                                client_secret = "{{ app('request')->input('client_secret') }}";
                                user = "{{ app('request')->input('user') }}";
                                //loginURL = "http://127.0.0.1:8000/api/auth/login/uploadFilelist/" + username;
                                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committee/" + username;
                                //console.log(loginURL);
                                $.ajax({
                                    method:'post',
                                    url:loginURL,
                                    data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                                    success:function(data){
                                        openPostWindow("{{ route('committee.post') }}", "", data["access_token"], username, clientid, client_secret, user);
                                    }
                                });
                            }
                        }
                    });
                }
            }


        });

        $('.btn-back').on('click',function(e){
            username = "{{ app('request')->input('username') }}";
            clientid = "{{ app('request')->input('clientid') }}";
            client_secret = "{{ app('request')->input('client_secret') }}";
            user = "{{ app('request')->input('user') }}";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committee/" + username;
            //console.log(loginURL);
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committee.post') }}", "", data["access_token"], username, clientid, client_secret, user);
                }
            });
        });

    </script>


</html>
