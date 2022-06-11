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

        <title>外部案件匯入</title>
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
                <p class="titleText">外部案件匯入</p>
            </div>
            <div class="col-12">
                <div>
                    <button type="button" class="btn btn-outline-primary btn-downloadExample">下載範例檔</button>
                </div>
                <br>
                <div class="text-danger font-weight-bold">
                    注意! CSV檔務必為UTF-8編碼
                </div>
                <div class="row">
                    <div class="col-sm">
                        <input class="form-control csvImport" type="file" name="files[]">
                    </div>
                    <div class="col-sm">
                        <button type="button" class="btn btn-outline-primary btn-csvImport">CSV檔匯入</button>
                    </div>
                </div>
                <div>
                    <table  class="projectImportTable"
                            id="projectImportTable"
                            data-toggle="table"
                            data-pagination="true"
                            data-toolbar="#toolbar"
                            data-use-row-attr-func="true"
                            data-reorderable-rows="true">

                        <thead>
                            <tr>
                                <th data-field="txtAppNo">計畫流水編號</th>
                                <th data-field="caseAppNo">案件流水編號</th>
                                <th data-field="txtReviewNo">iIRB No</th>
                                <th data-field="proj_name">計劃中文名稱</th>
                                <th data-field="proj_Ename">計劃英文名稱</th>
                                <th data-field="Duration_start">計劃起始日期</th>
                                <th data-field="Duraton_end">計劃結束日期</th>
                                <th data-field="txtAppName">計劃主持人單位中文名稱</th>
                                <th data-field="txtAppEName">計劃主持人單位英文名稱</th>
                                <th data-field="txtAppSSO">計劃主持人SSO</th>
                                <th data-field="txtSchool">計劃主持人單位</th>
                                <th data-field="JobTitle">計劃主持人職稱</th>
                                <th data-field="txtAppTel">計劃主持人電話</th>
                                <th data-field="txtAppEmail">計劃主持人Email</th>
                                <th data-field="committee">委員會</th>
                                <th data-field="reviewPassedDate">審查通過日期</th>
                                <th data-field="reviewFrequency">審查頻率(每季一次/半年一次/一年一次/其它)</th>
                                <th data-field="midcaseDate">期中審查預定日(以逗號分隔)</th>
                                <th data-field="endcaseDate">結案審查預定日</th>
                                <th data-field="midcaseTimes">已完成期中審查次數</th>
                                <th data-field="merge">申請表檔名</th>
                                <th data-field="proof_of_acceptance">通過證明檔名</th>
                                <th data-field="remark">備註</th>
                                <th data-field="test">主審的姓名與Email(請以,分隔)</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-success btn-addlist">新增一筆資料</button>
                </div>
            </div>
            <br>
            <div>
                <button type="button" class="btn btn-outline-secondary btn-uploadProject">上傳匯入案件</button>
            </div>
            <div id="dvCSV">
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

        //匯入CSV
        $('.btn-csvImport').on('click',function(e){
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv)$/;
            if (regex.test($(".csvImport").val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var table = $("<table />");
                        var rows = e.target.result.split("\n");
                        for (var i = 0; i < rows.length; i++) {
                            var row = $("<tr />");
                            var cells = rows[i].split(",");
                            if (cells.length > 1) {
                                for (var j = 0; j < cells.length; j++) {
                                    var cell = $("<td />");
                                    cell.html(cells[j]);
                                    row.append(cell);
                                }
                                table.append(row);
                            }
                        }
                        $("#dvCSV").html('');
                        $("#dvCSV").append(table);
                        }
                        reader.readAsText($(".csvImport")[0].files[0]);
                    } else {
                        alert("This browser does not support HTML5.");
                    }
                } else {
                    alert("Please upload a valid CSV file.");
                }
        });

        //新增清單
        $('.btn-addlist').on('click', function(){
            //刪除No matching records found
            var row = $('.no-records-found');
            row.remove();

            var newrow = '';
            newrow += '<tr>';
            newrow += '<td class="row-txtAppNo"><input type="text" class="form-control txtAppNo-value" value=""></td>';
            newrow += '<td class="row-caseAppNo"><input type="text" class="form-control caseAppNo-value" value=""></td>';
            newrow += '<td class="row-txtReviewNo"><input type="text" class="form-control txtReviewNo-value" value=""></td>';
            newrow += '<td class="row-proj_name"><input type="text" class="form-control proj_name-value" value=""></td>';
            newrow += '<td class="row-proj_Ename"><input type="text" class="form-control proj_Ename-value" value=""></td>';
            newrow += '<td class="row-Duration_start"><input type="text" class="form-control Duration_start-value" value=""></td>';
            newrow += '<td class="row-Duraton_end"><input type="text" class="form-control Duraton_end-value" value=""></td>';
            newrow += '<td class="row-txtAppName"><input type="text" class="form-control txtAppName-value" value=""></td>';
            newrow += '<td class="row-txtAppEName"><input type="text" class="form-control txtAppEName-value" value=""></td>';
            newrow += '<td class="row-txtAppSSO"><input type="text" class="form-control txtAppSSO-value" value=""></td>';
            newrow += '<td class="row-txtSchool"><input type="text" class="form-control txtSchool-value" value=""></td>';
            newrow += '<td class="row-JobTitle"><input type="text" class="form-control JobTitle-value" value=""></td>';
            newrow += '<td class="row-txtAppTel"><input type="text" class="form-control txtAppTel-value" value=""></td>';
            newrow += '<td class="row-txtAppEmail"><input type="text" class="form-control txtAppEmail-value" value=""></td>';
            newrow += '<td class="row-committee"><input type="text" class="form-control committee-value" value=""></td>';
            newrow += '<td class="row-reviewPassedDate"><input type="text" class="form-control reviewPassedDate-value" value=""></td>';
            newrow += '<td class="row-reviewFrequency"><input type="text" class="form-control reviewFrequency-value" value=""></td>';
            newrow += '<td class="row-midcaseDate"><input type="text" class="form-control midcaseDate-value" value=""></td>';
            newrow += '<td class="row-endcaseDate"><input type="text" class="form-control endcaseDate-value" value=""></td>';
            newrow += '<td class="row-midcaseTimes"><input type="text" class="form-control midcaseTimes-value" value=""></td>';
            newrow += '<td class="row-merge"><input class="form-control merge" type="file" name="mergeFiles[]"></td>';
            newrow += '<td class="row-proof_of_acceptance"><input class="form-control proof_of_acceptance" type="file" name="proofFiles[]"></td>';
            newrow += '<td class="row-remark"><input type="text" class="form-control remark-value" value=""></td>';
            newrow += '<td class="row-test"><input type="text" class="form-control test-value" value=""></td>';
            newrow += "</tr>";
            $('.projectImportTable').append(newrow);
        });


    </script>


</html>
