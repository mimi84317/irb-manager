<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>

        <!--datepicker需要-->
        <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">
        <!---->

        <title>管理倫理委員會議</title>
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
                <p class="titleText">管理倫理委員會議</p>
            </div>
            <div class="col-12">
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-addNewMeeting">新增倫理委員會議</button>
                </div>
                <br>
                <div>
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th>委員會</th>
                                <td>
                                    <select class="form-select" aria-label="Default select example" id="selectCommittee">
                                        <option value="none" selected>請選擇</option>
                                        <option value="biomedical">醫學研究倫理委員會</option>
                                        <option value="humanities">人文社會科學研究倫理委員會</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>會議期間</th>
                                <td>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" name="from" placeholder="From date" id="fromDate">
                                        <span class="input-group-addon">~</span>
                                        <input type="text" class="input-sm form-control" name="to" placeholder="To date" id="toDate">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-search">查詢</button>
                                    <button type="button" class="btn btn-outline-info btn-clear">重設</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div>
                    <table class="table table-hover committeeTable">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <!--style="display:none"-->
                                <th scope="col">會議名稱</th>
                                <th scope="col">會議日期</th>
                                <th scope="col">委員會</th>
                                <th scope="col">會議內容</th>
                                <th scope="col">討論案件清單</th>
                                <th scope="col">刪除會議</th>
                                <th scope="col">會議記錄</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($committeeList as $committee)
                                <tr>
                                    <th class="row-id">{{ $committee['Id'] }}</th>
                                    <th>{{ $committee['committeeName'] }}</th>
                                    <th>{{ $committee['committeeDate'] }}</th>
                                    <th>{{ $committee['selectCommittee'] }}</th>
                                    <th class="committee-edit"><button type="button" class="btn btn-outline-primary btn-edit">編輯</th>
                                    <th>清單</th>
                                    <th><button type="button" class="btn btn-outline-primary btn-delete"><i class="fas fa-trash-alt"></i></button></th>
                                    <th>編輯</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script>
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

        $(function(){
            $('.input-daterange').datepicker({
                autoclose: true
            });
        });

        //新增倫理委員會
        $('.btn-addNewMeeting').on('click',function(e){
            username = "{{ app('request')->input('username') }}";
            clientid = "{{ app('request')->input('clientid') }}";
            client_secret = "{{ app('request')->input('client_secret') }}";
            user = "{{ app('request')->input('user') }}";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committeeNew/" + username;
            condition = "where Id=0";
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committeeNew.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });
        });

        //查詢
        $('.btn-search').on('click',function(e){
            var selectCommittee = $('#selectCommittee').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();

            if(selectCommittee == "none"){
                selectCommittee = "";
            }
            else if(selectCommittee == "biomedical"){
                selectCommittee = "醫學研究倫理委員會";
            }
            else if(selectCommittee == "humanities"){
                selectCommittee = "人文社會科學研究倫理委員會";
            }
            console.log(selectCommittee);

            var username = "{{ app('request')->input('username') }}";
            var clientid = "{{ app('request')->input('clientid') }}";
            var client_secret = "{{ app('request')->input('client_secret') }}";
            var user = "{{ app('request')->input('user') }}";
            var condition = "where selectCommittee='" + selectCommittee + "' and committeeDate between '" + fromDate + "' and '" + toDate + "'";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committee/" + username;
            console.log(condition);

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committee.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                    location.reload();
                }
            });


        });

        //重設
        $('.btn-clear').on('click',function(e){
            $('#selectCommittee').val("none");
            $('#fromDate').val("");
            $('#toDate').val("");
        });

        //會議內容-編輯
        $('.btn-edit').on('click',function(e){
            var row = $(this).parents('tr:first');
            var id = row.children('th.row-id').text();
            
            var username = "{{ app('request')->input('username') }}";
            var clientid = "{{ app('request')->input('clientid') }}";
            var client_secret = "{{ app('request')->input('client_secret') }}";
            var user = "{{ app('request')->input('user') }}";
            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committeeNew/" + username;
            var condition = "where Id=" + id;
            console.log(condition);
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committeeNew.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });
        });

        //刪除會議
        $('.committeeTable').on('click', '.btn-delete', function(){
            var result = confirm('是否刪除會議?');
            if(result == true){
                var row = $(this).parents('tr:first');
                var id = row.children('th.row-id').text();
                row.remove();
            }
            
        });

    </script>


</html>
