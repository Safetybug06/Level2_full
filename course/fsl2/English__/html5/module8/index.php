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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 8 English</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_1c3b73e7 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?2C0D9D9A"></script>
	<script src="data/player.js?2C0D9D9A"></script>
    <div id="content"></div>
    <div id="spr0_1c3b73e7"><audio id="snd0_1c3b73e7" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_1c3b73e7" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_1c3b73e7" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_1c3b73e7" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_1c3b73e7" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_1c3b73e7" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_1c3b73e7" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_1c3b73e7" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_1c3b73e7" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_1c3b73e7" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_1c3b73e7" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_1c3b73e7" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_1c3b73e7" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_1c3b73e7" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_1c3b73e7" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_1c3b73e7" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_1c3b73e7" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_1c3b73e7" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_1c3b73e7" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_1c3b73e7" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_1c3b73e7" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio><audio id="snd21_1c3b73e7" preload="none"><source src="data/sound22.mp3" type="audio/mpeg"/></audio><audio id="snd22_1c3b73e7" preload="none"><source src="data/sound23.mp3" type="audio/mpeg"/></audio><audio id="snd23_1c3b73e7" preload="none"><source src="data/sound24.mp3" type="audio/mpeg"/></audio><audio id="snd24_1c3b73e7" preload="none"><source src="data/sound25.mp3" type="audio/mpeg"/></audio><audio id="snd25_1c3b73e7" preload="none"><source src="data/sound26.mp3" type="audio/mpeg"/></audio></div>
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