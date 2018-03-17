
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <title>保修注册</title>
    <script>
        (function(doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                recalc = function() {
                    var clientWidth = docEl.clientWidth;
                    if (!clientWidth) return;
                    if(clientWidth == 375){
                        docEl.style.fontSize = '100px';
                    }else{
                        docEl.style.fontSize = 100 * (clientWidth / 375) + 'px';
                    }
                };
            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);
    </script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script>
        var signature = '{{$signature}}';
        var appId = '{{$appId}}';
        var timeStamp = '{{$timeStamp}}';
        var nonceStr = '{{$nonceStr}}';
        var wxapiurl = '{{$wxapiurl}}';
    </script>
    <script>
        if(!window.Promise) {
            document.writeln('<script src="{{ asset('baoxiu/assets/js/es6-promise.min.js') }}"'+'>'+'<'+'/'+'script>');
        }
    </script>
    <link rel="stylesheet" href="{{ asset('baoxiu/index.css') }}?v=1.1">
    <script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=2XKBZ-UFYH6-JE5SC-MY3VY-AWUBT-ODFAB"></script>
</head>
<body>
<div id="example" />
<script src="{{ asset('baoxiu/assets/js/react-dom.min.js') }}"></script>
<script src="{{ asset('baoxiu/assets/js/iconfont.js') }}"></script>
<script src="{{ asset('baoxiu/shared.js') }}?v=1.1"></script>
<script src="{{ asset('baoxiu/index.js') }}?v=1.1"></script>
<script src="{{ asset('baoxiu/assets/js/fastclick.js') }}"></script>
<script>
    if ('addEventListener' in document) {
        window.addEventListener('load', function() {
            FastClick.attach(document.body);
        }, false);
    }
</script>
</body>
</html>

