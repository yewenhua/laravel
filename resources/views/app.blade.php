<!DOCTYPE html>
<html lang="en">
<head>
	<title>智能V家APP下载</title>
	<meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="{{ asset('app/css/voc.min.css') }}">
</head>
<body>
	<div class="voc">
		<div class="header">
			<div class="logo">
				<i class="vocfont voc-logo"></i>
			</div>
			<div class="title">智能指纹锁APP下载</div>
			<div class="version">
				<span>V1.0.0正式版</span>
			</div>
			<div class="qrcode">
				<p><img src="{{asset('app/images/qrcode.png') }}" alt=""></p>
				<p>手机扫描下载</p>
			</div>
		</div>
		<!-- 头部 -->
		<div class="download">
			<a href="http://ziyuan.voc.so/app/vhome.apk">Android下载</a>
			<a href="https://itunes.apple.com/cn/app/v%E5%AE%B6-%E6%99%BA%E8%83%BD%E7%94%9F%E6%B4%BB/id1271959417?mt=8">IOS下载</a>
		</div>
		<!-- 下载 -->
		<div class="about">
			<h2>智能开锁</h2>
			<p>连接设备点击即可开锁</p>
			<small>添加蓝牙智能锁后，点击首页设备按钮，即可通过手机直接打开智能锁。</small>
			<p><img src="{{asset('app/images/about_01.png') }}" alt="连接设备点击即可开锁"></p>
			<h2>设备共享</h2>
			<p>快速共享设备给其他用户</p>
			<small>将设备快速共享给其他用户，按需分配权限，满足不同用户需要。</small>
			<p><img src="{{asset('app/images/about_02.png') }}" alt="快速共享设备给其他用户"></p>
			<h2>通知日志</h2>
			<p>设备开锁日志一目了然</p>
			<small>设备每一次操作都会记录到日志，用户可随时浏览设备的每步操作。</small>
			<p><img src="{{asset('app/images/about_03.png') }}" alt="设备开锁日志一目了然"></p>
		</div>
		<!-- 介绍 -->
		<div class="footer">
			<p>Copyright 2014 - 2018 浙江亚和大机电科技有限公司</p>
			<p>All Rights Reserved. voc.so</p>
		</div>
		<!-- 底部 -->
	</div>
	<script type="text/javascript">
	var offWidth = window.screen.width / 30;
	if(document.body.clientWidth < 640){
        document.getElementsByTagName("html")[0].style.fontSize = offWidth + 'px';
    }
	</script>
</body>
</html>