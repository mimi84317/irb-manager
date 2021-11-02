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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!--datepicker需要-->
        <!--<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
        <script src="{{ asset('js/datepicker/bootstrap.min.js') }}"></script>
        <!--<script type='text/javascript' src='//code.jquery.com/jquery-1.8.3.js'></script>-->
        <!--<script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <script src="{{ asset('js/datepicker/jquery.min.js') }}"></script>
        <!--<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>-->
        <script type='text/javascript' src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
        <!---->

        <div class="container">
            <div class="col-form-label">
                <p class="titleText">會議記錄</p>
            </div>
            <div class="col-12">
                <div>
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th>委員會</th>
                                <td><div>{{ $committeeContentList[0]['selectCommittee'] }}</div></td>
                            </tr>
                            <tr>
                                <th>會議名稱</th>
                                <td><div>{{ $committeeContentList[0]['committeeName'] }}</div></td>
                            </tr>
                            <tr>
                                <th>會議日期</th>
                                <td>{{ $committeeContentList[0]['committeeDate'] }}</td>
                            </tr>
                            <tr>
                                <th>會議地點</th>
                                <td>{{ $committeeContentList[0]['committeePlace'] }}</td>
                            </tr>
                            <tr>
                                <th>主席</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <input type="text" class="form-control" id="committeeChairPerson" value="{{ $committeeContentList[0]['committeeChairPerson'] }}">
                                    @elseif (count($committeeContentList) == 0)
                                        <input type="text" class="form-control" id="committeeChairPerson">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>記錄</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <input type="text" class="form-control" id="committeeMinutesTaker" value="{{ $committeeContentList[0]['committeeMinutesTaker'] }}">
                                    @elseif (count($committeeContentList) == 0)
                                        <input type="text" class="form-control" id="committeeMinutesTaker" value="">
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <th>出席</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <textarea class="form-control desc-value" rows="5" id="committeeAttendance">{{ $committeeContentList[0]['committeeAttendance'] }}</textarea>
                                    @elseif (count($committeeContentList) == 0)
                                        <textarea class="form-control desc-value" rows="5" id="committeeAttendance"></textarea>
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <th>請假</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <textarea class="form-control desc-value" rows="5" id="committeeAbsentee">{{ $committeeContentList[0]['committeeAbsentee'] }}</textarea>
                                    @elseif (count($committeeContentList) == 0)
                                        <textarea class="form-control desc-value" rows="5" id="committeeAbsentee"></textarea>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>列席</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <textarea class="form-control desc-value" rows="5" id="committeeVisitor">{{ $committeeContentList[0]['committeeVisitor'] }}</textarea>
                                    @elseif (count($committeeContentList) == 0)
                                        <textarea class="form-control desc-value" rows="5" id="committeeVisitor"></textarea>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>報告事項</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <textarea class="form-control desc-value" rows="10" id="committeeReport">{{ $committeeContentList[0]['committeeReport'] }}</textarea>
                                    @elseif (count($committeeContentList) == 0)
                                        <textarea class="form-control desc-value" rows="10" id="committeeReport"></textarea>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>討論事項</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <input type="text" class="form-control" id="committeeDiscussion" value="{{ $committeeContentList[0]['committeeDiscussion'] }}">
                                    @elseif (count($committeeContentList) == 0)
                                        <input type="text" class="form-control" value="" id="committeeDiscussion">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>臨時動議</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <input type="text" class="form-control" id="committeeMotion" value="{{ $committeeContentList[0]['committeeMotion'] }}">
                                    @elseif (count($committeeContentList) == 0)
                                        <input type="text" class="form-control" value="" id="committeeMotion">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>散會時間</th>
                                <td>
                                    @if (count($committeeContentList) > 0)
                                        <input type="text" class="form-control" id="committeeEndDateTime" value="{{ $committeeContentList[0]['committeeEndDateTime'] }}">
                                    @elseif (count($committeeContentList) == 0)
                                        <input type="text" class="form-control" value="" id="committeeEndDateTime">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <form class="form-inline">
                                        <div class="d-inline-block">
                                            本次會議出席人數
                                        </div>
                                        <div class="d-inline-block">
                                            @if (count($committeeContentList) > 0)
                                                <input type="text" class="form-control" id="committeePresentNumber" value="{{ $committeeContentList[0]['committeePresentNumber'] }}">
                                            @elseif (count($committeeContentList) == 0)
                                                <input type="text" class="form-control" value="" id="committeePresentNumber">
                                            @endif
                                        </div>
                                        <div class="d-inline-block">
                                            人，並有非醫療專業委員及非試驗機構內委員與會，已達法定開會條件，主席宣布開會。
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-primary btn-update">更新</button>
                    <button type="button" class="btn btn-outline-primary btn-back">返回上一頁</button>
                </div>
            </div>
        </div>
    </body>
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

        $(function(){
            $('.input-daterange').datepicker({
                autoclose: true
            });
        });

        //更新
        $('.btn-update').on('click',function(e){
            var committeeChairPerson = $("#committeeChairPerson").val();
            var committeeMinutesTaker = $("#committeeMinutesTaker").val();
            var committeeAttendance = $("#committeeAttendance").val();
            var committeeAbsentee = $("#committeeAbsentee").val();
            var committeeVisitor = $("#committeeVisitor").val();
            var committeeReport = $("#committeeReport").val();
            var committeeDiscussion = $("#committeeDiscussion").val();
            var committeeMotion = $("#committeeMotion").val();
            var committeeEndDateTime = $("#committeeEndDateTime").val();
            var committeePresentNumber = $("#committeePresentNumber").val();

            committeeUpdate = { 'committeeChairPerson': committeeChairPerson,
                                'committeeMinutesTaker': committeeMinutesTaker,
                                'committeeAttendance': committeeAttendance,
                                'committeeAbsentee' : committeeAbsentee,
                                'committeeVisitor' : committeeVisitor,
                                'committeeReport' : committeeReport,
                                'committeeDiscussion' : committeeDiscussion,
                                'committeeMotion' : committeeMotion,
                                'committeeEndDateTime' : committeeEndDateTime,
                                'committeePresentNumber' : committeePresentNumber,
                                'modified_date':''};

            //console.log(committeeUpdate);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            token = "{{ app('request')->input('token') }}";

            var updateType = "update";
            var condition = "where Id={{ $committeeContentList[0]['Id'] }}";

            $.ajax({
                method:'post',
                url:"{{ route('committee.update') }}",
                data: {committeeUpdate:committeeUpdate, updateType:updateType, condition:condition, token:token},
                success:function(data){
                    console.log(data);
                    if(data != 0){
                        alert("更新失敗，請洽系統管理員");
                    }
                    else{
                        alert("更新成功");
                        condition = "";
                        loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committee/" + username;
                        $.ajax({
                            method:'post',
                            url:loginURL,
                            data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                            success:function(data){
                                openPostWindow("{{ route('committee.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                            }
                        });
                    }
                }
            });
        });


        //返回上一頁
        $('.btn-back').on('click',function(e){
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
