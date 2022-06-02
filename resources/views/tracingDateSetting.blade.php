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

        <title>設定追蹤審查預定日</title>
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

        <!--table需要-->
        <!--<script src="https://cdn.jsdelivr.net/npm/tablednd@1.0.5/dist/jquery.tablednd.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">-->
        <!--<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">-->
        <link href="{{ asset('js/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">
        <!--<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>-->
        <script src="{{ asset('js/bootstrap-table/bootstrap-table.min.js') }}"></script>
        <!---->

        <!--datepicker需要-->
        <!--<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
        <script src="{{ asset('js/datepicker/bootstrap.min.js') }}"></script>
        <!--<script type='text/javascript' src='//code.jquery.com/jquery-1.8.3.js'></script>-->
        <!--<script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <script src="{{ asset('js/datepicker/jquery.min.js') }}"></script>
        <!--<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>-->
        <script type='text/javascript' src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
        <!---->

        <!--modal需要-->
        <!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>-->
        <!--<script src="{{ asset('js/modal/jquery.slim.min.js') }}"></script>-->
        <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>-->
        <script src="{{ asset('js/modal/popper.min.js') }}"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>-->
        <script src="{{ asset('js/modal/bootstrap.bundle.min.js') }}"></script>
        <!---->

        <div class="container">
            <form method="POST" enctype="multipart/form-data" id="ajax-data-update" action="javascript:void(0)">
                <div class="col-form-label">
                    <p class="titleText">設定追蹤審查預定日</p>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">基本資料</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>計畫流水編號</th>
                                        <td>{{ $project[0]['txtAppNo'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>計畫名稱</th>
                                        <td>{{ $project[0]['proj_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>iIRB No</th>
                                        <td>{{ $project[0]['txtReviewNo'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>計畫主持人</th>
                                        <td>{{ $project[0]['txtAppName'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>計畫起訖日</th>
                                        <td>{{ $project[0]['Duration_start'] }} ~ {{ $project[0]['Duraton_end'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>其他計畫編號:</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>送審文件附件清單</th>
                                        <td>送審文件附件清單</td>
                                    </tr>
                                    <tr>
                                        <th>審查意見往返紀錄</th>
                                        <td>審查意見往返紀錄</td>
                                    </tr>
                                    <tr>
                                        <th>計畫資訊</th>
                                        <td><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#projectInfo">查看</button></td>
                                    </tr>
                                    <tr>
                                        <th>相關文件和備註</th>
                                        <td><button type="button" class="btn btn-outline-primary btn-projectRemark">相關文件和備註</button></td>
                                    </tr>
                                    @if ($project[0]['isImport'] == "true")
                                    <tr>
                                        <th>是否為匯入案件</th>
                                        <td>是</td>
                                    </tr>
                                    <tr>
                                        <th>匯入人</th>
                                        <td>{{ $project[0]['Import'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>匯入日期</th>
                                        <td>{{ $project[0]['ImportDate'] }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">案件類別</th>
                                        <th scope="col">通過日期</th>
                                        <th scope="col">審查頻率</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{ $project[0]['auditType'] }}</th>
                                        <th>{{ $project[0]['passDate'] }}</th>
                                        <th>{{ $project[0]['frequency'] }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            管理追蹤審查預定日
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered auditTable">
                                <thead>
                                    <tr>
                                        <th class="d-none">id</th>
                                        <th data-field="status">案件類別</th>
                                        <th data-field="description">說明</th>
                                        <th data-field="tracingDateStart">預定送審日期</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < count($tracinglist); $i++)
                                        <tr>
                                            <td class="row-id d-none">{{ $tracinglist[$i]['Id'] }}</td>
                                            <td class="row-status">{{ $tracinglist[$i]['status'] }}</td>
                                            <td class="row-description"><input type="text" class="input form-control description-value" value="{{ $tracinglist[$i]['description'] }}"></td>
                                            <td class="row-tracingDateStart"><input type="text" class="input form-control tracingDateStart-value" value="{{ $tracinglist[$i]['tracingDateStart'] }}"></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-success btn-addlist">新增追蹤審查預定日</button>
                        </div>
                    </div>
                </div>
                <br>
                <button type="sumbit" class="btn btn-outline-primary btn-update">更新</button>
                <button type="button" class="btn btn-outline-primary btn-back">返回上一頁</button>
            </form>
        </div>
        <!--------Modal------->
        <!--計畫資訊-->
        <div class="modal fade" id="projectInfo">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="subjectText">計畫資訊</p>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <th>計畫中文名稱</th>
                                    <td>{{ $project[0]['proj_name'] }}</td>
                                </tr>
                                <tr>
                                    <th>計畫英文名稱</th>
                                    <td>{{ $project[0]['proj_Ename'] }}</td>
                                </tr>
                                <tr>
                                    <th>總主持人中文姓名</th>
                                    <td>{{ $project[0]['txtAppName'] }}</td>
                                </tr>
                                <tr>
                                    <th>總主持人英文姓名</th>
                                    <td>{{ $project[0]['txtAppEName'] }}</td>
                                </tr>
                                <tr>
                                    <th>總主持人單位</th>
                                    <td>{{ $project[0]['txtSchool'] }}</td>
                                </tr>
                                <tr>
                                    <th>總主持人職稱</th>
                                    <td>{{ $project[0]['JobTitle'] }}</td>
                                </tr>
                                <tr>
                                    <th>總主持人電話</th>
                                    <td>{{ $project[0]['txtAppTel'] }}</td>
                                </tr>
                                <tr>
                                    <th>總主持人Email</th>
                                    <td>{{ $project[0]['txtAppEmail'] }}</td>
                                </tr>
                                <tr>
                                    <th>預計研究起始日</th>
                                    <td>{{ $project[0]['Duration_start'] }}</td>
                                </tr>
                                <tr>
                                    <th>預計研究結束日</th>
                                    <td>{{ $project[0]['Duraton_end'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!---->
    </body>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script>
        var username = "{{ app('request')->input('username') }}";
        var clientid = "{{ app('request')->input('clientid') }}";
        var client_secret = "{{ app('request')->input('client_secret') }}";
        var user = "{{ app('request')->input('user') }}";

        function openPostWindow(url, name, token, username, clientid, client_secret, user, proj_name, txtAppName, txtAppNo, previousPage)
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
            hideInput6.name = "proj_name";
            hideInput6.value = proj_name;

            var hideInput7 = document.createElement("input");
            hideInput7.type = "hidden";
            hideInput7.name = "txtAppName";
            hideInput7.value = txtAppName;

            var hideInput8 = document.createElement("input");
            hideInput8.type = "hidden";
            hideInput8.name = "txtAppNo";
            hideInput8.value = txtAppNo;

            var hideInput9 = document.createElement("input");
            hideInput9.type = "hidden";
            hideInput9.name = "previousPage";
            hideInput9.value = previousPage;

            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            tempForm.appendChild(hideInput4);
            tempForm.appendChild(hideInput5);
            tempForm.appendChild(hideInput6);
            tempForm.appendChild(hideInput7);
            tempForm.appendChild(hideInput8);
            tempForm.appendChild(hideInput9);

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
            $('.tracingDateStart-value').datepicker({
                autoclose: true,
                format: "yyyy/mm/dd",
            });
        });

        //相關文件和備註
        $('.btn-projectRemark').on('click',function(e){
            var proj_name = "{{ $project[0]['proj_name'] }}";
            var txtAppName = "{{ $project[0]['txtAppName'] }}";
            var txtAppNo = "{{ $project[0]['txtAppNo'] }}";
            var previousPage = "projectContent";

            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/projectRemark/" + username;
            //console.log(loginURL);
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('projectRemark.post') }}", "", data["access_token"], username, clientid, client_secret, user, proj_name, txtAppName, txtAppNo, previousPage);
                }
            });
        });

        //送審文件下載最新版+收件證明
        $('.auditTable').on('click', '.btn-download', function(){
            var btnValue = $(this).val();

            var row = $(this).parents('tr:first');
            var memID = row.children('.row-memID').text();
            var insID = row.children('.row-insID').text();
            var passID = memID + "+" + insID;
            var file = "";

            if(btnValue == "merge"){//送審文件下載最新版
                file = memID + "_" + insID + "_merge.pdf";
            }
            else if(btnValue == "proof_of_acceptance"){//收件證明
                file = "proof_of_acceptance.pdf";
            }

            condition = "";
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlowContent/" + username;
            //return 0;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    var url = "{{route('file.download',['case'=>'','passID'=>'', 'fileid'=>''])}}"+"/"+btnValue+"/"+passID+"/"+file+"?token="+data["access_token"];
                    window.open(url, "_blank");
                }
            });

        });

        //新增追蹤審查預定日
        $('.btn-addlist').on('click', function(){
            var newrow = '';
            newrow += '<tr>';
            newrow += '<td class="row-id d-none"></td>';
            newrow += '<td class="row-status">';
            newrow += '<select class="form-select selectStatus">';
            newrow += '<option value="none" selected>請選擇</option>';
            newrow += '<option value="midcase">期中審查</option>';
            newrow += '<option value="closedcase">結案審查</option>';
            newrow += '</select>';
            newrow += '</td>';
            newrow += '<td class="row-description"><input type="text" class="input form-control description-value" value=""></td>';
            newrow += '<td class="row-tracingDateStart"><input type="text" class="input form-control tracingDateStart-value" value=""></td>';
            newrow += "</tr>";
            $('.auditTable').append(newrow);

            $('.tracingDateStart-value').datepicker({
                autoclose: true,
                format: "yyyy/mm/dd",
            });
        });

        //更新
        $('#ajax-data-update').submit(function(e) {
            event.preventDefault();
            var auditTableLength = $('.auditTable tr').length;
            var tracingDatetUpdate = {};

            var formData = new FormData(this);

            var token = "{{ app('request')->input('token') }}";

            for(var i = 1; i < auditTableLength; i++){
                tracingDatetUpdate[i-1] = {};
                var id = $('.auditTable tr:eq('+i+')').children('.row-id').text();
                var status;
                var tracingDateStart = $('.auditTable tr:eq('+i+')').children('.row-tracingDateStart').children('.tracingDateStart-value').val();
                if(id == ""){
                    status = $('.auditTable tr:eq('+i+')').children('.row-status').children('.selectStatus').val();
                    if(status == "none"){
                        alert("請選擇案件類別");
                        return 0;
                    }
                    else if(status == "midcase"){
                        status = "期中審查";
                    }
                    else if(status == "closedcase"){
                        status = "結案審查";
                    }
                }
                else{
                    status = $('.auditTable tr:eq('+i+')').children('.row-status').text();
                }
                if(tracingDateStart == ""){
                    alert("請選擇預定送審日期");
                    return 0;
                }
                else{
                    tracingDatetUpdate[i-1]['Id'] = id;
                    tracingDatetUpdate[i-1]['tracingDateStart'] = tracingDateStart;
                    tracingDatetUpdate[i-1]['status'] = status;
                    tracingDatetUpdate[i-1]['description'] = $('.auditTable tr:eq('+i+')').children('.row-description').children('.description-value').val();
                    tracingDatetUpdate[i-1]['txtAppNo'] = "{{ $project[0]['txtAppNo'] }}";
                    tracingDatetUpdate[i-1]['txtReviewNo'] = "{{ $project[0]['txtReviewNo'] }}";
                    tracingDatetUpdate[i-1]['txtAppName'] = "{{ $project[0]['txtAppName'] }}";
                    tracingDatetUpdate[i-1]['Duration_start'] = "{{ $project[0]['Duration_start'] }}";
                    tracingDatetUpdate[i-1]['Duraton_end'] = "{{ $project[0]['Duraton_end'] }}";
                    tracingDatetUpdate[i-1]['tracingSumbit'] = "N";
                }
            }
            console.log(tracingDatetUpdate);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method:'post',
                url:"{{ route('tracingDateSetting.update') }}",
                data: {tracingDatetUpdate:tracingDatetUpdate, token:token},
                success:function(data){
                    console.log(data);
                    if(data != 0){
                        alert("更新失敗，請洽系統管理員");
                    }
                    else{
                        alert("更新成功");
                        condition = "";
                        loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageProtocol/" + username;
                        $.ajax({
                            method:'post',
                            url:loginURL,
                            data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                            success:function(data){
                                openPostWindow("{{ route('manageProtocol.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                            }
                        });
                    }
                }
            });
        });

        //返回上一頁
        $('.btn-back').on('click',function(e){
            var proj_name = "";
            var txtAppName = "";
            var txtAppNo = "";
            var previousPage = "";

            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageProtocol/" + username;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('manageProtocol.post') }}", "", data["access_token"], username, clientid, client_secret, user, proj_name, txtAppName, txtAppNo, previousPage);
                }
            });
        });

    </script>
</html>
