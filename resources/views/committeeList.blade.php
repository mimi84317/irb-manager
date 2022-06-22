<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>


        <title>討論案件清單</title>
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
                <p class="titleText">會議名稱: {{ app('request')->input('committeeName') }}</p>
            </div>
            <div class="">
                會議說明: {{ app('request')->input('committeeName') }}
            </div>
            <div>
                <div>
                    <p class="subjectText">一、前次會議後至今完成之案件報告</p>
                    <div>
                        <p class="subjectText">(一)免審</p>
                    </div>
                    <div>
                        <div>
                            <div>
                                <p>1.新案審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>2.修正審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>3.追蹤審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="subjectText">(二)簡易審查</p>
                    </div>
                    <div>
                        <div>
                            <div>
                                <p>1.新案審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>2.修正審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>3.追蹤審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="subjectText">(三)一般審查</p>
                    </div>
                    <div>
                        <div>
                            <div>
                                <p>1.新案審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>2.修正審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>3.追蹤審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="subjectText">(四)撤銷審查案件</p>
                    </div>
                    <div>
                        <div>
                            <div>
                                <p>1.新案審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>2.修正審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>3.追蹤審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="subjectText">(五)其它</p>
                    </div>
                    <div>
                        <div>
                            <div>
                                <p>1.新案審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>2.修正審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>3.追蹤審查</p>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">案件流水號</th>
                                            <th scope="col">類型</th>
                                            <th scope="col">編號</th>
                                            <th scope="col">收件日</th>
                                            <th scope="col">主持人</th>
                                            <th scope="col">單位</th>
                                            <th scope="col">計畫名稱</th>
                                            <th scope="col">經費來源</th>
                                            <th scope="col">研究計畫預定執行時間</th>
                                            <th scope="col">審核委員</th>
                                            <th scope="col">申請資料</th>
                                            <th scope="col">初審意見表</th>
                                            <th scope="col">複審意見表</th>
                                            <th scope="col">審查意見往返紀錄</th>
                                            <th scope="col">審查結果</th>
                                            <th scope="col">同意書/結果通知編號</th>
                                            <th scope="col">發函日期</th>
                                            <th scope="col">進度/成果報告應繳期限</th>
                                            <th scope="col">會議備註</th>
                                            <th scope="col">填寫會議記錄</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
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
                <div>
                    <div>
                        <p class="subjectText">二、本次會議審查案件</p>
                        <div>
                            <div>
                                <!--<div>
                                    <p>1.新案審查</p>
                                </div>-->
                                <div>
                                    <table  class="committeeListTable"
                                            id="committeeListTable"
                                            data-toggle="table"
                                            data-pagination="true"
                                            data-toolbar="#toolbar"
                                            data-use-row-attr-func="true"
                                            data-reorderable-rows="true">
                                        <thead>
                                            <tr>
                                                <th data-sortable="true">案件流水號</th>
                                                <th data-sortable="true">類型</th>
                                                <th data-sortable="true">編號</th>
                                                <th data-sortable="true">收件日</th>
                                                <th data-sortable="true">主持人</th>
                                                <th data-sortable="true">單位</th>
                                                <th data-sortable="true">計畫名稱</th>
                                                <th>經費來源</th>
                                                <th>研究計畫預定執行時間</th>
                                                <th>審核委員</th>
                                                <th>申請資料</th>
                                                <th>初審意見表</th>
                                                <th>複審意見表</th>
                                                <th>審查意見往返紀錄</th>
                                                <th>審查結果</th>
                                                <th>同意書/結果通知編號</th>
                                                <th>發函日期</th>
                                                <th>進度/成果報告應繳期限</th>
                                                <th>會議備註</th>
                                                <th>填寫會議記錄</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($i = 0; $i < count($list); $i++)
                                                <tr>
                                                    <td>{{ $list[$i]['caseAppNo'] }}</td>
                                                    <td>{{ $list[$i]['auditType'] }}</td>
                                                    <td>{{ $list[$i]['txtReviewNo'] }}</td>
                                                    <td>{{ $list[$i]['apply_time'] }}</td>
                                                    <td>{{ $list[$i]['txtAppName'] }}</td>
                                                    <td>{{ $list[$i]['txtSchool'] }}</td>
                                                    <td>{{ $list[$i]['proj_name'] }}</td>
                                                    <td>
                                                        @if ($list[$i]['inFunds'] == "true")
                                                            院內 : {{ $list[$i]['inFunds_1'] }} <br>
                                                        @endif
                                                        @if ($list[$i]['outFunds'] == "true")
                                                            院外 : {{ $list[$i]['outFunds_1'] }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $list[$i]['Duration_start'] }} ~ {{ $list[$i]['Duraton_end'] }}</td>
                                                    <td>??</td>
                                                    <td>下載</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>審查意見往返紀錄</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <th class="committee-editRecord"><button type="button" class="btn btn-outline-primary btn-editRecord">會議記錄</th>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--<div>
                                <div>
                                    <p>2.修正審查</p>
                                </div>
                                <div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">案件流水號</th>
                                                <th scope="col">類型</th>
                                                <th scope="col">編號</th>
                                                <th scope="col">收件日</th>
                                                <th scope="col">主持人</th>
                                                <th scope="col">單位</th>
                                                <th scope="col">計畫名稱</th>
                                                <th scope="col">經費來源</th>
                                                <th scope="col">研究計畫預定執行時間</th>
                                                <th scope="col">審核委員</th>
                                                <th scope="col">申請資料</th>
                                                <th scope="col">初審意見表</th>
                                                <th scope="col">複審意見表</th>
                                                <th scope="col">審查意見往返紀錄</th>
                                                <th scope="col">須迴避機構</th>
                                                <th scope="col">會議備註</th>
                                                <th scope="col">填寫會議記錄</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <p>3.追蹤審查</p>
                                </div>
                                <div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">案件流水號</th>
                                                <th scope="col">類型</th>
                                                <th scope="col">編號</th>
                                                <th scope="col">收件日</th>
                                                <th scope="col">主持人</th>
                                                <th scope="col">單位</th>
                                                <th scope="col">計畫名稱</th>
                                                <th scope="col">經費來源</th>
                                                <th scope="col">研究計畫預定執行時間</th>
                                                <th scope="col">審核委員</th>
                                                <th scope="col">申請資料</th>
                                                <th scope="col">初審意見表</th>
                                                <th scope="col">複審意見表</th>
                                                <th scope="col">審查意見往返紀錄</th>
                                                <th scope="col">須迴避機構</th>
                                                <th scope="col">會議備註</th>
                                                <th scope="col">填寫會議記錄</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>-->
                         </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-outline-primary btn-back">返回上一頁</button>
            </div>
        </div>
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
            tempForm.submit();

            document.body.removeChild(tempForm);
        }

        //會議記錄-編輯
        $('.committeeListTable').on('click', '.btn-editRecord',function(e){
            var row = $(this).parents('tr:first');
            var id = row.children('.row-id').html();

            var committeeType = "";
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
