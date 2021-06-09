<!doctype html>
<html>
  <head>
    <title>{{$var}} Not Found - {{ config('app.name')}}</title>

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .container {
            padding: 4rem 5rem;
            background-color: #fff;
            border-radius: 1rem;
            width: 100%;
            max-width: 45rem;
        }
        h1 {
            color: #fff;
            font-size: 2.8rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
            background: -webkit-linear-gradient(#fff, #999);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }
        h4 {
            color: lighten(#5c3d86,30%);
            font-size: 1.5rem;
            font-weight: 400;
            text-align: center;
            margin: 0 0 3.5rem 0;
        }
        .btn.btn-primary {
            background-color: $purple;
            border-color: $purple;
            outline: none;
            &:hover {
                background-color: darken($purple, 10%);
                border-color: darken($purple, 10%);
            }
            &:active, &:focus {
                background-color: lighten($purple, 5%);
                border-color: lighten($purple, 5%);
            }
        }

    </style>
  </head>
  <body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                錯誤：找不到 {{$var}}
            </div>
        </div>
    </div>
  </body>
</html>
