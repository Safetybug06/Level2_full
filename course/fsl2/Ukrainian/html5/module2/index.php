<?php
session_start();

if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: ../../../../../log-in.php");
    exit;
}
?>
<!DOCTYPE html>
<!-- Created with iSpring --><!-- 984 614 --><!--version 10.2.3.9011 --><!--type html --><!--mainFolder ./ -->
<html style=background-color:#8a8a8a;>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 2 part 2</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_f663ff1 {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?0D0B4C98"></script>
	<script src="data/player.js?0D0B4C98"></script>
    <div id="content"></div>
    <div id="spr0_f663ff1"><audio id="snd0_f663ff1" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_f663ff1" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_f663ff1" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_f663ff1" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_f663ff1" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_f663ff1" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_f663ff1" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_f663ff1" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_f663ff1" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_f663ff1" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_f663ff1" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_f663ff1" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_f663ff1" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_f663ff1" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_f663ff1" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_f663ff1" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_f663ff1" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_f663ff1" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_f663ff1" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_f663ff1" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_f663ff1" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio><audio id="snd21_f663ff1" preload="none"><source src="data/sound22.mp3" type="audio/mpeg"/></audio><audio id="snd22_f663ff1" preload="none"><source src="data/sound23.mp3" type="audio/mpeg"/></audio><audio id="snd23_f663ff1" preload="none"><source src="data/sound24.mp3" type="audio/mpeg"/></audio><audio id="snd24_f663ff1" preload="none"><source src="data/sound25.mp3" type="audio/mpeg"/></audio><audio id="snd25_f663ff1" preload="none"><source src="data/sound26.mp3" type="audio/mpeg"/></audio><audio id="snd26_f663ff1" preload="none"><source src="data/sound27.mp3" type="audio/mpeg"/></audio><audio id="snd27_f663ff1" preload="none"><source src="data/sound28.mp3" type="audio/mpeg"/></audio><audio id="snd28_f663ff1" preload="none"><source src="data/sound29.mp3" type="audio/mpeg"/></audio><audio id="snd29_f663ff1" preload="none"><source src="data/sound30.mp3" type="audio/mpeg"/></audio><audio id="snd30_f663ff1" preload="none"><source src="data/sound31.mp3" type="audio/mpeg"/></audio><audio id="snd31_f663ff1" preload="none"><source src="data/sound32.mp3" type="audio/mpeg"/></audio><audio id="snd32_f663ff1" preload="none"><source src="data/sound33.mp3" type="audio/mpeg"/></audio><audio id="snd33_f663ff1" preload="none"><source src="data/sound34.mp3" type="audio/mpeg"/></audio><audio id="snd34_f663ff1" preload="none"><source src="data/sound35.mp3" type="audio/mpeg"/></audio><audio id="snd35_f663ff1" preload="none"><source src="data/sound36.mp3" type="audio/mpeg"/></audio></div>
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