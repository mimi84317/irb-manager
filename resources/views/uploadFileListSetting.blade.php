<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>
        <title>修改上傳清單</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <div class="container">
            <p class="titleText">{{ $showCase }}修改上傳清單與設定送審須知</p>
            <div class="card col-16">
                <div class="card-header">上傳清單</div>
                <div class="card-body">
                    <div>
                        <table class="table table-hover filelistTable">
                            <thead>
                                <tr>
                                    <th scope="col">順序</th>
                                    <th scope="col" class="col-2">文件名稱</th>
                                    <th scope="col" class="col-3">文件說明</th>
                                    <th scope="col">是否必要</th>
                                    <th scope="col" class="col-2">上傳範本檔</th>
                                    <th scope="col" class="col-2">己上傳範本檔</th>
                                    <th scope="col" class="col-1">刪除</th>
                                    <th scope="col" class="col-1">調整順序</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($caseList as $case)
                                    <tr>
                                        <th class="row-id">{{ $case['id'] }}</th>
                                        <th class="row-name"><input type="text" class="form-control name-value" value="{{ $case['chname'] }}"></th>
                                        <th class="row-desc"><textarea class="form-control" rows="3">{{ $case['example_desc'] }}</textarea></th>
                                        <th class="row-require">
                                            @if ($case['required'] == "Y")
                                                <input class="form-check-input" type="checkbox" checked>
                                            @elseif ($case['required'] == "N")
                                            <input class="form-check-input" type="checkbox">
                                            @endif
                                        </th>
                                        <th><input class="form-control" type="file" id="formFile"></th>
                                        <th class="row-file"><a href="http://10.109.233.21/api/example/download?clientid=test&caseType={{ $caseType }}&file={{ $case['example_name'] }}">{{ $case['example_name'] }}</a></th>
                                        <th><button type="button" class="btn btn-outline-primary btn-delete"><i class="fas fa-trash-alt"></i></button></th>
                                        <th>
                                            <button type="button" class="btn btn-outline-info btn-moveUp"><i class="fas fa-arrow-up"></i></button>
                                            <button type="button" class="btn btn-outline-info btn-moveDown"><i class="fas fa-arrow-down"></i></button>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        <button type="button" class="btn btn-outline-success btn-addlist">新增清單</button>
                    <div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card col-16">
                <div class="card-header">送審須知</div>
                <div class="card-body">
                    <table class="table table-hover contentTable">
                        <tbody>
                            <tr>
                                <th scope="col" class="col-1">標題</th>
                                <th class="case-title"><input type="text" class="form-control case-title-value" value="{{ $caseContent[0]['review_subj'] }}"></th>
                            </tr>
                            <tr>
                                <th scope="col" class="col-1">說明</th>
                                <th class="case-desc"><textarea class="form-control" rows="15">{{ $caseContent[0]['review_desc'] }}</textarea></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div>
                <button type="button" class="btn btn-outline-primary btn-update">更新</button>
                <a class="btn btn-outline-primary" href="{{ route('fileuploadlist') }}" role="button">返回上一頁</a>
            </div>
        </div>
        
    </body>
    <script type="text/javascript">

        $('.btn-moveUp').click(function() {
            var row = $(this).parents('tr:first');
            var order = row.children('th.row-id').text();
            var prevorder = row.prev().children('th.row-id').text();
            row.children('th.row-id').text(prevorder);
            row.prev().children('th.row-id').text(order);
            row.insertBefore(row.prev());
        });

        $('.btn-moveDown').click(function(){
            var row = $(this).parents('tr:first');
            var order = row.children('th.row-id').text();
            var nextorder = row.next().children('th.row-id').text();
            row.children('th.row-id').text(nextorder);
            row.next().children('th.row-id').text(order);
            row.insertAfter(row.next());
        });

        $('.btn-delete').click(function(){
            var row = $(this).parents('tr:first');
            var deleteorder = row.children('th.row-id').text();
            row.remove();
            var orderlist = $('th.row-id').text();
            var newOrderlist = new Array(orderlist.length);
            for(var i = 0; i < orderlist.length; i++){ 
                if(orderlist[i] > deleteorder){
                    var newOrder = parseInt(orderlist[i], 10) - 1;
                    newOrderlist[i] = newOrder;
                }
                else{
                    newOrderlist[i] = orderlist[i];
                }
                $(".row-id:eq("+i+")").text(newOrderlist[i]);
            }
        });

        $('.btn-addlist').click(function(){
            var lastorder = $('.filelistTable tr:last').children('th.row-id').text();
            var newlastorder = parseInt(lastorder) + 1;
            var newrow = '';
            newrow += '<tr>';
            newrow += '<th class="row-id">' + newlastorder + '</th>';
            newrow += '<th><input type="text" class="form-control" value=""></th>';
            newrow += '<th><textarea class="form-control" rows="3"></textarea></th>';
            newrow += '<th><input class="form-check-input" type="checkbox"></th>';
            newrow += '<th><input class="form-control" type="file" id="formFile"></th>';
            newrow += '<th></th>';
            newrow += '<th><button type="button" class="btn btn-outline-primary btn-delete"><i class="fas fa-trash-alt"></i></button></button></th>';
            newrow += '<th>';
            newrow += '<button type="button" class="btn btn-outline-info btn-moveUp"><i class="fas fa-arrow-up"></i></button>';
            newrow += '<button type="button" class="btn btn-outline-info btn-moveDown"><i class="fas fa-arrow-down"></i></button>';
            newrow += '</th>';
            newrow += "</tr>";
            $('.filelistTable').append(newrow);
        });

        $('.btn-update').click(function(e){
            var filelistTableLength = $('.filelistTable tr').length;
            var contentTableLength = $('.contentTable tr').length;
            var caseType = "{{ $showCase }}";
            var filelistUpdate = {};
            var contentUpdate = {};

            for(var i = 1; i < filelistTableLength; i++){
                filelistUpdate[i-1] = {};
                filelistUpdate[i-1]['id'] = $('.filelistTable tr:eq('+i+')').children('th.row-id').text();
                filelistUpdate[i-1]['name'] = $('.filelistTable tr:eq('+i+')').children('th.row-name').children('.name-value').val();
                filelistUpdate[i-1]['desc'] = $('.filelistTable tr:eq('+i+')').children('th.row-desc').text();
                filelistUpdate[i-1]['require'] = $('.filelistTable tr:eq('+i+')').children('th.row-require').text();
                filelistUpdate[i-1]['file'] = $('.filelistTable tr:eq('+i+')').children('th.row-file').text();
            }

            contentUpdate = {'subject': $('.contentTable tr:eq(0)').children('th.case-title').children('.case-title-value').val(),
                             'content':$('.contentTable tr:eq(1)').children('th.case-desc').text()};
            
            console.log(filelistUpdate);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method:'post',
                url:"{{ route('fileuploadlist.update') }}",
                data: {caseType:caseType, filelistUpdate:filelistUpdate, contentUpdate:contentUpdate},
                success:function(data){
                    console.log(data);
                }
            });
        });
    </script>

</html>
