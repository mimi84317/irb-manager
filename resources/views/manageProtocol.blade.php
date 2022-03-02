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

        <title>管理計畫</title>
        <style>
            .titleText {
                color: #000093;
                text-align: left;
                font-weight: bold;
                font-size: 30px;
            }
            /*.table-bordered{
                table-layout: fixed;
                min-width: 1440px;
            }*/
            .txtReviewNo{
                min-width: 250px;
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
                <p class="titleText">管理計畫</p>
            </div>
            <div class="col-12">
                <div>
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th>計畫名稱</th>
                                <td><input type="text" class="form-control" id="projectName" value=""></td>
                            </tr>
                            <tr>
                                <th>所別</th>
                                <td>
                                    <select class="form-select" id="selectResearch">
                                        <option value="none" selected>請選擇</option>
                                        <option value="abrc">Agricultural Biotechnology Research Center 農業生物科技研究中心</option>
                                        <option value="ipmb">Institute of Plant and Microbial Biology 植物暨微生物學研究所</option>
                                        <option value="icob">Institute of Cellular and Organismic Biology 細胞與個體生物學研究所</option>
                                        <option value="il">Institute of Linguistics 語言學研究所</option>
                                        <option value="ibs">Institute of Biomedical Sciences 生物醫學科學研究所</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>計畫主持人</th>
                                <td><input type="text" class="form-control" id="projectHost" value=""></td>
                            </tr>
                            <tr>
                                <th>iIRB No.或流水編號</th>
                                <td><input type="text" class="form-control" id="projectNum" value=""></td>
                            </tr>
                            <tr>
                                <th>計畫起訖日期</th>
                                <td>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" name="from" placeholder="From date" id="fromDate">
                                        <span class="input-group-addon">~</span>
                                        <input type="text" class="input-sm form-control" name="to" placeholder="To date" id="toDate">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>狀態</th>
                                <td>
                                    <select class="form-select" id="selectStatus">
                                        <option value="none" selected>請選擇</option>
                                        <option value="newcase">新案申請中</option>
                                        <option value="planning">計畫執行中</option>
                                        <option value="planclosed">計畫已結束</option>
                                        <option value="planfailed">計劃不成立</option>
                                    </select>
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
                    <table  class="manageProtocolTable"
                            id="manageProtocolTable"
                            data-toggle="table"
                            data-pagination="true"
                            data-toolbar="#toolbar"
                            data-use-row-attr-func="true"
                            data-reorderable-rows="true">

                        <thead>
                            <tr>
                                <th data-field="field-txtAppNo" data-sortable="true">流水編號</th>
                                <th data-field="field-txtReviewNo" data-sortable="true" class="txtReviewNo">iIRB No.</th>
                                <th data-field="field-proj_name" data-sortable="true">計劃名稱</th>
                                <th data-field="field-txtSchool" data-sortable="true">所別</th>
                                <th data-field="field-txtAppName" data-sortable="true">主持人</th>
                                <th data-field="Duration" data-sortable="true">研究起迄期間</th>
                                <th data-sortable="true">設定追蹤審查預定日*(IRB行政人員設定)</th>
                                <th data-sortable="true">狀態</th>
                                <th data-sortable="true">其他計畫編號(衛署計畫編號、JIRB編號、科技部編號...)</th>
                                <th data-sortable="true">是否為匯入案件</th>
                                <th data-sortable="true">刪除匯入案件</th>
                                <th>申請追蹤審查</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($projectList); $i++)
                                <tr>
                                    <th class="row-txtAppNo">{{ $projectList[$i]['txtAppNo'] }}</th>
                                    <th class="row-txtReviewNo">
                                        <div class="input-group">
                                            <input type="text" class="form-control txtReviewNo" value="{{ $projectList[$i]['txtReviewNo'] }}" readonly>
                                            <div class="input-group-append">
                                                <!--<button class="btn btn-outline-secondary btn-settxtReviewNo" type="button"><i class="button-icon fas fa-pen"></i></button>-->
                                                <button class="btn btn-outline-secondary btn-setting" type="button" value="btn-txtReviewNo"><i class="button-icon fas fa-pen"></i></button>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="row-txtReviewNo"><a href="javascript:void(0)" onclick="changePage('{{ $projectList[$i]['caseAppNo'] }}')">{{ $projectList[$i]['proj_name'] }}</a></th>
                                    <th>{{ $projectList[$i]['txtSchool'] }}</th>
                                    <th>{{ $projectList[$i]['txtAppName'] }}</th>
                                    <th>{{ $projectList[$i]['Duration_start'] }} ~ {{ $projectList[$i]['Duraton_end'] }}</th>
                                    <th></th>
                                    <th></th>
                                    <th class="row-txtOtherNo">
                                        <div class="input-group">
                                            <input type="text" class="form-control txtOtherNo" value="{{ $projectList[$i]['txtOtherNo'] }}" readonly>
                                            <div class="input-group-append">
                                                <!--<button class="btn btn-outline-secondary btn-settxtOtherNo" type="button"><i class="button-icon fas fa-pen"></i></button>-->
                                                <button class="btn btn-outline-secondary btn-setting" type="button" value="btn-txtOtherNo"><i class="button-icon fas fa-pen"></i></button>
                                            </div>
                                        </div>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
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

        function openPostWindow(url, name, token, username, clientid, client_secret, user, condition, committeeType)
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

            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            tempForm.appendChild(hideInput4);
            tempForm.appendChild(hideInput5);
            tempForm.appendChild(hideInput6);
            tempForm.appendChild(hideInput7);

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
                autoclose: true
            });
        });

        //更新iIRB No.、其他計畫編號(衛署計畫編號、JIRB編號、科技部編號...)
        $('.manageProtocolTable').on('click', '.btn-setting', function(){
            var btnValue = $(this).val();

            if(btnValue == "btn-txtReviewNo"){
                var row = $(this).parents('tr:first').children('.row-txtReviewNo');
                var div = row.children('.input-group');

                //欄位相關
                var input = div.children('.txtReviewNo');
                var txtReviewNo = input.val();

                var updateValue = {'txtReviewNo': txtReviewNo};
            }
            else if(btnValue == "btn-txtOtherNo"){
                var row = $(this).parents('tr:first').children('.row-txtOtherNo');
                var div = row.children('.input-group');

                //欄位相關
                var input = div.children('.txtOtherNo');
                var txtOtherNo = input.val();

                var updateValue = {'txtOtherNo': txtOtherNo};
            }

            //button相關
            var buttonDiv = div.children('.input-group-append');
            var button = buttonDiv.children('.btn-setting');
            //流水編號
            var txtAppNo = $(this).parents('tr:first').children('.row-txtAppNo').text();

            if(input.is('[readonly]')){
                input.prop("readonly", false);

                //修改圖示
                button.children('.fas').removeClass('fa-pen');
                button.children('.fas').addClass('fa-check');
            }
            else{
                input.prop("readonly", true);

                var condition = "where txtAppNo='" + txtAppNo + "'";
                var token = "{{ app('request')->input('token') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method:'post',
                    url:"{{ route('manageProtocol.update') }}",
                    data: {updateValue:updateValue, condition:condition, token:token},
                    success:function(data){
                        console.log(data);
                        if(data != 0){
                            alert("更新失敗，請洽系統管理員");
                        }
                        else{
                            alert("更新成功");

                            //修改圖示
                            button.children('.fas').removeClass('fa-check');
                            button.children('.fas').addClass('fa-pen');

                            setTimeout(function () { document.location.reload(true); }, 5);
                        }
                    }
                });
            }

        });

        //查詢
        $('.btn-search').on('click',function(e){
            var projectName = $('#projectName').val();//計畫名稱
            var selectResearch = $('#selectResearch').val();//所別
            var projectHost = $('#projectHost').val();//計畫主持人
            var projectNum = $('#projectNum').val();//iIRB No.或流水編號
            var fromDate = $('#fromDate').val();//計畫起訖日期-起
            var toDate = $('#toDate').val();//計畫起訖日期-訖
            var selectStatus = $('#selectStatus').val();//狀態

            //所別
            if(selectResearch == "none"){
                selectResearch = "";
            }
            else if(selectResearch == "abrc"){
                selectResearch = "農業生物科技研究中心";
            }
            else if(selectResearch == "ipmb"){
                selectResearch = "植物暨微生物學研究所";
            }
            else if(selectResearch == "icob"){
                selectResearch = "細胞與個體生物學研究所";
            }
            else if(selectResearch == "il"){
                selectResearch = "語言學研究所";
            }
            else if(selectResearch == "ibs"){
                selectResearch = "生物醫學科學研究所";
            }

            //狀態
            if(selectStatus == "none"){
                selectStatus = "";
            }
            else if(selectStatus == "newcase"){
                selectStatus = "新案申請中";
            }
            else if(selectStatus == "planning"){
                selectStatus = "計畫執行中";
            }
            else if(selectStatus == "planclosed"){
                selectStatus = "計畫已結束";
            }
            else if(selectStatus == "planfailed"){
                selectStatus = "計劃不成立";
            }

            var condition = "";
            condition += "where proj_name like '%" + projectName + "%' ";
            condition += "and txtSchool like '%" + selectResearch + "%' ";
            condition += "and txtAppName like '%" + projectHost + "%' ";
            condition += "and txtReviewNo like '%" + projectNum + "%' ";
            //condition += "and ??? between '" + fromDate + "' and '" + toDate + "'";//計畫起訖日期
            //condition += "and ??? = '" + selectStatus + "'";//狀態
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageProtocol/" + username;
            console.log(condition);

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('manageProtocol.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });

        });

        //重設
        $('.btn-clear').on('click',function(e){
            $('#projectName').val("");//計畫名稱
            $('#selectResearch').val("none");//所別
            $('#projectHost').val("");//計畫主持人
            $('#projectNum').val("");//iIRB No.或流水編號
            $('#fromDate').val("");//計畫起訖日期-起
            $('#toDate').val("");//計畫起訖日期-訖
            $('#selectStatus').val("none");//狀態
        });

        //計劃名稱-內容
        function changePage(caseAppNo){
            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/projectContent/" + username;
            var condition = "where caseAppNo='" + caseAppNo+"'";
            console.log(condition)

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('projectContent.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });
        }

    </script>


</html>
