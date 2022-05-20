<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>

        <title>計劃內容</title>
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

        <!--modal需要-->
        <!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>-->
        <script src="{{ asset('js/modal/jquery.slim.min.js') }}"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>-->
        <script src="{{ asset('js/modal/popper.min.js') }}"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>-->
        <script src="{{ asset('js/modal/bootstrap.bundle.min.js') }}"></script>
        <!---->

        <div class="container">
            <div class="col-form-label">
                <p class="titleText">計劃內容</p>
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
                        <div class="card">
                            <div class="card-header">追蹤審查預定日</div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件類別</th>
                                            <th scope="col">說明</th>
                                            <th scope="col">預定送審日期</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        審核案件清單
                    </div>
                    <div class="card-body">
                        <table  class="auditTable"
                                id="auditTable"
                                data-toggle="table"
                                data-pagination="true"
                                data-toolbar="#toolbar"
                                data-use-row-attr-func="true"
                                data-reorderable-rows="true">

                            <thead>
                                <tr>
                                    <th data-field="insID" class="d-none">insID</th>
                                    <th data-field="memID" class="d-none">memID</th>
                                    <th data-field="txtAppNo" data-sortable="true">案件流水編號</th>
                                    <th data-field="apply_time" data-sortable="true">送審日期</th>
                                    <th data-field="auditType" data-sortable="true">案件類型</th>
                                    <th data-field="txtReviewNo" data-sortable="true">案件編號</th>
                                    <th data-field="">追蹤案(新案)編號</th>
                                    <th data-field="formType" data-sortable="true">審查類型</th>
                                    <th data-field="txtAppName" data-sortable="true">送件人</th>
                                    <th data-sortable="true">案件狀態</th>
                                    <th data-sortable="true">審核階段</th>
                                    <th >收件證明</th>
                                    <th>審查結果</th>
                                    <th>送審文件核准版</th>
                                    <th>送審文件下載</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($projectList); $i++)
                                    <tr>
                                        <th class="row-insID" style="display:none">{{ $projectList[$i]['insID'] }}</th>
                                        <th class="row-memID" style="display:none">{{ $projectList[$i]['memID'] }}</th>
                                        <th>{{ $projectList[$i]['caseAppNo'] }}</th>
                                        <th>{{ $projectList[$i]['apply_time'] }}</th>
                                        <th>{{ $projectList[$i]['auditType'] }}</th>
                                        <th>{{ $projectList[$i]['txtReviewNo'] }}</th>
                                        <th></th>
                                        <th>{{ $projectList[$i]['formType'] }}</th>
                                        <th>{{ $projectList[$i]['txtAppName'] }}</th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <button type="button" class="btn btn-outline-primary btn-download" value="proof_of_acceptance"><i class="fas fa-download">下載</i></button>
                                        </th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <button type="button" class="btn btn-outline-primary btn-download" value="merge"><i class="fas fa-download">文件下載</i></button>
                                        </th>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-outline-primary btn-back">返回上一頁</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var username = "{{ app('request')->input('username') }}";
        var clientid = "{{ app('request')->input('clientid') }}";
        var client_secret = "{{ app('request')->input('client_secret') }}";
        var user = "{{ app('request')->input('user') }}";

        function openPostWindow(url, name, token, username, clientid, client_secret, user, proj_name, txtAppName, txtAppNo, previousPage, condition)
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

            var hideInput10 = document.createElement("input");
            hideInput10.type = "hidden";
            hideInput10.name = "condition";
            hideInput10.value = condition;

            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            tempForm.appendChild(hideInput4);
            tempForm.appendChild(hideInput5);
            tempForm.appendChild(hideInput6);
            tempForm.appendChild(hideInput7);
            tempForm.appendChild(hideInput8);
            tempForm.appendChild(hideInput9);
            tempForm.appendChild(hideInput10);

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


        //相關文件和備註
        $('.btn-projectRemark').on('click',function(e){
            var proj_name = "{{ $project[0]['proj_name'] }}";
            var txtAppName = "{{ $project[0]['txtAppName'] }}";
            var txtAppNo = "{{ $project[0]['txtAppNo'] }}";
            var previousPage = "projectContent";
            var condition = "";

            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/projectRemark/" + username;
            //console.log(loginURL);
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('projectRemark.post') }}", "", data["access_token"], username, clientid, client_secret, user, proj_name, txtAppName, txtAppNo, previousPage, condition);
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

        //返回上一頁
        $('.btn-back').on('click',function(e){
            var proj_name = "";
            var txtAppName = "";
            var txtAppNo = "";
            var previousPage = "{{ app('request')->input('previousPage') }}";
            var condition = "";
            var loginURL = "";
            var route = "";
            console.log(previousPage);

            if(previousPage == "manageFlow"){//瀏覽全部審查案
                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlow/" + username;
                route = "{{ route('manageFlow.post') }}";
            }
            else if(previousPage == "manageFlowContent"){//審核案件內容
                var txtAppNo = "{{ $project[0]['txtAppNo'] }}";
                condition = "where txtAppNo='" + txtAppNo + "'";

                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlowContent/" + username;
                route = "{{ route('manageFlowContent.post') }}";
            }
            else if(previousPage == "manageProtocol"){//管理全部計畫與追蹤審查預定日
                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageProtocol/" + username;
                route = "{{ route('manageProtocol.post') }}";
            }
            else if(previousPage == "manageNotOngoingProtocol"){//管理未正進行計畫
                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageNotOngoingProtocol/" + username;
                route = "{{ route('manageNotOngoingProtocol.post') }}";
            }

            //return 0;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow(route, "", data["access_token"], username, clientid, client_secret, user, proj_name, txtAppName, txtAppNo, previousPage, condition);
                }
            });
        });

    </script>
</html>
