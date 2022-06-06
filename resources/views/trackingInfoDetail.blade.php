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

        <title>管理追蹤審查預定日功能</title>
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
                <p class="titleText">管理追蹤審查預定日功能</p>
            </div>
            <div class="col-12">
                <div>
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th>計畫主持人</th>
                                <td><input type="text" class="form-control" id="projectHost" value=""></td>
                            </tr>
                            <tr>
                                <th>iIRB No.或流水編號</th>
                                <td><input type="text" class="form-control" id="projectNum" value=""></td>
                            </tr>
                            <tr>
                                <th>計畫狀態</th>
                                <td>
                                    <select class="form-select" id="selectStatus">
                                        <option value="none" selected>請選擇</option>
                                        <option value="projContinue">計畫執行中</option>
                                        <option value="projEnd">計畫已結束</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>追蹤案類型</th>
                                <td>
                                    <select class="form-select" id="selectType">
                                        <option value="none" selected>請選擇</option>
                                        <option value="midcase">期中審查</option>
                                        <option value="closedcase">結案審查</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>計畫結束日</th>
                                <td>
                                    <div class="input-daterange input-group" id="projEnd">
                                        <input type="text" class="input-sm form-control" name="from" placeholder="From date" id="projEndFromDate">
                                        <span class="input-group-addon">~</span>
                                        <input type="text" class="input-sm form-control" name="to" placeholder="To date" id="projEndToDate">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>預定送審日</th>
                                <td>
                                    <div class="input-daterange input-group" id="projSubmit">
                                        <input type="text" class="input-sm form-control" name="from" placeholder="From date" id="projSubmitFromDate">
                                        <span class="input-group-addon">~</span>
                                        <input type="text" class="input-sm form-control" name="to" placeholder="To date" id="projSubmitToDate">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-search">查詢</button>
                                    <button type="button" class="btn btn-outline-primary btn-clear">重設</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table  class="trackingInfoDetailTable"
                            id="trackingInfoDetailTable"
                            data-toggle="table"
                            data-pagination="true"
                            data-toolbar="#toolbar"
                            data-use-row-attr-func="true"
                            data-reorderable-rows="true">

                        <thead>
                            <tr>
                                <th>id</th>
                                <th data-field="traceDate" data-sortable="true">追蹤審查預定日</th>
                                <th data-field="traceType" data-sortable="true">追蹤案類型</th>
                                <th data-field="traceRemark">追蹤審查備註</th>
                                <th data-field="protocolNum" data-sortable="true">Protocol流水號</th>
                                <th data-field="txtReviewNo" data-sortable="true">iIRB No.</th>
                                <th data-field="txtAppName">主持人</th>
                                <th data-field="Duration_start">計畫起日</th>
                                <th data-field="Duraton_end">計畫結束日</th>
                                <th data-field="tracingSumbit"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($tracinglist); $i++)
                                <tr>
                                    <td class="row-id">{{ $tracinglist[$i]['Id'] }}</td>
                                    <td>{{ $tracinglist[$i]['tracingDateStart'] }}</td>
                                    <td>{{ $tracinglist[$i]['status'] }}</td>
                                    <td>{{ $tracinglist[$i]['description'] }}</td>
                                    <td>{{ $tracinglist[$i]['txtAppNo'] }}</td>
                                    <td>{{ $tracinglist[$i]['txtReviewNo'] }}</td>
                                    <td>{{ $tracinglist[$i]['txtAppName'] }}</td>
                                    <td>{{ $tracinglist[$i]['Duration_start'] }}</td>
                                    <td>{{ $tracinglist[$i]['Duraton_end'] }}</td>
                                    <td>
                                        @if ($tracinglist[$i]['tracingSumbit'] == "N")
                                            <div><button type="button" class="btn btn-outline-primary btn-sumbit">已送審</button></div>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
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
            tempForm.submit();
            document.body.removeChild(tempForm);
        }

        $(function(){
            $('.input-daterange').datepicker({
                autoclose: true,
                format: "yyyy/mm/dd",
            });
        });

        //查詢
        $('.btn-search').on('click',function(e){
            var projectHost = $('#projectHost').val();//計畫主持人
            var projectNum = $('#projectNum').val();//iIRB No.或流水編號
            var selectStatus = $('#selectStatus').val();//計畫狀態
            var selectType = $('#selectType').val();//追蹤案類型
            var projEndFromDate = $('#projEndFromDate').val();//計畫結束日-起
            var projEndToDate = $('#projEndToDate').val();//計畫結束日-迄
            var projSubmitFromDate = $('#projSubmitFromDate').val();//預定送審日-起
            var projSubmitToDate = $('#projSubmitToDate').val();//預定送審日-迄

            //計畫狀態
            if(selectStatus == "none"){
                selectStatus = "";
            }
            else if(selectStatus == "projContinue"){
                selectStatus = "計畫執行中";
            }
            else if(selectStatus == "projEnd"){
                selectStatus = "計畫已結束";
            }

            //追蹤案類型
            if(selectType == "none"){
                selectType = "";
            }
            else if(selectType == "midcase"){
                selectType = "新案審查";
            }
            else if(selectType == "closedcase"){
                selectType = "結案審查";
            }

            var condition = "";
            condition += "where txtAppName like '%" + projectHost + "%' ";//計畫主持人
            condition += "and txtAppNo like '%" + projectNum + "%' ";//iIRB No.或流水編號-流水編號
            condition += "and txtReviewNo like '%" + projectNum + "%' ";//iIRB No.或流水編號-iIRB No.
            condition += "and txtAppName like '%" + selectStatus + "%' ";//status
            condition += "and proj_name like '%" + selectType + "%' ";//追蹤案類型
            condition += "and ??? between '" + projEndFromDate + "' and '" + projEndToDate + "'";//計畫結束日
            condition += "and ??? between '" + projSubmitFromDate + "' and '" + projSubmitToDate + "'";//預定送審日
            if(fromDate != ""){
                condition += "and Duration_start > '" + fromDate + "' ";//計畫起訖日期
            }
            if(toDate != ""){
                condition += "and Duraton_end < '" + toDate + "' ";//計畫起訖日期
            }

            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlow/" + username;
            console.log(condition);


            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('manageFlow.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });


        });

        //重設
        $('.btn-clear').on('click',function(e){
            $('#projectHost').val("");//計畫主持人
            $('#projectNum').val("");//iIRB No.或流水編號
            $('#selectStatus').val("none");//計畫狀態
            $('#selectType').val("none");//追蹤案類型
            $('#projEndFromDate').val("");//計畫結束日-起
            $('#projEndToDate').val("");//計畫結束日-迄
            $('#projSubmitFromDate').val("");//預定送審日-起
            $('#projSubmitToDate').val("");//預定送審日-訖
        });

        //已送審
        $('.trackingInfoDetailTable').on('click', '.btn-sumbit',function(e){
            var row = $(this).parents('tr:first');
            var caseAppNo = row.children('.row-caseAppNo').text();

            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlow/" + username;
            var condition = "where caseAppNo='" + caseAppNo+"'";

            var row = $(this).parents('tr:first');
            var id = row.children('.row-id').text();

            console.log(id);

            return 0;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('manageFlowContent.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });
        });

    </script>


</html>
