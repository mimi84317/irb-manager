<!doctype html>
<html>
    <head>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'>
        <title>登入</title>
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
        <div>
            username  <input type="text" value="mimi84317" id="username"><br>
            clientid  <input type="text" value="test" id="clientid"><br>
            client_secret  <input type="text" value="123456" id="client_secret"><br>
            user  <input type="text" value="MEMC_6002124" id="user"><br>
            <button type="button" class="btn btn-outline-primary btn-login" id="uploadFilelist">設定案件上傳清單</button>
            <br>
            <button type="button" class="btn btn-outline-primary btn-login" id="committee">設定委員會議程</button>
        </div>

    </body>
    <script>
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

        $('.btn-login').on('click',function(e){
            username = $('#username').val();
            clientid = $('#clientid').val();
            client_secret = $('#client_secret').val();
            user = $('#user').val();
            caseType = e.target.id;
            condition = "";
            //loginURL = "http://127.0.0.1:8000/api/auth/login/uploadFilelist/" + username;
            if(caseType == "uploadFilelist"){
                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/uploadFilelist/" + username;
            }
            else if(caseType == "committee"){
                loginURL = "{{ env('SERVER_URL') }}" + "/api/auth/login/committee/" + username;
            }

            //console.log(loginURL);
            $.ajax({
                method:'post',
                url:loginURL,
                data: {username:username, clientid:clientid, client_secret:client_secret, user:user},
                success:function(data){
                    if(caseType == "uploadFilelist"){
                        openPostWindow("{{ route('fileuploadlist.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                    }
                    else if(caseType == "committee"){

                        openPostWindow("{{ route('committee.post') }}", "", data["access_token"], username, clientid, client_secret, user, condition);
                    }

                }
            });
        });
    </script>


</html>
