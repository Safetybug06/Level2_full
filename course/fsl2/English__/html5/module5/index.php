<?php
session_start();


if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: ../../../../../log-in.php");
    exit;
}
?>
<!DOCTYPE html>
<!-- Created with iSpring --><!-- 984 614 --><!--version 9.7.4.12007 --><!--type html --><!--mainFolder ./ -->
<html style=background-color:#8a8a8a;>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 5 English</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_1c37f4a4 {display:none;}</style>
    
    
    <style>
		#playerView {
			position:absolute;
			-webkit-tap-highlight-color:rgba(0,0,0,0);
			-webkit-user-select:none;
			-moz-user-select:none;
			-webkit-touch-callout:none;
			-webkit-user-drag:none;
		}
		#playerView * {
			position:absolute;
		}
		#preloader {
			width: 50px;
			height: 50px;
			position: absolute;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			margin: auto;
			border-radius: 10px;
			background-color: rgba(0, 0, 0, 0.5);
		}

		#preloader::after {
			content: '';
			position: absolute;
			background: url(data:image/png;base64,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UmVhZHlxyWU8AAADcmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMwNjcgNzkuMTU3NzQ3LCAyMDE1LzAzLzMwLTIzOjQwOjQyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOmFjOGVjNDFhLTZkYWItODQ0Ni04YzkzLWU1Mjk3N2YwMmE4NSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFRThCNzU3NDYzNjcxMUU1QTZDRUE5NTVGOUJGQ0E3MCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFRThCNzU3MzYzNjcxMUU1QTZDRUE5NTVGOUJGQ0E3MCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxNSAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0OWFlZmI1OC00ZWFmLWQ3NDgtYTI0ZS0zNmNhNGQ2M2QwNTYiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6N0MwQkFBM0M2MjAxMTFFNUI4QjBERTk4MjY5MjQwQjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6MGSVVAAAE3klEQVR42uycW4hWVRiG15Q4eYzGQySSQlriEQ9BF2mE4iSdESRRIb0RD+mNmHgICjqQEGUe6sqgCy1i0iRinAzELrooQhHLGQURUTzMiM7omCLj+/F/czX/t/890z6s9e/3hZcZ1l6z19r7mXXca62arq4uR/mjh/gKCIQiEAKhCIRAKAIhEIpACIQiEIpACIQiEAKhCIRAKAIhEMoX9Yu62NbWxjcUobq6OpaQQpcQz/QwPBOeDU+Fx8Oj4UfhoRrnJnwDvgC3wCfgY/Bf8P0QHrImahmQB1VWLfwGvAieqy+/LxJIR+Dv4QPwf75WWb4CGQavg9fo70mqFd4F79DfCSRCA+HN8Hp4cMppdcBfwB/Bt9mo99Sr8Cl4SwYwnKYhaf2jaXMconoE/hL+CR6TQ/pPato7NS+FbtSfgH+Gp8eMfwv+HT6qpakZvqzVT/d//ePw0/BEeI72ygbFvP/f8MvwpSK2IfLSGuGxFeJ1aby98CG4s5fpDNAqaTlcL89cIf45jddcpDZknI4PKsFo0NKzQLusnX1Iq1P/doHe60CF+GM1b+OK0obIYO5XeGREnLPwfHghfDzBtOVeb+q9z0bEG6njltHVDqQ2RuP9HTwDbkoxH02axv4YjX1tNQP5LKIBl7ZiK/yWToGkLUljsaZpNaTTNc9VCeR1eHUEjHfgD3OoQiXNVRFQVmveqwrIEHh3xPXNOp2Rl77WPFiSvA+tJiCb4FHGNanHP/FggCp52Gdck7y/Wy0Dw2Hatx9s9KZmZNRmxC3JMjh8qsy1Du0St4Y+DomaKFzlEQxRu+apnOQZ1oVeZfWPeMCGlLu2/6dL3BDRwPcPGYiMjocbvaoPnL963+h1DddnChbIMiP8cMIj8KQln34be/lM3gOREW69cW2v81/fGOH1aY7e0wTyrNGYyxT6wQCAHNS8lmvcZ4UIZL4RLt8z7gQA5I7mtZyeCxHIS0b4UReOrLw+EyIQqxScDAiIldcJIQLZYTTmvwUEpMUIHxMikB/gta40PXIF/lwHVrcCAnLVCH8srQR9X7mYt2RUbq1yrOFia390N9SReugaYoR3EEg+GmGEtxNIPhpvhJ8nkHw02Qj/l0Dy0Rwj/DSBZC9ZeD3buPYHgWSv11z5RdrSw/qTQLLX20Z4o0toSxyBxJdsKrVmq79NM2ECKa/3XPltC9fgXwgkW81zpVX35fSVS3HahEB6SqZK9hjXujeJOgLJTrLG19qos1OrLALJSLL+eLFx7SL8cRaZIJCSVrrSfnVL8qHtJoFkoy3ablibQeWz849ZZaZfgUHIfg/Z97EkIs5xLR2OQNLv2u5x0Ttt5UShV1wfj91glRVP01xp8UVTBRiyuOFFheJYQpKVzNrKwQErXPyDA2SF+5k8MhsykCnwPdfzaA3ZYy6nREyCX4Cfd/EPs+nV0RoEUlqWsx1eCie9Bkc2nW5wOa87Dg3Ipy75bWXntSd1yIcHDK1RT3KzTIcOBif6AqOo3d42HX/I0tZW3zIXWgnp68chmfaQjZxyoKac0bXNRxghlpCN2m1dpj/btXEfpD0uqYaua89Luq3dx8TKN3AeE1vt4mLrAohACIQiEAKhCIRAKAIhEIpACq7IqROKJYRA+AoIhCIQAqEIhEAoAiEQikCKrQcCDABHPgH2w7NQdAAAAABJRU5ErkJggg==);
			background-size: cover;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			animation: preloader_spin 1s infinite linear;
			-webkit-animation: preloader_spin 1s infinite linear;
		}

		@keyframes preloader_spin { 0% {transform: rotate(0deg);} 100% {transform: rotate(360deg);} }
		@-webkit-keyframes preloader_spin { 0% {-webkit-transform: rotate(0deg);} 100% {-webkit-transform: rotate(360deg);}}
    </style>
</head>
<body>
	<div id="preloader"></div>
	<script src="data/browsersupport.js?6CF58B25"></script>
	<script src="data/player.js?6CF58B25"></script>
    <div id="content"></div>
    <div id="spr0_1c37f4a4"><audio id="snd0_1c37f4a4" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_1c37f4a4" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_1c37f4a4" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_1c37f4a4" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_1c37f4a4" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_1c37f4a4" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_1c37f4a4" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_1c37f4a4" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_1c37f4a4" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_1c37f4a4" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_1c37f4a4" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_1c37f4a4" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_1c37f4a4" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_1c37f4a4" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_1c37f4a4" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_1c37f4a4" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_1c37f4a4" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_1c37f4a4" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_1c37f4a4" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_1c37f4a4" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_1c37f4a4" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio></div>
    <script>
		(function(startup){
			function start(savedPresentationState)
			{
				var presInfo = "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";
				PresentationPlayer.start(presInfo, "content", "playerView", onPlayerInit, savedPresentationState);
				function onPlayerInit(player)
				{
					(player);

					var preloader = document.getElementById("preloader");
					preloader.parentNode.removeChild(preloader);
				}
			}

			if (startup)
				startup(start);
			else
				start();
		})();
    </script>
</body>
</html>