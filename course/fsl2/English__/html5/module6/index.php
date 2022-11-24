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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/><meta name="format-detection" content="telephone=no"/><meta name="apple-mobile-web-app-capable" content="yes"/><meta name="apple-mobile-web-app-status-bar-style" content="black"/><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="msapplication-tap-highlight" content="no"/><title>Module 6</title><link rel="apple-touch-icon-precomposed" href="data/apple-touch-icon.png"/><link rel="shortcut icon" type="image/ico" href="data/favicon.ico"/><style>body {background-color:#8a8a8a;}#spr0_1c4319ba {display:none;}</style>
    
    
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
	<script src="data/browsersupport.js?0DF0E298"></script>
	<script src="data/player.js?0DF0E298"></script>
    <div id="content"></div>
    <div id="spr0_1c4319ba"><audio id="snd0_1c4319ba" preload="none"><source src="data/sound1.mp3" type="audio/mpeg"/></audio><audio id="snd1_1c4319ba" preload="none"><source src="data/sound2.mp3" type="audio/mpeg"/></audio><audio id="snd2_1c4319ba" preload="none"><source src="data/sound3.mp3" type="audio/mpeg"/></audio><audio id="snd3_1c4319ba" preload="none"><source src="data/sound4.mp3" type="audio/mpeg"/></audio><audio id="snd4_1c4319ba" preload="none"><source src="data/sound5.mp3" type="audio/mpeg"/></audio><audio id="snd5_1c4319ba" preload="none"><source src="data/sound6.mp3" type="audio/mpeg"/></audio><audio id="snd6_1c4319ba" preload="none"><source src="data/sound7.mp3" type="audio/mpeg"/></audio><audio id="snd7_1c4319ba" preload="none"><source src="data/sound8.mp3" type="audio/mpeg"/></audio><audio id="snd8_1c4319ba" preload="none"><source src="data/sound9.mp3" type="audio/mpeg"/></audio><audio id="snd9_1c4319ba" preload="none"><source src="data/sound10.mp3" type="audio/mpeg"/></audio><audio id="snd10_1c4319ba" preload="none"><source src="data/sound11.mp3" type="audio/mpeg"/></audio><audio id="snd11_1c4319ba" preload="none"><source src="data/sound12.mp3" type="audio/mpeg"/></audio><audio id="snd12_1c4319ba" preload="none"><source src="data/sound13.mp3" type="audio/mpeg"/></audio><audio id="snd13_1c4319ba" preload="none"><source src="data/sound14.mp3" type="audio/mpeg"/></audio><audio id="snd14_1c4319ba" preload="none"><source src="data/sound15.mp3" type="audio/mpeg"/></audio><audio id="snd15_1c4319ba" preload="none"><source src="data/sound16.mp3" type="audio/mpeg"/></audio><audio id="snd16_1c4319ba" preload="none"><source src="data/sound17.mp3" type="audio/mpeg"/></audio><audio id="snd17_1c4319ba" preload="none"><source src="data/sound18.mp3" type="audio/mpeg"/></audio><audio id="snd18_1c4319ba" preload="none"><source src="data/sound19.mp3" type="audio/mpeg"/></audio><audio id="snd19_1c4319ba" preload="none"><source src="data/sound20.mp3" type="audio/mpeg"/></audio><audio id="snd20_1c4319ba" preload="none"><source src="data/sound21.mp3" type="audio/mpeg"/></audio><audio id="snd21_1c4319ba" preload="none"><source src="data/sound22.mp3" type="audio/mpeg"/></audio><audio id="snd22_1c4319ba" preload="none"><source src="data/sound23.mp3" type="audio/mpeg"/></audio><audio id="snd23_1c4319ba" preload="none"><source src="data/sound24.mp3" type="audio/mpeg"/></audio><audio id="snd24_1c4319ba" preload="none"><source src="data/sound25.mp3" type="audio/mpeg"/></audio><audio id="snd25_1c4319ba" preload="none"><source src="data/sound26.mp3" type="audio/mpeg"/></audio><audio id="snd26_1c4319ba" preload="none"><source src="data/sound27.mp3" type="audio/mpeg"/></audio><audio id="snd27_1c4319ba" preload="none"><source src="data/sound28.mp3" type="audio/mpeg"/></audio><audio id="snd28_1c4319ba" preload="none"><source src="data/sound29.mp3" type="audio/mpeg"/></audio><audio id="snd29_1c4319ba" preload="none"><source src="data/sound30.mp3" type="audio/mpeg"/></audio><audio id="snd30_1c4319ba" preload="none"><source src="data/sound31.mp3" type="audio/mpeg"/></audio><audio id="snd31_1c4319ba" preload="none"><source src="data/sound32.mp3" type="audio/mpeg"/></audio></div>
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