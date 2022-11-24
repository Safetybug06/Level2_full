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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 4 English</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_1c36b0d9 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?DA607648"></script>
	<script src="data/player.js?DA607648"></script>
    <div id="content"></div>
    <div id="spr0_1c36b0d9"><audio id="snd0_1c36b0d9" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_1c36b0d9" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_1c36b0d9" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_1c36b0d9" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_1c36b0d9" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_1c36b0d9" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_1c36b0d9" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_1c36b0d9" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_1c36b0d9" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_1c36b0d9" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_1c36b0d9" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_1c36b0d9" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_1c36b0d9" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_1c36b0d9" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_1c36b0d9" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_1c36b0d9" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_1c36b0d9" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_1c36b0d9" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_1c36b0d9" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_1c36b0d9" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_1c36b0d9" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio><audio id="snd21_1c36b0d9" preload="none"><source src="data/sound22.mp3" type="audio/mpeg"/></audio><audio id="snd22_1c36b0d9" preload="none"><source src="data/sound23.mp3" type="audio/mpeg"/></audio><audio id="snd23_1c36b0d9" preload="none"><source src="data/sound24.mp3" type="audio/mpeg"/></audio><audio id="snd24_1c36b0d9" preload="none"><source src="data/sound25.mp3" type="audio/mpeg"/></audio><audio id="snd25_1c36b0d9" preload="none"><source src="data/sound26.mp3" type="audio/mpeg"/></audio><audio id="snd26_1c36b0d9" preload="none"><source src="data/sound27.mp3" type="audio/mpeg"/></audio><audio id="snd27_1c36b0d9" preload="none"><source src="data/sound28.mp3" type="audio/mpeg"/></audio><audio id="snd28_1c36b0d9" preload="none"><source src="data/sound29.mp3" type="audio/mpeg"/></audio><audio id="snd29_1c36b0d9" preload="none"><source src="data/sound30.mp3" type="audio/mpeg"/></audio><audio id="snd30_1c36b0d9" preload="none"><source src="data/sound31.mp3" type="audio/mpeg"/></audio><audio id="snd31_1c36b0d9" preload="none"><source src="data/sound32.mp3" type="audio/mpeg"/></audio><audio id="snd32_1c36b0d9" preload="none"><source src="data/sound33.mp3" type="audio/mpeg"/></audio><audio id="snd33_1c36b0d9" preload="none"><source src="data/sound34.mp3" type="audio/mpeg"/></audio><audio id="snd34_1c36b0d9" preload="none"><source src="data/sound35.mp3" type="audio/mpeg"/></audio><audio id="snd35_1c36b0d9" preload="none"><source src="data/sound36.mp3" type="audio/mpeg"/></audio><audio id="snd36_1c36b0d9" preload="none"><source src="data/sound37.mp3" type="audio/mpeg"/></audio><audio id="snd37_1c36b0d9" preload="none"><source src="data/sound38.mp3" type="audio/mpeg"/></audio><audio id="snd38_1c36b0d9" preload="none"><source src="data/sound39.mp3" type="audio/mpeg"/></audio><audio id="snd39_1c36b0d9" preload="none"><source src="data/sound40.mp3" type="audio/mpeg"/></audio></div>
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