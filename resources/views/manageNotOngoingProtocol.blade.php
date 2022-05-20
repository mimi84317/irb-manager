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

        <title>管理未正進行的計劃</title>
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
                <p class="titleText">管理未正進行的計劃</p>
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
                                <td><input type="text" class="form-control" id="projectName" value=""></td>
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
                                    <select class="form-select" id="selectResearch">
                                        <option value="none" selected>請選擇</option>
                                        <option value="projectEnd">計畫已結束</option>
                                        <option value="projectFailed">計畫不成立</option>
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
                    <table  class="manageNotOngoingProtocolTable"
                            id="manageNotOngoingProtocolTable"
                            data-toggle="table"
                            data-pagination="true"
                            data-toolbar="#toolbar"
                            data-use-row-attr-func="true"
                            data-reorderable-rows="true">

                        <thead>
                            <tr>
                                <th data-field="chooseProject">選擇</th>
                                <th data-field="txtAppNo" data-sortable="true">流水編號</th>
                                <th data-field="txtReviewNo" data-sortable="true">iIRB No.</th>
                                <th data-field="proj_name" data-sortable="true">計劃名稱</th>
                                <th data-field="txtSchool" data-sortable="true">所別</th>
                                <th data-field="txtAppName" data-sortable="true">主持人</th>
                                <th data-field="Duration" data-sortable="true">研究起迄期間</th>
                                <th data-field="type" data-sortable="true">狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($projectList); $i++)
                                <tr>
                                    <th><input class="form-check-input require-checked" type="checkbox"></th>
                                    <th>{{ $projectList[$i]['txtAppNo'] }}</th>
                                    <th><a href="javascript:void(0)" onclick="changePage('{{ $projectList[$i]['caseAppNo'] }}')">{{ $projectList[$i]['txtReviewNo'] }}</a></th>
                                    <th>{{ $projectList[$i]['proj_name'] }}</th>
                                    <th>{{ $projectList[$i]['txtSchool'] }}</th>
                                    <th>{{ $projectList[$i]['txtAppName'] }}</th>
                                    <th>{{ $projectList[$i]['Duration_start'] }} ~ {{ $projectList[$i]['Duraton_end'] }}</th>
                                    <th>{{ $projectList[$i]['status'] }}</th>
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

        function openPostWindow(url, name, token, username, clientid, client_secret, user, condition, previousPage)
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
            hideInput7.name = "previousPage";
            hideInput7.value = previousPage;

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

        //查詢
        $('.btn-search').on('click',function(e){
            var selectCasetype = $('#selectCasetype').val();//案件類型
            var projectNum = $('#projectNum').val();//案件編號或案件流水編號
            var selectResearch = $('#selectResearch').val();//所別
            var projectHost = $('#projectHost').val();//計畫主持人
            var projectName = $('#projectName').val();//計畫名稱
            var reviewStatus = $('#reviewStatus').val();//審查狀態
            var fromDate = $('#fromDate').val();//計畫起訖日期-起
            var toDate = $('#toDate').val();//計畫起訖日期-訖

            //案件類型
            if(selectCasetype == "none"){
                selectCasetype = "";
            }
            else if(selectCasetype == "newcase"){
                selectCasetype = "新案審查";
            }
            else if(selectCasetype == "midcase"){
                selectCasetype = "期中審查";
            }
            else if(selectCasetype == "closedcase"){
                selectCasetype = "結案審查";
            }
            else if(selectCasetype == "fixcase"){
                selectCasetype = "修正審查";
            }
            else if(selectCasetype == "abnormalcase"){
                selectCasetype = "異常審查(院內)";
            }

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

            //審查狀態
            if(reviewStatus == "allStatus"){
                reviewStatus = "";
            }
            else if(reviewStatus == "review"){
                reviewStatus = "審查中";
            }
            else if(reviewStatus == "reviewPass"){
                reviewStatus = "審查通過";
            }
            else if(reviewStatus == "reviewFailed"){
                reviewStatus = "審查不通過";
            }
            else if(reviewStatus == "overdueCancellation"){
                reviewStatus = "逾期撤銷";
            }
            else if(reviewStatus == "reviewCancel"){
                reviewStatus = "審查取消(撤案)";
            }
            else if(reviewStatus == "disagree"){
                reviewStatus = "所長不同意";
            }

            var condition = "";
            //condition += "where ??? like '%" + selectCasetype + "%' ";//案件類型
            condition += "where txtReviewNo like '%" + projectNum + "%' ";//案件編號或案件流水編號
            condition += "and txtSchool like '%" + selectResearch + "%' ";//所別
            condition += "and txtAppName like '%" + projectHost + "%' ";//計畫主持人
            condition += "and proj_name like '%" + projectName + "%' ";//計畫名稱
            //condition += "and ??? like '%" + reviewStatus + "%' ";//審查狀態
            //condition += "and ??? between '" + fromDate + "' and '" + toDate + "'";//計畫起訖日期
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
            $('#selectCasetype').val("none");//案件類型
            $('#projectNum').val("");//案件編號或案件流水編號
            $('#selectResearch').val("none");//所別
            $('#projectHost').val("");//計畫主持人
            $('#projectName').val("");//計畫名稱
            $('input[name=reviewStatus]').attr('checked',false);//審查狀態
            $('#fromDate').val("");//計畫起訖日期-起
            $('#toDate').val("");//計畫起訖日期-訖
        });

        //案件編號-內容
        function changePage(caseAppNo){
            var loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/manageFlow/" + username;
            var condition = "where caseAppNo='" + caseAppNo + "'";
            var previousPage = "manageNotOngoingProtocol";

            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    openPostWindow("{{ route('projectContent.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition, previousPage);
                }
            });
        }

    </script>


</html>
