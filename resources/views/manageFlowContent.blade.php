<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>

        <title>審核案件內容</title>
        <style>
            .titleText {
                color: #000093;
                text-align: left;
                font-weight: bold;
                font-size: 30px;
            }
            .subjectText{
                color: #000093;
                text-align: left;
                font-weight: bold;
                font-size: 24px;
            }
        </style>
    </head>
    <body>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <script src="{{ asset('js/jquery.min.js') }}"></script>

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
                <p class="titleText">審核案件內容</p>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">案件資料</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>案件類型</th>
                                    <td>{{ $content[0]['auditType'] }}</td>
                                    <th>審查委員會</th>
                                    <td>{{ $content[0]['committee'] }}</td>
                                    <th>審核紀錄</th>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#auditRecord">審核紀錄</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>案件編號</th>
                                    <td>{{ $content[0]['txtReviewNo'] }}</td>
                                    <th>審查類型</th>
                                    <td>{{ $content[0]['formType'] }}</td>
                                    <th>審查紀錄</th>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#reviewRecord">通過審查紀錄</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>案件流水編號</th>
                                    <td>{{ $content[0]['caseAppNo'] }}</td>
                                    <th>所別</th>
                                    <td>{{ $content[0]['txtSchool'] }}</td>
                                    <th>相關文件和備註</th>
                                    <td>相關文件和備註</td>
                                </tr>
                                <tr>
                                    <th>計畫名稱</th>
                                    <td>{{ $content[0]['proj_name'] }}</td>
                                    <th>計畫起訖日</th>
                                    <td>{{ $content[0]['Duration_start'] }} ~ {{ $content[0]['Duraton_end'] }}</td>
                                    <th>審查意見往返紀錄</th>
                                    <td>審查意見往返紀錄</td>
                                </tr>
                                <tr>
                                    <th>計畫主持人</th>
                                    <td>{{ $content[0]['txtAppName'] }}</td>
                                    <th>送審文件紀錄</th>
                                    <td>下載送審文件紀錄</td>
                                    <th>送審附件清單</th>
                                    <td>送審文件附件清單</td>
                                </tr>
                                <tr>
                                    <th>計劃流水編號</th>
                                    <th class="row-txtReviewNo"><a href="javascript:void(0)" onclick="changePage('{{ $content[0]['caseAppNo'] }}')">{{ $content[0]['txtAppNo'] }}</a></th>
                                    <th>送審文件</th>
                                    <td>下載最新版</td>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">會議記錄清單</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>委員會名稱</th>
                                <th>會議名稱</th>
                                <th>會議日期</th>
                                <th>會議備註</th>
                                <th>會議記錄</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">繳費紀錄</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>支票</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>下載收件證明</td>
                                    <td>下載收件證明</td>
                                </tr>
                                <tr>
                                    <td>下載審查結果證明</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>下載網路版審查結果</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>委員會撤銷審查</td>
                                    <td>啟動逾期撤銷</td>
                                </tr>
                                <tr>
                                    <td>申請人取消審查(撤案)</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>設定審查期限</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div>
                <button type="button" class="btn btn-outline-primary btn-back">返回瀏覽全部審查案</button>
            </div>
        </div>

        <!--------Modal------->
        <!--審核紀錄-->
        <div class="modal fade" id="auditRecord">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="subjectText">審核紀錄</p>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>步驟</th>
                                <th>審查流程</th>
                                <th>審核階段</th>
                                <th>處理動作</th>
                                <th>備註欄</th>
                                <th>建立者</th>
                                <th>操作日期</th>
                                <th>處理時間(天數)</th>
                                <th>文件</th>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($record); $i++)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td></td>
                                        <td>{{ $record[$i]['stage'] }}</td>
                                        <td>{{ $record[$i]['action'] }}</td>
                                        <td>{{ $record[$i]['comment'] }}</td>
                                        <td>{{ $record[$i]['executor'] }}</td>
                                        <td>{{ $record[$i]['operation_time'] }}</td>
                                        <td>{{ $record[$i]['days'] }}</td>
                                        <td></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!---->
        <!--審查紀錄-->
        <div class="modal fade" id="reviewRecord">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="subjectText">通過審查紀錄</p>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>審查案類型</th>
                                <th>送件日期</th>
                                <th>通過審查文件下載</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!---->
        <!--送審文件紀錄-->
        <!---->
        <!--審查意見往返紀錄-->
        <!---->
        <!--送審附件清單:-->
        <!---->
        <!-------------------->
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

        //案件編號-內容
        function changePage(caseAppNo){
            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlowContent/" + username;
            var condition = "where caseAppNo='" + caseAppNo + "'";
            console.log(condition);

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('projectContent.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });
        }

        //返回瀏覽全部審查案
        $('.btn-back').on('click',function(e){
            loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlow/" + username;
            //console.log(loginURL);
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('manageFlow.post') }}", "", data["access_token"], username, clientid, client_secret, user);
                }
            });
        });

    </script>
</html>
