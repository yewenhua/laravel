
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <title>条码查询</title>
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
            document.writeln('<script src="{{ asset('tiaoma/assets/js/es6-promise.min.js') }}"'+'>'+'<'+'/'+'script>');
        }
    </script>
    <link rel="stylesheet" href="{{ asset('tiaoma/index.css') }}?v=1.2">
</head>
<body>
<div id="example" />
<script src="{{ asset('tiaoma/assets/js/react-dom.min.js') }}"></script>
<script src="{{ asset('tiaoma/assets/js/iconfont.js') }}"></script>
<script src="{{ asset('tiaoma/shared.js') }}"></script>
<script src="{{ asset('tiaoma/index.js') }}"></script>
<script src="{{ asset('tiaoma/assets/js/fastclick.js') }}"></script>
<script>
    if ('addEventListener' in document) {
        window.addEventListener('load', function() {
            FastClick.attach(document.body);
        }, false);
    }
</script>
</body>
</html>

