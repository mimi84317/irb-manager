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
                                        <option value="iclp">中國文哲研究所 Institute of Chinese Literature and Philosophy</option>
                                        <option value="rchss">人文社會科學研究中心 Research Center for Humanities and Social Sciences</option>
                                        <option value="imb">分子生物研究所 Institute of Molecular Biology</option>
                                        <option value="ic">化學研究所 Institute of Chemistry</option>
                                        <option value="iams">原子與分子科學研究所 Institute of Atomic and Molecular Sciences</option>
                                        <option value="ith">台灣史研究所 Institute of Taiwan History</option>
                                        <option value="ies">地球科學研究所 Institute of Earth Sciences</option>
                                        <option value="grc">基因體研究中心 Genomics Research Center</option>
                                        <option value="iaa">天文及天文物理研究所 Institute of Astronomy and Astrophysics</option>
                                        <option value="rcas">應用科學研究中心 Research Center for Applied Sciences</option>
                                        <option value="ips">政治學研究所 Institute of Political Science</option>
                                        <option value="im">數學研究所 Institute of Mathematics</option>
                                        <option value="ipmb">植物暨微生物學研究所 Institute of Plant and Microbial Biology</option>
                                        <option value="ieas">歐美研究所 Institute of European and American Studies</option>
                                        <option value="iethnology">民族學研究所 Institute of Ethnology</option>
                                        <option value="ii">法律學研究所 Institutum Iurisprudentiae</option>
                                        <option value="ip">物理研究所 Institute of Physics</option>
                                        <option value="rcec">環境變遷研究中心 Research Center for Environmental Changes</option>
                                        <option value="ibc">生物化學研究所 Institute of Biological Chemistry</option>
                                        <option value="brc">生物多樣性研究中心 Biodiversity Research Center</option>
                                        <option value="ibs">生物醫學科學研究所 Institute of Biomedical Sciences</option>
                                        <option value="is">社會學研究所 Institute of Sociology</option>
                                        <option value="icob">細胞與個體生物學研究所 Institute of Cellular and Organismic Biology</option>
                                        <option value="iss">統計科學研究所 Institute of Statistical Science</option>
                                        <option value="ieconomics">經濟研究所 Institute of Economics</option>
                                        <option value="il">語言學研究所 Institute of Linguistics</option>
                                        <option value="iis">資訊科學研究所 Institute of Information Science</option>
                                        <option value="rciti">資訊科技創新研究中心 Research Center for Information Technology Innovation</option>
                                        <option value="abrc">農業生物科技研究中心 Agricultural Biotechnology Research Center/option>
                                        <option value="imh">近代史研究所 Institute of Modern History</option>
                                        <option value="btrc">生醫轉譯研究中心 Biomedical Translation Research Center</option>
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
                                <th>設定追蹤審查預定日*(IRB行政人員設定)</th>
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
                                    <th>
                                        @if ($projectList[$i]['caseState'] == "計畫執行中")
                                            <button class="btn btn-outline-success btn-tracingDateSetting" type="button">設定</button>
                                        @endif
                                    </th>
                                    <th>{{ $projectList[$i]['caseState'] }}</th>
                                    <th class="row-txtOtherNo">
                                        <div class="input-group">
                                            <input type="text" class="form-control txtOtherNo" value="{{ $projectList[$i]['txtOtherNo'] }}" readonly>
                                            <div class="input-group-append">
                                                <!--<button class="btn btn-outline-secondary btn-settxtOtherNo" type="button"><i class="button-icon fas fa-pen"></i></button>-->
                                                <button class="btn btn-outline-secondary btn-setting" type="button" value="btn-txtOtherNo"><i class="button-icon fas fa-pen"></i></button>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        @if ($projectList[$i]['isImport'] == "true")
                                            是
                                        @elseif ($projectList[$i]['isImport'] == "false")
                                            否
                                        @endif
                                    </th>
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
                autoclose: true,
                format: "yyyy/mm/dd",
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
            switch(selectResearch){
                case 'none':
                    selectResearch = "";
                    break;
                case 'iclp':
                    selectResearch = "中國文哲研究所";
                    break;
                case 'rchss':
                    selectResearch = "人文社會科學研究中心";
                    break;
                case 'imb':
                    selectResearch = "分子生物研究所";
                    break;
                case 'ic':
                    selectResearch = "化學研究所";
                    break;
                case 'iams':
                    selectResearch = "原子與分子科學研究所";
                    break;
                case 'ith':
                    selectResearch = "台灣史研究所";
                    break;
                case 'ies':
                    selectResearch = "地球科學研究所";
                    break;
                case 'grc':
                    selectResearch = "基因體研究中心";
                    break;
                case 'iaa':
                    selectResearch = "天文及天文物理研究所";
                    break;
                case 'rcas':
                    selectResearch = "應用科學研究中心";
                    break;
                case 'ips':
                    selectResearch = "政治學研究所";
                    break;
                case 'im':
                    selectResearch = "數學研究所";
                    break;
                case 'ipmb':
                    selectResearch = "植物暨微生物學研究所";
                    break;
                case 'ieas':
                    selectResearch = "歐美研究所";
                    break;
                case 'iethnology':
                    selectResearch = "民族學研究所";
                    break;
                case 'ii':
                    selectResearch = "法律學研究所";
                    break;
                case 'ip':
                    selectResearch = "物理研究所";
                    break;
                case 'rcec':
                    selectResearch = "環境變遷研究中心";
                    break;
                case 'ibc':
                    selectResearch = "生物化學研究所";
                    break;
                case 'brc':
                    selectResearch = "生物多樣性研究中心";
                    break;
                case 'ibs':
                    selectResearch = "生物醫學科學研究所";
                    break;
                case 'is':
                    selectResearch = "社會學研究所";
                    break;
                case 'icob':
                    selectResearch = "細胞與個體生物學研究所";
                    break;
                case 'iss':
                    selectResearch = "統計科學研究所";
                    break;
                case 'ieconomics':
                    selectResearch = "經濟研究所";
                    break;
                case 'il':
                    selectResearch = "語言學研究所";
                    break;
                case 'iis':
                    selectResearch = "資訊科學研究所";
                    break;
                case 'rciti':
                    selectResearch = "資訊科技創新研究中心";
                    break;
                case 'abrc':
                    selectResearch = "農業生物科技研究中心";
                    break;
                case 'imh':
                    selectResearch = "近代史研究所";
                    break;
                case 'btrc':
                    selectResearch = "生醫轉譯研究中心";
                    break;
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
            if(fromDate != ""){
                condition += "and Duration_start > '" + fromDate + "' ";//計畫起訖日期
            }
            if(toDate != ""){
                condition += "and Duraton_end < '" + toDate + "' ";//計畫起訖日期
            }
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

        //設定追蹤審查預定日*(IRB行政人員設定)
        $('.manageProtocolTable').on('click', '.btn-tracingDateSetting',function(e){
            var row = $(this).parents('tr:first');
            var txtAppNo = row.children('.row-txtAppNo').text();

            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/tracingDateSetting/" + username;
            var condition = "where txtAppNo='" + txtAppNo+"'";
            console.log(condition);

            //return 0;
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('tracingDateSetting.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                }
            });
        });

    </script>


</html>
