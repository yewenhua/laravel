<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>

    <script>
        $(function() {
            var ws, name, room_id, client_list = {};

            // 连接服务端
            function connect() {
                name = '游客';
                room_id = 1;
                // 创建websocket
                ws = new WebSocket("ws://" + document.domain + ":7272");
                // 当socket连接打开时，输入用户名
                ws.onopen = onopen;
                // 当有消息时根据消息类型显示不同信息
                ws.onmessage = onmessage;
                ws.onclose = function () {
                    console.log("连接关闭，定时重连");
                    connect();
                };
                ws.onerror = function () {
                    console.log("出现错误");
                };
            }
            connect();

            // 连接建立时发送登录信息
            function onopen() {
                // 登录
                var login_data = '{"type":"login","client_name":"' + name.replace(/"/g, '\\"') + '","room_id":' + room_id + '}';
                console.log("websocket握手成功，发送登录数据:" + login_data);
                ws.send(login_data);
            }

            // 服务端发来消息时
            function onmessage(e) {
                console.log(e.data);
                var data = eval("(" + e.data + ")");
                switch (data['type']) {
                    // 服务端ping客户端
                    case 'ping':
                        ws.send('{"type":"pong"}');
                        break;
                        ;
                    // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
                    case 'init':
                        // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.post('/member/bind', {client_id: data.client_id}, function (data) {
                            console.log('bind success');
                        }, 'json');
                        break;
                    // 登录 更新用户列表
                    case 'login':
                        alert(data['client_id'] + data['client_name'] + data['client_name'] + ' 加入了聊天室' + data['time']);
                        break;
                    // 发言
                    case 'say':
                        alert(data['from_client_id'] + data['from_client_name'] + data['content'] + data['time']);
                        break;
                    // 用户退出 更新用户列表
                    case 'logout':
                        alert(data['from_client_id'] + data['from_client_name'] + data['from_client_name'] + ' 退出了', data['time']);
                }
            }
        });
    </script>
</html>
