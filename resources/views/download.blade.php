
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <title>下载中心</title>
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
    <script>
        var wxapiurl = '{{$wxapiurl}}';
    </script>
    <script>
        if(!window.Promise) {
            document.writeln('<script src="{{ asset('download/assets/js/es6-promise.min.js') }}"'+'>'+'<'+'/'+'script>');
        }
    </script>
    <link rel="stylesheet" href="{{ asset('download/index.css') }}">
</head>
<body>
<div id="example" />
<script src="{{ asset('download/assets/js/react-dom.min.js') }}"></script>
<script src="{{ asset('download/shared.js') }}"></script>
<script src="{{ asset('download/index.js') }}"></script>
<script src="{{ asset('download/assets/js/fastclick.js') }}"></script>
<script>
    if ('addEventListener' in document) {
        window.addEventListener('load', function() {
            FastClick.attach(document.body);
        }, false);
    }
</script>
</body>
</html>

