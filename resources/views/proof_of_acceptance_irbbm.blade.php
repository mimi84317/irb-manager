<!doctype html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>收件證明 - 中央研究院醫學研究倫理委員會</title>

    <style>
        {{-- @font-face {
            font-family: 'Firefly Sung';
            font-style: normal;
            src: url({{ storage_path('fonts/TW-Sung-98_1.ttf') }}) format('truetype');
        } --}}

        header {
            position: fixed;
            text-align: center;
            z-index: -1;
        }
        .stamp {
            position:absolute;
            right:0px;
            top:20px;
            text-align: center;
            z-index: -1;
        }

        body {
            font-family:'kaiu';
            font-size:13px;
        }
        .wrapper-page {
            page-break-after: auto;
            page-break-inside: avoid;
        }

        .wrapper-page:last-child {
            page-break-after: avoid;
        }
        span.cls_002 {
            font-family:'kaiu';
            font-size:27px;
            color:rgb(0,0,0);
            font-weight:bold;
        }
        div.cls_002 {
            font-family:'kaiu';
            font-size:27px;
            color:rgb(0,0,0);
            font-weight:bold;
            margin-bottom: 20px;
        }
        span.desc {
            font-family:'kaiu';
            font-size:13px;
            color:rgb(0,0,0);
            font-weight:normal;
            font-style:normal;
            text-decoration: none;
        }
        div.desc {
            font-family:'kaiu';
            font-size:13px;
            color:rgb(0,0,0);
            font-weight:normal;
            font-style:normal;
            text-decoration: none;
        }
        span.cls_003 {
            font-family:'kaiu';
            font-size:13px;
            color:rgb(0,0,0);
            font-weight:normal;
            font-style:normal;
            text-decoration: none;
            word-wrap:break-word;
        }
        div.cls_003 {
            font-family:'kaiu';
            font-size:13px;
            color:rgb(0,0,0);
            font-weight:normal;
            font-style:normal;
            text-decoration: none;
            max-width: 95%;
        }
        span.cls_004 {
            font-family:'kaiu';
            font-size:13px;
            color:rgb(255,0,0);
            font-weight:normal;
            font-style:normal;
            text-decoration: none;
        }
        div.cls_004 {
            font-family:'kaiu';
            font-size:13px;
            color:rgb(255,0,0);
            font-weight:normal;
            font-style:normal;
            text-decoration: none;
        }
        span.cls_005 {
            font-family:'kaiu';
            font-size:14px;
            color:rgb(12,42,126);
            font-weight:normal;
            font-style:normal;
            text-decoration: none
        }
        div.cls_005 {
            font-family:'kaiu';
            font-size:14px;
            color:rgb(12,42,126);
            font-weight:normal;
            font-style:normal;
            text-decoration: none
        }

        .line {
            width: 700px;
            height: 1px;
            border-bottom: 1px solid black;
            position: absolute;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .radio {
            display: inline-block;
            vertical-align: top;
            padding-left: 25px;
            position: relative;
        }

        .radio input {
            position: absolute;
            left: 0;
            top: 0;
        }

        .checkbox {
            display: inline-block;
            vertical-align: top;
            padding-left: 25px;
            position: relative;
        }

        .checkbox input {
            position: absolute;
            left: 0;
            top: 0;
        }
        .block {
            margin-bottom: 10px;
        }
        .data-div {
            /* overflow-x: hidden; */
            /* max-height: 211px; */
            max-width: 95%;
            /* overflow:hidden */
        }
        .data-table {
            position:relative;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 10px;
            max-width: 90%;
            border-collapse: collapse;
        }
        .data-table td {
            border: 1px solid black;
        }
        .data-table th {
            border: 1px solid black;
            background-color: #c8f396;
            color: black;
        }
        .cell {
            /* max-width: 95%; */
            /* min-width: 80px; */
            margin: 2px;
            word-break: break-word;
            word-wrap: break-word;
        }

        .info-table {
            word-break: break-word;
            word-wrap: break-word;
        }

    </style>
  </head>
  <body>
    <header>
        <div class="cls_005 stamp">
            <img src="{{storage_path('img/stamp.jpg')}}" width=150 height=90>
            <div style="position:absolute;left:4px;top:24px" class="cls_005">收件日期：{{$date}}</div>
            {{-- <table style="text-align: center; border: 2px solid rgb(12,42,126);">
                <tr>
                    <td>
                        <div style="font-size:19px;font-weight:bold;">Aa</div>
                        <div style="font-size:15px">醫學研究倫理委員會IRB</div>
                        <div class="cls_005">收件日期：2017-02-14</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="font-size:17px"><b>將進行審查程序</b></div>
                    </td>
                </tr>
            </table> --}}
        </div>
    </header>
    <div style="margin-top:-20px">
        {{-- <div style="position:absolute;left:0px;top:0px">aaa</div> --}}


        <div style="position:relative;left:0px;top:0px;width:100%;text-align:center" class="cls_002"><span class="cls_002">中央研究院醫學研究倫理委員會研究計畫審查申請表</span></div>

        <div style="position:reletive" class="cls_003"><span class="cls_003">編號：{{$irbNumber}}</span></div>

        <div style="position:reletive" class="cls_003">
            <div class="cls_003">申請表類型
                <label class="radio">
                    <input class="input-radio" type="radio" @if($isNormalReview) checked @endif>
                    一般審/簡審
                </label>
                <label class="radio">
                    <input class="input-radio" type="radio" @if(!$isNormalReview) checked @endif>
                    免審
                </label>
            </div>
        </div>
        <div style="position:reletive" class="line"></div>

        <div style="position:reletive;margin-bottom:10px" class="desc"><span class="desc">凡本院研究人員所參與之研究計畫涉及人體研究或人體檢體及資料的採集與使用，不論人體檢體、資料或計畫經費來源，<br/>均須填寫本表及完整附件（PDF文字檔），送至本委員會，經本委員會審核通過，始可進行。若與其他機構合作，需經本委<br/>員會及合作機構相關委員會之同意。本委員會將於3次入會期限內對申請案作成決議。</span></div>

        <div style="position:reletive;">
            <div style="position:relative" class="block">
                <div style="position:relative" class="cls_003"><span class="cls_003">1. 申請人 </span><span class="cls_004">*</span><span class="cls_003"> ：</span></div>
                <div style="position:relative;margin-left:20px">
                    <table class="info-table">
                        <tr><td>中文：</td><td>{{$chName}}</td></tr>
                        <tr><td>英文：</td><td>{{$enName}}</td></tr>
                        <tr><td>所別：</td><td>{{$institute}}</td></tr>
                        <tr><td>電話：</td><td>{{$phone}}</td></tr>
                        <tr><td>E-mail：</td><td>{{$email}}</td></tr>
                    </table>
                </div>
                {{-- <div style="position:relative;left:30px" class="cls_003"><span class="cls_003">中文：    申請人包伯</span></div>
                <div style="position:relative;left:30px" class="cls_003"><span class="cls_003">英文：    BOB</span></div>
                <div style="position:relative;left:30px" class="cls_003"><span class="cls_003">所別：    Institute of Biomedical Sciences 生物醫學科學研究所</span></div>
                <div style="position:relative;left:30px" class="cls_003"><span class="cls_003">電話：    4234</span></div>
                <div style="position:relative;left:30px" class="cls_003"><span class="cls_003">E-mail： rong66@gmail.com</span></div> --}}
            </div>
            <div style="position:relative" class="block">
                <div style="position:relative" class="cls_003"><span class="cls_003">2. 計畫名稱 </span><span class="cls_004">*</span><span class="cls_003"> ：</span></div>
                <div style="position:relative;margin-left:20px" class="cls_003">
                    <table class="info-table">
                        <tr><td style="vertical-align: top">中文：</td><td style="vertical-align: top">{{$projChName}}</td></tr>
                        <tr><td style="vertical-align: top">英文：</td><td style="vertical-align: top">{{$projEnName}}</td></tr>
                    </table>
                </div>
            </div>
            <div style="position:relative" class="block">
                <div style="position:relative" class="cls_003"><span class="cls_003">3. 經費來源 </span><span class="cls_004">*</span><span class="cls_003"> ：</span></div>
                <div style="position:relative;left:20px">
                    <label class="checkbox">
                        <input type="checkbox" class="input-checkbox" @if(isset($sourceFromAS) && $sourceFromAS != '') checked @endif>
                        院內 @if(isset($sourceFromAS) && $sourceFromAS != '') {{$sourceFromAS}} @endif
                    </label>
                </div>
                <div style="position:relative;left:20px">
                    <label class="checkbox">
                        <input type="checkbox" class="input-checkbox" @if(isset($sourceFromEX) && $sourceFromEX != '') checked @endif>
                        院外 @if(isset($sourceFromEX) && $sourceFromEX != '') {{$sourceFromEX}} @endif
                    </label>
                </div>
            </div>
            <div style="position:relative" class="block">
                <div style="position:relative" class="cls_003"><span class="cls_003">4. 合作對象：請列明協同主持人及其所屬機構；若非特定協同主持人，請列明合作機構名稱</span></div>
                <div style="position:relative;margin-left:20px;margin-bottom:10px" class="cls_003"><span class="cls_003">中研院內</span></div>
                <div class="data-div wrapper-page">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>姓名（中、英文）</th>
                                <th>院內機構 （中、英文）</th>
                                <th>於計畫之身分</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collabAS as $partner)
                            <tr>
                                <td><div class="cell">{{$partner['name']}}</div></td>
                                <td><div class="cell">{{$partner['inst']}}</div></td>
                                <td><div class="cell">{{$partner['role']}}</div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="position:relative;margin-left:20px;margin-bottom:10px;page-break-after: avoid;" class="cls_003"><span class="cls_003">中研院外</span></div>
                <div class="data-div wrapper-page">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>姓名（中、英文）</th>
                                <th>院內機構 （中、英文）</th>
                                <th>於計畫之身分</th>
                            </tr>
                        </thead>
                        {{-- <tbody> --}}
                            @foreach($collabNonAS as $partner)
                            <tr>
                                <td><div class="cell">{{$partner['name']}}</div></td>
                                <td><div class="cell">{{$partner['inst']}}</div></td>
                                <td><div class="cell">{{$partner['role']}}</div></td>
                            </tr>
                            @endforeach
                        {{-- </tbody> --}}
                    </table>
                </div >
            </div>
            <div style="position:relative;" class="cls_003"><span class="cls_003">5. 計畫執行時間(起迄) </span><span class="cls_004">*</span><span class="cls_003"> ：{{$startDate}} 至 {{$endDate}}</span></div>
        </div>
    </div>
  </body>
</html>
