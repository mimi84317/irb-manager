<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>
        <title>設定案件上傳清單</title>
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
        <div class="container">
            <div class="col-form-label">
                <p class="titleText">設定案件上傳清單</p>
            </div>
            <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">案件類型</th>
                            <th scope="col">建立/修改日期</th>
                            <th scope="col">清單列表描述</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>新案審查</td>
                            <td>{{ $modifiedDateList[0]['modified_date'] }}</td>
                            <td>
                                @foreach($newFilelist as $newFile)
                                    {{ $newFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><a class="btn btn-outline-primary" href="{{ route('fileuploadlist.setting', ['caseType' => 'newcase']) }}" role="button">編輯</a></td>
                        </tr>
                        <tr>
                            <td>期中審查</td>
                            <td>{{ $modifiedDateList[1]['modified_date'] }}</td>
                            <td>
                                @foreach($midFilelist as $midFile)
                                    {{ $midFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><a class="btn btn-outline-primary" href="{{ route('fileuploadlist.setting', ['caseType' => 'midcase']) }}" role="button">編輯</a></td>
                        </tr>
                        <tr>
                            <td>結案審查</td>
                            <td>{{ $modifiedDateList[2]['modified_date'] }}</td>
                            <td>
                                @foreach($closedFilelist as $closedFile)
                                    {{ $closedFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><a class="btn btn-outline-primary" href="{{ route('fileuploadlist.setting', ['caseType' => 'closedcase']) }}" role="button">編輯</a></td>
                        </tr>
                        <tr>
                            <td>修正審查</td>
                            <td>{{ $modifiedDateList[3]['modified_date'] }}</td>
                            <td>
                                @foreach($fixFilelist as $fixFile)
                                    {{ $fixFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><a class="btn btn-outline-primary" href="{{ route('fileuploadlist.setting', ['caseType' => 'fixcase']) }}" role="button">編輯</a></td>
                        </tr>
                        <tr>
                            <td>異常審查(院內)</td>
                            <td>{{ $modifiedDateList[4]['modified_date'] }}</td>
                            <td>
                                @foreach($abnormalFilelist as $abnormalFile)
                                    {{ $abnormalFile['chname'] }}<br>
                                @endforeach
                            </td>
                            <td><a class="btn btn-outline-primary" href="{{ route('fileuploadlist.setting', ['caseType' => 'abnormalcase']) }}" role="button">編輯</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>