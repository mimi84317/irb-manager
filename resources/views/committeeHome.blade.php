<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>

        <!--datepicker需要-->
        <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">-->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">-->
        <link rel="stylesheet" href="{{ asset('js/datepicker/bootstrap-datepicker3.min.css') }}">
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
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <!--datepicker需要-->
        <!--<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
        <script src="{{ asset('js/datepicker/bootstrap.min.js') }}"></script>
        <!--<script type='text/javascript' src='//code.jquery.com/jquery-1.8.3.js'></script>-->
        <!--<script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <script src="{{ asset('js/datepicker/jquery.min.js') }}"></script>
        <!--<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>-->
        <script type='text/javascript' src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
        <!---->

        <!--table需要-->
        <!--<script src="https://cdn.jsdelivr.net/npm/tablednd@1.0.5/dist/jquery.tablednd.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">-->
        <!--<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">-->
        <link href="{{ asset('js/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">
        <!--<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>-->
        <script src="{{ asset('js/bootstrap-table/bootstrap-table.min.js') }}"></script>
        <!---->

        <div class="container">
            <div class="col-form-label">
                <p class="titleText">管理倫理委員會議</p>
            </div>
            <div class="col-12">
                <div>
                    <button type="button" class="btn btn-outline-success btn-addNewMeeting">新增倫理委員會議</button>
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
                                    <select class="form-select" id="selectCommittee">
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
                    <table  class="committeeTable"
                            id="committeeTable"
                            data-toggle="table"
                            data-pagination="true"
                            data-toolbar="#toolbar"
                            data-use-row-attr-func="true"
                            data-reorderable-rows="true">

                        <thead>
                            <tr>
                                <th data-field="committeeID" class="d-none">id</th>
                                <th data-field="committeeName" data-sortable="true">會議名稱</th>
                                <th data-field="committeeDate" data-sortable="true">會議日期</th>
                                <th data-field="selectCommittee" data-sortable="true">委員會</th>
                                <th>會議內容</th>
                                <th>討論案件清單</th>
                                <th>刪除會議</th>
                                <th>會議記錄</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($committeeList as $committee)
                                <tr>
                                    <th class="row-id" style="display:none">{{ $committee['Id'] }}</th>
                                    <th class="row-committeeName">{{ $committee['committeeName'] }}</th>
                                    <th>{{ $committee['committeeDate'] }}</th>
                                    <th>{{ $committee['selectCommittee'] }}</th>
                                    <th class="committee-editContent"><button type="button" class="btn btn-outline-success btn-editContent">編輯 <i class="fas fa-edit"></i></th>
                                        <th class="committee-list"><button type="button" class="btn btn-outline-primary btn-list">清單</th>
                                    <th><button type="button" class="btn btn-outline-secondary btn-delete"><i class="fas fa-trash-alt"></i></button></th>
                                    <th class="committee-editRecord"><button type="button" class="btn btn-outline-info btn-editRecord">編輯 <i class="fas fa-edit"></i></th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script>

        var username = "{{ app('request')->input('username') }}";
        var clientid = "{{ app('request')->input('clientid') }}";
        var client_secret = "{{ app('request')->input('client_secret') }}";
        var user = "{{ app('request')->input('user') }}";

        function openPostWindow(url, name, token, username, clientid, client_secret, user, condition, committeeType, committeeName)
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

            var hideInput7 = document.createElement("input");
            hideInput7.type = "hidden";
            hideInput7.name = "committeeType";
            hideInput7.value = committeeType;

            var hideInput8 = document.createElement("input");
            hideInput8.type = "hidden";
            hideInput8.name = "committeeName";
            hideInput8.value = committeeName;

            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            tempForm.appendChild(hideInput4);
            tempForm.appendChild(hideInput5);
            tempForm.appendChild(hideInput6);
            tempForm.appendChild(hideInput7);
            tempForm.appendChild(hideInput8);

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
            tempForm.submit();
            document.body.removeChild(tempForm);
        }

        $(function(){
            $('.input-daterange').datepicker({
                autoclose: true,
                format: "yyyy/mm/dd",
            });
        });

        //新增倫理委員會
        $('.btn-addNewMeeting').on('click',function(e){
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committeeNew/" + username;
            condition = "where Id=0";
            var committeeType = "content";
            var committeeName = "";
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committeeContent.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition, committeeType, committeeName);
                }
            });
        });

        //查詢
        $('.btn-search').on('click',function(e){
            var selectCommittee = $('#selectCommittee').val();//委員會
            var fromDate = $('#fromDate').val();//會議期間-起
            var toDate = $('#toDate').val();//會議期間-迄

            var committeeType = "";
            var committeeName = "";

            if(selectCommittee == "none"){
                selectCommittee = "";
            }
            else if(selectCommittee == "biomedical"){
                selectCommittee = "醫學研究倫理委員會";
            }
            else if(selectCommittee == "humanities"){
                selectCommittee = "人文社會科學研究倫理委員會";
            }

            if(fromDate == ""){
                fromDate = "01/01/1990";
            }
            if(toDate == ""){
                toDate = "12/31/2121";
            }

            var condition = "where selectCommittee like '%" + selectCommittee + "%' and committeeDate between '" + fromDate + "' and '" + toDate + "'";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committee/" + username;

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committee.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition, committeeType, committeeName);
                }
            });


        });

        //重設
        $('.btn-clear').on('click',function(e){
            /*$('#selectCommittee').val("none");
            $('#fromDate').val("");
            $('#toDate').val("");*/

            var committeeType = "";
            var committeeName = "";

            var condition = "";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committee/" + username;

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committee.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition, committeeType, committeeName);
                }
            });
        });

        //會議內容-編輯
        $('.committeeTable').on('click', '.btn-editContent',function(e){
            var row = $(this).parents('tr:first');
            var id = row.children('.row-id').text();
            console.log(id)

            var committeeType = "";
            var committeeName = "";

            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committeeContent/" + username;
            var condition = "where Id=" + id;
            var committeeType = "content";

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committeeContent.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition, committeeType, committeeName);
                }
            });
        });

        //討論案件清單
        $('.committeeTable').on('click', '.btn-list',function(e){
            var row = $(this).parents('tr:first');
            //var id = row.children('.row-id').text();
            var committeeName = row.children('.row-committeeName').text();

            var committeeType = "";
            //var committeeName = "";

            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committeeList/" + username;
            var condition = "where committeeName='" + committeeName + "'";
            console.log(condition);

            //return 0;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committeeList.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition, committeeType, committeeName);
                }
            });
        });

        //刪除會議
        $('.committeeTable').on('click', '.btn-delete', function(){
            var result = confirm('是否刪除會議?');
            if(result == true){
                var row = $(this).parents('tr:first');
                var id = row.children('.row-id').text();
                //row.remove();

                var committeeType = "";
                var committeeName = "";

                var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committeeMinutes/" + username;
                var condition = id;

                var deleteURL = "{{ env('SERVER_URL') }}" + "/BPMAPI/index.php";

                $.ajax({
                    method:'post',
                    url:loginURL,
                    data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                    success:function(data){
                        $.ajax({
                            method:'post',
                            url:"{{ route('committee.delete') }}",
                            data: {condition:condition, token:data["access_token"], username:username, clientid:clientid, client_secret:client_secret, user:user},
                            success:function(data){
                                alert("刪除成功");
                                document.location.reload(true);
                            }
                        });
                    }
                });
            }

        });

        //會議記錄-編輯
        $('.committeeTable').on('click', '.btn-editRecord',function(e){
            var row = $(this).parents('tr:first');
            var id = row.children('.row-id').html();

            //var committeeType = "";
            var committeeName = "";

            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committeeMinutes/" + username;
            var condition = "where Id=" + id;
            var committeeType = "minutes";

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('committeeContent.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition, committeeType, committeeName);
                }
            });
        });

    </script>


</html>
